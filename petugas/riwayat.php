<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Data Riwayat Unduh Arsip</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Riwayat</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="panel panel">
        <div class="panel-heading">
            <h3 class="panel-title">Data Riwayat Unduhan Arsip</h3>
        </div>
        <div class="panel-body">
            <table id="table" class="table table-bordered table-striped table-hover table-datatable">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th width="18%">Waktu Unduh</th>
                        <th width="30%">Pengunduh</th>
                        <th width="30%">Arsip yang diunduh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';
                    $no = 1;
                    $saya = $_SESSION['id'];

                    $arsip = mysqli_query($koneksi, "SELECT riwayat.*, arsip.*, user.user_nama AS user_name, petugas.petugas_nama AS petugas_name 
                                 FROM riwayat 
                                 JOIN arsip ON riwayat_arsip = arsip_id 
                                 LEFT JOIN user ON riwayat_user = user.user_id 
                                 LEFT JOIN petugas ON riwayat_user = petugas.petugas_id 
                                 ORDER BY riwayat_id DESC");
                    while ($p = mysqli_fetch_array($arsip)) {
                        $nama_pengunduh = !empty($p['user_name']) ? $p['user_name'] : $p['petugas_name'];
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo date('H:i:s  d-m-Y', strtotime($p['riwayat_waktu'])) ?></td>
                            <td><?php echo $nama_pengunduh; ?></td>
                            <td><a style="color: blue" href="arsip_preview.php?id=<?php echo $p['arsip_id']; ?>"><?php echo $p['arsip_nama'] ?></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>