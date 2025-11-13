<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Gasto;
use DB;
use Response;
use App\Search;
use Illuminate\Support\Collection;


class GastoController extends Controller
{
    public function __construct() 
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
       $articulos =DB::table('searches as art')
        ->select(DB::raw('CONCAT(art.codigo, " ",art.name) AS articulo'),'art.id')
        ->groupBy('articulo','art.id')
        ->get();
       	$gastos=DB::table('gasto as g')   			
            ->join('searches as s','g.idarticulo','=','s.id')
            ->select('g.idarticulo','g.costo','g.tipousd','g.cantidad','g.gasto_total','g.created_at','s.image','s.name')
            ->orderBy('g.id','desc')
            ->groupBy('g.idarticulo','g.costo','g.tipousd','g.cantidad','g.gasto_total','g.created_at','s.image','s.name')
            ->paginate(25);

    	 
    	return ['articulos'=>$articulos,'gastos' => $gastos];
    }


    public function gastoindex(){
    	return view('gasto.index');
    }
    public function comprasindex(){
        return view('cell-version.compras-mobile');
    }
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'idarticulo' => 'required',
            'costo' => 'required',
            'tipousd' => 'required',
            'cantidad' => 'required',            
        ]);
        Gasto::create($request->all());
        return ;
    }
}
