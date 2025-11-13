<?php

namespace App;

use App\Venta; // Asegúrate que tu modelo sea App\Venta
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Persona extends Authenticatable
{
    use Notifiable;

    protected $table   = 'personas';
    protected $fillable = [
        'name','lastname','email','dni','cell','direccion','ciudad','provincia','distrito',
        'password','type','ban','calificacion','cumpleanos','puntos',
        'verify','google_id','avatar','provider'
    ];

    protected $hidden = ['password','remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // Si tu columna cumpleanos es VARCHAR, lo dejo como string y lo parseo en getAge()
        // 'cumpleanos' => 'date', // usa esto solo si tu DB guarda una fecha válida
        'ban' => 'boolean',
        'type' => 'integer',
    ];

    // -------- Relaciones --------
    public function ventas()
{
    // FK en venta = iduser, clave local en personas = id
    return $this->hasMany(Venta::class, 'iduser', 'id');
}

    // -------- Scopes de búsqueda rápidos --------
    public function scopeLastname($q, $v){ if ($v) return $q->where('lastname','like',"%$v%"); }
    public function scopeEmail($q, $v){ if ($v) return $q->where('email','like',"%$v%"); }
    public function scopeDni($q, $v){ if ($v) return $q->where('dni','like',"%$v%"); }

    // -------- Utilidades --------
    public function getAge()
    {
        if (!$this->cumpleanos) return null;
        $bday = Carbon::parse($this->cumpleanos);
        $diff = $bday->diff(Carbon::now());
        return sprintf('%d años, %d meses y %d días', $diff->y, $diff->m, $diff->d);
    }

    public function getInitialsAttribute()
    {
        $a = mb_substr(trim((string)$this->name),0,1,'UTF-8');
        $b = mb_substr(trim((string)$this->lastname),0,1,'UTF-8');
        return mb_strtoupper($a.$b, 'UTF-8') ?: 'U';
    }

    public function getRoleLabelAttribute()
    {
        return [
            0 => 'Usuario',
            1 => 'Admin',
            2 => 'Almacén',
        ][$this->type] ?? 'Usuario';
    }

    public function getAvatarUrlAttribute()
    {
        // Si en el futuro guardas foto, retorna aquí su URL.
        // Por ahora devolvemos null para activar el fallback de iniciales en el Blade.
        return null;
    }
}
