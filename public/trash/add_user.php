<!DOCTYPE html>
<html>

<head>
    <title>Add User</title>
</head>
<?php
use App\Models\DevisiModel;

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

<body>
    <h1>Add User</h1>
    <form action="<?= base_url('admin/saveUser'); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" required><br>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" required><br>

        <label for="no_telp">No. Telepon:</label>
        <input type="text" name="no_telp" required><br>

        <label for="devisi">Devisi:</label>
        <select name="devisi" required>
            <?php
            $devisiModel = new DevisiModel();
            $devisiData = $devisiModel->findAll();
            foreach ($devisiData as $devisi) {
                echo '<option value="' . $devisi['devisi'] . '">' . $devisi['devisi'] . '</option>';
            }
            ?>
        </select><br>

        <button type="submit">Save</button>
    </form>
    <a href="<?= base_url('dashboard'); ?>">Dashboard</a>

</body>

</html>