<?php 
session_start();
require_once '../include/db_connect.php';
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['id_admin']==""){
    header("location:login.php");
}
$id_laporan =$_GET['id'];
$query=mysqli_query($connect, "SELECT * FROM tbl_laporan left join tbl_sekolah on tbl_laporan.npsn=tbl_sekolah.npsn where id_laporan='$id_laporan'") or die(mysqli_error($connect));
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
                  <small>Verifikasi Laporan Bulanan</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Verifikasi Laporan Bulanan</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Verifikasi Data Laporan </h3>
                    <div class="box-tools pull-right">
                      <a href="laporan_bulanan.php" class="btn btn-success waves-effect waves-light"><i class="fa fa-reply-all"></i> Kembali</a>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                      <div class="row invoice-info">
                        <div class="col-sm-8 invoice-col">
                          Data Guru
                          <address>
                            <strong><?php echo $datpil['nama_sekolah'];?></strong><br>
                            <?php echo $datpil['npsn'];?><br>
                            <?php echo $datpil['telp_sekolah'];?><br>
                            <?php echo $datpil['alamat_sekolah'];?><br>
                            <?php echo $datpil['nama_kepala_sekolah'];?>
                          </address>
                        </div>
                        <!-- /.col -->
                        
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Kode Laporan #<?php echo $datpil['id_laporan'];?></b><br>
                          <br>
                          <b>Tanggal Kirim :</b> <?php echo tanggal_indo($datpil['tgl_kirim']);?><br>
                          <b>Bulan:</b> <?php echo getBulan($datpil['bulan']);?><br>
                          <b>Tahun:</b> <?php echo $datpil['tahun'];?>
                        </div>
                        
                      </div>
                      <!-- /.row -->
                    <input type="hidden" class="form-control" id="id_laporan" name="id_laporan" value="<?php echo $id_laporan;?>" >
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
            var id_laporan=$('#id_laporan').val();
            $.ajax({
                url: 'laporan_bulanan/verifikasi.php',
                type: "POST",
                data: {
                    id_laporan: id_laporan,
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
                    url: "laporan_bulanan/aksi.php?aksi=verifikasi",
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
