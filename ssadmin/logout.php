<?php
  session_start();
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['nama_sekolah']);
	
	session_destroy();
  echo "<script>alert('Anda telah keluar dari halaman administrator'); window.location = 'index.php'</script>";
?>