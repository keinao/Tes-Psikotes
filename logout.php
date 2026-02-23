<?php
// 1. Memulai session untuk mengakses data yang akan dihapus
session_start();

// 2. Menghapus semua variabel session (NIP, Nama, Role)
$_SESSION = array();

// 3. Menghancurkan session secara permanen dari server
session_destroy();

// 4. Mengarahkan kembali ke halaman login dengan pesan sukses
header("Location: login.php?msg=logout_sukses");
exit();
?>