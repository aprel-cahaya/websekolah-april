<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);

    if (!empty($nama_kelas)) {
        $query = "INSERT INTO kelas (nama_kelas) VALUES ('$nama_kelas')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Kelas berhasil ditambahkan!'); window.location='kelas.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan kelas!');</script>";
        }
    } else {
        echo "<script>alert('Nama kelas tidak boleh kosong!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Tambah Kelas</h2>
        <a href="kelas.php" class="btn btn-secondary mb-3">Kembali</a>
        <form method="POST">
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
