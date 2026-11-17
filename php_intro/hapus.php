<?php

declare(strict_types=1);

require __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id < 1) {
    header('Location: index.php?status=error');
    exit;
}

$statement = $database->prepare('DELETE FROM contacts WHERE id = :id');
$statement->execute([':id' => $id]);

header('Location: index.php?status=deleted');
exit;
