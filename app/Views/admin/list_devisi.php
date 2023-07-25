<!-- Make sure to include the AdminLTE CSS file in your HTML -->
<!-- For example: -->
<!-- <link rel="stylesheet" href="path/to/adminlte.css"> -->

<!-- Include DataTables CSS -->

<table id="example1" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Devisi</th>
            <th>Action</th>
            <!-- Tambahkan kolom lain sesuai kebutuhan -->
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($divisions as $division): ?>
            <tr>
                <td>
                    <?= $no++ ?>
                </td>
                <td>
                    <?= $division['devisi']; ?>
                </td>
                <td>
                    <a href="<?= base_url('admin/delete_division/' . $division['id_devisi']); ?>"
                        onclick="return confirm('Are you sure you want to delete this division?')">Delete</a>
                </td>
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