# Website Desa Salam

Implementasi Laravel awal berdasarkan screenshot Figma Desa Salam yang tersedia. Palet hijau tua dan krem, aksen emas, kartu konten, galeri, serta navigasi responsif mengikuti desain desktop.

## Menjalankan di lokal

Persyaratan: PHP 8.3+, Composer, dan ekstensi SQLite PDO aktif. Node.js tidak diperlukan untuk stylesheet yang sekarang digunakan.

```powershell
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Buka `http://127.0.0.1:8000`.

## Halaman

- `/` beranda Desa Salam
- `/potensi`, `/layanan`, `/berita`, `/umkm`, `/galeri`, `/kegiatan`
- `/layanan/{slug}`, `/berita/{slug}`, `/umkm/{slug}`, `/galeri/{slug}`
- Form pesan di bagian bawah beranda; data disimpan ke `contact_messages`.

Konten kartu berita/produk pada beranda masih contoh desain. Beberapa angka profil penduduk di screenshot dipertahankan sebagai data contoh desain dan perlu diverifikasi pemerintah desa. Belum ada desain admin pada aset yang diberikan; sistem admin CMS tidak termasuk implementasi ini.

Screenshot desain ada di `Desain Figma/`, foto tersedia di `public/`.
