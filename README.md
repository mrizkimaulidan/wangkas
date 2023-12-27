# WANGKAS

Aplikasi pendataan uang kas dibuat dengan Framework Laravel 10. Dengan sistem pembayaran kas sekali selama seminggu. Aplikasi ini cocok untuk digunakan untuk di sekolah atau masing masing kelas. <br>

Beberapa CRUD menggunakan modal dan AJAX untuk pengambilan data agar mengurangi penggunaan pindah halaman. Dan seluruh menu menggunakan DataTable Server Side Processing.

### Prasyarat

Berikut beberapa hal yang perlu diinstal terlebih dahulu:

-   Composer (https://getcomposer.org/)
-   PHP ^8.1.x
-   MySQL ^10.6
-   XAMPP

Jika Anda menggunakan XAMPP, untuk PHP dan MySQL sudah menjadi 1 (bundle) di dalam aplikasi XAMPP.

### Fitur

-   CRUD Data Siswa
-   CRUD Data Kelas
-   CRUD Data Jurusan
-   CRUD Data Transaksi Uang Kas
-   CRUD Data Administrator
-   Laporan

### Preview Gambar

_Login_
![Login](https://i.ibb.co/Tm5Mmgk/login.png)

_Dashboard_
![Dashboard](https://i.ibb.co/RYrRx6k/dashboard.png)

_Daftar Pelajar_
![Daftar Pelajar](https://i.ibb.co/r49hxYB/students.png)

_Daftar Kelas_
![Daftar Kelas](https://i.ibb.co/6Rqvt4n/schoolclasses.png)

_Daftar Jurusan_
![Daftar Jurusan](https://i.ibb.co/D1wn5Tm/schoolmajors.png)

_Daftar Kas_
![Daftar Kas](https://i.ibb.co/jMK1R7j/cashtransactionthisyear.png)

![Filter Kas](https://i.ibb.co/VQBbdbf/cashtransactionfilter.png)

_Laporan_
![Laporan](https://i.ibb.co/yQZkFwS/cashtransactionreport.png)

_Daftar Administrator_
![Daftar Administrator](https://i.ibb.co/XsZWk2c/administrators.png)

_Logout_
![Logout](https://i.ibb.co/qyRk9c1/logout.png)

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

### Pembuat

-   **Muhammad Rizki Maulidan**  - [mrizkimaulidan](https://github.com/mrizkimaulidan)

### Lisensi

Aplikasi ini boleh untuk dibagi dan diubah. Mohon tidak untuk diperjualbelikan!

### Ucapan terima kasih

-   [Mazer Dashboard Theme](https://github.com/zuramai/mazer)
