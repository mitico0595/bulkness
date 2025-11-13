<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\Venta;
use App\Search;
use App\DetalleVenta;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Auth;

class SuccessController extends Controller
{
     public function index(Request $request)
    {
        $query=trim($request->get('searchText'));
        $iduser= 1;
        $venta= DB::table('venta as v')
        ->join('personas as p','v.idpersona','=','p.id')
        ->join('detalle_venta as di','v.idventa','=','di.idventa')
        ->select('v.idpersona','v.idventa','v.total_parcial' ,'v.fecha_hora','v.total_venta','p.name','v.bembale','v.bcontra','v.detalle','v.bsend','v.nseg','v.bentrega','v.cembale','v.csend','p.email','v.bverifi' )
        ->selectRaw('DATE_FORMAT(v.fecha_hora,"%d/%m/%Y ") AS fecha')
        ->selectRaw('DATE_FORMAT(v.fembale,"%d/%m/%Y %H:%i:%s ") AS fecha_embale')
        ->selectRaw('DATE_FORMAT(v.fcontra,"%d/%m/%Y %H:%i:%s ") AS fecha_contra')
        ->selectRaw('DATE_FORMAT(v.fsend,"%d/%m/%Y %H:%i:%s ") AS fecha_envio')
        ->selectRaw('DATE_FORMAT(v.fentrega,"%d/%m/%Y %H:%i:%s ") AS fecha_entrega')
        ->where('v.idventa','LIKE','%'.$query.'%')
        ->orderBy('v.idventa','desc')
        ->groupBy('v.idpersona','v.idventa','v.fecha_hora','v.total_venta','fecha','v.total_parcial','p.name','v.bembale','fecha_embale','fecha_contra','v.bcontra','v.detalle','v.bsend','fecha_envio','v.nseg','fecha_entrega','v.bentrega','v.cembale','v.csend','p.email','v.bverifi' )
        ->where('v.idpersona','=',$iduser)
        ->first();

        $detalles=DB::table('detalle_venta as d')
        ->join('searches as a','d.idarticulo','=','a.id')
        ->select('d.id_dventa','d.idventa', 'a.name as articulo','a.codigo as code','d.cantidad','d.precio_venta','a.image','d.idarticulo','d.valoracion' )

        ->groupBy('d.id_dventa','d.idventa', 'articulo','code','d.cantidad','d.precio_venta' ,'a.image','d.idarticulo','d.valoracion' )
        ->get();
        $searches = Search::latest()->take(8)->where('soli','=','1')->get();
         return view('shop.success-purchase',['venta'=>$venta,'detalles'=>$detalles,'searchText'=>$query,'searches'=>$searches]);

    }
     public function mobile(Request $request)
    {
        if ($request){
        	
            $query=trim($request->get('searchText'));
        	$iduser= Auth::user()->id;
            $venta= DB::table('venta as v') 
            ->join('personas as p','v.idpersona','=','p.id')
            ->join('detalle_venta as di','v.idventa','=','di.idventa')
            ->select('v.idpersona','v.idventa','v.fecha_hora','v.total_venta','p.name','v.bembale','v.bcontra','v.detalle','v.bsend','v.nseg','v.bentrega','v.cembale','v.csend','p.email','v.bverifi' )
            ->selectRaw('DATE_FORMAT(v.fecha_hora,"%d/%m/%Y ") AS fecha')
            ->selectRaw('DATE_FORMAT(v.fembale,"%d/%m/%Y %H:%i:%s ") AS fecha_embale')
            ->selectRaw('DATE_FORMAT(v.fcontra,"%d/%m/%Y %H:%i:%s ") AS fecha_contra')
            ->selectRaw('DATE_FORMAT(v.fsend,"%d/%m/%Y %H:%i:%s ") AS fecha_envio')
            ->selectRaw('DATE_FORMAT(v.fentrega,"%d/%m/%Y %H:%i:%s ") AS fecha_entrega')
            ->where('v.idventa','LIKE','%'.$query.'%')
            ->orderBy('v.idventa','desc')
            ->groupBy('v.idpersona','v.idventa','v.fecha_hora','v.total_venta','fecha','p.name','v.bembale','fecha_embale','fecha_contra','v.bcontra','v.detalle','v.bsend','fecha_envio','v.nseg','fecha_entrega','v.bentrega','v.cembale','v.csend','p.email','v.bverifi' )
            ->where('v.idpersona','=',$iduser)
            ->first(); 

        	$detalles=DB::table('detalle_venta as d')
            ->join('searches as a','d.idarticulo','=','a.id')
            ->select('d.id_dventa','d.idventa', 'a.name as articulo','a.codigo as code','d.cantidad','d.precio_venta','a.image','d.idarticulo','d.valoracion' )
            
            ->groupBy('d.id_dventa','d.idventa', 'articulo','code','d.cantidad','d.precio_venta' ,'a.image','d.idarticulo','d.valoracion' )
            ->get();
            $searches = Search::latest()->take(8)->where('soli','=','1')->get();

        /* Agrupar por if id venta = id detalle */ 
            return view('cell-version.sucess-mobile',['venta'=>$venta,'detalles'=>$detalles,'searchText'=>$query,'searches'=>$searches]);
        }
        

    }
}
