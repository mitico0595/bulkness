<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\Venta;
use App\DetalleVenta;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Mail\Mailable; 

class VentaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        



        if ($request){
            $querya=trim($request->get('searchLast'));
            $query=trim($request->get('searchText'));
            $ventas=DB::table('venta as v')
            ->join('personas as p','v.idpersona','=','p.id')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','p.name','v.lastname','p.cell','v.total_venta','v.bentrega','v.idpersona','v.dni','v.email','v.purchaseNumber','v.tipo_venta','v.payment_id')
            ->selectRaw('DAY(v.fecha_hora) AS fecha')
            ->selectRaw('MONTH(v.fecha_hora) AS month')
            ->selectRaw('DATE_FORMAT(v.fecha_hora," %H:%i") AS hora')
            ->where('p.lastname','LIKE','%'.$query.'%')
            ->where('v.idventa','LIKE','%'.$querya.'%')
            ->orderBy('v.idventa','desc')
            ->groupBy('v.idventa','fecha','month','hora','v.name','v.lastname','p.cell','v.total_venta','v.bentrega','v.idpersona','v.dni','v.email','v.purchaseNumber','v.tipo_venta','v.payment_id')
            ->paginate(25)->withQueryString();
            return view('ingreso.index',["ventas"=>$ventas,"searchText"=>$query,"searchLast"=>$querya]);
        }
    }
    public function mobileindex(Request $request){
        if ($request){
            
            $query=trim($request->get('searchText'));
            $ventas=DB::table('venta as v')
            ->join('personas as p','v.idpersona','=','p.id')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','p.name','p.lastname','p.cell','v.total_venta','v.bentrega','v.idpersona','v.dni','v.email','v.purchaseNumber','v.tipo_venta','v.payment_id')
            ->selectRaw('DAY(v.fecha_hora) AS fecha')
            ->selectRaw('MONTH(v.fecha_hora) AS month')
            ->selectRaw('DATE_FORMAT(v.fecha_hora," %H:%i") AS hora')
            ->where('p.lastname','LIKE','%'.$query.'%')            
            ->orderBy('v.idventa','desc')
            ->groupBy('v.idventa','fecha','month','hora','p.name','p.lastname','p.cell','v.total_venta','v.bentrega','v.idpersona','v.dni','v.email','v.purchaseNumber','v.tipo_venta','v.payment_id')
            ->paginate(25)->withQueryString();
            return view('cell-version.venta-mobile',["ventas"=>$ventas,"searchText"=>$query]);
        }
    }

    public function ventaBusca() {
         $p= DB::table('venta as v')
            ->join('personas as p','v.idpersona','=','p.id')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','p.name','p.lastname','p.cell','v.total_venta','v.bentrega')
            ->selectRaw('DAY(v.fecha_hora) AS fecha')
            ->selectRaw('MONTH(v.fecha_hora) AS month')
            ->selectRaw('DATE_FORMAT(v.fecha_hora," %H:%i") AS hora')
            ->groupBy('v.idventa','fecha','month','hora','p.name','p.lastname','p.cell','v.total_venta','v.bentrega')
            ->get();

        return response()->json($p);
    }



    public function create()
    {   $personas=DB::table('personas')->get();
        $articulos =DB::table('searches as art')
        ->select(DB::raw('CONCAT(art.codigo, " ",art.name) AS articulo'),'art.id','art.stock','art.precio','art.costo')
        ->where('art.stock','>','0')
        ->groupBy('articulo','art.id','art.stock','art.precio','art.costo')
        ->get();
        return view("ingreso.create",["personas"=>$personas,"articulos"=>$articulos]);

    }
    public function createMobile()
    {   $personas=DB::table('personas')->get();
        $articulos =DB::table('searches as art')
        ->select(DB::raw('CONCAT(art.codigo, " ",art.name) AS articulo'),'art.id','art.stock','art.precio','art.costo')
        ->where('art.stock','>','0')
        ->groupBy('articulo','art.id','art.stock','art.precio','art.costo')
        ->get();
        return view("cell-version.venta-create",["personas"=>$personas,"articulos"=>$articulos]);

    }

    public function store(Request $request){
        $purchaseNumber = $this->generatePurchaseNumber();
        
        try{
           
            
            DB::beginTransaction();
            $venta= new Venta;
            
            
            $venta->idpersona=$request->get('idpersona');
            $venta->total_venta=$request->get('total_venta');
            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();
            $venta->purchaseNumber = $purchaseNumber;
            
            $venta->name = $request->get('name');            
            $venta->dni = $request->get('dni');
            $venta->domicilio = $request->get('direccion');
            $venta->celular = $request->get('celular');
            $venta->distrito = $request->get('distrito');
            $venta->provincia = $request->get('provincia');
            $venta->departamento = $request->get('ciudad');
            $venta->email = $request->get('email');
            $venta->tipo_venta = $request->get('tipo');
            $emaila = $request->get('email');
            $venta->option_select = $request->get('option');
            $venta->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');
            $ganancia = $request->get('ganancia');
            $cont = 0;

            while($cont < count($idarticulo)){
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->ganancia=$ganancia[$cont];
                $detalle->save();
                $cont=$cont+1;}
            DB::commit();
        // EMAIL 
        $idorder = $venta->idventa;
        Mail::to("miangelsp11@gmail.com")->send(new Email($idorder)); 
        Mail::to($emaila)->send(new Email($idorder)); 
        
        // end email
        
        }catch(\Exception $e){ DB::rollback();}
        
        return Redirect::to('ingreso');
    }
    public function storeMobile(Request $request){
        try{
            $purchaseNumber = $this->generatePurchaseNumber();
            $purchaseIzi = $this->generatePurchaseIzi();
            
            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona=$request->get('idpersona');
            $venta->total_venta=$request->get('total_venta');
            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();
            $venta->idpersona=$request->get('idpersona');
            $venta->name = $request->get('name');            
            $venta->dni = $request->get('dni');
            $venta->domicilio = $request->get('direccion');
                                  
            $venta->celular = $request->get('celular');

            $venta->distrito = $request->get('distrito');
            $venta->provincia = $request->get('provincia');
            $venta->departamento = $request->get('ciudad');
            $venta->email = $request->get('email');
            $venta->tipo_venta = $request->get('tipo');
            $emaila = $request->get('email');
            $venta->option_select = $request->get('option');
            $venta->purchaseNumber = $purchaseNumber;
            
            $venta->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');
            $ganancia = $request->get('ganancia');
            $cont = 0;

            while($cont < count($idarticulo)){
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->ganancia=$ganancia[$cont];
                $detalle->save();
                $cont=$cont+1;}
            DB::commit();
             // EMAIL 
        $idorder = $venta->idventa;
        Mail::to("miangelsp11@gmail.com")->send(new Email($idorder)); 
        Mail::to($emaila)->send(new Email($idorder)); 
        
        // end email

        }catch(\Exception $e){ DB::rollback();}
        
        return Redirect::to('venta-mobile');
    }
    public function show($id){
        $venta= DB::table('venta as v')
            ->join('personas as p','v.idpersona','=','p.id')
            ->join('detalle_venta as di','v.idventa','=','di.idventa')
            ->select('v.idventa','v.fecha_hora','v.name','v.lastname','p.cell','p.email','p.dni','v.total_venta','v.total_parcial','v.email','v.distrito','v.provincia','v.domicilio','v.purchaseNumber')
            ->selectRaw('DATE_FORMAT(v.fecha_hora,"%d/%m/%Y") AS fecha')
            ->groupBy('v.idventa','v.fecha_hora','v.name','v.lastname','p.cell','p.email','p.dni','v.total_venta','fecha','v.total_parcial','v.email','v.distrito','v.provincia','v.domicilio','v.purchaseNumber')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('detalle_venta as d')
            ->join('searches as a','d.idarticulo','=','a.id')
            ->select('a.name as articulo','a.codigo as code','a.description as descrip','d.cantidad','d.precio_venta')
            ->where('d.idventa','=',$id)
            ->get();
            $cantidad = 0;
            $precio = 0;
            $submont = 0;
            $cont = 0;
            
            while($cont < count($detalles)){
                $cantidad = $detalles[$cont]->cantidad;
                $precio = $detalles[$cont]->precio_venta;
                $precio = $precio*$cantidad;
                $submont = $submont + $precio;
                $cont=$cont+1;}
                
            return view('ingreso.show',['venta'=>$venta,'detalles'=>$detalles,'submont'=>$submont]);
    }
    public function showMobile($id){
        $venta= DB::table('venta as v')
            ->join('personas as p','v.idpersona','=','p.id')
            ->join('detalle_venta as di','v.idventa','=','di.idventa')
            ->select('v.idventa','v.fecha_hora','v.name','v.lastname','v.celular','v.dni','v.total_venta','v.bverifi','v.bsend','v.bcontra','v.bembale','v.bentrega','v.distrito','v.provincia','v.departamento','v.detalle','v.shcost','v.option_select','v.cargos','v.total_parcial','v.payment_id','v.domicilio')
            ->selectRaw('DATE_FORMAT(v.fecha_hora,"%d/%m/%Y") AS fecha')
            ->groupBy('v.idventa','v.fecha_hora','v.name','v.lastname','v.celular','v.dni','v.total_venta','fecha','v.bverifi','v.bsend','v.bcontra','v.bembale','v.bentrega','v.distrito','v.provincia','v.departamento','v.detalle','v.shcost','v.option_select','v.cargos','v.total_parcial','v.payment_id','v.domicilio') 
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('detalle_venta as d')
            ->join('searches as a','d.idarticulo','=','a.id')
            ->select('d.id_dventa','a.name as articulo','d.idarticulo', 'a.codigo as code','a.description as descrip','d.cantidad','d.precio_venta','a.image','d.opinion','d.valoracion')
            ->where('d.idventa','=',$id)
            ->get();
            return view('cell-version.venta-show',['venta'=>$venta,'detalles'=>$detalles]);
    }
    public function edit($id){
        $venta = Venta::findOrFail($id);
        return view('ingreso.edit',['venta'=>$venta]);
    }
    public function update(Request $request, $id)
    {
        
        Venta::find($id)->update($request->all());
        return redirect('ingreso');
    }
    public function destroy($id){
      
    }
    function generatePurchaseNumber(){
        $archivo = '/txt/purchaseNumber.txt';
        $purchaseNumber = 222;
        $fp = fopen(storage_path().$archivo,'r');
        $purchaseNumber = fgets($fp, 100);
        fclose($fp);
        ++$purchaseNumber;
        $fp = fopen(storage_path().$archivo,"w+");
        fwrite($fp, $purchaseNumber, 100);
        fclose($fp);
        return $purchaseNumber;
    }
    function generatePurchaseIzi(){
        $archivo = '/txt/izipay.txt';
        $purchaseNumber = 222;
        $fp = fopen(storage_path().$archivo,'r');
        $purchaseNumber = fgets($fp, 100);
        fclose($fp);
        ++$purchaseNumber;
        $fp = fopen(storage_path().$archivo,"w+");
        fwrite($fp, $purchaseNumber, 100);
        fclose($fp);
        return $purchaseNumber;
    }
}
