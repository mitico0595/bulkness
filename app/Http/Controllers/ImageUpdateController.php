<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imageupload;

class ImageUpdateController extends Controller
{
   public function create()
    {
        return view('imageupload');
    }

    public function image()
    {
        return view('imageupload');
    }


    public function imagePost(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);
        $imageupload = new Imageupload;
        $imageupload->image=$imageName;
        $imageupload->save();

        return back()->with('image',$imageName);

       
      
    }
}
