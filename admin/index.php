<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit;
}

include '../db.php';

// Hitung data
$jumlah_kategori = $conn->query("SELECT COUNT(*) AS total FROM kategori_produk")->fetch_assoc()['total'];
$jumlah_produk = $conn->query("SELECT COUNT(*) AS total FROM produk")->fetch_assoc()['total'];
$jumlah_detail = $conn->query("SELECT COUNT(*) AS total FROM detail_produk")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RB Reka Cipta (Admin) | Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card-dashboard {
            transition: transform 0.3s ease;
        }

        .card-dashboard:hover {
            transform: scale(1.03);
        }
    </style>
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
                        <a class="nav-link active" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="kategori_produk/index.php">Kategori</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="produk/index.php">Produk</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="detail/index.php">Detail Produk</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="logout.php">Logout</a>
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
                        <li class="nav-item mb-2">
                            <a class="nav-link active" href="index.php">Dashboard</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="kategori_produk/index.php">Kategori</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="produk/index.php">Produk</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="detail/index.php">Detail Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container py-5">
        <h2 class="mb-4 text-center">Dashboard Admin</h2><br>
        <div class="row g-4 justify-content-center">

            <div class="col-sm-6 col-lg-4">
                <div class="card shadow card-dashboard">
                    <div class="card-body text-center">
                        <i class="bi bi-tags-fill fs-1 text-primary"></i>
                        <h5 class="card-title mt-3">Kategori Produk</h5>
                        <p class="card-text"><?= $jumlah_kategori ?> data</p>
                        <a href="kategori_produk/index.php" class="btn btn-outline-primary w-100">Kelola Kategori</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="card shadow card-dashboard">
                    <div class="card-body text-center">
                        <i class="bi bi-box-seam fs-1 text-success"></i>
                        <h5 class="card-title mt-3">Produk</h5>
                        <p class="card-text"><?= $jumlah_produk ?> data</p>
                        <a href="produk/index.php" class="btn btn-outline-success w-100">Kelola Produk</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="card shadow card-dashboard">
                    <div class="card-body text-center">
                        <i class="bi bi-card-list fs-1 text-warning"></i>
                        <h5 class="card-title mt-3">Detail Produk</h5>
                        <p class="card-text"><?= $jumlah_detail ?> data</p>
                        <a href="detail/index.php" class="btn btn-outline-warning w-100">Kelola Detail</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>