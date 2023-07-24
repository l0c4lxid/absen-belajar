<!DOCTYPE html>
<html>

<head>
    <title>Admin Profile</title>
</head>

<body>
    <h1>Admin Profile</h1>
    <form action="<?= base_url('profile/save_admin'); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?= $userUsername; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Save</button>
    </form>
    <a href="<?= base_url('dashboard'); ?>">Back to Dashboard</a>
</body>

</html>