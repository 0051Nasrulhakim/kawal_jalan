<?= $this->extend('admin/index') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="wrapper-laporan-selesai">
        <div class="title">
            Laporan laporan Selesai
        </div>
        <div class="filter">
            <?= $this->include('admin/component/filter') ?>
        </div>
        <table class="table table-striped table-laporan-masuk" id="table_laporanSelesai">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tiket Laporan</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th class="text-center">Status</th>
                    <th>Tanggal</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($data as $aduan) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $aduan['id_tiket_aduan'] ?></td>
                        <td><?= $aduan['nama_kecamatan'] ?></td>
                        <td><?= $aduan['nama_kelurahan'] ?></td>
                        <td class="text-center"><?php echo $retVal = ($aduan['status'] == '') ? 'Belum di proses' : $aduan['status']; ?></td>
                        <td><?= $aduan['tanggal_aduan'] ?></td>
                        <td class="text-center">
                            <a href="<?= base_url() ?>admin/detail/<?= $aduan['id_tiket_aduan'] ?>">
                                <div class="btn btn-sm btn-primary"> Detail </div>
                            </a>
                            <div class="btn btn-sm btn-warning" onclick="openModal('<?= $aduan['id_tiket_aduan'] ?>')">Ubah Status</div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#table_laporanSelesai').DataTable({
            dom: 'Bfrtip',
            paging: true,
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "Tous"]
            ],
            order: [
                [0, 'asc'],
                [1, 'asc']
            ],
            buttons: ['copy', 'csv', 'print'],
            rowGroup: {
                emptyDataGroup: 'Data Guru Tidak Ada'
            }
        });
    });
</script>
<?= $this->endSection(); ?>