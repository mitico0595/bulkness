<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;
use App\Tienda;
use DB;
use App\Pedido;
use App\Detalle;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class DetalleController extends Controller
{
     public function index(Request $request)
    {
        if ($request){
            $searchIni=$request->get('searchIni').' 00:00:00' ;
            $searchFin=$request->get('searchFin').' 23:59:00';
            $pedido = Pedido::whereBetween('created_at',[$searchIni,$searchFin])->select('pedidos.id','pedidos.created_at')->selectRaw('MONTH(pedidos.created_at) AS month')->groupBy('pedidos.id','pedidos.created_at','month')->get();

            return view('proveedor.index',["pedido"=>$pedido,"searchIni"=>$searchIni,"searchFin"=>$searchFin]);
        }

    }
    public function productos(Request $request)
    {
        if ($request){
            $searchIni=$request->get('searchIni').' 00:00:00' ;
            $searchFin=$request->get('searchFin').' 23:59:00';
            $pedido = DB::table('detalle as det')
            ->join('pedidos as p','det.id_pedido','=','p.id')
            ->join('searches as s','det.idarticulo','=','s.id')
            ->select('det.id_dventa','p.created_at','det.idarticulo','s.name','det.precio_venta','det.subtotal','det.cantidad','s.codigo','s.name')
            ->whereBetween('p.created_at',[$searchIni,$searchFin])
            ->selectRaw('MONTH(p.created_at) AS month')
            ->selectRaw('SUM(det.cantidad) AS cantidad')
            ->selectRaw('SUM(det.subtotal) AS subtotal')
            ->groupBy('det.idarticulo')
            ->get();

            $cont =0;
            $sum=0;
            while($cont < count($pedido)){
            $sum = $sum + $pedido[$cont]->subtotal;
            $cont=$cont+1;
            }

            return view('proveedor.detalle',["sum"=>$sum,"pedido"=>$pedido,"searchIni"=>$searchIni,"searchFin"=>$searchFin]);
        }

    }

    public function create()
    {   $personas=DB::table('personas')->get();
        $articulos =DB::table('searches as art')
        ->select(DB::raw('CONCAT(art.codigo, " ",art.name) AS articulo'),'art.id','art.stock','art.costo')
        ->where('art.stock','>','0')
        ->groupBy('articulo','art.id','art.stock','art.costo')
        ->get();
        return view("proveedor.create",["personas"=>$personas,"articulos"=>$articulos]);

    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $pedido= new Pedido;
            $pedido->idpersona = Auth::user()->id;
            $mytime = Carbon::now('America/Lima');
            $pedido->created_at = $mytime->toDateTimeString();
            $pedido->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');
            $cont = 0;

            while($cont < count($idarticulo)){
                $detalle=new Detalle();
                $detalle->id_pedido=$pedido->id;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->subtotal=$cantidad[$cont]*$precio_venta[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            DB::commit();


        }catch(\Exception $e){ DB::rollback();}

        return Redirect::to('pedidos');
    }
}
