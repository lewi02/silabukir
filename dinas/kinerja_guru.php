<?php 
session_start();
require_once '../include/db_connect.php';
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['id_admin']==""){
    header("location:login.php");
}
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
                  <small>Laporan Bulanan</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Laporan Bulanan</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Data  Laporan Bulanan </h3>                    
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive order-table">
                      <table id="listdata" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Aksi</th>                           
                            <th>Kode Kinerja</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Tanggal Kirim</th>
                            <th>Nama Guru</th>                             
                            <th>NIP</th>                             
                            <th>Nama Sekolah</th>                             
                            <th>Keterangan</th>
                            <th>Penilai</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
                        <tfoot>
                          <tr>
                            <tr>
                              <th>No</th>
                              <th>Aksi</th>                           
                              <th>Kode Kinerja</th>
                              <th>Bulan</th>
                              <th>Tahun</th>
                              <th>Tanggal Kirim</th>
                              <th>Nama Guru</th>                             
                              <th>NIP</th>      
                              <th>Nama Sekolah</th>                             
                              <th>Keterangan</th>
                              <th>Penilai</th>
                              <th>Status</th>
                            </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
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
           var listdata = $('#listdata').DataTable({
                "processing": true,
                "ajax": "kinerja_guru/aksi.php?aksi=view_data",
                stateSave: true,
                "order": []
            });
           
        });
      </script>
   </body>
</html>
