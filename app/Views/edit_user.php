<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
</head>

<body>
    <h1>Edit User</h1>
    <form action="<?= base_url('admin/updateUser/' . $user['id_user']); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?= $user['username']; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Update</button>
    </form>
</body>

</html>