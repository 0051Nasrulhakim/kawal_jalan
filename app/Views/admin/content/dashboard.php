<?= $this->extend('admin/index') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="wrapper-dashboard">
        <div class="laporan-masuk">
            <div class="title">
                Jumlah Laporan Masuk
            </div>
            <div class="contain">
                <div class="number">
                    <?= $jumlah_laporan_masuk; ?>
                </div>
                <div class="logo">
                    <i class="fa-solid fa-envelopes-bulk fa-3x"></i>
                </div>
            </div>
        </div>
        <div class="laporan-diproses">
            <div class="title">
                Laporan Diproses
            </div>
            <div class="contain">
                <div class="number">
                    <?= $jumlah_laporan_diproses; ?>
                </div>
                <div class="logo">
                    <i class="fa-solid fa-route fa-3x"></i>
                </div>
            </div>
        </div>
        <div class="laporan-selesai">
            <div class="title">
                Laporan Selesai
            </div>
            <div class="contain">
                <div class="number">
                    <?= $jumlah_laporan_selesai; ?>
                </div>
                <div class="logo">
                    <i class="fa-solid fa-envelope-circle-check fa-3x"></i>
                </div>
            </div>
        </div>
        <div class="laporan-selesai">
            <div class="title">
                Laporan Tidak Valid
            </div>
            <div class="contain">
                <div class="number">
                    <?= $jumlah_laporan_tidak_valid; ?>
                </div>
                <div class="logo">
                    <i class="fa-solid fa-circle-xmark fa-3x"></i>
                </div>
            </div>
        </div>

        <div class="laporan-selesai">
            <div class="title">
                Belum Direspon
            </div>
            <div class="contain">
                <div class="number">
                    <?= $jumlah_laporan_belum_direspon; ?>
                </div>
                <div class="logo">
                    <i class="fa-solid fa-circle-xmark fa-3x"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>