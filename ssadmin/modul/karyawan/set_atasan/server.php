<?php
include "../../../../config/koneksi.php";
include "../../../../config/function.php";

@$tabel = "tkaryawan";
@$field_id = "id_karyawan";
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
	@$file = $_FILES['file']['name'];
	@$tmp  = $_FILES['file']['tmp_name'];
	$valid_ext = array('jpg', 'jpeg', 'png');
	$filebaru = $file;
	$path = "../../../file/foto_karyawan/" . $filebaru;

	$pass = hash("sha512", md5($_POST['password']));

	$ext = strtolower(end(explode('.', @$_FILES['file']['name'])));
	if (in_array($ext, $valid_ext)) {
		move_uploaded_file($tmp, $path);
		$data = array(
			'nip' => escape($_POST['nip']),
			'nama_lengkap' => escape($_POST['nama_lengkap']),
			'jabatan' => escape($_POST['jabatan']),
			'atasan1' => escape($_POST['atasan1']),
			'atasan2' => escape($_POST['atasan2']),
			'password' => escape($pass),
			'level' => escape($_POST['level']),
			'status' => escape($_POST['status']),
			'foto' => escape($filebaru)
		);
		validator(TambahData($tabel, $data));
	} else {
		$data = array(
			'nip' => escape($_POST['nip']),
			'nama_lengkap' => escape($_POST['nama_lengkap']),
			'jabatan' => escape($_POST['jabatan']),
			'atasan1' => escape($_POST['atasan1']),
			'atasan2' => escape($_POST['atasan2']),
			'password' => escape($pass),
			'level' => escape($_POST['level']),
			'status' => escape($_POST['status']),
			'foto' => escape("noimages.jpg")
		);
		validator(TambahData($tabel, $data));
	}
} elseif ($hal == 'ambildata') {
	$tampil = mysqli_query($koneksi, "select * from tkaryawan where id_karyawan='$id'");
	$data = mysqli_fetch_array($tampil);
	echo json_encode($data);
} elseif ($hal == 'edit') {
	if (empty($_FILES['file']['name'])) {
		if ($_POST['password'] == "") {
			$data = array(
				'nip' => escape($_POST['nip']),
				'nama_lengkap' => escape($_POST['nama_lengkap']),
				'jabatan' => escape($_POST['jabatan']),
				'atasan1' => escape($_POST['atasan1']),
				'atasan2' => escape($_POST['atasan2']),
				'level' => escape($_POST['level']),
				'status' => escape($_POST['status'])
			);
			validator(EditData($tabel, $data, $field_id, $id));
		} else {
			$pass = hash("sha512", md5($_POST['password']));
			$data = array(
				'nip' => escape($_POST['nip']),
				'nama_lengkap' => escape($_POST['nama_lengkap']),
				'jabatan' => escape($_POST['jabatan']),
				'atasan1' => escape($_POST['atasan1']),
				'atasan2' => escape($_POST['atasan2']),
				'password' => escape($pass),
				'level' => escape($_POST['level']),
				'status' => escape($_POST['status'])
			);
			validator(EditData($tabel, $data, $field_id, $id));
		}
	} else {
		@$file = $_FILES['file']['name'];
		$tmp  = $_FILES['file']['tmp_name'];
		$valid_ext = array('jpg', 'jpeg', 'png');
		$filebaru = $file;
		$path = "../../../../file/foto_karyawan/" . $filebaru;
		$ekstensi =  explode(".", $_FILES['file']['name']);
		$ekstensi = end($ekstensi);
		$ext = strtolower($ekstensi);

		//$ext = strtolower(end(explode('.', $_FILES['file']['name'])));
		if (in_array($ext, $valid_ext)) {
			move_uploaded_file($tmp, $path);
			if ($_POST['password'] == "") {
				$data = array(
					'nip' => escape($_POST['nip']),
					'nama_lengkap' => escape($_POST['nama_lengkap']),
					'jabatan' => escape($_POST['jabatan']),
					'atasan1' => escape($_POST['atasan1']),
					'atasan2' => escape($_POST['atasan2']),
					'level' => escape($_POST['level']),
					'status' => escape($_POST['status']),
					'foto' => escape($filebaru)
				);
				validator(EditData($tabel, $data, $field_id, $id));
			}
		} else {
			$pass = hash("sha512", md5($_POST['password']));
			$data = array(
				'nip' => escape($_POST['nip']),
				'nama_lengkap' => escape($_POST['nama_lengkap']),
				'jabatan' => escape($_POST['jabatan']),
				'atasan1' => escape($_POST['atasan1']),
				'atasan2' => escape($_POST['atasan2']),
				'password' => escape($pass),
				'level' => escape($_POST['level']),
				'status' => escape($_POST['status']),
				'foto' => escape($filebaru)
			);
			validator(EditData($tabel, $data, $field_id, $id));
		}
	}
} elseif ($hal == 'hapus') {
	$id = $_POST['id'];
	$simpan = mysqli_query($koneksi, "delete from tkaryawan where id_karyawan='$id'");
	validator($simpan);
}
