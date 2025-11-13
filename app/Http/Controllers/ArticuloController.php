<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;
use App\Persona;
use DB;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;
use App\Tienda;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *  \Illuminate\Http\Response 
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $searches = Search::orderBy('id','ASC')->paginate(100);
                
       
        return [ 
        'pagination'=>[
            'total'=> $searches-> total(),
            'current_page'=> $searches-> currentPage(),
            'per_page'=> $searches-> perPage(),
            'last_page'=> $searches-> lastPage(),
            'from'=> $searches-> firstItem(),
            'to'=> $searches-> lastItem() 
        ],        
        'searches' => $searches ,
        ] ;     

    }

    public function subindex(){
        $personas=DB::table('personas as p')
        ->where('p.type','=','2')
        ->get(); 
        return view('admin.articulo',["personas"=>$personas]);
    } 
  public function mobileindex(){
        $personas=DB::table('personas as p')
        ->where('p.type','=','2')
        ->get();  
        return view('cell-version.product-mobile',["personas"=>$personas]);
    }
public function editMobile($id)
    {
        $searches= Search::findOrFail($id);
        return view ("cell-version.show-product",["searches"=>$searches]);
    }

    
    public function imageMobile(Request $request, $id){
                
        $searches = Search::findOrFail($id);
      
        if ($request->image != NULL ){
       
        $file_name = time().'_'.$request->image->getClientOriginalName();
        
        Image::make($request->file('image'))
        ->resize(400,400)
        ->text('ADLEREMERGENCY.COM',10,10,function($font){ 
             $font->color('#d6d6d6');
             
        } )
        ->save('images/'.$file_name);
        $file= $searches->image;
        $image_path = 'images/'.$file;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
            File::delete($image_path);
            }
         $searches->image=$file_name;    
        }

       

        

        //image1

        if ($request->image1 != NULL ){
        $file_name1 = time().'_1'.$request->image1->getClientOriginalName();
        Image::make($request->file('image1'))
        ->resize(400,400)
        ->text('ADLERMERGENCY.COM',10,10,function($font){ 
             $font->color('#d6d6d6');
             
        } )
        ->save('images/'.$file_name1);
        $file1= $searches->image1;
        $image_path1 = 'images/'.$file1;  // Value is not URL but directory file path
            if(File::exists($image_path1)) {
            File::delete($image_path1);
            }
         $searches->image1=$file_name1;    
        }

        //image2
        if ($request->image2 != NULL ){
        $file_name2 = time().'_2'.$request->image2->getClientOriginalName();
        Image::make($request->file('image2'))
        ->resize(400,400)
        ->text('ADLERMERGENCY.COM',10,10,function($font){ 
             $font->color('#d6d6d6');
             
        } )
        ->save('images/'.$file_name2);
        $file2= $searches->image2;
        $image_path2 = 'images/'.$file2;  // Value is not URL but directory file path
            if(File::exists($image_path2)) {
            File::delete($image_path2);
            }
         $searches->image2=$file_name2;    
        }
        //image3
        if ($request->image3 != NULL ){
        $file_name3 = time().'_3'.$request->image3->getClientOriginalName();
        Image::make($request->file('image3'))
        ->resize(400,400)
        ->text('ADLERMERGENCY.COM',10,10,function($font){ 
             $font->color('#d6d6d6');
             
        } )
        ->save('images/'.$file_name3);
        $file3= $searches->image3;
        $image_path3 = 'images/'.$file3;  // Value is not URL but directory file path
            if(File::exists($image_path3)) {
            File::delete($image_path3);
            }
         $searches->image3=$file_name3;    
        }

        
         
        
        $searches->save();

        return back();
             
    } 

    public function imagePost(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            
        ]);
        $imageupload = Search::create($request->all()) ;
        //portada
        if ($request->image != NULL ){
        $file_name = time().'_'.substr($request->image->getClientOriginalName(), 0, 2). substr($request->image->getClientOriginalName(), -4);
        
        Image::make($request->file('image'))
        ->text('ADLERMERGENCY.COM',10,10,function($font){ 
             $font->color('#d6d6d6');
             
        } )
        ->save('images/'.$file_name);
        $imageupload->image=$file_name; 
        }
        //imagen1
        
        if ($request->image1 != NULL ){
        $file_name1 = time().'_1'.$request->image1->getClientOriginalName();
        Image::make($request->file('image1'))
        ->text('ADLERMERGENCY.COM',10,10,function($font){ 
             $font->color('#d6d6d6');
             
        } )
        ->save('images/'.$file_name1);
        $imageupload->image1=$file_name1; 
        
        }
        //imagen2
        if ($request->image2 != NULL ){
        $file_name2 = time().'_2'.$request->image2->getClientOriginalName();
        Image::make($request->file('image2'))
        ->text('ADLERMERGENCY.COM',10,10,function($font){ 
             $font->color('#d6d6d6');
             
        } )
        ->save('images/'.$file_name2);
        $imageupload->image2=$file_name2;
        
        }
        //imagen3
        if ($request->image3 != NULL ){
        $file_name3 = time().'_3'.$request->image3->getClientOriginalName();
        Image::make($request->file('image3'))
        ->text('ADLERMERGENCY.COM',10,10,function($font){ 
             $font->color('#d6d6d6');
             
        } )
        ->save('images/'.$file_name3);
        $imageupload->image3=$file_name3; 
        }
        //
        
        
         
        $imageupload->save();
        
        return back();
             
    }
    
    
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            
                        
        ]);
        Search::create($request->all());

        return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $k= Search::find($id);
        return $k;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $t= Search::findOrFail($id);
        return $t;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            
        ]);
        
        Search::find($id)->update ($request->all());
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $h=Search::findOrFail($id);
        $h->delete();
    }
}
