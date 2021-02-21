<?php 
session_start();
require_once '../include/db_connect.php';
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['id_admin']==""){
    header("location:login.php");
}
$id_kinerja =$_GET['id'];
$query=mysqli_query($connect, "SELECT * FROM tbl_kinerja left join tbl_guru on tbl_kinerja.id_guru=tbl_guru.id_guru left join tbl_sekolah on tbl_guru.npsn=tbl_sekolah.npsn where id_kinerja='$id_kinerja'") or die(mysqli_error($connect));
 $datpil=mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html>
   <head>
     
     <?php include '../template/css.php'; ?>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <?php include '../template/menudinas.php'; ?>
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  Dashboard
                  <small>Verifikasi Kinerja Guru</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Verifikasi Kinerja </li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Verifikasi Data kinerja </h3>
                    <div class="box-tools pull-right">
                      <a href="kinerja_guru.php" class="btn btn-success waves-effect waves-light"><i class="fa fa-reply-all"></i> Kembali</a>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          Data Guru
                          <address>
                            <strong><?php echo $datpil['nama_guru'];?></strong><br>
                            <?php echo $datpil['nip'];?><br>
                            <?php echo $datpil['pangkat'];?>,<?php echo $datpil['gol'];?><br>
                            <?php echo tanggal_indo($datpil['tmt_tugas']);?><br>
                            <?php echo $datpil['jabatan'];?>
                          </address>
                        </div>
                        <!-- /.col -->
                        
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Kode kinerja #<?php echo $datpil['id_kinerja'];?></b><br>
                          <br>
                          <b>Tanggal Kirim :</b> <?php echo tanggal_indo($datpil['tgl_kirim']);?><br>
                          <b>Bulan:</b> <?php echo getBulan($datpil['bulan']);?><br>
                          <b>Tahun:</b> <?php echo $datpil['tahun'];?>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <form id="formtambahdata">
                              <div class="form-group">
                                 <label for="#">Status Verifikasi </label>
                                 <input type="hidden" class="form-control" id="id_kinerjaver" name="id_kinerjaver" placeholder="id_kinerja" value="<?php echo $datpil['id_kinerja'];?>" required>
                                 <select class="form-control"id="status" name="status"  required>
                                    <option value="">Pilih Status Verikasi</option>
                                    <option value="4">DI TERIMA</option>
                                    <option value="5">DI TOLAK</option>                     
                                  </select>
                              </div>
                              <div class="form-group">
                                 <label for="#">Keterangan</label>
                                 <textarea class="textarea" name="keterangan" placeholder="Keterangan" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required=""></textarea>
                              </div>
                             
                              <div class="form-group">
                                <button  type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                            </form>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    <input type="hidden" class="form-control" id="id_kinerja" name="id_kinerja" value="<?php echo $id_kinerja;?>" >
                    <div id="lihatisiData"></div>
                  </div>
                  <!-- /.box-body -->
                </div>
                
            </section>
            <!-- /.content -->
          </div>
         
        <!-- /.modal -->
         <?php include '../template/footer.php'; ?>
         <div class="control-sidebar-bg"></div>
      </div>
      <?php include '../template/js.php'; ?>
      <script>
        $(document).ready(function() {
          isiData();
          
          
          function isiData() {
            var id_kinerja=$('#id_kinerja').val();
            $.ajax({
                url: 'kinerja_guru/verifikasi.php',
                type: "POST",
                data: {
                    id_kinerja: id_kinerja,
                },
                success: function(data) {
                    $('#lihatisiData').html(data);
                }
            });
          }
          $('#formtambahdata').on('submit', function() {
                var form = $(this);     
                $.ajax({
                    type: "POST",
                    url: "kinerja_guru/aksi.php?aksi=verifikasi",
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    dataType: "JSON",
                    data: form.serialize(),
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Tambah Data',
                            text: 'Anda Berhasil Menambah Data',
                            showConfirmButton: true,
                            timer: 1500
                        });
                        $("#formtambahdata")[0].reset();
                        $('#Modal_Add').modal('hide');
                        isiData();
                    }
                });
                return false;
            });
        });
      </script>
   </body>
</html>
