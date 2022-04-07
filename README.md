# WANGKAS

Aplikasi pendataan uang kas dibuat dengan Framework Laravel 8. Dengan sistem pembayaran kas sekali selama seminggu. Aplikasi ini cocok untuk digunakan untuk di sekolah atau masing masing kelas. <br>

Beberapa CRUD menggunakan modal dan AJAX untuk pengambilan data agar mengurangi penggunaan pindah halaman. Dan seluruh menu menggunakan DataTable Server Side Processing.

Website Demo : https://wangkas.herokuapp.com/

### Prasyarat

Berikut beberapa hal yang perlu diinstal terlebih dahulu:

-   Composer (https://getcomposer.org/)
-   PHP ^8.x.x
-   MySQL ^15.x
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
![Login](https://i.ibb.co/Ws6H4Kr/login.png)

_Dashboard_
![Dashboard](https://i.ibb.co/jJsmpHQ/dashboard.png)

_Daftar Pelajar_
![Daftar Pelajar](https://i.ibb.co/vQcMzNr/students.png)

_Daftar Kelas_
![Daftar Kelas](https://i.ibb.co/brXRLbf/school-classes.png)

_Daftar Jurusan_
![Daftar Jurusan](https://i.ibb.co/V2FwnR8/school-majors.png)

_Daftar Kas_
![Daftar Kas](https://i.ibb.co/gZCXdDr/cash-transaction-this-week.png)

![Filter Kas](https://i.ibb.co/s3vZVgF/cash-transaction-filter.png)

_Laporan_
![Laporan](https://i.ibb.co/FBj0LmZ/reports.png)

_Daftar Administrator_
![Daftar Administrator](https://i.ibb.co/Mfr1PD3/administrators.png)

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

-   _(Opsional)_ Secara default debugbar akan aktif, untuk menonaktifkannnya cari variabel `DEBUGBAR_ENABLED` pada file .env dan ubah valuenya menjadi `false`

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

- [Laravel](https://laravel.com/) - Backend Framework
- [Bootstrap](https://getbootstrap.com/) - Frontend Framework

### Kontribusi

Silahkan request melalui kolom `Pull Requests` jika ingin melakukan kontribusi

Database Schema -> [dbdiagram](https://dbdiagram.io/d/60115a6180d742080a380f79)

### Pembuat

-   **Muhammad Rizki Maulidan**  - [mrizkimaulidan](https://github.com/mrizkimaulidan)

### Lisensi

Aplikasi ini boleh untuk dibagi dan diubah. Mohon tidak untuk diperjualbelikan!

### Ucapan terima kasih

-   [Mazer Dashboard Theme](https://github.com/zuramai/mazer)
-   Stackoverflow
-   Google
