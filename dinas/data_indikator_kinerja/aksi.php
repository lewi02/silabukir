<?php
require_once '../../include/db_connect.php';

switch ($_GET['aksi'])
{
    case 'view_data':

        $output = array('data' => array());
        $sql = "SELECT * FROM tbl_indikator_kinerja ";
        $query = $connect->query($sql);

        $x = 1;
        while ($row = $query->fetch_assoc()) {  
           
            $action= "<a href='#' class='btn btn-info btn-sm ubah-data' data-toggle='modal'  data-id=".$row['id_indikator_kinerja']." data-original-title='Edit'> <i class='fa fa-edit'></i> </a>".' '."<a href='#' class='btn btn-primary btn-sm hapus-data' data-toggle='modal' data-id=".$row['id_indikator_kinerja']." data-original-title='Hapus'> <i class='fa fa-close'></i> </a>";
            $output['data'][] = array(
                $x,
                $row['uraian_indikator_kinerja'],
                $action
            );

            $x++;
        }
       
        $connect->close();

        echo json_encode($output);
    break;

    case 'simpan':

        $uraian_indikator_kinerja=$_POST['uraian_indikator_kinerja'];
       
        $sql = "INSERT INTO  tbl_indikator_kinerja (uraian_indikator_kinerja) VALUES ('$uraian_indikator_kinerja')";
        $query = $connect->query($sql);        
        $connect->close();

        echo json_encode($query);
    break;

    case 'edit':

            $id = $_POST['id_indikator_kinerja'];
            $uraian_indikator_kinerja=$_POST['uraian_indikator_kinerja'];
           

            $sql = "UPDATE tbl_indikator_kinerja SET uraian_indikator_kinerja='$uraian_indikator_kinerja' WHERE id_indikator_kinerja = $id";
            $data = $connect->query($sql);            
            $connect->close();

            echo json_encode($data);
    break;

    case 'hapus':       
        $id_indikator_kinerja = $_POST['id'];

        $sql = "DELETE FROM tbl_indikator_kinerja WHERE id_indikator_kinerja = '$id_indikator_kinerja'";
        $data = $connect->query($sql);        
        $connect->close();

        echo json_encode($data);
    break;
}
?>