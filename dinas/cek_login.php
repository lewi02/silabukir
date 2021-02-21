<?php
session_start();
require_once '../include/db_connect.php';
switch ($_GET['aksi'])
{
    case 'cek_data':
        $username = $_POST['username'];

        $cek_kode = mysqli_query($connect,"select * from tbl_admin where username='$username'");
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
        $username = $_POST['username'];
        $password = $_POST['password'];

        $cek_kode = mysqli_query($connect,"select * from tbl_admin where username='$username' and password='$password'");
        $row = mysqli_fetch_row($cek_kode);
        if($row > 0){    
            $sql = "select * from tbl_admin where username='$username' and password='$password'";
            $query = $connect->query($sql);
            $result = $query->fetch_assoc();

            $_SESSION['username'] = $username;
            $_SESSION['id_admin'] = $result['id_admin'];
            $_SESSION['nama_lengkap'] = $result['nama_lengkap'];
            
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