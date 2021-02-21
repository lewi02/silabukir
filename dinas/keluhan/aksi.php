<?php
require_once '../../include/db_connect.php';

switch ($_GET['aksi'])
{
    case 'view_data':

        $output = array('data' => array());
        $sql = "SELECT * FROM  pertanyaan ORDER BY tanggal_kirim DESC";
        $query = $connect->query($sql);

        $x = 1;
        while ($row = $query->fetch_assoc()) {  
           
            $action= "<a href='#' class='btn btn-info btn-sm ubah-data' data-toggle='modal'  data-id=".$row['id_pertanyaan']." data-original-title='Edit'> <i class='fa fa-edit'></i> </a>".' '."<a href='#' class='btn btn-primary btn-sm hapus-data' data-toggle='modal' data-id=".$row['id_pertanyaan']." data-original-title='Hapus'> <i class='fa fa-close'></i> </a>";
            $output['data'][] = array(
                $x,                     
                $row['judul_pertanyaan'],               
                $row['uraian_pertanyaan'],               
                $row['jawaban'],                
                tanggal_indo($row['tanggal_kirim']),               
                $row['pengirim'],
                 $action
            );

            $x++;
        }
       
        $connect->close();

        echo json_encode($output);
    break;

    case 'edit':

            $id = $_POST['id_pertanyaan'];
            $jawaban=$_POST['jawaban'];
           
            $sql = "UPDATE pertanyaan SET jawaban='$jawaban' WHERE id_pertanyaan = $id";
            $data = $connect->query($sql);            
            $connect->close();

            echo json_encode($data);
    break;

    case 'hapus':       
        $id_pertanyaan = $_POST['id'];

        $sql = "DELETE FROM pertanyaan WHERE id_pertanyaan = '$id_pertanyaan'";
        $data = $connect->query($sql);        
        $connect->close();

        echo json_encode($data);
    break;
}
?>