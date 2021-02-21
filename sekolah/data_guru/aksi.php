<?php

session_start();
$npsn=$_SESSION['npsn'];
require_once '../../include/db_connect.php';

switch ($_GET['aksi'])
{
    case 'view_data':
        $output = array('data' => array());
        $sql = "SELECT * FROM tbl_guru  where npsn='$npsn' ORDER BY nama_guru ASC";
        $query = $connect->query($sql);

        $x = 1;
        while ($row = $query->fetch_assoc()) {  
           
            $action= "<a href='#' class='btn btn-info btn-sm ubah-data' data-toggle='modal'  data-id=".$row['id_guru']." data-original-title='Edit'> <i class='fa fa-edit'></i> </a>".' '."<a href='#' class='btn btn-primary btn-sm hapus-data' data-toggle='modal' data-id=".$row['id_guru']." data-original-title='Hapus'> <i class='fa fa-close'></i> </a>";
            $output['data'][] = array(
                $x,                     
                $action,
                $row['id_guru'],               
                $row['nama_guru'],               
                $row['nip'],               
                $row['tempat_lahir'],               
                tanggal_indo($row['tanggal_lahir']),               
                $row['jenis_kelamin'],               
                $row['pangkat'],               
                $row['gol'],               
                tanggal_indo($row['tmt_tugas']),               
                $row['pendidikan'],               
                $row['jabatan'],               
                $row['password'],            
            );

            $x++;
        }
       
        $connect->close();

        echo json_encode($output);
    break;

    case 'simpan':

        $tanggal_lahir=$_POST['tanggal_lahir'];
        $pecah   = explode("-", $tanggal_lahir);
        $no_urut = $pecah[0].$pecah[1].$pecah[2];
        $query = mysqli_query($connect, "SELECT max(id_guru) as max_id FROM tbl_guru WHERE id_guru LIKE '{$no_urut}%' ORDER BY id_guru DESC LIMIT 1");
        $data = mysqli_fetch_assoc($query);

        $getId = $data['max_id'];

        $no = substr($getId, -2, 2);
        $no = (int) $no;
        $no += 1;
        $newId = $no_urut . sprintf("%02s", $no);

        $id_guru=$newId;
        $nama_guru=$_POST['nama_guru'];
        $nip=$_POST['nip'];
        $tempat_lahir=$_POST['tempat_lahir'];
        $jenis_kelamin=$_POST['jenis_kelamin'];
        $pangkat=$_POST['pangkat'];
        $gol=$_POST['gol'];
        $tmt_tugas=$_POST['tmt_tugas'];
        $pendidikan=$_POST['pendidikan'];
        $jabatan=$_POST['jabatan'];
        $password=$_POST['password'];
       
         $sql = "INSERT INTO  tbl_guru (id_guru,nama_guru,nip,tempat_lahir,tanggal_lahir,jenis_kelamin,pangkat,gol,tmt_tugas,pendidikan,jabatan,password,npsn) VALUES ('$id_guru','$nama_guru','$nip','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$pangkat','$gol','$tmt_tugas','$pendidikan','$jabatan','$password','$npsn')";
        $query = $connect->query($sql);        
        $connect->close();

        echo json_encode($query);
    break;

    case 'edit':

            $id = $_POST['id_guru'];
            $nama_guru=$_POST['nama_guru'];
            $nip=$_POST['nip'];
            $tempat_lahir=$_POST['tempat_lahir'];
            $tanggal_lahir=$_POST['tanggal_lahir'];
            $jenis_kelamin=$_POST['jenis_kelamin'];
            $pangkat=$_POST['pangkat'];
            $gol=$_POST['gol'];
            $tmt_tugas=$_POST['tmt_tugas'];
            $pendidikan=$_POST['pendidikan'];
            $jabatan=$_POST['jabatan'];
            $password=$_POST['password'];

            $sql = "UPDATE tbl_guru SET nama_guru='$nama_guru',nip='$nip',tanggal_lahir='$tanggal_lahir',tempat_lahir='$tempat_lahir',jenis_kelamin='$jenis_kelamin',pangkat='$pangkat',gol='$gol',tmt_tugas='$tmt_tugas',pendidikan='$pendidikan',jabatan='$jabatan',password='$password',npsn='$npsn' WHERE id_guru = $id";
            $data = $connect->query($sql);            
            $connect->close();

            echo json_encode($data);
    break;

    case 'hapus':       
        $id_guru = $_POST['id'];

        $sql = "DELETE FROM tbl_guru WHERE id_guru = '$id_guru'";
        $data = $connect->query($sql);        
        $connect->close();

        echo json_encode($data);
    break;
}
?>