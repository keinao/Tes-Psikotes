<?php
session_start();
require 'config.php'; // Pastikan path ini benar (sesuaikan jika file ini di dalam folder backend)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip      = mysqli_real_escape_string($conn, $_POST['nip']);
    $password = $_POST['password'];

    // 1. Cari user berdasarkan NIP
    $query  = "SELECT * FROM users WHERE nip = '$nip'";
    $result = mysqli_query($conn, $query);
    $user   = mysqli_fetch_assoc($result);

    if ($user) {
        // 2. Verifikasi password (asumsi menggunakan password_hash saat register)
        if (password_verify($password, $user['password'])) {
            
            // 3. Set Session
            $_SESSION['nip']    = $user['nip'];
            $_SESSION['nama']   = $user['nama'];
            $_SESSION['role']   = $user['role']; // Role: 'admin' atau 'peserta'
            $_SESSION['jabatan']      = $user['jabatan'];
            $_SESSION['satuan_kerja'] = $user['satuan_kerja']; // Pastikan nama kolom sesuai database Anda

            // 4. Redirect berdasarkan Role
            if ($user['role'] == 'admin') {
                header("Location: ../admin/index.php");
            } else {
                header("Location: ../dashboard.php");
            }
            exit();

        } else {
            // Password salah
            header("Location: ../login.php?error=gagal");
        }
    } else {
        // NIP tidak ditemukan
        header("Location: ../login.php?error=gagal");
    }
}
?>