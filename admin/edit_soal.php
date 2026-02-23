<?php 
require_once '../backend/auth_check.php'; 
require_once '../backend/config.php';

// Pastikan ada ID yang dikirim
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

// Ambil data soal
$query = mysqli_query($conn, "SELECT * FROM soal WHERE id = '$id'");
$d = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$d) {
    header("Location: kelola_soal.php");
    exit;
}

// Proses Update saat tombol diklik
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_soal = mysqli_real_escape_string($conn, $_POST['id']);
    $nomor = mysqli_real_escape_string($conn, $_POST['nomor_soal']);
    $pa = mysqli_real_escape_string($conn, $_POST['pertanyaan_a']);
    $pb = mysqli_real_escape_string($conn, $_POST['pertanyaan_b']);

    $sql_update = "UPDATE soal SET 
                   nomor_soal='$nomor', 
                   pertanyaan_a='$pa', 
                   pertanyaan_b='$pb' 
                   WHERE id='$id_soal'";
    
    if (mysqli_query($conn, $sql_update)) {
        header("Location: kelola_soal.php?msg=update_berhasil");
        exit;
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Soal | Admin BPS</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        /* CSS untuk menaruh konten tepat di tengah layar */
        body {
            background-color: #f4f7f6;
            margin: 0;
            display: flex;
            align-items: center; 
            justify-content: center; 
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
        }

        .container-edit {
            width: 100%;
            max-width: 900px;
            padding: 20px;
        }

        .form-card { 
            background: white; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            border-top: 6px solid #00a2e9;
        }

        .header-flex { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 25px; 
        }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; }
        .form-group input, .form-group textarea { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            font-size: 14px; 
            box-sizing: border-box;
        }

        /* Layout Landscape (Kesamping) */
        .form-row { display: flex; gap: 20px; }
        .form-row > div { flex: 1; }
        
        .btn-update { 
            background: #00a2e9; 
            color: white; 
            border: none; 
            padding: 15px; 
            border-radius: 8px; 
            cursor: pointer; 
            font-size: 16px; 
            font-weight: bold;
            width: 100%; 
            transition: 0.3s;
        }
        .btn-update:hover { background: #00569c; }
        .btn-back { color: #888; text-decoration: none; font-size: 14px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container-edit">
        <header class="header-flex">
            <h1 style="margin:0;">Edit Soal #<?= $d['nomor_soal']; ?></h1>
            <a href="kelola_soal.php" class="btn-back">&larr; Kembali</a>
        </header>

        <div class="form-card">
            <?php if(isset($error)): ?>
                <p style="color:red;"><?= $error; ?></p>
            <?php endif; ?>

            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $d['id']; ?>">

                <div class="form-group" style="width: 150px;">
                    <label>Nomor Soal</label>
                    <input type="number" name="nomor_soal" value="<?= $d['nomor_soal']; ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Pernyataan Opsi A</label>
                        <textarea name="pertanyaan_a" rows="8" required><?= htmlspecialchars($d['pertanyaan_a']); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Pernyataan Opsi B</label>
                        <textarea name="pertanyaan_b" rows="8" required><?= htmlspecialchars($d['pertanyaan_b']); ?></textarea>
                    </div>
                </div>

                <div style="margin-top: 10px;">
                    <button type="submit" class="btn-update">Simpan Perubahan Soal</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>