<?php
session_start();
include "../db.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $_SESSION['admin_login'] = true;
    $_SESSION['admin_username'] = $username;
    header("Location: index.php"); // Halaman setelah login
} else {
    $_SESSION['error'] = "Username atau password salah!";
    header("Location: login.php");
}
?>
