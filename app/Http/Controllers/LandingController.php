<?php



namespace App\Http\Controllers;

use App\IndexImage;
use App\Campaign;
use App\Search;

class LandingController extends Controller
{
    public function index()
    {
        // 👉 nuevo: nombre de la campaña activa (o null si no hay)
        $activeCampaignName = Campaign::where('is_active', true)->value('name');

        $activeCampaignIds = Campaign::where('is_active', true)->pluck('id');

        $query = IndexImage::query()->with('campaign');

        if ($activeCampaignIds->count()) {
            $query->whereIn('campaign_id', $activeCampaignIds);
        }
        
        $indexImages = $query->orderBy('id')->get();

        if ($indexImages->isEmpty()) {
            return view('layouts.buone', [
                'mainImages'            => collect(),
                'relatedProductsByLook' => collect(),
                // 👉 pasamos el nombre también aquí
                'activeCampaignName'    => $activeCampaignName,
            ]);
        }

        $allRelatedIds = $indexImages
            ->flatMap(fn ($img) => $img->relacion ?? [])
            ->unique()
            ->values()
            ->all();

        $searchesById = Search::whereIn('id', $allRelatedIds)
            ->get()
            ->keyBy('id');

        $mainImages = $indexImages->map(function ($img) {
            return [
                'id'            => $img->id,
                'image_url'     => asset('image/index/' . $img->image),
                'campaign_name' => optional($img->campaign)->name,
            ];
        });

        $relatedProductsByLook = $indexImages->map(function ($img) use ($searchesById) {
            $ids = $img->relacion ?? [];

            return collect($ids)->map(function ($id) use ($searchesById) {
                $p = $searchesById->get($id);
                if (!$p) return null;

                return [
                    'id'    => $p->id,
                    'title' => $p->name,
                    'price' => number_format($p->precio, 2),
                    'img'   => asset('image/productos/' . $p->image),
                ];
            })->filter()->values()->all();
        });

        return view('layouts.buone', [
            'mainImages'            => $mainImages,
            'relatedProductsByLook' => $relatedProductsByLook,
            // 👉 y aquí también
            'activeCampaignName'    => $activeCampaignName,
        ]);
    }
}
