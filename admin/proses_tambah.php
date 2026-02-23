<?php
require_once '../backend/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Tangkap data dari form
    $no = mysqli_real_escape_string($conn, $_POST['nomor_soal']);
    $pa = mysqli_real_escape_string($conn, $_POST['pertanyaan_a']);
    $pb = mysqli_real_escape_string($conn, $_POST['pertanyaan_b']);

    // 2. Query Insert (Gunakan 'KEPRIBADIAN' sesuai ENUM tabel Anda)
    $query = "INSERT INTO soal (kode_tes, nomor_soal, pertanyaan_a, pertanyaan_b, status) 
              VALUES ('KEPRIBADIAN', '$no', '$pa', '$pb', 'aktif')";
    
    if (mysqli_query($conn, $query)) {
        // 3. Jika sukses, kembali ke halaman daftar soal
        header("Location: index.php?msg=sukses");
    } else {
        echo "Gagal simpan ke database: " . mysqli_error($conn);
    }
    exit();
}
?>