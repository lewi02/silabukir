 <table id="cekdata" class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama Indikator</th>
      <th>Ceklist</th>
      <th>Keterangan</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    require_once '../include/db_connect.php';
      $id_kinerja = $_POST['id_kinerja'];
      $x = 1;
      $data_kriterias = mysqli_query($connect,"SELECT * FROM tbl_indikator_kinerja");
      while($dss = mysqli_fetch_array($data_kriterias)){
      $id_indikator_kinerja =$dss['id_indikator_kinerja'];
      $query=mysqli_query($connect, "SELECT * FROM tbl_dkinerja WHERE id_indikator_kinerja='$id_indikator_kinerja' and id_kinerja='$id_kinerja'") or die(mysqli_error($connect));
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
      <td><?php echo $dss['uraian_indikator_kinerja'];?> </td>
      <td><?php echo $icon;?> </td>
      <td><?php echo $ket;?> </td>
    </tr>
  <?php }?>
  </tbody>
 
</table>