<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.dashboard');
    }

    // ---------------- helpers ----------------
    private function range(string $key): array
    {
        $tz = config('app.timezone', 'America/Lima');
        $end = Carbon::now($tz)->endOfDay();
        switch ($key) {
            case 'day':
                $start = (clone $end)->startOfDay();
                break;
            case 'week':
                $start = (clone $end)->subDays(6)->startOfDay();
                break;
            case 'month':
                $start = (clone $end)->startOfMonth();
                break;
            case 'ytd':
                $start = (clone $end)->startOfYear();
                break;
            case '7d':
                $start = (clone $end)->subDays(6)->startOfDay();
                break;
            case '30d':
                $start = (clone $end)->subDays(29)->startOfDay();
                break;
            case 'qtr':
                $start = (clone $end)->subDays(90 - 1)->startOfDay();
                break;
            default:
                $start = (clone $end)->subDays(6)->startOfDay();
        }
        return [$start, $end];
    }

    private function couponSql(): string
    {
        // Intenta varias claves donde podrías guardar el cupón en venta.detalle (JSON/TEXT)
        // MySQL 5.7+/8: JSON_EXTRACT + JSON_UNQUOTE. Trim de comillas por si acaso.
        return "TRIM(BOTH '\"' FROM COALESCE(
            JSON_UNQUOTE(JSON_EXTRACT(venta.detalle,'$.coupon.code')),
            JSON_UNQUOTE(JSON_EXTRACT(venta.detalle,'$.cupon')),
            JSON_UNQUOTE(JSON_EXTRACT(venta.detalle,'$.cupon.codigo'))
        ))";
    }

    // ---------------- API: ventas / kpis ----------------
    public function data(Request $request)
    {
        $rangeKey = $request->query('range', 'day');
        [$start, $end] = $this->range($rangeKey);

        $cacheKey = "dash:data:{$rangeKey}:" . $start->format('Ymd') . ':' . $end->format('YmdHis');
        $payload = Cache::remember($cacheKey, 15, function () use ($start, $end, $rangeKey) {

            // Serie por fecha: ingresos y COGS
            // Nota: ingresos = SUM(qty * precio) (sin envío). COGS = SUM(GREATEST(qty,0) * costo)
            $grp = $rangeKey === 'ytd' ? "%Y-%m" : "%Y-%m-%d";

            $series = DB::table('venta')
                ->join('detalle_venta as dv', 'dv.idventa', '=', 'venta.idventa')
                ->leftJoin('searches as s', 's.id', '=', 'dv.idarticulo')
                ->whereBetween('venta.fecha_hora', [$start, $end])
                ->groupBy(DB::raw("DATE_FORMAT(venta.fecha_hora,'$grp')"))
                ->orderBy(DB::raw("DATE_FORMAT(venta.fecha_hora,'$grp')"))
                ->get([
                    DB::raw("DATE_FORMAT(venta.fecha_hora,'$grp') as bucket"),
                    DB::raw("SUM(dv.qty * dv.precio) as revenue"),
                    DB::raw("SUM(GREATEST(dv.qty,0) * COALESCE(s.costo,0)) as cogs"),
                    DB::raw("COUNT(DISTINCT venta.idventa) as orders")
                ]);

            $labels = $series->pluck('bucket')->all();
            $revenue = $series->pluck('revenue')->map(fn($v)=> (float)$v)->all();
            $cogs = $series->pluck('cogs')->map(fn($v)=> (float)$v)->all();
            $orders = $series->pluck('orders')->map(fn($v)=> (int)$v)->all();

            $revenueTotal = array_sum($revenue);
            $cogsTotal = array_sum($cogs);
            $ordersTotal = array_sum($orders);
            $margin = $revenueTotal - $cogsTotal;
            $marginPct = $revenueTotal > 0 ? $margin / $revenueTotal * 100 : 0;

            // Valor inventario líquido aprox: SUM(precio * stock)
            $inventory = DB::table('searches')
                ->where(function ($q) {
                    $q->whereNull('codigo')
                    ->orWhereRaw("UPPER(TRIM(codigo)) NOT LIKE 'KIT%%'");
                })
                ->where(function ($q) {
                    $q->whereNull('categoria')
                    ->orWhereRaw("LOWER(TRIM(categoria)) <> 'kit de emergencia'");
                })
                ->selectRaw('SUM(COALESCE(precio,0) * COALESCE(stock,0)) AS liquid')
                ->value('liquid') ?? 0;

            // Últimas 10 ventas
            $couponSql = $this->couponSql();
            $last10 = DB::table('venta')
                ->leftJoin('personas as p', 'p.id', '=', 'venta.iduser')
                ->leftJoin('detalle_venta as dv', 'dv.idventa', '=', 'venta.idventa')
                ->whereBetween('venta.fecha_hora', [$start->copy()->subDays(30), $end]) // ventana razonable
                ->groupBy('venta.idventa', 'venta.fecha_hora', 'venta.tipo', 'venta.cargo_envio', 'p.name', 'p.lastname', 'venta.detalle')
                ->orderBy('venta.fecha_hora', 'desc')
                ->limit(10)
                ->get([
                    'venta.idventa',
                    'venta.fecha_hora',
                    DB::raw("CONCAT(COALESCE(p.name,''),' ',COALESCE(p.lastname,'')) as cliente"),
                    'venta.tipo as metodo',
                    DB::raw("$couponSql as cupon"),
                    DB::raw('SUM(dv.qty) as items'),
                    DB::raw('SUM(dv.qty * dv.precio) as total')
                ]);

            // Top clientes en el rango por órdenes y por gasto
            $topCustomers = DB::table('venta')
                ->leftJoin('detalle_venta as dv', 'dv.idventa', '=', 'venta.idventa')
                ->leftJoin('personas as p', 'p.id', '=', 'venta.iduser')
                ->whereBetween('venta.fecha_hora', [$start, $end])
                ->groupBy('venta.iduser', 'p.name', 'p.lastname')
                ->orderByRaw('SUM(dv.qty*dv.precio) DESC')
                ->limit(12)
                ->get([
                    'venta.iduser',
                    DB::raw("TRIM(CONCAT(COALESCE(p.name,''),' ',COALESCE(p.lastname,''))) as nombre"),
                    DB::raw('COUNT(DISTINCT venta.idventa) as orders'),
                    DB::raw('SUM(dv.qty*dv.precio) as spend')
                ]);

            // Top cupones últimos 90 días
            $start90 = (clone $end)->subDays(89)->startOfDay();
            $topCoupons90 = DB::table('venta')
                ->whereBetween('venta.fecha_hora', [$start90, $end])
                ->selectRaw("$couponSql as codigo, COUNT(*) as usos")
                ->whereRaw("$couponSql IS NOT NULL AND $couponSql <> ''")
                ->groupBy('codigo')
                ->orderBy('usos','desc')
                ->limit(10)
                ->get();

            // Flow YTD mensual
            $ytdStart = (clone $end)->startOfYear();
            $flow = DB::table('venta')
                ->join('detalle_venta as dv', 'dv.idventa', '=', 'venta.idventa')
                ->leftJoin('searches as s', 's.id', '=', 'dv.idarticulo')
                ->whereBetween('venta.fecha_hora', [$ytdStart, $end])
                ->groupBy(DB::raw("DATE_FORMAT(venta.fecha_hora,'%Y-%m')"))
                ->orderBy(DB::raw("DATE_FORMAT(venta.fecha_hora,'%Y-%m')"))
                ->get([
                    DB::raw("DATE_FORMAT(venta.fecha_hora,'%Y-%m') as ym"),
                    DB::raw("SUM(dv.qty*dv.precio) as revenue"),
                    DB::raw("SUM(GREATEST(dv.qty,0)*COALESCE(s.costo,0)) as cogs")
                ]);

            // Tabla “Ventas por rango”
            $table = [];
            foreach ($labels as $i => $b) {
                $aov = ($orders[$i] ?? 0) > 0 ? round(($revenue[$i] ?? 0) / $orders[$i]) : 0;
                $table[] = [
                    'period'  => $b,
                    'orders'  => (int)($orders[$i] ?? 0),
                    'revenue' => (float)($revenue[$i] ?? 0),
                    'aov'     => (float)$aov,
                ];
            }

            return [
                'range' => [
                    'key'   => $rangeKey,
                    'start' => $start->toIso8601String(),
                    'end'   => $end->toIso8601String(),
                ],
                'kpis' => [
                    'revenue'     => (float)$revenueTotal,
                    'orders'      => (int)$ordersTotal,
                    'margin'      => (float)$margin,
                    'margin_pct'  => (float)$marginPct,
                    'inventory'   => (float)$inventory,
                    'campaign_spend' => 0.0, // sin tabla de campañas; si la creas, aquí la sumas
                ],
                'sales' => [
                    'labels'  => $labels,
                    'revenue' => $revenue,
                    'cogs'    => $cogs,
                    'orders'  => $orders,
                    'table'   => $table,
                ],
                'last10' => $last10,
                'top_customers' => $topCustomers,
                'top_coupons_90' => $topCoupons90,
                'flow_ytd' => [
                    'labels'  => $flow->pluck('ym')->all(),
                    'revenue' => $flow->pluck('revenue')->map(fn($v)=>(float)$v)->all(),
                    'cogs'    => $flow->pluck('cogs')->map(fn($v)=>(float)$v)->all(),
                ],
            ];
        });

        return response()->json($payload);
    }

    // ---------------- API: inventario por rango ----------------
    public function inventory(Request $request)
    {
        $rangeKey = $request->query('range', '7d');
        [$start, $end] = $this->range($rangeKey);
        $grp = $rangeKey === 'ytd' ? "%Y-%m" : ($rangeKey === 'qtr' ? "%x-W%v" : "%Y-%m-%d");

        $cacheKey = "dash:inv:{$rangeKey}:" . $start->format('Ymd') . ':' . $end->format('YmdHis');
        $payload = Cache::remember($cacheKey, 15, function () use ($start, $end, $grp) {
            $serie = DB::table('venta')
                ->leftJoin('detalle_venta as dv', 'dv.idventa', '=', 'venta.idventa')
                ->leftJoin('searches as s', 's.id', '=', 'dv.idarticulo')
                ->whereBetween('venta.fecha_hora', [$start, $end])
                ->groupBy(DB::raw("DATE_FORMAT(venta.fecha_hora,'$grp')"))
                ->orderBy(DB::raw("DATE_FORMAT(venta.fecha_hora,'$grp')"))
                ->get([
                    DB::raw("DATE_FORMAT(venta.fecha_hora,'$grp') as bucket"),
                    DB::raw('SUM(GREATEST(dv.qty,0)) as units'),
                    DB::raw('SUM(GREATEST(dv.qty,0)*COALESCE(s.costo,0)) as cogs')
                ]);

            $labels = $serie->pluck('bucket')->all();

            // Low stock top 10
            $low = DB::table('searches')
                ->orderBy('stock','asc')
                ->limit(10)
                ->get(['id','codigo as sku','name','stock']);

            // Top productos por unidad y por COGS en el rango
            $top = DB::table('venta')
                ->leftJoin('detalle_venta as dv', 'dv.idventa', '=', 'venta.idventa')
                ->leftJoin('searches as s', 's.id', '=', 'dv.idarticulo')
                ->whereBetween('venta.fecha_hora', [$start, $end])
                ->groupBy('dv.idarticulo','s.name')
                ->get([
                    'dv.idarticulo',
                    DB::raw('COALESCE(s.name,"Producto") as name'),
                    DB::raw('SUM(GREATEST(dv.qty,0)) as units'),
                    DB::raw('SUM(GREATEST(dv.qty,0)*COALESCE(s.costo,0)) as cogs')
                ]);

            $topUnits = $top->sortByDesc('units')->values()->take(7)->all();
            $topCogs  = $top->sortByDesc('cogs')->values()->take(7)->all();

            return [
                'range' => ['start'=>$start->toIso8601String(), 'end'=>$end->toIso8601String()],
                'serie' => [
                    'labels' => $labels,
                    'units'  => $serie->pluck('units')->map(fn($v)=>(int)$v)->all(),
                    'cogs'   => $serie->pluck('cogs')->map(fn($v)=>(float)$v)->all(),
                ],
                'table' => $serie->map(function ($r) {
                    $cpu = $r->units > 0 ? round($r->cogs / $r->units) : 0;
                    return [
                        'period' => $r->bucket,
                        'units'  => (int)$r->units,
                        'cogs'   => (float)$r->cogs,
                        'cpu'    => (float)$cpu,
                    ];
                })->all(),
                'low_stock' => $low,
                'top' => [
                    'units' => $topUnits,
                    'cogs'  => $topCogs,
                ],
            ];
        });

        return response()->json($payload);
    }

    // ---------------- API: ratios (logística + rotación) ----------------
    public function ratios(Request $request)
    {
        $cacheKey = "dash:ratios:" . Carbon::now('America/Lima')->format('YmdHi');
        $payload = Cache::remember($cacheKey, 15, function () {
            // últimas 8 semanas: promedio envío y % gratis
            $end = Carbon::now('America/Lima')->endOfWeek(Carbon::MONDAY);
            $start = (clone $end)->subWeeks(7)->startOfWeek(Carbon::MONDAY);

            $weeks = DB::table('venta')
                ->whereBetween('venta.fecha_hora', [$start, $end])
                ->selectRaw("YEARWEEK(venta.fecha_hora, 3) as yw")
                ->selectRaw("DATE_FORMAT(DATE_SUB(venta.fecha_hora, INTERVAL (WEEKDAY(venta.fecha_hora)) DAY),'%d-%b') as week_start_label")
                ->selectRaw('COUNT(*) as ord')
                ->selectRaw('SUM(COALESCE(venta.cargo_envio,0)) as ship_sum')
                ->selectRaw('SUM(CASE WHEN COALESCE(venta.cargo_envio,0) = 0 THEN 1 ELSE 0 END) as free_count')
                ->groupBy('yw','week_start_label')
                ->orderBy('yw')
                ->get();

            $labels  = $weeks->pluck('week_start_label')->all();
            $avgShip = $weeks->map(fn($w)=> $w->ord ? round($w->ship_sum / $w->ord) : 0)->all();
            $freePct = $weeks->map(fn($w)=> $w->ord ? round($w->free_count*100/$w->ord,1) : 0.0)->all();

            // Rotación 30 días por SKU
            $end30 = Carbon::now('America/Lima')->endOfDay();
            $start30 = (clone $end30)->subDays(29)->startOfDay();

            $sold30 = DB::table('venta')
                ->join('detalle_venta as dv','dv.idventa','=','venta.idventa')
                ->leftJoin('searches as s','s.id','=','dv.idarticulo')
                ->whereBetween('venta.fecha_hora', [$start30,$end30])
                ->groupBy('dv.idarticulo','s.codigo','s.stock')
                ->get([
                    'dv.idarticulo',
                    DB::raw('COALESCE(s.codigo,"SKU") as sku'),
                    DB::raw('COALESCE(s.stock,0) as stock'),
                    DB::raw('SUM(GREATEST(dv.qty,0)) as sold')
                ]);

            $rows = $sold30->map(function ($r) {
                $avgDaily = $r->sold / 30;
                $daysLeft = $avgDaily > 0 ? (int)ceil($r->stock / $avgDaily) : null;
                $avgInv   = $r->stock + ($r->sold / 2);
                $turns    = $avgInv > 0 ? round($r->sold / $avgInv, 2) : 0.0;
                return [
                    'sku'     => $r->sku,
                    'stock'   => (int)$r->stock,
                    'sold30'  => (int)$r->sold,
                    'days'    => $daysLeft ?? '∞',
                    'rot'     => $turns,
                ];
            })->sortBy(fn($r)=> $r['days']==='∞' ? 9e9 : $r['days'])->values()->all();

            $stockTotal = (int) DB::table('searches')->sum('stock');
            $soldSum    = (int) array_sum(array_column($rows, 'sold30'));
            $rotGlobal  = $stockTotal > 0 ? round($soldSum / $stockTotal, 1) : 0.0;
            $dohAvg = collect($rows)->filter(fn($r)=>$r['days']!=='∞')->avg(fn($r)=>$r['days']) ?? 0;
            $dohAvg = (int) round($dohAvg);

            return [
                'logistics' => [
                    'labels'  => $labels,
                    'avgShip' => $avgShip,
                    'freePct' => $freePct,
                    'totals'  => [
                        'avgShipLast' => end($avgShip) ?: 0,
                        'freePctLast' => end($freePct) ?: 0,
                        'shipSumLast' => (int) ($weeks->last()->ship_sum ?? 0),
                    ]
                ],
                'inventory' => [
                    'rot_global' => $rotGlobal,
                    'doh_avg'    => $dohAvg,
                    'stock_total'=> $stockTotal,
                    'rows'       => array_slice($rows, 0, 50), // no enviamos 10k filas al front
                ]
            ];
        });

        return response()->json($payload);
    }
}
