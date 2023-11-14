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
                    <a href="#" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal"
                        data-id="<?= $division['id_devisi']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Bootstrap Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this division?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="#" id="confirmDelete" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Set the data-id attribute for the delete button in the modal
        $('.delete-btn').on('click', function () {
            var divisionId = $(this).data('id');
            $('#confirmDelete').attr('href', '<?= base_url('admin/delete_division/'); ?>' + divisionId);
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Set the data-id attribute for the delete button in the modal
        $('.delete-btn').on('click', function () {
            var divisionId = $(this).data('id');
            $('#confirmDelete').attr('href', '<?= base_url('admin/delete_division/'); ?>' + divisionId);
        });

        // Hide delete and edit buttons for rows where division name is "CS" or "Satpam"
        $('table#example1 tbody tr').each(function () {
            var divisionName = $(this).find('td:eq(1)').text(); // Assuming division name is in the second column
            if (divisionName === "CS" || divisionName === "Satpam") {
                $(this).find('.delete-btn').hide();
                // If you have an edit button, hide it as well
                $(this).find('.edit-btn').hide();
            }
        });
    });
</script>