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
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyewa_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('media_iklan_id')->constrained('media_iklans')->cascadeOnDelete();
            $table->foreignId('paket_harga_id')->constrained('paket_hargas')->cascadeOnDelete();
        
            $table->string('nama_produk_usaha');
            $table->string('kategori_produk');
            $table->string('file_materi_iklan');
            $table->text('catatan_tambahan')->nullable();
        
            $table->integer('total_harga');
            $table->string('order_id')->nullable();
            $table->string('payment_url')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('status_pembayaran', ['pending', 'success', 'expired', 'failed'])->default('pending');
        
            $table->timestamp('tanggal_pengajuan')->useCurrent();
            $table->date('tanggal_mulai_tayang')->nullable();
            $table->date('tanggal_selesai_tayang')->nullable();
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'aktif', 'selesai'])->default('pending');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};
