<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['Surat Keterangan', 'surat-keterangan'], ['Surat Domisili', 'surat-domisili'], ['Surat Pengantar KTP', 'surat-pengantar-ktp'],
            ['Surat Usaha', 'surat-usaha'], ['Pengaduan Warga', 'pengaduan-warga'], ['Info Dana Desa', 'info-dana-desa'],
        ] as $index => [$title, $slug]) {
            DB::table('services')->updateOrInsert(['slug' => $slug], ['title' => $title, 'description' => "Informasi layanan {$title} Desa Salam.", 'sort_order' => $index, 'published' => true, 'updated_at' => now(), 'created_at' => now()]);
        }
        foreach ([
            ['Berita', 'Musyawarah Desa Salam Bahas Rencana Pembangunan', 'niels-baars-9ATKh7LzkEI-unsplash.jpg'],
            ['UMKM', 'Keripik Singkong Bu Sriati', 'ChatGPT Image Sep 19, 2026, 07_43_01 PM.png'],
        ] as [$type, $title, $image]) {
            DB::table('posts')->updateOrInsert(['slug' => str($title)->slug()], ['type' => $type, 'title' => $title, 'excerpt' => 'Konten contoh untuk pengembangan website Desa Salam.', 'image' => $image, 'published_at' => now()->toDateString(), 'published' => true, 'updated_at' => now(), 'created_at' => now()]);
        }
    }
}
