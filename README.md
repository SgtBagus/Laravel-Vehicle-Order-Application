```markdown
# Panduan Instalasi Laravel untuk Aplikasi Pemesanan Kendaraan

Panduan ini akan membantu Anda menginstal dan menjalankan proyek Laravel "Aplikasi Pemesanan Kendaraan" dengan langkah-langkah yang jelas dan mudah diikuti.

## Prasyarat

Pastikan Anda telah memenuhi prasyarat berikut sebelum memulai:

- [XAMPP](https://www.apachefriends.org/index.html) atau stack server sejenis yang sudah terinstal.
- [PHP](https://www.php.net/): Pastikan Anda memiliki PHP versi 8.1.17 atau yang lebih baru.
- [Composer](https://getcomposer.org/): Sebuah alat manajemen paket PHP.
- [Node.js](https://nodejs.org/): Untuk manajemen paket JavaScript.
- [npm](https://www.npmjs.com/): Alat manajemen paket JavaScript yang akan terinstal bersama Node.js.

## Langkah 1: Instal Laravel

1. Pastikan Anda telah menginstal Composer. Jika belum, ikuti [Langkah 1](#langkah-1-instal-composer) dari panduan sebelumnya.
2. Buka terminal Anda dan jalankan perintah berikut untuk menginstal Laravel dengan versi 10.x:

   ```bash
   composer create-project --prefer-dist laravel/laravel nama-proyek-anda "10.*"
   ```

3. Masuk ke direktori proyek Anda:

   ```bash
   cd nama-proyek-anda
   ```

## Langkah 2: Konfigurasi Database

1. Salin file `.env.example` menjadi `.env`:

   ```bash
   cp .env.example .env
   ```

2. Buka file `.env` dengan editor teks Anda dan atur parameter berikut sesuai kebutuhan:

   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=vehicle-order-application
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   Pastikan untuk mengganti nama database, username, dan password sesuai dengan konfigurasi database Anda.

## Langkah 3: Migrasi Database

Jalankan perintah berikut untuk menjalankan migrasi database:

```bash
php artisan migrate
```

## Langkah 4: Memasukkan Data Dummy (Opsional)

Jika Anda ingin memasukkan data dummy ke dalam database, Anda dapat menjalankan perintah berikut:

```bash
php artisan db:seed --class=CreateUsersSeeder
php artisan db:seed --class=SubmissionSeeder
php artisan db:seed --class=CreateVehicleListSeeder
```

## Langkah 5: Instalasi Paket JavaScript

Jalankan perintah berikut untuk menginstal paket JavaScript yang diperlukan:

```bash
npm install
```

## Langkah 6: Kompilasi Sumber Daya

Selanjutnya, jalankan perintah untuk mengkompilasi sumber daya JavaScript dan CSS:

```bash
npm run dev
```

## Langkah 7: Menjalankan Server Pengembangan

Terakhir, jalankan server pengembangan Laravel dengan perintah:

```bash
php artisan serve
```

Anda sekarang dapat mengakses aplikasi pemesanan kendaraan di [http://localhost:8000](http://localhost:8000).
```