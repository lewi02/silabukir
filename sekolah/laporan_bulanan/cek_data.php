 <table id="cekdata" class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama Indikator</th>
      <th>Nama Sub Indikator</th>
      <th>Ceklist</th>
      <th>Keterangan</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      require_once '../../include/db_connect.php';
      $id_laporan = $_POST['id_laporan'];
      $x = 1;
      $data_kriterias = mysqli_query($connect,"SELECT * FROM tbl_indikator_laporan left join tbl_subindikator_laporan on tbl_indikator_laporan.id_indikator_laporan=tbl_subindikator_laporan.id_indikator_laporan ORDER BY tbl_indikator_laporan.id_indikator_laporan ASC");
      while($dss = mysqli_fetch_array($data_kriterias)){
      $id_subindikator_laporan =$dss['id_subindikator_laporan'];
      $query=mysqli_query($connect, "SELECT * FROM tbl_dlaporan WHERE id_subindikator_laporan='$id_subindikator_laporan' and id_laporan='$id_laporan'") or die(mysqli_error($connect));
      $datpil=mysqli_fetch_array($query);  


        if($datpil > 0){  
          $icon ="<button class='btn btn-info'  title='Sukses'> <i class='fa fa-check-square-o'></i> </button>";
          $ket="Sudah di isi";
        }else{
          $icon ="<button class='btn btn-danger'  title='Sukses'> <i class='fa fa-times'></i> </button>";
           $ket="Belum di isi";
        }  
    ?>
    <tr>
      <td><?php echo $x++;?> </td>
      <td><?php echo $dss['uraian_indikator_laporan'];?> </td>
      <td><?php echo $dss['uraian_subindikator_laporan'];?> </td>
      <td><?php echo $icon;?> </td>
      <td><?php echo $ket;?> </td>
    </tr>
  <?php }?>

  </tbody>
 
</table>