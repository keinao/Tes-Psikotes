<?php
require_once '../backend/config.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hasil_papi WHERE id = $id"));

// Kelompokkan skor berdasarkan teori PAPI Kostick
$roles = ['G', 'L', 'I', 'T', 'V', 'S', 'R', 'D', 'C', 'E'];
$needs = ['N', 'A', 'P', 'X', 'B', 'O', 'K', 'F', 'W', 'Z'];
?>

<div class="report-box">
    <h3>Hasil Evaluasi Individu</h3>
    
    <div class="grid-report">
        <div class="col">
            <h4>Roles (Peran di Dunia Kerja)</h4>
            <ul>
                <?php foreach($roles as $r): ?>
                    <li>Dimensi <?= $r ?>: <strong><?= $data[$r] ?></strong> / 9</li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="col">
            <h4>Needs (Kebutuhan/Motivasi)</h4>
            <ul>
                <?php foreach($needs as $n): ?>
                    <li>Dimensi <?= $n ?>: <strong><?= $data[$n] ?></strong> / 9</li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>