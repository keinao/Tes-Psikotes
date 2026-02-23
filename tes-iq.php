<?php
// Baris 1: Proteksi halaman
require_once __DIR__ . '/backend/auth_check.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tes IQ | Tes Psikologi Pegawai</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="images/logobps.png">
        <span>Tes Psikologi Pegawai</span>
    </div>
</header>

<main class="container">

    <section class="instruction-card">
        <h2>Tes IQ</h2>
        <p>Jawablah setiap soal dengan memilih satu jawaban yang paling tepat.</p>

        <div class="test-info">
            <p><strong>Jumlah Soal:</strong> ±40</p>
            <p><strong>Waktu:</strong> ±30 menit</p>
        </div>
    </section>

    <section class="progress-box">
        <p>Soal 1 dari 40</p>
        <div class="progress-bar">
            <div class="progress-fill" style="width: 2.5%;"></div>
        </div>
    </section>

    <section class="question-card">
        <h3>1. Jika 2 + 4 = 6, maka 3 + 6 = ?</h3>

        <form id="answerForm">
            <label><input type="radio" name="answer"> 7</label>
            <label><input type="radio" name="answer"> 8</label>
            <label><input type="radio" name="answer"> 9</label>
            <label><input type="radio" name="answer"> 10</label>
        </form>
    </section>

    <div class="navigation">
        <button id="prevBtn">Sebelumnya</button>
        <button id="nextBtn">Berikutnya</button>
    </div>

</main>

</body>
</html>
