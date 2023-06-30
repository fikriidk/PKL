<?php
	function run($query){
		global $koneksi;
		
		if (mysqli_query($koneksi, $query)){
			return true;
		}else{
			return false;
		}
	}
	
	function run1($query){
		global $koneksi;
		$result = mysqli_query($koneksi, $query) or die("Query tampil data gagal..!".mysqli_error());	
		return $result;
	}
	//Simpan Data
	function TambahData($tabel,$data){
		$kunci = implode(", ",array_keys($data));
		
		$i = 0;
		foreach($data as $key=>$value){
			if(!is_int($value)){
				$nilaiArray[$i]="'". $value ."'";
			}else{
				$nilaiArray[$i]=$value;
			}
			$i++;
		}
		
		$nilai = implode(", ",($nilaiArray));
	$query = "insert into $tabel ($kunci)
			  values($nilai)";	

	return run($query);
	}

	//Edit Data
	function EditData($tabel,$data,$field,$id){
		$i = 0;
		foreach($data as $key=>$value){
			if(!is_int($value)){
				$nilaiArray[$i]= $key ."='". $value ."'";
			}else{
				$nilaiArray[$i]= $key ."=". $value;
			}
			$i++;
		}
		$nilai = implode(", ",($nilaiArray));
		$query = "update $tabel set $nilai
		          where $field = $id";
		
		return run($query);
	}
	function EditData1($tabel,$data,$field){
		$i = 0;
		foreach($data as $key=>$value){
			if(!is_int($value)){
				$nilaiArray[$i]= $key ."='". $value ."'";
			}else{
				$nilaiArray[$i]= $key ."=". $value;
			}
			$i++;
		}
		$nilai = implode(", ",($nilaiArray));
		$query = "update $tabel set $nilai
		          where $field";
		
		return run($query);
	}
	//Hapus Data
	function HapusData($tabel,$field,$id){
		$query = "delete from $tabel where $field=$id";
		return run($query);
	}
	
	
	//Tampilkan Data
	function TampilData($tabel,$field,$urutan){
	$query = "select * from $tabel order by $field $urutan";
	return run1($query);
	
	}
	function tampil($tabel,$where){
	$query = "select * from $tabel $where";
	return run1($query);
	
	}
	
	//Tampil Data Per ID
	function pencarian_data($tabel,$field,$id){
		$query = "select * from $tabel WHERE $field='$id'";
		return run1($query);
	}

	//Tampil Data Relasi
	function tampildata_relasi($relasi,$tabel,$field){
		$query = "select $relasi from $tabel WHERE $field";
		return run1($query);
	}
	function tampildata_relasi1($relasi,$where){
		$query = "select $relasi from $where";
		return run1($query);
	}

	//Tampil Data Per ID
	function pencarian_data_relasi($relasi,$tabel,$field){
		$query = "select $relasi from $tabel WHERE $field";
		return run1($query);
	}
	//Tampilkan Data autocomplete
	function tampildata_auto($field,$tabel,$where){
	$query = "select $field from $tabel $where";
	return run1($query);
	}

	function escape($data){
		global $koneksi;
		return mysqli_escape_string($koneksi,$data);
	}
	
	function rupiah($angka){
		$hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
		return $hasil_rupiah;
	}

	function jam_indo($jam){
			$jam1 = substr($jam,0,2);
			$menit = substr($jam,3,2);
			return $jam1.':'.$menit;	
	}
	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			}
function getBulan1($bln){
				switch ($bln){
					case 1: 
						return "I";
						break;
					case 2:
						return "II";
						break;
					case 3:
						return "III";
						break;
					case 4:
						return "IV";
						break;
					case 5:
						return "V";
						break;
					case 6:
						return "VI";
						break;
					case 7:
						return "VII";
						break;
					case 8:
						return "VIII";
						break;
					case 9:
						return "IX";
						break;
					case 10:
						return "X";
						break;
					case 11:
						return "XI";
						break;
					case 12:
						return "XII";
						break;
				}
			} 

function getday($tgl,$sep){
        $sepparator = $sep; //separator. contoh: '-', '/'
        $parts = explode($sepparator, $tgl);
     //   $d = date("l", mktime(0, 0, 0, $parts[1], $parts[2], $parts[0]));
           $d = date("l", mktime(0, 0, 0, $parts[1], $parts[2], $parts[0]));
 
        if ($d=='Monday'){
            return 'Senin';
        }elseif($d=='Tuesday'){
            return 'Selasa';
        }elseif($d=='Wednesday'){
            return 'Rabu';
        }elseif($d=='Thursday'){
            return 'Kamis';
        }elseif($d=='Friday'){
            return 'Jumat';
        }elseif($d=='Saturday'){
            return 'Sabtu';
        }elseif($d=='Sunday'){
            return 'Minggu';
        }else{
            return 'ERROR!';
        }
    }
?>