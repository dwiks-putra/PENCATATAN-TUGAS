<?php
require_once 'helpers.php';
cek_login();
require_once 'koneksi.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_proyek = xss_clean($_POST['nama_proyek']);
    $deskripsi   = xss_clean($_POST['deskripsi']);
    $kategori    = xss_clean($_POST['kategori']);
    $user_id     = $_SESSION['user_id'];

    // Validasi Input
    if (empty($nama_proyek) || empty($deskripsi) || empty($kategori)) {
        $error = "Semua bidang wajib diisi!";
    } else {
        // Prepared Statement (Mitigasi SQLi)
        $stmt = mysqli_prepare($koneksi, "INSERT INTO proyek (user_id, nama_proyek, deskripsi, kategori) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "isss", $user_id, $nama_proyek, $deskripsi, $kategori);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Gagal menyimpan tugas.";
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Catatan Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white"><h5>Tambah Catatan Tugas Baru</h5></div>
        <div class="card-body">
            <?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Judul Tugas</label>
                    <input type="text" name="nama_proyek" class="form-control" placeholder="Contoh: Tugas Remedial Back-End" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prioritas Tugas</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">-- Pilih Prioritas --</option>
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Rincian / Catatan Tugas</label>
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan instruksi atau detail tugas..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Tugas</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>