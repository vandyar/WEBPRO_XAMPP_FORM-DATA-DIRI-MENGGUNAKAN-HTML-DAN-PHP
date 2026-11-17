<?php

declare(strict_types=1);

require __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.php';

$contacts = $database
    ->query('SELECT id, name, email, message, created_at FROM contacts ORDER BY id DESC')
    ->fetchAll();

$status = $_GET['status'] ?? '';
$statusMessages = [
    'success' => ['success', 'Data berhasil disimpan ke database lokal.'],
    'deleted' => ['success', 'Data berhasil dihapus.'],
    'error' => ['danger', 'Terjadi kesalahan. Silakan coba lagi.'],
];

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Kontak - PHP MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-4">
                    <h1 class="fw-bold">Form Kontak</h1>
                    <p class="text-secondary mb-0">Contoh input data dari web page ke database MYSQL local.</p>
                </div>

                <?php if (isset($statusMessages[$status])): ?>
                    <?php [$alertType, $message] = $statusMessages[$status]; ?>
                    <div class="alert alert-<?= e($alertType) ?> alert-dismissible fade show" role="alert">
                        <?= e($message) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                <?php endif; ?>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-3">Tambah Data</h2>
                        <form action="simpan.php" method="post">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" maxlength="100" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" maxlength="150" required>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Pesan</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" maxlength="1000" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="h5 mb-0">Data Tersimpan</h2>
                            <span class="badge text-bg-secondary"><?= count($contacts) ?> data</span>
                        </div>
                        <?php if ($contacts === []): ?>
                            <p class="text-secondary mb-0">Belum ada data. Silakan isi form di atas.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Pesan</th>
                                            <th>Waktu</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($contacts as $contact): ?>
                                            <tr>
                                                <td><?= e($contact['name']) ?></td>
                                                <td><?= e($contact['email']) ?></td>
                                                <td><?= nl2br(e($contact['message'])) ?></td>
                                                <td class="text-nowrap"><?= e($contact['created_at']) ?></td>
                                                <td class="text-end">
                                                    <form action="hapus.php" method="post" onsubmit="return confirm('Hapus data ini?');">
                                                        <input type="hidden" name="id" value="<?= e((string) $contact['id']) ?>">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>