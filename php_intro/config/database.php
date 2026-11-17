<?php

declare(strict_types=1);

$host = '127.0.0.1';
$databaseName = 'php_intro';
$username = 'root';
$password = 'root';

try {
    $database = new PDO(
        "mysql:host={$host};dbname={$databaseName};charset=utf8mb4",
        $username,
        $password
    );
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // $database->exec(
    //     'CREATE TABLE IF NOT EXISTS contacts (
    //         id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //         name VARCHAR(100) NOT NULL,
    //         email VARCHAR(150) NOT NULL,
    //         message TEXT NOT NULL,
    //         created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    //     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
    // );
} catch (PDOException $exception) {
    throw new RuntimeException(
        'Koneksi database gagal. Pastikan MySQL Laragon aktif dan database php_intro sudah dibuat.',
        0,
        $exception
    );
}
