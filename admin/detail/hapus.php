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

// Hapus gambar dari server
$gambar = $conn->query("SELECT gambar FROM gambar_detail_produk WHERE id_detail_produk = $id");
while ($g = $gambar->fetch_assoc()) {
    @unlink("uploads/" . $g['gambar']);
}

// Hapus dari DB
$conn->query("DELETE FROM gambar_detail_produk WHERE id_detail_produk = $id");
$conn->query("DELETE FROM detail_produk WHERE id = $id");

header("Location: index.php");
