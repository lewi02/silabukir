<?php
require_once '../../include/db_connect.php';

switch ($_GET['aksi'])
{
    case 'view_data':

        $output = array('data' => array());
        $sql = "SELECT * FROM tbl_subindikator_laporan left join tbl_indikator_laporan on tbl_subindikator_laporan.id_indikator_laporan=tbl_indikator_laporan.id_indikator_laporan";
        $query = $connect->query($sql);

        $x = 1;
        while ($row = $query->fetch_assoc()) {  
           
            $action= "<a href='#' class='btn btn-info btn-sm ubah-data' data-toggle='modal'  data-id=".$row['id_subindikator_laporan']." data-original-title='Edit'> <i class='fa fa-edit'></i> </a>".' '."<a href='#' class='btn btn-primary btn-sm hapus-data' data-toggle='modal' data-id=".$row['id_subindikator_laporan']." data-original-title='Hapus'> <i class='fa fa-close'></i> </a>";
            $output['data'][] = array(
                $x,
                $row['uraian_subindikator_laporan'],
                $row['satuan'],
                $row['uraian_indikator_laporan'],
                $action
            );

            $x++;
        }
       
        $connect->close();

        echo json_encode($output);
    break;

    case 'simpan':

        $id_indikator_laporan=$_POST['id_indikator_laporan'];
        $satuan=$_POST['satuan'];
        $uraian_subindikator_laporan=$_POST['uraian_subindikator_laporan'];
       
        $sql = "INSERT INTO  tbl_subindikator_laporan (id_indikator_laporan,satuan,uraian_subindikator_laporan) VALUES ('$id_indikator_laporan','$satuan','$uraian_subindikator_laporan')";
        $query = $connect->query($sql);        
        $connect->close();

        echo json_encode($query);
    break;

    case 'edit':

            $id = $_POST['id_subindikator_laporan'];
            $uraian_subindikator_laporan=$_POST['uraian_subindikator_laporan'];
            $satuan=$_POST['satuan'];
            $id_indikator_laporan=$_POST['id_indikator_laporan'];
           

            $sql = "UPDATE tbl_subindikator_laporan SET id_indikator_laporan='$id_indikator_laporan', satuan='$satuan', uraian_subindikator_laporan='$uraian_subindikator_laporan' WHERE id_subindikator_laporan = $id";
            $data = $connect->query($sql);            
            $connect->close();

            echo json_encode($data);
    break;

    case 'hapus':       
        $id_subindikator_laporan = $_POST['id'];

        $sql = "DELETE FROM tbl_subindikator_laporan WHERE id_subindikator_laporan = '$id_subindikator_laporan'";
        $data = $connect->query($sql);        
        $connect->close();

        echo json_encode($data);
    break;
}
?>