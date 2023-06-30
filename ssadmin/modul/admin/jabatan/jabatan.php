<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue">Data Jabatan</h3>
		<div class="table-header">
			Daftar Jabatan
		</div>
			<div id="tampildata"></div>
	</div>
</div>


<!-- add modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="form-modal">
	   <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Tambah Data</h4>
	      </div>
	      
	      <form class="form-horizontal" enctype="multipart/form-data" method="post" id="idform">
	      	<input type="hidden" id="id">
	      <div class="modal-body">
			  
			  <div class="form-group">
			    <label for="name" class="col-sm-3 control-label">Jabatan</label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="jabatan" name="jabatan">
			    </div>
			  </div>
		

	      </div>
	      <div class="modal-footer">
	        <button type="button"  class="btn btn-default" data-dismiss="modal" id="breset">Batal</button>
	        <button type="button" class="btn btn-primary" id="bsimpan">Simpan</button>
	        <button type="button" class="btn btn-primary" id="bubah">Ubah</button>
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
var main = "modul/admin/jabatan/";
 $("#tampildata").load(main+"data.php"); 


$("#bsimpan").click(function(){
		var data = new FormData();

		data.append('jabatan', $("#jabatan").val());

		$.ajax({
			type : "POST",
			url : main+"server.php?hal=tambah",
			data : data,
			processData: false,
			contentType: false,
			dataType : 'json',
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function(response){
				if(response.success == true){
					 $(".removeMessages").html('<div class="alert alert-info alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span>Sukses! </strong>'+response.messages+
							'</div>');
							
				}else{
					$(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
				}
				$("#tampildata").load(main+"data.php"); 
				//hidden modal
				$("#form-modal").modal('hide');
				// reset the form 
				$("#idform")[0].reset();
			},
			error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
				alert(xhr.responseText); // munculkan alert
			}
		});
	});

function cariData(id = null){

	// Set judul modal dialog menjadi Form Ubah Data
	$("#form-modal .modal-title").html("<span class='glyphicon glyphicon-pencil'></span> Ubah data");

	$("#bsimpan").hide(); // Sembunyikan tombol simpan
	$("#bubah, #pesan").show(); // Munculkan tombol ubah 


		if(id){

			$.ajax({
			url: main+'server.php?hal=ambildata',
			type: 'post',
			data: {id : id},
			dataType: 'json',
			success:function(response) {
				$("#id").val(response.id_jabatan);
				$("#jabatan").val(response.jabatan);
			}
		});
	}
}

$("#bubah").click(function(){
	var data = new FormData();

		data.append('id', $("#id").val());
		data.append('jabatan', $("#jabatan").val());

	$.ajax({
		type : "POST",
		url : main+"server.php?hal=edit",
		data : data,
		processData: false,
		contentType: false,
		dataType : 'json',
		beforeSend: function(e) {
			if(e && e.overrideMimeType) {
				e.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		success: function(response){
			if(response.success == true){
				$(".removeMessages").html('<div class="alert alert-info alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> Sukses! </strong>'+response.messages+
						'</div>');
						
			}else{
				$(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');
			}
				$("#tampildata").load(main+"data.php"); 
				//hidden modal
				$("#form-modal").modal('hide');
				// reset the form 
				$("#idform")[0].reset();

		},
		error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
			alert(xhr.responseText); // Munculkan alert
		}
	});
});

function hapusData(id = null){
	if(id) {
		// click on remove button
		$("#bhapus").unbind('click').bind('click', function() {
			$.ajax({
				url: main+"server.php?hal=hapus",
				type: "post",
				data: {id : id},
				dataType: "json",
				success:function(response) {
					if(response.success == true){
					$(".removeMessages").html('<div class="alert alert-info alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> Sukses! </strong>'+response.messages+
								'</div>');
								
					}else{
						$(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
								'</div>');
					}
					$("#tampildata").load(main+"data.php"); 
					// close the modal
					$("#mldhapus").modal('hide');
				},
				error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
				alert("ERROR : "+xhr.responseText); // Munculkan alert
			}
			});
		});
	}
}

$("#breset").click(function(){ // Ketika tombol tambah diklik
	$("#idform")[0].reset();
	});
</script>