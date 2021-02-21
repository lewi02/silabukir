<?php 
session_start();
require_once '../include/db_connect.php';
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['npsn']==""){
    header("location:login.php");
}
$id_kinerja =$_GET['id'];
$query=mysqli_query($connect, "SELECT * FROM tbl_kinerja left join tbl_guru on tbl_kinerja.id_guru=tbl_guru.id_guru where id_kinerja='$id_kinerja'") or die(mysqli_error($connect));
 $datpil=mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html>
   <head>
     
     <?php include '../template/css.php'; ?>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <?php include '../template/menusekolah.php'; ?>
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  Dashboard
                  <small>Data Laporan Bulanan</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Data Bulanan</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Data Laporan </h3>
                    <div class="box-tools pull-right">
                      <a href="kinerja_guru.php" class="btn btn-success waves-effect waves-light"><i class="fa fa-reply-all"></i> Kembali</a>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                      <div class="row invoice-info">
                        <div class="col-sm-8 invoice-col">
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
                          <b>Kode Laporan #<?php echo $datpil['id_kinerja'];?></b><br>
                          <br>
                          <b>Tanggal Kirim :</b> <?php echo tanggal_indo($datpil['tgl_kirim']);?><br>
                          <b>Bulan:</b> <?php echo getBulan($datpil['bulan']);?><br>
                          <b>Tahun:</b> <?php echo $datpil['tahun'];?>
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
                url: 'kinerja_guru/isi_data.php',
                type: "POST",
                data: {
                    id_kinerja: id_kinerja,
                },
                success: function(data) {
                    $('#lihatisiData').html(data);
                }
            });
          }
          
          
        });
      </script>
   </body>
</html>
