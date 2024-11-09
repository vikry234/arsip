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
                            <label>Pilih Tahun:</label>
                            <select class="form-control" name="tahun" id="tahun" required="required">
                                <option value="">Pilih Tahun</option>
                                <option value="2024" <?php if (isset($_GET['tahun']) && $_GET['tahun'] == "2024") echo 'selected="selected"'; ?>>2024</option>
                                <option value="2025" <?php if (isset($_GET['tahun']) && $_GET['tahun'] == "2025") echo 'selected="selected"'; ?>>2025</option>
                                <option value="2026" <?php if (isset($_GET['tahun']) && $_GET['tahun'] == "2026") echo 'selected="selected"'; ?>>2026</option>
                                <option value="2027" <?php if (isset($_GET['tahun']) && $_GET['tahun'] == "2027") echo 'selected="selected"'; ?>>2027</option>
                                <option value="2028" <?php if (isset($_GET['tahun']) && $_GET['tahun'] == "2028") echo 'selected="selected"'; ?>>2028</option>
                                <option value="2029" <?php if (isset($_GET['tahun']) && $_GET['tahun'] == "2029") echo 'selected="selected"'; ?>>2029</option>
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
                                    <option value="<?php echo $row_kategori['kategori_id']; ?>" <?php if (isset($_GET['kategori']) && $_GET['kategori'] == $row_kategori['kategori_id']) echo 'selected="selected"'; ?>>
                                        <?php echo $row_kategori['kategori_nama']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <br>
                        <input type="submit" value="Tampilkan" class="btn btn-primary" style="margin-top: 15px;">
                        <button type="button" class="btn btn-primary" style="margin-top: 15px;" onclick="cetakLaporan()"><i class="fa fa-print"></i> Cetak Laporan</button>
                    </div>
                </div>
            </form>
            <script>
                function cetakLaporan() {
                    var tahun = document.getElementById('tahun').value;
                    var kategori = document.getElementById('kategori').value;

                    if (tahun === "" || kategori === "") {
                        alert("Silakan pilih tahun dan kategori terlebih dahulu!");
                    } else {
                        var url = 'cetak_laporan.php?tahun=' + tahun + '&kategori=' + kategori;
                        window.open(url, '_blank');
                    }
                }
            </script>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Data arsip</h3>
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
                    $arsip_query = "SELECT * FROM arsip,kategori,petugas WHERE arsip_petugas=petugas_id and arsip_kategori=kategori_id ";

                    // Periksa apakah tahun yang dipilih bukan 2024
                    if (isset($_GET['tahun']) && $_GET['tahun'] != '2024') {
                        $tahun = $_GET['tahun'];
                        // Sesuaikan kueri untuk hanya mengambil data untuk tahun yang dipilih
                        $arsip_query .= "AND YEAR(arsip_waktu_upload) = '$tahun' ";
                    }

                    if (isset($_GET['kategori']) && $_GET['kategori'] != 'all') {
                        $kategori = $_GET['kategori'];
                        $arsip_query .= "AND arsip_kategori='$kategori' ";
                    } elseif (isset($_GET['kategori']) && $_GET['kategori'] == 'all') {
                        // Jika opsi "Semua Surat" dipilih, tidak perlu filter berdasarkan jenis surat
                    } elseif (isset($_GET['kategori']) && $_GET['kategori'] == 'surat_masuk') {
                        $arsip_query .= "AND arsip_jenis='Surat Masuk' ";
                    } elseif (isset($_GET['kategori']) && $_GET['kategori'] == 'surat_keluar') {
                        $arsip_query .= "AND arsip_jenis='Surat Keluar' ";
                    }

                    $arsip_query .= "ORDER BY arsip_id DESC";

                    $arsip = mysqli_query($koneksi, $arsip_query);
                    while ($p = mysqli_fetch_array($arsip)) {
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
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . date('H:i:s d', strtotime($p['arsip_waktu_upload'])) . " " . $bulan_indo[$bulan_angka] . " " . date('Y', strtotime($p['arsip_waktu_upload'])) . "</td>";
                        echo "<td><b>KODE</b> : " . $p['arsip_kode'] . "<br><b>Pengirim</b> : " . $p['arsip_nama'] . "<br><b>Jenis</b> : " . $p['arsip_jenis'] . "</td>";
                        echo "<td>" . $p['kategori_nama'] . "</td>";
                        echo "<td>" . $p['arsip_keterangan'] . "</td>";
                        echo "<td class='text-center'>";
                        echo "<div class='btn-group'>";
                        echo "<a target='_blank' class='btn btn-default' href='arsip_download.php?id=" . $p['arsip_id'] . "'><i class='fa fa-download'></i></a>";
                        echo "<a href='arsip_preview.php?id=" . $p['arsip_id'] . "' class='btn btn btn-default'><i class='fa fa-search'></i> Preview</a>";
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