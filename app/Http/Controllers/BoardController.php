<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Ventamensual;
use App\Search;
use DB;
use Carbon\Carbon;

class BoardController extends Controller
{
     public function __construct()
    {
        $this->middleware('admin');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hoy=Carbon::now()->format('m');
        $year=Carbon::now()->format('Y');
        $productos= DB::table('productos_conteo as c')
        ->select('c.mes','c.conteo')
        ->groupBy('c.mes','c.conteo')
        ->get();
        $ventas=DB::table('conteo_ventas as co')
        ->select('co.mes','co.conteo')
        ->groupBy('co.mes','co.conteo')
        ->get();

        $ganancias= DB::table('ganaas as g')
        ->select('g.fecha','g.ganancia')
        ->selectRaw('MONTH(g.fecha) AS Mes')
        ->groupBy('g.fecha','g.ganancia','Mes')
        ->get();


        $ventam=DB::table('venta_mensual as v')
        ->select('v.mes','v.ventas')
        ->groupBy('v.mes','v.ventas')
        ->get();
        $mercaderia=DB::table('merca as m')
        ->select('m.actual','m.potencial')
        ->groupBy('m.actual','m.potencial')
        ->get();
        $artmonth=DB::table('articulo_mes as mes')
        ->select('mes.id','mes.cantidad','mes.ventas','mes.ganancia','mes.fecha')
        ->where(\DB::raw('substr(mes.fecha, 0, 4)'), '=' , $year)
        ->orWhere(\DB::raw('substr(mes.fecha, -2)'), '=' , $hoy)
        ->orderBy('mes.ganancia','desc')
        ->groupBy('mes.id','mes.cantidad','mes.ventas','mes.ganancia','mes.fecha')        
        ->take(3)
        ->get();
       $articulos=Search::all();
        return view('app',['ganancias'=>$ganancias,'hoy'=>$hoy,'year'=>$year,'productos'=>$productos,'ventas'=>$ventas,'ventam'=>$ventam,'mercaderia'=>$mercaderia,'artmonth'=>$artmonth,'articulos'=>$articulos]);
        
    }
    public function indexmobile(){
        $hoy=Carbon::now()->format('m');
        $year=Carbon::now()->format('Y');
        $productos= DB::table('productos_conteo as c')
        ->select('c.mes','c.conteo')
        ->groupBy('c.mes','c.conteo')
        ->get();
        $ventas=DB::table('conteo_ventas as co')
        ->select('co.mes','co.conteo')
        ->groupBy('co.mes','co.conteo')
        ->get();
        
        
        $entrada = DB::table('entrada as e')
        ->get();
        $salida = DB::table('salida as s')
        ->get();
        $flujo =0;
        for ($i=0; $i < count($entrada); $i++) {
            $flujo = $flujo + $entrada[$i]->monto;
        }
        for ($i=0; $i < count($salida); $i++) {
            $flujo = $flujo - $salida[$i]->monto;
        }
        
        $ganancias= DB::table('ganaas as g')
        ->select('g.fecha','g.ganancia')
        ->selectRaw('MONTH(g.fecha) AS Mes')
        ->groupBy('g.fecha','g.ganancia','Mes')
        ->get();



        $ventam=DB::table('venta_mensual as v')
        ->select('v.mes','v.ventas')
        ->groupBy('v.mes','v.ventas')
        ->get();
        $mercaderia=DB::table('merca as m')
        ->select('m.actual','m.potencial')
        ->groupBy('m.actual','m.potencial')
        ->get();
        $artmonth=DB::table('articulo_mes as mes')
        ->select('mes.id','mes.cantidad','mes.ventas','mes.ganancia','mes.fecha')
        ->where(\DB::raw('substr(mes.fecha, 0, 4)'), '=' , $year)
        ->orWhere(\DB::raw('substr(mes.fecha, -2)'), '=' , $hoy)
        ->orderBy('mes.ganancia','desc')
        ->groupBy('mes.id','mes.cantidad','mes.ventas','mes.ganancia','mes.fecha')        
        ->take(3)
        ->get();
       $articulos=Search::all();
        return view('cell-version.admin-mobile',['ganancias'=>$ganancias,'hoy'=>$hoy,'year'=>$year,'productos'=>$productos,'ventas'=>$ventas,'ventam'=>$ventam,'mercaderia'=>$mercaderia,'artmonth'=>$artmonth,'articulos'=>$articulos,'flujo'=>$flujo ]);
        
    }

    public function getGanancia(){   
        $p = DB::table('ganaas as g')
        ->select('g.fecha','g.ganancia')
        ->selectRaw('MONTH(g.fecha) AS Mes')
        ->groupBy('g.fecha','g.ganancia','Mes')
        ->orderBy('g.fecha', 'DESC')
        ->take(5)
        ->get();
        return response()->json($p);
    }
    public function getMonto(){
        $k= Ventamensual::latest('mes')->take(5)->get(); 
        for ($i=0; $i < 5 ; $i++) {
            $n = $k[$i]->mes;
        $k[$i]->mes = substr($n,0,4).'-'.substr($n,4,2).'-'.'01';
        $n = $k[$i]->mes;

        $n = date('M', strtotime($n));
        $k[$i]->mes = $n;
        }
        return response()->json($k);
    }
}
