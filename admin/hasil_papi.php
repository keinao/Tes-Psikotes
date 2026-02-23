<?php 
require_once '../backend/config.php';
include '../backend/auth_check.php';

$nip = mysqli_real_escape_string($conn, $_GET['nip']);

// Ambil data hasil PAPI dan Profil User
$query = "SELECT u.nama, h.* FROM hasil_papi h 
          JOIN users u ON h.nip = u.nip 
          WHERE h.nip = '$nip' LIMIT 1";
$res = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($res);

if (!$data) {
    die("Data hasil PAPI tidak ditemukan.");
}

// Pengelompokan Dimensi
$roles = [
    'G' => 'Hard Intense Worked', 'L' => 'Leadership Role', 'I' => 'Ease in Decision Making',
    'T' => 'Theoretical Type', 'V' => 'Vigorous Type', 'S' => 'Social Adability',
    'R' => 'Self-Conditioning', 'D' => 'Interest in Details', 'C' => 'Organized Type', 'E' => 'Emotional Restraint'
];

$needs = [
    'N' => 'Need to Finish a Task', 'A' => 'Need to Achieve', 'P' => 'Need to Control Others',
    'X' => 'Need to be Noticed', 'B' => 'Need to Belong to Groups', 'O' => 'Need for Closeness',
    'Z' => 'Need for Change', 'K' => 'Need to be Forceful', 'F' => 'Need to Support Authority', 'W' => 'Need for Rules and Supervision'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil PAPI - <?= htmlspecialchars($data['nama']) ?></title>
    <link rel="stylesheet" href="admin-style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .papi-grid { display: grid; grid-template-columns: 1fr 1.2fr; gap: 20px; margin-top: 20px; }
        .chart-container { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
        .user-profile-card { 
            background: linear-gradient(135deg, #00a2e9 0%, #007bb5 100%); 
            color: white; padding: 25px; border-radius: 12px; margin-bottom: 25px;
        }
        .user-profile-card h2 { margin: 0; font-size: 24px; text-transform: uppercase; letter-spacing: 1px; }
        .user-profile-card p { margin: 5px 0 0; opacity: 0.9; font-size: 16px; }
        .table-skor { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table-skor th, .table-skor td { border: 1px solid #eee; padding: 10px; text-align: left; font-size: 14px; }
        .table-skor th { background-color: #fcfcfc; color: #555; }
        .dimensi-code { font-weight: bold; color: #00a2e9; width: 45px; text-align: center; }
        .score-value { text-align: center; font-weight: bold; width: 50px; background: #f9f9f9; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">
        <img src="../images/logobps.png" alt="BPS">
        <span>Admin Panel</span>
    </div>
    <nav>
        <a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Dashboard</a>
        <a href="status_pegawai.php">Status Pegawai</a>
        <a href="kelola_soal.php">Kelola Soal</a>
        <a href="hasil_peserta.php" class="active">Hasil Tes</a>
        <a href="../logout.php">Logout</a>
    </nav>
</div>

<div class="main-content">
    <div class="user-profile-card">
        <p>Laporan Hasil Evaluasi Individu</p>
        <h2><?= htmlspecialchars($data['nama']) ?></h2>
        <p>NIP: <?= htmlspecialchars($data['nip']) ?> | Tanggal Tes: <?= date('d F Y', strtotime($data['tanggal_tes'])) ?></p>
    </div>

    <div class="papi-grid">
        <div class="chart-container">
            <h3 style="margin-bottom: 20px; text-align: center; color: #333;">Profil Kepribadian (Radar)</h3>
            <canvas id="papiRadarChart"></canvas>
        </div>

        <div class="chart-container">
            <h3 style="color: #00a2e9; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">Roles (Peran Kerja)</h3>
            <table class="table-skor">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Keterangan Dimensi</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($roles as $kode => $ket): ?>
                    <tr>
                        <td class="dimensi-code"><?= $kode ?></td>
                        <td><?= $ket ?></td>
                        <td class="score-value"><?= $data[$kode] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="chart-container" style="grid-column: span 2;">
            <h3 style="color: #00a2e9; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">Needs (Kebutuhan & Motivasi)</h3>
            <table class="table-skor">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Keterangan Dimensi</th>
                        <th>Skor</th>
                        <th style="border-left: 2px solid #eee;">Kode</th>
                        <th>Keterangan Dimensi</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $n_keys = array_keys($needs);
                    for($i=0; $i < 5; $i++): 
                        $k1 = $n_keys[$i];
                        $k2 = $n_keys[$i+5];
                    ?>
                    <tr>
                        <td class="dimensi-code"><?= $k1 ?></td>
                        <td><?= $needs[$k1] ?></td>
                        <td class="score-value"><?= $data[$k1] ?></td>
                        <td class="dimensi-code" style="border-left: 2px solid #eee;"><?= $k2 ?></td>
                        <td><?= $needs[$k2] ?></td>
                        <td class="score-value"><?= $data[$k2] ?></td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('papiRadarChart');
new Chart(ctx, {
    type: 'radar',
    data: {
        labels: <?= json_encode(array_keys(array_merge($roles, $needs))) ?>,
        datasets: [{
            label: 'Skor Dimensi',
            data: <?= json_encode(array_values(array_intersect_key($data, array_merge($roles, $needs)))) ?>,
            fill: true,
            backgroundColor: 'rgba(0, 162, 233, 0.2)',
            borderColor: 'rgb(0, 162, 233)',
            pointBackgroundColor: 'rgb(0, 162, 233)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(0, 162, 233)'
        }]
    },
    options: {
        elements: { line: { borderWidth: 3 } },
        scales: {
            r: {
                angleLines: { display: true },
                suggestedMin: 0,
                suggestedMax: 9, // Sesuai skor maksimal PAPI
                ticks: {
                    display: false, // Menghilangkan angka 1-9 pada grafik
                    stepSize: 1
                },
                pointLabels: {
                    font: { size: 12, weight: 'bold' },
                    color: '#555'
                }
            }
        },
        plugins: {
            legend: { display: false } // Sembunyikan label dataset agar lebih bersih
        }
    }
});
</script>

</body>
</html>