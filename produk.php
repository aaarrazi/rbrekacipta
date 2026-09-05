<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RB Reka Cipta | Produk</title>
    <link rel="stylesheet" href="bootstrap-5.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/lightbox.min.css">
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
    include 'db.php';

    // Ambil parameter kategori dari URL
    $kategori_id = isset($_GET['kategori']) ? (int) $_GET['kategori'] : 0;
    $kategori_nama = "Semua Produk";

    // Ambil data kategori
    $kategori_query = "SELECT * FROM kategori_produk";
    $kategori_result = $conn->query($kategori_query);

    // Jika ada parameter kategori, ambil nama kategori
    if ($kategori_id > 0) {
        $single_kategori_query = "SELECT nama_kategori FROM kategori_produk WHERE id = $kategori_id";
        $single_kategori_result = $conn->query($single_kategori_query);
        if ($single_kategori_result->num_rows > 0) {
            $kategori_row = $single_kategori_result->fetch_assoc();
            $kategori_nama = $kategori_row['nama_kategori'];
        }
    }

    // Tangani parameter sortir
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    $order_by = '';

    switch ($sort) {
        case 'harga_asc':
            $order_by = 'ORDER BY p.harga ASC';
            break;
        case 'harga_desc':
            $order_by = 'ORDER BY p.harga DESC';
            break;
        case 'nama_asc':
            $order_by = 'ORDER BY p.nama_produk ASC';
            break;
        case 'nama_desc':
            $order_by = 'ORDER BY p.nama_produk DESC';
            break;
        default:
            $order_by = 'ORDER BY p.id DESC';
            break;
    }
    ?>

    <!-- breadcrumb -->
    <div class="container-fluid py5">
        <div class="container pt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" style="text-decoration: none;">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="produk.php" style="text-decoration: none;">Kategori</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo htmlspecialchars($kategori_nama); ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Produk konten -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <!-- kategori -->
                <div class="col-md-4 col-lg-3 mb-5">
                    <h4>Kategori</h4>
                    <div class="list-group"data-aos="fade-right">
                        <a href="produk.php"
                            class="list-group-item list-group-item-action <?php echo ($kategori_id == 0) ? 'active' : ''; ?>">
                            Semua Produk
                        </a>
                        <?php
                        if ($kategori_result->num_rows > 0) {
                            while ($row = $kategori_result->fetch_assoc()) {
                                $active = ($kategori_id == $row['id']) ? 'active' : '';
                                echo '<a href="produk.php?kategori=' . $row['id'] . '" class="list-group-item list-group-item-action ' . $active . '">'
                                    . htmlspecialchars($row['nama_kategori']) . '</a>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <!-- produk -->
                <div class="col-md-8 col-lg-9" >
                    <h4 class="text-center mb-4"><?php echo htmlspecialchars($kategori_nama); ?></h4>

                    <!-- Form sortir -->
                    <form method="get" class="mb-4 d-flex justify-content-end"data-aos="fade-left">
                        <?php if ($kategori_id > 0): ?>
                            <input type="hidden" name="kategori" value="<?= $kategori_id ?>">
                        <?php endif; ?>
                        <select name="sort" class="form-select w-auto" onchange="this.form.submit()">
                            <option value="">Urutkan</option>
                            <option value="harga_asc" <?= ($sort == 'harga_asc') ? 'selected' : '' ?>>Harga: Termurah
                            </option>
                            <option value="harga_desc" <?= ($sort == 'harga_desc') ? 'selected' : '' ?>>Harga: Termahal
                            </option>
                            <option value="nama_asc" <?= ($sort == 'nama_asc') ? 'selected' : '' ?>>Nama: A-Z</option>
                            <option value="nama_desc" <?= ($sort == 'nama_desc') ? 'selected' : '' ?>>Nama: Z-A</option>
                        </select>
                    </form>

                    <div class="row" data-aos="fade-up">
                        <?php
                        // Query produk berdasarkan kategori atau semua produk
                        $produk_query = "SELECT p.id, p.nama_produk, p.harga, p.gambar, k.nama_kategori 
                                    FROM produk p 
                                    JOIN kategori_produk k ON p.id_kategori = k.id";

                        if ($kategori_id > 0) {
                            $produk_query .= " WHERE p.id_kategori = $kategori_id";
                        }

                        $produk_query .= " $order_by";

                        $produk_result = $conn->query($produk_query);

                        if ($produk_result->num_rows > 0) {
                            while ($produk = $produk_result->fetch_assoc()) {
                                echo '<div class="col-sm-6 col-lg-4 mb-3">';
                                echo '    <div class="card">';
                                echo '        <a data-lightbox="produk" href="admin/produk/uploads/' . htmlspecialchars($produk['gambar']) . '" class="card-img-top" alt="' . htmlspecialchars($produk['nama_produk']) . '">';
                                if (!empty($produk['gambar'])) {
                                    echo '            <img src="admin/produk/uploads/' . htmlspecialchars($produk['gambar']) . '" class="card-img-top" alt="' . htmlspecialchars($produk['nama_produk']) . '">';
                                } else {
                                    echo '            <img src="admin/produk/uploads/" class="card-img-top" alt="Default Product Image">';
                                }
                                echo '        </a>';
                                echo '        <div class="card-body">';
                                echo '            <h5 class="card-title text-center text-truncate" style="max-width: 100%;">' . htmlspecialchars($produk['nama_produk']) . '</h5>';
                                echo '            <p class="card-text text-center">Rp ' . number_format($produk['harga'], 0, ',', '.') . '</p>';
                                echo '            <a href="detail_produk.php?id=' . $produk['id'] . '" class="btn btn-primary text-center w-100">Lihat Produk</a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div class="col-12"><p class="text-center">Tidak ada produk yang ditemukan.</p></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kami Melayani -->
    <section id="call-to-action" class="call-to-action section accent-background">
        <div class="container">
            <div class="row" data-aos="zoom-in" >
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
    <script src="dist/js/lightbox-plus-jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // durasi animasi (ms)
            once: true      // animasi hanya sekali saat scroll ke view
        });
    </script>
</body>

</html>