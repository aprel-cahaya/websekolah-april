<?php
include 'koneksi.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_wali = $_POST['nama_wali'] ;
    $kontak = $_POST['kontak'];


        // Insert into database
        $query = "INSERT INTO wali_murid (nama_wali, kontak) VALUES ('$nama_wali', '$kontak')";
        if (mysqli_query($koneksi, $query)) {
            header('Location: wali_murid.php'); 
        } else {
            echo "error: " .$query . "<br>" . mysqli_error ($koneksi);
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Tambah Wali Murid</h2>
        <div class="d-flex justify-content-between mb-3">
        </div>

        <form method="POST">
            <div class="mb-3">
                <label for="nama_wali" class="form-label">Nama Wali</label>
                <input type="text" class="form-control" id="nama_wali" name="nama_wali" required>
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">No Telepon</label>
                <input type="number" class="form-control" id="kontak" name="kontak"  required>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
            <a href="wali_murid.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
