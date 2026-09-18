<?php
require_once 'koneksi.php';

$username = 'admin';
$password = '112789';

// Generate Hash Enkripsi BCRYPT
$hash_password = password_hash($password, PASSWORD_BCRYPT);

// Update Password ke Database
$stmt = mysqli_prepare($koneksi, "UPDATE users SET password = ? WHERE username = ?");
mysqli_stmt_bind_param($stmt, "ss", $hash_password, $username);

if (mysqli_stmt_execute($stmt)) {
    echo "<h3>Password Berhasil Diperbarui!</h3>";
    echo "Silakan coba login kembali menggunakan:<br>";
    echo "Username: <b>admin</b><br>";
    echo "Password: <b>112789</b><br><br>";
    echo "<a href='login.php'>Ke Halaman Login</a>";
} else {
    echo "Gagal memperbarui: " . mysqli_error($koneksi);
}
?>