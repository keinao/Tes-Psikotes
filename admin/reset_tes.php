<?php
require_once '../backend/config.php';
include '../backend/auth_check.php';

// Validasi parameter
if (!isset($_GET['nip']) || !isset($_GET['tipe'])) {
    header("Location: status_pegawai.php");
    exit;
}

$nip = mysqli_real_escape_string($conn, $_GET['nip']);
$tipe = $_GET['tipe'];

// Tentukan tabel mana yang akan dihapus
if ($tipe == 'msdt') {
    $sql = "DELETE FROM hasil_msdt WHERE nip = '$nip'";
} elseif ($tipe == 'papi') {
    $sql = "DELETE FROM hasil_papi WHERE nip = '$nip'";
} else {
    header("Location: status_pegawai.php");
    exit;
}

if (mysqli_query($conn, $sql)) {
    header("Location: status_pegawai.php?status=reset_berhasil");
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}