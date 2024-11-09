<?php
include '../koneksi.php';

$id  = $_POST['id'];
$nama  = $_POST['nama'];
$username = $_POST['username'];
$pwd = $_POST['password'];
$password = md5($_POST['password']);

// cek gambar
$rand = rand();
$allowed =  array('gif', 'png', 'jpg', 'jpeg');
$filename = $_FILES['foto']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

if ($pwd == "" && $filename == "") {
	mysqli_query($koneksi, "update user set user_nama='$nama', user_username='$username' where user_id='$id'");
	header("location:user.php?update=sukses");
} elseif ($pwd == "") {
	if (!in_array($ext, $allowed)) {
		header("location:user.php?alert=gagal");
	} else {
		if (move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/' . $rand . '_' . $filename)) {
			$x = $rand . '_' . $filename;
			mysqli_query($koneksi, "update user set user_nama='$nama', user_username='$username', user_foto='$x' where user_id='$id'");
			header("location:user.php?update=sukses");
		} else {
			// Jika terjadi kesalahan saat mengunggah foto, tampilkan pesan kesalahan
			die("Terjadi kesalahan saat mengunggah foto.");
		}
	}
} elseif ($filename == "") {
	mysqli_query($koneksi, "update user set user_nama='$nama', user_username='$username', user_password='$password' where user_id='$id'");
	header("location:user.php?update=sukses");
} else {
	if ($query_update) {
		// Jika pembaruan berhasil, alihkan ke halaman sebelumnya dengan pesan sukses
		header("location:user.php?update=sukses");
		exit();
	} else {
		// Jika terjadi kesalahan, tampilkan pesan kesalahan
		die(mysqli_error($koneksi));
	}
}
