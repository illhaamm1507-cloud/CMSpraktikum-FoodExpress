<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMakanan extends Model
{
    use HasFactory;

    protected $connection = 'oracle';

    protected $table = 'KATEGORI_MAKANAN';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'NAMA_KATEGORI'
    ];

    protected function setKeysForSaveQuery($query)
    {
    return $query->where('ID', $this->getAttribute('id'));
    }

    public function getKey()
    {
    return $this->getAttribute('id');
    }

    public function user()
    {
    return $this->belongsTo(
        User::class,
        'USER_ID',
        'id'
    );
    }

    public function makanans()
    {
        return $this->hasMany(
            Makanan::class,
            'KATEGORI_ID',
            'id'
    );

    }
}
