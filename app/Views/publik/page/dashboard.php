<?= $this->extend('publik/index-dashboard') ?>
<?= $this->section('content') ?>

<div class="middle">
    <div class="wrapper">.

        <div class="title">
            PORTAL LAYANAN PENGADUAN JALAN RUSAK DI WILAYAH KOTA PEKALONGAN
        </div>
        <div class="title-2">
            Sampaikan Aduan Anda Di sini
        </div>

        <div class="form">

            <!-- buatkan form untuk upload gambar  -->
            <form id="f_aduan" method="post" enctype="multipart/form-data">

                <div class="contain">
                    <div class="judul">
                        Form Pengaduan Jalan
                    </div>

                    <div class="form-setion">
                        <div class="section-latlon">
                            <div class="text">
                                Koordinat sekarang
                            </div>
                            <div class="samadengan text-center">
                                =
                            </div>
                            <div class="value-latlon">
                                <div class="lokasi" id="lokasi"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="kecamatan" class="col-form-label">Kecamatan</label>
                            </div>
                            <div class="col">
                                <select class="form-select" name="kecamatan" id="kecamatan">
                                    <option selected disabled>Pilih Kecamatan</option>
                                    <?php foreach ($kecamatan as $kec) : ?>
                                        <option value="<?= $kec['id_wilayah'] ?>"><?= $kec['nama_kecamatan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- <input type="text" id="kecamatan" class="form-control" name="kecamatan" onkeyup="hapusError('kecamatan')"> -->
                                <input type="text" id="latInput" class="form-control" name="lat" hidden>
                                <input type="text" id="lonInput" class="form-control" name="lon" hidden>
                                <div class="form-text text-danger" id="kecamatan_error"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="Desa" class="col-form-label">Desa / kelurahan</label>
                            </div>
                            <div class="col">
                                <!-- <input type="text" id="Desa" class="form-control" name="desa" onkeyup="hapusError('desa')"> -->
                                <select name="desa" id="desa" class="form-select">
                                    <option selected disabled>Pilih Desa / kelurahan</option>

                                </select>
                                <div class="form-text text-danger" id="desa_error"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="Desa" class="col-form-label">Detail Lokasi & Keterangan</label>
                            </div>
                            <div class="col">
                                <textarea class="form-control" name="detail_lokasi" id="" cols="91" rows="7" onkeyup="hapusError('detail_lokasi')"></textarea>
                                <div class="form-text text-danger" id="detail_lokasi_error"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="Desa" class="col-form-label">Ambil Gambar</label>
                            </div>
                            <div class="col">
                                <input type="file" accept="image/*" capture="camera" id="imageInput" name="image" onchange="hapusError('image')">
                                <div class="form-text text-danger" id="image_error"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="Desa" class="col-form-label">Rahasiakan</label>
                            </div>

                            <div class="col" style="display: flex;flex-direction: column;">
                                <div class="col">
                                    <input class="form-check-input" type="radio" name="identitas" value="false" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Biarkan Identitas Terlihat
                                    </label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="radio" name="identitas" value="true" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Sembunyikan Identitas
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row mt-3">
                            <div class="col-2">
                                <label for="Desa" class="col-form-label">Apakah Anda Di TKP.?</label>
                            </div>

                            <div class="col" style="display: flex;flex-direction: column;">
                                <div class="col">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault-tkp" value="true" id="flexRadioDefault3" checked>
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Saya Berada Di TKP
                                    </label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault-tkp" value="false" id="flexRadioDefault4">
                                    <label class="form-check-label" for="flexRadioDefault4">
                                        Saya Tidak Berada Di TKP
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="row mt-3">
                            <button class="btn btn-sm btn-primary" type="submit">
                                Buat Laporan
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>
        <!-- <div class="lokasi" id="lokasi"></div> -->


    </div>
</div>

<script>
    function getKoordinat() {
        if (navigator.geolocation) {
            var options = {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: 10000 
            };
            var izin = navigator.geolocation.getCurrentPosition(showPosition, showError, options);
            console.log(izin)
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }

    // ketika kecamatan berubah maka lakukan ajax mencari kelurahan
    $('#kecamatan').change(function() {
        getKelurahan();
    });

    function getKelurahan() {
        var kecamatan = $('#kecamatan').val();
        var baseUrl = 'http://localhost:8080/home/getKelurahan/'
        $.ajax({
            url: baseUrl + kecamatan,
            type: 'POST',
            data: {
                kecamatan: kecamatan
            },
            success: function(data) {
                // Misalkan data yang diterima adalah array JSON berisi objek kelurahan
                var kelurahanOptions = '';
                $.each(data, function(index, kelurahan) {
                    kelurahanOptions += '<option value="' + kelurahan.id_kelurahan + '">' + kelurahan.nama_kelurahan + '</option>';
                });

                // Tambahkan kelurahanOptions ke dalam select kelurahan
                $('#desa').html(kelurahanOptions);
            }
        });
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                console.log("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                console.log("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                console.log("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                console.log("An unknown error occurred.");
                break;
        }
    }

    function showPosition(position) {

        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        var accuracy = position.coords.accuracy;
        console.log(longitude, accuracy)

        var lokasi = document.getElementById('lokasi')
        lokasi.innerHTML = "Latitude: " + latitude + ", Longitude: " + longitude + "akurasi" + accuracy;
        
    }

    $(document).ready(function() {
        getKoordinat();
    });
</script>

<script>
    $('#f_aduan').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'http://localhost:8080/StoreAduan/insert_aduan',
            type: 'POST',
            contentType: false,
            processData: false,
            // data: $('#f_aduan').serialize(),
            data: new FormData(this),
            success: function(res) {
                console.log(res);
                if (res.status == 'error') {
                    console.log('error bro')
                    // masukkan pesan error ke dalam div
                    $('#kecamatan_error').text(res.errors.kecamatan);
                    $('#desa_error').text(res.errors.desa);
                    $('#detail_lokasi_error').text(res.errors.detail_lokasi);
                    $('#image_error').text(res.errors.image);
                } else {
                    // swall
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Berhasil Membuat Aduan',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    // redirect
                    setTimeout(function() {
                        window.location.href = 'http://localhost:8080/home/aduanSaya';
                    }, 2500);
                }
            }
        });
    })

    function hapusError(id) {
        $('#' + id + '_error').text('');
    }
</script>


<?= $this->endSection(); ?>