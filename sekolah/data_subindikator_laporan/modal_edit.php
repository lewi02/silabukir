<?php
require_once '../../include/db_connect.php';
 $id =$_POST['id'];
 $query=mysqli_query($connect, "SELECT * FROM tbl_subindikator_laporan WHERE id_subindikator_laporan='$id'") or die(mysqli_error($connect));
 $datpil=mysqli_fetch_array($query);
?>

<form id="formubahdata" method="post"> 
<div class="modal-body">
    
    <div class="form-group">
        <label for="uraian_subindikator_laporan">Uraian Sub Indikator Laporan</label>
        <input type="text" class="form-control" id="uraian_subindikator_laporan" name="uraian_subindikator_laporan" value="<?php echo $datpil['uraian_subindikator_laporan'];?>"  placeholder="Nama Sekolah" required>
         <input type="hidden" class="form-control" id="id_subindikator_laporan" name="id_subindikator_laporan" value="<?php echo $datpil['id_subindikator_laporan'];?>"  placeholder="id_subindikator_laporan" readonly>
      </div>
      <div class="form-group">
      <label for="npsn">Nama SubIndikator Laporan</label>
      <select class="form-control select2" name="id_indikator_laporan" >
        <option value="">~~ Pilih Nama Indikator Laporan ~~</option>
         <?php 
            $sql="select * from tbl_indikator_laporan";

            $hasil=mysqli_query($connect,$sql);
            while ($data = mysqli_fetch_array($hasil)) {
       
                $id_indikator_laporan=$datpil['id_indikator_laporan'];
                if($id_indikator_laporan==$data['id_indikator_laporan']){
                     echo "<option value='$data[id_indikator_laporan]' selected>$data[uraian_indikator_laporan]</option>";
                }else{
                     echo "<option value='$data[id_indikator_laporan]'>$data[uraian_indikator_laporan]</option>";
                 
                }
            } 
          ?>
        </select>
    </div>   
    
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
  <button  type="submit" class="btn btn-outline">Simpan</button>
</div>
</form>  