<!-- Make sure to include the AdminLTE CSS file in your HTML -->
<!-- For example: -->
<!-- <link rel="stylesheet" href="path/to/adminlte.css"> -->

<!-- Include DataTables CSS -->


<table id="example1" class="table table-bordered">
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
                    <?= $division['keterangan']; ?>
                </td>
                <td>
                    <a href="<?= base_url('admin/delete_division/' . $division['id_devisi']); ?>"
                        onclick="return confirm('Are you sure you want to delete this division?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>