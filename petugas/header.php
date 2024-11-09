<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Petugas - E-Arsip Kecamatan Gunungsindur</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.css">
    <link rel="stylesheet" href="../assets/css/owl.transitions.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/educate-custon-icon.css">
    <link rel="stylesheet" href="../assets/css/morrisjs/morris.css">
    <link rel="stylesheet" href="../assets/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../assets/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="../assets/css/metisMenu/metisMenu-vertical.css">
    <link rel="stylesheet" href="../assets/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="../assets/css/calendar/fullcalendar.print.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="../assets/js/DataTables/datatables.css">

    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>

    <?php
    include '../koneksi.php';
    session_start();
    if ($_SESSION['status'] != "petugas_login") {
        header("location:../login.php?alert=belum_login");
    }
    ?>
</head>

<body>
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.php"><img class="main-logo" src="../gambar/logo/logosindur.png" alt="" /></a>
                <strong><a href="index.php"><img src="../gambar/logo/logosindur.png" alt="" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">

                <nav class="sidebar-nav left-sidebar-menu-pro" style="margin-top: 30px">

                    <ul class="metismenu" id="menu1">
                        <li class="active">
                            <a href="index.php">
                                <span class="educate-icon educate-home icon-wrap"></span>
                                <span class="mini-click-non">Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="arsip.php" aria-expanded="false"><span class="educate-icon educate-data-table icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Data Arsip</span></a>
                        </li>

                        <li>
                            <a href="kategori.php" aria-expanded="false"><span class="educate-icon educate-course icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Data Kategori</span></a>
                        </li>

                        <li>
                            <a href="riwayat.php" aria-expanded="false"><span class="educate-icon educate-form icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Riwayat Unduh</span></a>
                        </li>

                        <li>
                            <a href="gantipassword.php" aria-expanded="false"><span class="educate-icon educate-danger icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Ganti Password</span></a>
                        </li>

                        <li>
                            <a href="logout.php" aria-expanded="false"><span class="educate-icon educate-pages icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Logout</span></a>
                        </li>

                    </ul>
                </nav>
            </div>
        </nav>
    </div>

    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <p class="main">.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-12 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                <i class="educate-icon educate-nav"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                            <ul class="nav navbar-nav mai-top-nav">
                                                <li class="nav-item"><a href="#" class="nav-link"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">

                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                        <i class="educate-icon educate-bell" aria-hidden="true"></i>
                                                        <span class="indicator-nt"></span>
                                                    </a>
                                                    <div role="menu" class="notification-author dropdown-menu animated zoomIn">
                                                        <div class="notification-single-top">
                                                            <h1>Riwayat unduh terakhir</h1>
                                                        </div>
                                                        <ul class="notification-menu">
                                                            <?php
                                                            include '../koneksi.php';
                                                            $bulan_indo = array(
                                                                1 => 'Januari',
                                                                2 => 'Februari',
                                                                3 => 'Maret',
                                                                4 => 'April',
                                                                5 => 'Mei',
                                                                6 => 'Juni',
                                                                7 => 'Juli',
                                                                8 => 'Agustus',
                                                                9 => 'September',
                                                                10 => 'Oktober',
                                                                11 => 'November',
                                                                12 => 'Desember'
                                                            );

                                                            // Perbarui query untuk mengambil data dari user dan petugas
                                                            $arsip = mysqli_query($koneksi, "SELECT riwayat.*, arsip.*, user.user_nama AS user_name, petugas.petugas_nama AS petugas_name 
                                                            FROM riwayat 
                                                            JOIN arsip ON riwayat_arsip = arsip_id 
                                                            LEFT JOIN user ON riwayat_user = user.user_id 
                                                            LEFT JOIN petugas ON riwayat_user = petugas.petugas_id 
                                                            ORDER BY riwayat_id DESC 
                                                            LIMIT 5"); // Menampilkan 5 riwayat terakhir

                                                            while ($p = mysqli_fetch_array($arsip)) {
                                                                // Menentukan apakah pengunduh adalah user atau petugas
                                                                $nama_pengunduh = !empty($p['user_name']) ? $p['user_name'] : $p['petugas_name'];
                                                                $bulan_angka = date('n', strtotime($p['riwayat_waktu']));
                                                            ?>
                                                                <li>
                                                                    <a href="riwayat.php">
                                                                        <div class="notification-content">
                                                                            <p>
                                                                                <small><i><?php echo date('H:i:s d', strtotime($p['riwayat_waktu'])) . " " . $bulan_indo[$bulan_angka] . " " . date('Y', strtotime($p['riwayat_waktu'])) ?></i></small>
                                                                                <br>
                                                                                <b><?php echo $nama_pengunduh; ?></b> mengunduh <b><?php echo $p['arsip_nama']; ?></b>.
                                                                            </p>
                                                                        </div>
                                                                    </a>
                                                                    <hr>
                                                                </li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                        <div class="notification-view">
                                                            <a href="riwayat.php">Lihat semua riwayat</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                        <?php
                                                        $id_petugas = $_SESSION['id'];
                                                        $profil = mysqli_query($koneksi, "select * from petugas where petugas_id='$id_petugas'");
                                                        $profil = mysqli_fetch_assoc($profil);
                                                        if ($profil['petugas_foto'] == "") {
                                                        ?>
                                                            <img src="../gambar/sistem/user.png" style="width: 20px;height: 20px">
                                                        <?php } else { ?>
                                                            <img src="../gambar/petugas/<?php echo $profil['petugas_foto'] ?>" style="width: 20px;height: 20px">
                                                        <?php } ?>
                                                        <span class="admin-name"><?php echo $_SESSION['nama']; ?> [ <b>Petugas</b> ]</span>
                                                        <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                    </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li><a href="profil.php"><span class="edu-icon edu-home-admin author-log-ic"></span>Profil Saya</a></li>
                                                        <li><a href="gantipassword.php"><span class="edu-icon edu-user-rounded author-log-ic"></span>Ganti Password</a></li>
                                                        <li><a href="logout.php"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <li class="active">
                                            <a href="index.php">
                                                <span class="educate-icon educate-home icon-wrap"></span>
                                                <span class="mini-click-non">Dashboard</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="arsip.php" aria-expanded="false"><span class="educate-icon educate-data-table icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Data Arsip</span></a>
                                        </li>

                                        <li>
                                            <a href="kategori.php" aria-expanded="false"><span class="educate-icon educate-course icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Data Kategori</span></a>
                                        </li>

                                        <li>
                                            <a href="riwayat.php" aria-expanded="false"><span class="educate-icon educate-form icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Riwayat Unduh</span></a>
                                        </li>

                                        <li>
                                            <a href="gantipassword.php" aria-expanded="false"><span class="educate-icon educate-danger icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Ganti Password</span></a>
                                        </li>

                                        <li>
                                            <a href="logout.php" aria-expanded="false"><span class="educate-icon educate-pages icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Logout</span></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>