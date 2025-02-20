<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: kelas.php");
    exit();
}

$id = $_GET['id'];

$query = "SELECT * FROM kelas WHERE id_class = $id";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<script>
            alert('Data kelas tidak ditemukan.');
            window.location.href = 'kelas.php';
          </script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kelas = $_POST['nama_kelas'];

    $update_query = "UPDATE kelas SET nama_kelas = '$nama_kelas' WHERE id_class = $id";
    $update_result = mysqli_query($koneksi, $update_query);

    if ($update_result) {
        echo "<script>
                alert('Data kelas berhasil diperbarui.');
                window.location.href = 'kelas.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui data kelas.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Kelas</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" value="<?php echo $row['nama_kelas']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Perbarui</button>
            <a href="kelas.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
