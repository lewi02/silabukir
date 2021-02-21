<?php
session_start();
require_once '../../include/db_connect.php';

switch ($_GET['aksi'])
{
    case 'view_data':

        $output = array('data' => array());
        $sql = "SELECT * FROM tbl_kinerja left join tbl_guru on tbl_kinerja.id_guru=tbl_guru.id_guru left join tbl_sekolah on tbl_guru.npsn=tbl_sekolah.npsn WHERE status='3' OR status='4' ORDER BY tgl_kirim DESC ";
        $query = $connect->query($sql);

        $x = 1;
        while ($row = $query->fetch_assoc()) {  
           
            $status=$row['status'];
           if($status==3){
                $label="<span class='label label-primary'>Belum Di Verifikasi</span>";
                $action= "<a href='verikasi_kinerja.php?id=".$row['id_kinerja']."' class='btn btn-info btn-sm' title='Verifikasi  kinerja'> <i class='fa fa-search-plus'></i> </a>";
            }else if($status==4){
                 $label="<span class='label label-info'>Diterima</span>";
                $action= "<a href='lihat_kinerja.php?id=".$row['id_kinerja']."' class='btn btn-info btn-sm' title='Isi Detail Laporan'> <i class='fa fa-search-plus'></i> </a>";
            
            }
            $output['data'][] = array(
                $x,                
                $action,
                $row['id_kinerja'],
                getBulan($row['bulan']),
                $row['tahun'],
                $row['tgl_kirim'],
                $row['nama_guru'],
                $row['nip'],
                $row['nama_sekolah'],
                $row['keterangan'],
                $row['penilai'],
                $label
            );

            $x++;
        }
       
        $connect->close();

        echo json_encode($output);
    break;
   
     case 'verifikasi':

            $id_kinerja            = $_POST['id_kinerjaver'];
            $status                 = $_POST['status'];
            $keterangan            = $_POST['keterangan'];
             $sql = "UPDATE tbl_kinerja SET  status='$status', keterangan='$keterangan' WHERE id_kinerja = '$id_kinerja'";
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