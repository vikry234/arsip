<?php
include '../koneksi.php';
session_start();
$id = $_SESSION['id'];
$new_password = md5($_POST['password']);

// Ambil password lama dari database
$query = mysqli_query($koneksi, "SELECT admin_password FROM admin WHERE admin_id='$id'");
$row = mysqli_fetch_assoc($query);
$old_password = $row['admin_password'];

// Periksa apakah password baru sama dengan password lama
if ($new_password === $old_password) {
    // Jika sama, tampilkan pesan error
    header("location:gantipassword.php?alert=sama");
    exit();
}

// Jika password baru tidak sama dengan password lama, lakukan pembaruan
mysqli_query($koneksi, "UPDATE admin SET admin_password='$new_password' WHERE admin_id='$id'") or die(mysqli_errno());

// Redirect dengan pesan sukses
header("location:gantipassword.php?alert=sukses");