<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Auth;
use DB;
use App\Venta;
use Illuminate\Support\Collection;
use Illuminate\Mail\Mailable;

class MailController extends Controller
{
    public function sendMail(){

        $idorder = Venta::latest('idventa')->first();
        $idorder = $idorder->idventa;

        Mail::to('miangelsp11@gmail.com')->send(new Email($idorder));
        

        return "exito";
    }
}
