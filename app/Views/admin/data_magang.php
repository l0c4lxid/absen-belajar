<!-- Make sure to include the AdminLTE CSS file in your HTML -->
<!-- For example: -->
<!-- <link rel="stylesheet" href="path/to/adminlte.css"> -->

<!-- Include DataTables CSS -->

<table id="example1" class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">No.</th>
            <th class="text-center">ID</th>
            <th>Username</th>
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
                    <?= $no++ ?>
                </td>
                <td class="text-center">
                    <?= $user['id_user']; ?>
                </td>
                <td>
                    <?= $user['username']; ?>
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
                    <?= $user['devisi']; ?>
                </td>
                <td class="text-center">
                    <a class="btn btn-primary" href="<?= base_url('admin/edit_user/' . $user['id_user']); ?>"><i
                            class="fas fa-edit"></i> Edit</a>
                    <a class="btn btn-danger" href="<?= base_url('admin/delete_user/' . $user['id_user']); ?>"
                        onclick="return confirm('Are you sure you want to delete this user?')"><i class="fas fa-trash"></i>
                        Hapus</a>
                </td>
                <!-- Tambahkan kolom lain sesuai kebutuhan -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>