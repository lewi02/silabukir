<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Login Guru | APLIKASI LAPORAN KINERJA</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css" />
        <!-- Ionicons -->
        <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css" />
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/css/AdminLTE.min.css" />
        <!-- iCheck -->
        <link rel="stylesheet" href="../plugins/iCheck/square/blue.css" />

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"> <b>Login </b>Guru </a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Silahkan Login Untuk Melakukan Pengisian Data</p>
                 <form id="login-form">
                    <div class="form-group has-feedback">
                        <input type="text" id="id_guru" name="id_guru" class="form-control" placeholder="id_guru" />
                        <span class="glyphicon glyphicon-envelope form-control-feedback"> </span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" id="password" name="password"  class="form-control" placeholder="Password" />
                        <span class="glyphicon glyphicon-lock form-control-feedback"> </span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label> <input type="checkbox" /> Remember Me </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                
                <br />
               <a href="#" class="text-center">Apabila belum memiliki Username dan Password Silahkan Menghubungi Admin Sekolah Masing - Masing </a>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <!-- jQuery 3 -->
        <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="assets/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $("input").iCheck({
                    checkboxClass: "icheckbox_square-blue",
                    radioClass: "iradio_square-blue",
                    increaseArea: "20%" /* optional */,
                });
            });
        </script>
        <script src="assets/sweetalert/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function() {       
                $('#login-form').on('submit', function() {
                    var id_guru = $('#id_guru').val(); 
                    var password = $('#password').val();    
                    $.ajax({
                        url: "cek_login.php?aksi=cek_data",
                        type: "POST",
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
                            id_guru: id_guru
                        },
                        dataType: 'json',
                        success: function(json) {
                            if (json.status == 0) {
                                $.ajax({
                                    type: "post",
                                    url: "cek_login.php?aksi=cek_password",
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
                                        id_guru: id_guru,
                                        password: password
                                    }, 
                                    dataType: 'json',
                                    success: function(json) {
                                        if (json.status == 0) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Login Berhasil!',
                                                text: 'Anda akan di arahkan dalam 3 Detik',
                                                timer: 3000,
                                                showCancelButton: false,
                                                showConfirmButton: false
                                            })
                                            .then (function() {
                                                window.location.href = "index.php";
                                            });
                                        }
                                        if (json.status == 1) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Password Salah',
                                                text: 'Maaf Password yang anda masukkan salah',
                                                showConfirmButton: true,
                                                timer: 1500
                                            })
                                        }
                                    }
                                })
                                return false;                  
                            }
                            if (json.status == 1) {
                                 Swal.fire({
                                    icon: 'error',
                                    title: 'Guru Salah',
                                    text: 'Maaf Guru Salah Salah/Tidak Terdaftar'
                                });
                            }
                        }
                    });
                    return false;
                });
                
            });
        </script>
    </body>
</html>
