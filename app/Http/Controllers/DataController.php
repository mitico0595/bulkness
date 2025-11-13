<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Search;
use PDF;
use App\Tienda;
use DB;
use App\Pdfs;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;
use Response;
use Illuminate\Support\Collection;
use Storage;

class DataController extends Controller
{
    public function __construct()
{
    set_time_limit(8000000);
    $this->middleware('admin');
}

    public function index(Request $request){


        $pdfs = DB::table('pdf as p')
        ->select('p.id', 'p.titulo','p.name')
        ->groupBy('p.id', 'p.titulo','p.name')
        ->get();


        return view('pdfauth',['pdfs' => $pdfs]);
    }

    public function create(){
        return view('pdfcreate');
    }

    public function store(Request $request){
        $this->validate($request, [
            'titulo' => 'required',
            'name' => 'required',

        ]);
        $pdfs = Pdfs::latest('id')->first();
        if ($pdfs == NULL){
        $t = 1;
        }else{
            $t = $pdfs->id;
            $t = $t+1;
        }

        if ($request->portada != NULL ){
            $imagePortada = $request->portada->getClientOriginalName();
            $request->portada->move(public_path('image/catalogo/'.$t), $imagePortada);

        }
        if ($request->trama != NULL ){
            $imageTrama = $request->trama->getClientOriginalName();
            $request->trama->move(public_path('image/catalogo/'.$t), $imageTrama);

        }
        Pdfs::create($request->all());
        return redirect('pdfauth');
    }

    public function edit(Request $request, $id){
        $pdfs= Pdfs::findOrFail($id);
        $tienda = Tienda::all();
        $t=0;
        while($t<count($tienda)){
        $e[$t]= Storage::disk('public')->exists('image/catalogo/'.$id.'/portada'.$t.'.jpg');
        $t = $t+1;
        }
        return view ("pdfedit",["pdfs"=>$pdfs,'tienda'=>$tienda,'e'=>$e ]);
    }

    public function update(Request $request, $id){
        $pdfs= Pdfs::findOrFail($id);



        if ($request->portada != NULL ){
            $imagePortada = $request->portada->getClientOriginalName();

            $request->portada->move(public_path('image/catalogo/'.$id), $imagePortada);

            }
        if ($request->trama != NULL ){
                $imageTrama = $request->trama->getClientOriginalName();
                $request->trama->move(public_path('image/catalogo/'.$id), $imageTrama);

        }
        $pdfs->name =$request->name;
        $pdfs->titulo =$request->titulo;

        $tienda = Tienda::all();
        $t=0;
        while($t<count($tienda)){
            $e = 'portada'.$t;
            if ($request->$e != NULL ){
                $imagePortada = $e.'.jpg';
                $request->$e->move(public_path('image/catalogo/'.$id), $imagePortada);

            }
        $t = $t+1;
        }



        $pdfs->update();

        return redirect('pdfauth');
    }


    public function downloadPDF($id){
        $tienda = Tienda::all();
        $pdfs= Pdfs::findOrFail($id);

        $count = 0;
        while($count < count($tienda) ){
            $t[][][] = 0;
            $idtienda = $tienda[$count]->id;
            $searches = DB::table('searches as s')
            ->select('s.name','s.precio','s.image','s.description','s.tienda','s.preciof' )
            ->where('s.tienda','=',$idtienda)
            ->where('s.stock','!=',0)
            ->groupby('s.name','s.precio','s.image','s.description','s.tienda','s.preciof')
            ->get();
            $n=0;
            $nq=0;
            $k=0;
            while($n<count($searches)){
                $t[$count][$k][0] = $searches[$nq];
                $nq=$nq+1;
                if(empty($searches[$nq]) == false ){
                $t[$count][$k][1] = $searches[$nq];
                $nq=$nq+1;
                }

                $n=$n+2;
                $k=$k+1;
            }
            $count = $count +1;
        }
        $pdf= PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,'enable_css_float'=> true,"enable_html5_parser" => true])->loadView('pdf',['t'=>$t,'pdfs'=>$pdfs])->stream();
        file_put_contents('pdf/'.$pdfs->name.'.pdf', $pdf);

        return $pdf;
     }





}
