# PHP Form ke MySQL

Contoh sederhana untuk menyimpan input form web ke database MySQL menggunakan PHP native, PDO, Bootstrap, dan Laragon.

## 1. Buat database

Pastikan MySQL Laragon sudah menyala. Buka HeidiSQL atau phpMyAdmin, lalu jalankan isi file [`database.sql`](database.sql).

## 2. Atur koneksi

Konfigurasi ada di [`config/database.php`](config/database.php):

```php
$host = '127.0.0.1';
$databaseName = 'php_intro';
$username = 'root';
$password = 'root';
```

Nilai tersebut adalah konfigurasi default Laragon. Sesuaikan jika konfigurasi MySQL Anda berbeda.

## 3. Jalankan project

Letakkan folder project di `C:\laragon\www`, lalu buka:

```text
http://localhost/php_intro
```

Atau jalankan dari terminal folder project:

```bash
php -S localhost:8000
```

Kemudian buka <http://localhost:8000>.

## File penting

- `index.php`: menampilkan form dan data dari tabel `contacts`.
- `simpan.php`: memvalidasi lalu menyimpan data dengan prepared statement.
- `hapus.php`: menghapus data berdasarkan ID.
- `config/database.php`: koneksi ke MySQL.
