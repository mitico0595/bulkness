<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Persona;
use App\Personasub;
use Carbon\Carbon;
use DB;
use Response;
use Illuminate\Support\Collection;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index(Request $request){

     		$query=trim($request->get('searchText'));
            $dni=trim($request->get('searchTexto'));
    		$users= DB::table('personas as p')            
            ->where('p.lastname','LIKE','%'.$query.'%')
            ->where('p.dni','LIKE','%'.$dni.'%')
    		->paginate(30);
            
            $usuario = Persona::all();
            
    		return view('users',['searchTexto'=>$dni,'users'=>$users,'searchText'=>$query,'usuario'=>$usuario]);

    }
    public function indexMobile(Request $request){

            $query=trim($request->get('searchText'));   
            $dni=trim($request->get('searchTexto')); 
            $users= DB::table('personas as p')            
            ->where('p.lastname','LIKE','%'.$query.'%')
            ->where('p.dni','LIKE','%'.$dni.'%')
            ->orderBy('p.id','desc')
            ->get();            
            $usuario = Persona::all();
            
            return view('cell-version.usuario-mobile',['users'=>$users,'searchText'=>$query,'searchTexto'=>$dni,'usuario'=>$usuario]);

    }
    
    public function showMobile($id){    
        $hoy = Carbon::now();
        
        
        $personas= DB::table('personas as p')
        ->select('p.id','p.created_at','p.type','p.cell','p.dni','p.email','p.name','p.lastname','p.cumpleanos','p.direccion','p.distrito','p.provincia','p.ciudad')
        ->selectRaw('MONTH(p.created_at) AS monthy')
        ->selectRaw('DAY(p.cumpleanos) AS fecha')
        ->selectRaw('MONTH(p.cumpleanos) AS month')
        ->selectRaw('YEAR(p.cumpleanos) AS year')
        ->groupBy('p.id','p.created_at','monthy','p.type','p.cell','p.dni','p.email','p.name','p.lastname','fecha','month','year','p.cumpleanos','p.direccion','p.distrito','p.provincia','p.ciudad')
        ->where('p.id','=',$id)
        ->first();
                  
        $clientes=DB::table('detalle_cliente as d')
            ->select('d.id','d.dni','d.direccion','d.distrito','d.provincia','d.ciudad','d.cumpleanos','d.ganancia','d.total','d.conteog' )
            ->selectRaw('DAY(d.cumpleanos) AS fecha')
            ->selectRaw('MONTH(d.cumpleanos) AS month')
            ->selectRaw('YEAR(d.cumpleanos) AS year')
            ->groupBy('d.id','d.dni','d.direccion','d.distrito','d.provincia','d.ciudad','d.cumpleanos','d.ganancia','d.total','d.conteog','fecha','month','year')
            ->where('d.id','=',$id)
            ->first();
        
        $conteo=DB::table('conteoventa as c')
        ->select('c.id','c.conteot')
        ->groupBy('c.id','c.conteot')
        ->where('c.id','=',$id)
        ->first();
        return view('cell-version.usershow',['personas'=>$personas,'clientes'=>$clientes,'conteo'=>$conteo,'hoy'=>$hoy ]);
        
    }
    
    public function getName(){
        $p= Persona::all();        
        return response()->json($p);
    }

    public function show($id){        
        $personas= DB::table('personas as p')
        
        ->select('p.id','p.created_at','p.type','p.cell','p.dni','p.email','p.name','p.lastname','p.direccion','p.distrito','p.provincia','p.ciudad')
        ->selectRaw('MONTH(p.created_at) AS month')            
        ->groupBy('p.id','p.created_at','p.type','p.cell','p.dni','p.email','p.name','p.lastname','p.direccion','p.distrito','p.provincia','p.ciudad','month')
        ->where('p.id','=',$id)
        ->first();
        $clientes=DB::table('detalle_cliente as d')
            ->select('d.id','d.cumpleanos','d.ganancia','d.total','d.conteog' )
            ->selectRaw('DAY(d.cumpleanos) AS fecha')
            ->selectRaw('MONTH(d.cumpleanos) AS month')
            ->selectRaw('YEAR(d.cumpleanos) AS year')
            ->groupBy('d.id','d.cumpleanos','d.ganancia','d.total','d.conteog','fecha','month','year')
            ->where('d.id','=',$id)
            ->first();
            
        
        $conteo=DB::table('conteoventa as c')
        ->select('c.id','c.conteot')
        ->groupBy('c.id','c.conteot')
        ->where('c.id','=',$id)
        ->first();
        return view('user.show',['personas'=>$personas,'clientes'=>$clientes,'conteo'=>$conteo]);
        
    }
    public function edit($id){
        $personas = Persona::findOrFail($id);        
        return view ("user.edit",["personas"=>$personas]);
    }
    public function editMobile($id){
        $personas=DB::table('personas as p')
            ->join('detalle_cliente as d','d.id','=','p.id')
            ->select('p.id','p.name','p.lastname','p.dni','p.direccion','p.distrito','p.provincia','p.ciudad','p.cumpleanos','d.ganancia','d.total','d.conteog','p.email','p.cell','p.verify','p.type' )
            ->selectRaw('DAY(d.cumpleanos) AS fecha')
            ->selectRaw('MONTH(d.cumpleanos) AS month')
            ->selectRaw('YEAR(d.cumpleanos) AS year')
            ->groupBy('p.id','p.name','p.lastname','p.dni','p.direccion','p.distrito','p.provincia','p.ciudad','p.cumpleanos','d.ganancia','d.total','d.conteog','fecha','month','year','p.email','p.cell','p.verify','p.type' )
            ->where('p.id','=',$id)
            ->first();
            if ($personas === null) { 
                $personas=DB::table('personas as p')            
            ->select('p.id','p.name','p.lastname','p.dni','p.direccion','p.distrito','p.provincia','p.ciudad','p.cumpleanos','p.email','p.cell','p.verify' ,'p.type' )
            ->selectRaw('DAY(p.cumpleanos) AS fecha')
            ->selectRaw('MONTH(p.cumpleanos) AS month')
            ->selectRaw('YEAR(p.cumpleanos) AS year')
            ->selectRaw('0.00 AS ganancia')
            ->selectRaw('0.00 AS total')
            ->groupBy('p.id','p.name','p.lastname','p.dni','p.direccion','p.distrito','p.provincia','p.ciudad','p.cumpleanos','ganancia','total','fecha','month','year','p.email','p.cell','p.verify','p.type' )
            ->where('p.id','=',$id)
            ->first();
            }          
        return view ("cell-version.verify",["personas"=>$personas]);
    }

    public function update(Request $request, $id){
        $personas = Persona::findOrFail($id);                
        $personas->name=$request->get('name');
        $personas->lastname=$request->get('lastname');
        $personas->email=$request->get('email');
        $personas->dni=$request->get('dni');
        $personas->cell=$request->get('cell');
        $personas->direccion=$request->get('direccion');
        $personas->distrito=$request->get('distrito');
        $personas->provincia=$request->get('provincia');
        $personas->ciudad=$request->get('ciudad');
        $personas->cumpleanos=$request->get('cumpleanos');
        $personas->update();
        return Redirect::to('personas');
    }

    public function updateMobile(Request $request, $id){
        $personas = Persona::findOrFail($id);                
        $personas->name=$request->get('name');
        $personas->lastname=$request->get('lastname');
        $personas->email=$request->get('email');
        $personas->dni=$request->get('dni');
        $personas->cell=$request->get('cell');
        $personas->direccion=$request->get('direccion');
        $personas->distrito=$request->get('distrito');
        $personas->provincia=$request->get('provincia');
        $personas->ciudad=$request->get('ciudad');
        $personas->cumpleanos=$request->get('cumpleanos');
        $personas->verify = $request->get('verify');
        $personas->type=$request->get('type');
        $personas->update();
        return Redirect::to('usuario-mobile');
    }
}
