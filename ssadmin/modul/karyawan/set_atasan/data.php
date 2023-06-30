<button class="btn btn-primary pull">
	
</button>
	<div class="pull-right tableTools-container"></div>
	<div class="removeMessages"></div>
<table id="dynamic-table1" class="table table-striped table-bordered table-hover" >
	<thead>
		<tr>
			<th>No.</th>
			<th>NIP</th>
			<th>Nama</th>
			<th>Jabatan</th>
			<th>Atasan</th>
			<th>Atasan dari Atasan</th>
			<th>Status</th>
			<th>Foto</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php
	
session_start();
	include "../../../../config/koneksi.php";
	include "../../../../config/function.php";

	@$tabel = "tkaryawan";
	@$field_id = "id_karyawan";
	@$urutan = "desc";

	$id_karyawan = $_SESSION['id_karyawan'];
	  // $tampil = TampilData($tabel,$field_id,$urutan);
	   $tampil = tampildata_relasi("tkaryawan.*,tjabatan.jabatan","tkaryawan,tjabatan","tkaryawan.jabatan=tjabatan.id_jabatan and tkaryawan.id_karyawan='$id_karyawan' order by id_karyawan desc");

		$no = 0;
		while($data = mysqli_fetch_array($tampil)){
			$no++;
		if($data['status'] == "Aktif"){
			$status = '<span class="label label-success arrowed">Aktif</span>';
		}else{
			$status = '<span class="label label-warning arrowed">Non Aktif</span>';
		}
		$atasan1 = '';
		$atasan2 = '';

		$t = pencarian_data($tabel, $field_id, $data['atasan1']);
		$d = mysqli_fetch_array($t);
		if($d){	$atasan1 = $d['nama_lengkap']; }else{$atasan1 = '<font color="red">Belum ditentukan</font>';}
		
		$t1 = pencarian_data($tabel, $field_id, $data['atasan2']);
		$d1 = mysqli_fetch_array($t1);
		if($d1){$atasan2 = $d1['nama_lengkap']; }else{$atasan2 = '<font color="red">Belum ditentukan</font>';}


		?>

		<tr>
			<td><?=@$no?></td>
			<td><?=$data['nip']?></td>
			<td><?=$data['nama_lengkap']?></td>
			<td><?=$data['jabatan']?></td>
			<td><?=$atasan1?></td>
			<td><?=$atasan2?></td>
			<td><?=$status?></td>
			<td width="100"><img width="100" height="100" src="../file/foto_karyawan/<?=$data['foto']?>"></td>
			<td>
				<button class="btn btn-warning btn-xs" data-rel="tooltip" title="Ubah Data" data-toggle="modal" data-target="#form-modal" onclick="cariData('<?=$data[$field_id]?>')"><li class="ace-icon fa fa-pencil  bigger-110 icon-only"></li></button> 
				
		</tr>
		<?php }	?>	
	</tbody>
</table>


<script>
	$("#btambah").click(function(){ // Ketika tombol tambah diklik

		$("#form-modal .modal-title").html("<span class='glyphicon glyphicon-plus-sign'></span> Tambah data");

		$("#bubah, #pesan").hide(); // Sembunyikan tombol ubah dan checkbox foto
		$("#bsimpan").show(); // Munculkan tombol simpan
		
	});


var myTable = 
	$('#dynamic-table1')
	//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
	.DataTable( {
		bAutoWidth: true,
		"aoColumns": [
		  { "bSortable": true },
		  null, null,null,null,null,null,null,
		  { "bSortable": false }
		],
		"aaSorting": [],

		select: {
			style: 'single'
		}
    });
	
	$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
	new $.fn.dataTable.Buttons( myTable, {
		buttons: [
		  {
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
	} );
	myTable.buttons().container().appendTo( $('.tableTools-container') );
	
	//style the message box
	var defaultCopyAction = myTable.button(1).action();
	myTable.button(1).action(function (e, dt, button, config) {
		defaultCopyAction(e, dt, button, config);
		$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
	});
	
	
	var defaultColvisAction = myTable.button(0).action();
	myTable.button(0).action(function (e, dt, button, config) {
		
		defaultColvisAction(e, dt, button, config);
		
		
		if($('.dt-button-collection > .dropdown-menu').length == 0) {
			$('.dt-button-collection')
			.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
			.find('a').attr('href', '#').wrap("<li />")
		}
		$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
	});

</script>