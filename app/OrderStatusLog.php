<?php
// app/OrderStatusLog.php
namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    protected $table = 'order_status_logs';
    protected $fillable = [
        'venta_id','domain','from_status','to_status','actor_type','actor_id','note','meta','occurred_at'
    ];
    protected $casts = [
        'meta' => 'array',
        'occurred_at' => 'datetime',
    ];
    public function venta() { return $this->belongsTo(Venta::class, 'venta_id', 'idventa'); }
}
