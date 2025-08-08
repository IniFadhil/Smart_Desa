<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HashId;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HashId;

    protected $table = 'ds_users';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'desa_id',
        'nama_lengkap',
        'nik',
        'email',
        'password',
        'no_telpon',
        'alamat',
        'api_token',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}