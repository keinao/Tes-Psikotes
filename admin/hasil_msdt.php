<?php include '../backend/auth_check.php'; ?>
<?php require_once '../backend/config.php';

// PERBAIKAN: Query disederhanakan sesuai struktur tabel hasil_msdt yang baru
$query = "SELECT u.nama, h.nip, h.to_score, h.ro_score, h.e_score, h.o_score 
          FROM hasil_msdt h
          JOIN users u ON h.nip = u.nip
          WHERE u.role = 'peserta'
          ORDER BY h.id DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil MSDT | Admin BPS</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .score-box { font-weight: bold; color: #00a2e9; font-size: 1.1em; text-align: center; }
        .table-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; padding: 15px; text-align: center; border-bottom: 2px solid #dee2e6; }
        td { padding: 15px; border-bottom: 1px solid #eee; }
        .btn-export { background: #28a745; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 0.9em; }
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
        <header>
            <h1>Hasil Perhitungan Skor</h1>
        </header>
        <p style="margin-top: 20px; color: #292929; font-style: italic;">
            * Data berikut adalah skor murni (TO, RO, E, O).
        </p>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="text-align: left;">NIP</th>
                        <th style="text-align: left;">Nama Pegawai</th>
                        <th>TO</th>
                        <th>RO</th>
                        <th>E</th>
                        <th>O (Ds)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['nip']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td class="score-box"><?= $row['to_score']; ?></td>
                            <td class="score-box"><?= $row['ro_score']; ?></td>
                            <td class="score-box"><?= $row['e_score']; ?></td>
                            <td class="score-box"><?= $row['o_score']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align:center;">Belum ada peserta yang menyelesaikan tes.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>