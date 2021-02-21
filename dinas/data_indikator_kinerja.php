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
                  <small>Data Indikator kinerja</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Data Indikator kinerja</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Data Indikator kinerja</h3>

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
                            <th>Uraian Indikator kinerja</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>Uraian Indikator kinerja</th>
                            <th>Aksi</th>
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
                <form id="formtambahdata"> 
                <div class="modal-body">
                  <div class="form-group">
                    <label for="uraian_indikator_kinerja">Uraian Indikator kinerja </label>
                    <input type="text" class="form-control" id="uraian_indikator_kinerja" name="uraian_indikator_kinerja" placeholder="Uraian Indikator kinerja" required>
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
         <?php include '../template/footer.php'; ?>
         <div class="control-sidebar-bg"></div>
      </div>
      <?php include '../template/js.php'; ?>
      <script>
        $(document).ready(function() {
           var listdata = $('#listdata').DataTable({
                "processing": true,
                "ajax": "data_indikator_kinerja/aksi.php?aksi=view_data",
                stateSave: true,
                "order": []
            });
            $('#formtambahdata').on('submit', function() {
                var form = $(this);     
                $.ajax({
                    type: "POST",
                    url: "data_indikator_kinerja/aksi.php?aksi=simpan",
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
            $('#listdata').on('click', '.ubah-data', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "post",
                    url: "data_indikator_kinerja/modal_edit.php",
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
                                url: "data_indikator_kinerja/aksi.php?aksi=edit",
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
                            url: "data_indikator_kinerja/aksi.php?aksi=hapus",
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
        });
      </script>
   </body>
</html>
