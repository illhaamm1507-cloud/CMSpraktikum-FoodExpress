<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $connection = 'oracle';

    protected $table = 'CARTS';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'USER_ID',
        'MAKANAN_ID',
        'QTY'
    ];

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('ID', $this->getAttribute('id'));
    }

    public function getKey()
    {
        return $this->getAttribute('id');
    }

    public function makanan()
    {
        return $this->belongsTo(
            Makanan::class,
            'MAKANAN_ID',
            'id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'USER_ID',
            'id'
        );
    }
}