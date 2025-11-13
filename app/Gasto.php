<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $table='gasto';
    protected $primaryKey="id";
    protected  $fillable = [
    'idarticulo',
    'costo',
    'tipousd',
    'cantidad',
    'gasto_total',
    'created_at'
     ];
    protected $guarded =[
    ];
}
