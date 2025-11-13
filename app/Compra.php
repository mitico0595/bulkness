<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'idcompra';

    protected $fillable = [
        'codigo','user_id','proveedor','fecha',
        'subtotal','impuesto','total',
        'factura_numero','factura_path'
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function detalles(){
        return $this->hasMany(CompraDetalle::class, 'idcompra', 'idcompra')->with('producto');
    }

    public function getItemsCountAttribute(){
        return $this->detalles()->count();
    }
    public function getRouteKeyName()
        {
            return 'idcompra';
        }
}
