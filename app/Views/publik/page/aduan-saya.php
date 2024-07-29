<?= $this->extend('publik/index-page') ?>
<?= $this->section('content') ?>
<?= $this->include('publik/page/aduan-component/lihat-respon') ?>
<?= $this->include('publik/page/aduan-component/bukti-aduan') ?>

<div class="aduan">
    <div class="content">
        <div class="left">

            <?= $this->include('publik/page/aduan-component/menu') ?>
            <?php if ($data == null || $data == '[]') { ?>
                <div class="content-aduan-kosong">
                    Belum Ada Histori Aduan
                </div>
            <?php } ?>
            <?php foreach ($data as $aduan) : ?>
                <div class="content-aduan">
                    <div class="wraper-content-aduan">
                        <div class="list-aduan">
                            <div class="left-list-aduan">
                                <div class="foto-profile">
                                    <?php if ($profile['foto_profile'] == '') { ?>
                                        <img src="<?= base_url() ?>assets/profile/default.png" alt="" srcset="">
                                    <?php } else { ?>
                                        <img src="<?= base_url() ?>assets/profile/<?= $profile['foto_profile'] ?>" alt="" srcset="">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="right-list-aduan">
                                <div class="top-right">
                                    <div class="user">
                                        <?= $aduan['nama'] ?>
                                    </div>
                                    <div class="tanggal">
                                        <?= $aduan['tanggal_aduan'] ?>
                                    </div>
                                </div>
                                <div class="mid-right">
                                    <div class="judul-aduan">
                                        Kecamatan <?= $aduan['nama_kecamatan'] ?>, Kelurahan <?= $aduan['nama_kelurahan'] ?>
                                    </div>
                                    <div class="detail-lokasi-keterangan">
                                        <?= $aduan['detail_lokasi'] ?>
                                    </div>

                                    <div class="kordinat-pengaduan">
                                        <?php if ($aduan['is_in_location'] == "true") { ?>
                                            Koordinat = Lat: <?= $aduan['lat'] ?>, Long: <?= $aduan['lon'] ?>
                                        <?php } ?>
                                    </div>

                                    <div class="tombol mt-2">
                                        <button class="btn btn-sm btn-primary tombol-lihat" onclick="show_bukti('<?= $aduan['gambar'] ?>')">Lihat Foto</button>
                                        <?php if ($aduan['status'] == 'selesai') { ?>
                                            <button type="button" class="btn btn-sm btn-success tombol-bukti" onclick="show_bukti_penyelesaian('<?= $aduan['id_tiket_aduan'] ?>')">Bukti Perbaikan</button>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="bottom-right">
                                    <div class="title">
                                        Status Laporan :
                                    </div>
                                    <div class="status-laporan">
                                        <?php echo $retVal = ($aduan['status'] == '') ? 'Belum di proses' : $aduan['status']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            
            <div class="pagination">
                <?= $pager->links('aduan', 'bootstrap') ?>
            </div>
        </div>

        <div class="right">
            <?= $this->include('publik/page/aduan-component/mini-profile') ?>
        </div>


    </div>
</div>

<script>
    function show_bukti(id_gambar) {
        $('#bukti_gambar').attr('src', '<?= base_url() ?>gambar/' + id_gambar);
        $('#buktiAduanModal').modal('show');
    }

    function show_bukti_penyelesaian(id_tiket) {
        // console.log(id_tiket)
        $.ajax({
            url: 'http://localhost:8080/StoreAduan/findGambar',
            type: 'POST',
            data: {
                'id_tiket_aduan': id_tiket
            },
            //data: new FormData(this),
            success: function(response) {
                console.log(response);
                if (response.status == 'failed') {
                    Swal.fire({
                            icon: 'failure',
                            title: 'GAGAL',
                            text: 'GAMBAR TIDAK DITEMUKAN',
                            showConfirmButton: true,
                            timer: 4000
                        })
                        .then((result) => {
                            $('#ubahStatus').modal('hide');
                            location.reload();
                        })
                }
                $('#respon_gambar').attr('src', '<?= base_url() ?>gambar/' + response.gambar);
                $('#exampleModal').modal('show');
            }
        });
    }
</script>



<?= $this->endSection() ?>