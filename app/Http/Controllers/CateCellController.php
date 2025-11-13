<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;
use App\Tienda;
use DB;

class CateCellController extends Controller
{
     public function index(Request $request)
    {

        $tiendas = DB::table('tiendas as t')->select('t.id','t.name')->orderBy('t.id','desc')->groupBy('t.id','t.name')->get();

        return view('categoria-cell',["tiendas"=>$tiendas]);

    }
}
