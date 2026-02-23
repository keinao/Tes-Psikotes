<?php
require_once '../backend/config.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $query = "DELETE FROM soal WHERE id = '$id'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php?msg=hapus_sukses");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit();
}