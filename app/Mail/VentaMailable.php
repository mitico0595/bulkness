<?php

namespace App\Mail;

use App\Venta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VentaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $venta;

    public function __construct(Venta $venta)
    {
        $this->venta = $venta;
    }

    public function build()
    {
        return $this->subject('Detalle de compra '.$this->venta->codigo)
            ->view('emails.venta');
    }
}
