<?php

// database/migrations/2025_10_09_000001_alter_ventas_for_statuses.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::table('venta', function (Blueprint $t) {
      $t->string('payment_status')->default('pending')->index();
      $t->string('fulfillment_status')->default('pending')->index();
      $t->string('fulfillment_method')->default('delivery'); // o 'pickup'
      $t->timestamp('paid_at')->nullable();
      $t->timestamp('ready_at')->nullable();
      $t->timestamp('shipped_at')->nullable();
      $t->timestamp('delivered_at')->nullable();
      $t->timestamp('cancelled_at')->nullable();
    });
  }
  public function down() {
    Schema::table('venta', function (Blueprint $t) {
      $t->dropColumn([
        'payment_status','fulfillment_status','fulfillment_method',
        'paid_at','ready_at','shipped_at','delivered_at','cancelled_at'
      ]);
    });
  }
};
