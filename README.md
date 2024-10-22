# Wangkas

Wangkas adalah aplikasi pendataan uang kas yang dibuat menggunakan Framework Laravel 11 dan Fullstack Framework Livewire 3. Aplikasi ini dirancang untuk sistem pembayaran kas yang dilakukan satu kali setiap minggu, dan sangat cocok digunakan di lingkungan sekolah atau untuk masing-masing kelas.

## Demo

-   Demo Aplikasi (https://demo.wangkas.mrizkimaulidan.my.id/login)

## Prasyarat

Berikut beberapa hal yang perlu diinstal terlebih dahulu:

-   Composer (https://getcomposer.org/)
-   PHP ^8.2
-   MySQL 15.x
-   NodeJS ^20.x (https://nodejs.org/)
-   XAMPP (https://www.apachefriends.org/)

Jika Anda menggunakan XAMPP, PHP, dan MySQL sudah menjadi satu paket di dalam aplikasi XAMPP.

## Fitur

-   CRUD Pelajar
-   CRUD Kelas
-   CRUD Jurusan
-   Transaksi kas
-   Filter transaksi kas
-   CRUD Administrator
-   Pengaturan Profil

## Preview Gambar

**Tampilan Login**
![Image 1](https://i.imgur.com/XxHhqON.jpeg)

**Tampilan Dashboard**
![Image 2](https://i.imgur.com/22ytFSv.jpeg)

**Tampilan Pelajar**
![Image 3](https://i.imgur.com/DgT8SKQ.jpeg)

**Tampilan Kelas**
![Image 4](https://i.imgur.com/xYpzWtx.jpeg)

**Tampilan Jurusan**
![Image 5](https://i.imgur.com/1bBrBs4.jpeg)

**Tampilan Transaksi Kas Minggu Ini**
![Image 6](https://i.imgur.com/zgKq8Dt.jpeg)

**Tampilan Filter Transaksi Kas**
![Image 7](https://i.imgur.com/bNvjbWR.jpeg)

**Tampilan Administrator**
![Image 8](https://i.imgur.com/iXKQXzP.jpeg)

**Tampilan Pengaturan Profil**
![Image 9](https://i.imgur.com/Ocn0uGU.jpeg)

## Langkah-langkah Instalasi

1. Clone repository ini dengan memilih tipe protokol HTTPS atau SSH. Jika belum memiliki setup SSH, bisa menggunakan HTTPS.

**HTTPS:**

```bash
$ git clone https://github.com/mrizkimaulidan/wangkas.git
```

**SSH:**

```bash
$ git clone git@github.com:mrizkimaulidan/wangkas.git
```

2. Instal seluruh packages yang dibutuhkan.

```bash
$ npm install
```

```bash
$ composer install
```

3. Siapkan database dan atur value pada file `.env` sesuai dengan konfigurasi Anda.

```bash
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

4. Ubah value `APP_NAME=` pada file `.env` menjadi nama aplikasi yang Anda inginkan.

```bash
APP_NAME=
```

5. Ubah value `APP_TIMEZONE=` pada file `.env` menjadi lokasi Timezone Anda.

```bash
APP_TIMEZONE=
```

6. Migrate seluruh migrasi dan seeding data palsu.

```bash
$ php artisan migrate:fresh --seed
```

7. Jalankan local server Laravel.

```bash
$ php artisan serve
```

```bash
INFO  Server running on [http://127.0.0.1:8000].

Press Ctrl+C to stop the server
```

8. Jalankan juga development server untuk NPM.

```bash
$ npm run dev
```

```bash
> dev
> vite


  VITE v5.4.9  ready in 341 ms

  ➜  Local:   http://localhost:5173/
  ➜  Network: use --host to expose
  ➜  press h + enter to show help

  LARAVEL v11.28.1  plugin v1.0.5

  ➜  APP_URL: http://localhost

```

## User default aplikasi untuk login

```bash
Email   : admin@mail.com
Pass    : secret
```

## Dibuat dengan

-   Laravel 11 (https://laravel.com/)
-   Livewire 3 (https://livewire.laravel.com/)
-   Mazer Admin Dashboard (https://github.com/zuramai/mazer)
-   Bootstrap 5 (https://getbootstrap.com/)

## Kontribusi

Silakan request melalui kolom `Pull Requests` jika ingin melakukan kontribusi.

## Lisensi

Aplikasi ini boleh untuk dibagi dan diubah. Mohon tidak untuk diperjualbelikan!

Muhammad Rizki Maulidan - [@mrizkimaulidan](https://github.com/mrizkimaulidan)
