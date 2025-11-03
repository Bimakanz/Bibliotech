# Bibliotech — School Library Management

**Bibliotheck** adalah aplikasi perpustakaan sekolah berbasis Laravel 12 dengan arsitektur multi-peran. Versi terbaru ini menghadirkan perubahan identitas penuh sekaligus pembaruan antarmuka secara menyeluruh dengan palet hangat, tata letak baru, dan pengalaman pengguna yang lebih editorial.

## Fitur Utama

- **Autentikasi Berbasis Peran** – Admin dan siswa mendapatkan alur kerja yang berbeda, dibangun menggunakan Laravel Breeze.
- **Manajemen Koleksi** – CRUD buku, unggah sampul, pengaturan kategori, dan monitoring stok secara real-time.
- **Kontrol Peminjaman** – Admin dapat memproses status _processing_, _borrowed_, hingga _returned_ tanpa meninggalkan halaman.
- **Katalog Publik Modern** – Landing page baru dengan pencarian adaptif, kartu buku bergaya editorial, dan CTA yang jelas.
- **Form Peminjaman Dinamis** – Validasi stok otomatis dengan pengalaman form baru yang ringkas untuk siswa.
- **Dashboard Modular** – Statistik utama dipresentasikan dengan kartu warna-warni yang mudah dipindai.

## Screenshot

Lihat folder `screenshots/` untuk pratinjau tampilan terbaru Bibliotheck.

## Teknologi

- Laravel 12 + PHP 8.2
- Laravel Breeze (Blade + TailwindCSS)
- TailwindCSS + Vite
- SQLite (default) / MySQL
- PHPUnit & Pest

## Instalasi Cepat

```bash
git clone https://github.com/username/bibliotheck.git
cd bibliotheck

composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed

npm install
npm run dev  # atau npm run build untuk produksi

php artisan serve
```

### Kredensial Default

| Peran | Username | Password   |
| ----- | -------- | ---------- |
| Admin | `admin`  | `password` |

## Testing

```bash
php artisan test
```

## Kontribusi

Temukan bug atau ingin mengusulkan peningkatan? Buat _issue_ atau _pull request_ di repository ini.

— Selamat datang di Bibliotheck. Semoga pustaka digital sekolahmu semakin hidup!
