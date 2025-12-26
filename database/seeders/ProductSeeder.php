<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->truncate();
        
        $path = base_path("database/seeders/products.csv");
        if (!file_exists($path)) {
            $this->command->error("File CSV tidak ditemukan!"); return;
        }

        // Baca seluruh isi file sebagai array
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        // Deteksi Pemisah (Cek baris pertama)
        $delimiter = (substr_count($lines[0], ';') > substr_count($lines[0], ',')) ? ";" : ",";
        $this->command->info("Menggunakan pemisah: " . $delimiter);

        foreach ($lines as $index => $line) {
            // Lewati baris judul (Header)
            if ($index == 0) continue;

            $data = str_getcsv($line, $delimiter);

            // Cek apakah data rusak/kosong
            if (count($data) < 3) continue;

            // --- LOGIKA DETEKSI KOLOM ---
            // Jika kolomnya ada 5 (berarti ada NOMOR di depan)
            if (count($data) >= 5) {
                $name     = $data[1]; // Kolom B
                $category = $data[2]; // Kolom C
                $priceRaw = $data[3]; // Kolom D
                $image    = $data[4]; // Kolom E
            } 
            // Jika kolomnya ada 4 (berarti TIDAK ADA NOMOR)
            else {
                $name     = $data[0]; // Kolom A
                $category = $data[1]; // Kolom B
                $priceRaw = $data[2]; // Kolom C
                $image    = $data[3] ?? null; // Kolom D (jaga-jaga kalau kosong)
            }

            // Bersihkan Harga (Hapus Rp, Titik, Koma, Spasi)
            $price = preg_replace('/[^0-9]/', '', $priceRaw);

            // Masukkan Database
            DB::table('products')->insert([
                'name'       => $name,
                'category'   => $category,
                'price'      => $price,
                'image'      => $image,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        $this->command->info("Sukses! Data berhasil masuk.");
    }
}