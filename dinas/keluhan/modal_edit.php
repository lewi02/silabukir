<?php
require_once '../../include/db_connect.php';
 $id =$_POST['id'];
 $query=mysqli_query($connect, "SELECT * FROM pertanyaan WHERE id_pertanyaan='$id'") or die(mysqli_error($connect));
 $datpil=mysqli_fetch_array($query);
?>

<form id="formubahdata" method="post"> 
<div class="modal-body">
    <div class="form-group">
      <label for="id_guru">Judul Pertanyaan</label>
      <input type="hidden" class="form-control" id="id_pertanyaan" name="id_pertanyaan" value="<?php echo $datpil['id_pertanyaan'];?>"  placeholder="Kode Guru" readonly="">
      <input type="text" class="form-control" id="judul_pertanyaan" name="judul_pertanyaan" value="<?php echo $datpil['judul_pertanyaan'];?>"  placeholder="Nama Guru" required>
    </div>
    <div class="form-group">
      <label for="nama_guru">Pertanyaan</label>
      <textarea class="form-control" id="uraian_pertanyaan" name="uraian_pertanyaan"><?php echo $datpil['uraian_pertanyaan'];?></textarea>
     
    </div>
     <div class="form-group">
      <label for="nama_guru">Jawaban</label>
      <textarea class="form-control" id="jawaban" name="jawaban"><?php echo $datpil['jawaban'];?></textarea>
    </div>

    
    </div>   
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
  <button  type="submit" class="btn btn-outline">Simpan</button>
</div>
</form>  