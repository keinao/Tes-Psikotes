<?php
require_once '../backend/config.php';
include '../backend/auth_check.php';

header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Hasil_MSDT_BPS.xls");

$query = "SELECT u.nama, u.nip, h.to_score, h.ro_score, h.e_score, h.o_score, h.tanggal_tes 
          FROM hasil_msdt h 
          JOIN users u ON h.nip = u.nip 
          ORDER BY h.tanggal_tes DESC";
$result = mysqli_query($conn, $query);
?>

<table border="1">
    <tr>
        <th colspan="7" style="font-size: 16px;">REKAPITULASI HASIL TES MSDT</th>
    </tr>
    <tr>
        <th>No</th>
        <th>NIP</th>
        <th>Nama Pegawai</th>
        <th>TO</th>
        <th>RO</th>
        <th>E</th>
        <th>O (Ds)</th>
        <th>Tanggal Tes</th>
    </tr>
    <?php 
    $no = 1;
    while($row = mysqli_fetch_assoc($result)): 
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td>'<?= $row['nip']; ?></td> <td><?= $row['nama']; ?></td>
        <td><?= $row['to_score']; ?></td>
        <td><?= $row['ro_score']; ?></td>
        <td><?= $row['e_score']; ?></td>
        <td><?= $row['o_score']; ?></td>
        <td><?= $row['tanggal_tes']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>