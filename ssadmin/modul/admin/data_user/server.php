<?php
include "../../../../config/koneksi.php";
include "../../../../config/function.php";

@$tabel = "tuser";
@$field_id = "id_user";
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
	$path = "../../../file/foto_user/" . $filebaru;

	$pass = hash("sha512", md5($_POST['password']));
	$ext1 = explode('.',  @$_FILES['file_pekerjaan']['name']);
	$ext = strtolower(end($ext1));
	if (in_array($ext, $valid_ext)) {
		move_uploaded_file($tmp, $path);
		$data = array(
			'username' => escape($_POST['username']),
			'password' => $pass,
			'nama_pengguna' => escape($_POST['nama_pengguna']),
			'level' => escape($_POST['level']),
			'status' => escape($_POST['status']),
			'foto' => escape($filebaru)
		);
		validator(TambahData($tabel, $data));
	} else {
		$data = array(
			'username' => escape($_POST['username']),
			'password' => $pass,
			'nama_pengguna' => escape($_POST['nama_pengguna']),
			'level' => escape($_POST['level']),
			'status' => escape($_POST['status']),
			'foto' => escape("noimages.jpg")
		);
		validator(TambahData($tabel, $data));
	}
} elseif ($hal == 'ambildata') {
	$id_user = $_POST['id_user'];
	$tampil = mysqli_query($koneksi, "select * from tuser where id_user='$id_user'");
	$data = mysqli_fetch_array($tampil);
	echo json_encode($data);
} elseif ($hal == 'edit') {

	if (empty($_FILES['file']['name'])) {
		if ($_POST['password'] == "") {
			$data = array(
				'username' => escape($_POST['username']),
				'nama_pengguna' => escape($_POST['nama_pengguna']),
				'level' => escape($_POST['level']),
				'status' => escape($_POST['status'])
			);
			validator(EditData($tabel, $data, $field_id, $id));
		} else {
			$pass = hash("sha512", md5($_POST['password']));
			$data = array(
				'username' => escape($_POST['username']),
				'password' => $pass,
				'nama_pengguna' => escape($_POST['nama_pengguna']),
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
		$path = "../../../../file/foto_user/" . $filebaru;
		$ext1 = explode('.',  @$_FILES['file_pekerjaan']['name']);
		$ext = strtolower(end($ext1));
		if (in_array($ext, $valid_ext)) {
			move_uploaded_file($tmp, $path);
			if ($_POST['password'] == "") {
				$data = array(
					'username' => escape($_POST['username']),
					'nama_pengguna' => escape($_POST['nama_pengguna']),
					'level' => escape($_POST['level']),
					'status' => escape($_POST['status']),
					'foto' => escape($filebaru)
				);
				validator(EditData($tabel, $data, $field_id, $id));
			}
		} else {
			$pass = hash("sha512", md5($_POST['password']));
			$data = array(
				'username' => escape($_POST['username']),
				'password' => $pass,
				'nama_pengguna' => escape($_POST['nama_pengguna']),
				'level' => escape($_POST['level']),
				'status' => escape($_POST['status']),
				'foto' => escape($filebaru)
			);
			validator(EditData($tabel, $data, $field_id, $id));
		}
	}
} elseif ($hal == 'hapus') {
	$id = $_POST['id'];
	$simpan = mysqli_query($koneksi, "delete from tuser where id_user='$id'");
	validator($simpan);
}
