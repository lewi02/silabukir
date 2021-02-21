<?php
  require_once '../../include/db_connect.php';
 $id =$_POST['id'];
 $query=mysqli_query($connect, "SELECT * FROM tbl_dlaporan WHERE id_dlaporan='$id'") or die(mysqli_error($connect));
 $datpil=mysqli_fetch_array($query);
?>

<form id="formubahdata" method="post"> 
  <div class="modal-body">
    <div class="form-group">
      <label for="id_indikator_laporan">Uraian Indikator laporan </label>
      <input type="hidden" class="form-control" id="id_dlaporan" name="id_dlaporan" value="<?php echo $datpil['id_dlaporan'];?>" >
      <select class="form-control select2" id="id_subindikator_laporan_ubah" name="id_subindikator_laporan_ubah" required="">
        <option value="">~~ Pilih Indikator laporan ~~</option>
        <?php 
            $sql="select * from tbl_indikator_laporan left join tbl_subindikator_laporan on tbl_indikator_laporan.id_indikator_laporan=tbl_subindikator_laporan.id_indikator_laporan order By tbl_indikator_laporan.id_indikator_laporan ASC";


            $hasil=mysqli_query($connect,$sql);
            while ($data = mysqli_fetch_array($hasil)) {
            if($data['id_subindikator_laporan'] == $datpil['id_subindikator_laporan']){
        ?>
          <option value="<?php echo $data['id_subindikator_laporan'];?>" selected>(<?php echo $data['uraian_indikator_laporan'];?> ) - <?php echo $data['uraian_subindikator_laporan'];?> 
        <?php }else{ ?>
          <option value="<?php echo $data['id_subindikator_laporan'];?>">(<?php echo $data['uraian_indikator_laporan'];?> ) - <?php echo $data['uraian_subindikator_laporan'];?> 
        
        <?php 
          }
            } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="nama_guru">Isi Laporan laporan</label>
      <textarea class="form-control" id="isi_laporan_ubah" name="isi_laporan_ubah"  required=""><?php echo $datpil['isi_laporan'];?></textarea>
        
    </div>                
    
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
  <button  type="submit" class="btn btn-outline">Simpan</button>
</div>
</form>  