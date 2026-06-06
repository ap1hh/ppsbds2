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
        $table->string('order_id')->nullable(); 
        $table->integer('total_harga');
        $table->string('payment_url')->nullable();
        $table->string('payment_method')->nullable();
        $table->enum('status_pembayaran', ['pending', 'success', 'expired', 'failed'])->default('pending');
        $table->timestamp('tanggal_pengajuan')->useCurrent();
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
