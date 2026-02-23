<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Instruksi Tes | Tes Psikologi Pegawai</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="images/logobps.png" alt="Logo BPS">
        <span>Tes Psikologi Pegawai</span>
    </div>
    <div class="user-info">
        <span>Halo, Andi</span>
        <a href="#" class="logout">Logout</a>
    </div>
</header>

<main class="container">

    <section class="instruction-card">
        <h2>Instruksi Tes Psikologi</h2>

        <p>
            Tes ini bertujuan untuk memperoleh gambaran umum mengenai
            karakteristik psikologis pegawai dalam konteks kerja.
        </p>

        <ul class="instruction-list">
            <li>Jawablah setiap pertanyaan dengan jujur dan sesuai kondisi Anda.</li>
            <li>Tidak ada jawaban benar atau salah.</li>
            <li>Kerjakan tes dalam satu waktu tanpa jeda.</li>
            <li>Pastikan koneksi internet stabil.</li>
            <li>Data dan hasil tes bersifat rahasia.</li>
        </ul>

        <div class="test-info">
            <p><strong>Jumlah Soal:</strong> 60</p>
            <p><strong>Estimasi Waktu:</strong> ±30 menit</p>
            <p><strong>Jenis Skala:</strong> Skala Likert</p>
        </div>

        <div class="agreement">
            <input type="checkbox" id="agree">
            <label for="agree">
                Saya telah membaca dan memahami instruksi tes
            </label>
        </div>

        <div class="action">
            <button class="btn-primary" id="startBtn" disabled>
                Mulai Tes
            </button>
        </div>
    </section>

</main>

<script src="main.js"></script>
</body>
</html>
