<?php include 'header.php'; ?>
<?php
include '../koneksi.php'; // pastikan file koneksi.php sudah ada 
setlocale(LC_TIME, 'id_ID');

// Ambil data kategori dari database
$query_kategori = "SELECT * FROM kategori";
$result_kategori = mysqli_query($koneksi, $query_kategori);
?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4>Data Arsip</h4>
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
    <div class="panel">
        <div class="panel-body">
            <form method="get" action="">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Filter Bulan</label>
                            <select class="form-control" name="bulan" id="bulan" required="required">
                                <option value="">Pilih bulan</option>
                                <option value="01" <?php if (isset($_GET['bulan']) && $_GET['bulan'] == "01") echo 'selected="selected"'; ?>>Januari</option>
                                <option value="02" <?php if (isset($_GET['bulan']) && $_GET['bulan'] == "02") echo 'selected="selected"'; ?>>Februari</option>
                                <option value="03" <?php if (isset($_GET['bulan']) && $_GET['bulan'] == "03") echo 'selected="selected"'; ?>>Maret</option>
                                <option value="04" <?php if (isset($_GET['bulan']) && $_GET['bulan'] == "04") echo 'selected="selected"'; ?>>April</option>
                                <option value="05" <?php if (isset($_GET['bulan']) && $_GET['bulan'] == "05") echo 'selected="selected"'; ?>>Mei</option>
                                <option value="06" <?php if (isset($_GET['bulan']) && $_GET['bulan'] == "06") echo 'selected="selected"'; ?>>Juni</option>
                                <option value="07" <?php if (isset($_GET['bulan']) && $_GET['bulan'] == "07") echo 'selected="selected"'; ?>>Juli</option>
                                <option value="08" <?php if (isset($_GET['bulan']) && $_GET['bulan'] == "08") echo 'selected="selected"'; ?>>Agustus</option>
                                <option value="09" <?php if (isset($_GET['bulan']) && $_GET['bulan'] == "09") echo 'selected="selected"'; ?>>September</option>
                                <option value="10" <?php if (isset($_GET['bulan']) && $_GET['bulan'] == "10") echo 'selected="selected"'; ?>>Oktober</option>
                                <option value="11" <?php if (isset($_GET['bulan']) && $_GET['bulan'] == "11") echo 'selected="selected"'; ?>>November</option>
                                <option value="12" <?php if (isset($_GET['bulan']) && $_GET['bulan'] == "12") echo 'selected="selected"'; ?>>Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Filter Kategori</label>
                            <select class="form-control" name="kategori" id="kategori" required="required">
                                <option value="">Pilih kategori</option>
                                <option value="all" <?php if (isset($_GET['kategori']) && $_GET['kategori'] == "all") echo 'selected="selected"'; ?>>Semua Surat</option>
                                <?php while ($row_kategori = mysqli_fetch_assoc($result_kategori)) : ?>
                                    <option value="<?php echo $row_kategori['kategori_id']; ?>" <?php if (isset($_GET['kategori']) && $_GET['kategori'] == $row_kategori['kategori_id']) echo 'selected="selected"'; ?>><?php echo $row_kategori['kategori_nama']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <br>
                        <input type="submit" class="btn btn-primary" value="Tampilkan" style="margin-top: 15px;">
                        <button type="button" class="btn btn-primary" style="margin-top: 15px;" onclick="cetakLaporan()"><i class="fa fa-print"></i> Cetak Laporan</button>
                    </div>
                </div>
            </form>
            <script>
                function cetakLaporan() {
                    var bulan = document.getElementById('bulan').value;
                    var kategori = document.getElementById('kategori').value;

                    if (bulan === "" || kategori === "") {
                        alert("Silakan pilih bulan dan kategori terlebih dahulu!");
                    } else {
                        var url = 'cetak_laporan.php?bulan=' + bulan + '&kategori=' + kategori;
                        window.open(url, '_blank');
                    }
                }
            </script>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Data Arsip</h3>
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
                    $no = 1;
                    $arsip_query = "SELECT * FROM arsip 
                        INNER JOIN kategori ON arsip.arsip_kategori=kategori.kategori_id
                        INNER JOIN petugas ON arsip.arsip_petugas=petugas.petugas_id WHERE 1=1";

                    if (isset($_GET['kategori']) && $_GET['kategori'] != 'all') {
                        $kategori = $_GET['kategori'];
                        $arsip_query .= " AND arsip_kategori='$kategori'";
                    }
                    if (isset($_GET['bulan']) && $_GET['bulan'] != '') {
                        $bulan = $_GET['bulan'];
                        $arsip_query .= " AND MONTH(arsip_waktu_upload)='$bulan'";
                    }
                    $arsip_query .= " ORDER BY arsip_id DESC";
                    $arsip = mysqli_query($koneksi, $arsip_query);

                    while ($p = mysqli_fetch_array($arsip)) {
                        // Ambil bulan dari tanggal
                        $bulan_angka = date('n', strtotime($p['arsip_waktu_upload']));
                        // Konversi indeks bulan menjadi nama bulan dalam bahasa Indonesia
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
                        // Tampilkan data arsip
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . date('H:i:s d', strtotime($p['arsip_waktu_upload'])) . " " . $bulan_indo[$bulan_angka] . " " . date('Y', strtotime($p['arsip_waktu_upload'])) . "</td>";
                        echo "<td><b>KODE</b> : " . $p['arsip_kode'] . "<br><b>Pengirim</b> : " . $p['arsip_nama'] . "<br><b>Jenis</b> : " . $p['arsip_jenis'] . "</td>";
                        echo "<td>" . $p['kategori_nama'] . "</td>";
                        echo "<td>" . $p['arsip_keterangan'] . "</td>";
                        echo "<td class='text-center'>";
                        echo "<div class='btn-group'>";
                        echo "<a target='_blank' class='btn btn-default' href='arsip_download.php?id=" . $p['arsip_id'] . "'><i class='fa fa-download'></i></a>";
                        echo "<a href='arsip_preview.php?id=" . $p['arsip_id'] . "' class='btn btn-default'><i class='fa fa-search'></i> Preview</a>";
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