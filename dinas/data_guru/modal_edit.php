<?php
require_once '../../include/db_connect.php';
 $id =$_POST['id'];
 $query=mysqli_query($connect, "SELECT * FROM tbl_guru WHERE id_guru='$id'") or die(mysqli_error($connect));
 $datpil=mysqli_fetch_array($query);
?>

<form id="formubahdata" method="post"> 
<div class="modal-body">
    <div class="form-group">
      <label for="id_guru">Kode  Guru</label>
      <input type="text" class="form-control" id="id_guru" name="id_guru" value="<?php echo $datpil['id_guru'];?>"  placeholder="Kode Guru" readonly="">
    </div>
    <div class="form-group">
      <label for="nama_guru">Nama Guru</label>
      <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?php echo $datpil['nama_guru'];?>"  placeholder="Nama Guru" required>
    </div>
    <div class="row">
      <div class="col-sm-7 form-group">
        <label for="nip">NIP</label>
        <input type="text" class="form-control" id="nip" name="nip" value="<?php echo $datpil['npsn'];?>"  placeholder="NIP" required>
      </div>
      <div class="col-sm-5 form-group">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
            <?php $jenis_kelamin=$datpil['jenis_kelamin'];?>
            <option <?php if( $jenis_kelamin=='L'){echo "selected"; } ?> value="L">Laki - Laki</option>
            <option <?php if( $jenis_kelamin=='P'){echo "selected"; } ?> value="P">Perempuan</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-8 form-group">
        <label for="tempat_lahir">Tempat Lahir</label>
        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"  value="<?php echo $datpil['tempat_lahir'];?>"  placeholder="Tempat Lahir" required>
      </div>
      <div class="col-sm-4 form-group">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"  value="<?php echo $datpil['tanggal_lahir'];?>"  placeholder="Tempat Lahir" required>
      </div>
    </div>      
    <div class="row">
      <div class="col-sm-8 form-group">
        <label for="pangkat">Pangkat</label>
        <input type="text" class="form-control" id="pangkat" name="pangkat"  value="<?php echo $datpil['pangkat'];?>"  placeholder="Pangkat" required>
      </div>
      <div class="col-sm-4 form-group">
        <label for="gol">Golongan</label>
        <input type="text" class="form-control" id="gol" name="gol"  value="<?php echo $datpil['gol'];?>"  placeholder="Pangkat" required>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4 form-group">
        <label for="tmt_tugas">TMT TUGAS</label>
        <input type="date" class="form-control" id="tmt_tugas" name="tmt_tugas"  value="<?php echo $datpil['tmt_tugas'];?>"  placeholder="TMT Tugas" required>
      </div>
      <div class="col-sm-8 form-group">
        <label for="jabatan">Jabatan</label>
        <input type="text" class="form-control" id="jabatan" name="jabatan"  value="<?php echo $datpil['jabatan'];?>"  placeholder="Jabatan" required>
      </div>
    </div>
    <div class="form-group">
      <label for="pendidikan">Pendidikan</label>
      <input type="text" class="form-control" id="pendidikan" name="pendidikan"  value="<?php echo $datpil['pendidikan'];?>"  placeholder="Pendidikan" required>
    </div>
     <div class="form-group">
      <label for="password">password</label>
      <input type="text" class="form-control" id="password" name="password"  value="<?php echo $datpil['password'];?>"  placeholder="Password" required>
    </div>
    
    <div class="form-group">
      <label for="npsn">Nama Sekolah</label>
      <select class="form-control select2" name="npsn" >
        <option value="">~~ Pilih Nama Sekolah ~~</option>
         <?php 
            $sql="select * from tbl_sekolah";

            $hasil=mysqli_query($connect,$sql);
            while ($data = mysqli_fetch_array($hasil)) {
       
                $npsn=$datpil['npsn'];
                if($npsn==$data['npsn']){
                     echo "<option value='$data[npsn]' selected>$data[npsn] ~~ $data[nama_sekolah]</option>";
                }else{
                     echo "<option value='$data[npsn]'>$data[npsn]  $data[nama_sekolah]</option>";
                 
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