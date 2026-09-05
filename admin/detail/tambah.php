<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: ../login.php");
    exit;
}
?>

<?php
include '../../db.php';

$produk = $conn->query("SELECT * FROM produk");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = $_POST['id_produk'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $link = $_POST['link_produk'];
    $ket = [
        $_POST['keterangan1'],
        $_POST['keterangan2'],
        $_POST['keterangan3'],
        $_POST['keterangan4'],
        $_POST['keterangan5'],
        $_POST['keterangan6'],
        $_POST['keterangan7'],
        $_POST['keterangan8']
    ];
    $deskripsi = $_POST['deskripsi'];

    $conn->query("INSERT INTO detail_produk 
        (id_produk, nama, harga, link_produk, keterangan1, keterangan2, keterangan3, keterangan4, 
         keterangan5, keterangan6, keterangan7, keterangan8, deskripsi) 
        VALUES ('$id_produk', '$nama', '$harga', '$link', 
                '$ket[0]', '$ket[1]', '$ket[2]', '$ket[3]', 
                '$ket[4]', '$ket[5]', '$ket[6]', '$ket[7]', '$deskripsi')");

    $id_detail = $conn->insert_id;

    foreach ($_FILES['gambar']['tmp_name'] as $key => $tmp_name) {
        $filename = $_FILES['gambar']['name'][$key];
        $tmp = $_FILES['gambar']['tmp_name'][$key];
        move_uploaded_file($tmp, "uploads/" . $filename);
        $conn->query("INSERT INTO gambar_detail_produk (id_detail_produk, gambar) VALUES ('$id_detail', '$filename')");
    }

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RB Reka Cipta (Admin) | Tambah Detail Produk</title>
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
                        <a class="nav-link" href="../kategori_produk/index.php">Daftar Kategori</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link " href="../produk/index.php">Daftar Produk</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link active" href="index.php">Daftar Detail Produk</a>
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
                            <a class="nav-link" href="../kategori_produk/index.php">Daftar Kategori</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link " href="../produk/index.php">Daftar Produk</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link active" href="index.php">Daftar Detail Produk</a>
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
        <h2 class="mb-4">Tambah Detail Produk</h2>
        <a href="index.php" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Produk</label>
                <select name="id_produk" class="form-select" required>
                    <?php while ($p = $produk->fetch_assoc()): ?>
                        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nama_produk']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Detail</label>
                <input type="text" name="nama" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Link Produk</label>
                <input type="text" name="link_produk" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan 1 - 8</label>
                <?php for ($i = 1; $i <= 8; $i++): ?>
                    <input type="text" name="keterangan<?= $i ?>" class="form-control mb-2"
                        placeholder="Keterangan <?= $i ?>">
                <?php endfor; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Detail (bisa banyak)</label>
                <input type="file" name="gambar[]" multiple class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Simpan Detail</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>