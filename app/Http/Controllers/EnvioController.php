<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Venta;
use App\DetalleVenta;
use DB;
use Response;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;

class EnvioController extends Controller
{
	public function index(Request $request) {

   			$envios=DB::table('venta as v')
   			
            ->join('personas as p','v.idpersona','=','p.id')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.idpersona' ,'p.name','p.lastname','p.cell','v.total_venta','v.bentrega','v.bverifi','v.cembale','v.fembale','v.bembale','v.fcontra','v.bcontra','v.csend','v.fsend','v.bsend','v.nseg','v.detalle','v.centrega','v.fentrega','v.opinion','v.fecha_hora as clock','v.domicilio','v.distrito','v.provincia','v.departamento','v.celular','v.dni' )
            ->selectRaw('DATE_FORMAT(v.fecha_hora,"%d/%m/%Y") AS fecha_hora')
            ->orderBy('v.idventa','desc')
            ->groupBy('v.idventa','v.idpersona' ,'p.name','p.lastname','p.cell','v.total_venta','v.bentrega','v.bverifi','v.cembale','v.fembale','v.bembale','v.fcontra','v.bcontra','v.csend','v.fsend','v.bsend','v.nseg','v.detalle','v.centrega','v.fentrega','v.opinion','fecha_hora','clock','v.domicilio','v.distrito','v.provincia','v.departamento','v.celular','v.dni')
            ->where('v.bentrega','=','0')
            ->paginate(20);

            $detalles=DB::table('detalle_venta as d')
            ->join('searches as a','d.idarticulo','=','a.id')
            ->join('venta as v','v.idventa','=','d.idventa')
            ->select('d.id_dventa','d.idventa', 'a.name as articulo','a.codigo as code','d.cantidad','d.precio_venta','a.image','d.idarticulo','d.valoracion','v.bentrega')            
            ->groupBy('d.id_dventa','d.idventa', 'articulo','code','d.cantidad','d.precio_venta' ,'a.image','d.idarticulo','d.valoracion','v.bentrega' )
            ->where('v.bentrega','=','0')
            ->get();

    	return [ 'envios' => $envios,'detalles'=>$detalles ];
    }

    public function subindex(){
    	return view('pedidos.lista');
    }
    public function indexMobile(){
        return view('cell-version.envio-mobile');
    }
       public function edit($id)
    {
        $envios= Venta::findOrFail($id);
        return view ("pedidos.edit",["envios"=>$envios]);
    }

    public function editMobile($id)
    {
        $envios= Venta::findOrFail($id);
        return view ("cell-version.progresoVenta",["envios"=>$envios]);
    }

    
    public function imageMobile(Request $request, $id){
                
        $envios = Venta::findOrFail($id);
        if (!is_dir('images/envios/'.$id)) {
        //make new directory with unique id
            mkdir('images/envios/'.$id); 
        }
        if ($request->cembale != NULL ){
       
        $file_name = time().'_'.$request->cembale->getClientOriginalName();
        Image::make($request->file('cembale'))
        ->resize(200,350)
        ->text('Embale realizado, OBERLU.COM',10,10,function($font){ 
             $font->color('#ccccc');
             
        } )
        ->save('images/envios/'.$id.'/'.$file_name);
        $envios->cembale=$file_name;    
        }
        if ($request->csend != NULL ){
            $file_name = time().'_'.$request->csend->getClientOriginalName();
        Image::make($request->file('csend'))
        ->resize(200,350)
        ->text('Envio realizado, OBERLU.COM',10,10,function($font){ 
             $font->color('#ccccc');
        } )
        ->save('images/envios/'.$id.'/'.$file_name);
        $envios->csend=$file_name;
        
        }
        if ($request->centrega != NULL ){
        $file_name = time().'_'.$request->centrega->getClientOriginalName();
        Image::make($request->file('centrega'))
        ->resize(200,350)
        ->text('Entrega realizada, OBERLU.COM',10,10,function($font){ 
             $font->color('#ccccc');
        } )
        ->save('images/envios/'.$id.'/'.$file_name);
        $envios->centrega=$file_name;
        }

        
         
        
        $envios->save();

        return back();
             
    }
    public function imageEnvio(Request $request, $id){
                
        $envios = Venta::findOrFail($id);
      
        if ($request->cembale != NULL ){
        $imageEmbale = time().'_'.$request->cembale->getClientOriginalName();
        $request->cembale->move(public_path('images/envios/'.$id), $imageEmbale);
        $envios->cembale=$imageEmbale;
        }
        if ($request->csend != NULL ){
        $imageEnvio = time().'_'.$request->csend->getClientOriginalName();
        $request->csend->move(public_path('images/envios/'.$id), $imageEnvio);
        $envios->csend=$imageEnvio;
        }
        if ($request->centrega != NULL ){
        $imageEntrega = time().'_'.$request->centrega->getClientOriginalName();
        $request->centrega->move(public_path('images/envios/'.$id), $imageEntrega);
        $envios->centrega=$imageEntrega;
        }

        
         
        
        $envios->save();

        return Redirect::to('lista');
             
    }

    public function update(Request $request, $idventa)
    {
        $this->validate($request, [

        ]);
        
        Venta::find($idventa)->update($request->all());
        return;
    }

     public function show($idventa)
    {
        $k= Venta::find($idventa);
        return $k;
    }
}
