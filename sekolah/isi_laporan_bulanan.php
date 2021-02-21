<?php 
session_start();
require_once '../include/db_connect.php';
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['npsn']==""){
    header("location:login.php");
}
$id_laporan =$_GET['id'];

?>
<!DOCTYPE html>
<html>
   <head>
     
     <?php include '../template/css.php'; ?>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <?php include '../template/menusekolah.php'; ?>
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  Dashboard
                  <small>Data Laporan Bulanan</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Data laporan</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                  <input type="hidden" class="form-control" id="id_laporan" name="id_laporan" value="<?php echo $id_laporan;?>" >
                  <div class="col-md-12">
                    <!-- Custom Tabs (Pulled to the right) -->
                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab">Cek Validasi Laporan</a></li>
                        <li><a href="#tab_2-2" data-toggle="tab">Form Pengisian Laporan</a></li>
                        
                        <li class="pull-left header"><i class="fa fa-th"></i> Laporan laporan Bulanan</li>
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
                    <label for="id_indikator_laporan">Uraian Indikator laporan </label>
                     <input type="hidden" class="form-control" id="id_laporanadd" name="id_laporanadd" value="<?php echo $id_laporan;?>" >
                    <select class="form-control select2" id="id_subindikator_laporan" name="id_subindikator_laporan" required="">
                      <option value="">~~ Pilih Indikator laporan ~~</option>
                      <?php 
                          $sql="select * from tbl_indikator_laporan left join tbl_subindikator_laporan on tbl_indikator_laporan.id_indikator_laporan=tbl_subindikator_laporan.id_indikator_laporan order By tbl_indikator_laporan.id_indikator_laporan ASC";

                          $hasil=mysqli_query($connect,$sql);
                          while ($data = mysqli_fetch_array($hasil)) {
                      ?>
                      <option value="<?php echo $data['id_subindikator_laporan'];?>">(<?php echo $data['uraian_indikator_laporan'];?> ) - <?php echo $data['uraian_subindikator_laporan'];?> 
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nama_guru">Isi Laporan laporan</label>
                    <textarea class="form-control" id="isi_laporan" name="isi_laporan" required=""></textarea>                      
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
          cekData();
          isiData();
          function cekData() {
            var id_laporan=$('#id_laporan').val();
            $.ajax({
                url: 'laporan_bulanan/cek_data.php',
                type: "POST",
                data: {
                    id_laporan: id_laporan,
                },
                success: function(data) {
                    $('#cekdata').html(data);
                }
            });
          }
          
          function isiData() {
            var id_laporan=$('#id_laporan').val();
            $.ajax({
                url: 'laporan_bulanan/isi_data.php',
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
