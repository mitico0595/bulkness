<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Cupon extends Model
{
    protected $table = 'cupones';
    protected $fillable = [
        'codigo','nombre','tipo','valor','emitidos','reclamados','por_usuario',
        'min_subtotal','aplica_solo_subtotal','activo','inicia_at','caduca_at',
        'duracion_minutos','notas'
    ];
    protected $casts = [
        'activo' => 'boolean',
        'aplica_solo_subtotal' => 'boolean',
        'inicia_at' => 'datetime',
        'caduca_at' => 'datetime',
    ];

    public function reservas(): HasMany {
        return $this->hasMany(CuponReserva::class, 'cupon_id');
    }

    public function activosReservados(): int {
        return (int) $this->reservas()
            ->where('estado','reservado')
            ->where('expires_at','>', now())
            ->count();
    }

    public function disponibles(): int {
        // emitidos - consumidos finales - reservas activas
        return max(0, (int)$this->emitidos - (int)$this->reclamados - $this->activosReservados());
    }

    public function ventanaActivaAhora(): bool {
        $now = now();
        if (!$this->activo) return false;
        if ($this->inicia_at && $now->lt($this->inicia_at)) return false;
        if ($this->caduca_at && $now->gt($this->caduca_at)) return false;
        return true;
    }

    public function calcularDescuento(int $subtotalCentavos): int {
        if ($subtotalCentavos <= 0) return 0;
        if ($this->tipo === 'percent') {
            $pct = min(max((int)$this->valor, 0), 100);
            return (int) floor($subtotalCentavos * $pct / 100);
        }
        // fixed
        return min((int)$this->valor, $subtotalCentavos);
    }
}
