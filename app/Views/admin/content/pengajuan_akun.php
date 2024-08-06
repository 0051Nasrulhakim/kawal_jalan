<?= $this->extend('admin/index') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/modals/status-akun') ?>
<div class="container">
    <div class="wrapper-laporan-Tidak-Valid">
        <div class="title">
            Pengajuan Pembuatan Akun
        </div>
        <?= $this->include('admin/component/menuKelolaAkun') ?>
        <table class="table table-striped table-laporan-masuk" id="table_laporanTidakValid">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Status Akun</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($data as $akun) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $akun['username'] ?></td>
                        <td><?= $akun['nama'] ?></td>
                        <td class="<?php if($akun['status_akun'] == 'tidak_aktiv') echo('bg-danger text-white')?>"><?= $akun['status_akun'] ?></td>
                        <td class="text-center"><?= $akun['email'] ?></td>
                        <td class="text-center">
                            <div class="btn btn-sm btn-warning" onclick="openModal('<?= $akun['id_user'] ?>')">Ubah Status</div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#table_laporanTidakValid').DataTable({
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