<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin
        $admin = User::create([
            'name' => 'Admin RT',
            'email' => 'admin@rt.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // Buat data warga untuk admin (opsional)
        Warga::create([
            'user_id' => $admin->id,
            'nik' => '1234567890123456',
            'no_rumah' => 'RT01/01',
            'alamat' => 'Jl. Contoh No. 1',
            'no_hp' => '081234567890',
            'status' => 'aktif'
        ]);

        // Buat beberapa anggota
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Anggota $i",
                'email' => "anggota$i@rt.com",
                'password' => Hash::make('password123'),
                'role' => 'anggota'
            ]);

            Warga::create([
                'user_id' => $user->id,
                'nik' => '123456789012345' . $i,
                'no_rumah' => 'RT01/0' . $i,
                'alamat' => 'Jl. Contoh No. ' . $i,
                'no_hp' => '08123456789' . $i,
                'status' => 'aktif'
            ]);
        }
    }
}