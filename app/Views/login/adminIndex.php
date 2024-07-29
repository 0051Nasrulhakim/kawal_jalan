<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
</head>
<body>
    <div class="wrapper">
        <div class="section">
            <div class="side_left">
                <img src="<?= base_url()?>img/logo_pekalongan.png" alt="" srcset="">
            </div>
            <div class="side_right">
                <div class="judul_login" id="judul">
                    Admin Login Kawal Jalan
                </div>
                <div class="form_login" style="margin-top: 15%;">
                    <form id="f_login">
                        <div class="mb-3 row">
                            <label for="username" class="col-sm-3 col-form-label">username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" name="username" onkeyup="r_username_login_e()">
                                <div class="form-text text-danger" id="username_login_error"></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password" onkeyup="r_password_login_e()">
                                <div class="form-text text-danger" id="password_login_error"></div>
                            </div>
                        </div>
                        <div class="button" style="margin-top: 10%;">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="keterangan">
                            *Bagi yang belum mempunyai akun silahkan klik <div class="disini" onclick="disini_register()">register</div>
                        </div>
                    </form>
                </div>

                
            </div>
        </div>
        <img src="<?= base_url()?>img/tulisan_pekalongan.png" alt="" srcset="">
    </div>
    <script>

        $('#f_login').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'http://localhost:8080/login/loginAdmin',
                type: 'POST',
                data: $('#f_login').serialize(),
                //data: new FormData(this),
                success: function(res_login) {
                    console.log(res_login);
                    if(res_login.status == 'error'){
                        // masukkan pesan error ke dalam div
                        $('#username_login_error').text(res_login.username);
                        $('#password_login_error').text(res_login.password);
                    }else if(res_login.status == 'akun tidak aktiv'){
                        // swall
                        Swal.fire({
                            icon: 'error',
                            title: 'AKUN TIDAK AKTIV',
                            text: 'AKUN ANDA TIDAK AKTIV / TERBANED',
                            showConfirmButton: false,
                            // timer: 1500
                        })
                        // redirect
                        setTimeout(function() {
                            window.location.href = 'http://localhost:8080/login/adminIndex';
                        }, 3000);
                    }else{
                        // swall
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Login Berhasil',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        // redirect
                        setTimeout(function() {
                            window.location.href = 'http://localhost:8080/admin';
                        }, 1000);
                    }
                }
            });
        })
        function r_nama_register_e(){
            $('#nama_register_error').text('');
        }
        function r_nik_register_e(){
            $('#nik_register_error').text('');
        }
        function r_email_register_e(){
            $('#email_register_error').text('');
        }
        function r_username_register_e(){
            $('#username_register_error').text('');
        }
        function r_password_register_e(){
            $('#password_register_error').text('');
        }
        function r_password_login_e(){
            $('#password_login_error').text('');
        }
        function r_username_login_e(){
            $('#username_login_error').text('');
        }

    </script>
</body>
</html>