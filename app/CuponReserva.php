<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CuponReserva extends Model
{
    protected $table = 'cupon_reservas';
    public $timestamps = false;

    protected $fillable = [
        'cupon_id','user_id','session_id','ip','ua','estado',
        'reserved_at','expires_at','consumido_at','venta_id','descuento_aplicado'
    ];

    protected $casts = [
        'reserved_at' => 'datetime',
        'expires_at'  => 'datetime',
        'consumido_at'=> 'datetime',
    ];

    public function cupon(): BelongsTo {
        return $this->belongsTo(Cupon::class, 'cupon_id');
    }
}
