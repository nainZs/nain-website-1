<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$sections = [
    'potensi' => ['Potensi Desa', 'Kekayaan dan Potensi Desa Salam', 'Jelajahi potensi unggulan desa kami.'],
    'layanan' => ['Layanan Desa', 'Layanan untuk Warga', 'Informasi layanan publik Desa Salam.'],
    'berita' => ['Berita Desa', 'Informasi dan Kabar Desa Salam', 'Kabar terbaru dari Desa Salam.'],
    'umkm' => ['UMKM', 'Produk Unggulan Warga Salam', 'Kenali produk dan usaha warga Desa Salam.'],
    'galeri' => ['Galeri Desa', 'Kehidupan, Kegiatan dan Keindahan Desa Salam', 'Cerita Desa Salam dalam foto.'],
    'kegiatan' => ['Kegiatan Desa', 'Agenda dan Kegiatan Desa Salam', 'Kegiatan masyarakat dan pemerintahan desa.'],
];

Route::get('/', fn () => view('home'));

Route::get('/layanan/{slug}', function (string $slug) {
    $services = [
        'surat-keterangan' => ['Surat Keterangan', 'Ajukan surat keterangan sesuai kebutuhan administrasi Anda.'],
        'surat-domisili' => ['Surat Domisili', 'Informasi persyaratan pengurusan surat keterangan domisili.'],
        'surat-pengantar-ktp' => ['Surat Pengantar KTP', 'Informasi pengantar administrasi kependudukan.'],
        'surat-usaha' => ['Surat Usaha', 'Informasi pengurusan surat keterangan usaha.'],
        'pengaduan-warga' => ['Pengaduan Warga', 'Sampaikan aspirasi dan pengaduan kepada pemerintah desa.'],
        'info-dana-desa' => ['Info Dana Desa', 'Informasi transparansi dan penggunaan dana desa.'],
    ];
    abort_unless(isset($services[$slug]), 404);
    return view('detail', ['title' => $services[$slug][0], 'description' => $services[$slug][1], 'tag' => 'Pelayanan Publik']);
})->name('service.show');

Route::get('/berita/{slug}', fn (string $slug) => view('detail', ['title' => str($slug)->replace('-', ' ')->title(), 'description' => 'Informasi dan kabar terbaru dari Desa Salam.', 'tag' => 'Berita Desa']))->name('news.show');
Route::get('/umkm/{slug}', fn (string $slug) => view('detail', ['title' => str($slug)->replace('-', ' ')->title(), 'description' => 'Produk unggulan dan usaha masyarakat Desa Salam.', 'tag' => 'Produk Warga']))->name('umkm.show');
Route::get('/galeri/{slug}', fn (string $slug) => view('detail', ['title' => str($slug)->replace('-', ' ')->title(), 'description' => 'Dokumentasi kehidupan dan kegiatan Desa Salam.', 'tag' => 'Galeri Desa']))->name('gallery.show');
Route::post('/kontak', function (Request $request) {
    $data = $request->validate(['name' => 'required|string|max:120', 'email' => 'nullable|email|max:160', 'message' => 'required|string|max:2000']);
    \Illuminate\Support\Facades\DB::table('contact_messages')->insert([...$data, 'created_at' => now(), 'updated_at' => now()]);
    return back()->with('success', 'Terima kasih. Pesan Anda sudah kami terima.');
})->name('contact.store');

Route::get('/{section}', function (string $section) use ($sections) {
    abort_unless(isset($sections[$section]), 404);
    return view('listing', ['section' => $section, 'content' => $sections[$section]]);
})->whereIn('section', array_keys($sections));
