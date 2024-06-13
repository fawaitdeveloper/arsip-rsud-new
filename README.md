## Installation / Instalasi
Direkomendasikan menggunakan php > 8.1.0. Pastikan repo ini telah diclone, kemudian buka CLI dan posisikan direktori aktif ke repo ini.
Silakan pilih salah satu dari dua cara di bawah ini.

### Makefile Setup
Jalankan perintah berikut untuk setup awal
```
make setup
```
Pastikan Anda telah membuat database baru di MySQL dan silakan sesuaikan file `.env` dengan database Anda.

### Setup
Jalankan perintah berikut untuk menginstal dependensi php
```
composer install
```
Jalankan perintah berikut untuk mengatur _environment variable_
```
cp .env.example .env
```
Pastikan Anda telah membuat database baru di MySQL dan silakan sesuaikan file `.env` dengan database Anda.
Jalankan perintah berikut untuk membuat _key_ untuk web app Anda
```
php artisan key:generate
```
Jalankan perintah berikut untuk menghubungkan folder public Anda dengan storage
```
php artisan storage:link
```
Jalankan perintah berikut untuk membuat skema database
```
php artisan migrate
```
Jalankan perintah berikut untuk menambahkan data-data _dummy_
```
php artisan db:seed
```
Terakhir, jalankan perintah berikut untuk menyalakan web server bawaan laravel 
```
php artisan serve
```
Setelah perintah di atas dijalankan, web app Anda bisa sudah bisa diakses

## Login
Untuk login aplikasi silakan masukkan surel dan kata sandi berikut

| Username   | johndoe |
|------------|---------|
| Kata Sandi | password|

## Other / Lainnya
Proyek ini menggunakan admin template [Sneat](https://github.com/themeselection/sneat-html-admin-template-free)
