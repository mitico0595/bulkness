<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Message;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
class MessageController extends Controller
{
    public function index(Request $request){
 $messages= Message::orderBy('id', 'DESC')->get();
        return  view('cell-version.listaqueja',['messages'=>$messages]);
    }

    public function create(){
        return  view('cell-version.messages');
    }


    public function store(Request $request)
    {
        
          $this->validate($request, [
            'mensaje' => 'required',            
                        
        ]);
        Message::create($request->all());
        $name = $request->get('mensaje');
       
        $motivo = $request->get('motivo');
        return redirect()->back()->with(['success' => $name,'motivo' => $motivo]);
    }


}
