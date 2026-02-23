<?php 
require_once 'backend/auth_check.php';
require_once 'backend/config.php';

$nip = $_SESSION['nip'] ?? '-';
$nama = $_SESSION['nama'] ?? 'User';

// 1. Cek progres: Pastikan Bagian 1 (MSDT) sudah dikerjakan
$check_msdt = mysqli_query($conn, "SELECT id FROM hasil_msdt WHERE nip = '$nip'");
if (mysqli_num_rows($check_msdt) == 0) {
    header("Location: tes-kepribadian.php?error=selesaikan_bagian1");
    exit;
}

// 2. Cek apakah user sudah mengerjakan Bagian 2 (PAPI)
$check_papi = mysqli_query($conn, "SELECT id FROM hasil_papi WHERE nip = '$nip'");
if (mysqli_num_rows($check_papi) > 0) {
    header("Location: dashboard.php?status=tes_selesai");
    exit;
}

// 3. Ambil soal PAPI (Bagian 2)
$query = "SELECT * FROM soal WHERE kode_tes = 'KEPRIBADIAN2' AND status = 'aktif' ORDER BY nomor_soal ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bagian 2: | BPS Psikotes</title>
    <link rel="stylesheet" href="style.css">
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
    <section class="welcome-banner">
        <h1>Tes Kepribadian (Bagian 2)</h1>
        <p>Pilihlah satu pernyataan yang paling mencerminkan diri Anda dalam situasi kerja.</p>
    </section>

    <div class="alert-success" style="border-left-color: #07079d; text-align: center;">
        📌 Anda sedang mengerjakan <strong>Bagian 2:</strong>. Terdapat 90 butir soal.
    </div>

    <form action="backend/proses_simpan_papi.php" method="POST" id="answerForm">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="question-card">
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                    <span style="font-weight: bold; color: #07079d;">No. <?= $row['nomor_soal']; ?></span>
                </div>
                
                <div class="options">
                    <label style="display: block; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 10px; cursor: pointer; transition: 0.3s;">
                        <input type="radio" name="jawaban_papi[<?= $row['nomor_soal']; ?>]" value="A" required style="margin-right: 10px;">
                        <strong>A.</strong> <?= htmlspecialchars($row['pertanyaan_a']); ?>
                    </label>
                    
                    <label style="display: block; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; cursor: pointer; transition: 0.3s;">
                        <input type="radio" name="jawaban_papi[<?= $row['nomor_soal']; ?>]" value="B" required style="margin-right: 10px;">
                        <strong>B.</strong> <?= htmlspecialchars($row['pertanyaan_b']); ?>
                    </label>
                </div>
            </div>
        <?php endwhile; ?>

        <div style="margin-top: 30px; padding-bottom: 100px;">
            <button type="submit" class="btn-test btn-blue" onclick="return confirm('Kirim jawaban sekarang? Pastikan semua 90 soal telah terisi.')">
                Kirim Tes Bagian 2 →
            </button>
        </div>
    </form>
</main>

<script>
    // Menambahkan efek hover visual pada label saat radio ditekan
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const container = this.closest('.question-card');
            container.querySelectorAll('label').forEach(l => {
                l.style.backgroundColor = 'white';
                l.style.borderColor = '#e5e7eb';
            });
            if(this.checked) {
                this.parentElement.style.backgroundColor = '#f5f3ff';
                this.parentElement.style.borderColor = '#1f3f74';
            }
        });
    });
</script>

</body>
</html>