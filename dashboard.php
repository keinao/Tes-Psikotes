<?php
require_once 'backend/auth_check.php'; 
require_once 'backend/config.php';

$nama = $_SESSION['nama'] ?? 'User';
$nip = $_SESSION['nip'] ?? '-';
$satuan_kerja = $_SESSION['satuan_kerja'] ?? 'BPS Sulawesi Utara'; 

// --- LOGIKA PENGECEKAN STATUS TES ---
// Cek apakah Bagian 1 (MSDT) sudah dikerjakan
$cek_bagian1 = mysqli_query($conn, "SELECT id FROM hasil_msdt WHERE nip = '$nip' AND Ds IS NOT NULL");
$sudah_bagian1 = mysqli_num_rows($cek_bagian1) > 0;

// Cek apakah Bagian 2 (PAPI) sudah dikerjakan (Asumsi nama tabel hasil_papi)
$cek_bagian2 = mysqli_query($conn, "SELECT id FROM hasil_papi WHERE nip = '$nip'");
$sudah_bagian2 = mysqli_num_rows($cek_bagian2) > 0;

// Tentukan URL dan Label Tombol secara dinamis
$url_kepribadian = "tes-kepribadian.php";
$label_kepribadian = "Mulai Tes Kepribadian →";
$status_kelas = "btn-purple";

if ($sudah_bagian1 && !$sudah_bagian2) {
    // Jika Bagian 1 selesai tapi Bagian 2 belum
    $url_kepribadian = "tes-papi.php";
    $label_kepribadian = "Lanjut ke Bagian 2 (PAPI) →";
} elseif ($sudah_bagian1 && $sudah_bagian2) {
    // Jika keduanya sudah selesai
    $url_kepribadian = "#";
    $label_kepribadian = "✓ Tes Selesai";
    $status_kelas = "btn-disabled"; // Tambahkan CSS untuk tombol mati
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Tes Psikologi Pegawai</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS tambahan untuk tombol yang sudah selesai */
        .btn-disabled {
            background-color: #ccc !important;
            cursor: not-allowed;
            pointer-events: none;
        }
        .badge-info {
            font-size: 0.8em;
            background: #eee;
            padding: 2px 8px;
            border-radius: 10px;
            display: inline-block;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="images/logobps.png" alt="Logo BPS">
        <span>Tes Psikologi Pegawai</span>
    </div>

    <div class="user-info">
        <span>Halo, <strong><?= htmlspecialchars($nama); ?></strong></span>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</header>

<main class="container">

    <?php if (isset($_GET['status']) && $_GET['status'] == 'tes_selesai'): ?>
        <div class="alert-success">
            ✓ <strong>Terima Kasih!</strong> Seluruh rangkaian Tes Kepribadian Anda telah berhasil disimpan.
        </div>
    <?php endif; ?>

    <section class="welcome-banner">
        <h1>Selamat Datang di Portal Tes Psikologi</h1>
        <p>Silakan pilih jenis tes yang ingin Anda ikuti</p>
    </section>

    <section class="profile-box">
        <div class="profile-item"><strong><?= htmlspecialchars($nama); ?></strong></div>
        <div class="profile-item"><span>NIP: <?= htmlspecialchars($nip); ?></span></div>
        <div class="profile-item"><span>Unit Kerja: <?= htmlspecialchars($satuan_kerja); ?></span></div>
    </section>

    <section class="test-selection">
        <div class="test-grid">
            
            <div class="test-card card-blue">
                <div class="card-header">
                    <div class="icon-circle blue">🧠</div>
                    <h3>Tes IQ</h3>
                </div>
                <p class="card-desc">Mengukur kemampuan logika, numerik, dan pemahaman pola.</p>
                <div class="card-info">
                    <div class="info-row"><span>Jumlah Soal</span><strong>±40 Soal</strong></div>
                    <div class="info-row"><span>Durasi</span><strong>30 Menit</strong></div>
                </div>
                <button class="btn-test btn-blue" onclick="window.location.href='tes-iq.php'">
                    Mulai Tes IQ →
                </button>
            </div>

            <div class="test-card card-purple">
                <div class="card-header">
                    <div class="icon-circle purple">👤</div>
                    <h3>Tes Kepribadian</h3>
                </div>
                <p class="card-desc">Terdiri dari Bagian 1 (MSDT) dan Bagian 2 (PAPI Kostick).</p>
                <div class="card-info">
                    <div class="info-row">
                        <span>Status</span>
                        <strong>
                            <?php 
                                if (!$sudah_bagian1) echo "Belum Mulai";
                                elseif (!$sudah_bagian2) echo "Bagian 1 Selesai";
                                else echo "Selesai";
                                
                                $url_kepribadian = "tes-kepribadian.php"; // Halaman Bagian 1 (MSDT)
                                $label_kepribadian = "Mulai Tes Kepribadian →";
                                $status_kelas = "btn-purple";

                                if ($sudah_bagian1 && !$sudah_bagian2) {
                                    // Jika Bagian 1 selesai, arahkan ke Bagian 2 (PAPI)
                                    $url_kepribadian = "tes-kepribadian2.php"; 
                                    $label_kepribadian = "Lanjut ke Bagian 2 (PAPI) →";
                                } elseif ($sudah_bagian1 && $sudah_bagian2) {
                                    // Jika keduanya sudah selesai, matikan tombol
                                    $url_kepribadian = "#";
                                    $label_kepribadian = "✓ Tes Selesai";
                                    $status_kelas = "btn-disabled"; 
}
                            ?>
                        </strong>
                    </div>
                    <div class="info-row">
                        <span>Total Soal</span>
                        <strong>64 + 90 Butir</strong>
                    </div>
                </div>
                <button class="btn-test <?= $status_kelas ?>" onclick="window.location.href='<?= $url_kepribadian ?>'">
                    <?= $label_kepribadian ?>
                </button>
            </div>

        </div>
    </section>

    <section class="disclaimer">
        🔒 Hasil tes bersifat rahasia dan digunakan untuk keperluan internal BPS
    </section>

</main>

</body>
</html>