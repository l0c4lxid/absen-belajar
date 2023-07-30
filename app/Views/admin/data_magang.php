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
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Devisi</th>
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
                                <?= $user['alamat']; ?>
                            </td>
                            <td>
                                <?= $user['no_telp']; ?>
                            </td>
                            <td>
                                <?= $user['keterangan']; ?>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-warning" href="<?= base_url('admin/edit_user/' . $user['id_user']); ?>"><i
                                        class="fas fa-edit"></i> Edit</a>
                                <a class="btn btn-danger" href="<?= base_url('admin/delete_user/' . $user['id_user']); ?>"
                                    onclick="return confirm('Are you sure you want to delete this user?')"><i
                                        class="fas fa-trash"></i>
                                    Hapus</a>
                            </td>
                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>