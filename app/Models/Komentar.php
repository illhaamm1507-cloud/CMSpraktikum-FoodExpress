<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $connection = 'oracle';

    protected $table = 'KOMENTARS';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'USER_ID',
        'KOMENTAR',
        'RATING'
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'USER_ID',
            'id'
        );
    }
}