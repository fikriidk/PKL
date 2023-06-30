<?php
session_start();
include "../config/koneksi.php";

@$pass = hash("sha512", md5($_POST['password']));
@$username = mysqli_escape_string($koneksi, $_POST['username']);
@$password = mysqli_escape_string($koneksi, $pass);
@$level = mysqli_escape_string($koneksi, $_POST['level']);

if ($level == "Operator") {

  @$q = "SELECT * FROM tuser WHERE username='$username' AND password='$password' and level='Operator' and status='Aktif'";
} elseif ($level == "Karyawan") {
  @$q = "SELECT * FROM v_datakaryawan WHERE nip='$username' AND password='$password' and level='Karyawan' and status='Aktif'";
}
// pastikan username dan password adalah berupa huruf atau angka.

$login = mysqli_query($koneksi, @$q);
@$r = mysqli_fetch_array($login);
// Apabila username dan password ditemukan
if ($r) {
  /// session_start();
  if ($level == "Operator") {
    $_SESSION['id_user']     = $r['id_user'];
    $_SESSION['username']     = $r['username'];
    $_SESSION['password']     = $r['password'];
    $_SESSION['foto']        = $r['foto'];
    $_SESSION['level']     = $level;
  }
  if ($level == "Karyawan") {
    $_SESSION['id_karyawan']     = $r['id_karyawan'];
    $_SESSION['nama_pengguna'] = $r['nama_lengkap'];
    $_SESSION['username']     = $r['nip'];
    $_SESSION['jabatan']     = $r['jabatan1'];
    $_SESSION['password']     = $r['password'];
    $_SESSION['foto']        = $r['foto'];
    $_SESSION['level']     = $level;
  } else {
    $_SESSION['nama_pengguna']    = $r['nama_pengguna'];
  }

  header('location:admin.php');
} else {


  echo "<script>alert('Maaf, Login Gagal, pastikan username dan password anda benar..!');document.location='index.php';</script>";
}
