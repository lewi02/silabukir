<?php 
session_start();
require_once 'include/db_connect.php';
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['id_guru']==""){
    header("location:login.php");
}
$id_kinerja =$_GET['id'];

?>
<!DOCTYPE html>
<html>
   <head>
     
     <?php include 'templateguru/css.php'; ?>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <?php include 'templateguru/menuguru.php'; ?>
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  Dashboard
                  <small>Data Laporan Kinerja</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Data Kinerja</li>
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
                    <input type="hidden" class="form-control" id="id_kinerja" name="id_kinerja" value="<?php echo $id_kinerja;?>" >
                    <div id="lihatisiData"></div>
                  </div>
                  <!-- /.box-body -->
                </div>
                
            </section>
            <!-- /.content -->
          </div>
         
        <!-- /.modal -->
         <?php include 'templateguru/footer.php'; ?>
         <div class="control-sidebar-bg"></div>
      </div>
      <?php include 'templateguru/js.php'; ?>
      <script>
        $(document).ready(function() {
          isiData();
          
          
          function isiData() {
            var id_kinerja=$('#id_kinerja').val();
            $.ajax({
                url: 'kinerja_guru/isi_datalihat.php',
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
