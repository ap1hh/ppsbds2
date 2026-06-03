<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paket_hargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_iklan_id')->constrained('media_iklans')->cascadeOnDelete();
            $table->string('nama_paket');
            $table->integer('durasi_hari');
            $table->integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_hargas');
    }
};
