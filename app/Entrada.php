<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table='entrada';
    protected $primaryKey="id";

    protected  $fillable = [

    'detalle',
    'monto'

     ];
    protected $guarded =[
    ];
}
