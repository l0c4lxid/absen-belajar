<!DOCTYPE html>
<html>

<head>
    <title>User List (Level 2)</title>
</head>

<body>
    <h1>User List (Level 2)</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>nama</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Devisi</th>
            <th>Edit</th>
            <th>Hapus</th>
            <!-- Tambahkan kolom lain sesuai kebutuhan -->
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
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
                <td><a href="<?= base_url('admin/edit_user/' . $user['id_user']); ?>">Edit</a></td>
                <td><a href="<?= base_url('admin/delete_user/' . $user['id_user']); ?>"
                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</a></td>
                <!-- Tambahkan kolom lain sesuai kebutuhan -->
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="<?= base_url('admin'); ?>">kembali</a>
</body>

</html>