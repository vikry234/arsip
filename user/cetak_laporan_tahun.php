<style>
    table {
        width: 100%;
        /* Ubah nilai ini sesuai dengan preferensi Anda */
    }

    h2,
    h2 {
        text-align: center;
    }

    .logo-container {
        text-align: center;
    }

    .logo-container img {
        width: 150px;
        /* Adjust the size as needed */
        display: inline-block;
    }
</style>

<div class="container-fluid">
    <div class="panel">
        <div class="panel-heading">
            <div class="logo-container">
                <img src="../gambar/logo/logosindur.png" alt="Logo">
            </div>
            <h2 class="text-center">E-ARSIP SURAT KECAMATAN GUNUNGSINDUR</h1>
        </div>
        <div class="panel-body">
            <?php
            include '../koneksi.php'; // pastikan file koneksi.php sudah ada 
            setlocale(LC_TIME, 'id_ID');

            // Ambil data kategori dari database
            $query_kategori = "SELECT * FROM kategori";
            $result_kategori = mysqli_query($koneksi, $query_kategori);

            // Inisialisasi variabel kategori
            $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

            // Set default value untuk tahun
            $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
            $bulan_indonesia = array(
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

            // Membuat kondisi untuk filter berdasarkan tahun
            $tahun_condition = '';
            if (!empty($tahun)) {
                $tahun_condition = "AND YEAR(arsip_waktu_upload) = '$tahun'";
            }

            // Membuat kondisi untuk filter berdasarkan kategori
            $kategori_condition = '';
            if (!empty($kategori) && $kategori != 'all') {
                $kategori_condition = "AND arsip_kategori = '$kategori'";
            }

            // Ambil data arsip dari database untuk pengecekan
            $query_check = "SELECT COUNT(*) as count FROM arsip WHERE 1=1 $tahun_condition $kategori_condition";
            $result_check = mysqli_query($koneksi, $query_check);
            $row_check = mysqli_fetch_assoc($result_check);
            $count = $row_check['count'];

            // Cek apakah ada data yang ditemukan

            // Jika ada data yang ditemukan, ambil data arsip untuk ditampilkan
            $query = "SELECT arsip_id, arsip_waktu_upload, arsip_kode, arsip_nama, kategori.kategori_nama, arsip_keterangan, petugas_nama 
              FROM arsip 
              INNER JOIN kategori ON arsip.arsip_kategori = kategori.kategori_id
              INNER JOIN petugas ON arsip.arsip_petugas = petugas.petugas_id 
              WHERE 1=1 $tahun_condition $kategori_condition
              ORDER BY arsip_id DESC";
            $result = mysqli_query($koneksi, $query);

            echo "<h2 class='text-center'>Laporan Dokumen Arsip Tahunan</h2>";

            echo "<table border='1'>";
            echo "<thead><tr><th>No</th><th>Waktu Upload</th><th>Arsip</th><th>Perihal</th></tr></thead>";
            echo "<tbody>";

            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                // Ambil bulan dari tanggal
                $bulan_angka = date('n', strtotime($row['arsip_waktu_upload']));
                // Konversi indeks bulan menjadi nama bulan dalam bahasa Indonesia
                $bulan_indo = $bulan_indonesia[$bulan_angka];
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . date('H:i:s d', strtotime($row['arsip_waktu_upload'])) . " " . $bulan_indo . " " . date('Y', strtotime($row['arsip_waktu_upload'])) . "</td>";
                echo "<td>No. Surat: " . $row['arsip_kode'] . "<br>Pengirim: " . $row['arsip_nama'] . "<br>Kategori: " . $row['kategori_nama'] . "</td>";
                echo "<td>" . $row['arsip_keterangan'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";


            mysqli_close($koneksi);
            ?>

            <script>
                window.print();
                window.onafterprint = window.close;
            </script>
        </div>
    </div>
</div>