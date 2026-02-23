<?php
// Baris 1: Proteksi halaman
require_once __DIR__ . '/backend/auth_check.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Tes | Tes Psikologi Pegawai</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="images/logobps.png" alt="Logo BPS">
        <span>Tes Psikologi Pegawai</span>
    </div>
    <div class="user-info">
        <span>Andi</span>
        <a href="#" class="logout">Logout</a>
    </div>
</header>

<main class="container">

    <section class="result-card">
        <h2>Hasil Tes Psikologi</h2>

        <div class="score-box">
            <p>Total Skor</p>
            <h1 id="totalScore">0</h1>
        </div>

        <div class="result-info">
            <p><strong>Kategori:</strong></p>
            <h3 id="resultCategory">-</h3>

            <p><strong>Deskripsi:</strong></p>
            <p id="resultDescription">-</p>
        </div>

        <div class="action">
            <button class="btn-primary" onclick="window.location.href='index.php'">
                Kembali ke Beranda
            </button>
        </div>
    </section>

</main>

<script src="main.js"></script>
</body>
</html>
