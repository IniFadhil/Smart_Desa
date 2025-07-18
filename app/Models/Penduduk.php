<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    // WAJIB: Menghubungkan ke tabel 'ds_penduduk'
    protected $table = 'ds_penduduk';

    // WAJIB: Beritahu Laravel bahwa tabel ini punya kolom created_at & updated_at
    public $timestamps = true;

    // Direkomendasikan: Tentukan kolom yang boleh diisi untuk keamanan
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'no_kk',
        'kk_level',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'pekerjaan',
        'status_kawin',
        'status_keluarga',
        'kewarganegaraan',
        'nama_ayah',
        'nama_ibu',
        'golongan_darah',
        'alamat_sekarang',
        'telepon',
        'email',
        'status_dasar',
        'status_rekam',
        'foto',
    ];
}
