<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use App\Entrada;
use App\Salida;
class CajaController extends Controller
{
     public function index(Request $request)
    {

      $entradas = DB::table('entrada as e')
       ->select('e.id','e.detalle','e.monto','e.created_at')
       ->orderBy('e.id','desc')
       ->groupBy('e.id','e.detalle','e.monto','e.created_at')
       ->get();
        $ingreso = 0;
        for ($i=0; $i < count($entradas); $i++) {
            $ingreso = $ingreso + $entradas[$i]->monto;
        }
        $salidas = DB::table('salida as e')
       ->select('e.id','e.detalle','e.monto','e.created_at')
       ->orderBy('e.id','desc')
       ->groupBy('e.id','e.detalle','e.monto','e.created_at')
       ->get();
        $egreso = 0;
        for ($i=0; $i < count($salidas); $i++) {
            $egreso = $egreso + $salidas[$i]->monto;
        }

        return view('caja.index',["entradas"=>$entradas,'ingreso'=>$ingreso,'salidas'=>$salidas,'egreso'=>$egreso ]);

    }
    public function create(){

        return view('caja.create');
    }
    public function store(Request $request){


        try{
            DB::beginTransaction();

            $detalle = $request->get('detalle');
            $monto = $request->get('monto');
            $cont = 0;

            while($cont < count($detalle)){
                $entrada= new Entrada;
                $entrada->detalle= $detalle[$cont];
                $entrada->monto = $monto[$cont];
                $entrada->save();
                $cont=$cont+1;}
            DB::commit();


        }catch(\Exception $e){ DB::rollback();}

        return Redirect::to('entradas');
    }

    public function egresocreate(){

        return view('caja.egreso');
    }
    public function egresostore(Request $request){


        try{
            DB::beginTransaction();

            $detalle = $request->get('detalle');
            $monto = $request->get('monto');
            $cont = 0;

            while($cont < count($detalle)){
                $egreso= new Salida;
                $egreso->detalle= $detalle[$cont];
                $egreso->monto = $monto[$cont];
                $egreso->save();
                $cont=$cont+1;}
            DB::commit();


        }catch(\Exception $e){ DB::rollback();}

        return Redirect::to('entradas');
    }
}
