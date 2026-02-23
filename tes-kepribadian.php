<?php
require_once 'backend/config.php';
require_once 'backend/auth_check.php'; // Pastikan peserta sudah login

$nip = $_SESSION['nip'];

// cek apakah sudah pernah tes
$cek = mysqli_query($conn, "SELECT nip FROM hasil_msdt WHERE nip='$nip'");

if (mysqli_num_rows($cek) > 0) {
    echo "<h2 style='text-align:center;margin-top:100px'>
          Anda sudah pernah mengikuti tes MSDT.<br>
          Silakan hubungi admin jika ingin mengulang.
          </h2>";
    exit;
}

// Mengambil semua soal MSDT dari database
$query = "SELECT * FROM soal WHERE kode_tes = 'KEPRIBADIAN' ORDER BY nomor_soal ASC";
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tes Kepribadian | BPS</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Style khusus untuk pilihan A/B agar lebih rapi */
        .question-item { background: #ffffff;margin-bottom: 30px; padding: 20px; border: 1px solid #ffffff; border-radius: 8px; }
        .option-label { display: block; padding: 12px; margin: 8px 0; border: 1px solid #ffffff; border-radius: 5px; cursor: pointer; transition: 0.3s; }
        .option-label:hover { background-color: #d0e3ff; border-color: #1f3f74; }
        input[type="radio"] { margin-right: 10px; }
    </style>
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="images/logobps.png" alt="Logo BPS">
        <span>Tes Psikologi Pegawai</span>
    </div>
    <div class="user-info">
        <span><strong><?= htmlspecialchars($nama); ?></strong> (<?= htmlspecialchars($nip); ?>)</span>
    </div>
</header>

<main class="container">
    <section id="instruction-section" class="instruction-card">
        <h2>Instruksi Tes Kepribadian (MSDT)</h2>
        <div class="test-info">
            <p>Pada halaman-halaman berikut, Anda akan membaca sejumlah pernyataan mengenai tindakan yang mungkin Anda lakukan dalam tugas Anda di unit kerja.</p>
            <p>Anda diminta untuk memilih pernyataan A atau B yang paling sesuai dengan diri Anda, atau paling mungkin Anda lakukan.</p>
            <br>
            <p><strong>Total Soal:</strong> 64 Butir</p>
            <p><strong>Waktu:</strong> Tidak dibatasi (Kerjakan dengan jujur)</p>
        </div>
        <button type="button" class="btn-primary" id="start-test-btn">Mulai Kerjakan Soal</button>
    </section>

    <section id="questions-section" style="display: none;">
        <form action="backend/proses_simpan_tes.php" method="POST">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="question-item">
                    <h3>Soal No. <?= $row['nomor_soal']; ?></h3>
                    
                    <label class="option-label">
                        <input type="radio" name="jawaban[<?= $row['nomor_soal']; ?>]" value="A" required>
                        <span><strong>A.</strong> <?= htmlspecialchars($row['pertanyaan_a']); ?></span>
                    </label>

                    <label class="option-label">
                        <input type="radio" name="jawaban[<?= $row['nomor_soal']; ?>]" value="B" required>
                        <span><strong>B.</strong> <?= htmlspecialchars($row['pertanyaan_b']); ?></span>
                    </label>
                </div>
            <?php endwhile; ?>

            <div class="navigation" style="justify-content: center; margin-top: 40px;">
                <button type="submit" class="btn-primary" onclick="return confirm('Kirim jawaban sekarang? Pastikan semua soal telah terisi.')">Kirim Tes Bagian 1</button>
            </div>
        </form>
    </section>
</main>
<script>
document.getElementById('start-test-btn').addEventListener('click', function() {
    // Sembunyikan bagian instruksi
    document.getElementById('instruction-section').style.display = 'none';
    
    // Tampilkan bagian soal
    document.getElementById('questions-section').style.display = 'block';
    
    // Scroll otomatis ke posisi paling atas agar user tidak bingung
    window.scrollTo(0, 0);
});
</script>
</body>
</html>