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
                <div class="row">
                  <input type="hidden" class="form-control" id="id_kinerja" name="id_kinerja" value="<?php echo $id_kinerja;?>" >
                  <div class="col-md-12">
                    <!-- Custom Tabs (Pulled to the right) -->
                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab">Cek Validasi Laporan</a></li>
                        <li><a href="#tab_2-2" data-toggle="tab">Form Pengisian Laporan</a></li>
                        
                        <li class="pull-left header"><i class="fa fa-th"></i> Laporan Kinerja Guru</li>
                        <li class="pull-right"><button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#Modal_Add"><i class="fa fa-plus-circle "></i>Tambah Data</button></li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                           <div id="cekdata"></div>
                          
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2-2">
                          <div id="lihatisiData"></div>
                        </div>
                        
                      </div>
                      <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                  </div>
                  <!-- /.col -->
                </div>
                
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
                <form id="formtambahdata" >
                <div class="modal-body">  
                  <div class="form-group">
                    <label for="id_indikator_kinerja">Uraian Indikator kinerja </label>
                    <select class="form-control select2" id="id_indikator_kinerja" name="id_indikator_kinerja" required="">
                      <option value="">~~ Pilih Indikator Kinerja ~~</option>
                      <?php 
                          $sql="select * from tbl_indikator_kinerja";

                          $hasil=mysqli_query($connect,$sql);
                          while ($data = mysqli_fetch_array($hasil)) {
                      ?>
                      <option value="<?php echo $data['id_indikator_kinerja'];?>"><?php echo $data['uraian_indikator_kinerja'];?> 
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nama_guru">Isi Laporan Kinerja</label>
                    <textarea class="form-control" id="isi_kinerja" name="isi_kinerja" required=""></textarea>
                      
                  </div>                
                  <div class="form-group">
                        <label for="username">File Pendukung</label>
                        <input type="file" name="fileupload" id="fileupload" class="form-control" placeholder="File Pendukung" required="" >
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
         <?php include 'templateguru/footer.php'; ?>
         <div class="control-sidebar-bg"></div>
      </div>
      <?php include 'templateguru/js.php'; ?>
      <script>
        $(document).ready(function() {
          cekData();
          isiData();
          function cekData() {
            var id_kinerja=$('#id_kinerja').val();
            $.ajax({
                url: 'kinerja_guru/cek_data.php',
                type: "POST",
                data: {
                    id_kinerja: id_kinerja,
                },
                success: function(data) {
                    $('#cekdata').html(data);
                }
            });
          }
          
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
          $('#formtambahdata').on('submit', function() {
            const fileupload = $('#fileupload').prop('files')[0];
            let formData = new FormData();
            formData.append('fileupload', fileupload);
            formData.append('id_kinerja', $('#id_kinerja').val());
            formData.append('id_indikator_kinerja', $('#id_indikator_kinerja').val());
            formData.append('isi_kinerja', $('#isi_kinerja').val());
              $.ajax({
                  type: "POST",
                  url: "kinerja_guru/aksi.php?aksi=simpan",
                  beforeSend: function() {
                      Swal.fire({
                          title: 'Menunggu',
                          html: 'Memproses data',
                          onOpen: () => {
                              swal.showLoading()
                          }
                      })
                  },
                  data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                  success: function(data) {
                      Swal.fire({
                          icon: 'success',
                          title: 'Tambah Data',
                          text: 'Anda Berhasil Menambah Data ',
                          showConfirmButton: true,
                          timer: 1500
                      });
                      $("#formtambahdata")[0].reset();
                      $('#Modal_Add').modal('hide');
                      cekData();
                      isiData();
                  }
              });
              return false;
          });
          $('#lihatisiData').on('click', '.ubah-data', function() {
              var id = $(this).data('id');
              $.ajax({
                  type: "post",
                  url: "kinerja_guru/modal_edit.php",
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
                          const fileupload_ubah = $('#fileupload_ubah').prop('files')[0];
                          let formData = new FormData();
                          formData.append('fileupload_ubah', fileupload_ubah);
                          formData.append('id_kinerja_ubah', $('#id_kinerja_ubah').val());
                          formData.append('id_indikator_kinerja_ubah', $('#id_indikator_kinerja_ubah').val());
                          formData.append('isi_kinerja_ubah', $('#isi_kinerja_ubah').val());
                          formData.append('id_dkinerja', $('#id_dkinerja').val());
                          $.ajax({
                              type: "post",
                              url: "kinerja_guru/aksi.php?aksi=edit",
                              beforeSend: function() {
                                  Swal.fire({
                                      title: 'Menunggu',
                                      html: 'Memproses data',
                                      onOpen: () => {
                                          swal.showLoading()
                                      }
                                  })
                              },
                              data: formData,
                          cache: false,
                          processData: false,
                          contentType: false,
                              success: function(data) {
                                  cekData();
                                  isiData();
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
          $('#lihatisiData').on('click', '.hapus-data', function() {
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
                          url: "kinerja_guru/aksi.php?aksi=hapus",
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

                              cekData();
                              isiData();
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
