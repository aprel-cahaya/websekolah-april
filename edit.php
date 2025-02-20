<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_siswa = $_GET['id'];
    
    $query = "SELECT * FROM siswa WHERE id_siswa = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_siswa);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $siswa = mysqli_fetch_assoc($result);
    
    if (!$siswa) {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href = 'index.php';</script>";
        exit;
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href = 'index.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_class = $_POST['id_class'];
    $id_wali = $_POST['id_wali'];
    
    $query = "UPDATE siswa SET nama_siswa = ?, jenis_kelamin = ?, tempat_lahir = ?, tanggal_lahir = ?, id_class = ?, id_wali = ? WHERE id_siswa = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ssssiii", $nama_siswa, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $id_class, $id_wali, $id_siswa);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
    
    mysqli_stmt_close($stmt);
}

$kelas_query = mysqli_query($koneksi, "SELECT * FROM kelas");
$wali_query = mysqli_query($koneksi, "SELECT * FROM wali_murid");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Data Siswa</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama_siswa" class="form-control" value="<?php echo $siswa['nama_siswa']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L" <?php echo ($siswa['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?php echo ($siswa['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $siswa['tempat_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $siswa['tanggal_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="id_class" class="form-control" required>
                    <?php while ($kelas = mysqli_fetch_assoc($kelas_query)): ?>
                        <option value="<?php echo $kelas['id_class']; ?>" <?php echo ($siswa['id_class'] == $kelas['id_class']) ? 'selected' : ''; ?>>
                            <?php echo $kelas['nama_kelas']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Wali Murid</label>
                <select name="id_wali" class="form-control" required>
                    <?php while ($wali = mysqli_fetch_assoc($wali_query)): ?>
                        <option value="<?php echo $wali['id_wali']; ?>" <?php echo ($siswa['id_wali'] == $wali['id_wali']) ? 'selected' : ''; ?>>
                            <?php echo $wali['nama_wali']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>