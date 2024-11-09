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
                                <li><a href="index.php">Home</a> <span class="bread-slash">/</span></li>
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
            <h3 class="panel-title">Semua Arsip</h3>
        </div>
        <div class="panel-body">
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
                    $arsip = mysqli_query($koneksi, "SELECT * FROM arsip, kategori, petugas WHERE arsip_petugas=petugas_id and arsip_kategori=kategori_id ORDER BY arsip_id DESC");
                    while ($p = mysqli_fetch_array($arsip)) {
                        // Ambil bulan dari tanggal
                        $bulan_angka = date('n', strtotime($p['arsip_waktu_upload']));
                        // Tampilkan data arsip dengan bulan dalam bahasa Indonesia
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . date('H:i:s d', strtotime($p['arsip_waktu_upload'])) . " " . $bulan_indo[$bulan_angka] . " " . date('Y', strtotime($p['arsip_waktu_upload'])) . "</td>";
                        echo "<td><b>KODE</b> : " . $p['arsip_kode'] . "<br><b>Pengirim</b> : " . $p['arsip_nama'] . "<br><b>Jenis</b> : " . $p['arsip_jenis'] . "</td>";
                        echo "<td>" . $p['kategori_nama'] . "</td>";
                        echo "<td>" . $p['arsip_keterangan'] . "</td>";
                        echo "<td class='text-center'>";
                        echo "<div class='modal fade' id='exampleModal_" . $p['arsip_id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                        echo "<div class='modal-dialog' role='document'>";
                        echo "<div class='modal-content'>";
                        echo "<div class='modal-header'>";
                        echo "<h5 class='modal-title' id='exampleModalLabel'>PERINGATAN!</h5>";
                        echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                        echo "<span aria-hidden='true'>&times;</span>";
                        echo "</button>";
                        echo "</div>";
                        echo "<div class='modal-body'>";
                        echo "Apakah anda yakin ingin menghapus data ini? <br>file dan semua yang berhubungan akan dihapus secara permanen.";
                        echo "</div>";
                        echo "<div class='modal-footer'>";
                        echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Batalkan</button>";
                        echo "<a href='arsip_hapus.php?id=" . $p['arsip_id'] . "' class='btn btn-primary'><i class='fa fa-check'></i> &nbsp; Ya, hapus</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='btn-group'>";
                        echo "<a href='arsip_preview.php?id=" . $p['arsip_id'] . "' class='btn btn-default'><i class='fa fa-search'></i> Preview</a>";
                        // Uncomment these if you want to enable edit and delete functionalities
                        // echo "<a href='arsip_edit.php?id=" . $p['arsip_id'] . "' class='btn btn-default'><i class='fa fa-wrench'></i></a>";
                        // echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal_" . $p['arsip_id'] . "'><i class='fa fa-trash'></i></button>";
                        echo "</div>";
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