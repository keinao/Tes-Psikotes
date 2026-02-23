<?php 
include '../backend/auth_check.php'; 
require_once '../backend/config.php';

// Query untuk mengambil data pegawai dan status pengerjaan di kedua tabel hasil
$queryPegawai = "
SELECT 
    u.nip,
    u.nama,
    u.jabatan,
    u.satuan_kerja,
    h1.nip AS sudah_msdt,
    h2.nip AS sudah_papi
FROM users u
LEFT JOIN hasil_msdt h1 ON u.nip = h1.nip
LEFT JOIN hasil_papi h2 ON u.nip = h2.nip
WHERE u.role = 'peserta'
ORDER BY u.nama ASC
";

$resultPegawai = mysqli_query($conn, $queryPegawai);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Tes Pegawai | Admin BPS</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .badge { padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge-success { background-color: #d4edda; color: #155724; }
        .badge-danger { background-color: #f8d7da; color: #721c24; }
        .btn-action { padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px; color: white; display: inline-block; margin: 2px; }
        .btn-reset-msdt { background-color: #e74c3c; }
        .btn-reset-papi { background-color: #f39c12; }
    </style>
</head>
<body>

<?php include 'includes/sidebar.php'; ?>

<div class="main-content">
    <header>
        <h1>Status Tes Pegawai</h1>
    </header>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'reset_berhasil'): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
            ✓ Data tes berhasil di-reset.
        </div>
    <?php endif; ?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pegawai</th>
                    <th>Unit Kerja</th>
                    <th>Bagian 1 (MSDT)</th>
                    <th>Bagian 2 (PAPI)</th>
                    <th>Aksi Reset</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1;
            while($p = mysqli_fetch_assoc($resultPegawai)): 
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>
                        <strong><?= htmlspecialchars($p['nama']); ?></strong><br>
                        <small>NIP: <?= $p['nip']; ?></small>
                    </td>
                    <td><?= htmlspecialchars($p['satuan_kerja']); ?></td>
                    
                    <td>
                        <?php if ($p['sudah_msdt']): ?>
                            <span class="badge badge-success">Selesai</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Belum</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if ($p['sudah_papi']): ?>
                            <span class="badge badge-success">Selesai</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Belum</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if ($p['sudah_msdt']): ?>
                            <a href="reset_tes.php?nip=<?= $p['nip']; ?>&tipe=msdt" 
                               class="btn-action btn-reset-msdt"
                               onclick="return confirm('Reset hasil MSDT pegawai ini?')">Reset MSDT</a>
                        <?php endif; ?>

                        <?php if ($p['sudah_papi']): ?>
                            <a href="reset_tes.php?nip=<?= $p['nip']; ?>&tipe=papi" 
                               class="btn-action btn-reset-papi"
                               onclick="return confirm('Reset hasil PAPI pegawai ini?')">Reset PAPI</a>
                        <?php endif; ?>

                        <?php if (!$p['sudah_msdt'] && !$p['sudah_papi']): ?>
                            <span style="color: #999;">-</span>
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