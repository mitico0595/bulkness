<?php
// app/Http/Controllers/Admin/KitController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kit;
use App\KitItem;
use App\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KitController extends Controller
{
    public function index(Request $req)
    {
        $q = trim((string)$req->get('q', ''));
        $kits = Kit::with(['principal','products'])
            ->when($q, function($qq) use ($q) {
                $qq->whereHas('principal', function($qp) use ($q) {
                    $qp->where('name','like',"%$q%")
                       ->orWhere('codigo','like',"%$q%")
                       ->orWhere('categoria','like',"%$q%");
                });
            })
            ->orderByDesc('id')
            ->paginate(20)
            ->appends(['q' => $q]);

        return view('admin.kits.index', [
            'kits' => $kits,
            'q' => $q,
        ]);
    }

    public function show(Kit $kit)
    {
        $kit->load(['principal','items.product']);
        return response()->json($this->serializeKit($kit));
    }

    public function store(Request $req)
    {
        $data = $this->validateKit($req);

        return DB::transaction(function() use ($data) {
            $kit = Kit::create([
                'search_id' => $data['search_id'],
                'name'      => $data['name'] ?? null,
                'price'     => $data['price'] ?? null,
                'meta'      => $data['meta'] ?? null,
            ]);
            $this->syncItems($kit, $data['items'] ?? []);
            $kit->load(['principal','products']);
            return response()->json(['item' => $this->serializeKit($kit)], 201);
        });
    }

    public function update(Request $req, Kit $kit)
    {
        $data = $this->validateKit($req, $kit->id);

        return DB::transaction(function() use ($kit, $data) {
            $kit->update([
                'search_id' => $data['search_id'],
                'name'      => $data['name'] ?? null,
                'price'     => $data['price'] ?? null,
                'meta'      => $data['meta'] ?? null,
            ]);
            $this->syncItems($kit, $data['items'] ?? []);
            $kit->load(['principal','products']);
            return response()->json(['item' => $this->serializeKit($kit)]);
        });
    }

    public function destroy(Kit $kit)
    {
        $kit->delete();
        return response()->json(['ok' => true]);
    }

    public function searches(Request $req)
    {
        $q   = trim((string)$req->get('q',''));
        $ex  = array_filter(array_map('intval', explode(',', (string)$req->get('exclude',''))));
        $per = (int) $req->get('per_page', 10);

        $rows = Search::query()
            ->when($q, function($qq) use ($q) {
                $qq->where('name','like',"%$q%")
                   ->orWhere('codigo','like',"%$q%")
                   ->orWhere('categoria','like',"%$q%");
            })
            ->when(!empty($ex), fn($qq)=>$qq->whereNotIn('id',$ex))
            ->orderByDesc('id')
            ->paginate($per);

        $data = $rows->map(function($p){
            return [
                'id'    => $p->id,
                'name'  => $p->name,
                'codigo'=> $p->codigo,
                'categoria'=>$p->categoria,
                'precio'=> (float) ($p->precio ?? 0),
                'image' => $this->img($p),
            ];
        });

        return response()->json([
            'data' => $data,
            'next' => $rows->nextPageUrl() ? 1 : 0
        ]);
    }

    /* --------------------- helpers --------------------- */

    private function validateKit(Request $req, $kitId = null): array
    {
        $data = $req->validate([
            'search_id'       => ['required','integer','exists:searches,id'],
            'name'            => ['nullable','string','max:255'],
            'price'           => ['nullable','numeric','min:0'],
            'meta'            => ['nullable','array'],
            'items'           => ['nullable','array'],
            'items.*.search_id' => ['required','integer','exists:searches,id'],
            'items.*.qty'       => ['nullable','integer','min:1'],
        ]);

        // no permitas que el producto principal se meta como componente
        if (!empty($data['items'])) {
            $data['items'] = collect($data['items'])
                ->filter(fn($i) => (int)$i['search_id'] !== (int)$data['search_id'])
                ->groupBy('search_id')
                ->map(function($g){ return ['search_id' => (int)$g[0]['search_id'], 'qty' => (int)($g[0]['qty'] ?? 1)]; })
                ->values()->all();
        }

        return $data;
    }

    private function syncItems(Kit $kit, array $items): void
    {
        // Limpia y sincroniza
        $map = [];
        foreach ($items as $it) {
            $map[$it['search_id']] = ['qty' => max(1, (int)($it['qty'] ?? 1))];
        }
        $kit->products()->sync($map);
    }

    private function serializeKit(Kit $k): array
    {
        $principal = $k->principal;
        $thumbs = $k->products->take(6)->map(fn($p)=>$this->img($p))->values();

        return [
            'id'          => $k->id,
            'search_id'   => $k->search_id,
            'name'        => $k->name ?: ($principal->name ?? 'Kit'),
            'price'       => $k->price,
            'created_at'  => $k->created_at?->toDateTimeString(),
            'updated_at'  => $k->updated_at?->toDateTimeString(),
            'principal'   => [
                'id'    => $principal->id,
                'name'  => $principal->name,
                'precio'=> (float)($principal->precio ?? 0),
                'categoria' => $principal->categoria,
                'image' => $this->img($principal),
            ],
            'items'       => $k->items->map(function($i){
                return [
                    'id'   => $i->id,
                    'qty'  => (int)$i->qty,
                    'search'=> [
                        'id'   => $i->product->id,
                        'name' => $i->product->name,
                        'precio'=>(float)($i->product->precio ?? 0),
                        'image'=> $this->img($i->product),
                    ],
                ];
            })->values(),
            'items_count' => $k->products->count(),
            'thumbs'      => $thumbs,
        ];
    }

    private function img($p): string {
        $img = $p->image ?: $p->thumb ?: $p->image1 ?: $p->image2 ?: $p->image3 ?: null;
        if (!$img) return asset('image/productos/default.png');
        if (str_starts_with($img,'http://') || str_starts_with($img,'https://') || str_starts_with($img,'/')) return $img;
        return asset('image/productos/'.$img);
    }
}
