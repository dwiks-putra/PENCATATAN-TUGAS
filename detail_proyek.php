<?php
require_once 'helpers.php';
cek_login();
require_once 'koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user_id = $_SESSION['user_id'];


$stmt = mysqli_prepare($koneksi, "SELECT * FROM proyek WHERE id = ? AND user_id = ?");
mysqli_stmt_bind_param($stmt, "ii", $id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$proyek = mysqli_fetch_assoc($result);

if (!$proyek) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Catatan Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white"><h5>Detail Catatan Tugas</h5></div>
        <div class="card-body">
            <h3><?= xss_clean($proyek['nama_proyek']) ?></h3>
            <span class="badge bg-<?= ($proyek['kategori'] == 'Tinggi') ? 'danger' : (($proyek['kategori'] == 'Sedang') ? 'warning text-dark' : 'secondary') ?>">
                Prioritas: <?= xss_clean($proyek['kategori']) ?>
            </span>
            <p class="text-muted mt-2"><small>Dibuat pada: <?= $proyek['created_at'] ?></small></p>
            <hr>
            <h6>Deskripsi / Rincian:</h6>
            <p><?= nl2br(xss_clean($proyek['deskripsi'])) ?></p>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
</body>
</html>