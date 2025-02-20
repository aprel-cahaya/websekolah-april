<?php
include 'koneksi.php';

$error_message = '';


if (isset($_GET['id'])) {
    $id_wali = $_GET['id'];

    $id_wali = mysqli_real_escape_string($koneksi, $id_wali);
    $query = "SELECT * FROM wali_murid WHERE id_wali = '$id_wali'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama_wali = $row['nama_wali'];
        $kontak = $row['kontak'];
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_wali = isset($_POST['nama_wali']) ? $_POST['nama_wali'] : '';
    $kontak = isset($_POST['kontak']) ? $_POST['kontak'] : '';

        $query = "UPDATE wali_murid SET nama_wali = '$nama_wali', kontak = '$kontak' WHERE id_wali = '$id_wali'";

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
    <title>Edit Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Wali Murid</h2>
        <div class="d-flex justify-content-between mb-3">
           
        </div>
        
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="nama_wali" class="form-label">Nama Wali</label>
                <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?php echo htmlspecialchars($nama_wali); ?>" required>
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">No Telepon</label>
                <input type="text" class="form-control" id="kontak" name="kontak" value="<?php echo htmlspecialchars($kontak); ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Perbarui</button>
             <a href="wali_murid.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>