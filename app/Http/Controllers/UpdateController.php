<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UpdateController extends Controller
{
    public function uploadForm() {
    	return view('upload');
    }
    public function uploadFile(Request $req){
    	$path= $req->file->store('/');
    	return $path;
    }
}
