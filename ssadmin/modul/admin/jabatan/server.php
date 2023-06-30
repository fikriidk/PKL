<?php
include "../../../../config/koneksi.php";
include "../../../../config/function.php";

@$tabel = "tjabatan";
@$field_id = "id_jabatan";
@$urutan = "desc";
@$id = $_POST['id'];
@$hal = $_GET['hal'];

function validator($simpan){
	if($simpan){
		$validator['success'] = true;
		$validator['messages'] = "Sukses, Data telah diperbarui..";
	}else{
		$validator['success'] = false;
		$validator['messages'] = "Gagal, Data dapat diperbarui..";
	}
	echo json_encode($validator);
}

	if($hal == 'tambah')
	{
		$data = array(
	    'jabatan' => escape($_POST['jabatan'])
	      );
	     validator(TambahData($tabel,$data));
	}
	elseif($hal == 'edit')
	{
		$data = array(
	    'jabatan' => escape($_POST['jabatan'])
	      );
	     validator(EditData($tabel,$data,$field_id,$id));
	}
	elseif($hal == 'ambildata')
	{
		$tampil = mysqli_query($koneksi,"select * from $tabel where $field_id ='$id'");
		$data = mysqli_fetch_array($tampil);
		echo json_encode($data);
	}
	elseif($hal == 'hapus')
	{
			$simpan = mysqli_query($koneksi,"delete from $tabel where $field_id='$id'");
			validator($simpan);
	}

	

?>
