<?php
session_start();
require_once 'include/db_connect.php';
switch ($_GET['aksi'])
{
    case 'cek_data':
        $id_guru = $_POST['id_guru'];

        $cek_kode = mysqli_query($connect,"select * from tbl_guru where id_guru='$id_guru'");
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
        $id_guru = $_POST['id_guru'];
        $password = $_POST['password'];

        $cek_kode = mysqli_query($connect,"select * from tbl_guru where id_guru='$id_guru' and password='$password'");
        $row = mysqli_fetch_row($cek_kode);
        if($row > 0){    
            $sql = "select * from tbl_guru where id_guru='$id_guru' and password='$password'";
            $query = $connect->query($sql);
            $result = $query->fetch_assoc();

            $_SESSION['id_guru'] = $id_guru;
            $_SESSION['nama_guru'] = $result['nama_guru'];
            $_SESSION['jabatan'] = $result['jabatan'];
            $_SESSION['tmt_tugas'] = $result['tmt_tugas'];
            
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