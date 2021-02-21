<?php
session_start();
$id_guru=$_SESSION['id_guru'];
$nama_guru=$_SESSION['nama_guru'];
require_once '../include/db_connect.php';

switch ($_GET['aksi'])
{
    case 'view_data':

        $output = array('data' => array());
        $sql = "SELECT * FROM tbl_kinerja where id_guru='$id_guru' ORDER BY tgl_kirim DESC ";
        $query = $connect->query($sql);

        $x = 1;
        while ($row = $query->fetch_assoc()) {  
           
            $status=$row['status'];
            if($status==1){
                $label="<span class='label label-danger'>Draf</span>";
                $action= "<a href='isi_kinerja_guru.php?id=".$row['id_kinerja']."' class='btn btn-info btn-sm'  title='Edit'> <i class='fa fa-edit'></i> </a>".' '."<a href='#' class='btn btn-primary btn-sm ajukan-data' data-toggle='modal' data-id=".$row['id_kinerja']." data-original-title='Ajukan Laporan'> <i class='fa fa-random'></i> </a>".' '."<a href='#' class='btn btn-danger btn-sm hapus-data' data-toggle='modal' data-id=".$row['id_kinerja']." data-original-title='Hapus'> <i class='fa fa-trash-o'></i> </a>";
            }else if($status==2){
                $label="<span class='label label-primary'>Verifikasi Sekolah</span>";
                $action= "<a href='lihat_laporan.php?id=".$row['id_kinerja']."' class='btn btn-info btn-sm' title='Isi Detail Laporan'> <i class='fa fa-search-plus'></i> </a>";
            }else if($status==3){
                $label="<span class='label label-primary'>Verifikasi Dinas</span>";
                $action= "<a href='lihat_laporan.php?id=".$row['id_kinerja']."' class='btn btn-info btn-sm' title='Isi Detail Laporan'> <i class='fa fa-search-plus'></i> </a>";
            }else if($status==4){
                 $label="<span class='label label-info'>Diterima</span>";
                $action= "<a href='lihat_laporan.php?id=".$row['id_kinerja']."' class='btn btn-info btn-sm' title='Isi Detail Laporan'> <i class='fa fa-search-plus'></i> </a>";
            }else if($status==5){
               $label="<span class='label label-warning'>Di tolak</span>";
                $action= "<a href='isi_kinerja_guru.php?id=".$row['id_kinerja']."' class='btn btn-info btn-sm'  title='Edit'> <i class='fa fa-edit'></i> </a>".' '."<a href='#' class='btn btn-primary btn-sm ajukan-data' data-toggle='modal' data-id=".$row['id_kinerja']." data-original-title='Ajukan Laporan'> <i class='fa fa-random'></i> </a>".' '."<a href='#' class='btn btn-danger btn-sm hapus-data' data-toggle='modal' data-id=".$row['id_kinerja']." data-original-title='Hapus'> <i class='fa fa-trash-o'></i> </a>";
            }
            $output['data'][] = array(
                $x,                
                $action,
                $row['id_kinerja'],
                getBulan($row['bulan']),
                $row['tahun'],
                $row['tgl_kirim'],
                $row['keterangan'],
                $row['penilai'],
                $label
            );

            $x++;
        }
       
        $connect->close();

        echo json_encode($output);
    break;
     case 'view_dataprofil':

        $output = array('data' => array());
        $sql = "SELECT * FROM tbl_kinerja where id_guru='$id_guru' ORDER BY tgl_kirim DESC ";
        $query = $connect->query($sql);

        $x = 1;
        while ($row = $query->fetch_assoc()) {  
           
            $status=$row['status'];
            if($status==1){
                $label="<span class='badge badge-info'>Draf</span>";
               
            }else if($status==2){
                $label="<span class='badge badge-danger'>Verifikasi Sekolah</span>";
                
            }else if($status==3){
                $label="<span class='badge badge-danger'>Verifikasi Dinas</span>";
               
            }else if($status==4){
                $label="<span class='badge badge-success'>Diterima</span>";
                
            }else if($status==4){
                $label="<span class='badge badge-warning'>Ditolak</span>";
               
            }
            $output['data'][] = array(
                $x,    
                $row['id_kinerja'],
                getBulan($row['bulan']),
                $row['tahun'],
                $row['tgl_kirim'],
                $row['keterangan'],
                $row['penilai'],
                $label
            );

            $x++;
        }
       
        $connect->close();

        echo json_encode($output);
    break;

    case 'simpankinerja':

        $bulan           = $_POST['bulan'];
        $tahun           = $_POST['tahun'];
        $status          = "1";
        $tgl_kirim       = date("Y-m-d H:i:s");       
        $id_kinerja      =  $id_guru.$tahun.$bulan;
           
        $sql = "INSERT INTO  tbl_kinerja (id_kinerja,bulan,tahun,tgl_kirim,id_guru) VALUES ('$id_kinerja','$bulan','$tahun','$tgl_kirim','$id_guru')";
        $query = $connect->query($sql);        
        $connect->close();

        echo json_encode($query);

    break;

    case 'simpan':

        $temp                   = "../file_kinerja/";
        $id_kinerja             = $_POST['id_kinerja'];
        $id_indikator_kinerja   = $_POST['id_indikator_kinerja'];
        $isi_kinerja            = $_POST['isi_kinerja'];
        
        $fileupload      = $_FILES['fileupload']['tmp_name'];
        $ImageName       = $_FILES['fileupload']['name'];
        $ImageType       = $_FILES['fileupload']['type'];

           
        if (!empty($fileupload)){
            $acak           = rand(11111111, 99999999);
            $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt       = str_replace('.','',$ImageExt); // Extension
            $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName   = str_replace(' ', '', $acak.'.'.$ImageExt);
             
            move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp.$NewImageName); 
         
            $sql = "INSERT INTO tbl_dkinerja(id_kinerja,id_indikator_kinerja,isi_kinerja,file_pendukung)
                                 VALUES ('$id_kinerja','$id_indikator_kinerja','$isi_kinerja','$NewImageName')";
            $query = $connect->query($sql);        
            $connect->close();
            echo "Data Berhasil Disimpan";
        } else {
            echo "Data Gagal Disimpan";
        }
        echo json_encode($query);

    break;

     case 'edit':

            $temp                   = "../file_kinerja/";
            $id_dkinerja            = $_POST['id_dkinerja'];
            $id_indikator_kinerja   = $_POST['id_indikator_kinerja_ubah'];
            $isi_kinerja            = $_POST['isi_kinerja_ubah'];
        
            $fileupload             = $_FILES['fileupload_ubah']['tmp_name'];
            $ImageName              = $_FILES['fileupload_ubah']['name'];
            $ImageType              = $_FILES['fileupload_ubah']['type'];

               
            if (!empty($fileupload)){

                $query=mysqli_query($connect, "SELECT * FROM tbl_dkinerja WHERE id_dkinerja='$id_dkinerja'") or die(mysqli_error($connect));

                $datpil=mysqli_fetch_array($query);
                $target = "../file_kinerja/".$datpil['file_pendukung'];
                $proses = unlink($target);

                $acak           = rand(11111111, 99999999);
                $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt       = str_replace('.','',$ImageExt); // Extension
                $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $NewImageName   = str_replace(' ', '', $acak.'.'.$ImageExt);
                 
                move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp.$NewImageName); 
                
                $sql = "UPDATE tbl_dkinerja SET  id_indikator_kinerja='$id_indikator_kinerja', isi_kinerja='$isi_kinerja', file_pendukung='$NewImageName' WHERE id_dkinerja = '$id_dkinerja'";
                $query = $connect->query($sql);        
                $connect->close();
            } else {
                 $sql = "UPDATE tbl_dkinerja SET  id_indikator_kinerja='$id_indikator_kinerja', isi_kinerja='$isi_kinerja' WHERE id_dkinerja = '$id_dkinerja'";
                $query = $connect->query($sql);        
                $connect->close();
            }
            echo json_encode($query);
            
    break;
    case 'hapus':       
        $id_dkinerja = $_POST['id'];
        $query=mysqli_query($connect, "SELECT * FROM tbl_dkinerja WHERE id_dkinerja='$id_dkinerja'") or die(mysqli_error($connect));

        $datpil=mysqli_fetch_array($query);
        $target = "../file_kinerja/".$datpil['file_pendukung'];
        $proses = unlink($target);
        $sql = "DELETE FROM tbl_dkinerja WHERE id_dkinerja = '$id_dkinerja'";
        
        $data = $connect->query($sql);        
        $connect->close();

        echo json_encode($data);
    break;
    case 'hapuskinerja':       
        $id_kinerja = $_POST['id'];
        $sql = "DELETE FROM tbl_kinerja WHERE id_kinerja = '$id_kinerja'";
        
        $data = $connect->query($sql);        
        $connect->close();

        echo json_encode($data);
    break;
    case 'ajukan':       
        $id_kinerja = $_POST['id'];
        $status = "2";
        $sql = "UPDATE tbl_kinerja SET  status='$status' WHERE id_kinerja = '$id_kinerja'";
               
        $data = $connect->query($sql);        
        $connect->close();

        echo json_encode($data);
    break;
}
?>