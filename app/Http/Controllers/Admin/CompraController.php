<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\CompraDetalle;
use App\Search;
use App\Compra;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CompraController extends Controller
{
    public function index(Request $req)
    {
        $q     = trim((string) $req->get('q'));
        $from  = $req->get('from');
        $to    = $req->get('to');

        $compras = Compra::query()
            ->withCount('detalles')
            ->when($q, function($qq) use ($q){
                $qq->where('codigo','like',"%$q%")
                   ->orWhere('proveedor','like',"%$q%")
                   ->orWhere('factura_numero','like',"%$q%");
            })
            ->when($from, fn($qq)=> $qq->whereDate('fecha','>=',$from))
            ->when($to,   fn($qq)=> $qq->whereDate('fecha','<=',$to))
            ->orderByDesc('idcompra')
            ->paginate(12)
            ->withQueryString();

        if ($req->wantsJson()) {
            return response()->json(['compras' => $compras]);
        }

        return view('admin.compras.index', compact('compras','q','from','to'));
    }

    public function show($id, Request $req)
    {
        $compra = Compra::with(['detalles.producto'])->findOrFail($id);

        return response()->json(['compra' => $compra]);
    }

    public function store(Request $req)
    {
        // Validación
        $data = $req->validate([
            'fecha'           => ['required','date'],
            'proveedor'       => ['nullable','string','max:180'],
            'factura_numero'  => ['nullable','string','max:80'],
            'factura'         => ['nullable','file','mimes:pdf,jpg,jpeg,png','max:5120'],
            'items'           => ['required','array','min:1'],
            'items.*.search_id' => ['required','integer','distinct'],
            'items.*.qty'       => ['required','integer','min:1'],
            'items.*.costo'     => ['required','numeric','min:0'],
        ]);

        // Verificar que existan todos los productos
        $ids = collect($data['items'])->pluck('search_id')->all();
        $foundCount = Search::whereIn('id',$ids)->count();
        if ($foundCount !== count($ids)) {
            return response()->json(['message'=>'Algunos productos no existen en searches.'], 422);
        }

        // Totales
        $subtotal = collect($data['items'])
            ->reduce(fn($c, $it) => $c + ($it['qty'] * $it['costo']), 0);
        $impuesto = 0; // Ajusta si usas IGV
        $total    = $subtotal + $impuesto;

        $codigo = $this->genCodigo();

        try {
            DB::beginTransaction();

            $compra = Compra::create([
                'codigo'         => $codigo,
                'user_id'        => Auth::id(),
                'proveedor'      => $data['proveedor'] ?? null,
                'fecha'          => $data['fecha'],
                'subtotal'       => $subtotal,
                'impuesto'       => $impuesto,
                'total'          => $total,
                'factura_numero' => $data['factura_numero'] ?? null,
            ]);

            // Detalles + stock
            foreach ($data['items'] as $it) {
                $rowSubtotal = $it['qty'] * $it['costo'];

                CompraDetalle::create([
                    'idcompra'  => $compra->idcompra,
                    'search_id' => $it['search_id'],
                    'qty'       => $it['qty'],
                    'costo'     => $it['costo'],
                    'subtotal'  => $rowSubtotal,
                ]);

                Search::where('id', $it['search_id'])->increment('stock', $it['qty']);
            }

            // Factura opcional (privado: storage/app/facturas)
            if ($req->hasFile('factura')) {
                $file = $req->file('factura');

                if (!$file->isValid()) {
                    return response()->json(['message' => 'Archivo de factura inválido.'], 422);
                }

                // Validación redundante por extensión (tu validación de mimes ya está arriba)
                $ext = strtolower($file->getClientOriginalExtension());
                if (!in_array($ext, ['pdf','jpg','jpeg','png'])) {
                    return response()->json(['message' => 'Formato no permitido.'], 422);
                }

                $fname = now()->format('Ymd_His') . '_' . \Illuminate\Support\Str::random(8) . '.' . $ext;

                // PRIVADO: se guarda en storage/app/facturas
                $path = $file->storeAs('facturas', $fname, 'local'); // sin tercer parámetro => disco local

                if (!$path) {
                    return response()->json(['message' => 'No se pudo guardar la factura.'], 500);
                }

                $compra->factura_path = $path;  // p.ej. "facturas/20251008_120000_abcd1234.pdf"
                $compra->save();
            }

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return response()->json(['message' => 'No se pudo crear la compra.'], 500);
        }

        // Respuesta
        if ($req->wantsJson()) {
            return response()->json(['ok'=>true,'id'=>$compra->idcompra,'codigo'=>$compra->codigo], 201);
        }

        return redirect()->route('admin.compras.index')->with('ok','Compra creada.');
    }

    private function genCodigo(): string
    {
        $rand = strtoupper(Str::random(6));
        $suf  = now()->format('dm');
        return "C-$rand-$suf";
    }

    // Descarga/visualización protegida (archivo privado)
public function downloadFactura(\App\Compra $compra): \Symfony\Component\HttpFoundation\StreamedResponse
{
    abort_unless(auth()->check(), 403);

    // Normaliza por si guardaste "public/..." o "storage/..."
    $raw  = (string)$compra->factura_path;
    $path = ltrim(str_replace(['storage/', 'public/'], '', $raw), '/');

    // 1) Privado: storage/app/...
    if (\Storage::disk('local')->exists($path)) {
        $mime = \Storage::disk('local')->mimeType($path) ?: 'application/octet-stream';
        $name = $this->makeDownloadName($compra, $path, $mime);
        return \Storage::disk('local')->download($path, $name, ['Content-Type' => $mime]);
    }

    // 2) Público: storage/app/public/...
    if (\Storage::disk('public')->exists($path)) {
        $mime = \Storage::disk('public')->mimeType($path) ?: 'application/octet-stream';
        $name = $this->makeDownloadName($compra, $path, $mime);
        return \Storage::disk('public')->download($path, $name, ['Content-Type' => $mime]);
    }

    // 3) Ultra-legacy: /public/factura/NOMBRE
    $legacy = public_path('factura/'.basename($path));
    if (is_file($legacy)) {
        $mime = $this->guessMimeFromExtension(pathinfo($legacy, PATHINFO_EXTENSION)) ?: 'application/octet-stream';
        $name = $this->makeDownloadName($compra, $legacy, $mime);
        return response()->download($legacy, $name, ['Content-Type' => $mime]);
    }

    abort(404, 'Archivo no encontrado');
}

// Genera un nombre de descarga con extensión siempre
private function makeDownloadName(\App\Compra $compra, string $path, string $mime): string
{
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if (!$ext) {
        $ext = $this->guessExtFromMime($mime) ?? 'bin';
    }

    $base = $compra->factura_numero
        ? ('Factura-'.$compra->factura_numero)
        : (pathinfo($path, PATHINFO_FILENAME) ?: 'archivo');

    // evita doble .ext si el base ya la trae
    if (!str_ends_with(strtolower($base), '.'.$ext)) {
        $base .= '.'.$ext;
    }
    return $base;
}

private function guessExtFromMime(string $mime): ?string
{
    $map = [
        'application/pdf' => 'pdf',
        'image/jpeg'      => 'jpg',
        'image/png'       => 'png',
        'image/gif'       => 'gif',
        'image/webp'      => 'webp',
    ];
    return $map[strtolower($mime)] ?? null;
}

private function guessMimeFromExtension(?string $ext): ?string
{
    $map = [
        'pdf'  => 'application/pdf',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png'  => 'image/png',
        'gif'  => 'image/gif',
        'webp' => 'image/webp',
    ];
    return $map[strtolower((string)$ext)] ?? null;
}
public function verFactura(\App\Compra $compra)
{
    abort_unless(auth()->check(), 403);

    $raw  = (string)$compra->factura_path;
    $path = ltrim(str_replace(['storage/', 'public/'], '', $raw), '/');

    foreach (['local','public'] as $disk) {
        if (\Storage::disk($disk)->exists($path)) {
            $mime = \Storage::disk($disk)->mimeType($path) ?: 'application/octet-stream';
            $name = $this->makeDownloadName($compra, $path, $mime);
            $stream = \Storage::disk($disk)->readStream($path);
            return response()->stream(function() use ($stream) {
                fpassthru($stream);
            }, 200, [
                'Content-Type'        => $mime,
                'Content-Disposition' => 'inline; filename="'.$name.'"',
            ]);
        }
    }

    $legacy = public_path('factura/'.basename($path));
    if (is_file($legacy)) {
        $mime = $this->guessMimeFromExtension(pathinfo($legacy, PATHINFO_EXTENSION)) ?: 'application/octet-stream';
        return response()->file($legacy, [
            'Content-Type'        => $mime,
            'Content-Disposition' => 'inline; filename="'.basename($legacy).'"',
        ]);
    }

    abort(404);
}

}
