<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $table='tiendas';
    protected $primaryKey="id";
    public $timestamps= false;
    protected  $fillable = [
    'name',
    'portada',
    'marca1',
    'marca2',
    'marca3',
    'color'
     ];
    protected $guarded =[
    ];
}
