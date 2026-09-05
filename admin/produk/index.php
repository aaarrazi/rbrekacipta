<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: ../login.php");
    exit;
}
?>

<?php
include '../../db.php';

$query = "SELECT produk.*, kategori_produk.nama_kategori FROM produk
          JOIN kategori_produk ON produk.id_kategori = kategori_produk.id";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RB Reka Cipta (Admin) | Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg main-color">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand me-auto" href="#">RIYADHUL BAHRI REKA CIPTA</a>

            <!-- Mobile Toggler -->
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarNav" aria-controls="sidebarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Horizontal menu (desktop) -->
            <div class="collapse navbar-collapse d-none d-lg-block" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-4">
                        <a class="nav-link" href="../index.php">Dashboard</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="../kategori_produk/index.php">Kategori</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link active" href="index.php">Produk</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link " href="../detail/index.php">Detail Produk</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link " href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>

            <!-- Sidebar (mobile) -->
            <div class="offcanvas offcanvas-start d-lg-none sidebar-custom" tabindex="-1" id="sidebarNav"
                aria-labelledby="sidebarNavLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-white" id="sidebarNavLabel">RIYADHUL BAHRI REKA CIPTA</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item me-4">
                            <a class="nav-link" href="../index.php">Dashboard</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link" href="../kategori_produk/index.php">Kategori</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link active" href="index.php">Produk</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link " href="../detail/index.php">Detail Produk</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link " href="../logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h2 class="mb-4">Daftar Produk</h2>

        <div class="mb-3">
            <a href="../index.php" class="btn btn-secondary me-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <a href="tambah.php" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Produk
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td>
                                <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>"
                                    alt="<?= htmlspecialchars($row['nama_produk']) ?>" width="80" class="img-thumbnail">
                            </td>
                            <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mb-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger mb-1"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>