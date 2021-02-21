<?php 
session_start();
require_once 'include/db_connect.php';
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['id_guru']==""){
    header("location:login.php");
}
$id_guru =$_SESSION['id_guru'];
$query=mysqli_query($connect, "SELECT * FROM tbl_guru WHERE id_guru='$id_guru'") or die(mysqli_error($connect));
$datpil=mysqli_fetch_array($query);
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
            <section class="content-header">
                  <h1>
                    Pofil  <?php echo $_SESSION['nama_guru'];?>
                  </h1>
                  <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Data Profil</a></li>
                    <li class="active">Profil  <?php echo $_SESSION['nama_guru'];?></li>
                  </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                  <div class="row">
                    <div class="col-md-3">

                      <!-- Profile Image -->
                      <div class="box box-primary">
                        <div class="box-body box-profile">
                          <img class="profile-user-img img-responsive img-circle" src="assets/img/user4-128x128.jpg" alt="User profile picture">

                          <h3 class="profile-username text-center"><?php echo $datpil['id_guru'];?></h3>

                          <p class="text-muted text-center"><?php echo $datpil['jabatan'];?></p>

                          <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                              <b>Semua Laporan</b> <a class="pull-right"><?php echo $jlh_pel;?></a>
                            </li>
                            <li class="list-group-item">
                              <b>Draf Laporan</b> <a class="pull-right"><?php echo $jlh_pelnew;?></a>
                            </li>
                            <li class="list-group-item">
                              <b>Laporan di terima</b> <a class="pull-right"><?php echo $jlh_pelditerima;?></a>
                            </li>
                          </ul>

                          <a href="kinerja_guru.php" class="btn btn-primary btn-block"><b>Buat Laporan Kinerja</b></a>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->

                      <!-- About Me Box -->
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">About Me</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <strong><i class="fa fa-book margin-r-5"></i> Kode Guru</strong>
                          <p class="text-muted"><?php echo $datpil['id_guru'];?></p>

                          <hr>
                          <strong><i class="fa fa-book margin-r-5"></i> Nama Lengkap</strong>
                          <p class="text-muted"><?php echo $datpil['nama_guru'];?></p>

                          <hr>
                          <strong><i class="fa fa-book margin-r-5"></i> NIP</strong>
                          <p class="text-muted"><?php echo $datpil['nip'];?></p>

                          <hr>
                          <strong><i class="fa fa-book margin-r-5"></i> Tempat Tanggal Lahir</strong>
                          <p class="text-muted"><?php echo $datpil['tempat_lahir'];?>, <?php echo tanggal_indo($datpil['tanggal_lahir']);?></p>

                          <hr>
                          <strong><i class="fa fa-book margin-r-5"></i>Jenis Kelamin</strong>
                          <p class="text-muted"><?php
                          if($datpil['jenis_kelamin']=='L'){
                            echo "Laki - Laki";
                          }else{
                            echo "Perempuan";
                          }
                          ?></p>
                          
                          <hr>
                          <strong><i class="fa fa-book margin-r-5"></i> Pangkat, Gol</strong>
                          <p class="text-muted"><?php echo $datpil['pangkat'];?> - <?php echo $datpil['gol'];?></p>

                          <hr>
                          <strong><i class="fa fa-book margin-r-5"></i> Pendidikan</strong>
                          <p class="text-muted"><?php echo $datpil['pendidikan'];?></p>

                          <hr>
                          <strong><i class="fa fa-book margin-r-5"></i> Jabatan</strong>
                          <p class="text-muted"><?php echo $datpil['jabatan'];?></p>

                          <hr>

                          <?php echo "<a href='#' class='btn btn-primary btn-block ubah-data' data-toggle='modal' data-id=".$datpil['id_guru']." data-original-title='Edit'> <i class='fa fa-edit'></i> </a>";?>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                     <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title">Data  Kinerja</h3>
                          
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="table-responsive order-table">
                            <table id="listdata" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>No</th>                            
                                  <th>Kode Kinerja</th>
                                  <th>Bulan</th>
                                  <th>Tahun</th>
                                  <th>Tanggal Kirim</th>
                                  <th>Keterangan</th>
                                  <th>Penilai</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                             
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>No</th>                            
                                  <th>Kode Kinerja</th>
                                  <th>Bulan</th>
                                  <th>Tahun</th>
                                  <th>Tanggal Kirim</th>
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
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

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
        <!-- /.modal -->
         <?php include 'templateguru/footer.php'; ?>
         <div class="control-sidebar-bg"></div>
      </div>
      <?php include 'templateguru/js.php'; ?>
      <script>
        $(document).ready(function() {
          var listdata = $('#listdata').DataTable({
                "processing": true,
                "ajax": "kinerja_guru/aksi.php?aksi=view_dataprofil",
                stateSave: true,
                "order": []
            });
            $(".ubah-data").button().click(function(){
                var id = $(this).data('id');
                $.ajax({
                    type: "post",
                    url: "dinas/data_guru/modal_edit.php",
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
                       
                        $('#formubahdata').on('submit', function() {
                            var form = $(this);                
                            $.ajax({
                                type: "post",
                                url: "dinas/data_guru/aksi.php?aksi=edit",
                                beforeSend: function() {
                                    Swal.fire({
                                        title: 'Menunggu',
                                        html: 'Memproses data',
                                        onOpen: () => {
                                            swal.showLoading()
                                        }
                                    })
                                },
                                data: form.serialize(),
                                success: function(data) {
                                    listdata.ajax.reload(null, false);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil Terupdate',
                                        text: 'Anda Berhasil Mengubah Data',
                                        showConfirmButton: true,
                                        timer: 1500
                                    })
                                    // bersihkan form pada modal
                                    $('#Modal_Edit').modal('hide');
                                }
                            })
                            return false;
                        });
                    }
                });
            });
        });
      </script>
   </body>
</html>
