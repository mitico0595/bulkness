<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $table='salida';
    protected $primaryKey="id";

    protected  $fillable = [

    'detalle',
    'monto'

     ];
    protected $guarded =[
    ];
}
