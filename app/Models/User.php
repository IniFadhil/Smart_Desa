<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HashId; // Asumsi Anda menggunakan trait ini

class User extends Authenticatable
{
    use HasFactory, Notifiable, HashId;

    /**
     * Menghubungkan model ini ke tabel 'ds_users'.
     */
    protected $table = 'ds_users';

    /**
     * Memberitahu Eloquent bahwa ID tidak auto-incrementing.
     */
    public $incrementing = false;

    /**
     * Tipe data dari primary key.
     */
    protected $keyType = 'string';

    /**
     * Kolom-kolom yang boleh diisi secara massal.
     */
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

    /**
     * Kolom-kolom yang disembunyikan.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Mengubah tipe data kolom.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
