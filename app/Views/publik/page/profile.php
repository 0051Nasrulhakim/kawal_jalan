<?= $this->extend('publik/index-page') ?>
<?= $this->section('content') ?>
<div class="middle">
    <div class="wrapper">.
        <div class="profile-wrapper">
            <div class="left-profile">
                <div class="form-profile">
                    <form id="f_profile" enctype="multipart/form-data">

                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="username" class="col-form-label">Username</label>
                            </div>
                            <div class="col">
                                <input type="text" id="username" class="form-control" name="username" onkeyup="hapusError('username')" value="<?= $data['username']; ?>">
                                <div class="form-text text-danger" id="username_error"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="password" class="col-form-label">Password</label>
                            </div>
                            <div class="col">
                                <input type="password" id="password" class="form-control" name="password" onkeyup="hapusError('password')">
                                <div class="form-text text-danger" id="password_error"></div>
                                <div class="form-text" id="password_error">*Jika Tidak Ingin merubah password silahkan dikosongkan</div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="nama" class="col-form-label">Nama</label>
                            </div>
                            <div class="col">
                                <input type="text" id="nama" class="form-control" name="nama" onkeyup="hapusError('nama')" value="<?= $data['nama']; ?>">
                                <div class="form-text text-danger" id="nama_error"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="nik" class="col-form-label">NIK</label>
                            </div>
                            <div class="col">
                                <input type="number" id="nik" class="form-control" name="nik" onkeyup="hapusError('nik')" value="<?= $data['nik']; ?>">
                                <div class="form-text text-danger" id="nik_error"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="tempat_tinggal" class="col-form-label">Tempat Tinggal</label>
                            </div>
                            <div class="col">
                                <input type="text" id="tempat_tinggal" class="form-control" name="tempat_tinggal" onkeyup="hapusError('tempat_tinggal')" value="<?= $data['tempat_tinggal']; ?>">
                                <div class="form-text text-danger" id="tempat_tinggal_error"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="email" class="col-form-label">Email</label>
                            </div>
                            <div class="col">
                                <input type="text" id="email" class="form-control" name="email" onkeyup="hapusError('email')" value="<?= $data['email']; ?>">
                                <div class="form-text text-danger" id="email_error"></div>
                            </div>
                        </div>

                        <div class="lokasi-btn">
                            <button class="btn btn-sm btn-primary" type="submit">Ubah Profile</button>
                        </div>
                </div>
                </form>
            </div>
            <div class="right-profile">
                <div class="gambar-profile">
                    <?php if ($data['foto_profile'] == '') { ?>
                        <img src="<?= base_url() ?>assets/profile/default.png" alt="" srcset="">
                    <?php } else { ?>
                        <img src="<?= base_url() ?>assets/profile/<?= $data['foto_profile']; ?>" alt="" srcset="">
                    <?php } ?>
                </div>
                <form id="f_foto" enctype="multipart/form-data">

                    <div class="tombol-ubah-foto">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupFile02">Ubah Foto</label>
                            <input type="file" name="fp" class="form-control" id="inputGroupFile02" accept=".jpg,.jpeg">
                        </div>
                    </div>
                    <div class="tombol-ubah-foto">
                        <div class="lokasi-btn">
                            <button class="btn btn-sm btn-primary" type="submit">Upload</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#f_profile').submit(function(e) {
        e.preventDefault();
        //var formData = new FormData(this);
        $.ajax({
            url: 'http://localhost:8080/Home/updateProfile',
            type: 'POST',
            data: $('#f_profile').serialize(),
            //data: new FormData(this),
            success: function(response) {
                // your code here
                console.log(response)
                if (response.status == 'error') {
                    $('#username_error').text(response.errors.username);
                    $('#password_error').text(response.errors.password);
                    $('#nama_error').text(response.errors.nama);
                    $('#nik_error').text(response.errors.nik);
                    $('#tempat_tinggal_error').text(response.errors.tempat_tinggal);
                    $('#email_error').text(response.errors.email);
                } else {

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Berhasil Mengubah Profile',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    // redirect
                    setTimeout(function() {
                        window.location.href = 'http://localhost:8080/home/profile';
                    }, 2500);
                }
            }
        });
    })

    function hapusError(id) {
        $('#' + id + '_error').text('');
    }

    $('#f_foto').submit(function(e) {
        e.preventDefault();
        //var formData = new FormData(this);
        $.ajax({
            url: 'http://localhost:8080/Home/ubahFoto',
            type: 'POST',
            contentType: false,
            processData: false,
            // data: $('#f_foto').serialize(),
            data: new FormData(this),
            success: function(response) {
                // your code here
                console.log(response)
                if (response.status == 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'GAGAL',
                        text: response.data,
                        showConfirmButton: false,
                        timer: 3500
                    })
                    // redirect
                    setTimeout(function() {
                        window.location.href = 'http://localhost:8080/home/profile';
                    }, 3500);
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.data,
                        showConfirmButton: false,
                        timer: 3500
                    })
                    // redirect
                    setTimeout(function() {
                        window.location.href = 'http://localhost:8080/home/profile';
                    }, 3500);
                }
            }
        });
    })

</script>
<?= $this->endSection() ?>