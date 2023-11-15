<!-- Include DataTables CSS -->
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data
                <?= $judul ?>
            </h3>
            <div class="card-tools">
                <a class="btn btn-primary" href="<?= base_url('admin/TambahUser/'); ?>"><i class="fas fa-plus"></i>
                    Tambah
                </a>
            </div>
            <!-- /.card-tools -->
        </div>
        <div class="card-body">
            <?php
            $session = session();
            $successMsg = $session->getFlashdata('success');
            $errorMsg = $session->getFlashdata('error');
            if ($successMsg) {
                echo '<p style="color: green;">' . $successMsg . '</p>';
            }
            if ($errorMsg) {
                echo '<p style="color: red;">' . $errorMsg . '</p>';
            }
            ?>
            <table id="example2" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>No Telepon</th>
                        <th class='text-center'>Devisi</th>
                        <th class='text-center'>Jam Kerja</th>
                        <th class='text-center'>Atur</th>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($users as $user): ?>
                        <tr>
                            <td class="text-center">
                                <?= $no++ ?>.
                            </td>
                            <td>
                                <?= $user['nama']; ?>
                            </td>
                            <td>
                                <?= $user['username']; ?>
                            </td>
                            <td>
                                <?= $user['no_telp']; ?>
                            </td>
                            <td class='text-center'>
                                <?= $user['keterangan']; ?>
                            </td>
                            <td class='text-center'>
                                <?= $user['shift']; ?>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-warning" href="<?= base_url('admin/edit_user/' . $user['id_user']); ?>"><i
                                        class="fas fa-edit"></i> Edit</a>
                                <button class="btn btn-flat btn-danger" data-toggle="modal"
                                    data-target="#modal-hapus<?= $user['id_user'] ?>"><i class="fas fa-trash">
                                        Hapus</i></button>
                            </td>
                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php foreach ($users as $key => $user) { ?>
    <div class="modal fade" id="modal-hapus<?= $user['id_user'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus
                        <?= $judul ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Ingin Hapus Data ?<br>
                    <b>
                        <?= $user['nama'] ?>
                    </b>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

                    <a href="<?= base_url('admin/delete_user/' . $user['id_user']) ?>" class="btn btn-danger">Hapus</a>

                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
<?php } ?>