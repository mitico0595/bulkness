<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    protected $table='ingresos';
    
    
    protected $primaryKey="id";
    protected  $fillable = [
    'iduser',
    'idtienda',
    'idarticulo',
    'cantidad',
    'precio_venta',
    'stock' 
     ]; 
    protected $guarded =[
    ];
}
