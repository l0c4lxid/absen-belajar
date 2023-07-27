<!DOCTYPE html>
<html>

<head>
    <title>Add Division</title>
</head>
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

<body>
    <h1>Add Division</h1>
    <form action="<?= base_url('admin/save_division'); ?>" method="post">
        <label for="division_name">Division Name:</label>
        <input type="text" name="devisi" required><br>

        <!-- Tambahkan kolom lain sesuai kebutuhan -->

        <button type="submit">Add Division</button>
    </form>
</body>
<a href="<?= base_url('dashboard'); ?>">dashboard</a>

</html>