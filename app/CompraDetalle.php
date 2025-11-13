<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    protected $table = 'compra_detalles';
    protected $primaryKey = 'iddetalle';

    protected $fillable = ['idcompra','search_id','qty','costo','subtotal'];

    public function compra(){
        return $this->belongsTo(Compra::class, 'idcompra', 'idcompra');
    }

    public function producto(){
        // Tu modelo de producto se llama Search
        return $this->belongsTo(\App\Search::class, 'search_id', 'id');
    }
}
