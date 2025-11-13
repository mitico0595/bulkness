<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('personas', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique()->after('verify');
            $table->string('avatar')->nullable()->after('google_id');
            $table->string('provider')->nullable()->after('avatar'); // opcional
        });
    }
    public function down() {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropColumn(['google_id','avatar','provider']);
        });
    }
};
