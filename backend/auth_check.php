<?php
// Gunakan pengecekan status session agar tidak terjadi duplikasi call
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Lanjutkan pengecekan NIP seperti biasa
if (!isset($_SESSION['nip'])) {
    header("Location: login.php?error=akses_ditolak");
    exit();
}
?>