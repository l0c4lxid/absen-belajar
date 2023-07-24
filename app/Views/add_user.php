<!DOCTYPE html>
<html>

<head>
    <title>Add User</title>
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
    <h1>Add User</h1>
    <form action="<?= base_url('admin/saveUser'); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Save</button>
    </form>
    <a href="<?= base_url('dashboard'); ?>">dashboard</a>

</body>

</html>