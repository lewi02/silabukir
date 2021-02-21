 <table id="isidata" class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama Indikator</th>
      <th>Isi Laporan</th>
      <th>File Pendukung</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    require_once '../include/db_connect.php';
      $id_kinerja = $_POST['id_kinerja'];
      $x = 1;
      $data_kriterias = mysqli_query($connect,"SELECT * FROM tbl_dkinerja left join tbl_indikator_kinerja on tbl_dkinerja.id_indikator_kinerja=tbl_indikator_kinerja.id_indikator_kinerja  WHERE id_kinerja='$id_kinerja'");
      while($dss = mysqli_fetch_array($data_kriterias)){
      
    ?>
    <tr>
      <td><?php echo $x++;?> </td>
      <td><?php echo $dss['uraian_indikator_kinerja'];?> </td>
      <td><?php echo $dss['isi_kinerja'];?> </td>
      <td><a href="file_kinerja/<?php echo $dss['file_pendukung'];?>" target="_blank"><?php echo $dss['file_pendukung'];?></a></td>
      <td>
        <?php echo
        "<a href='#' class='btn btn-info btn-sm ubah-data' data-toggle='modal'  data-id=".$dss['id_dkinerja']." data-original-title='Edit'> <i class='fa fa-edit'></i> </a>".' '."<a href='#' class='btn btn-primary btn-sm hapus-data' data-toggle='modal' data-id=".$dss['id_dkinerja']." data-original-title='Hapus'> <i class='fa fa-close'></i> </a>";
        ?>
      </td>
    </tr>
  <?php }?>
  </tbody>
 
</table>