<!-- app/Views/absensi/absen_keluar.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Absensi Keluar</title>
</head>
<?php
$session = session();
$successMsg = $session->getFlashdata('success');
$errorMsg = $session->getFlashdata('error_message');
if ($successMsg) {
    echo '<p style="color: green;">' . $successMsg . '</p>';
}
if ($errorMsg) {
    echo '<p style="color: red;">' . $errorMsg . '</p>';
}
?>

<body>
    <h2>Absensi Keluar</h2>
    <form action="<?= base_url('absensi/absen_keluar') ?>" method="post">
        <input type="submit" name="submit" value="Absen Keluar">
    </form>
</body>

</html>