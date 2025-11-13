<?php

namespace App\Http\Controllers;

use App\Venta;
use App\DetalleVenta;
use App\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\VentaMailable;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Persona;
use Illuminate\Support\Facades\Hash;
use App\Mail\ClienteCompraExitosa;




class AdminVentaController extends Controller
{
    public function index(Request $request){
    $q    = trim($request->get('q',''));
    $from = $request->get('from');
    $to   = $request->get('to');

    $ventas = Venta::withCount('detalle')
        ->withCount([
            'shipments as shipments_count',
            'shipments as delivered_count' => function($q){
                $q->where(function($w){
                    $w->where('status','delivered')
                      ->orWhereNotNull('delivered_at');
                });
            },
        ])
        ->when($q, function($qq) use ($q){
            $qq->where(function($w) use ($q){
                $w->where('codigo','like',"%{$q}%")
                  ->orWhere('nombre','like',"%{$q}%")
                  ->orWhere('email','like',"%{$q}%")
                  ->orWhere('dni','like',"%{$q}%");
            });
        })
        ->when($from, fn($qq)=>$qq->whereDate('fecha_hora','>=',$from))
        ->when($to,   fn($qq)=>$qq->whereDate('fecha_hora','<=',$to))
        ->orderByDesc('idventa')
        ->paginate(15)
        ->appends($request->query());

    // Artículos para el builder del modal
    $articulos = Search::select('id','name','precio as price')
        ->orderBy('name')->limit(500)->get();

    return view('admin.ventas.index', compact('ventas','q','from','to','articulos'));
    }


    public function create()
    {
        // Alias 'precio' como 'price' para no tocar tu JS
        $articulos = Search::select('id','name','precio as price')
            ->orderBy('name')->limit(300)->get();

        return view('admin.ventas.create', compact('articulos'));
    }

    public function store(Request $request){
    Log::info('ADMIN VENTA | Payload recibido', ['post' => $request->all()]);

    $raw = $request->input('items');
    if (is_string($raw)) {
        $decoded = json_decode($raw, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('ADMIN VENTA | items JSON inválido', ['items' => $raw, 'json_error' => json_last_error_msg()]);
            return back()->withErrors(['items' => 'Formato de items inválido'])->withInput();
        }
        $request->merge(['items' => $decoded]);
    }

    try {
        $payload = $request->validate([
            'fulfillment_method' => 'required|in:delivery,pickup',
            'cargo_envio'        => 'nullable|numeric|min:0',

            // Identificación del cliente
            'persona_id'   => 'nullable|integer|exists:personas,id',
            'email'        => 'nullable|email|max:160',

            // Reglas condicionales:
            // pickup: al menos email
            'email'        => 'required_if:fulfillment_method,pickup|nullable|email|max:160',

            // delivery: pide datos de envío
            'nombre'       => 'required_if:fulfillment_method,delivery|nullable|string|max:120',
            'apellido'     => 'nullable|string|max:120',
            'domicilio'    => 'required_if:fulfillment_method,delivery|nullable|string|max:200',
            'celular'      => 'required_if:fulfillment_method,delivery|nullable|string|max:50',
            'distrito'     => 'required_if:fulfillment_method,delivery|nullable|string|max:80',
            'provincia'    => 'required_if:fulfillment_method,delivery|nullable|string|max:80',
            'departamento' => 'required_if:fulfillment_method,delivery|nullable|string|max:80',
            'dni'          => 'required_if:fulfillment_method,delivery|nullable|string|max:20',
            'referencia'   => 'nullable|string|max:200',

            'tipo'         => 'nullable|string|max:30',

            'items'                     => 'required|array|min:1',
            'items.*.idarticulo'       => 'required|integer|exists:searches,id',
            'items.*.qty'              => 'required|integer|min:1',
            'items.*.precio'           => 'required|numeric|min:0',
        ]);
    } catch (ValidationException $ex) {
        Log::error('ADMIN VENTA | Validación fallida', ['errors' => $ex->errors()]);
        return back()->withErrors($ex->errors())->withInput();
    }

    try {
        $venta = DB::transaction(function() use ($payload) {
            $now    = Carbon::now();
            $codigo = 'V-'.Str::upper(Str::random(6)).'-'.$now->format('ymd');

            // 1) Resolver cliente
            $personaId = $payload['persona_id'] ?? null;
            $persona   = null;

            if ($personaId) {
                $persona = Persona::find($personaId);
            } elseif (!empty($payload['email'])) {
                $persona = Persona::where('email', $payload['email'])->first();
            }

            // Si no existe y tenemos al menos email, lo creamos con lo que haya
            if (!$persona && !empty($payload['email'])) {
                $persona = Persona::create([
                    'name'       => $payload['nombre']      ?? '',
                    'lastname'   => $payload['apellido']    ?? '',
                    'email'      => $payload['email'],
                    'cell'       => $payload['celular']     ?? null,
                    'direccion'  => $payload['domicilio']   ?? null,
                    'distrito'   => $payload['distrito']    ?? null,
                    'provincia'  => $payload['provincia']   ?? null,
                    'dni'        => $payload['dni']         ?? null,
                    'password'   => Hash::make(Str::random(16)),
                    'type'       => 0,
                ]);
            } elseif ($persona) {
                // Existe: actualiza campos si llegan (excepto email)
                $patch = [
                    'name'      => $payload['nombre']     ?? null,
                    'lastname'  => $payload['apellido']   ?? null,
                    'cell'      => $payload['celular']    ?? null,
                    'direccion' => $payload['domicilio']  ?? null,
                    'distrito'  => $payload['distrito']   ?? null,
                    'provincia' => $payload['provincia']  ?? null,
                    'dni'       => $payload['dni']        ?? null,
                    // si tienes 'departamento' en personas, agrégalo aquí
                ];
                $dirty = false;
                foreach ($patch as $k => $v) {
                    if ($v !== null && $v !== '' && $persona->{$k} !== $v) {
                        $persona->{$k} = $v;
                        $dirty = true;
                    }
                }
                if ($dirty) $persona->save();
            }

            // 2) Cabecera
            $venta = new Venta();
            $venta->iduser             = $persona->id ?? null;   // <— cliente real, no el admin
            $venta->codigo             = $codigo;
            $venta->tipo               = $payload['tipo'] ?? 'manual';
            $venta->fulfillment_method = $payload['fulfillment_method'];
            $venta->cargo_envio        = $payload['fulfillment_method'] === 'pickup' ? 0 : ($payload['cargo_envio'] ?? 0);
            $venta->fecha_hora         = $now;

            foreach (['nombre','apellido','email','domicilio','celular','distrito','provincia','departamento','dni','referencia'] as $f) {
                if (array_key_exists($f, $payload)) {
                    $venta->{$f} = $payload[$f];
                }
            }

            $venta->subtotal = 0;
            $venta->total_venta = 0;
            $venta->save();
            Log::info('ADMIN VENTA | Cabecera creada', ['idventa' => $venta->idventa, 'codigo' => $venta->codigo]);

            // 3) Detalle
            $subtotal = 0;
            foreach ($payload['items'] as $i => $it) {
                $linea = new DetalleVenta();
                $linea->idventa    = $venta->idventa;
                $linea->idsub      = $i + 1;
                $linea->idarticulo = $it['idarticulo'];
                $linea->qty        = $it['qty'];
                $linea->precio     = $it['precio'];
                $linea->subtotal   = $it['qty'] * $it['precio'];
                $linea->save();
                $subtotal += $linea->subtotal;
            }

            $venta->subtotal    = $subtotal;
            $venta->total_venta = $subtotal + ($venta->cargo_envio ?? 0);
            $venta->save();

            Log::info('ADMIN VENTA | Totales recalculados', [
                'idventa' => $venta->idventa,
                'subtotal' => $venta->subtotal,
                'cargo_envio' => $venta->cargo_envio,
                'total' => $venta->total_venta,
            ]);

            return $venta;
        });

        Log::info('ADMIN VENTA | TX OK', ['idventa' => $venta->idventa, 'codigo' => $venta->codigo]);
        return redirect()->route('admin.ventas.index')->with('ok', "Venta {$venta->codigo} creada.");
    } catch (\Throwable $e) {
        Log::error('ADMIN VENTA | Error guardando venta', [
            'exception' => get_class($e),
            'msg' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
            'trace_top' => collect(explode("\n", $e->getTraceAsString()))->take(5)->implode("\n"),
        ]);
        return back()->withErrors(['fatal' => 'No se pudo crear la venta. Revisa el log.'])->withInput();
    }
    }


    public function show(Venta $venta)    {
        $venta->load(['detalle' => function($q){
            $q->with('articulo')->orderBy('idsub')->orderBy('iddetalle');
        }]);

        // estados para pintar en la lista
        $shipmentsCount = $venta->shipments()->count();
        $deliveredFlag = ($venta->fulfillment_status === 'delivered')
            || !empty($venta->delivered_at)
            || $venta->shipments()->where(function($w){
                $w->where('status','delivered')
                    ->orWhereNotNull('delivered_at');
            })->exists();

        return response()->json([
            'venta'            => $venta->toArray(),
            'shipments_count'  => $shipmentsCount,
            'delivered'        => $deliveredFlag,
        ]);
    }


    public function destroy(Venta $venta)
    {
        DB::transaction(function() use ($venta){
            DetalleVenta::where('idventa',$venta->idventa)->delete();
            $venta->delete();
        });
        return redirect()->route('admin.ventas.index')->with('ok','Venta eliminada.');
    }


public function sendEmail(Request $request, Venta $venta)
{
    // 1. validar destino
    $data = $request->validate([
        'to' => 'required|email',
    ]);

    // 2. reconstruir detalle EXACTAMENTE como en MercadoPagoController::buildReceipt()
    $detalles = $venta->detalle()
        ->orderBy('idsub')
        ->get(['idsub','idarticulo','qty','precio','subtotal']);

    $grupos = [];
    foreach ($detalles as $d) {
        $articulo = Search::where('id', $d->idarticulo)
            ->select('name','image')
            ->first();

        $grupos[$d->idsub][] = [
            'idarticulo' => (int) $d->idarticulo,
            'name'       => $articulo->name  ?? ('Artículo #'.$d->idarticulo),
            'image'      => $articulo->image ?? null,
            'qty'        => (int) $d->qty,
            'precio'     => (float) $d->precio,
            'subtotal'   => (float) $d->subtotal,
        ];
    }

    $receipt = [
        'venta' => [
            'idventa'     => (int) $venta->idventa,
            'codigo'      => $venta->codigo,
            'subtotal'    => (float) $venta->subtotal,
            'cargo_envio' => (float) $venta->cargo_envio,
            'total'       => (float) $venta->total_venta,
            'fecha'       => $venta->fecha_hora?->toDateTimeString(),
            'detalle'     => $venta->detalle, // la columna json si la tuvieras
        ],
        'cliente' => [
            'nombre'   => $venta->nombre,
            'apellido' => $venta->apellido,
            'email'    => $data['to'],           // lo que puso el admin
            'dni'      => $venta->dni,
            'celular'  => $venta->celular,
            'envio'    => [
                'domicilio'    => $venta->domicilio,
                'distrito'     => $venta->distrito,
                'provincia'    => $venta->provincia,
                'departamento' => $venta->departamento,
                'referencia'   => $venta->referencia,
            ],
            'tipo' => (int) $venta->tipo,
        ],
        'grupos' => $grupos,
    ];

    // 3. en admin casi nunca tienes la cookie delivery, así que va vacío
    $delivery = [];

    // 4. ahora sí, el mailable como lo hiciste en MP/Yape
    Mail::to($data['to'])->send(
        new ClienteCompraExitosa($venta, $receipt, $delivery)
    );

    return response()->json(['ok' => true]);
}

    public function updateMeta(Request $req, Venta $venta)  {
    $data = $req->validate([
        'payment_status'      => ['nullable', Rule::in(['paid','unpaid','refunded'])],
        'fulfillment_method'  => ['nullable', Rule::in(['delivery','pickup'])],
        // cuando quieras además hacer la transición logística desde el modal
        'transition'          => ['nullable', Rule::in(['ready_to_ship','ready_for_pickup','cancelled'])],
    ]);

    // Actualiza pago
    if (array_key_exists('payment_status', $data) && $data['payment_status'] !== null) {
        if ($data['payment_status'] === 'paid' && $venta->payment_status !== 'paid') {
            $venta->payment_status = 'paid';
            if (!$venta->paid_at) $venta->paid_at = now();
        } else {
            $venta->payment_status = $data['payment_status'];
        }
    }

    // Actualiza método de cumplimiento
    if (array_key_exists('fulfillment_method', $data) && $data['fulfillment_method'] !== null) {
        $venta->fulfillment_method = $data['fulfillment_method'];
    }

    $venta->save();

    // Transición logística opcional
    if (!empty($data['transition'])) {
        try {
            $venta->transitionFulfillment($data['transition']);
        } catch (\DomainException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    // Si quedó pagada + delivery y aún no hay shipment, garantizamos la creación
    if (($venta->fulfillment_method ?? 'delivery') === 'delivery'
        && $venta->payment_status === 'paid'
        && !$venta->shipments()->exists()) {
        // requiere que tengas el método ensureShipment() en Venta, como te dejé antes
        $venta->ensureShipment();
    }

    $venta->loadCount('detalle');

    return response()->json([
        'ok' => true,
        'venta' => $venta->toArray(),
        'shipments_count' => $venta->shipments()->count(),
    ]);
    }
    public function lookupPersona(Request $req){
    $email = trim((string)$req->get('email',''));
    if (!$email) return response()->json(null);

    $p = Persona::where('email',$email)->first();
    if (!$p) return response()->json(null);

    return response()->json([
        'id'         => $p->id,
        'name'       => $p->name,
        'lastname'   => $p->lastname,
        'email'      => $p->email,
        'cell'       => $p->cell,
        'direccion'  => $p->direccion,
        'distrito'   => $p->distrito,
        'provincia'  => $p->provincia,
        'ciudad'     => $p->ciudad,
        'departamento'=> $p->provincia ?? null, // si usas 'provincia' como depto, adáptalo
    ]);
    }
    public function searchPersonas(Request $req)
    {
        $q = trim((string)$req->get('q',''));
        if (mb_strlen($q) < 2) return response()->json([]);

        $rows = Persona::query()
            ->where(function($w) use ($q){
                $w->where('email','like',"%{$q}%")
                ->orWhere('dni','like',"%{$q}%");
            })
            ->orderBy('id','desc')
            ->limit(10)
            ->get(['id','name','lastname','email','dni','cell','direccion','distrito','provincia']);

        return response()->json($rows);
    }

}
