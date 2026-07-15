<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $connection = 'oracle';
    protected $table = 'PESANANS';
    protected $primaryKey = 'id';

    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

   protected $fillable = [
    'USER_ID',
    'NAMA_PEMESAN',
    'TANGGAL_PESAN',
    'TOTAL_HARGA',
    'METODE_PEMBAYARAN',
    'STATUS',
];

protected $casts = [
    'TANGGAL_PESAN' => 'datetime',
];

public function user()
{
    return $this->belongsTo(User::class, 'USER_ID', 'ID');
}

}
