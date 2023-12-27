# Panduan Kontribusi Aplikasi Wangkas

Terima kasih telah berminat untuk berkontribusi pada proyek Aplikasi Wangkas! Dengan partisipasi Anda, kita dapat membuat Aplikasi Wangkas menjadi lebih baik bersama-sama. Harap ikuti panduan berikut untuk memudahkan proses kontribusi:

## Bagaimana Berkontribusi

1. **Fork Proyek:**
   - Fork proyek ke akun GitHub Anda.
   - Clone repositori tersebut ke mesin lokal Anda dengan menjalankan perintah:
     ```bash
     git clone https://github.com/mrizkimaulidan/wangkas.git
     ```

2. **Buat Cabang (Branch) Baru:**
   - Buat branch baru untuk fitur atau perbaikan yang akan Anda kerjakan:
     ```bash
     git checkout -b fitur-baru
     ```

3. **Pemasangan dan Pengaturan Lingkungan Pengembangan:**
   - Pastikan Anda telah menginstal Laravel Framework 10 dan dependensinya di lingkungan pengembangan Anda.
   - Salin file `.env.example` ke `.env` dan sesuaikan konfigurasi yang diperlukan.
   - Jalankan migrasi database dan _seeder_ jika diperlukan:
     ```bash
     php artisan migrate --seed
     ```

4. **Pengembangan:**
   - Mulailah mengembangkan fitur atau perbaikan Anda.
   - Pastikan untuk mengikuti pedoman gaya dan standar kode yang berlaku di proyek ini.

5. **Uji Coba (Testing):**
   - Pastikan untuk menguji perubahan Anda secara menyeluruh.

6. **Buat Pull Request:**
   - Setelah selesai, buat pull request ke repositori utama.
   - Jelaskan dengan jelas tujuan dari perubahan Anda.
   - Pastikan untuk menyertakan detail yang dibutuhkan dan mengacu pada nomor _issue_ terkait jika ada.

7. **Review dan Kolaborasi:**
   - Tim pengembangan akan melakukan review terhadap kontribusi Anda.
   - Harap bersedia untuk berkolaborasi dan membuat perubahan jika diperlukan.

## Pedoman Kontribusi

- Pastikan setiap perubahan atau penambahan fitur diuji coba secara menyeluruh.
- Ikuti pedoman gaya dan standar kode yang berlaku di proyek ini.
- Berikan deskripsi yang jelas dan informatif saat membuat pull request.
- Jangan ragu untuk bertanya jika ada ketidakjelasan atau butuh bantuan.

## Pelaporan Masalah (Issues)

Jika Anda menemui masalah atau memiliki ide perbaikan, silakan buat _issue_ di repositori ini. Pastikan untuk memberikan informasi yang cukup dan jelas untuk mempermudah pemahaman dan penanganan.

Terima kasih banyak atas kontribusi Anda dalam mengembangkan Aplikasi Wangkas!
