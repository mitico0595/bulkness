<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cupones', function (Blueprint $t) {
            $t->id();
            $t->string('codigo', 50)->unique();          // p.ej. ADLER20
            $t->string('nombre', 100)->nullable();       // descriptivo
            $t->enum('tipo', ['percent', 'fixed']);      // percent = % ; fixed = monto fijo
            $t->unsignedInteger('valor');                // si percent: 1..100 ; si fixed: centavos
            $t->unsignedInteger('emitidos')->default(0); // stock total disponible
            $t->unsignedInteger('reclamados')->default(0); // usos consumidos (ventas)
            $t->unsignedInteger('por_usuario')->default(1); // límite por usuario
            $t->unsignedInteger('min_subtotal')->nullable(); // centavos mínimos de compra
            $t->boolean('aplica_solo_subtotal')->default(true); // excluye envío
            $t->boolean('activo')->default(true);
            $t->timestamp('inicia_at')->nullable();
            $t->timestamp('caduca_at')->nullable();
            $t->unsignedInteger('duracion_minutos')->default(20); // ventana de reserva
            $t->text('notas')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('cupones');
    }
};
