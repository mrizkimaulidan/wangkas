# WANGKAS

Aplikasi pendataan uang kas dibuat dengan Framework Laravel 8. Dengan sistem pembayaran kas sekali selama seminggu. Aplikasi ini cocok untuk digunakan untuk di sekolah atau masing masing kelas. <br>

Beberapa CRUD menggunakan modal dan AJAX untuk pengambilan data agar mengurangi penggunaan pindah halaman. Dan seluruh menu menggunakan DataTable Server Side Processing.

### Prasyarat

Berikut beberapa hal yang perlu diinstal terlebih dahulu:

-   Composer (https://getcomposer.org/)
-   PHP 8.x
-   MySQL 15.x
-   XAMPP

Jika Anda menggunakan XAMPP, untuk PHP dan MySQL sudah menjadi 1 (bundle) didalam aplikasi XAMPP.

### Fitur

-   CRUD Data Siswa
-   CRUD Data Kelas
-   CRUD Data Jurusan
-   CRUD Data Transaksi Uang Kas
-   CRUD Data Administrator
-   Laporan

### Preview Gambar

_Login_
![Login](https://i.imgur.com/roFkqZM.png)

_Dashboard_
![Dashboard](https://i.imgur.com/TVBKaxK.png)

_Daftar Pelajar_
![Daftar Pelajar](https://i.imgur.com/esVc0GZ.png)

_Daftar Kelas_
![Daftar Kelas](https://i.imgur.com/D1AlY45.png)

_Daftar Jurusan_
![Daftar Jurusan](https://i.imgur.com/KFuPEnn.png)

_Daftar Kas_
![Daftar Kas](https://i.imgur.com/4yr5Sja.png)

![Filter Kas](https://i.imgur.com/ejffRnV.png)

_Laporan_
![Laporan](https://i.imgur.com/3yziMLW.png)

_Daftar Administrator_
![Daftar Administrator](https://i.imgur.com/pmsu7tF.png)

### Langkah-langkah instalasi

-   Clone repository ini

HTTPS

```
https://github.com/mrizkimaulidan/wangkas.git
```

SSH

```
git@github.com:mrizkimaulidan/wangkas.git
```

-   Install seluruh packages yang dibutuhkan

```bash
composer install
```

-   Siapkan database dan atur file .env sesuai dengan konfigurasi Anda
-   Ubah value APP_NAME= pada file .env menjadi nama aplikasi yang anda inginkan
-   Jika sudah, migrate seluruh migrasi dan seeding data

```bash
php artisan migrate --seed
```

-   Ketik perintah dibawah ini untuk membuat cache baru dari beberapa konfigurasi yang telah diubah

```bash
php artisan optimize
```

-   Jalankan local server

```bash
php artisan serve
```

-   _(Opsional)_ Secara default debugbar akan aktif, untuk menonaktifkannnya cari variabel `DEBUGBAR_ENABLED` pada file .env dan ubah valuenya menjadi `FALSE`

-   Akses ke halaman

```
http://127.0.0.1:8000
```

---

-   User default aplikasi untuk login

##### Administrator

```
Email       : admin@mail.com
Password    : secret
```

### Dibuat dengan

-   [Laravel](https://laravel.com) - Web Framework

### Kontribusi

Silahkan request melalui kolom `Pull Requests` jika ingin melakukan kontribusi

Database Schema -> [dbdiagram](https://dbdiagram.io/d/60115a6180d742080a380f79)

### Pembuat

-   **Muhammad Rizki Maulidan** - _Programmer_ - [mrizkimaulidan](https://github.com/mrizkimaulidan)

### Lisensi

Aplikasi ini boleh untuk dibagi dan diubah. Mohon tidak untuk diperjualbelikan!

### Ucapan terima kasih

-   [Mazer Dashboard Theme](https://github.com/zuramai/mazer)
-   Stackoverflow
-   Google
