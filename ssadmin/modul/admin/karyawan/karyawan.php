<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue">Data Karyawan</h3>
		<div class="table-header">
			Daftar Karyawan
		</div>
		<div id="tampildata"></div>
	</div>
</div>


<!--  add modal  -->
<div class="modal fade" tabindex="-1" role="dialog" id="form-modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Data</h4>
			</div>

			<form class="form-horizontal" enctype="multipart/form-data" method="post" id="idform">
				<input type="hidden" id="id">
				<div class="modal-body">
					<div class="form-group">
						<label for="address" class="col-sm-4 control-label-left">NIP</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nip" name="nip" placeholder="NIP Pengguna">
						</div>
					</div>
					<div class="form-group">
						<label for="address" class="col-sm-4 control-label-left">Nama</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap Pengguna">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label-left no-padding-right" for="form-field-1"> Jabatan </label>
						<div class="col-sm-8">
							<select class="form-control" name="jabatan" id="jabatan" data-placeholder="--Pilih--">
								<option>-Pilih Jabatan-</option>
								<?php
								$tampil = mysqli_query($koneksi, "select * from tjabatan order by jabatan asc");
								while ($data = mysqli_fetch_array($tampil)) {
									echo "<option value='$data[id_jabatan]'>$data[jabatan]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label-left no-padding-right" for="form-field-1"> Data Atasan / Pejabat Penilai </label>
						<div class="col-sm-8">
							<select class="chosen-select form-control" name="atasan1" id="atasan1" data-placeholder="Pilih Data...">
								<option></option>
								<?php
								$tampil = mysqli_query($koneksi, "select * from tkaryawan order by nama_lengkap asc");
								while ($data = mysqli_fetch_array($tampil)) {
									echo "<option value='$data[id_karyawan]'>$data[nip] - $data[nama_lengkap] </option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label-left no-padding-right" for="form-field-1"> Data Atasan dari Atasan / Atasan Pejabat Penilai </label>
						<div class="col-sm-8">
							<select class="chosen-select form-control" name="atasan2" id="atasan2" data-placeholder="Pilih Data...">
								<option></option>
								<?php
								$tampil = mysqli_query($koneksi, "select * from tkaryawan order by nama_lengkap asc");
								while ($data = mysqli_fetch_array($tampil)) {
									echo "<option value='$data[id_karyawan]'>$data[nip] - $data[nama_lengkap] </option>";
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="col-sm-4 control-label-left">Password</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="password" name="password" placeholder="Password">
							<span id="pesan" style="color:red">* Kosongkan jika tidak mengganti passowrd </span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label-left no-padding-right" for="form-field-1"> Level </label>
						<div class="col-sm-4">
							<select class="form-control" name="level" id="level" data-placeholder="--Pilih--">
								<option value="Karyawan">Karyawan</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label-left no-padding-right" for="form-field-1"> Status Aktif </label>
						<div class="col-sm-4">
							<select class="form-control" name="status" id="status" data-placeholder="--Pilih--">
								<option value="Aktif">Aktif</option>
								<option value="Non Aktif">Non Aktif</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="address" class="col-sm-4 control-label-left">Foto</label>
						<div class="col-xs-7">
							<input type="file" id="file" class="file" />
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
	// global the manage memeber table 
	var main = "modul/admin/karyawan/";
	$("#tampildata").load(main + "data.php");


	$("#bsimpan").click(function() {
		var data = new FormData();

		data.append('nip', $("#nip").val());
		data.append('nama_lengkap', $("#nama_lengkap").val());
		data.append('jabatan', $("#jabatan").val());
		data.append('atasan1', $("#atasan1").val());
		data.append('atasan2', $("#atasan2").val());
		data.append('password', $("#password").val());
		data.append('level', $("#level").val());
		data.append('status', $("#status").val());
		data.append('file', $("#file")[0].files[0]);

		$.ajax({
			type: "POST",
			url: main + "server.php?hal=tambah",
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
						'<strong> <span class="glyphicon glyphicon-ok-sign"></span>Sukses! </strong>' + response.messages +
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
			},
			error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
				alert(xhr.responseText); // munculkan alert
			}
		});
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
					$("#id").val(response.id_karyawan);
					$("#nip").val(response.nip);
					$("#nama_lengkap").val(response.nama_lengkap);
					$("#jabatan").val(response.jabatan);
					$("#atasan1").val(response.atasan1).trigger("chosen:updated");
					$("#atasan2").val(response.atasan2).trigger("chosen:updated");
					$("#username").val(response.username);
					$("#level").val(response.level);
					$("#status").val(response.status);
					$("#file").val(response.foto);
				}
			});
		}
	}

	$("#bubah").click(function() {
		var data = new FormData();

		data.append('id', $("#id").val());
		data.append('nip', $("#nip").val());
		data.append('nama_lengkap', $("#nama_lengkap").val());
		data.append('jabatan', $("#jabatan").val());
		data.append('atasan1', $("#atasan1").val());
		data.append('atasan2', $("#atasan2").val());
		data.append('password', $("#password").val());
		data.append('level', $("#level").val());
		data.append('status', $("#status").val());
		data.append('file', $("#file")[0].files[0]);


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

			},
			error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
				alert(xhr.responseText); // Munculkan alert
			}
		});
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

	$("#breset").click(function() { // Ketika tombol tambah diklik
		$("#idform")[0].reset();
	});

	$('.file, #id-input-file-2').ace_file_input({
		no_file: 'No File ...',
		btn_choose: 'Choose',
		btn_change: 'Change',
		droppable: false,
		onchange: null,
		thumbnail: true, //| true | large
		//whitelist:'gif|png|jpg|jpeg'
		blacklist: 'exe|php'
		//onchange:''
		//
	});

	$("#breset").click(function() { // Ketika tombol tambah diklik
		$("#idform")[0].reset();
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