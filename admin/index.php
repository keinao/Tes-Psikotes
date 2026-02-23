<?php 
require_once '../backend/config.php';
include '../backend/auth_check.php';

// Mengambil ringkasan data untuk dashboard
$count_pegawai = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role = 'peserta'"))['total'];
$count_msdt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM hasil_msdt"))['total'];
$count_papi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM hasil_papi"))['total'];
$last_activity = mysqli_query($conn, "SELECT u.nama, 'MSDT' as jenis, h.tanggal_tes FROM hasil_msdt h JOIN users u ON h.nip = u.nip 
                                      UNION 
                                      SELECT u.nama, 'PAPI' as jenis, h.tanggal_tes FROM hasil_papi h JOIN users u ON h.nip = u.nip 
                                      ORDER BY tanggal_tes DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - BPS Psikotes</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        /* Style tambahan khusus untuk elemen dashboard agar tidak kosong */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }
        .card-info h3 { margin: 0; font-size: 28px; color: #333; }
        .card-info p { margin: 5px 0 0; color: #777; font-size: 14px; }
        
        .recent-activity {
            margin-top: 30px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .recent-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .recent-table th, .recent-table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        .badge {
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-msdt { background: #e3f2fd; color: #1976d2; }
        .badge-papi { background: #f3e5f5; color: #7b1fa2; }
    </style>
</head>
<body>
<?php include 'includes/sidebar.php'; ?>
<div class="main-content">
    <header>
        <h1>Selamat Datang, Admin</h1>
        <p>Sistem Informasi Tes Psikologi BPS Provinsi Sulawesi Utara.</p>
    </header>

    <div class="dashboard-cards">
        <div class="card">
            <div class="card-icon" style="background: #00a2e9;">👥</div>
            <div class="card-info">
                <h3><?= $count_pegawai ?></h3>
                <p>Total Pegawai</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon" style="background: #28a745;">📄</div>
            <div class="card-info">
                <h3><?= $count_msdt ?></h3>
                <p>Hasil Tes Kepribadian Bagian 1</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon" style="background: #7c3aed;">📊</div>
            <div class="card-info">
                <h3><?= $count_papi ?></h3>
                <p>Hasil Tes Kepribdian Bagian 2</p>
            </div>
        </div>
    </div>

    <div class="recent-activity">
        <h3>Aktivitas Tes Terbaru</h3>
        <table class="recent-table">
            <thead>
                <tr>
                    <th>Nama Pegawai</th>
                    <th>Jenis Tes</th>
                    <th>Tanggal Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($last_activity)): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($row['nama']) ?></strong></td>
                    <td>
                        <span class="badge <?= $row['jenis'] == 'MSDT' ? 'badge-msdt' : 'badge-papi' ?>">
                            <?= $row['jenis'] ?>
                        </span>
                    </td>
                    <td><?= date('d M Y, H:i', strtotime($row['tanggal_tes'])) ?></td>
                </tr>
                <?php endwhile; ?>
                <?php if(mysqli_num_rows($last_activity) == 0): ?>
                    <tr><td colspan="3" style="text-align:center;">Belum ada aktivitas tes.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>