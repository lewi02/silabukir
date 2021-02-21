<?php
session_start();
$npsn=$_SESSION['npsn'];
$nama_sekolah=$_SESSION['nama_sekolah'];
require_once '../../include/db_connect.php';

switch ($_GET['aksi'])
{
    case 'view_data':

        $output = array('data' => array());
        $sql = "SELECT * FROM tbl_laporan where npsn='$npsn' ORDER BY tgl_kirim DESC ";
        $query = $connect->query($sql);

        $x = 1;
        while ($row = $query->fetch_assoc()) {  
           
            $status=$row['status'];
            if($status==1){
                $label="<span class='label label-danger'>Draf</span>";
                $action= "<a href='isi_laporan_bulanan.php?id=".$row['id_laporan']."' class='btn btn-info btn-sm'  title='Edit'> <i class='fa fa-edit'></i> </a>".' '."<a href='#' class='btn btn-primary btn-sm ajukan-data' data-toggle='modal' data-id=".$row['id_laporan']." data-original-title='Ajukan Laporan'> <i class='fa fa-random'></i> </a>".' '."<a href='#' class='btn btn-danger btn-sm hapus-data' data-toggle='modal' data-id=".$row['id_laporan']." data-original-title='Hapus'> <i class='fa fa-trash-o'></i> </a>";
            }else if($status==2){
                $label="<span class='label label-primary'>Verifikasi Dinas</span>";
                $action= "<a href='lihat_laporan.php?id=".$row['id_laporan']."' class='btn btn-info btn-sm' title='Isi Detail Laporan'> <i class='fa fa-search-plus'></i> </a>";
            }else if($status==3){
                 $label="<span class='label label-info'>Diterima</span>";
                $action= "<a href='lihat_laporan.php?id=".$row['id_laporan']."' class='btn btn-info btn-sm' title='Isi Detail Laporan'> <i class='fa fa-search-plus'></i> </a>";
            }else if($status==4){
               $label="<span class='label label-warning'>Di tolak</span>";
                $action= "<a href='isi_laporan_bulanan.php?id=".$row['id_laporan']."' class='btn btn-info btn-sm'  title='Edit'> <i class='fa fa-edit'></i> </a>".' '."<a href='#' class='btn btn-primary btn-sm ajukan-data' data-toggle='modal' data-id=".$row['id_laporan']." data-original-title='Ajukan Laporan'> <i class='fa fa-random'></i> </a>".' '."<a href='#' class='btn btn-danger btn-sm hapus-data' data-toggle='modal' data-id=".$row['id_laporan']." data-original-title='Hapus'> <i class='fa fa-trash-o'></i> </a>";
            }
            $output['data'][] = array(
                $x,                
                $action,
                $row['id_laporan'],
                getBulan($row['bulan']),
                $row['tahun'],
                $row['tgl_kirim'],
                $row['keterangan'],
                $row['pemeriksa'],
                $label
            );

            $x++;
        }
       
        $connect->close();

        echo json_encode($output);
    break;
     case 'view_dataprofil':

        $output = array('data' => array());
        $sql = "SELECT * FROM tbl_laporan where npsn='$npsn' ORDER BY tgl_kirim DESC ";
        $query = $connect->query($sql);

        $x = 1;
        while ($row = $query->fetch_assoc()) {  
           
            $status=$row['status'];
            if($status==1){
                $label="<span class='label label-info'>Draf</span>";
               
            }else if($status==2){
                $label="<span class='label label-danger'>Verifikasi Dinas</span>";
                
            }else if($status==3){
                $label="<span class='label label-success'>Diterima</span>";
               
            }else if($status==4){
               
                $label="<span class='label label-warning'>Ditolak</span>";
               
            }
            $output['data'][] = array(
                $x,    
                $row['id_laporan'],
                getBulan($row['bulan']),
                $row['tahun'],
                $row['tgl_kirim'],
                $row['keterangan'],
                $row['pemeriksa'],
                $label
            );

            $x++;
        }
       
        $connect->close();

        echo json_encode($output);
    break;

    case 'simpanlaporan':

        $bulan           = $_POST['bulan'];
        $tahun           = $_POST['tahun'];
        $status          = "1";
        $tgl_kirim       = date("Y-m-d H:i:s");       
        $id_laporan      =  $npsn.$tahun.$bulan;
           
        $sql = "INSERT INTO  tbl_laporan (id_laporan,bulan,tahun,tgl_kirim,npsn) VALUES ('$id_laporan','$bulan','$tahun','$tgl_kirim','$npsn')";
        $query = $connect->query($sql);        
        $connect->close();

        echo json_encode($query);

    break;

    case 'simpan':

        $id_laporan   = $_POST['id_laporanadd'];
        $id_subindikator_laporan   = $_POST['id_subindikator_laporan'];
        $isi_laporan            = $_POST['isi_laporan'];
           
        $sql = "INSERT INTO tbl_dlaporan(id_laporan,id_subindikator_laporan,isi_laporan)
                                 VALUES ('$id_laporan','$id_subindikator_laporan','$isi_laporan')";
        $query = $connect->query($sql);        
        $connect->close();

        echo json_encode($query);
       
    break;

     case 'edit':

            $id_dlaporan            = $_POST['id_dlaporan'];
            $id_subindikator_laporan   = $_POST['id_subindikator_laporan_ubah'];
            $isi_laporan            = $_POST['isi_laporan_ubah'];
             $sql = "UPDATE tbl_dlaporan SET  id_subindikator_laporan='$id_subindikator_laporan', isi_laporan='$isi_laporan' WHERE id_dlaporan = '$id_dlaporan'";
            $query = $connect->query($sql);        
            $connect->close();
            echo json_encode($query);
            
    break;
    case 'hapus':       
        $id_dlaporan = $_POST['id'];
        $query=mysqli_query($connect, "SELECT * FROM tbl_dlaporan WHERE id_dlaporan='$id_dlaporan'") or die(mysqli_error($connect));

        $datpil=mysqli_fetch_array($query);
        $target = "../file_laporan/".$datpil['file_pendukung'];
        $proses = unlink($target);
        $sql = "DELETE FROM tbl_dlaporan WHERE id_dlaporan = '$id_dlaporan'";
        
        $data = $connect->query($sql);        
        $connect->close();

        echo json_encode($data);
    break;
    case 'hapuslaporan':       
        $id_laporan = $_POST['id'];
        $sql = "DELETE FROM tbl_laporan WHERE id_laporan = '$id_laporan'";
        
        $data = $connect->query($sql);        
        $connect->close();

        echo json_encode($data);
    break;
    case 'ajukan':       
        $id_laporan = $_POST['id'];
        $status = "2";
        $sql = "UPDATE tbl_laporan SET  status='$status' WHERE id_laporan = '$id_laporan'";
               
        $data = $connect->query($sql);        
        $connect->close();

        echo json_encode($data);
    break;
}
?>