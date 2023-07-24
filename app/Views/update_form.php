<!DOCTYPE html>
<html>

<head>
    <title>Update Username and Password</title>
</head>

<body>
    <h1>Update Username and Password</h1>
    <?php if (isset($validation)): ?>
        <!-- Tampilkan pesan error jika validasi gagal -->
        <div>
            <?php echo $validation->listErrors(); ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <label for="new_username">New Username:</label>
        <input type="text" name="new_username" value="<?php echo isset($user) ? $user['username'] : ''; ?>"
            required><br>

        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required><br>

        <button type="submit">Update</button>
    </form>
    <a href="<?= base_url('dashboard'); ?>">Back to Dashboard</a>
</body>

</html>