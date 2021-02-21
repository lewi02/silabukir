<?php 
session_start();
require_once 'include/db_connect.php';
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['id_guru']==""){
    header("location:login.php");
}
$id_guru =$_SESSION['id_guru'];
$nama_guru=$_SESSION['nama_guru'];
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
                 <div class="row">
                    <div class="col-md-12">
                      <div class="box box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Keluhan dan Pertanyaan</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="box-group" id="accordion">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <?php  
                             $sql = "SELECT * FROM pertanyaan ORDER BY tanggal_kirim ";
                               $query = $connect->query($sql);

                               $x = 1;
                               $y = 1;
                               while ($row = $query->fetch_assoc()) { 
                                $pengirim=$row['pengirim'];
                                if($nama_guru==$pengirim){
                                   $action= "<a href='#' class='hapus-data' data-toggle='modal' data-id=".$row['id_pertanyaan']." data-original-title='Hapus'> <i class='fa fa-trash-o'></i> </a>";   
                                }else{
                                    $action="";
                                }
                                
                                
                             ?>
                            <div class="panel box box-danger">
                              <div class="box-header with-border">
                                <h4 class="box-title">

                                  <?php echo $action;?>
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $x++;?>">
                                    <?php echo $row['judul_pertanyaan'];?>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapse<?php echo $y++;?>" class="panel-collapse collapse">
                                <div class="box-body">
                                  <div class="form-group">
                                    <label for="nama_guru">Uraian</label>
                                      <?php echo $row['uraian_pertanyaan'];?>
                                  </div>
                                  <div class="form-group">
                                    <label for="nama_guru">Jawaban</label>
                                      <?php echo $row['jawaban'];?>
                                  </div>
                                </div>
                              </div>
                            </div>
                           
                            <?php } ?>
                          </div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                   
                  </div>
                <!-- /.box -->
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
          $(".hapus-data").button().click(function(){
                var id = $(this).data('id');
                Swal.fire({
                    icon: 'warning',
                    title: 'Konfirmasi',
                    text: "Anda ingin menghapus ",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: 'Tidak',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "aksi_guru.php?aksi=hapus",
                            method: "post",
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Menunggu',
                                    html: 'Memproses data',
                                    onOpen: () => {
                                        swal.showLoading()
                                    }
                                })
                            },
                            data: {
                                id: id
                            },
                            success: function(data) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Terhapus',
                                    showConfirmButton: true,
                                    timer: 1500
                                })

                                 window.location.reload(); 
                            }
                        })
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Batal Menghapus Data',
                            showConfirmButton: true,
                            timer: 1500
                        })

                    }
                })
            });
            
        });
      </script>
   </body>
</html>
