<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: ../login.php");
    exit;
}
?>

<?php
include '../../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_kategori'];
    $conn->query("INSERT INTO kategori_produk (nama_kategori) VALUES ('$nama')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RB Reka Cipta (Admin) | Tambah Kategori</title>
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
                        <a class="nav-link active" href="index.php">Kategori</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link " href="../produk/index.php">Produk</a>
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
                            <a class="nav-link active" href="index.php">Kategori</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link " href="../produk/index.php">Produk</a>
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
        <h2 class="mb-4">Tambah Kategori</h2>

        <a href="index.php" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                            placeholder="Masukkan nama kategori" required>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>