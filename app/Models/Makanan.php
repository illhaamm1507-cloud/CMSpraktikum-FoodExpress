<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    use HasFactory;

    protected $connection = 'oracle';

    protected $table = 'MAKANANS';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'NAMA_MAKANAN',
        'HARGA',
        'GAMBAR',
        'DESKRIPSI',
        'STOK',
        'KATEGORI_ID'
    ];

    public function kategori()
    {
        return $this->belongsTo(
            KategoriMakanan::class,
            'KATEGORI_ID',
            'id'
        );
    }
}