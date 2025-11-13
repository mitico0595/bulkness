<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personasub extends Model
{
    protected $table='detalle_cliente';
    
    public $timestamps= false;
    protected  $fillable = [
    'name',
    'email',
    'cumpleanos',
    'lastname',
    'dni',
    'cell',
    'direccion',
    'ciudad',
    'provincia',
    'distrito',
    'ganancia',
    'total',
    'conteog' 
     ];
    protected $guarded =[
    ];
}
