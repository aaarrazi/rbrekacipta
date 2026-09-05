<?php
include '../../db.php';

$id_detail = $_POST['id_detail_produk'];

foreach ($_FILES['gambar']['tmp_name'] as $key => $tmp_name) {
    if (!empty($_FILES['gambar']['name'][$key])) {
        $filename = $_FILES['gambar']['name'][$key];
        move_uploaded_file($tmp_name, "uploads/" . $filename);
        $conn->query("INSERT INTO gambar_detail_produk (id_detail_produk, gambar) VALUES ('$id_detail', '$filename')");
    }
}

// Tampilkan gambar terbaru agar bisa ditambahkan ke tampilan tanpa reload
$gambar = $conn->query("SELECT * FROM gambar_detail_produk WHERE id_detail_produk = $id_detail ORDER BY id DESC LIMIT 1");

while ($g = $gambar->fetch_assoc()) {
    echo '<div class="text-center me-3 mb-3">';
    echo '<img src="uploads/' . $g['gambar'] . '" width="100" class="img-thumbnail"><br>';
    echo '<a href="hapus_gambar.php?id=' . $g['id'] . '&detail=' . $id_detail . '" onclick="return confirm(\'Hapus gambar ini?\')" class="btn btn-sm btn-danger mt-2">Hapus</a>';
    echo '</div>';
}
?>
