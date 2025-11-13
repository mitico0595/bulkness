<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table='ganan';
    
    public $timestamps= false;
    protected  $fillable = [
    'fecha',
    'ganancia'
    
     ]; 
    protected $guarded =[
    ];

}
