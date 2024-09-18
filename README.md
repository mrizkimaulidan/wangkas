# Peminba

**Perhatian**: Proyek ini akan dibuat ulang menggunakan Livewire untuk mengikuti perkembangan teknologi yang lebih modern. Saat ini sedang dilakukan development pada branch `livewire`.

Aplikasi pendataan uang kas dibuat dengan Framework Laravel 10. Dengan sistem pembayaran kas sekali selama seminggu. Aplikasi ini cocok untuk digunakan untuk di sekolah atau masing masing kelas.

Beberapa CRUD menggunakan modal dan AJAX untuk pengambilan data agar mengurangi penggunaan pindah halaman. Dan seluruh menu menggunakan DataTable Server Side Processing.

### Demo

-   Demo Aplikasi (https://demo.wangkas.mrizkimaulidan.my.id/login)

### Prasyarat

Berikut beberapa hal yang perlu diinstal terlebih dahulu:

-   Composer (https://getcomposer.org/)
-   PHP ^8.1
-   MySQL 15.x
-   NodeJS ^20.x (https://nodejs.org/)
-   XAMPP (https://www.apachefriends.org/)

Jika Anda menggunakan XAMPP, PHP, dan MySQL sudah menjadi satu paket di dalam aplikasi XAMPP.

### Fitur

-   CRUD Pelajar
-   CRUD Kelas
-   CRUD Jurusan
-   Transaksi pembayaran kas
-   Laporan transaksi kas
-   CRUD Administrator
-   Pengaturan Profil

### Preview Gambar

**Tampilan Login**
![Image 1](https://i.imgur.com/XnUNu3m.png)

**Tampilan Dashboard**
![Image 2](https://i.imgur.com/uT8ibPT.png)

**Tampilan Pelajar**
![Image 3](https://i.imgur.com/hBkOz9i.png)

**Tampilan Kelas**
![Image 4](https://i.imgur.com/4yAzcRC.png)

**Tampilan Jurusan**
![Image 5](https://i.imgur.com/6zYaTSi.png)

**Tampilan Transaksi Kas Minggu Ini**
![Image 6](https://i.imgur.com/8LpyWo7.png)

**Tampilan Filter Transaksi Kas**
![Image 7](https://i.imgur.com/O3TH0hF.png)

**Tampilan Laporan Transaksi Kas**
![Image 8](https://i.imgur.com/G7h5LUo.png)

**Tampilan Administrator**
![Image 9](https://i.imgur.com/5S15SGf.png)

**Tampilan Pengaturan Profil**
![Image 10](https://i.imgur.com/825gl4z.png)

### Langkah-langkah Instalasi

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

5. Migrate seluruh migrasi dan seeding data palsu.

```bash
$ php artisan migrate:fresh --seed
```

6. Generate IDE Helper (opsional jika ingin melakukan development)

```bash
$ php artisan ide-helper:generate
```

```bash
$ php artisan ide-helper:models
```

7. Jalankan local server

```bash
$ php artisan serve
```

```bash
INFO  Server running on [http://127.0.0.1:8000].

Press Ctrl+C to stop the server
```

### User default aplikasi untuk login

```bash
Email   : admin@mail.com
Pass    : secret
```

### Dibuat dengan

-   Laravel (https://laravel.com/)
-   Mazer Admin Dashboard (https://github.com/zuramai/mazer)
-   Bootstrap 5 (https://getbootstrap.com/)

### Kontribusi

Silakan request melalui kolom `Pull Requests` jika ingin melakukan kontribusi.

### Lisensi

Aplikasi ini boleh untuk dibagi dan diubah. Mohon tidak untuk diperjualbelikan!

Muhammad Rizki Maulidan - [@mrizkimaulidan](https://github.com/mrizkimaulidan)
