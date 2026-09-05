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

$detail = $conn->query("SELECT * FROM detail_produk WHERE id = $id")->fetch_assoc();
$produk = $conn->query("SELECT * FROM produk");
$gambar = $conn->query("SELECT * FROM gambar_detail_produk WHERE id_detail_produk = $id");

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

    $conn->query("UPDATE detail_produk SET
        id_produk='$id_produk', nama='$nama', harga='$harga', link_produk='$link',
        keterangan1='$ket[0]', keterangan2='$ket[1]', keterangan3='$ket[2]', keterangan4='$ket[3]',
        keterangan5='$ket[4]', keterangan6='$ket[5]', keterangan7='$ket[6]', keterangan8='$ket[7]',
        deskripsi='$deskripsi' WHERE id = $id");

    foreach ($_FILES['gambar']['tmp_name'] as $key => $tmp_name) {
        if (!empty($_FILES['gambar']['name'][$key])) {
            $filename = $_FILES['gambar']['name'][$key];
            move_uploaded_file($tmp_name, "uploads/" . $filename);
            $conn->query("INSERT INTO gambar_detail_produk (id_detail_produk, gambar) VALUES ('$id', '$filename')");
        }
    }

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RB Reka Cipta (Admin) | Edit Detail Produk</title>
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
                        <a class="nav-link " href="../produk/index.php">Produk</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link active" href="index.php">Detail Produk</a>
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
                            <a class="nav-link " href="../produk/index.php">Produk</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link active" href="index.php">Detail Produk</a>
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
        <h2 class="mb-4">Edit Detail Produk</h2>
        <a href="index.php" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Produk</label>
                <select name="id_produk" class="form-select" required>
                    <?php while ($p = $produk->fetch_assoc()): ?>
                        <option value="<?= $p['id'] ?>" <?= $p['id'] == $detail['id_produk'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($p['nama_produk']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Detail</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($detail['nama']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" value="<?= $detail['harga'] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Link Produk</label>
                <input type="text" name="link_produk" class="form-control"
                    value="<?= htmlspecialchars($detail['link_produk']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan 1 - 8</label>
                <?php for ($i = 1; $i <= 8; $i++): ?>
                    <input type="text" name="keterangan<?= $i ?>" class="form-control mb-2"
                        value="<?= htmlspecialchars($detail['keterangan' . $i]) ?>" placeholder="Keterangan <?= $i ?>">
                <?php endfor; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control"
                    rows="4"><?= htmlspecialchars($detail['deskripsi']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tambah Gambar Baru</label>
                <input type="file" id="gambarInput" multiple class="form-control">
            </div>
            <div id="previewGambarBaru" class="d-flex flex-wrap"></div>

            <div class="mb-3">
                <h5>Gambar Saat Ini:</h5>
                <div class="d-flex flex-wrap">
                    <?php while ($g = $gambar->fetch_assoc()): ?>
                        <div class="text-center me-3 mb-3">
                            <img src="uploads/<?= $g['gambar'] ?>" width="100" class="img-thumbnail"><br>
                            <a href="hapus_gambar.php?id=<?= $g['id'] ?>&detail=<?= $id ?>"
                                onclick="return confirm('Hapus gambar ini?')" class="btn btn-sm btn-danger mt-2">Hapus</a>
                        </div>
                    <?php endwhile; ?>
                </div>

                <h5>Gambar Baru Ditambahkan:</h5>
                <div id="previewGambarBaru" class="d-flex flex-wrap"></div>

            </div>

            <button type="submit" class="btn btn-primary">Update Detail</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
        <script>
            document.getElementById('gambarInput').addEventListener('change', function () {
                let files = this.files;
                let formData = new FormData();
                let idDetail = <?= $id ?>; // ID detail produk dari PHP

                for (let i = 0; i < files.length; i++) {
                    formData.append('gambar[]', files[i]);
                }

                formData.append('id_detail_produk', idDetail);

                fetch('upload_gambar.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('previewGambarBaru').innerHTML += data;
                        document.getElementById('gambarInput').value = ''; // reset agar bisa upload ulang gambar yang sama
                    });
            });
        </script>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>