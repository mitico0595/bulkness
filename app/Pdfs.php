<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pdfs extends Model
{
    protected $table='pdf';
    protected $primaryKey="id";
    protected  $fillable = [
    'idtienda',
    'titulo',
    'name'
     ];
    protected $guarded =[
    ];
}
