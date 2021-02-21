<?php
require_once '../../include/db_connect.php';
 $id =$_POST['id'];
 $query=mysqli_query($connect, "SELECT * FROM tbl_sekolah WHERE npsn='$id'") or die(mysqli_error($connect));
 $datpil=mysqli_fetch_array($query);
?>

<form id="formubahdata" method="post"> 
<div class="modal-body">
    
    <div class="form-group">
        <label for="npsn">NPSN</label>
        <input type="number" class="form-control" id="npsn" name="npsn" value="<?php echo $datpil['npsn'];?>"  placeholder="NPSN" readonly>
    </div>
    <div class="form-group">
        <label for="nama_sekolah">Nama Sekolah</label>
        <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="<?php echo $datpil['nama_sekolah'];?>"  placeholder="Nama Sekolah" required>
      </div>
      <div class="form-group">
        <label for="alamat_sekolah">Alamat Sekolah</label>
        <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah" value="<?php echo $datpil['alamat_sekolah'];?>"  placeholder="Alamat Sekolah" required>
      </div>
      <div class="form-group">
        <label for="telp_sekolah">Telp Sekolah</label>
        <input type="number" class="form-control" id="telp_sekolah" name="telp_sekolah" value="<?php echo $datpil['telp_sekolah'];?>"  placeholder="Tel Sekolah" required>
      </div>
      <div class="form-group">
        <label for="desa">Desa/Kelurahan</label>
        <input type="text" class="form-control" id="desa" name="desa" value="<?php echo $datpil['desa'];?>"  placeholder="Nama Desa/Kelurahan" required>
      </div>
      <div class="form-group">
        <label for="kecamatan">Kecamatan</label>
        <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?php echo $datpil['kecamatan'];?>"  placeholder="Kecamatan" required>
      </div>
      <div class="form-group">
        <label for="desa">Jenjang Pendidikan</label>        
        <select class="form-control" id="jenjang_sekolah" name="jenjang_sekolah">
            <?php $jenjang_sekolah=$datpil['jenjang_sekolah'];?>
            <option <?php if( $jenjang_sekolah=='TK'){echo "selected"; } ?> value="TK">Taman Kanak - Kanak</option>
          	<option <?php if( $jenjang_sekolah=='SD'){echo "selected"; } ?> value="SD">Sekolah Dasar</option>
          	<option <?php if( $jenjang_sekolah=='SMP'){echo "selected"; } ?> value="SMP">Sekolah Menengah Pertama</option>

        </select>
      </div>
      <div class="form-group">
        <label for="nama_kepala_sekolah">Nama Kepala Sekolah</label>
        <input type="text" class="form-control" id="nama_kepala_sekolah" name="nama_kepala_sekolah" value="<?php echo $datpil['nama_kepala_sekolah'];?>"  placeholder="Nama Kepala Sekolah" required>
      </div>

      <div class="form-group">
        <label for="password_sekolah">Password</label>
        <input type="text" class="form-control" id="password_sekolah" name="password_sekolah" value="<?php echo $datpil['password_sekolah'];?>"  placeholder="Password" required="">
      </div>
    
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
  <button  type="submit" class="btn btn-outline">Simpan</button>
</div>
</form>  