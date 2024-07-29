<div class="profile">
    <div class="top">
        <div class="left-profile">
            <div class="foto-profile">
                <?php if($profile['foto_profile'] == ''){?>
                    <img src="<?= base_url()?>assets/profile/default.png" alt="" srcset="">
                <?php }else{?>
                    <img src="<?= base_url()?>assets/profile/<?= $profile['foto_profile'] ?>" alt="" srcset="">
                <?php }?>
            </div>
        </div>
        <div class="right-profile">
            <div class="nama">
                <?= session()->get('nama') ?>
            </div>
            <div class="ubah-profile">
                <button class="btn btn-sm btn-warning">
                    <a href="<?= base_url() ?>home/profile">
                        Ubah Profile
                    </a>
                </button>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="logo-aduan">
            <div class="logo-total-aduan">
                Total
            </div>
            <div class="logo-diproses-aduan">
                Diproses
            </div>
            <div class="logo-selesai-aduan">
                Selesai
            </div>
        </div>
        <div class="jumlah-aduan">
            <div class="total-aduan">
                <?= $jml_aduan_saya; ?>
            </div>
            <div class="diproses-aduan">
                <?= $jml_aduan_saya_diproses; ?>
            </div>
            <div class="selesai-aduan">
                <?= $jml_aduan_saya_selesai; ?>
            </div>
        </div>
    </div>
</div>