<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
</head>

<body>
    <h1>Welcome, Admin!</h1>
    <p>You are logged in as an admin. You have access to the admin dashboard.</p>

    <!-- Tambahkan link menuju halaman pengaturan profil admin -->
    <a href="<?= base_url('profile/admin'); ?>">Profile Settings</a>
    <a href="<?= base_url('admin/add_user'); ?>">Add User</a>
    <a href="<?= base_url('admin/list_user_level_two'); ?>">List Users (Level 2)</a>
    <a href="<?= base_url('logout'); ?>">Logout</a>
</body>
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

</html>