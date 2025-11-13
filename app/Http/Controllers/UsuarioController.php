<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use Auth;
use DB;
class UsuarioController extends Controller
{	
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $iduser= Auth::user()->id;
    	$clientes= DB::table('personas as p')
        ->select('p.id','p.name','p.lastname','p.direccion','p.ciudad','p.distrito','p.provincia','p.cumpleanos','p.created_at','p.type','p.cell','p.dni','p.email')
        ->selectRaw('DAY(p.cumpleanos) AS fecha')
        ->selectRaw('MONTH(p.cumpleanos) AS month')
        ->selectRaw('MONTH(p.created_at) AS monthi')
        ->selectRaw('YEAR(p.cumpleanos) AS year')           
        ->groupBy('p.id','p.name','p.lastname','p.direccion','p.ciudad','p.distrito','p.provincia','p.cumpleanos','p.created_at','p.type','p.cell','p.dni','p.email','month','fecha','year','monthi')
        ->where('p.id','=',$iduser)
        ->first(); 
        

    	return view('userblackboard',['clientes'=>$clientes]);
    }

    public function indexMobile(Request $request){
        $iduser= Auth::user()->id;
        $clientes= DB::table('personas as p')
        ->select('p.id','p.name','p.lastname','p.direccion','p.ciudad','p.distrito','p.provincia','p.cumpleanos','p.created_at','p.type','p.cell','p.dni','p.email')
        ->selectRaw('DAY(p.cumpleanos) AS fecha')
        ->selectRaw('MONTH(p.cumpleanos) AS month')
        ->selectRaw('MONTH(p.created_at) AS monthi')
        ->selectRaw('YEAR(p.cumpleanos) AS year')           
        ->groupBy('p.id','p.name','p.lastname','p.direccion','p.ciudad','p.distrito','p.provincia','p.cumpleanos','p.created_at','p.type','p.cell','p.dni','p.email','month','fecha','year','monthi')
        ->where('p.id','=',$iduser)
        ->first(); 

        return view('cell-version.usuario-mobile',['clientes'=>$clientes]);
    }

    public function subindex (){
        return view('index-profile');
    }
}
