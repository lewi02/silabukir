<?php
session_start();
require_once '../include/db_connect.php';
switch ($_GET['aksi'])
{
    case 'cek_data':
        $npsn = $_POST['npsn'];

        $cek_kode = mysqli_query($connect,"select * from tbl_sekolah where npsn='$npsn'");
        $row = mysqli_fetch_row($cek_kode);
        if($row > 0){    
            echo json_encode(array(
                'status' => 0
            ));
        }else{
            echo json_encode(array(
                'status' => 1
            ));
        }
    break;
    case 'cek_password':
        $npsn = $_POST['npsn'];
        $password_sekolah = $_POST['password'];

        $cek_kode = mysqli_query($connect,"select * from tbl_sekolah where npsn='$npsn' and password_sekolah='$password_sekolah'");
        $row = mysqli_fetch_row($cek_kode);
        if($row > 0){    
            $sql = "select * from tbl_sekolah where npsn='$npsn' and password_sekolah='$password_sekolah'";
            $query = $connect->query($sql);
            $result = $query->fetch_assoc();

            $_SESSION['npsn'] = $npsn;
            $_SESSION['nama_sekolah'] = $result['nama_sekolah'];
            
            echo json_encode(array(
                'status' => 0
            ));
        }else{
            echo json_encode(array(
                'status' => 1
            ));
        }
    break;    
    
    case 'logout':   
    session_start();

    // menghapus semua session
    session_destroy();

    // mengalihkan halaman ke halaman login
    header("location:login.php");
    break;
}
?>