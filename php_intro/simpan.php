<?php

declare(strict_types=1);

require __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if ($name === '' || $email === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.php?status=error');
    exit;
}

$statement = $database->prepare(
    'INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)'
);
$statement->execute([
    ':name' => $name,
    ':email' => $email,
    ':message' => $message,
]);

header('Location: index.php?status=success');
exit;
