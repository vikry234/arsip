<?php
include '../koneksi.php';

// Periksa apakah id sudah diterima dari parameter GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama file foto dari database
    $query_foto = mysqli_query($koneksi, "SELECT petugas_foto FROM petugas WHERE petugas_id='$id'");
    $data_foto = mysqli_fetch_assoc($query_foto);
    $foto = $data_foto['petugas_foto'];

    // Set session hapus
    $_SESSION['hapus'] = 'sukses';

    // Hapus file foto dari direktori
    if (!empty($foto)) {
        $lokasi_foto = "../gambar/petugas/" . $foto;
        if (file_exists($lokasi_foto)) {
            unlink($lokasi_foto); // Hapus file jika ada
        }
    }

    // Hapus data petugas dari database
    $query_hapus = mysqli_query($koneksi, "DELETE FROM petugas WHERE petugas_id='$id'");
    if ($query_hapus) {
        // Jika penghapusan berhasil, alihkan ke halaman sebelumnya dengan pesan sukses
        header("location:petugas.php?hapus=sukses");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        die(mysqli_error($koneksi));
    }
}
