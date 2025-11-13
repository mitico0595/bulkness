<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventamensual extends Model
{
    protected $table='venta_mensual';
    
    public $timestamps= false;
    protected  $fillable = [
    'mes',
    'ventas'
     ];
    protected $guarded =[
    ];
}
