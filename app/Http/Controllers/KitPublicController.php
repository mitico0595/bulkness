<?php
// app/Http/Controllers/KitPublicController.php
namespace App\Http\Controllers;

use App\Kit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KitPublicController extends Controller
{
    public function index(Request $request)
    {
        $kits = Kit::with(['principal','items.product'])->orderByDesc('id')->get();
        
        $artworks = $kits->map(function($k){
            $p = $k->principal;
            $ids = $k->search_id;
            
            // Año desde fecha (si viene tipo YYYY-MM-DD)
            $year = '';
            if (!empty($p->fecha) && preg_match('/^\d{4}/', (string)$p->fecha, $m)) {
                $year = $m[0];
            }

            // Miniaturas = productos asignados
            $related = $k->items->map(function($it){
                return [
                    'id'  => $it->search_id,          // <- lo que quieres para /busco/{id}
                    'src' => $this->img($it->product) // url de imagen
                ];
            })->values()->all();

            // Quote desde descripción, o un guion fino si no hay
            $quote = $p->description ? Str::limit(strip_tags($p->description), 120) : '—';

            return [
                'id'            => $k->id,
                'title'         => $k->name ?: ($p->name ?? 'Kit'),
                'price'         => $k->price,
                'searchid'      => $ids,
                // el “artist” en tu UI lo muestro como el nombre del principal
                'artist'        => $p->name ?? 'Kit',
                'year'          => $year ?: '',
                // “location” lo uso para la categoría
                'location'      => $p->categoria ?: '—',
                'quote'         => $quote,
                'image'         => $this->img($p),      // foto principal (del principal)
                'relatedImages' => $related,            // componentes abajo
            ];
        })->values()->all();
        
        return view('kits', [
            'artworks' => $artworks,
        ]);
    }

    private function img($prod): string
    {
        if(!$prod) return asset('image/productos/default.png');
        $img = $prod->image ?: $prod->thumb ?: $prod->image1 ?: $prod->image2 ?: $prod->image3 ?: null;
        if (!$img) return asset('image/productos/default.png');
        if (str_starts_with($img,'http://') || str_starts_with($img,'https://') || str_starts_with($img,'/')) return $img;
        return asset('image/productos/'.$img);
    }
}
