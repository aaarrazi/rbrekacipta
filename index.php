<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RB Reka Cipta | Beranda</title>
    <link rel="stylesheet" href="bootstrap-5.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
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
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="produk.php">Produk</a>
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
                            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link" href="produk.php">Produk</a>
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
    <!-- banner -->
    <div class=" container-fluid banner d-flex align-items-center">
        <div class="container" style="text-align: center;" data-aos="zoom-in">
            <h1 class="text-light text-center display-6">Selamat Datang di RIYADHUL BAHRI REKA CIPTA
            </h1>
            <h2 class="text-light text-center display-7">"Melayani dengan Kualitas, Berkarya dengan Hati" </h2><br>
        </div>

    </div>
    <!-- Produk kami -->
    <div class="container-fluid py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center">Produk Kami</h2>

            <div class="row mt-5 justify-content-center">
                <div class="col-sm-6 col-lg-3 hovered-card mb-3">
                    <div class="card">
                        <img src="image/product/Mukena1.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Mukena</h5>
                            <p class="card-title text-truncate" style="max-width: 100%;">Khodijah, Sabiya, Elmira, Yura
                            </p><br>
                            <a href="produk.php?kategori=1" class="btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 hovered-card mb-3">
                    <div class="card">
                        <img src="image/product/MukenaTravel1.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Mukena Travel</h5>
                            <p class="card-title text-truncate" style="max-width: 100%;">Amara, Zamora, Ameena, Namira,
                                Adara</p><br>
                            <a href="produk.php?kategori=2" class="btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 hovered-card mb-3">
                    <div class="card">
                        <img src="image/product/buku1.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Buku</h5>
                            <p class="card-title text-truncate" style="max-width: 100%;">Buku Politik, Hukum, dan Ilmu
                                Sosial</p><br>
                            <a href="produk.php?kategori=3" class="btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    <a href="produk.php" class="btn-primary">Lihat Semua Produk</a>
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
                        <li><a href="#"><i class="bi bi-instagram"></i>
                                Instagram</a></li>
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
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const images = [
                'image/banner/download (1).jpg',
                'image/banner/download (2).jpg',
                'image/banner/download (3).jpg',
            ];

            let current = 0;
            const banner = document.querySelector('.banner');

            // Tampilkan gambar pertama saat halaman dimuat
            banner.style.backgroundImage = `
                linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                url('${images[current]}')`;

            // Jalankan slideshow
            setInterval(() => {
                current = (current + 1) % images.length;
                banner.style.backgroundImage = `
                    linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                    url('${images[current]}')`;
            }, 4000); // setiap 4 detik
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="bootstrap-5.0.0-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // durasi animasi (ms)
            once: true      // animasi hanya sekali saat scroll ke view
        });
    </script>

</body>

</html>