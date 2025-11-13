<?php

// database/migrations/2025_11_11_000001_create_index_images_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('index_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');        // nombre del archivo en image/index/
            $table->json('relacion')->nullable(); // array de IDs de Search (máx 3)
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->timestamps();

            $table->foreign('campaign_id')
                  ->references('id')
                  ->on('campaigns')
                  ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('index_images');
    }
};
