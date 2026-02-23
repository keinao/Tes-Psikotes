<?php
require_once '../backend/config.php';
include '../backend/auth_check.php';

header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Hasil_PAPI_BPS.xls");

$query = "SELECT u.nama, h.* FROM hasil_papi h 
          JOIN users u ON h.nip = u.nip 
          ORDER BY h.tanggal_tes DESC";
$result = mysqli_query($conn, $query);
?>

<table border="1">
    <tr>
        <th colspan="23" style="font-size: 16px;">REKAPITULASI HASIL TES PAPI KOSTICK</th>
    </tr>
    <tr>
        <th>No</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>G</th><th>L</th><th>I</th><th>T</th><th>V</th><th>S</th><th>R</th><th>D</th><th>C</th><th>E</th>
        <th>N</th><th>A</th><th>P</th><th>X</th><th>B</th><th>O</th><th>K</th><th>F</th><th>W</th><th>Z</th>
        <th>Tanggal Tes</th>
    </tr>
    <?php 
    $no = 1;
    while($row = mysqli_fetch_assoc($result)): 
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td>'<?= $row['nip']; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['G']; ?></td><td><?= $row['L']; ?></td><td><?= $row['I']; ?></td>
        <td><?= $row['T']; ?></td><td><?= $row['V']; ?></td><td><?= $row['S']; ?></td>
        <td><?= $row['R']; ?></td><td><?= $row['D']; ?></td><td><?= $row['C']; ?></td>
        <td><?= $row['E']; ?></td><td><?= $row['N']; ?></td><td><?= $row['A']; ?></td>
        <td><?= $row['P']; ?></td><td><?= $row['X']; ?></td><td><?= $row['B']; ?></td>
        <td><?= $row['O']; ?></td><td><?= $row['K']; ?></td><td><?= $row['F']; ?></td>
        <td><?= $row['W']; ?></td><td><?= $row['Z']; ?></td>
        <td><?= $row['tanggal_tes']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>