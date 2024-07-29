<!-- Modal -->
<div class="modal fade" id="ubahStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Status Pengaduan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="loading">
                </div>

                <div class="modal-ubah-status">
                    <form method="post" id="f_ubah_status" enctype="multipart/form-data">
                    <div class="form" >
                        <input type="text" name="id_tiket_aduan" id="id_tiket_aduan" hidden>
                        <div class="row mt-3">
                            <div class="col-4">
                                <label for="Desa" class="col-form-label">Status Pengaduan</label>
                            </div>
                            <div class="col">
                                <!-- <input type="password" id="Desa" class="form-control" aria-describedby="passwordHelpInline"> -->
                                <select class="form-select" name="status" aria-label="Default select example" id="status">
                                    <!-- <option value="">silahkan Pilih</option> -->
                                    <option value="diproses">Diproses</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="tidak_valid">Tidak Valid</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-4">
                                <label for="Desa" class="col-form-label">Berikan Keterangan</label>
                            </div>
                            <div class="col">
                                <textarea class="form-control" name="keterangan" id="" cols="91" rows="7"></textarea>
                            </div>
                        </div>

                        <div class="row mt-3" id="bukti_penyelesaian">
                            <div class="col-4">
                                <label for="Desa" class="col-form-label">Bukti Penyelesaian</label>
                            </div>
                            <div class="col">
                                <input type="file" accept="image/*" id="imageInput" name="bukti">
                            </div>
                        </div>

                        <div class="lokasi-btn">
                            <button class="btn btn-sm btn-primary">Simpan</button>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#bukti_penyelesaian').hide();
    // reset value
    $('#imageInput').val(null);

    // ambil nilai dari select
    $('#status').on('change', function() {
        if ($(this).val() == 'selesai') {
            $('#bukti_penyelesaian').show();
        } else {
            $('#bukti_penyelesaian').hide();
            $('#imageInput').val(null);
        }
    });
    
    $('#f_ubah_status').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'http://localhost:8080/StoreAduan/ubahStatus',
            type: 'POST',
            contentType: false,
            processData: false,
            // data: $('#f_aduan').serialize(),
            data: new FormData(this),
            success: function(res) {
                console.log(res);
                if (res.status == 'error') {
                    // masukkan pesan error ke dalam div
                    // $('#username_login_error').text(res.username);
                    // $('#password_login_error').text(res.password);
                } else {
                    // swall
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Status Berhasil Diubah',
                        showConfirmButton: true,
                        timer: 2000
                    })
                    .then((result) => {
                        $('#ubahStatus').modal('hide');
                        location.reload();
                    })
                }
            }
        });
    })
</script>