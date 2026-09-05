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
$conn->query("DELETE FROM kategori_produk WHERE id = $id");
header("Location: index.php");
