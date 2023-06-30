<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "db_ekinerja-native";

$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));



$base_url = "http://localhost/ekinerja-native/";
$logo = "http://localhost/ekinerja-native/assets/logo-benteng.png";
$nama_aplikasi = "Kabupaten Bengkulu Tengah";
$kota = "";





@$halaman = $_GET['halaman'];
if ($halaman == "data_user") {
	@$title = "Data User | ";
} else {
	$title = "";
}
@$title = $title . $nama_aplikasi;
