<?php 
include '../backend/auth_check.php'; 
require_once '../backend/config.php';


// Ambil semua soal dari database
$query = "SELECT * FROM soal ORDER BY kode_tes, nomor_soal ASC";
$result = mysqli_query($conn, $query);

// Kelompokkan soal berdasarkan jenisnya
$soals = ['KEPRIBADIAN' => [], 'KEPRIBADIAN2' => [], 'IQ' => []];
while($row = mysqli_fetch_assoc($result)) {
    $soals[$row['kode_tes']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Soal | Admin BPS</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        /* Tampilan Tab CSS Sederhana */
        .tabs { display: flex; gap: 10px; margin-bottom: 20px; border-bottom: 2px solid #ddd; padding-bottom: 10px; }
        .tab-btn { padding: 10px 20px; border: none; background: #eee; cursor: pointer; border-radius: 5px; font-weight: bold; }
        .tab-btn.active { background: #00a2e9; color: white; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        
        /* Card Tampilan Soal */
        .soal-card { background: white; border-radius: 8px; padding: 15px; margin-bottom: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-left: 5px solid #00a2e9; }
        .card-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px; }
        .grid-opsi { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .opsi { background: #f9f9f9; padding: 10px; border-radius: 5px; font-size: 14px; }
    </style>
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    <div class="sidebar-logo">
        <img src="../images/logobps.png" alt="BPS">
        <span>Admin Panel</span>
    </div>
    <div class="main-content">
        <header>
            <h1>Manajemen Bank Soal</h1>
            <a href="tambah_soal.php" class="btn-add">+ Tambah Soal Baru</a>
        </header>

        <div class="tabs">
            <button class="tab-btn active" onclick="openTab(event, 'msdt')">Bagian 1 (MSDT)</button>
            <button class="tab-btn" onclick="openTab(event, 'papi')">Bagian 2 (PAPI)</button>
            <button class="tab-btn" onclick="openTab(event, 'iq')">Tes IQ</button>
        </div>

        <div id="msdt" class="tab-content active">
            <?php foreach($soals['KEPRIBADIAN'] as $s): ?>
                <div class="soal-card">
                    <div class="card-header">
                        <strong>No. <?= $s['nomor_soal'] ?></strong>
                        <div>
                            <a href="edit_soal.php?id=<?= $s['id'] ?>" class="text-blue">Edit</a> | 
                            <a href="hapus_soal.php?id=<?= $s['id'] ?>" class="text-red" onclick="return confirm('Hapus?')">Hapus</a>
                        </div>
                    </div>
                    <div class="grid-opsi">
                        <div class="opsi"><strong>A:</strong> <?= $s['pertanyaan_a'] ?></div>
                        <div class="opsi"><strong>B:</strong> <?= $s['pertanyaan_b'] ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="papi" class="tab-content">
            <?php foreach($soals['KEPRIBADIAN2'] as $s): ?>
                <div class="soal-card" style="border-left-color: #f39c12;">
                    <div class="card-header">
                        <strong>No. <?= $s['nomor_soal'] ?> (PAPI)</strong>
                        <div>
                            <a href="edit_soal.php?id=<?= $s['id'] ?>">Edit</a> | 
                            <a href="hapus_soal.php?id=<?= $s['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
                        </div>
                    </div>
                    <div class="grid-opsi">
                        <div class="opsi"><strong>A:</strong> <?= $s['pertanyaan_a'] ?></div>
                        <div class="opsi"><strong>B:</strong> <?= $s['pertanyaan_b'] ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="iq" class="tab-content">
            <?php if(empty($soals['IQ'])) echo "<p>Belum ada soal IQ.</p>"; ?>
            </div>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) { tabcontent[i].style.display = "none"; }
            tablinks = document.getElementsByClassName("tab-btn");
            for (i = 0; i < tablinks.length; i++) { tablinks[i].className = tablinks[i].className.replace(" active", ""); }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</body>
</html>