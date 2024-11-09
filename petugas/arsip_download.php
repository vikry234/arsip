<?php
session_start();
include '../koneksi.php'; // Ensure the database connection is established
date_default_timezone_set('Asia/Jakarta');

// Check if the file ID is set
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('No file specified.');
}

$user_id = $_SESSION['id'];
$arsip_id = $_GET['id'];
$waktu = date('Y-m-d H:i:s');

// Retrieve file information from the database
$arsip = mysqli_query($koneksi, "SELECT arsip_nama, arsip_file FROM arsip WHERE arsip_id='$arsip_id'");
if ($p = mysqli_fetch_array($arsip)) {
    $file = $p['arsip_file'];
    $filePath = "../arsip/" . $file;

    // Check if the file exists
    if (file_exists($filePath)) {

        // Insert the download record into the riwayat table
        $insert_riwayat = mysqli_query($koneksi, "INSERT INTO riwayat (riwayat_waktu, riwayat_user, riwayat_arsip) VALUES ('$waktu', '$user_id', '$arsip_id')");

        if ($insert_riwayat) {
            // Output the file to the browser
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"" . basename($filePath) . "\"");
            header("Expires: 0");
            header("Cache-Control: must-revalidate");
            header("Pragma: public");
            header("Content-Length: " . filesize($filePath));
            flush(); // Flush system output buffer
            readfile($filePath);
            exit;
        } else {
            die('Failed to log the download record.');
        }
    } else {
        die('File not found.');
    }
} else {
    die('File record not found.');
}
