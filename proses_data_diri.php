<?php

echo '<pre>';
print_r($_POST);
echo '</pre>';
// Mengambil data nama
$nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '-';

// Mengambil dan mengubah format tanggal ke Bahasa Indonesia
$tgl_input = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : '';
if (!empty($tgl_input)) {
    $bulan_indo = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
        '04' => 'April',   '05' => 'Mei',      '06' => 'Juni',
        '07' => 'Juli',    '08' => 'Agustus',  '09' => 'September',
        '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
    ];
    
    // Memecah format YYYY-MM-DD
    $pecah = explode('-', $tgl_input);
    $tahun = $pecah[0];
    $bulan = $bulan_indo[$pecah[1]];
    $tanggal = (int)$pecah[2]; // Menghilangkan angka 0 di depan tanggal (contoh: 07 menjadi 7)
    
    $tanggal_lahir = "$tanggal $bulan $tahun";
} else {
    $tanggal_lahir = '-';
}

// Mengambil data hobi (array) dan menggabungkannya dengan koma
if (isset($_POST['hobi']) && is_array($_POST['hobi'])) {
    $hobi = implode(', ', $_POST['hobi']);
} else {
    $hobi = 'Tidak ada hobi yang dipilih';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Data Diri</title>
</head>
<body>
    <h3>Data Diri</h3>
    
    <p>Nama Lengkap: <?php echo $nama; ?></p>
    <p>Tanggal Lahir: <?php echo $tanggal_lahir; ?></p>
    <p>Hobi: <?php echo $hobi; ?></p>
    
    <br>
    <a href="form_data_diri.html">Kembali ke Form</a>
</body>
</html>
