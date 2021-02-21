<?php
require_once '../include/db_connect.php';
 $id =$_POST['id'];
 $query=mysqli_query($connect, "SELECT * FROM pertanyaan WHERE id_pertanyaan='$id'") or die(mysqli_error($connect));
 $datpil=mysqli_fetch_array($query);
?>

<form id="formubahdata" method="post"> 
<div class="modal-body">
    <div class="form-group">
    	<label for="nama_guru">Judul Pertanyaan</label>
       	<?php echo $datpil['judul_pertanyaan'];?>
    </div>
    <div class="form-group">
    	<label for="nama_guru">Uraian</label>
       	<?php echo $datpil['uraian_pertanyaan'];?>
    </div>
    <div class="form-group">
    	<label for="nama_guru">Jawaban</label>
       	<?php echo $datpil['jawaban'];?>
    </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
</div>
</form>  