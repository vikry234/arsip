<div class="footer-copyright-area mg-t-30">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="footer-copy-right">
					<p>Copyright © <?php echo date('Y') ?>. Teknologi Informasi Arsip Digital. All rights reserved.</p>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


<script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/wow.min.js"></script>
<script src="../assets/js/jquery-price-slider.js"></script>
<script src="../assets/js/jquery.meanmenu.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/jquery.sticky.js"></script>
<script src="../assets/js/jquery.scrollUp.min.js"></script>
<script src="../assets/js/counterup/jquery.counterup.min.js"></script>
<script src="../assets/js/counterup/waypoints.min.js"></script>
<script src="../assets/js/counterup/counterup-active.js"></script>
<script src="../assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="../assets/js/scrollbar/mCustomScrollbar-active.js"></script>
<script src="../assets/js/metisMenu/metisMenu.min.js"></script>
<script src="../assets/js/metisMenu/metisMenu-active.js"></script>
<script src="../assets/js/morrisjs/raphael-min.js"></script>
<script src="../assets/js/morrisjs/morris.js"></script>
<script src="../assets/js/morrisjs/morris-active.js"></script>
<script src="../assets/js/sparkline/jquery.sparkline.min.js"></script>
<script src="../assets/js/sparkline/jquery.charts-sparkline.js"></script>
<script src="../assets/js/sparkline/sparkline-active.js"></script>
<script src="../assets/js/calendar/moment.min.js"></script>
<script src="../assets/js/calendar/fullcalendar.min.js"></script>
<script src="../assets/js/calendar/fullcalendar-active.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>

<script src="../assets/js/DataTables/datatables.js"></script>
<script src="../assets/js/pdf/jquery.media.js"></script>
<script src="../assets/js/pdf/pdf-active.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
		$('.table-datatable').DataTable();

		Morris.Area({
			element: 'extra-area-chart',
			data: [
				<?php
				$dateBegin = strtotime("first day of this month");
				$dateEnd = strtotime("last day of this month");

				$awal = date("Y/m/d", $dateBegin);
				$akhir = date("Y/m/d", $dateEnd);

				$arsip = mysqli_query($koneksi, "SELECT DATE(riwayat_waktu) AS tanggal, COUNT(*) AS jumlah FROM riwayat WHERE DATE(riwayat_waktu) >= '$awal' AND DATE(riwayat_waktu) <= '$akhir' GROUP BY DATE(riwayat_waktu)");
				while ($p = mysqli_fetch_array($arsip)) {
					// Format tanggal ke dalam format yang diharapkan oleh Morris.js
					$formatted_date = date('Y-m-d', strtotime($p['tanggal']));

					// Mengonversi jumlah unduhan menjadi integer
					$jumlah_unduh = intval($p['jumlah']);

					// Menambahkan data ke dalam format yang diharapkan oleh Morris.js
					echo "{ period: '$formatted_date', Unduh: $jumlah_unduh },";
				}
				?>
			],
			xkey: 'period',
			ykeys: ['Unduh'],
			labels: ['Unduh'],
			xLabels: 'day',
			xLabelAngle: 45,
			pointSize: 3,
			fillOpacity: 0,
			pointStrokeColors: ['#006DF0'],
			behaveLikeLine: true,
			gridLineColor: '#e0e0e0',
			lineWidth: 1,
			hideHover: 'auto',
			lineColors: ['#006DF0'],
			resize: true
		});
	});
</script>
</body>

</html>