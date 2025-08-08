<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BumdesController extends Controller
{
    public function produk()
    {
        // Data disederhanakan sesuai permintaan
        $produks = collect([
            (object)[
                'gambar' => 'https://placehold.co/600x400/a7f3d0/166534?text=Keripik+Singkong',
                'nama' => 'Keripik Singkong Gurih',
                'deskripsi' => 'Keripik singkong renyah dengan bumbu balado asli, cocok untuk teman santai.',
            ],
            (object)[
                'gambar' => 'https://placehold.co/600x400/a7f3d0/166534?text=Batik+Subang',
                'nama' => 'Batik Tulis Khas Subang',
                'deskripsi' => 'Kain batik tulis dengan motif nanas yang menjadi ikon Subang, dibuat oleh pengrajin lokal.',
            ],
            (object)[
                'gambar' => 'https://placehold.co/600x400/a7f3d0/166534?text=Madu+Murni',
                'nama' => 'Madu Hutan Asli',
                'deskripsi' => 'Madu murni dari lebah hutan di perbukitan Subang, kaya akan manfaat kesehatan.',
            ],
        ]);

        return view('frontend.bumdes.produk', compact('produks'));
    }
    public function profil()
    {
        // Nanti, data ini bisa Anda ambil dari database
        $profil = (object) [
            'nama' => 'BUMDES DESA SUKAMANDI',
            'sejarah' => 'Berdiri sejak tahun 2018, BUMDES Jaya Makmur didirikan dengan semangat untuk memajukan perekonomian Desa Subang melalui pengelolaan potensi lokal. Kami berfokus pada pengembangan produk pertanian, kerajinan tangan, dan jasa pariwisata untuk meningkatkan kesejahteraan masyarakat.',
            'visi' => 'Menjadi pilar utama dalam kemandirian ekonomi desa yang berdaya saing, inovatif, dan berkelanjutan.',
            'misi' => [
                'Mengelola dan mengembangkan potensi sumber daya alam desa secara optimal.',
                'Meningkatkan keterampilan dan partisipasi masyarakat dalam kegiatan ekonomi.',
                'Menciptakan produk dan jasa unggulan yang memiliki nilai jual tinggi.',
                'Menjalin kemitraan strategis dengan berbagai pihak untuk memperluas pasar.'
            ],
            'struktur' => [
                'Ketua' => 'Bapak Budi Santoso',
                'Sekretaris' => 'Ibu Siti Aminah',
                'Bendahara' => 'Bapak Agus Wijoyo',
                'Manajer Unit Usaha' => 'Saudara Deden Kurniawan'
            ]
        ];

        return view('frontend.bumdes.profil', compact('profil'));
    }
}
