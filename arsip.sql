-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Nov 2024 pada 14.11
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_nama` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_nama`, `admin_username`, `admin_password`, `admin_foto`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', '131566265_1719452381091-removebg.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip`
--

CREATE TABLE `arsip` (
  `arsip_id` int(11) NOT NULL,
  `arsip_waktu_upload` datetime NOT NULL,
  `arsip_petugas` int(11) NOT NULL,
  `arsip_kode` varchar(255) NOT NULL,
  `arsip_nama` varchar(255) NOT NULL,
  `arsip_jenis` varchar(255) NOT NULL,
  `arsip_kategori` int(11) NOT NULL,
  `arsip_keterangan` text NOT NULL,
  `arsip_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `arsip`
--

INSERT INTO `arsip` (`arsip_id`, `arsip_waktu_upload`, `arsip_petugas`, `arsip_kode`, `arsip_nama`, `arsip_jenis`, `arsip_kategori`, `arsip_keterangan`, `arsip_file`) VALUES
(12, '2024-07-04 11:30:27', 6, '2024/500.23/KOM', 'PT Teknologi Indonesia', 'pdf', 11, 'Sosialisasi Teknologi Informasi', '599134775_SKKNI Nomer 321 Tahun 2016.pdf'),
(13, '2024-07-04 11:31:30', 6, '2J20/2I', 'Kantor Gununsindur', 'pdf', 12, 'Undangan Rapat Siaga Bencana', '183962339_document.pdf'),
(15, '2024-07-29 09:58:10', 6, 'ASDA/123/ITF', 'Komisi Informasi Jawa Barat', 'pdf', 11, 'Sosialisasi Teknologi 5.0', '677319656_vikry.pdf'),
(17, '2024-08-06 12:45:12', 6, '156/FTI/2024', 'Dinas Perhubungan', 'pdf', 11, 'Test', '1504217260_2045332486_Surat Pengantar.pdf'),
(18, '2024-08-11 08:14:56', 6, 'Test2', 'Dinas Kesehatan', 'jpg', 11, 'Undangan', '1208081698_mentahanLUMINOUS.jpg'),
(19, '2024-08-11 08:18:54', 6, 'test', 'test', 'jpg', 11, 'Undangan', '1298422389_LUMINOUS4.jpg'),
(21, '2024-08-11 08:57:15', 6, '09ur', 'Kecamatan Gunungsindur', 'png', 12, 'Undangan Rapat Siaga Bencana', '150720645_Untitled-1.png'),
(22, '2024-08-11 09:35:29', 6, 'FTI/501/uuk', 'Kecamatan Gunungsindur', 'png', 12, 'Sosialisasi', '2121026608_Untitled-1.png'),
(41, '2024-08-15 14:07:28', 6, '501/FTI/2024', 'Universitas Bina Sarana Informatika', 'pdf', 11, 'Undangan', '179875731_1504217260_2045332486_Surat Pengantar.pdf'),
(44, '2024-08-15 14:32:53', 6, 'SMT/2024/002', 'Dinas Kesehatan', 'jpg', 12, 'Undangan', '347209830_6881871b20bd33be2dfc55e16ed4a08a9240daa3_s2_n3_y1.jpg'),
(45, '2024-08-15 17:15:03', 6, 'TMS/02/2024', 'Pt. Sumber Jaya', 'pdf', 11, 'Perizinan', '672662189_1504217260_2045332486_Surat Pengantar.pdf'),
(46, '2024-08-16 08:11:09', 6, 'test', 'test', 'png', 11, 'test', '606697676_code.png'),
(47, '2024-11-08 20:18:40', 6, 'test', 'test', 'pdf', 12, 'contoh', '2021845320_1504217260_2045332486_Surat Pengantar.pdf'),
(48, '2024-11-08 20:22:57', 6, '111', 'contoh', 'pdf', 11, 'undangsn niksh', '2104646210_1504217260_2045332486_Surat Pengantar.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(255) NOT NULL,
  `kategori_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`, `kategori_keterangan`) VALUES
(11, 'Surat Masuk', 'surat yang dikirim dari external'),
(12, 'Surat Keluar', 'surat yang dikirim dari internal'),
(16, 'Undangan', 'Surat Undangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `petugas_id` int(11) NOT NULL,
  `petugas_nama` varchar(255) NOT NULL,
  `petugas_username` varchar(255) NOT NULL,
  `petugas_password` varchar(255) NOT NULL,
  `petugas_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`petugas_id`, `petugas_nama`, `petugas_username`, `petugas_password`, `petugas_foto`) VALUES
(6, 'eman', 'eman', '04ecff4292be7186a9fbfa186e83b87e', '2100869728_fotorifki.jpg'),
(16, 'ujang', 'ujang', 'c959810f01adc10791f46e1b3ecab45a', '678498514_392c8e11afdbaaeffb8d47114d1c6b678.jpg'),
(17, 'ujang', 'ujang', 'c959810f01adc10791f46e1b3ecab45a', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `riwayat_id` int(11) NOT NULL,
  `riwayat_waktu` datetime NOT NULL,
  `riwayat_user` int(11) NOT NULL,
  `riwayat_arsip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`riwayat_id`, `riwayat_waktu`, `riwayat_user`, `riwayat_arsip`) VALUES
(69, '2024-08-11 11:00:32', 8, 15),
(70, '2024-08-11 17:07:35', 6, 22),
(71, '2024-08-11 17:24:30', 6, 21),
(88, '2024-08-12 10:14:42', 8, 15),
(90, '2024-08-13 09:05:04', 6, 19),
(91, '2024-08-13 09:05:14', 6, 22),
(92, '2024-08-13 09:05:16', 6, 12),
(93, '2024-08-13 09:06:04', 8, 18),
(95, '2024-08-14 14:45:18', 8, 15),
(99, '2024-08-15 14:25:44', 8, 17),
(101, '2024-08-15 14:33:09', 8, 44),
(102, '2024-08-15 17:15:36', 8, 45),
(103, '2024-08-15 17:19:05', 6, 45),
(104, '2024-08-16 08:10:42', 6, 45);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`) VALUES
(8, 'dace', 'dace', '8e3a3fcbb9c41388689f6b039b7b9c41', '76540672_GAMBAR DEPAN.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`arsip_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`petugas_id`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`riwayat_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `arsip`
--
ALTER TABLE `arsip`
  MODIFY `arsip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `petugas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `riwayat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
