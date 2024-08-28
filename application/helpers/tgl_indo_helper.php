<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('tgl_indo'))
{
	function tgl_indo($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}

if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln)
		{
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
}

if ( ! function_exists('nama_hari'))
{
	function nama_hari($tanggal)
	{
		$ubah = gmdate($tanggal, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
}

if ( ! function_exists('hitung_mundur'))
{
	function hitung_mundur($wkt)
	{
		$waktu=array(	365*24*60*60	=> "tahun",
						30*24*60*60		=> "bulan",
						7*24*60*60		=> "minggu",
						24*60*60		=> "hari",
						60*60			=> "jam",
						60				=> "menit",
						1				=> "detik");

		$hitung = strtotime(gmdate ("Y-m-d H:i:s", time () +60 * 60 * 8))-$wkt;
		$hasil = array();
		if($hitung<5)
		{
			$hasil = 'kurang dari 5 detik yang lalu';
		}
		else
		{
			$stop = 0;
			foreach($waktu as $periode => $satuan)
			{
				if($stop>=6 || ($stop>0 && $periode<60)) break;
				$bagi = floor($hitung/$periode);
				if($bagi > 0)
				{
					$hasil[] = $bagi.' '.$satuan;
					$hitung -= $bagi*$periode;
					$stop++;
				}
				else if($stop>0) $stop++;
			}
			$hasil=implode(' ',$hasil).' yang lalu';
		}
		return $hasil;
	}
}

if ( ! function_exists('tulis_hari'))
{
	function tulis_hari($var) { //hari
		switch ($var)
		{
			case 0:
				return "Minggu";
				break;
			case 1:
				return "Senin";
				break;
			case 2:
				return "Selasa";
				break;
			case 3:
				return "Rabu";
				break;
			case 4:
				return "Kamis";
				break;
			case 5:
				return "Jumat";
				break;
			case 6:
				return "Sabtu";
				break;
		}
	}
}

if ( ! function_exists('tulis_waktu'))
{
	function tulis_waktu($var) { //waktu
		$tgl= explode(' ', $var);
		$wkt= explode('-', $tgl[0]); 
		switch ($wkt[1])
		{
		case '01': $bl="Januari";break;
		case '02': $bl="Februari";break;
		case '03': $bl="Maret";break;
		case '04': $bl="April";break;
		case '05': $bl="Mei";break;
		case '06': $bl="Juni";break;
		case '07': $bl="Juli";break;
		case '08': $bl="Agustus";break; 
		case '09': $bl="September";break; 
		case '10': $bl="Oktober";break; 
		case '11': $bl="November";break; 
		case '12': $bl="Desember";break;             
		}
		return $wkt[2]." ".$bl." ".$wkt[0]." | ".$tgl[1]." WIB";
	}
}

function highlightKeywords($text, $keyword) {
	$wordsAry = explode(" ", $keyword);
	$wordsCount = count($wordsAry);
	
	for($i=0;$i<$wordsCount;$i++) {
		$highlighted_text = "<span class='text-warning'> $wordsAry[$i]</span> ";
		$text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
	}

	return $text;
}

function highlightCariKata($teks, $cari)
{
    preg_match_all('~\w+~', $cari, $m);
    return ($m ? preg_replace('/'.implode('|', $m[0]).'/i', '<b>$0</b>', $teks) : $teks);
}