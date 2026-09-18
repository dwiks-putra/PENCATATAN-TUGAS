# Aplikasi Catatan Tugas

Aplikasi web manajemen tugas sederhana berbasis **PHP Native** dan **MySQL** untuk mencatat, memantau, dan mengelola daftar tugas harian berdasarkan tingkat prioritas.

---

## Fitur Utama

- **Autentikasi Pengguna:** Fitur Login & Logout berbasis Session untuk keamanan akun.
- **Manajemen Tugas (CRUD):** 
  - Menambahkan catatan tugas baru beserta kategori/prioritasnya.
  - Menampilkan daftar tugas terurut berdasarkan waktu pembuatan.
  - Melihat detail lengkap dari setiap catatan tugas.
  - Menghapus catatan tugas yang sudah selesai.
- **Sistem Keamanan:**
  - Enkripsi kata sandi menggunakan **BCRYPT** (`password_hash`).
  - Pencegahan SQL Injection menggunakan **Prepared Statements**.
  - Sanitasi Input untuk mencegah serangan **XSS (Cross-Site Scripting)**.
- **Tampilan Responsif:** Antarmuka modern yang dibuat menggunakan **Bootstrap 5** dan **FontAwesome**.

---

## Teknologi yang Digunakan

- **Language:** PHP 8.x
- **Database:** MySQL / MariaDB
- **Styling & UI:** Bootstrap 5.3 & FontAwesome 6.4
- **Local Server:** XAMPP (Apache & MySQL)

---

## Struktur Folder Project

```text
Catatan tugas/
├── .gitignore          # File konfigurasi abaikan Git
├── README.md           # Dokumentasi project
├── db_proyek.sql       # Backup / Skema Database MySQL
├── helpers.php         # Functions helper (Sanitasi XSS & Cek Login)
├── koneksi.php        # Konfigurasi koneksi database MySQL
├── index.php           # Halaman utama (Daftar Tugas)
├── login.php           # Halaman login pengguna
├── logout.php          # Script proses logout
├── tambah_proyek.php   # Halaman tambah tugas baru
├── detail_proyek.php   # Halaman detail tugas
└── hapus.php           # Script hapus tugas
