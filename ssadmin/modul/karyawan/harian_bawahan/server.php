<?php
include "../../../../config/koneksi.php";
include "../../../../config/function.php";
session_start();
@$tabel = "tharian";
@$field_id = "id_harian";
@$urutan = "desc";
@$id = $_POST['id'];
@$hal = $_GET['hal'];
@$id_korektor = $_SESSION['id_karyawan'];

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
		    'id_karyawan' => escape($_POST['id_karyawan']),
		    'tanggal' => escape($_POST['tanggal']),
		    'kegiatan' => escape($_POST['kegiatan']),
		    'waktu_mulai' => escape($_POST['waktu_mulai']),
		    'waktu_selesai' => escape($_POST['waktu_selesai']),
		    'lama_pengerjaan' => escape($_POST['lama_pengerjaan']),
		    'output' => escape($_POST['output']),
		    'id_satuan' => escape($_POST['id_satuan'])
		);
	     validator(TambahData($tabel,$data));
			
	}
	elseif($hal == 'sditerima')
	{
			$data = array(
		    'status' => escape('Diterima'),
		    'id_korektor' => escape($id_korektor)
		   );
			validator(EditData($tabel,$data,$field_id,$id));
	}
	elseif($hal == 'sditolak')
	{
			$data = array(
		    'status' => escape('Ditolak'),
		    'id_korektor' => escape($id_korektor)
		   );
			
			validator(EditData($tabel,$data,$field_id,$id));
	}
	elseif($hal == 'ambildata')
	{
			$tampil = mysqli_query($koneksi,"select * from $tabel where $field_id='$id'");
			$data = mysqli_fetch_array($tampil);
			echo json_encode($data);

	}
	elseif($hal == 'edit')
	{

			$data = array(
		    'id_karyawan' => escape($_POST['id_karyawan']),
		    'tanggal' => escape($_POST['tanggal']),
		    'kegiatan' => escape($_POST['kegiatan']),
		    'waktu_mulai' => escape($_POST['waktu_mulai']),
		    'waktu_selesai' => escape($_POST['waktu_selesai']),
		    'lama_pengerjaan' => escape($_POST['lama_pengerjaan']),
		    'output' => escape($_POST['output']),
		    'id_satuan' => escape($_POST['id_satuan'])
		 );
			
			validator(EditData($tabel,$data,$field_id,$id));
	}
	elseif($hal == 'hapus')
	{
			$simpan = mysqli_query($koneksi,"delete from $tabel where $field_id='$id'");
			validator($simpan);
	}

	

?>
