<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Ingresos;
use App\Search;
use Carbon\Carbon;

class IngresosController extends Controller
{
    public function index(Request $request)
    {   
        if ($request){
            $searchIni=$request->get('searchIni').' 00:00:00';
            $searchFin=$request->get('searchFin').' 23:59:00';
        
        if ($searchIni == ' 00:00:00' ){
            $searchIni = Carbon::now();
            $searchFin = Carbon::now();
            $searchIni = DATE_FORMAT($searchIni,"Y-01-01 00:00:00");
            $searchFin = DATE_FORMAT($searchFin,"Y-m-d 23:59:00");
            
        }
        $tienda=$request->get('tienda');
        $searches=$request->get('searches');            
        $iduser= Auth::user()->id;
        $tiendas=DB::table('tienda')->where('tienda.iduser','=',$iduser)->get();
        $search=DB::table('searches')->get();
        if ($tienda){
            $ingresos =DB::table('ingresos as ing')
        ->join('searches as s','s.id','=','ing.idarticulo')
        ->join('tienda as t','t.id','=','idtienda')        
        ->select('s.codigo','ing.created_at','s.name','ing.cantidad','t.name as tienda','ing.stock')
        ->selectRaw('DATE_FORMAT(ing.created_at,"%d/%m/%Y %H:%i") AS fecha')
        ->where('ing.iduser','=',$iduser)         
        ->where('ing.idtienda','=',$tienda)              
        ->whereBetween('ing.created_at',[$searchIni,$searchFin])                          
        ->orderBy('ing.id','desc')        
        ->groupBy('s.codigo','ing.created_at','s.name','ing.cantidad','t.name','fecha','ing.stock')
        ->get();
        
        }
        else {
            $ingresos =DB::table('ingresos as ing')
        ->join('searches as s','s.id','=','ing.idarticulo')
        ->join('tienda as t','t.id','=','idtienda')        
        ->select('s.codigo','ing.created_at','s.name','ing.cantidad','t.name as tienda','ing.stock')
        ->selectRaw('DATE_FORMAT(ing.created_at,"%d/%m/%Y %H:%i") AS fecha')
        ->where('ing.iduser','=',$iduser)         
        ->where('ing.idtienda','=',$tienda)              
        ->orwhereBetween('ing.created_at',[$searchIni,$searchFin])                          
        ->orderBy('ing.id','desc')        
        ->groupBy('s.codigo','ing.created_at','s.name','ing.cantidad','t.name','fecha','ing.stock')
        ->get();
        
        }

        return view('supplier.ingresos',["ingresos"=>$ingresos,"searchIni"=>$searchIni,"searchFin"=>$searchFin,"tiendas"=>$tiendas,"search"=>$search]);
        }
    }
    public function create()
    {   
        $iduser= Auth::user()->id;        
        $tienda=DB::table('tienda')->where('tienda.iduser','=',$iduser)->get();
        $articulos =DB::table('searches as art')
        ->select(DB::raw('CONCAT(art.codigo, " ",art.name) AS articulo'),'art.id','art.stock','art.precio')
        ->where('art.stock','>','0')
        
        ->groupBy('articulo','art.id','art.stock','art.precio')
        ->get();
        return view("supplier.create",["tienda"=>$tienda,"articulos"=>$articulos]);

    }

    public function store(Request $request){
        $iduser= Auth::user()->id;    
        
        try{
            DB::beginTransaction();   
            

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            
            $cont = 0;

            while($cont < count($idarticulo)){ 
                $ingreso = new Ingresos;
                $searches= Search::findOrFail($idarticulo[$cont]); 
                $lol= $searches->stock;                
                $ingreso->idtienda = $request->get('idpersona');
                $ingreso->iduser= $iduser;
                $ingreso->idarticulo=$idarticulo[$cont];
                $ingreso->cantidad=$cantidad[$cont];  
                $searches->stock= $ingreso->cantidad+$lol;
                $ingreso->stock=$searches->stock;
                $searches->update();                              
                $ingreso->save();
                $cont=$cont+1;}
            DB::commit();

        }catch(\Exception $e){ DB::rollback();}
        
        return Redirect::to('ingresos');
    }
}
