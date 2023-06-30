<?php
include "../config/koneksi.php";
$id_karyawan = escape($_SESSION['id_karyawan']);
?>

<br>
<form class="form-horizontal" enctype="multipart/form-data" method="post" id="idform">


	<div class="form-group">
		<label for="address" class="col-sm-4 control-label-left">Tanggal</label>
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
</form>
<center><button class=" btn btn-primary" id="btampil">Tampilkan</button></center>
<form method="post" action="<?= $base_url ?>ssadmin/modul/cetak/cetak_riwayat_laporan.php" style="display: inline;" target="$_blank">
	<input type="hidden" name="tanggal1a" id="tanggal1a">
	<input type="hidden" name="tanggal2a" id="tanggal2a">
	<button type="submit" class="btn btn-success" id="cetak" style="display: none;"> <i class="fa fa-print"></i>Cetak Laporan</button>
</form>
<form method="post" action="<?= $base_url ?>ssadmin/modul/cetak/excel_riwayat_laporan.php" style="display: inline;">
	<input type="hidden" name="tanggal1b" id="tanggal1b">
	<input type="hidden" name="tanggal2b" id="tanggal2b">
	<button type="submit" class="btn btn-warning" id="excel" style="display: none;"><i class="fa fa-download"></i>Export Excel</button>
</form>
<div id="tampildataku">

</div>

<!-- add modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="form-modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Data</h4>
			</div>

			<form class="form-horizontal" enctype="multipart/form-data" method="post" id="idform">
				<input type="hidden" value="<?= $_SESSION['id_karyawan'] ?>" id="id_karyawan">
				<input type="hidden" id="id">
				<div class="modal-body">
					<div class="form-group">
						<label for="address" class="col-sm-3 control-label-left">Tanggal</label>
						<div class="col-sm-4">
							<div class="input-group">
								<input class="form-control date-picker" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>" type="text" data-date-format="yyyy-mm-dd" />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label-left">Kegiatan</label>
						<div class="col-sm-9">
							<textarea class="form-control" id="kegiatan" placeholder="Default Text" required></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label-left">Waktu Mulai</label>
						<div class="col-sm-4">
							<div class="input-group bootstrap-timepicker ">
								<input id="waktu_mulai" type="text" class="form-control timepicker1" />
								<span class="input-group-addon">
									<i class="fa fa-clock-o bigger-110"></i>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label-left">Waktu Selesai</label>
						<div class="col-sm-4">
							<div class="input-group bootstrap-timepicker ">
								<input id="waktu_selesai" type="text" class="form-control timepicker1" />
								<span class="input-group-addon">
									<i class="fa fa-clock-o bigger-110"></i>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="address" class="col-sm-3 control-label-left">Lama Pengerjaan</label>
						<div class="col-sm-4">
							<div class="input-group">
								<input class="form-control" id="lama_pengerjaan" name="lama_pengerjaan" type="text" readonly />
								<span class="input-group-addon">
									Menit <i class="fa fa-clock-o bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-3 control-label-left">Deskripsi Pekerjaan</label>
						<div class="col-sm-9">
							<textarea class="form-control" name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" placeholder="Default Text"></textarea>

						</div>
					</div>
					<div class="form-group">
						<label for="address" class="col-sm-3 control-label-left">Output</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="output" name="output" placeholder="Output yang dihasilkan">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label-left no-padding-right" for="form-field-1"> Satuan </label>
						<div class="col-sm-9">
							<select class="chosen-select form-control" name="id_satuan" id="id_satuan" data-placeholder="Pilih Satuan..." required>
								<option></option>
								<?php
								$tampil = mysqli_query($koneksi, "select * from tsatuan order by satuan asc");
								while ($data = mysqli_fetch_array($tampil)) {
									echo "<option value='$data[id_satuan]'>$data[satuan]</option>";
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label-left">File Pekerjaan</label>
						<div class="col-sm-9">
							<input type="file" name="file_pekerjaan" id="file_pekerjaan" class="form-control">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="bsimpan">Simpan</button>
					<button type="button" class="btn btn-primary" id="bubah">Ubah</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="breset">Batal</button>

				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /add modal -->


<!-- remove modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="mldhapus">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Hapus Data</h4>
			</div>
			<div class="modal-body">
				<p>Anda Yakin akan menghapus Data ini?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary" onclick="hapusData()" id="bhapus">Ya, Hapus aja</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove modal -->


<script type="text/javascript">
	var main = "modul/karyawan/riwayat_laporan/";

	function kirim() {
		var atasan = $("#atasan1").val();
		alert(atasan);
	}
	$("#btampil").click(function() {
		var tanggal1 = escape($("#tanggal1").val());
		var tanggal2 = escape($("#tanggal2").val());
		$("#tanggal1a").val(tanggal1);
		$("#tanggal2a").val(tanggal2);
		$("#tanggal1b").val(tanggal1);
		$("#tanggal2b").val(tanggal2);
		$("#tampildataku").load(main + "dataharian.php?tanggal1=" + tanggal1 + "&tanggal2=" + tanggal2);

		$("#cetak").show();
		$("#excel").show();

	});

	$("#nama_karyawan").change(function() {

		var nama = escape($("#nama_karyawan").val());
		var tanggal1 = escape($("#tanggal1").val());
		var tanggal2 = escape($("#tanggal2").val());

		$("#tampildataku").load(main + "dataharian.php?nama_karyawan=" + nama + "&tanggal1=" + tanggal1 + "&tanggal2=" + tanggal2);

	});

	function cariData(id = null) {
		// Set judul modal dialog menjadi Form Ubah Data
		$("#form-modal .modal-title").html("<span class='glyphicon glyphicon-pencil'></span> Ubah data");

		$("#bsimpan").hide(); // Sembunyikan tombol simpan
		$("#bubah, #pesan").show(); // Munculkan tombol ubah 


		if (id) {

			$.ajax({
				url: main + 'server.php?hal=ambildata',
				type: 'post',
				data: {
					id: id
				},
				dataType: 'json',
				success: function(response) {
					$("#id").val(response.id_harian);
					$("#tanggal").val(response.tanggal);
					$("#kegiatan").val(response.kegiatan);
					$("#waktu_mulai").val(response.waktu_mulai);
					$("#waktu_selesai").val(response.waktu_selesai);
					$("#lama_pengerjaan").val(response.lama_pengerjaan);
					$("#output").val(response.output);
					//$("#deskripsi_pekerjaan").val(response.deskripsi_pekerjaan);
					//$("#deskripsi_pekerjaan").val(response.deskripsi_pekerjaan);
					CKEDITOR.instances.deskripsi_pekerjaan.setData(response.deskripsi_pekerjaan);

					$("#file_pekerjaan").val(response.file_pekerjaan);

					$("#id_satuan").val(response.id_satuan).trigger("chosen:updated");
				}
			});
		}
	}

	$("#bubah").click(function() {
		var data = new FormData();

		data.append('id', $("#id").val());
		data.append('id_karyawan', $("#id_karyawan").val());
		data.append('tanggal', $("#tanggal").val());
		data.append('kegiatan', $("#kegiatan").val());
		data.append('waktu_mulai', $("#waktu_mulai").val());
		data.append('waktu_selesai', $("#waktu_selesai").val());
		data.append('lama_pengerjaan', $("#lama_pengerjaan").val());
		data.append('output', $("#output").val());
		data.append('deskripsi_pekerjaan', CKEDITOR.instances['deskripsi_pekerjaan'].getData());
		data.append('file_pekerjaan', $("#file_pekerjaan")[0].files[0]);
		data.append('id_satuan', $("#id_satuan").val());

		if ($("#kegiatan").val() == "" || $("#waktu_mulai").val() == "" || $("#waktu_selesai").val() == "" || $("#id_satuan").val() == "") {
			alert("Perhatikan Inputan anda, masih terdapat field yang kosong, harap periksa kembali, terima kasih..");
		} else {

			$.ajax({
				type: "POST",
				url: main + "server.php?hal=edit",
				data: data,
				processData: false,
				contentType: false,
				dataType: 'json',
				beforeSend: function(e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(response) {
					if (response.success == true) {
						$(".removeMessages").html('<div class="alert alert-info alert-dismissible" role="alert">' +
							'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
							'<strong> <span class="glyphicon glyphicon-ok-sign"></span> Sukses! </strong>' + response.messages +
							'</div>');

					} else {
						$(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
							'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
							'<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
							'</div>');
					}
					$("#tampildata").load(main + "data.php");
					//hidden modal
					$("#form-modal").modal('hide');
					// reset the form 
					$("#idform")[0].reset();
					$("#id_satuan").val('').trigger("chosen:updated");

				},
				error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
					alert(xhr.responseText); // Munculkan alert
				}
			});
		}

	});

	function hapusData(id = null) {
		if (id) {
			// click on remove button
			$("#bhapus").unbind('click').bind('click', function() {
				$.ajax({
					url: main + "server.php?hal=hapus",
					type: "post",
					data: {
						id: id
					},
					dataType: "json",
					success: function(response) {
						if (response.success == true) {
							$(".removeMessages").html('<div class="alert alert-info alert-dismissible" role="alert">' +
								'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
								'<strong> <span class="glyphicon glyphicon-ok-sign"></span> Sukses! </strong>' + response.messages +
								'</div>');

						} else {
							$(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
								'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
								'<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
								'</div>');
						}
						$("#tampildata").load(main + "data.php");
						// close the modal
						$("#mldhapus").modal('hide');
					},
					error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
						alert("ERROR : " + xhr.responseText); // Munculkan alert
					}
				});
			});
		}
	}

	CKEDITOR.replace('deskripsi_pekerjaan');

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