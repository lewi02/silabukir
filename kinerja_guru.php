<?php 
session_start();
require_once 'include/db_connect.php';
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['id_guru']==""){
    header("location:login.php");
}
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
                    <h3 class="box-title">Data  Kinerja</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#Modal_Add"><i class="fa fa-plus-circle "></i>Tambah Data</button>
                    </div>
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
                            <th>Aksi</th>
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
                <!-- /.box -->
            </section>
            <!-- /.content -->
          </div>
          <div class="modal modal-info fade" id="Modal_Add">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Tambah Data</h4>
                </div>
                <form id="formtambahdata"  method="post">
                <div class="modal-body">                  
                  <div class="row">
                    <div class="col-sm-8 form-group">
                      <label for="nama_guru">Nama Bulan</label>
                      <select class="form-control" id="bulan" name="bulan"  required>
                       <?php
                        $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                          for($a=1;$a<=12;$a++){
                              if($a==date("m")){ 
                                $pilih="selected";
                              }else{
                                  $pilih="";
                              }
                          echo("<option value=\"$a\" $pilih>$bulan[$a]</option>"."\n");
                          }
                        ?>            
                      </select>
                    </div>
                    <div class="col-sm-4 form-group">
                      <label for="Tahun">Tahun</label>
                      <?php
                      $now=date('Y');
                      echo "<select class='form-control' name='tahun' id='tahun' name='tahun'  required >";
                      echo "<option value='$now'>$now</option>";
                      for ($a=2018;$a<=$now;$a++)
                      {
                           echo "<option value='$a'>$a</option>";
                      }
                      echo "</select>";
                      ?>
                    </div>
                  </div>                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                  <button  type="submit" class="btn btn-outline">Simpan</button>
                </div>
                </form>
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
                "ajax": "kinerja_guru/aksi.php?aksi=view_data",
                stateSave: true,
                "order": []
            });
            $('#formtambahdata').on('submit', function() {
                var form = $(this);     
                $.ajax({
                    type: "POST",
                    url: "kinerja_guru/aksi.php?aksi=simpankinerja",
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
                        listdata.ajax.reload(null, false);
                    }
                });
                return false;
            });
            $('#listdata').on('click', '.hapus-data', function() {
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
                            url: "kinerja_guru/aksi.php?aksi=hapuskinerja",
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

                                listdata.ajax.reload(null, false)
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
            $('#listdata').on('click', '.ajukan-data', function() {
                var id = $(this).data('id');
                Swal.fire({
                    icon: 'warning',
                    title: 'Konfirmasi',
                    text: "Anda ingin Mengajukan Laporan ",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ajukan',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: 'Tidak',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "kinerja_guru/aksi.php?aksi=ajukan",
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
                                    title: 'Berhasil Mengajukan Laporan',
                                    showConfirmButton: true,
                                    timer: 1500
                                })

                                listdata.ajax.reload(null, false)
                            }
                        })
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Batal Mengajukan Laporan',
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
