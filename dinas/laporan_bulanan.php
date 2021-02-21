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
                            <th>Kode Laporan</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Tanggal Kirim</th>
                            <th>Nama Sekolah</th>                             
                            <th>Keterangan</th>
                            <th>Pemeriksa</th>
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
                              <th>Kode Laporan</th>
                              <th>Bulan</th>
                              <th>Tahun</th>
                              <th>Tanggal Kirim</th>
                              <th>Nama Sekolah</th>                             
                              <th>Keterangan</th>
                              <th>Pemeriksa</th>
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
                <form id="formtambahdata">
                <div class="modal-body">                  
                  <div class="form-group">
                    <label for="nama_guru">Nama Guru</label>
                    <input type="text" class="form-control" id="nama_guru" name="nama_guru" placeholder="Nama Guru" required>
                  </div>
                  <div class="row">
                    <div class="col-sm-7 form-group">
                      <label for="nip">NIP</label>
                      <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" required>
                    </div>
                    <div class="col-sm-5 form-group">
                      <label for="jenis_kelamin">Jenis Kelamin</label>
                      <select class="form-control"id="jenis_kelamin" name="jenis_kelamin"  required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki - Laki</option>
                        <option value="P">Perempuan</option>                     
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-8 form-group">
                      <label for="tempat_lahir">Tempat Lahir</label>
                      <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                    </div>
                    <div class="col-sm-4 form-group">
                      <label for="tanggal_lahir">Tanggal Lahir</label>
                      <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tempat Lahir" required>
                    </div>
                  </div>      
                  <div class="row">
                    <div class="col-sm-8 form-group">
                      <label for="pangkat">Pangkat</label>
                      <input type="text" class="form-control" id="pangkat" name="pangkat" placeholder="Pangkat" required>
                    </div>
                    <div class="col-sm-4 form-group">
                      <label for="gol">Golongan</label>
                      <input type="text" class="form-control" id="gol" name="gol" placeholder="Pangkat" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4 form-group">
                      <label for="tmt_tugas">TMT TUGAS</label>
                      <input type="date" class="form-control" id="tmt_tugas" name="tmt_tugas" placeholder="TMT Tugas" required>
                    </div>
                    <div class="col-sm-8 form-group">
                      <label for="jabatan">Jabatan</label>
                      <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pendidikan">Pendidikan</label>
                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" placeholder="Pendidikan" required>
                  </div>
                   <div class="form-group">
                    <label for="password">password</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="Password" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="npsn">Nama Sekolah</label>
                    <select class="form-control select2" name="npsn" >
                      <option value="">~~ Pilih Nama Sekolah ~~</option>
                      <?php 
                          $sql="select * from tbl_sekolah";

                          $hasil=mysqli_query($connect,$sql);
                          while ($data = mysqli_fetch_array($hasil)) {
                      ?>
                      <option value="<?php echo $data['npsn'];?>"><?php echo $data['npsn'];?> ~~ <?php echo $data['nama_sekolah'];?></option>
                      <?php } ?>
                      </select>
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
                "ajax": "laporan_bulanan/aksi.php?aksi=view_data",
                stateSave: true,
                "order": []
            });
            $('#formtambahdata').on('submit', function() {
                var form = $(this);     
                $.ajax({
                    type: "POST",
                    url: "laporan_bulanan/aksi.php?aksi=simpan",
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
                    url: "laporan_bulanan/modal_edit.php",
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
                                url: "laporan_bulanan/aksi.php?aksi=edit",
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
                            url: "laporan_bulanan/aksi.php?aksi=hapus",
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
