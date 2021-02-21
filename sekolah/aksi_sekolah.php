<?php
session_start();
$npsn=$_SESSION['npsn'];
$nama_sekolah=$_SESSION['nama_sekolah'];
require_once '../include/db_connect.php';
switch ($_GET['aksi'])
{
   case 'simpan':

        $judul_pertanyaan=$_POST['judul_pertanyaan'];
        $uraian_pertanyaan=$_POST['uraian_pertanyaan'];
        $tanggal_kirim=date("Y-m-d H:i:s");
       
         $sql = "INSERT INTO  pertanyaan (judul_pertanyaan,uraian_pertanyaan,tanggal_kirim,pengirim) VALUES ('$judul_pertanyaan','$uraian_pertanyaan','$tanggal_kirim','$npsn')";
        $query = $connect->query($sql);        
        $connect->close();

        echo json_encode($query);
    break;
    case 'hapus':       
        $id_pertanyaan = $_POST['id'];

        $sql = "DELETE FROM pertanyaan WHERE id_pertanyaan = '$id_pertanyaan'";
        $data = $connect->query($sql);        
        $connect->close();

        echo json_encode($data);
    break;
}
?>