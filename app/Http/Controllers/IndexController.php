<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;
use App\Tienda;
use DB;

class IndexController extends Controller
{
     public function index(Request $request)
    {
        
        $some = Search::latest()->where('tipo','=','3')->take(12)->get();
        $kits = Search::latest()->where('tipo','=','2')->get();
        
        
        
         return view('layouts.amigurumis',["some"=>$some,"kits"=>$kits ]);

    }
}
