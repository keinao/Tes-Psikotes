<?php 
require_once '../backend/config.php';
include '../backend/auth_check.php';

// Logika penyimpanan soal
if (isset($_POST['tambah'])) {
    $kode_tes = mysqli_real_escape_string($conn, $_POST['kode_tes']);
    $nomor_soal = mysqli_real_escape_string($conn, $_POST['nomor_soal']);
    $pertanyaan_a = mysqli_real_escape_string($conn, $_POST['pertanyaan_a']);
    $pertanyaan_b = mysqli_real_escape_string($conn, $_POST['pertanyaan_b']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "INSERT INTO soal (kode_tes, nomor_soal, pertanyaan_a, pertanyaan_b, status) 
              VALUES ('$kode_tes', '$nomor_soal', '$pertanyaan_a', '$pertanyaan_b', '$status')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: kelola_soal.php?status=tambah_berhasil");
    } else {
        $error = "Gagal menambah soal: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Soal Baru</title>
    <link rel="stylesheet" href="admin-style.css"> <style>
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            max-width: 800px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        .form-group textarea { height: 80px; resize: vertical; }
        .btn-submit {
            background-color: #00a2e9;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-submit:hover { background-color: #0086c2; }
        .btn-cancel {
            text-decoration: none;
            color: #666;
            margin-left: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="sidebar"> <div class="sidebar-logo">
        <img src="../images/logobps.png" alt="BPS">
        <span>Admin Panel</span>
    </div>
    <nav>
        <a href="status_pegawai.php">Status Pegawai</a>
        <a href="kelola_soal.php" class="active">Kelola Soal</a>
        <a href="hasil_peserta.php">Hasil Tes</a>
        <a href="../logout.php">Logout</a>
    </nav>
</div>

<div class="main-content">
    <header>
        <h1>Tambah Soal Baru</h1>
        <p>Silakan isi detail soal untuk modul tes psikologi.</p>
    </header>

    <?php if(isset($error)): ?>
        <div style="color: red; margin-bottom: 20px;"><?= $error ?></div>
    <?php endif; ?>

    <div class="form-container">
        <form action="" method="POST">
            <div class="form-group">
                <label>Jenis Tes</label>
                <select name="kode_tes" required>
                    <option value="KEPRIBADIAN">Kepribadian-Bagian 1</option>
                    <option value="KEPRIBADIAN2">Kepribadian-Bagian 2</option>
                    <option value="IQ">Tes IQ</option>

                </select>
            </div>

            <div class="form-group">
                <label>Nomor Soal</label>
                <input type="number" name="nomor_soal" placeholder="Contoh: 1" required>
            </div>

            <div class="form-group">
                <label>Pernyataan A</label>
                <textarea name="pertanyaan_a" placeholder="Masukkan pernyataan pilihan A..." required></textarea>
            </div>

            <div class="form-group">
                <label>Pernyataan B</label>
                <textarea name="pertanyaan_b" placeholder="Masukkan pernyataan pilihan B..." required></textarea>
            </div>

            <div class="form-group">
                <label>Status Soal</label>
                <select name="status">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Non-Aktif</option>
                </select>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" name="tambah" class="btn-submit">Simpan Soal</button>
                <a href="kelola_soal.php" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>