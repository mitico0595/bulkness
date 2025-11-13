<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 
use App\Shipment;

class Venta extends Model
{
    protected $table = 'venta';
    protected $primaryKey = 'idventa';
    public $timestamps = true;

    protected $fillable = [
        'iduser','codigo','subtotal','total_venta','tipo','cargo_envio','detalle','fecha_hora',
        'nombre','email','user-mail','apellido','domicilio','celular','distrito','provincia',
        'departamento','dni','referencia',
        // nuevos:
        'payment_status','fulfillment_status','fulfillment_method',
        'paid_at','ready_at','shipped_at','delivered_at','cancelled_at',
    ];

    // si 'detalle' guarda JSON, te conviene:
    protected $casts = [
        'fecha_hora' => 'datetime',
        'paid_at' => 'datetime',
        'ready_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    // ANTES: public function detalle() { ... }
    public function detalle()     { return $this->hasMany(DetalleVenta::class, 'idventa', 'idventa'); }
    public function shipments()     {  return $this->hasMany(Shipment::class, 'venta_id', 'idventa');  }
    public function statusLogs()     {  return $this->hasMany(OrderStatusLog::class, 'venta_id', 'idventa'); }
    public function lineas(){  return $this->hasMany(DetalleVenta::class, 'idventa', 'idventa');}
    public function latestShipment(){   return $this->hasOne(Shipment::class, 'venta_id', 'idventa')->latestOfMany();      }
    public function transitionFulfillment(string $to, ?Model $actor = null, ?string $note = null): void
    {
        $allowed = [
            'pending'          => ['ready_for_pickup','ready_to_ship','cancelled'],
            'ready_for_pickup' => ['delivered','cancelled'],
            'ready_to_ship'    => ['in_transit','cancelled'],
            'in_transit'       => ['delivered','returned','cancelled'],
            'delivered'        => [],
            'cancelled'        => [],
            'returned'         => [],
        ];

        $from = $this->fulfillment_status ?? 'pending';
        if (!in_array($to, $allowed[$from] ?? [], true)) {
            throw new \DomainException("Transición no permitida: $from → $to");
        }

        DB::transaction(function () use ($from, $to, $actor, $note) {
            $this->fulfillment_status = $to;
            if ($to === 'ready_for_pickup') { $this->ready_at = now();}if ($to === 'ready_to_ship') {  $this->ready_at = now(); }

            if ($to === 'in_transit') $this->shipped_at = now();
            if ($to === 'delivered')  $this->delivered_at = now();
            if ($to === 'cancelled')  $this->cancelled_at = now();
            $this->save();
            if ($to === 'ready_for_pickup') {
                $this->ensureShipmentForPickup(); // crea/asegura el shipment de RECOJO
            }

            if ($to === 'ready_to_ship') {
                $this->ensureShipment();
            }    
            try {
        if (method_exists($this, 'statusLogs')) {
            $this->statusLogs()->create([
                'domain'      => 'fulfillment',
                'from_status' => $from,
                'to_status'   => $to,
                'actor_type'  => $actor?->getMorphClass(),
                'actor_id'    => $actor?->getKey(),
                'note'        => $note,
                'occurred_at' => now(),
                'meta'        => null,
            ]);
        }
        } catch (\Throwable $e) {
            \Log::warning('No se pudo guardar status log', ['venta'=>$this->idventa,'err'=>$e->getMessage()]);
        }

        });
    }
    public function ensureShipment(): Shipment{
    if ($ex = $this->shipments()->first()) return $ex;

    $addr = [
        'address'      => $this->domicilio,
        'distrito'     => $this->distrito,
        'provincia'    => $this->provincia,
        'departamento' => $this->departamento,
        'name'         => trim(($this->nombre ?? '').' '.($this->apellido ?? '')),
        'email'        => $this->email,
        'dni'          => $this->dni,
        'phone'        => $this->celular,
    ];

    return $this->shipments()->create([
        'status'          => 'label_created',
        'carrier'         => null,
        'service'         => null,
        'tracking_number' => null,
        'tracking_url'    => null,
        'shipping_cost'   => $this->cargo_envio ?? 0,
        'weight_kg'       => null,
        'address_to'      => $addr,
        'shipped_at'      => null,
        'delivered_at'    => null,
    ]);
    }
    public function ensureShipmentForPickup(): Shipment
    {
        // Si ya existe un shipment de pickup (o ya entregado), reusar
        if ($ex = $this->shipments()->whereIn('status', ['pickup_ready','delivered'])->first()) {
            return $ex;
        }

        $addr = [
            'address'      => $this->domicilio,
            'distrito'     => $this->distrito,
            'provincia'    => $this->provincia,
            'departamento' => $this->departamento,
            'name'         => trim(($this->nombre ?? '').' '.($this->apellido ?? '')),
            'email'        => $this->email,
            'dni'          => $this->dni,
            'phone'        => $this->celular,
        ];

        return $this->shipments()->create([
            'status'          => 'pickup_ready', // ← clave azul
            'carrier'         => null,
            'service'         => 'recojo',
            'tracking_number' => null,
            'tracking_url'    => null,
            'shipping_cost'   => 0,
            'weight_kg'       => null,
            'address_to'      => $addr,
            'shipped_at'      => null,
            'delivered_at'    => null,
        ]);
    }

}
