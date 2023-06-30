	<button></button>
	<div class="pull-right tableTools-container"></div>
	<div class="removeMessages"></div>
	<br>

	<table id="dynamic-table1" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>No.</th>
				<th>Tanggal</th>
				<th>Kegiatan</th>
				<th>Waktu Mulai</th>
				<th>Waktu Selesai</th>
				<th>Lama Pengerjaan</th>
				<th>Deskripsi Pekerjaan</th>
				<th>Output</th>
				<th>Satuan</th>
				<th>File</th>
				<th>Status Verifikasi</th>
				<th>Nilai</th>
				<th>Keterangan/Catatan</th>
				<th>Verifikator</th>
			</tr>
		</thead>
		<tbody>
			<?php
			//session_start();
			session_start();
			include "../../../../config/koneksi.php";
			include "../../../../config/function.php";

			@$id_karyawan = $_SESSION['id_karyawan'];
			@$nama_karyawan = $_GET['nama_karyawan'];
			@$tanggal1 = $_GET['tanggal1'];
			@$tanggal2 = $_GET['tanggal2'];
			//echo $nama_karyawan;
			@$tabel = "v_lapharian";
			@$field_id = "id_harian";
			@$urutan = "desc";
			@$tgl = date('Y-m-d');

			if (@$_SESSION['jabatan'] == "Direktur") {
				@$q = "where nama_lengkap = '$nama_karyawan' and tanggal BETWEEN '$tanggal1' and '$tanggal2' order by id_harian desc ";
			} else {
				@$q = "where nama_lengkap = '$nama_karyawan' and (atasan1 = '$id_karyawan' or atasan2 = '$id_karyawan')  and tanggal BETWEEN '$tanggal1' and '$tanggal2' order by id_harian desc ";
			}

			$tampil = tampil($tabel, @$q);
			$no = 0;
			while ($data = mysqli_fetch_array($tampil)) {
				$no++;
				if ($data['status'] == "Diterima") {
					$status = '<span class="label label-lg label-success">
						<i class="ace-icon glyphicon glyphicon-thumbs-up bigger-120"></i> Diterima </span>';
				} elseif ($data['status'] == "Ditolak") {
					$status = '<span class="label label-lg label-danger">
						<i class="ace-icon glyphicon glyphicon-thumbs-down bigger-120"></i> Ditolak </span>';
				} else {
					$status = '<span class="label label-lg label-warning">
						<i class="ace-icon glyphicon glyphicon-retweet bigger-120"></i>  Proses	</span>';
				}

				$t = tampil("tkaryawan", "where id_karyawan='$data[id_korektor]'");
				$d = mysqli_fetch_array($t);
				if ($d) {
					$verifikator = $d['nama_lengkap'];
				} else {
					$verifikator = " - ";
				}
			?>

				<tr>
					<td><?= @$no ?></td>
					<td><?= $data['tanggal'] ?></td>
					<td><?= $data['kegiatan'] ?></td>
					<td><?= $data['waktu_mulai'] ?></td>
					<td><?= $data['waktu_selesai'] ?></td>
					<td><?= $data['lama_pengerjaan'] ?> Menit</td>
					<td><?= $data['deskripsi_pekerjaan'] ?></td>
					<td><?= $data['output'] ?></td>
					<td><?= $data['satuan'] ?></td>
					<td><?= ($data['file_pekerjaan'] == '-' || $data['file_pekerjaan'] == '') ? '' : '<a href="../file/file_pekerjaan/' . $data['file_pekerjaan'] . '" target="$_blank">Lihat file</a>'; ?></td>
					<td>
						<div class="input-group">
							<input type="hidden" name="id_harian[]" value="<?= $data['id_harian'] ?>">

							<select class="form-control" name="status_verifikasi[]" id="status_verifikasi">
								<option value="<?= $data['status'] ?>"><?= $data['status'] ?></option>
								<option value="Diterima">Diterima</option>
								<option value="Ditolak">Ditolak</option>
							</select>
						</div>
					</td>
					<td> <input type="text" size="4" name="nilai[]" value="<?= $data['nilai'] ?>"></td>
					<td><textarea name="keterangan[]"><?= $data['keterangan'] ?></textarea></td>
					<td><?= @$verifikator ?></td>
				</tr>
			<?php @$total += $data['lama_pengerjaan'];
			}	?>
		</tbody>
		<tr>
			<td colspan="5" align="right" style="color: blue;font-weight: bold;">Total Jam Kerja Efektif Tanggal <span style="color:red"><?= tgl_indo($tanggal1) ?></span> s/d <span style="color:red"><?= tgl_indo($tanggal2) ?></span> </td>
			<td colspan="5" style="color: blue;font-weight: bold;"><?= @$total ?> Menit <span style="color:red">(<?= floor(@$total / 60) ?> Jam)</span> </td>
			<td colspan="4" align="center">
				<button type="submit" class="btn btn-primary" name="bsimpan">Simpan Penilaian</button>
			</td>
		</tr>
	</table>

	<script type="text/javascript">
		var myTable =
			$('#dynamic-table1')
			//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
			.DataTable({
				bAutoWidth: true,
				"aoColumns": [{
						"bSortable": true
					},
					null, null, null, null, null, null, null, null, null, null, null, null,
					{
						"bSortable": false
					}
				],
				"aaSorting": [],

				select: {
					style: 'single'
				}
			});

		$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

		new $.fn.dataTable.Buttons(myTable, {
			buttons: [{
					"extend": "colvis",
					"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
					"className": "btn btn-white btn-primary btn-bold",
					columns: ':not(:first):not(:last)'
				},
				{
					"extend": "copy",
					"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
					"className": "btn btn-white btn-primary btn-bold"
				},
				{
					"extend": "csv",
					"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
					"className": "btn btn-white btn-primary btn-bold"
				},
				{
					"extend": "excel",
					"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
					"className": "btn btn-white btn-primary btn-bold"
				},
				{
					"extend": "pdf",
					"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
					"className": "btn btn-white btn-primary btn-bold"
				},
				{
					"extend": "print",
					"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
					"className": "btn btn-white btn-primary btn-bold",
					autoPrint: false,
					message: ''
				}
			]
		});
		myTable.buttons().container().appendTo($('.tableTools-container'));

		//style the message box
		var defaultCopyAction = myTable.button(1).action();
		myTable.button(1).action(function(e, dt, button, config) {
			defaultCopyAction(e, dt, button, config);
			$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
		});


		var defaultColvisAction = myTable.button(0).action();
		myTable.button(0).action(function(e, dt, button, config) {

			defaultColvisAction(e, dt, button, config);


			if ($('.dt-button-collection > .dropdown-menu').length == 0) {
				$('.dt-button-collection')
					.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
					.find('a').attr('href', '#').wrap("<li />")
			}
			$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
		});
	</script>