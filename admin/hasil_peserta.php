<?php 
include '../backend/auth_check.php'; 
require_once '../backend/config.php';


// Query yang sudah diperbaiki kolomnya (menggunakan tanggal_tes)
$query = "
SELECT 
    u.nip, 
    u.nama, 
    u.satuan_kerja,
    h1.tanggal_tes AS tgl_msdt,
    h2.tanggal_tes AS tgl_papi
FROM users u
LEFT JOIN hasil_msdt h1 ON u.nip = h1.nip
LEFT JOIN hasil_papi h2 ON u.nip = h2.nip
WHERE h1.nip IS NOT NULL OR h2.nip IS NOT NULL
ORDER BY u.nama ASC
";
$result = mysqli_query($conn, $query);

// Cek jika query gagal untuk debug lebih lanjut
if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Tes Pegawai | Admin BPS</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .btn-view {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            margin: 2px;
            transition: 0.3s;
        }
        .btn-msdt { background-color: #3498db; color: white; border: 1px solid #2980b9; }
        .btn-papi { background-color: #f39c12; color: white; border: 1px solid #d35400; }
        .btn-msdt:hover { background-color: #2980b9; }
        .btn-papi:hover { background-color: #d35400; }
        
        .status-tag {
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 4px;
            background: #f0f0f0;
            color: #666;
            display: block;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">
        <img src="../images/logobps.png" alt="BPS">
        <span>Admin Panel</span>
    </div>
</div>
<?php include 'includes/sidebar.php'; ?>

<div class="main-content">
    <header>
        <h1>Laporan Hasil Tes Psikologi</h1>
        <p>Silakan pilih kategori tes untuk melihat analisis mendalam.</p>
    </header>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Informasi Pegawai</th>
                    <th>Unit Kerja</th>
                    <th style="text-align: center;">Aksi Lihat Hasil</th>
                </tr>
            </thead>
            <tbody>
        <div class="action-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Daftar Hasil Tes Pegawai</h2>
                <div class="export-buttons">
                    <a href="export_msdt.php" class="btn-view" style="background-color: #28a745; color: white;">
                    Excel Rekap MSDT
                    </a>
                <a href="export_papi.php" class="btn-view" style="background-color: #17a2b8; color: white;">
                    Excel Rekap PAPI
                </a>
            </div>
        </div>
                <?php 
                $no = 1;
                while($row = mysqli_fetch_assoc($result)): 
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>
                        <strong><?= htmlspecialchars($row['nama']); ?></strong><br>
                        <small>NIP: <?= $row['nip']; ?></small>
                    </td>
                    <td><?= htmlspecialchars($row['satuan_kerja']); ?></td>
                    <td style="text-align: center;">
                        <?php if($row['tgl_msdt']): ?>
                            <a href="hasil_msdt.php?nip=<?= $row['nip']; ?>" class="btn-view btn-msdt">
                                📊 Lihat MSDT
                            </a>
                        <?php else: ?>
                            <span class="status-tag">MSDT Belum Ada</span>
                        <?php endif; ?>

                        <?php if($row['tgl_papi']): ?>
                            <a href="hasil_papi.php?nip=<?= $row['nip']; ?>" class="btn-view btn-papi">
                                📊 Lihat PAPI
                            </a>
                        <?php else: ?>
                            <span class="status-tag">PAPI Belum Ada</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>