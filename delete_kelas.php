<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM kelas WHERE id_class = $id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                alert('Data kelas berhasil dihapus.');
                window.location.href = 'kelas.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data kelas.');
                window.location.href = 'kelas.php';
              </script>";
    }
} else {
    header("Location: kelas.php");
}
?>
