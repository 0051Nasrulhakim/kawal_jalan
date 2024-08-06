<div class="list-menu-kelola-akun">
    <button class="btn btn-sm <?= ($lokasi == 'pengajuanakun') ? 'btn-warning' : 'btn-primary'?>"><a href="<?= base_url() ?>admin/pengajuanAkun" style="color: white; text-decoration: none"> Pengajuan akun </a> </button>
    <button class="btn btn-sm <?= ($lokasi == 'kelolaakun') ? 'btn-warning' : 'btn-primary'?>"><a href="<?= base_url() ?>admin/kelolaAkun" style="color: white; text-decoration: none;?>"> Daftar akun publik </a></button>
</div>