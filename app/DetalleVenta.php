<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_venta';
    protected $primaryKey = 'iddetalle'; // <- tu PK real
    public $timestamps = false;

    protected $fillable = [
        'idventa','idsub','idarticulo','qty','precio','subtotal','opinion','valoracion'
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'idventa', 'idventa');
    }

    public function articulo()
    {
        return $this->belongsTo(Search::class, 'idarticulo', 'id');
    }
}
