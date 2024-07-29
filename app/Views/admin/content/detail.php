<?= $this->extend('admin/index') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/modals/ubah-status') ?>

<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>/leaflet/leaflet.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/style.css">

<div class="container">
    <div class="wrapper-laporan-masuk">
        <div class="title">
            Detail Laporan
        </div>

        <div class="form-detail-laporan-masuk">
            <div class="left">

                <div class="row mt-3">
                    <div class="col-3">
                        <label for="status" class="col-form-label">Status Aduan</label>
                    </div>
                    <div class="col-5   ">
                        <input type="text" id="status" class="form-control" name="status" readonly value="<?php echo $retVal = ($data['status'] == '') ? 'Belum di proses' : $data['status']; ?>">
                    </div>
                    <div class="col">
                        <div class="btn btn-sm btn-warning" onclick="openModal('<?= $data['id_tiket_aduan'] ?>')">Ubah Status</div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <label for="noTiket" class="col-form-label">No Tiket</label>
                    </div>
                    <div class="col">
                        <input type="text" id="noTiket" class="form-control" name="noTiket" readonly value="<?= $data['id_tiket_aduan'] ?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <label for="kecamatan" class="col-form-label">Kecamatan</label>
                    </div>
                    <div class="col">
                        <input type="text" id="kecamatan" class="form-control" name="kecamatan" readonly value="<?= $data['nama_kecamatan'] ?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <label for="desa" class="col-form-label">Desa</label>
                    </div>
                    <div class="col">
                        <input type="text" id="desa" class="form-control" name="desa" readonly value="<?= $data['nama_kelurahan'] ?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <label for="identitas" class="col-form-label">identitas</label>
                    </div>
                    <div class="col">
                        <input type="text" id="identitas" class="form-control" name="identitas" readonly value="<?php echo $retVal = ($data['is_anonymous'] == 'true') ? 'Anonim' : $identitas['nama']; ?>">
                    </div>
                </div>
                <!-- 
                <div class="row mt-3">
                    <div class="col-3">
                        <label for="beradaDiTp" class="col-form-label">Berada Di TKP</label>
                    </div>
                    <div class="col">
                        <input type="text" id="beradaDiTp" class="form-control" name="beradaDiTp" readonly value="<?= $data['is_in_location'] ?>">
                    </div>
                </div> -->
                <div class="row mt-3">
                    <div class="col-3">
                        <label for="beradaDiTp" class="col-form-label">Kordinat</label>
                    </div>
                    <div class="col">
                        <input type="text" id="beradaDiTp" class="form-control" name="beradaDiTp" readonly value="<?= $data['lat'] . ',' . $data['lon'] ?>">
                    </div>
                </div>

            </div>
            <div class="right">

                <div class="row mt-3">
                    <div class="col-3">
                        <label for="tanggal" class="col-form-label">Tanggal Aduan</label>
                    </div>
                    <div class="col">
                        <input type="text" id="tanggal" class="form-control" name="tanggal" readonly value="<?= $data['tanggal_aduan'] ?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <label for="Desa" class="col-form-label">Detail Lokasi & Keterangan</label>
                    </div>
                    <div class="col">
                        <textarea class="form-control" name="detail_lokasi" id="" cols="91" rows="7" readonly> <?= $data['detail_lokasi'] ?></textarea>
                    </div>
                </div>

            </div>

        </div>
        <div class="riwayat-laporan">
            <div class="title-riwayat mt-2">
                Riwayat Laporan
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td width="20%">Tanggal</td>
                        <td width="20%">Status</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $data['tanggal_aduan'] ?></td>
                        <td>Laporan Masuk</td>
                        <td>-</td>
                    </tr>
                    <?php foreach ($riwayat as $riwayat_aduan) : ?>
                        <tr>
                            <td><?= $riwayat_aduan['tanggal_diubah'] ?></td>
                            <td>Laporan <?= $riwayat_aduan['status'] ?></td>
                            <td><?= $riwayat_aduan['keterangan'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="section">
            <div class="gambar">
                <div class="title-gambar">
                    Bukti Laporan
                </div>
                <img class="img" src="<?= base_url() ?>gambar/<?= $data['gambar'] ?>" alt="" srcset="" width="518px">
            </div>
            <div class="maps">
                <div class="title-gambar">
                    Lokasi
                </div>
                <div class="peta" id="peta" style="height: 510px; width: 100%">
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function openModal(id) {
        $('#id_tiket_aduan').val(id);
        $('#ubahStatus').modal('show');
    }
</script>
<script type="text/javascript">
    var map = L.map('peta')
        .setView([<?= $data['lat'] ?>, <?= $data['lon'] ?>], 14);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var popupContent = "<div style='text-align: center;'><div style='font-weight: bold;'>" +
        "Kecamatan : <?= $data['nama_kecamatan'] ?>" + "<br>" +
        "Kelurahan : <?= $data['nama_kelurahan'] ?>" + "<br>" +
        "Detail Lokasi : <?= $data['detail_lokasi'] ?>" + "<br>" +
        "Koordinat : <?= $data['lat'] ?>, <?= $data['lon'] ?>" +
        "<br><button class='btn btn-sm btn-primary' onclick='redirectToGoogleMaps(<?= $data['lat'] ?>, <?= $data['lon'] ?>)'>Buka di Google Maps</button>" +
        "</div></div>";

    function redirectToGoogleMaps(lat, lon) {
        var url = `https://www.google.com/maps?q=${lat},${lon}`;
        window.location.href = url;
    }

    var marker = L.marker([<?= $data['lat'] ?>, <?= $data['lon'] ?>])
        .bindPopup(popupContent).addTo(map);

    marker.on('click', function() {
        map.flyTo([<?= $data['lat'] ?>, <?= $data['lon'] ?>], 16);
    })
    map.zoomControl.setPosition('bottomright');
</script>
<?= $this->endSection(); ?>