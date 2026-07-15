 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('KATEGORI_MAKANAN', function (Blueprint $table) {
    $table->id();
    $table->string('nama_kategori');
    $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_makanans');
    }
};