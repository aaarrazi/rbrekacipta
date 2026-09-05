<?php
include 'db.php';

$produk_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$page_title = "RB Reka Cipta | Produk"; // Default value

if ($produk_id > 0) {
    $produk_query = "SELECT nama_produk FROM produk WHERE id = $produk_id";
    $produk_result = $conn->query($produk_query);

    if ($produk_result->num_rows > 0) {
        $produk = $produk_result->fetch_assoc();
        $page_title = "RB Reka Cipta | " . htmlspecialchars($produk['nama_produk'], ENT_QUOTES, 'UTF-8');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RB Reka Cipta | <?php echo htmlspecialchars($produk['nama_produk']); ?></title>
    <link rel="stylesheet" href="bootstrap-5.0.0-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
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
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link active" href="produk.php">Produk</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="tentang.php">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
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
                            <a class="nav-link" href="index.php">Beranda</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link active" href="produk.php">Produk</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link" href="tentang.php">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kontak.php">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <?php

    // Ambil ID produk dari URL
    $produk_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    if ($produk_id <= 0) {
        die("Produk tidak ditemukan");
    }

    // Query untuk mendapatkan data produk dan kategori
    $produk_query = "SELECT p.*, k.nama_kategori 
                    FROM produk p 
                    JOIN kategori_produk k ON p.id_kategori = k.id 
                    WHERE p.id = $produk_id";
    $produk_result = $conn->query($produk_query);

    if ($produk_result->num_rows == 0) {
        die("Produk tidak ditemukan");
    }

    $produk = $produk_result->fetch_assoc();

    // Query untuk mendapatkan detail produk
    $detail_query = "SELECT * FROM detail_produk WHERE id_produk = $produk_id";
    $detail_result = $conn->query($detail_query);
    $detail = $detail_result->num_rows > 0 ? $detail_result->fetch_assoc() : null;

    // Query untuk mendapatkan gambar detail produk
    $gambar_query = "SELECT * FROM gambar_detail_produk WHERE id_detail_produk = " . ($detail ? $detail['id'] : 0);
    $gambar_result = $conn->query($gambar_query);
    ?>

    <!-- breadcrumb -->
    <div class="container-fluid py5">
        <div class="container pt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" style="text-decoration: none;">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="produk.php" style="text-decoration: none;">Kategori</a></li>
                    <li class="breadcrumb-item"><a href="produk.php?kategori=<?php echo $produk['id_kategori']; ?>"
                            style="text-decoration: none;">
                            <?php echo htmlspecialchars($produk['nama_kategori']); ?>
                        </a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo htmlspecialchars($produk['nama_produk']); ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- main -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <!-- produk image -->
                <div class="col-lg-4">
                    <!-- Gambar Utama -->
                    <?php
                    $main_image = $produk['gambar'] ? $produk['gambar'] : 'admin/produk/uploads/';
                    ?>
                    <img id="mainImage" src="admin/produk/uploads/<?php echo htmlspecialchars($main_image); ?>"
                        class="img-fluid border mb-3" alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>"
                        style="width: 100%; max-height: 500px; object-fit: cover;">

                    <!-- Thumbnail Pilihan -->
                    <div class="thumbnail-slider-wrapper position-relative">
                        <div class="thumbnail-slider d-flex flex-nowrap overflow-auto pb-2"
                            style="scroll-behavior: smooth;">
                            <!-- Thumbnail gambar utama -->
                            <img src="admin/produk/uploads/<?php echo htmlspecialchars($main_image); ?>"
                                class="img-thumbnail me-2"
                                style="width: 80px; height: 80px; flex: 0 0 auto; cursor: pointer;"
                                onclick="changeImage(this)">

                            <!-- Thumbnail gambar detail -->
                            <?php
                            if ($gambar_result->num_rows > 0) {
                                while ($gambar = $gambar_result->fetch_assoc()) {
                                    echo '<img src="admin/detail/uploads/' . htmlspecialchars($gambar['gambar']) . '" 
                                         class="img-thumbnail me-2"
                                         style="width: 80px; height: 80px; flex: 0 0 auto; cursor: pointer;"
                                         onclick="changeImage(this)">';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Harga dan Tombol -->
                    <h4 class="text-dark mt-4">Harga Spesial</h4>
                    <h2 class="text-dark">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></h2>
                    <div class="dropdown mt-4">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Beli Sekarang
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <?php if ($detail && $detail['link_produk']): ?>
                                <li><a class="dropdown-item" href="<?php echo htmlspecialchars($detail['link_produk']); ?>"
                                        target="_blank">Shopee</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="https://wa.me/6282118202706">via Whatsapp</a></li>
                        </ul>
                    </div>
                </div>

                <!-- detail produk -->
                <div class="col-lg-7 offset-lg-1">
                    <h1><?php echo htmlspecialchars($produk['nama_produk']); ?></h1><br>
                    <div class="list-group">
                        <?php
                        if ($detail) {
                            for ($i = 1; $i <= 8; $i++) {
                                $keterangan = $detail['keterangan' . $i];
                                if (!empty($keterangan)) {
                                    echo '<a class="list-group-item list-group-item-action">' . htmlspecialchars($keterangan) . '</a><br>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <?php if ($detail && !empty($detail['deskripsi'])): ?>
                        <p class="text-justify mt-2">
                            <?php echo nl2br(htmlspecialchars($detail['deskripsi'])); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Kami Melayani -->
    <section id="call-to-action" class="call-to-action section accent-background">
        <div class="container">
            
            <div class="row" data-aos="zoom-in">
                <div class="col-xl-9 text-center text-xl-start">
                    <h3 class="text-light display-6">Kami Melayani Pemesanan via Whatsapp</h3>
                    <p class="text-light">Jika Anda ingin melakukan pemesanan atau membutuhkan bantuan, jangan ragu
                        untuk menghubungi admin kami.</p>
                </div>
                <div class="col-xl-3 cta-btn-container text-center">
                    <a class="cta-btn align-middle" href="https://wa.me/6282118202706">Whatsapp</a>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer id="footer" class="footer dark-background">
        <div class="container footer-top" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-6 footer-links">
                    <h4>Follow Us</h4>
                    <ul>
                        <li><a href="https://wa.me/6282118202706"><i class="bi bi-whatsapp"></i> Whatsapp</a></li>
                        <li><a href="https://wa.me/6282118202706"><i
                                    class="bi bi-telephone-outbound-fill"></i>Telepon</a></li>
                        <li><a href="#"><i class="bi bi-facebook"></i>Facebook</a></li>
                        <li><a href="#"><i class="bi bi-instagram"></i> Instagram</a></li>
                        <li><a
                                href="https://shopee.co.id/rbrekacipta?entryPoint=ShopBySearch&searchKeyword=rbrekacipta&is_from_login=true"><i
                                    class="bi bi-cart-check-fill"></i>Shopee</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Find</h4>
                    <ul>
                        <li><a href="tentang.php">Tentang Kami</a></li>
                        <li><a href="kontak.php">Hubungi Kami</a></li>
                        <li><a href="produk.php">Produk</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>Kp. Tambakbaya RT 011 RW 004 Margalaksana, Sukaraja Kab. Tasikmalaya</p>
                    <p>Jawa Barat</p>
                    <p>Indonesia</p>
                    <p class="mt-4"><strong>Phone:</strong> <span>+62 821 1820 2706</span></p>
                    <p><strong>Email:</strong> <span></span></p>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4 text-light">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Riyadhul Bahri Reka Cipta</strong>
                <span>2024</span>
            </p>
        </div>
    </footer>

    <script src="bootstrap-5.0.0-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function changeImage(thumbnail) {
            const mainImg = document.getElementById('mainImage');
            mainImg.src = thumbnail.src;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // durasi animasi (ms)
            once: true      // animasi hanya sekali saat scroll ke view
        });
    </script>
</body>

</html>