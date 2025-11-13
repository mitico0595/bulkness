<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table='detalle';
    protected $primaryKey="id_dventa";
    public $timestamps= false;
    protected  $fillable = [

    'id_pedido',
    'idarticulo',
    'cantidad',
    'precio_venta',
    'subtotal'

     ];
    protected $guarded =[
    ];
}
