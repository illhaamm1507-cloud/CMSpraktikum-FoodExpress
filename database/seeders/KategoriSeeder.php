<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('KATEGORI_MAKANAN')->insert([
            ['nama_kategori' => 'Makanan Berat'],
            ['nama_kategori' => 'Minuman'],
            ['nama_kategori' => 'Snack']
        ]);
    }
}
