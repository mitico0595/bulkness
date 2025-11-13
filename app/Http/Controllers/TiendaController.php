<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Tienda;
use DB;
use Response;
use Illuminate\Support\Collection;

class TiendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {

       	$tiendas=DB::table('tiendas as t')
            ->select('t.id','t.name','t.portada','t.marca1','t.marca2','t.marca3','t.color')
            ->orderBy('t.id','desc')
            ->groupBy('t.id','t.name','t.portada','t.marca1','t.marca2','t.marca3','t.color')
            ->paginate(25);

            return view('almacen.tienda',["tiendas"=>$tiendas]);

    }

    public function create()
    {
        return view("almacen.create");
    }

    public function store(Request $request){

            $tienda= new Tienda;
            $tienda->name=$request->get('name');
            $tienda->save();


            DB::commit();

        return Redirect::to('tiendas');
    }
    public function destroy($id)
    {
        $tiendas= Tienda::findOrFail($id);
        $tiendas->delete();

        return Redirect::to('tiendas');
    }

}
