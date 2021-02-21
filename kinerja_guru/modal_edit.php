<?php
  require_once '../include/db_connect.php';
 $id =$_POST['id'];
 $query=mysqli_query($connect, "SELECT * FROM tbl_dkinerja WHERE id_dkinerja='$id'") or die(mysqli_error($connect));
 $datpil=mysqli_fetch_array($query);
?>

<form id="formubahdata" method="post"> 
  <div class="modal-body">
    <div class="form-group">
      <label for="id_indikator_kinerja">Uraian Indikator kinerja </label>
      <input type="hidden" class="form-control" id="id_dkinerja" name="id_dkinerja" value="<?php echo $datpil['id_dkinerja'];?>" >
      <select class="form-control select2" id="id_indikator_kinerja_ubah" name="id_indikator_kinerja_ubah" required="">
        <option value="">~~ Pilih Indikator Kinerja ~~</option>
        <?php 
            $sql="select * from tbl_indikator_kinerja";

            $hasil=mysqli_query($connect,$sql);
            while ($data = mysqli_fetch_array($hasil)) {
            if($data['id_indikator_kinerja'] == $datpil['id_indikator_kinerja']){
        ?>
          <option value="<?php echo $data['id_indikator_kinerja'];?>" selected><?php echo $data['uraian_indikator_kinerja'];?> 
        <?php }else{ ?>
          <option value="<?php echo $data['id_indikator_kinerja'];?>"><?php echo $data['uraian_indikator_kinerja'];?> 
        
        <?php 
          }
            } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="nama_guru">Isi Laporan Kinerja</label>
      <textarea class="form-control" id="isi_kinerja_ubah" name="isi_kinerja_ubah"  required=""><?php echo $datpil['isi_kinerja'];?></textarea>
        
    </div>                
    <div class="form-group">
          <label for="username">File Pendukung</label>
          <input type="file" name="fileupload_ubah" id="fileupload_ubah" class="form-control" placeholder="File Pendukung" >
      </div>       
    
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
  <button  type="submit" class="btn btn-outline">Simpan</button>
</div>
</form>  