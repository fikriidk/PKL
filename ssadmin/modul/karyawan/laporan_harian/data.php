<button class="btn btn-success pull " id="btambah" data-toggle="modal" data-target="#form-modal">
	<span class="glyphicon glyphicon-plus-sign"></span> Tambah Data
</button>
<div class="table-responsive">
	<div class="pull-right tableTools-container"></div>
	<div class="removeMessages"></div>

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
				<th>Status</th>
				<th>Nilai</th>
				<th>Keterangan/Catatan</th>
				<th>Verifikator</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody>
			<?php


			include "../../../../config/koneksi.php";
			include "../../../../config/function.php";

			@$tabel = "v_lapharian";
			@$field_id = "id_harian";
			@$urutan = "desc";
			@$tgl = date('Y-m-d');
			session_start();
			//$tampil = pencarian_data($tabel,"id_karyawan",$_SESSION['id_karyawan']);
			$tampil = tampil($tabel, "where tanggal = '$tgl' and id_karyawan = '$_SESSION[id_karyawan]' order by id_harian desc ");

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
					<td><?= $status ?></td>
					<td><?= $data['nilai'] ?></td>
					<td><?= $data['keterangan'] ?></td>
					<td><?= @$verifikator ?></td>
					<td>
						<?php
						if ($data['status'] == "Proses") :
						?>
							<button class="btn btn-warning btn-xs" data-rel="tooltip" title="Ubah Data" data-toggle="modal" data-target="#form-modal" onclick="cariData('<?= $data[$field_id] ?>')">
								<li class="ace-icon fa fa-pencil  bigger-110 icon-only"></li>
							</button>
							<button class="btn btn-danger btn-xs" data-rel="tooltip" title="Hapus Data" data-toggle="modal" data-target="#mldhapus" onclick="hapusData('<?= $data[$field_id] ?>')">
								<li class="ace-icon fa fa-trash  bigger-110 icon-only"></li>
							</button>
						<?php endif; ?>
				</tr>
			<?php
				@$total += $data['lama_pengerjaan'];
				@$total_nilai += $data['nilai'];
			}	?>
		</tbody>
		<tr>
			<td colspan="5" align="right" style="color: blue;font-weight: bold;">Total Jam Kerja Efektif Hari ini, <span style="color:red"><?= tgl_indo(date('Y-m-d')) ?></span> </td>
			<td colspan="6" style="color: blue;font-weight: bold;"><?= @$total ?> Menit <span style="color:red"> (<?= floor(@$total / 60) ?> Jam)</span> </td>
			<td colspan="5"><b><?= @$total_nilai ?></b></td>
		</tr>
	</table>
</div>
<script>
	$("#btambah").click(function() { // Ketika tombol tambah diklik

		$("#form-modal .modal-title").html("<span class='glyphicon glyphicon-plus-sign'></span> Tambah data");

		$("#bubah, #pesan").hide(); // Sembunyikan tombol ubah dan checkbox foto
		$("#bsimpan").show(); // Munculkan tombol simpan

		// reset the form 
		$("#idform")[0].reset();
		$("#id_satuan").val('').trigger("chosen:updated");

	});


	var myTable =
		$('#dynamic-table1')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.DataTable({
			bAutoWidth: true,
			"aoColumns": [{
					"bSortable": true
				},
				null, null, null, null, null, null, null, null, null, null, null, null, null,
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