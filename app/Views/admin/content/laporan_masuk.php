<?= $this->extend('admin/index') ?>
<?= $this->section('content') ?>

<?= $this->include('admin/modals/ubah-status') ?>
<div class="container">
    <div class="wrapper-laporan-masuk">
        <div class="title">
            Laporan Masuk
        </div>
        <div class="filter">
            <?= $this->include('admin/component/filter') ?>
        </div>
        <table class="table table-striped table-laporan-masuk" id="table_laporanMasuk">
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

                            <div class="btn btn-sm btn-primary"><a href="<?= base_url() ?>admin/detail/<?= $aduan['id_tiket_aduan'] ?>"> Detail </a></div>
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
        $('#table_laporanMasuk').DataTable({
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

    function openModal(id) {
        $('#id_tiket_aduan').val(id);
        $('#ubahStatus').modal('show');
    }
</script>

<?= $this->endSection(); ?>