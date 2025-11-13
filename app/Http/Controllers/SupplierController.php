<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Auth;
class SupplierController extends Controller
{
	public function __construct()
    {
        $this->middleware('prove');
    }
    public function index(Request $request)
    {	
    	$user = Auth::user()->lastname;
    
         return view('supplier.index');

    }
      
    

}
