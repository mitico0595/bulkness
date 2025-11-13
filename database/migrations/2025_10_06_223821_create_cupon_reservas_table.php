<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cupon_reservas', function (Blueprint $t) {
            $t->id();
            $t->foreignId('cupon_id')->constrained('cupones')->cascadeOnDelete();
            $t->unsignedBigInteger('user_id')->nullable(); // por si está logeado
            $t->string('session_id', 120);                 // amarra al carrito actual
            $t->string('ip', 45)->nullable();
            $t->string('ua', 255)->nullable();

            $t->enum('estado', ['reservado','consumido','liberado','expirado'])->default('reservado');
            $t->timestamp('reserved_at')->useCurrent();
            $t->timestamp('expires_at');
            $t->timestamp('consumido_at')->nullable();
            $t->unsignedBigInteger('venta_id')->nullable(); // idventa cuando se consuma
            $t->unsignedInteger('descuento_aplicado')->nullable(); // centavos sobre subtotal al reservar (opcional/log)

            $t->index(['cupon_id','estado']);
            $t->index('expires_at');
            $t->index(['session_id','cupon_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('cupon_reservas');
    }
};