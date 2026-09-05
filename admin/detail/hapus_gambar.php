<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: ../login.php");
    exit;
}
?>

<?php
include '../../db.php';

$id = $_GET['id']; // id dari tabel gambar_detail_produk
$id_detail = $_GET['detail'];

// Ambil nama file dulu
$gambar = $conn->query("SELECT * FROM gambar_detail_produk WHERE id = $id")->fetch_assoc();
$filename = $gambar['gambar'];
$filepath = "uploads/" . $filename;

// Hapus file dari folder
if (file_exists($filepath)) {
    unlink($filepath);
}

// Hapus dari database
$conn->query("DELETE FROM gambar_detail_produk WHERE id = $id");

header("Location: edit.php?id=$id_detail");
exit;
?>
