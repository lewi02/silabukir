<?php
require_once '../../include/db_connect.php';

switch ($_GET['aksi'])
{
    case 'view_data':

        $output = array('data' => array());
        $sql = "SELECT * FROM tbl_indikator_laporan ";
        $query = $connect->query($sql);

        $x = 1;
        while ($row = $query->fetch_assoc()) {  
           
            $action= "<a href='#' class='btn btn-info btn-sm ubah-data' data-toggle='modal'  data-id=".$row['id_indikator_laporan']." data-original-title='Edit'> <i class='fa fa-edit'></i> </a>".' '."<a href='#' class='btn btn-primary btn-sm hapus-data' data-toggle='modal' data-id=".$row['id_indikator_laporan']." data-original-title='Hapus'> <i class='fa fa-close'></i> </a>";
            $output['data'][] = array(
                $x,
                $row['uraian_indikator_laporan'],
                $action
            );

            $x++;
        }
       
        $connect->close();

        echo json_encode($output);
    break;

    case 'simpan':

        $uraian_indikator_laporan=$_POST['uraian_indikator_laporan'];
       
        $sql = "INSERT INTO  tbl_indikator_laporan (uraian_indikator_laporan) VALUES ('$uraian_indikator_laporan')";
        $query = $connect->query($sql);        
        $connect->close();

        echo json_encode($query);
    break;

    case 'edit':

            $id = $_POST['id_indikator_laporan'];
            $uraian_indikator_laporan=$_POST['uraian_indikator_laporan'];
           

            $sql = "UPDATE tbl_indikator_laporan SET uraian_indikator_laporan='$uraian_indikator_laporan' WHERE id_indikator_laporan = $id";
            $data = $connect->query($sql);            
            $connect->close();

            echo json_encode($data);
    break;

    case 'hapus':       
        $id_indikator_laporan = $_POST['id'];

        $sql = "DELETE FROM tbl_indikator_laporan WHERE id_indikator_laporan = '$id_indikator_laporan'";
        $data = $connect->query($sql);        
        $connect->close();

        echo json_encode($data);
    break;
}
?>