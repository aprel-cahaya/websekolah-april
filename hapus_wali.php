<?php
include 'koneksi.php';

// Check if ID is provided
if (isset($_GET['id'])) {
    $id_wali = $_GET['id'];

    // Escape input to prevent SQL injection
    $id_wali = mysqli_real_escape_string($koneksi, $id_wali);

    // Query to delete the record
    $query = "DELETE FROM wali_murid WHERE id_wali = '$id_wali'";

    if (mysqli_query($koneksi, $query)) {
        header('Location: wali_murid.php'); // Redirect to wali_murid page after successful deletion
        exit;
    } else {
        echo "Gagal menghapus data wali!";
    }
} else {
    echo "ID Wali tidak ditemukan!";
}
?>
