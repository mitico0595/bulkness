<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;
use Auth;
use DB;

class SupplierstockController extends Controller
{

	public function __construct()
    {
        $this->middleware('prove');
    }

     public function index(Request $request)
    {
    	$user= Auth::user()->id;
        $suppliers = Search::orderBy('id','DESC')
        ->where('idpersona','=',$user)
        ->paginate(100);
              
        
        return [ 
        'pagination'=>[
            'total'=> $suppliers-> total(),
            'current_page'=> $suppliers-> currentPage(),
            'per_page'=> $suppliers-> perPage(),
            'last_page'=> $suppliers-> lastPage(),
            'from'=> $suppliers-> firstItem(),
            'to'=> $suppliers-> lastItem() 
        ],

        'suppliers' => $suppliers,

        ];  
    }
    public function subindex(){
        $personas=DB::table('personas as p')
        ->where('p.type','=','2')
        ->get(); 
        return view('supplier.supplier-stock',["personas"=>$personas]);
    }
    public function supmobile(){
        $personas=DB::table('personas as p')
        ->where('p.type','=','2')
        ->get();
        return view('cell-version.prov-mobile',["personas"=>$personas]);
    }

    public function imagePost(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'categoria' => 'required',
            'costo' => 'required',
            'stock' => 'required',
        ]);
        
        
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);
        
        $imageupload = Search::create($request->all()) ;
        $imageupload->image=$imageName;        
        $imageupload->save();
        
        return back()->with('image',$imageName);
             
    }

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

        return  view('supplier.supplier-stock');
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
