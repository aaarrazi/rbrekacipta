<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: ../login.php");
    exit;
}
?>

<?php
include '../../db.php';
$id = $_GET['id'];

$produk = $conn->query("SELECT * FROM produk WHERE id = $id")->fetch_assoc();
$kategori = $conn->query("SELECT * FROM kategori_produk");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kategori = $_POST['id_kategori'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "uploads/" . $gambar);
        $conn->query("UPDATE produk SET id_kategori='$id_kategori', nama_produk='$nama', harga='$harga', gambar='$gambar' WHERE id=$id");
    } else {
        $conn->query("UPDATE produk SET id_kategori='$id_kategori', nama_produk='$nama', harga='$harga' WHERE id=$id");
    }

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RB Reka Cipta (Admin) | Edit Produk</title>
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
        <h2 class="mb-4">Edit Produk</h2>

        <a href="index.php" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="form-select" required>
                            <?php while ($k = $kategori->fetch_assoc()): ?>
                                <option value="<?= $k['id'] ?>" <?= ($k['id'] == $produk['id_kategori']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($k['nama_kategori']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control"
                            value="<?= htmlspecialchars($produk['nama_produk']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control"
                            value="<?= $produk['harga'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Baru (Opsional)</label>
                        <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                        <div class="mt-2">
                            <small>Gambar saat ini:</small><br>
                            <img src="uploads/<?= htmlspecialchars($produk['gambar']) ?>" width="120"
                                class="img-thumbnail">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save2"></i> Update Produk
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>