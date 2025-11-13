<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{   
    protected $table = 'searches';

    protected $fillable = [
        'idpersona','tipo','name','volumen','codigo','stock','categoria','image','thumb',
        'precio','costo','preciof','description','caracteristicas','caracteristicas2',
        'especificaciones','puntos','image1','image2','image3','impropio',
        'soli','fecha','preventa','preventab','oferta'
    ];

    protected $casts = [
        'caracteristicas2' => 'array',     // JSON
        'especificaciones' => 'array',     // JSON
        'precio' => 'decimal:2',
        'costo'  => 'decimal:2',
        'preciof'=> 'decimal:2',
        'preventa'=> 'decimal:2',
    ];
    
    public function scopeName($query, $name){
        if ($name) return $query->where('name','LIKE',"%$name%");
    }

    public function scopeCategoria($query, $categoria){
        if ($categoria) return $query->where('categoria','LIKE',"%$categoria%");
    }
}
