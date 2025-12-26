<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. DATA ADMIN UTAMA
        // Menggunakan updateOrCreate agar email yang sama tidak menyebabkan error
        User::updateOrCreate(
            ['email' => 'admin@test.com'], // Kunci pencarian unik
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. DAFTAR KARYAWAN CABANG (BEKASI & CIKARANG)
        $karyawanData = [
            ['name' => 'Iqbal - Cabang Pilar', 'email' => 'iqbal@test.com'],
            ['name' => 'Tegar - Cabang Pilar', 'email' => 'tegar@test.com'],
            ['name' => 'Rendy - Cabang Mega Regency', 'email' => 'rendy@test.com'],
            ['name' => 'Mizy - Cabang Mega Regency', 'email' => 'mizy@test.com'],
            ['name' => 'Latif - Cabang Jababeka', 'email' => 'latif@test.com'],
            ['name' => 'Ari - Cabang Jababeka', 'email' => 'ari@test.com'],
            ['name' => 'Umar - Cabang Ciantra', 'email' => 'umar@test.com'],
            ['name' => 'Reza - Cabang Ciantra', 'email' => 'reza@test.com'],
        ];

        foreach ($karyawanData as $data) {
            // Logika Password: Nama depan huruf kecil + "2025"
            $namaDepan = strtolower(explode(' ', $data['name'])[0]);
            $passwordDefault = $namaDepan . "2025";

            User::updateOrCreate(
                ['email' => $data['email']], // Kunci pencarian unik
                [
                    'name' => $data['name'],
                    'password' => Hash::make($passwordDefault),
                    'role' => 'karyawan',
                ]
            );
        }
    }
}