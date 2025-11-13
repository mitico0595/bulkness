<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;
use App\Tienda;
use DB;

class PruebaController extends Controller
{
     public function index(Request $request)
    {
        
        $some = Search::latest()->where('tipo','=','3')->take(12)->get();
        $kits = Search::latest()->where('tipo','=','2')->get();
        
        
        
         return view('prueba',["some"=>$some,"kits"=>$kits ]);

    }
}
