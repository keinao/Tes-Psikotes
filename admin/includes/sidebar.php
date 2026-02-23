<?php 
// Mengambil nama file yang sedang aktif secara otomatis
$current_page = basename($_SERVER['PHP_SELF']); 
?>

<div class="sidebar">
    <div class="sidebar-logo">
        <img src="../images/logobps.png" alt="BPS">
        <span>Admin Panel</span>
    </div>
    <nav>
        <a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Dashboard</a>
        
        <a href="status_pegawai.php" class="<?= ($current_page == 'status_pegawai.php') ? 'active' : '' ?>">Status Pegawai</a>
        
        <a href="kelola_soal.php" class="<?= (in_array($current_page, ['kelola_soal.php', 'tambah_soal.php', 'edit_soal.php'])) ? 'active' : '' ?>">Kelola Soal</a>
        
        <a href="hasil_peserta.php" class="<?= (in_array($current_page, ['hasil_peserta.php', 'hasil_msdt.php', 'hasil_papi.php'])) ? 'active' : '' ?>">Hasil Tes</a>
        
        <a href="../logout.php">Logout</a>
    </nav>
</div>