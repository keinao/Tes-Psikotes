<?php
session_start();

// cek sudah login atau belum
if (!isset($_SESSION['nip'])) {
    header("Location: ../login.php");
    exit;
}

// cek role harus admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../dashboard.php");
    exit;
}
