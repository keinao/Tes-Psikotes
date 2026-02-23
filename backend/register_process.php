<?php
require 'config.php'; // Menggunakan koneksi $conn dari mysqli_connect

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Tangkap data dari form register.php
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $nip      = mysqli_real_escape_string($conn, $_POST['nip']);
    $jabatan  = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $satuan_kerja   = mysqli_real_escape_string($conn, $_POST['satuan_kerja']);
    $password = $_POST['password'];

    // 2. Cek apakah NIP sudah terdaftar di database
    $cek_nip = mysqli_query($conn, "SELECT nip FROM users WHERE nip = '$nip'");
    
    if (mysqli_num_rows($cek_nip) > 0) {
        // Jika NIP sudah ada, kembalikan ke halaman regis dengan pesan error
        header("Location: ../register.php?error=nip_ada");
        exit();
    }

    // 3. Enkripsi password untuk keamanan data pegawai
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // 4. Simpan ke tabel users
    // Role otomatis diset sebagai 'peserta'
    $query = "INSERT INTO users (nip, nama, jabatan, satuan_kerja, password, role) 
              VALUES ('$nip', '$nama', '$jabatan', '$satuan_kerja', '$password_hash', 'peserta')";

    if (mysqli_query($conn, $query)) {
        // Jika berhasil, arahkan ke halaman login
        header("Location: ../login.php?msg=regis_sukses");
    } else {
        // Jika gagal karena masalah database
        header("Location: ../register.php?error=gagal");
    }
    exit();
}
?>