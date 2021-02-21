<?php
require_once '../../include/db_connect.php';
 $id =$_POST['id'];
 $query=mysqli_query($connect, "SELECT * FROM tbl_indikator_kinerja WHERE id_indikator_kinerja='$id'") or die(mysqli_error($connect));
 $datpil=mysqli_fetch_array($query);
?>

<form id="formubahdata" method="post"> 
<div class="modal-body">
    
    <div class="form-group">
        <label for="id_indikator_kinerja">id_indikator_kinerja</label>
       
    </div>
    <div class="form-group">
        <label for="uraian_indikator_kinerja">Uraian Indikator kinerja</label>
        <input type="text" class="form-control" id="uraian_indikator_kinerja" name="uraian_indikator_kinerja" value="<?php echo $datpil['uraian_indikator_kinerja'];?>"  placeholder="Nama Sekolah" required>
         <input type="hidden" class="form-control" id="id_indikator_kinerja" name="id_indikator_kinerja" value="<?php echo $datpil['id_indikator_kinerja'];?>"  placeholder="id_indikator_kinerja" readonly>
    </div>

    
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
  <button  type="submit" class="btn btn-outline">Simpan</button>
</div>
</form>  