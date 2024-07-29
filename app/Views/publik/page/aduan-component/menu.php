<div class="menu">
    <div class="sub-1 <?php echo $retVal = ($params == 'aduan') ? 'active' : '' ;?>">
        <a href="<?= base_url()?>home/aduan">Semua</a>
    </div>
    <div class="sub-2 <?php echo $retVal = ($params == 'aduan-saya') ? 'active' : '' ;?>">
        <a href="<?= base_url()?>home/aduanSaya">
            Laporan Saya
        </a>
    </div>
</div>