<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_wali = $_GET['id'];

    $id_wali = mysqli_real_escape_string($koneksi, $id_wali);

    $query = "DELETE FROM wali_murid WHERE id_wali = '$id_wali'";

    if (mysqli_query($koneksi, $query)) {
        header('Location: wali_murid.php'); 
        exit;
    } else {
        echo "Gagal menghapus data wali!";
    }
} else {
    echo "ID Wali tidak ditemukan!";
}
?>
