<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/publik.css">
    <title>Testing Pengaduan Jalan</title>
</head>

<body>
    <div class="top-nav">
        <div class="wrapper">
            <div class="logo">Kawal Jalan</div>
            <div class="menu">
                <div class="menu-1">Daftar Aduan</div>
                <div class="menu-2">Riwayat</div>
                <div class="menu-3">Profile</div>
            </div>
        </div>
    </div>

    <div class="middle" >
        <div class="wrapper">.
            
            <div class="title">
                PORTAL LAYANAN PENGADUAN JALAN RUSAK DI WILAYAH KOTA PEKALONGAN
            </div>
            <div class="title-2">
                Sampaikan Aduan Anda Di sini
            </div>

            <div class="form" >
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
                                <input type="password" id="kecamatan" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="Desa" class="col-form-label">Desa</label>
                            </div>
                            <div class="col">
                                <input type="password" id="Desa" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="Desa" class="col-form-label">Detail Lokasi</label>
                            </div>
                            <div class="col">
                                <textarea class="form-control" name="detail_lokasi" id="" cols="91" rows="7"></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="Desa" class="col-form-label">Ambil Gambar</label>
                            </div>
                            <div class="col">
                                <input type="file" accept="image/*" capture="camera" id="imageInput" name="image">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2">
                                <label for="Desa" class="col-form-label">Rahasiakan</label>
                            </div>

                            <div class="col" style="display: flex;flex-direction: column;">
                                <div class="col">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Biarkan Identitas Terlihat
                                    </label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Sembunyikan Identitas
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <button class="btn btn-sm btn-primary" onclick="getKoordinat()">
                                Buat Laporan
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- <div class="lokasi" id="lokasi"></div> -->


        </div>
    </div>

    <div class="footer" style="margin-top: 32%;">
        <div class="wrapper">
            sasasa
        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script>
    function getKoordinat() {
        if (navigator.geolocation) {
            var options = {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: 15000
            };
            var izin = navigator.geolocation.getCurrentPosition(showPosition, showError, options);
            console.log(izin)
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
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

        var lokasi = document.getElementById('lokasi')
        lokasi.innerHTML = "Latitude: " + latitude + ", Longitude: " + longitude;
        console.log(longitude)
    }

    $(document).ready(function() {
        getKoordinat();
    });
</script>

</html>