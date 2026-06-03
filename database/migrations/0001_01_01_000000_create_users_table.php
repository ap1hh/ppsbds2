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
    // 1. TABEL USERS (Kustomisasi sesuai ERD)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
        
            $table->enum('role', ['admin', 'pemilik', 'penyewa'])->default('penyewa');
            $table->enum('status', ['pending', 'aktif', 'ditolak'])->default('pending');
        
            $table->string('nama_lengkap');
            $table->string('nama_perusahaan_atau_usaha')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('no_hp');
            $table->text('alamat')->nullable();
            $table->string('foto_identitas_atau_legalitas')->nullable();
        
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Tetap butuh email untuk fitur reset password default jika nanti dipakai
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
