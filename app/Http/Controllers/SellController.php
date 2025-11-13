<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\Venta;
use App\DetalleVenta;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Auth;
class SellController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        if ($request){
        	
            $query=trim($request->get('searchText'));
        	$iduser= Auth::user()->id;
            $venta= DB::table('venta as v') 
            ->join('personas as p','v.idpersona','=','p.id')
            ->join('detalle_venta as di','v.idventa','=','di.idventa')
            ->select('v.idpersona','v.purchaseNumber','v.idventa','v.fecha_hora','v.total_venta','p.name','v.bembale','v.bcontra','v.detalle','v.bsend','v.nseg','v.bentrega','v.cembale','v.csend','p.email','v.bverifi' )
            ->selectRaw('DATE_FORMAT(v.fecha_hora,"%d/%m/%Y ") AS fecha')
            ->selectRaw('DATE_FORMAT(v.fembale,"%d/%m/%Y %H:%i:%s ") AS fecha_embale')
            ->selectRaw('DATE_FORMAT(v.fcontra,"%d/%m/%Y %H:%i:%s ") AS fecha_contra')
            ->selectRaw('DATE_FORMAT(v.fsend,"%d/%m/%Y %H:%i:%s ") AS fecha_envio')
            ->selectRaw('DATE_FORMAT(v.fentrega,"%d/%m/%Y %H:%i:%s ") AS fecha_entrega')
            ->where('v.idventa','LIKE','%'.$query.'%')
            ->orderBy('v.idventa','desc')
            ->groupBy('v.idpersona','v.purchaseNumber','v.idventa','v.fecha_hora','v.total_venta','fecha','p.name','v.bembale','fecha_embale','fecha_contra','v.bcontra','v.detalle','v.bsend','fecha_envio','v.nseg','fecha_entrega','v.bentrega','v.cembale','v.csend','p.email','v.bverifi' )
            ->where('v.idpersona','=',$iduser)
            ->get(); 

        	$detalles=DB::table('detalle_venta as d')
            ->join('searches as a','d.idarticulo','=','a.id')
            ->select('d.id_dventa','d.idventa', 'a.name as articulo','a.codigo as code','d.cantidad','d.precio_venta','a.image','d.idarticulo','d.valoracion' )
            
            ->groupBy('d.id_dventa','d.idventa', 'articulo','code','d.cantidad','d.precio_venta' ,'a.image','d.idarticulo','d.valoracion' )
            ->get();
            

        /* Agrupar por if id venta = id detalle */ 
            return view('detail.index',['venta'=>$venta,'detalles'=>$detalles,'searchText'=>$query ]);
        }
    }

    public function edit($id){
        $iduser= Auth::user()->id;
        $detalles=DB::table('detalle_venta as d')
            ->join('searches as a','d.idarticulo','=','a.id')
            ->join('venta as v','v.idventa','=','d.idventa')
            ->select('v.idpersona','d.id_dventa','d.idventa', 'a.name as articulo','a.codigo as code','d.cantidad','d.precio_venta','a.image','d.idarticulo','d.opinion','d.valoracion' )
            
            ->groupBy('d.id_dventa','d.idventa', 'articulo','code','d.cantidad','d.precio_venta' ,'a.image','d.idarticulo','d.opinion','d.valoracion')
            ->where('d.id_dventa','=',$id)
            ->where('v.idpersona','=',$iduser)  
            ->first();
        return view ("detail.edit",["detalles"=>$detalles]);  

    }
    
   public function show($id){
        $verifi = Auth::user()->id;
        $venta= DB::table('venta as v')
            ->join('personas as p','v.idpersona','=','p.id')
            ->join('detalle_venta as di','v.idventa','=','di.idventa')
            ->select('v.idventa','v.fecha_hora','v.name','v.lastname', 'v.domicilio','v.fembale','v.nseg', 'v.celular','v.dni','v.total_venta','v.bverifi','v.bsend','v.bcontra','v.bembale','v.bentrega','v.distrito','v.provincia','v.departamento','v.detalle','v.shcost','v.option_select','v.cargos')
            ->selectRaw('DATE_FORMAT(v.fecha_hora,"%d/%m/%Y") AS fecha')
            ->selectRaw('DATE_FORMAT(v.fembale,"%d/%m/%Y %H:%m") AS fecha_embale')
            ->selectRaw('DATE_FORMAT(v.fsend,"%d/%m/%Y %H:%m") AS fecha_envio')
            ->selectRaw('DATE_FORMAT(v.fcontra,"%d/%m/%Y %H:%m") AS fecha_contra')
            ->selectRaw('DATE_FORMAT(v.fentrega,"%d/%m/%Y %H:%m") AS fecha_entrega')
            ->groupBy('v.idventa','v.fecha_hora','v.name','v.lastname','v.celular','fecha_embale','fecha_entrega','fecha_envio','v.nseg', 'fecha_contra' ,'v.dni','v.total_venta','fecha','v.domicilio','v.bverifi','v.bsend','v.bcontra','v.bembale','v.bentrega','v.distrito','v.provincia','v.departamento','v.detalle','v.shcost','v.option_select','v.cargos')
            ->where('v.idventa','=',$id)
            ->where('v.idpersona','=',$verifi)
            ->first();

        $detalles=DB::table('detalle_venta as d')
            ->join('searches as a','d.idarticulo','=','a.id')
            ->select('d.id_dventa','a.name as articulo','d.idarticulo', 'a.codigo as code','a.description as descrip','d.cantidad','d.precio_venta','a.image','d.opinion','d.valoracion')
            ->where('d.idventa','=',$id)
            ->get();
            return view('detail.show',['venta'=>$venta,'detalles'=>$detalles]);
    }

    public function update(Request $request,$id){
        
        $detalles = DetalleVenta::findOrFail($id);
        $detalles->opinion=$request->get('opinion');
        $detalles->valoracion=$request->get('valoracion');        
        
        $detalles->update();
        return Redirect::to('detail');
    }
    



   
   
    
}

