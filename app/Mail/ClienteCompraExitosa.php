<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Venta;

class ClienteCompraExitosa extends Mailable
{
    use Queueable, SerializesModels;

    public $venta;
    public $receipt;
    public $delivery;

    public function __construct(Venta $venta, array $receipt, array $delivery = [])
    {
        $this->venta = $venta;
        $this->receipt = $receipt;
        $this->delivery = $delivery;
    }

    public function build()
    {
        $codigo = $this->venta->codigo ?? 'pedido';

        return $this
            ->subject("Compra exitosa #{$codigo}")
            ->view('emails.ventas.cliente-html');
    }
}
