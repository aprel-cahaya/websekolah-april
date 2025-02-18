<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_siswa = $_GET['id'];
    
    $query = "DELETE FROM siswa WHERE id_siswa = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_siswa);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location.href = 'index.php';</script>";
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href = 'index.php';</script>";
}
?>