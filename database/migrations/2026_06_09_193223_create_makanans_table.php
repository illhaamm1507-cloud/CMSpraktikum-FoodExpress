<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('makanans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kategori_id')
                  ->constrained('KATEGORI_MAKANAN')
                  ->cascadeOnDelete();

            $table->string('nama_makanan');
            $table->integer('harga');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('stok');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('makanans');
    }
};