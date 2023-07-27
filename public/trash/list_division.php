<!DOCTYPE html>
<html>

<head>
    <title>List of Divisions</title>
</head>

<body>
    <h1>List of Divisions</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Division Name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($divisions as $division): ?>
            <tr>
                <td>
                    <?= $division['id_devisi']; ?>
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
    </table>
</body>

</html>