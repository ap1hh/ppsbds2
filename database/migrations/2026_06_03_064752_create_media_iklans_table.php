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
        Schema::create('media_iklans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilik_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_lokasi');
            $table->enum('jenis', ['reklame', 'videotron']);
            $table->integer('kapasitas_slot');
            $table->text('keterangan')->nullable();
            $table->text('alamat_lokasi');
            $table->enum('status_ketersediaan', ['tersedia', 'penuh'])->default('tersedia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_iklans');
    }
};
