<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Niubiz;
use App\Search;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Cart;
use App\Venta;

use App\DetalleVenta;
use DB;
use Carbon\Carbon;
use Response;

use Session;
use Auth;



class PagoProvController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        
    }    
    public function index (Request $request){
        $domil = Session::get('domil');
        if(!Session::has('cart')){
            return view('shop.carro-compras', ['searches'=>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrecioProv;
        return view('datainprov', ['domil' => $domil,'searches'=>$cart->items,'totalProduct'=>$cart->totalPrice,'total'=>$total]);

    }
    public function indexMobile (Request $request){
        $domil = Session::get('domil');
        if(!Session::has('cart')){
            return view('shop.carro-compras', ['searches'=>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrecioProv;
        return view('cell-version.pagas-mobile', ['domil' => $domil,'searches'=>$cart->items,'totalProduct'=>$cart->totalPrice,'total'=>$total]);

    }
    
    public function store(Request $request) {
        $request->session()->forget('domil');
        $domil = (object)array(
            'name' => $request->name,
            'cell' => $request->cell,
            'dni' => $request->dni,
            'detalle' => $request->detalle,
            'referencia' => $request->referencia,
            'distrito' => $request->distrito,
            'provincia' => $request->provincia,
            'ciudad' => $request->ciudad,
        );
        Session::push('domil',$domil);
        $var = Session::get('domil');
        
        return redirect('checkoutcity');
    }
    
    public function storeMobile(Request $request) {
        $request->session()->forget('domil');
        $domil = (object)array(
            'name' => $request->name,
            'cell' => $request->celular,
            'dni' => $request->dni,
            'detalle' => $request->nota,
            'referencia' => $request->referencia,
            'domicilio' => $request->domicilio,
            'distrito' => $request->distrito,
            'provincia' => $request->provincia,
            'ciudad' => $request->ciudad,
        );
        Session::push('domil',$domil);
        $var = Session::get('domil');
        
        return redirect('checkoutcity-mobile');
    }

    

    
}
