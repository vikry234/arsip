<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Data Arsip</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Arsip</span></li>
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
            <h3 class="panel-title">Data Arsip Saya</h3>
        </div>
        <center>
            <?php
            if (isset($_GET['tambah']) && $_GET['tambah'] == 'sukses') {
                echo "<div class='alert alert-success alert-dismissible alert-small'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Data arsip berhasil ditambah!
                      </div>";
            }
            if (isset($_GET['hapus']) && $_GET['hapus'] == 'sukses') {
                echo "<div class='alert alert-danger alert-dismissible alert-small'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Data arsip berhasil dihapus!
                      </div>";
            }
            if (isset($_GET['alert']) && $_GET['alert'] == 'sukses') {
                echo "<div class='alert alert-success alert-dismissible alert-small'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Data arsip berhasil diperbarui!
                      </div>";
            }
            ?>
        </center>

        <div class="panel-body">
            <div class="pull-right">
                <a href="arsip_tambah.php" class="btn btn-primary"><i class="fa fa-cloud"></i> Upload Arsip</a>
            </div>

            <br><br><br>

            <table id="table" class="table table-bordered table-striped table-hover table-datatable">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Waktu Upload</th>
                        <th>Arsip</th>
                        <th>Kategori</th>
                        <th>Perihal</th>
                        <th class="text-center" width="20%">OPSI</th>
                    </tr>
                </thead>
                <tbody>
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
                    $no = 1;
                    $saya = $_SESSION['id'];
                    /* $arsip = mysqli_query($koneksi, "SELECT * FROM arsip
                         INNER JOIN kategori ON arsip.arsip_kategori = kategori.kategori_id
                         INNER JOIN petugas ON arsip.arsip_petugas = petugas.petugas_id
                         WHERE arsip.arsip_petugas = '$saya'
                         ORDER BY arsip.arsip_id DESC"); */

                    $arsip = mysqli_query($koneksi, "SELECT * FROM arsip
                         INNER JOIN kategori ON arsip.arsip_kategori = kategori.kategori_id
                         INNER JOIN petugas ON arsip.arsip_petugas = petugas.petugas_id
                         ORDER BY arsip.arsip_id DESC");

                    while ($p = mysqli_fetch_array($arsip)) {
                        // Ambil bulan dari tanggal
                        $bulan_angka = date('n', strtotime($p['arsip_waktu_upload']));
                        // Tampilkan data arsip dengan bulan dalam bahasa Indonesia
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . date('H:i:s d', strtotime($p['arsip_waktu_upload'])) . " " . $bulan_indo[$bulan_angka] . " " . date('Y', strtotime($p['arsip_waktu_upload'])) . "</td>";
                        echo "<td><b>KODE</b> : " . htmlspecialchars($p['arsip_kode']) . "<br><b>Pengirim</b> : " . htmlspecialchars($p['arsip_nama']) . "<br><b>Jenis</b> : " . htmlspecialchars($p['arsip_jenis']) . "</td>";
                        echo "<td>" . htmlspecialchars($p['kategori_nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($p['arsip_keterangan']) . "</td>";
                        echo "<td class='text-center'>";
                    ?>
                        <!-- Modal for Deletion Confirmation -->
                        <div class="modal fade" id="exampleModal_<?php echo $p['arsip_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">PERINGATAN!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus data ini? <br>File dan semua yang berhubungan akan dihapus secara permanen.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                        <a href="arsip_hapus.php?id=<?php echo $p['arsip_id']; ?>" class="btn btn-primary"><i class="fa fa-check"></i> &nbsp; Ya, hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="btn-group">
                            <a target='_blank' class='btn btn-default' href='arsip_download.php?id=<?php echo $p['arsip_id']; ?>'><i class='fa fa-download'></i></a>
                            <a href="arsip_preview.php?id=<?php echo $p['arsip_id']; ?>" class="btn btn-default"><i class="fa fa-search"></i> Preview</a>
                            <a href="arsip_edit.php?id=<?php echo $p['arsip_id']; ?>" class="btn btn-default"><i class="fa fa-wrench"></i></a>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_<?php echo $p['arsip_id']; ?>">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    <?php
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>