<?php
require_once 'helpers.php';
cek_login();
require_once 'koneksi.php';

$user_id = $_SESSION['user_id'];

$stmt = mysqli_prepare($koneksi, "SELECT * FROM proyek WHERE user_id = ? ORDER BY id DESC");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Catatan Tugas</title>
    <!-- Library Eksternal: Bootstrap 5 & FontAwesome CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fa-solid fa-list-check me-2"></i>Catatan Tugas</a>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white"><i class="fa-solid fa-user me-1"></i> <?= xss_clean($_SESSION['username']) ?></span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Catatan Tugas</h2>
        <a href="tambah_proyek.php" class="btn btn-success"><i class="fa-solid fa-plus me-1"></i> Tambah Tugas</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul Tugas</th>
                        <th>Prioritas / Kategori</th>
                        <th>Tanggal Dibuat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= xss_clean($row['nama_proyek']) ?></strong></td>
                        <td>
                            <span class="badge bg-<?= ($row['kategori'] == 'Tinggi') ? 'danger' : (($row['kategori'] == 'Sedang') ? 'warning text-dark' : 'secondary') ?>">
                                <?= xss_clean($row['kategori']) ?>
                            </span>
                        </td>
                        <td><?= $row['created_at'] ?></td>
                        <td class="text-center">
                            <a href="detail_proyek.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-eye me-1"></i> Detail</a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus tugas ini?')"><i class="fa-solid fa-trash me-1"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if(mysqli_num_rows($result) === 0): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada catatan tugas. Klik "Tambah Tugas" untuk membuat tugas baru.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>