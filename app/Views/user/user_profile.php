<!DOCTYPE html>
<html>

<head>
    <title>User Profile</title>
</head>
<?php
$session = session();
$successMsg = $session->getFlashdata('success');
if ($successMsg) {
    echo '<p style="color: green;">' . $successMsg . '</p>';
}
?>

<body>
    <h1>User Profile</h1>
    <form action="<?= base_url('profile/save_user'); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?= $userUsername; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Save</button>
    </form>
    <a href="<?= base_url('dashboard'); ?>">Back to Dashboard</a>
</body>

</html>