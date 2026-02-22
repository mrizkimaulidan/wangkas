# Wangkas

Wangkas adalah aplikasi pendataan uang kas berbasis web yang dibangun dengan Laravel 12 dan Livewire 4. Aplikasi ini dirancang khusus untuk memudahkan pencatatan pembayaran kas mingguan di lingkungan sekolah atau perkelas. Dengan antarmuka yang intuitif dan fitur lengkap, Wangkas membantu bendahara kelas atau sekolah dalam mengelola keuangan kas dengan lebih efisien.

## Fitur Aplikasi

### Manajemen Master Data

- CRUD Jurusan
- CRUD Kelas
- CRUD Pelajar

### Manajemen Transaksi Kas

- Transaksi Kas Mingguan
- Rekapitulasi Kas

### Manajamen Pengguna

- CRUD Administrator
- Profil Pengguna

## Preview Aplikasi

**Halaman Login**
![Login](https://i.imgur.com/nlYUpAF.jpeg)

**Halaman Dashboard**
![Dashboard](https://i.imgur.com/auPa2aZ.jpeg)

**Halaman Daftar Pelajar**
![Pelajar](https://i.imgur.com/H9MRHey.jpeg)

**Halaman Daftar Kelas**
![Kelas](https://i.imgur.com/80BQUbz.jpeg)

**Halaman Daftar Jurusan**
![Jurusan](https://i.imgur.com/McEXvnO.jpeg)

**Halaman Kas Mingguan**
![Kas](https://i.imgur.com/w5tuB9A.jpeg)

**Halaman Tambah Kas**
![Tambah Kas](https://i.imgur.com/YfuEh3K.jpeg)

**Halaman Daftar Pengguna**
![Pengguna](https://i.imgur.com/iQiekwB.jpeg)

**Halaman Pengaturan Profil**
![Pengaturan Profil](https://i.imgur.com/ZEZgIr9.jpeg)

## Prasyarat Sistem

Pastikan sistem Anda memenuhi spesifikasi berikut:

| Komponen | Versi Minimal |
|---|---|
| PHP | ^8.2 |
| Composer | ^2.0 |
| Node.js | ^20.x |
| NPM | ^10.x |
| MySQL | 15.x |
| Web Server | Apache/Nginx |

Jika Anda menggunakan XAMPPs komponen seperti PHP dan MySQL sudah menjadi satu paket di dalam aplikasi XAMPPs.

## Langkah Instalasi

### Langkah 1: Clone Repository

```bash
$ git clone https://github.com/mrizkimaulidan/wangkas.git

# Masuk ke direktori project
$ cd wangkas
```

### Langkah 2: Install Dependencies

```bash
# Install PHP dependencies
$ composer install

# Install JavaScript dependencies
$ npm install
```

### Langkah 3: Konfigurasi Environment

Copy dan rename file `.env.example` menjadi `.env`. Lalu generate application key

```bash
# Generate application key
$ php artisan key:generate
```

### Langkah 4: Setup Database

1. Buat database baru di MySQL
2. Edit file `.env` sesuaikan dengan konfigurasi Anda

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

APP_NAME="Wangkas"
APP_TIMEZONE=Asia/Jakarta
```

### Langkah 5: Migrasi dan Seeding

```bash
# Jalankan migrasi dan seeder
php artisan migrate:fresh --seed
```

### Langkah 6: Jalankan Aplikasi

Terminal 1 - Laravel Server:

```bash
$ php artisan serve
```

```bash
INFO  Server running on [http://127.0.0.1:8000].

Press Ctrl+C to stop the server
```

Akses: `http://127.0.0.1:8000/`

Terminal 2 - Vite Server:

```bash
$ npm run dev
```

```bash
VITE v7.3.1  ready in 349 ms

  ➜  Local:   http://localhost:5173/
  ➜  Network: use --host to expose
  ➜  press h + enter to show help

  LARAVEL v12.52.0  plugin v2.1.0

  ➜  APP_URL: http://localhost
```

## Akun Default

Setelah instalasi selesai, Anda dapat login menggunakan akun berikut:

```bash
Email       : admin@mail.com
Password    : secret
```

## Teknologi Yang Digunakan

<p align="center"> <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel" alt="Laravel"></a> <a href="https://livewire.laravel.com"><img src="https://img.shields.io/badge/Livewire-4.x-FB70A9?style=flat-square&logo=livewire" alt="Livewire"></a> <a href="https://getbootstrap.com"><img src="https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=flat-square&logo=bootstrap" alt="Bootstrap"></a> <a href="https://github.com/zuramai/mazer"><img src="https://img.shields.io/badge/Mazer-Admin_Template-ff69b4?style=flat-square" alt="Mazer"></a> <a href="https://vitejs.dev"><img src="https://img.shields.io/badge/Vite-Build_Tool-646CFF?style=flat-square&logo=vite" alt="Vite"></a> <a href="https://www.mysql.com"><img src="https://img.shields.io/badge/MySQL-15.x-4479A1?style=flat-square&logo=mysql" alt="MySQL"></a> </p>

## Lisensi

Aplikasi ini boleh untuk dibagi dan diubah. Mohon tidak untuk diperjualbelikan!

Hak Cipta © 2026 - Muhammad Rizki Maulidan

<a href="https://opensource.org/licenses/MIT"> <img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="MIT License"> </a>
