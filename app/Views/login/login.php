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
                    Portal Login Kawal Jalan
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

                <div class="form_register" hidden>
                    <form id="f_register">
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_register" name="nama_register" onkeyup="r_nama_register_e()">
                                <div class="form-text text-danger" id="nama_register_error"></div>
                            </div>  
                        </div>

                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-4 col-form-label">NIK</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nik_register" name="nik_register" onkeyup="r_nik_register_e()">
                                <div class="form-text text-danger" id="nik_register_error"></div>
                            </div>  
                        </div>

                        <!-- <div class="mb-3 row">
                            <label for="nama" class="col-sm-4 col-form-label">Tempat Tinggal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tempat_tinggal_register" name="tempat_tinggal_register" onkeyup="r_tempat_tinggal_register_e()">
                                <div class="form-text text-danger" id="tempat_tinggal_register_error"></div>
                            </div>  
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-4 col-form-label">Nomor HP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nomor_hp_register" name="nomor_hp_register" onkeyup="r_nomor_hp_register_e()">
                                <div class="form-text text-danger" id="nomor_hp_register_error"></div>
                            </div>  
                        </div> -->

                        <div class="mb-3 row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email_register" id="email_register" onkeyup="r_email_register_e()">
                                <!-- pesan error dengan label -->
                                <div class="form-text text-danger" id="email_register_error"></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="username" class="col-sm-4 col-form-label">username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="username_register" id="username_register" onkeyup="r_username_register_e()">
                                <div class="form-text text-danger" id="username_register_error"></div>
                            </div>
                        </div>
                        <div class="mb-5 row">
                            <label for="password" class="col-sm-4 col-form-label">password</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="password_register" id="password_register" onkeyup="r_password_register_e()">
                                <div class="form-text text-danger" id="password_register_error"></div>
                            </div>
                        </div>
                        <div class="button">
                            <div class="keterangan">
                                <div class="text-login">
                                    *sudah punya akun klik 
                                </div>
                                <div class="disini" onclick="disini_login()"> 
                                    Disini
                                </div>
                            </div>
                            <div class="tombol">
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <img src="<?= base_url()?>img/tulisan_pekalongan.png" alt="" srcset="">
    </div>
    <script>
        function disini_register(){
            document.getElementById('judul').innerHTML = "Register Portal Login Kawal Jalan";
            document.getElementsByClassName('form_login')[0].hidden = true;
            document.getElementsByClassName('form_register')[0].hidden = false;
            document.getElementById('nama_register').value = "";
            document.getElementById('nik_register').value = "";
            document.getElementById('email_register').value = "";
            document.getElementById('username_register').value = "";
            document.getElementById('password_register').value = "";
        }
        function disini_login(){
            document.getElementById('judul').innerHTML = "Login Portal Login Kawal Jalan";
            document.getElementsByClassName('form_login')[0].hidden = false;
            document.getElementsByClassName('form_register')[0].hidden = true;
            document.getElementById('username').value = "";
            document.getElementById('password').value = "";
        }

        $('#f_login').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'http://localhost:8080/login/login',
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
                            window.location.href = 'http://localhost:8080/home';
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
                            window.location.href = 'http://localhost:8080/home/dashboard';
                        }, 1000);
                    }
                }
            });
        })

        $('#f_register').submit(function(e) {
            var data =$('#f_register').serialize();
            console.log(data);
            // alert(data);
            e.preventDefault();
            $.ajax({
                url: 'http://localhost:8080/login/register',
                type: 'post',
                data: $('#f_register').serialize(),
                // data: new FormData(this),
                success: function(response) {
                    console.log(response);
                    if(response.status == 'error'){
                        // masukkan pesan error ke dalam div
                        $('#nama_register_error').text(response.errors.nama);
                        $('#nik_register_error').text(response.errors.nik);
                        $('#email_register_error').text(response.errors.email);
                        $('#username_register_error').text(response.errors.username);
                        $('#password_register_error').text(response.errors.password);
                    }
                    if(response.status == 'success'){
                        // swall
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Pendaftaran Berhasil Silahkan Login',
                            showConfirmButton: true,
                            
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "<?= base_url()?>login";
                            }
                        })
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