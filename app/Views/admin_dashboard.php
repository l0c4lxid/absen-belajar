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

    <a href="<?= base_url('logout'); ?>">Logout</a>
</body>

</html>