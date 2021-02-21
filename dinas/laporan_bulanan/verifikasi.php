<table class="table table-bordered">
    <tr>
      <th>Indikator Laporan</th>
      <th>Isi Laporan</th>
      
    </tr>
     <?php 
     require_once '../../include/db_connect.php';
      $id_laporan = $_POST['id_laporan'];
      $x = 1;
      $data_kriterias = mysqli_query($connect,"SELECT * FROM tbl_dlaporan 
        left join tbl_subindikator_laporan on tbl_dlaporan.id_subindikator_laporan=tbl_subindikator_laporan.id_subindikator_laporan  
        left join tbl_indikator_laporan on tbl_subindikator_laporan.id_indikator_laporan=tbl_indikator_laporan.id_indikator_laporan 
        WHERE id_laporan='$id_laporan' GROUP BY id_laporan");
        while($dss = mysqli_fetch_array($data_kriterias)){
      
    ?>
    <tr>
      <th colspan="4"><?php echo $dss['uraian_subindikator_laporan'];?></th>
      
    </tr>

    <?php 
      $id_indikator_laporan = $dss['id_indikator_laporan'];
      $x = 1;
      $data_kriteria = mysqli_query($connect,"SELECT * FROM tbl_dlaporan 
        left join tbl_subindikator_laporan on tbl_dlaporan.id_subindikator_laporan=tbl_subindikator_laporan.id_subindikator_laporan  
      
        WHERE id_laporan='$id_laporan' and id_indikator_laporan='$id_indikator_laporan'");
        while($ds = mysqli_fetch_array($data_kriteria)){
      
    ?>
    <tr>
      <td><?php echo $ds['uraian_subindikator_laporan'];?></td>
      <td><?php echo $ds['isi_laporan'];?> <?php echo $ds['satuan'];?> </td>
      
    </tr>
   <?php 
    }
    } ?>
  </table>