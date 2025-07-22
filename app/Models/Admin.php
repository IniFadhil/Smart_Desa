<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use App\Traits\HashId; // Pastikan Trait ini ada dan berfungsi dengan baik

class Admin extends Authenticatable
{
    use Notifiable, HashId, HasFactory;

    protected $table = 'ds_admins';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    /**
     * INI ADALAH BAGIAN PALING PENTING UNTUK LARAVEL 12
     * Memberi tahu Laravel bahwa kolom 'password' harus di-hash secara otomatis.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // <-- WAJIB ADA
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'ds_admin_roles', 'admin_id', 'role_id');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }

    public function isSuperUser(): bool
    {
        return $this->roles()->where('id', 'su')->exists();
    }
}
