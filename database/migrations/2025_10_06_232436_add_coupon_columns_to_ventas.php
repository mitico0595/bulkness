<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('ventas', function (Blueprint $t) {
            $t->unsignedBigInteger('coupon_id')->nullable()->after('total_venta');
            $t->string('coupon_code', 50)->nullable()->after('coupon_id');
            $t->unsignedInteger('discount_cents')->default(0)->after('coupon_code');
        });
    }
    public function down(): void {
        Schema::table('ventas', function (Blueprint $t) {
            $t->dropColumn(['coupon_id','coupon_code','discount_cents']);
        });
    }
};