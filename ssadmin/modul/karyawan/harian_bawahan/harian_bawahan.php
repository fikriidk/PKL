<?php
include "../config/koneksi.php";
$id_karyawan = escape($_SESSION['id_karyawan']);
?>

<br>
<form class="form-horizontal" enctype="multipart/form-data" method="post" id="idform">

	<?php
	$tampil = mysqli_query($koneksi, "select nama_lengkap,jabatan from v_lapharian where (atasan1 = '$id_karyawan') or (atasan2 = '$id_karyawan') group by nama_lengkap");

	$d = mysqli_fetch_array($tampil);
	if (empty($d)) {
		echo '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong> <span class="glyphicon glyphicon-ok-sign"></span>Perhatian..! </strong> Tidak ada bawahan...</div>';
	} else {
	?>
		<div class="form-group">
			<label for="address" class="col-sm-3 control-label">Tanggal</label>
			<div class="col-sm-2">
				<div class="input-group">
					<input class="form-control date-picker" id="tanggal1" name="tanggal1" value="<?= date('Y-m-d') ?>" type="text" data-date-format="yyyy-mm-dd" />
					<span class="input-group-addon">
						<i class="fa fa-calendar bigger-110"></i>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="input-group">
					<input class="form-control date-picker" id="tanggal2" name="tanggal2" value="<?= date('Y-m-d') ?>" type="text" data-date-format="yyyy-mm-dd" />
					<span class="input-group-addon">
						<i class="fa fa-calendar bigger-110"></i>
					</span>
				</div>

			</div>
		</div>
		<div class="form-group">
			<label for="address" class="col-sm-3 control-label">Pilih Data Karyawan</label>
			<div class="col-sm-5">
				<select class="chosen-select form-control" name="nama_karyawan" id="nama_karyawan" data-placeholder="Pilih Data...">
					<option value="<?= @$_POST['nama_karyawan'] ?>"><?= @$_POST['nama_karyawan'] ?></option>
					<?php
					$tampil1 = mysqli_query($koneksi, "select nama_lengkap,jabatan1 from v_datakaryawan where (atasan1 = '$id_karyawan') or (atasan2 = '$id_karyawan') group by nama_lengkap ");
					while ($data = mysqli_fetch_array($tampil1)) {
						echo "<option value='$data[nama_lengkap]'>$data[nama_lengkap]</option>";
					}
					?>
				</select>
			</div>
		</div>

	<?php } ?>



</form>
<form method="post" action="">
	<div id="tampildataku">
		<?php
		//simpan penilaian
		if (isset($_POST['bsimpan'])) {
			$id_harian = $_POST['id_harian'];
			@$id_korektor = $_SESSION['id_karyawan'];
			$status_verifikasi = $_POST['status_verifikasi'];
			$nilai = $_POST['nilai'];
			$keterangan = $_POST['keterangan'];

			$jumlah_dipilih = count($id_harian);
			for ($x = 0; $x < $jumlah_dipilih; $x++) {
				$simpan = mysqli_query($koneksi, "UPDATE tharian set status = '$status_verifikasi[$x]', nilai = '$nilai[$x]', keterangan='$keterangan[$x]', id_korektor='$id_korektor' where id_harian='$id_harian[$x]'");
			}

			if ($simpan) {
				echo "<script>alert('Penilaian berhasil disimpan');</script>";
			} else {
				echo "<script>alert('Penilaian Gagal disimpan');</script>";
			}
		}

		?>

</form>

</div>


<script type="text/javascript">
	var main = "modul/karyawan/harian_bawahan/";

	function kirim() {
		var atasan = $("#atasan1").val();
		alert(atasan);
	}
	$("#nama_karyawan").change(function() {

		var nama = escape($("#nama_karyawan").val());
		var tanggal1 = escape($("#tanggal1").val());
		var tanggal2 = escape($("#tanggal2").val());

		$("#tampildataku").load(main + "dataharian.php?nama_karyawan=" + nama + "&tanggal1=" + tanggal1 + "&tanggal2=" + tanggal2);

	});
	//$("#bproses").click(function(){
	//data = new FormData();
	//data.append('atasan1', $("#atasan1").val());

	//alert($("#atasan1").val());
	//	$("#tampildataku").load(main+"dataharian.php"); 

	//});

	function Sditerima(id = null, nm = null, tgl1 = null, tgl2 = null) {

		if (id) {
			$.ajax({
				url: main + "server.php?hal=sditerima",
				type: "post",
				data: {
					id: id
				},
				dataType: "json",
				success: function(response) {
					$("#tampildataku").load(main + "dataharian.php?nama_karyawan=" + escape(nm) + "&tanggal1=" + escape(tgl1) + "&tanggal2=" + escape(tgl2));
				},
				error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
					alert("ERROR : " + xhr.responseText); // Munculkan alert
				}
			});
			//});
		}
	}

	function Sditolak(id = null, nm = null, tgl1 = null, tgl2 = null) {
		if (id) {
			$.ajax({
				url: main + "server.php?hal=sditolak",
				type: "post",
				data: {
					id: id
				},
				dataType: "json",
				success: function(response) {
					$("#tampildataku").load(main + "dataharian.php?nama_karyawan=" + escape(nm) + "&tanggal1=" + escape(tgl1) + "&tanggal2=" + escape(tgl2));
				},
				error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
					alert("ERROR : " + xhr.responseText); // Munculkan alert
				}
			});
			//});
		}
	}

	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	});

	$('.chosen-select').chosen({
		allow_single_deselect: true
	});
	$('#chosen-multiple-style .btn').on('click', function(e) {
		var target = $(this).find('input[type=radio]');
		var which = parseInt(target.val());
		if (which == 2) $('#form-field-select-4').addClass('tag-input-style');
		else $('#form-field-select-4').removeClass('tag-input-style');
		$(".chosen-select").chosen({
			width: "inherit"
		});
	});

	$(".chosen-select").chosen({
		width: "95%"
	});
</script>
<style type="text/css">
	.chosen-container {
		width: 100% !important;
	}
</style>