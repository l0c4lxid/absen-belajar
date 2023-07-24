<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
</head>

<body>
    <h1>Welcome, User!</h1>
    <p>You are logged in as a user. You have access to the user dashboard.</p>

    <!-- Tambahkan link menuju halaman pengaturan profil user -->
    <a href="<?= base_url('profile/user'); ?>">Profile Settings</a>

    <a href="<?= base_url('logout'); ?>">Logout</a>
</body>

</html>