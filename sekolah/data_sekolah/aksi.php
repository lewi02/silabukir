<?php
session_start();
require_once '../../include/db_connect.php';

switch ($_GET['aksi'])
{
    case 'view_data':
        $npsn=$_SESSION['npsn'];
        $output = array('data' => array());
        $sql = "SELECT * FROM tbl_sekolah where npsn='$npsn' ";
        $query = $connect->query($sql);

        $x = 1;
        while ($row = $query->fetch_assoc()) {  
           
            $action= "<a href='#' class='btn btn-info btn-sm ubah-data' data-toggle='modal'  data-id=".$row['npsn']." data-original-title='Edit'> <i class='fa fa-edit'></i> </a>";
            $output['data'][] = array(
                $x,
                $row['npsn'],               
                $row['nama_sekolah'],               
                $row['alamat_sekolah'],                  
                $row['telp_sekolah'],               
                $row['desa'],            
                $row['kecamatan'],               
                $row['jenjang_sekolah'],               
                $row['nama_kepala_sekolah'],               
                $row['password_sekolah'],     
                $action
            );

            $x++;
        }
       
        $connect->close();

        echo json_encode($output);
    break;

   
    case 'edit':

            $id = $_POST['npsn'];
            $nama_sekolah=$_POST['nama_sekolah'];
            $alamat_sekolah=$_POST['alamat_sekolah'];
            $desa=$_POST['desa'];
            $telp_sekolah=$_POST['telp_sekolah'];
            $kecamatan=$_POST['kecamatan'];
            $jenjang_sekolah=$_POST['jenjang_sekolah'];
            $nama_kepala_sekolah=$_POST['nama_kepala_sekolah'];
            $password_sekolah=$_POST['password_sekolah'];

            $sql = "UPDATE tbl_sekolah SET nama_sekolah='$nama_sekolah',alamat_sekolah='$alamat_sekolah',telp_sekolah='$telp_sekolah',desa='$desa',kecamatan='$kecamatan',jenjang_sekolah='$jenjang_sekolah',nama_kepala_sekolah='$nama_kepala_sekolah',password_sekolah='$password_sekolah' WHERE npsn = $id";
            $data = $connect->query($sql);            
            $connect->close();

            echo json_encode($data);
    break;

}
?>