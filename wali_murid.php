<?php
include 'koneksi.php';

// Initialize search variable
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Create the search query if there's input
$search_query = '';
if ($search) {
    $search_query = "WHERE nama_wali LIKE '%$search%'";
}


$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get current page, default to 1
$start = ($page - 1) * $limit; // Calculate the starting record for the SQL query

// Count total records
$total_result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kelas $search_query");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'] ?? 0;
$total_pages = ($total_records > 0) ? ceil($total_records / $limit) : 1;



// Ambil data siswa
$query = "SELECT * FROM wali_murid $search_query LIMIT $start, $limit";

$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Wali Murid</title>
    <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Data Wali Murid</h2>
        <div class="d-flex justify-content-between mb-3">
                <a href="index.php" class="btn btn-primary">Kembali ke Data Siswa</a>
                <form method="GET" class="d-flex">
                    <input type="text" name="search" class = "form-control me-2" placeholder = "Cari wali murid..." value = "<?php echo $search; ?>">
                    <button type="submit" class = "btn btn-succes">Cari</button>
                </form>
                <a href="tambah_wali.php" class ="btn btn-succes">Tambah Wali Murid</a>
        </div>
        <table class="table table-bordered">
            <thead class="table-dark">

                <tr>
                    <th>Nama Wali</th>
                    <th>No Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row =mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['nama_wali']; ?>  </td>
                    <td><?php echo $row['kontak']; ?>  </td>
                    <td>
                        <a href="edit_wali.php?id=<?php echo $row['id_wali']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus_wali.php?id=<?php echo $row['id_wali']; ?>" class="btn btn-danger btn-sm "onclick = "return confirm('Yakin ingin menghapus?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="pages-item <?php if ($page == $i) echo 'active'; ?>">
                    <a class= "pages-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"> <?php echo $i;?></a>
                    </li>
                    <?php endfor;?>
            </ul>
        </nav>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>