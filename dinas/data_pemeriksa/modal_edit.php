<?php
require_once '../../include/db_connect.php';
 $id =$_POST['id'];
 $query=mysqli_query($connect, "SELECT * FROM tbl_pemeriksa WHERE id_pemeriksa='$id'") or die(mysqli_error($connect));
 $datpil=mysqli_fetch_array($query);
?>

<form id="formubahdata" method="post"> 
<div class="modal-body">
    
    <div class="form-group">
      <label for="nama_pemeriksa">Nama Pemeriksa</label>
      <input type="text" class="form-control" id="nama_pemeriksa" name="nama_pemeriksa" value="<?php echo $datpil['nama_pemeriksa'];?>"  placeholder="Nama Pemeriksa" required>
      <input type="hidden" class="form-control" id="id_pemeriksa" name="id_pemeriksa" value="<?php echo $datpil['id_pemeriksa'];?>" >
    </div>
    <div class="form-group">
      <label for="nip_pemeriksa">NIP Pemeriksa</label>
      <input type="text" class="form-control" id="nip_pemeriksa" name="nip_pemeriksa" value="<?php echo $datpil['nip_pemeriksa'];?>"  placeholder="NIP Pemeriksa" required>
    </div>
    <div class="form-group">
      <label for="pangkat_pemeriksa">Pangkat</label>
      <input type="text" class="form-control" id="pangkat_pemeriksa" name="pangkat_pemeriksa" value="<?php echo $datpil['pangkat_pemeriksa'];?>"  placeholder="Pangkat" required>
    </div>
    <div class="form-group">
      <label for="golongan_pemeriksa">Golongan</label>
      <input type="text" class="form-control" id="golongan_pemeriksa" name="golongan_pemeriksa" value="<?php echo $datpil['golongan_pemeriksa'];?>"  placeholder="Golongan" required>
    </div>
    <div class="form-group">
      <label for="jabatan">Jabatan</label>
      <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $datpil['jabatan'];?>"  placeholder="Nama Jabatan" required>
    </div>
    <div class="form-group">
      <label for="username">username</label>
      <input type="text" class="form-control" id="username" name="username" value="<?php echo $datpil['username'];?>"  placeholder="Username" required>
    </div>
    <div class="form-group">
      <label for="username">Password</label>
      <input type="password" class="form-control" id="username" name="username" value="<?php echo $datpil['username'];?>"  placeholder="Password" required>
    </div>                 
    
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
  <button  type="submit" class="btn btn-outline">Simpan</button>
</div>
</form>  