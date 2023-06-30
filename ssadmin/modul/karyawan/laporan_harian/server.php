<?php
include "../../../../config/koneksi.php";
include "../../../../config/function.php";

@$tabel = "tharian";
@$field_id = "id_harian";
@$urutan = "desc";
@$id = $_POST['id'];
@$hal = $_GET['hal'];

function validator($simpan)
{
	if ($simpan) {
		$validator['success'] = true;
		$validator['messages'] = "Sukses, Data telah diperbarui..";
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Gagal, Data dapat diperbarui..";
	}
	echo json_encode($validator);
}

if ($hal == 'tambah') {
	@$file = $_FILES['file_pekerjaan']['name'];
	@$tmp  = $_FILES['file_pekerjaan']['tmp_name'];
	$valid_ext = array('jpg', 'jpeg', 'png', 'pdf', 'docx', 'doc', 'xls', 'xlsx');
	$filebaru = $file;
	$path = "../../../../file/file_pekerjaan/" . $filebaru;

	$ext1 = explode('.',  @$_FILES['file_pekerjaan']['name']);
	$ext = strtolower(end($ext1));

	if (in_array($ext, $valid_ext)) {
		move_uploaded_file($tmp, $path);
		$data = array(
			'id_karyawan' => escape($_POST['id_karyawan']),
			'tanggal' => escape($_POST['tanggal']),
			'kegiatan' => escape($_POST['kegiatan']),
			'waktu_mulai' => escape($_POST['waktu_mulai']),
			'waktu_selesai' => escape($_POST['waktu_selesai']),
			'lama_pengerjaan' => escape($_POST['lama_pengerjaan']),
			'output' => escape($_POST['output']),
			'deskripsi_pekerjaan' => escape($_POST['deskripsi_pekerjaan']),
			'file_pekerjaan' => $filebaru,
			'id_satuan' => escape($_POST['id_satuan'])
		);

		validator(TambahData($tabel, $data));
	} else {
		$data = array(
			'id_karyawan' => escape($_POST['id_karyawan']),
			'tanggal' => escape($_POST['tanggal']),
			'kegiatan' => escape($_POST['kegiatan']),
			'waktu_mulai' => escape($_POST['waktu_mulai']),
			'waktu_selesai' => escape($_POST['waktu_selesai']),
			'lama_pengerjaan' => escape($_POST['lama_pengerjaan']),
			'output' => escape($_POST['output']),
			'deskripsi_pekerjaan' => escape($_POST['deskripsi_pekerjaan']),
			'file_pekerjaan' => '-',
			'id_satuan' => escape($_POST['id_satuan'])
		);
		validator(TambahData($tabel, $data));
	}
} elseif ($hal == 'ambildata') {
	$tampil = mysqli_query($koneksi, "select * from $tabel where $field_id='$id'");
	$data = mysqli_fetch_array($tampil);
	echo json_encode($data);
} elseif ($hal == 'edit') {
	if (empty($_FILES['file_pekerjaan']['name'])) {
		$data = array(
			'id_karyawan' => escape($_POST['id_karyawan']),
			'tanggal' => escape($_POST['tanggal']),
			'kegiatan' => escape($_POST['kegiatan']),
			'waktu_mulai' => escape($_POST['waktu_mulai']),
			'waktu_selesai' => escape($_POST['waktu_selesai']),
			'lama_pengerjaan' => escape($_POST['lama_pengerjaan']),
			'output' => escape($_POST['output']),
			'deskripsi_pekerjaan' => escape($_POST['deskripsi_pekerjaan']),
			'id_satuan' => escape($_POST['id_satuan'])
		);
		validator(EditData($tabel, $data, $field_id, $id));
	} else {
		@$file = $_FILES['file_pekerjaan']['name'];
		$tmp  = $_FILES['file_pekerjaan']['tmp_name'];
		$valid_ext = array('jpg', 'jpeg', 'png', 'pdf', 'docx', 'doc', 'xls', 'xlsx');
		$filebaru = $file;
		$path = "../../../../file/file_pekerjaan/" . $filebaru;
		$ext1 = explode('.',  @$_FILES['file_pekerjaan']['name']);
		$ext = strtolower(end($ext1));
		if (in_array($ext, $valid_ext)) {
			move_uploaded_file($tmp, $path);
			$data = array(
				'id_karyawan' => escape($_POST['id_karyawan']),
				'tanggal' => escape($_POST['tanggal']),
				'kegiatan' => escape($_POST['kegiatan']),
				'waktu_mulai' => escape($_POST['waktu_mulai']),
				'waktu_selesai' => escape($_POST['waktu_selesai']),
				'lama_pengerjaan' => escape($_POST['lama_pengerjaan']),
				'output' => escape($_POST['output']),
				'deskripsi_pekerjaan' => escape($_POST['deskripsi_pekerjaan']),
				'file_pekerjaan' => $filebaru,
				'id_satuan' => escape($_POST['id_satuan'])
			);

			validator(EditData($tabel, $data, $field_id, $id));
		}
	}
} elseif ($hal == 'hapus') {
	$simpan = mysqli_query($koneksi, "delete from $tabel where $field_id='$id'");
	validator($simpan);
}
