<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_silabukir";

// create connection
$connect = new mysqli($servername, $username, $password, $dbname);

// check connection 
if($connect->connect_error) {
	die("Connection Failed : " . $connect->connect_error);
} else {
	// echo "Successfully Connected";
}

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
 
}
function acak($panjang)
{
    $karakter= '123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  		$pos = rand(0, strlen($karakter)-1);
  		$string .= $karakter{$pos};
    }
    return $string;
}
function tanggal_indo($tanggal)
{
  $bulan = array (1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );
  $split = explode('-', $tanggal);
  return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
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

function waktu_lalu($timestamp){ // membuat fungsi menghitung waktu
  $selisih = time() - strtotime($timestamp) ;
  $detik = $selisih ;
  $menit = round($selisih / 60 );
  $jam = round($selisih / 3600 );
  $hari = round($selisih / 86400 );
  $minggu = round($selisih / 604800 );
  $bulan = round($selisih / 2419200 );
  $tahun = round($selisih / 29030400 );
  if ($detik <= 60) {
    $waktu = $detik.' detik yang lalu';
  } else if ($menit <= 60) {
    $waktu = $menit.' menit yang lalu';
  } else if ($jam <= 24) {
    $waktu = $jam.' jam yang lalu';
  } else if ($hari <= 7) {
    $waktu = $hari.' hari yang lalu';
  } else if ($minggu <= 4) {
    $waktu = $minggu.' minggu yang lalu';
  } else if ($bulan <= 12) {
    $waktu = $bulan.' bulan yang lalu';
  } else {
    $waktu = $tahun.' tahun yang lalu';
  }
  return $waktu;
}