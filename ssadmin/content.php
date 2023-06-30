<?php
	@$halaman = $_GET['halaman'];
	@$hal = $_GET['hal'];
	@$level = $_SESSION['level'];

	//pengujian apa yang akan ditampilkan.
if($level == "Operator"){
	if($halaman == "data_user"){
			include "modul/admin/data_user/data_user.php";
	}elseif($halaman == "jabatan"){
			include "modul/admin/jabatan/jabatan.php";
	}elseif($halaman == "karyawan"){
			include "modul/admin/karyawan/karyawan.php";
	}else{
		include "modul/admin/home_admin.php";
	}
}elseif($level == "Karyawan"){
	if($halaman == "set_atasan"){
			include "modul/karyawan/set_atasan/set_atasan.php";
	}elseif($halaman == "laporan_harian"){
			include "modul/karyawan/laporan_harian/laporan_harian.php";
	}elseif($halaman == "harian_bawahan"){
			include "modul/karyawan/harian_bawahan/harian_bawahan.php";
	}elseif($halaman == "riwayat_laporan"){
			include "modul/karyawan/riwayat_laporan/riwayat_laporan.php";
	}else{
		include "modul/karyawan/home_karyawan.php";
	}
}elseif($level == "Pengusul"){
	if($halaman == "usulan_penelitian"){
			include "modul/pengusul/usulan_penelitian/usulan_penelitian.php";
	}elseif($halaman == "daftar_usulan"){
			include "modul/pengusul/daftar_usulan/daftar_usulan.php";
	}elseif($halaman == "data_penelitian"){
			include "modul/pengusul/data_penelitian/data_penelitian.php";
	}else{
		include "modul/home_pengusul.php";
	}
}elseif($level == "Reviewer"){
	if($halaman == "daftar_usulan"){
		include "modul/reviewer/daftar_usulan/daftar_usulan.php";
}elseif($halaman == "daftar_usulan"){
			include "modul/reviewer/daftar_usulan/daftar_usulan.php";
	}else{
		include "modul/home_reviewer.php";
	}
	
}
	


?>