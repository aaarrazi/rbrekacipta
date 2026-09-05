<?php
$host = "localhost";
$user = "root"; // ganti sesuai user MySQL kamu
$pass = "";     // ganti jika ada password
$db   = "rb_rekacipta";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
