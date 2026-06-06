<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'role' => 'admin',
            'status' => 'aktif',
            'nama_lengkap' => 'Administrator Sistem',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'no_hp' => '081111111111',
        ]);

        User::create([
            'role' => 'pemilik',
            'status' => 'aktif',
            'nama_lengkap' => 'Budi Sudarsono',
            'nama_perusahaan_atau_usaha' => 'PT Iklan Nusantara',
            'username' => 'pemilik',
            'password' => Hash::make('password'),
            'no_hp' => '082222222222',
            'alamat' => 'Jl. Sudirman No. 10',
        ]);

        User::create([
            'role' => 'penyewa',
            'status' => 'aktif',
            'nama_lengkap' => 'Siti Aminah',
            'nama_perusahaan_atau_usaha' => 'Toko Kue Siti',
            'username' => 'penyewa',
            'password' => Hash::make('password'),
            'no_hp' => '083333333333',
            'alamat' => 'Jl. Merdeka No. 45',
        ]);
    }
}
