<?php
// Pengaturan Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "bps_psikotes";

// Membuat Koneksi dengan MySQLi
$conn = mysqli_connect($host, $user, $pass, $db);

// Periksa Koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set Charset ke UTF-8 (Penting agar teks soal terbaca sempurna)
mysqli_set_charset($conn, "utf8mb4");

// Mulai session jika belum dimulai (Berguna untuk dashboard admin & login)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>