 <table id="isidata" class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama Indikator</th>
      <th>Nama Sub Indikator</th>
      <th>Isi Laporan</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    require_once '../../include/db_connect.php';
      $id_laporan = $_POST['id_laporan'];
      $x = 1;
      $data_kriterias = mysqli_query($connect,"SELECT * FROM tbl_dlaporan left join tbl_subindikator_laporan on tbl_dlaporan.id_subindikator_laporan=tbl_subindikator_laporan.id_subindikator_laporan  left join tbl_indikator_laporan on tbl_subindikator_laporan.id_indikator_laporan=tbl_indikator_laporan.id_indikator_laporan WHERE id_laporan='$id_laporan'");
      while($dss = mysqli_fetch_array($data_kriterias)){
      
    ?>
    <tr>
      <td><?php echo $x++;?> </td>
      <td><?php echo $dss['uraian_indikator_laporan'];?> </td>
      <td><?php echo $dss['uraian_subindikator_laporan'];?> </td>
      <td><?php echo $dss['isi_laporan'];?> <?php echo $dss['satuan'];?>  </td>
      
    </tr>
  <?php }?>
  </tbody>
 
</table>