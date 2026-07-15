<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'oracle';

    protected $table = 'USERS';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'user_id', 'id');
    }

    public function isAdmin()
    {
        return strtolower($this->role) === 'admin';
    }

    public function isCustomer()
    {
        return strtolower($this->role) === 'customer';
    }
}