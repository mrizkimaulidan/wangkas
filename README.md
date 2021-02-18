# WANGKAS

Aplikasi pendataan uang kas dibuat dengan Framework Laravel 8. Dengan sistem pembayaran kas sekali selama seminggu. Aplikasi ini cocok untuk digunakan untuk di sekolah atau masing masing kelas. <br>

Beberapa CRUD menggunakan modal dan AJAX untuk pengambilan data agar mengurangi penggunaan pindah halaman.

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
-   Laporan **ongoing**
### Preview Gambar

_Dashboard_
![Image 1](https://i.imgur.com/MUkIIv7.png)

_Daftar Pelajar_
![Image 2](https://i.imgur.com/e1pEgWj.png)

_Daftar Kelas_
![Image 3](https://i.imgur.com/4AbTouL.png)

_Daftar Jurusan_
![Image 4](https://i.imgur.com/3fnieHm.png)

_Daftar Kas 1_
![Image 5](https://i.imgur.com/VJevruz.png)

_Daftar Kas 2_
![Image 6](https://i.imgur.com/TcDe35o.png)

_Daftar Administrator Aplikasi_
![Image 7](https://i.imgur.com/mmK00Z9.png)

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

```
composer install
```

-   Siapkan database dan atur file .env sesuai dengan konfigurasi Anda
-   Ubah value APP_NAME= pada file .env menjadi nama aplikasi yang anda inginkan
-   Jika sudah, migrate seluruh migrasi dan seeding data

```
php artisan migrate --seed
```

-   Ketik perintah dibawah ini untuk membuat cache baru dari beberapa konfigurasi yang telah diubah

```
php artisan optimize
```

-   Jalankan local server

```
php artisan serve
```

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
