<?php
session_start();
$id_guru=$_SESSION['id_guru'];
$nama_guru=$_SESSION['nama_guru'];
require_once 'include/db_connect.php';
switch ($_GET['aksi'])
{
   case 'simpan':

        $judul_pertanyaan=$_POST['judul_pertanyaan'];
        $uraian_pertanyaan=$_POST['uraian_pertanyaan'];
        $tanggal_kirim=date("Y-m-d H:i:s");
       
         $sql = "INSERT INTO  pertanyaan (judul_pertanyaan,uraian_pertanyaan,tanggal_kirim,pengirim) VALUES ('$judul_pertanyaan','$uraian_pertanyaan','$tanggal_kirim','$nama_guru')";
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