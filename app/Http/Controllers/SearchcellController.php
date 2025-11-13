<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;
use App\DetalleVenta;
use App\Calificacion;
use App\Valoras;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;


class SearchcellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     

    public function index(Request $request){
            $name = $request->get('name');
            $categoria = $request->get('categoria');
            $searches= Search::orderBy('id', 'DESC')
            ->name($name)
            ->categoria($categoria)
            ->paginate(6);
            $searches->appends(['name' => $name,  'categoria' => $categoria]);
            return view('cell-version.searches',compact('searches'));
    }
    public function getItem(){
        $p= Search::orderBy('id', 'DESC')->where('soli','=','1')->get();
        return response()->json($p);
    }

    public function pagination(){
        $searches= Search::orderBy('id', 'DESC')            
            ->where('soli','=','1')
            ->paginate(6);        
        return view('cell-version.pagination',compact('searches'));
    }
 


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $searches = DB::table('searches as s')
         ->where('s.id','=',$id) 
         ->first();
         $d = 0;
         if ($searches->fecha != NULL){
         $d  = substr($searches->fecha,8,2);
         $d = substr($searches->fecha,5,2).'/'.$d.'/'.substr($searches->fecha,0,4) ;
        }
         $detalles = DB::table('detalle_venta')
         ->get();
         $calificaciones = DB::table('calificaciones')
         ->get();
         $valoras = DB::table('valoras')
         ->get();
          $sear = Search::latest()->take(8)->where('soli','=','1')->get();
          return view('cell-version.show',['searches'=>$searches,'detalles'=>$detalles,'calificaciones'=>$calificaciones,'valoras'=>$valoras,'sear'=>$sear,'d'=>$d  ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
