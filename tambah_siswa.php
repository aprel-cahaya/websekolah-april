<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nis_query = mysqli_query($koneksi, "SELECT MAX(nis) AS max_nis FROM siswa");
    $nis_result = mysqli_fetch_assoc($nis_query);
    $nis = $nis_result['max_nis'] + 1; 

   

    if (!in_array($jenis_kelamin, ['Laki-laki', 'Perempuan'])) {
        die("Jenis kelamin tidak valid!");
    }
    
    
    $jenis_kelamin = ($jenis_kelamin == 'Laki-laki') ? 'L' : 'P';
    
    
    $query = "INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, tempat_lahir, tanggal_lahir, id_class, id_wali) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ssssssi", $nis, $nama_siswa, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $id_class, $id_wali);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data!');</script>";
    }
    
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Tambah Data Siswa</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama_siswa" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="id_class" class="form-control" required>
                    <?php
                    $kelas_query = mysqli_query($koneksi, "SELECT * FROM kelas");
                    while ($kelas = mysqli_fetch_assoc($kelas_query)) {
                        echo "<option value='{$kelas['id_class']}'>{$kelas['nama_kelas']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Wali Murid</label>
                <select name="id_wali" class="form-control" required>
                    <?php
                    $wali_query = mysqli_query($koneksi, "SELECT * FROM wali_murid");
                    while ($wali = mysqli_fetch_assoc($wali_query)) {
                        echo "<option value='{$wali['id_wali']}'>{$wali['nama_wali']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
