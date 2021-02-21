<?php 
session_start();
require_once 'include/db_connect.php';
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['id_guru']==""){
    header("location:login.php");
}
$id_guru =$_SESSION['id_guru'];
$nama_guru=$_SESSION['nama_guru'];
$datapel = mysqli_query($connect,"SELECT * FROM tbl_kinerja where id_guru='$id_guru'");
$datapelnew = mysqli_query($connect,"SELECT * FROM tbl_kinerja where id_guru='$id_guru' and status='1'");
$datapelditerima = mysqli_query($connect,"SELECT * FROM tbl_kinerja where id_guru='$id_guru' and  status='2'");
$datapelditolak = mysqli_query($connect,"SELECT * FROM tbl_kinerja where id_guru='$id_guru' and  status='3'");
$jlh_pel = mysqli_num_rows($datapel);
$jlh_pelnew = mysqli_num_rows($datapelnew);
$jlh_pelditerima = mysqli_num_rows($datapelditerima);
$jlh_pelditolak = mysqli_num_rows($datapelditolak);
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
                  <small>Halaman Utama</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Dashboard</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <!-- Small boxes (Stat box) -->

               <div class="row">
                  <div class="col-lg-3 col-xs-6">
                     <!-- small box -->
                     <div class="small-box bg-aqua">
                        <div class="inner">
                           <h3><?php echo $jlh_pel;?> </h3>
                           <p>Semua Laporan Kinerja</p>
                        </div>
                        <div class="icon">
                           <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-xs-6">
                     <!-- small box -->
                     <div class="small-box bg-green">
                        <div class="inner">
                           <h3><?php echo $jlh_pelnew;?></h3>
                           <p>Draf Laporan Kinerja</p>
                        </div>
                        <div class="icon">
                           <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-xs-6">
                     <!-- small box -->
                     <div class="small-box bg-yellow">
                        <div class="inner">
                           <h3><?php echo $jlh_pelditerima;?></h3>
                           <p>Laporan Kinerja Dinilai</p>
                        </div>
                        <div class="icon">
                           <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-xs-6">
                     <!-- small box -->
                     <div class="small-box bg-red">
                        <div class="inner">
                           <h3><?php echo $jlh_pelditolak;?></h3>
                           <p>Laporan Kinerja Di Terima</p>
                        </div>
                        <div class="icon">
                           <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <!-- ./col -->
               </div>
               <!-- /.row -->
               <!-- Main row -->
               <div class="row">
                  <!-- Left col -->
                  <section class="col-lg-12 connectedSortable">                 
                     <!-- /.box -->
                     <!-- TO DO List -->
                      <div class="box box-primary">
                        <div class="box-header">
                          <i class="ion ion-clipboard"></i>

                          <h3 class="box-title">Pertanyaan/Keluhan Terbaru</h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                          <ul class="todo-list">
                           <?php  
                           $sql = "SELECT * FROM pertanyaan ORDER BY tanggal_kirim DESC limit 10";
                             $query = $connect->query($sql);

                             $x = 1;
                             while ($row = $query->fetch_assoc()) { 
                              $pengirim=$row['pengirim'];
                              if($nama_guru==$pengirim){
                                 $action= "<a href='#' class='lihat-data' data-toggle='modal' data-id=".$row['id_pertanyaan']." data-original-title='Edit'> <i class='fa fa-edit'></i> </a>".' '."<a href='#' class='hapus-data' data-toggle='modal' data-id=".$row['id_pertanyaan']." data-original-title='Hapus'> <i class='fa fa-trash-o'></i> </a>";   
                              }else{
                                    $action= "<a href='#' class='lihat-data' data-toggle='modal'  data-id=".$row['id_pertanyaan']." data-original-title='Edit'> <i class='fa fa-edit'></i> </a>";   
                              }
                              
                              
                           ?>
                            <li>
                              <!-- drag handle -->
                              <span class="handle">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <i class="fa fa-ellipsis-v"></i>
                                  </span>
                              <!-- checkbox -->
                              <input type="checkbox" value="">
                              <!-- todo text -->
                              <span class="text"><?php echo $row['judul_pertanyaan'];?></span>
                              <!-- Emphasis label -->
                              <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo waktu_lalu($row['tanggal_kirim']);?></small>
                              <!-- General tools such as edit or delete-->
                              <div class="tools">
                                <?php echo $action;?>
                              </div>
                            </li>
                         <?php }?>
                           
                          </ul>
                        </div>
                       
                      </div>
                      <!-- /.box -->

                     <!-- quick email widget -->
                     <div class="box box-info">
                        <div class="box-header">
                           <i class="fa fa-envelope"></i>
                           <h3 class="box-title">Kirim Pertanyaan/Keluhan</h3>
                           <!-- tools box -->
                           <div class="pull-right box-tools">
                              <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                                 title="Remove">
                              <i class="fa fa-times"></i></button>
                           </div>
                           <!-- /. tools -->
                        </div>
                         <form id="formtambahdata">
                          
                        <div class="box-body">
                             
                              <div class="form-group">

                                 <input type="text" class="form-control" name="judul_pertanyaan" maxlength="100" placeholder="Judul Pertanyaan (Panjang Maximal 100 Karakter" required="">
                              </div>
                              <div>
                                 <textarea class="textarea" name="uraian_pertanyaan" placeholder="Uraian Pertanyaan" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required=""></textarea>
                              </div>
                        </div>
                        <div class="box-footer clearfix">
                           <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                           <i class="fa fa-arrow-circle-right"></i></button>
                        </div>

                           </form>
                     </div>
                  </section>
                  <!-- /.Left col -->
                
               </div>
               <!-- /.row (main row) -->
            </section>
            <!-- /.content -->
         </div>
         <div class="modal modal-info fade" id="Modal_Edit">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Edit Data</h4>
                </div>
                <div id="formdata">
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
         <?php include 'templateguru/footer.php'; ?>
         <div class="control-sidebar-bg"></div>
      </div>
     <?php include 'templateguru/js.php'; ?>
      <script>
         $(document).ready(function() {  
            $('#formtambahdata').on('submit', function() {
                var form = $(this);     
                $.ajax({
                    type: "POST",
                    url: "aksi_guru.php?aksi=simpan",
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
                        window.location.reload();  
                    }
                });
                return false;
            });
            $(".lihat-data").button().click(function(){
                var id = $(this).data('id');
                $.ajax({
                    type: "post",
                    url: "lihat_pertanyaan.php",
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
                        swal.close();
                        $('#Modal_Edit').modal('show');
                        $('#formdata').html(data);
                       
                    }
                });
            });
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
