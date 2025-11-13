<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IndexImage;
use App\Campaign;
use App\Search;

class IndexImageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin']);
    }

    public function index()
    {
        $images    = IndexImage::with('campaign')->orderBy('id', 'desc')->get();
        $campaigns = Campaign::orderBy('name')->get();

        return view('admin.index_images.index', compact('images', 'campaigns'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image'             => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'relacion_ids'      => 'nullable|string',
            'campaign_id'       => 'nullable|exists:campaigns,id',
            'activate_campaign' => 'nullable|boolean',
        ]);

        // 1. Subir imagen a public/image/index/
        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('image/index'), $filename);

        // 2. Parsear IDs de Search (máx 3)
        $ids = collect(explode(',', $data['relacion_ids'] ?? ''))
            ->map(fn ($v) => trim($v))
            ->filter()
            ->map(fn ($v) => (int) $v)
            ->filter(fn ($v) => $v > 0)
            ->unique()
            ->take(3)
            ->values()
            ->all();

        if (count($ids) > 0) {
            $existingCount = Search::whereIn('id', $ids)->count();
            if ($existingCount !== count($ids)) {
                // En serio, mete IDs que existan...
                return back()
                    ->withErrors(['relacion_ids' => 'Alguno de los IDs no existe en la tabla searches.'])
                    ->withInput();
            }
        }

        // 3. Crear registro en index_images
        $indexImage = IndexImage::create([
            'image'       => $filename,
            'relacion'    => $ids,
            'campaign_id' => $data['campaign_id'] ?? null,
        ]);

        // 4. Activar campaña si se marcó
        if (!empty($data['activate_campaign']) && $indexImage->campaign_id) {
            Campaign::where('id', '!=', $indexImage->campaign_id)
                ->update(['is_active' => false]);

            Campaign::where('id', $indexImage->campaign_id)
                ->update(['is_active' => true]);
        }

        return redirect()
            ->route('admin.index_images.index')
            ->with('status', 'Imagen creada correctamente.');
    }

    public function update(Request $request, IndexImage $indexImage)
    {
        // NO se cambia la imagen principal
        $data = $request->validate([
            'relacion_ids'      => 'nullable|string',
            'campaign_id'       => 'nullable|exists:campaigns,id',
            'activate_campaign' => 'nullable|boolean',
        ]);

        $ids = collect(explode(',', $data['relacion_ids'] ?? ''))
            ->map(fn ($v) => trim($v))
            ->filter()
            ->map(fn ($v) => (int) $v)
            ->filter(fn ($v) => $v > 0)
            ->unique()
            ->take(3)
            ->values()
            ->all();

        if (count($ids) > 0) {
            $existingCount = Search::whereIn('id', $ids)->count();
            if ($existingCount !== count($ids)) {
                return back()
                    ->withErrors(['relacion_ids' => 'Alguno de los IDs no existe en la tabla searches.'])
                    ->withInput();
            }
        }

        $indexImage->relacion    = $ids;
        $indexImage->campaign_id = $data['campaign_id'] ?? null;
        $indexImage->save();

        if (!empty($data['activate_campaign']) && $indexImage->campaign_id) {
            Campaign::where('id', '!=', $indexImage->campaign_id)
                ->update(['is_active' => false]);

            Campaign::where('id', $indexImage->campaign_id)
                ->update(['is_active' => true]);
        }

        return redirect()
            ->route('admin.index_images.index')
            ->with('status', 'Imagen actualizada correctamente.');
    }

    public function destroy(IndexImage $indexImage)
    {
        $path = public_path('image/index/' . $indexImage->image);

        if (file_exists($path)) {
            @unlink($path);
        }

        $indexImage->delete();

        return redirect()
            ->route('admin.index_images.index')
            ->with('status', 'Imagen eliminada correctamente.');
    }
    public function searchProducts(Request $request)
{
    $term = $request->get('q', '');

    if (mb_strlen($term) < 2) {
        return response()->json([]);
    }

    $query = Search::query();

    $query->where(function ($q) use ($term) {
        $q->where('name', 'LIKE', '%' . $term . '%')
          ->orWhere('codigo', 'LIKE', '%' . $term . '%');
    });

    $results = $query
        ->orderBy('name')
        ->limit(10)
        ->get(['id', 'name', 'precio', 'image']);

    $mapped = $results->map(function ($p) {
        return [
            'id'        => $p->id,
            'name'      => $p->name,
            'precio'    => (float) $p->precio,
            'image_url' => asset('image/productos/' . $p->image),
        ];
    });

    return response()->json($mapped);
}

}
