<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MakananSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('MAKANANS')->insert([
            [
                'kategori_id' => 1,
                'nama_makanan' => 'Nasi Goreng',
                'harga' => 15000,
                'gambar' => null,
                'deskripsi' => 'Makanan enak dan murah',
                'stok' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori_id' => 2,
                'nama_makanan' => 'Es Teh Manis',
                'harga' => 5000,
                'gambar' => null,
                'deskripsi' => 'Minuman segar',
                'stok' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}