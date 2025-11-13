<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\DetalleVenta;
use Auth;
use DB;
class Email extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $id=$order;
        $venta=DB::table('venta as d')
        ->select('d.idventa', 'd.checkoutUrl','d.total_venta', 'd.tipo_venta','d.fecha_hora','d.purchaseNumber')
        ->where('d.idventa','=',$order)
        ->groupBy('d.idventa', 'd.checkoutUrl','d.total_venta', 'd.tipo_venta','d.fecha_hora','d.purchaseNumber')
        ->first();

        $detalles=DB::table('detalle_venta as d')
        ->join('searches as a','d.idarticulo','=','a.id')
        ->select('d.id_dventa','d.idventa', 'a.name as articulo','a.codigo as code','d.cantidad','d.precio_venta','a.image','d.idarticulo','d.valoracion' )
        ->where('d.idventa','=',$order)
        ->groupBy('d.id_dventa','d.idventa', 'articulo','code','d.cantidad','d.precio_venta' ,'a.image','d.idarticulo','d.valoracion' )
        ->get();

        $order = $detalles;
        $this->order = $order;
        $k = $this->order;
        $k->fecha = $venta->fecha_hora;
        $k->tipo_venta = $venta->tipo_venta;
        $k->checkout = $venta->checkoutUrl;
        $k->total = $venta->total_venta;
        $k->id= $id;
        $k->purchaseNumber = $venta->purchaseNumber;
        $this->order=$k;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail');
    }
}
