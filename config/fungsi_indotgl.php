<?php
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
