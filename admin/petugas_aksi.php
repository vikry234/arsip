<?php
include '../koneksi.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);

$rand = rand();
$allowed = array('gif', 'png', 'jpg', 'jpeg');
$filename = $_FILES['foto']['name'];

if ($filename == "") {
	// Jika tidak ada foto yang diunggah, tambahkan petugas dengan foto kosong
	mysqli_query($koneksi, "INSERT INTO petugas (petugas_nama, petugas_username, petugas_password, petugas_foto) VALUES ('$nama', '$username', '$password', '')");
	header("location:petugas.php?tambah=sukses");
} else {
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if (!in_array($ext, $allowed)) {
		header("location:petugas.php?alert=gagal");
	} else {
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/petugas/' . $rand . '_' . $filename);
		$file_gambar = $rand . '_' . $filename;
		mysqli_query($koneksi, "INSERT INTO petugas (petugas_nama, petugas_username, petugas_password, petugas_foto) VALUES ('$nama', '$username', '$password', '$file_gambar')");
		header("location:petugas.php?tambah=sukses");
	}
}
