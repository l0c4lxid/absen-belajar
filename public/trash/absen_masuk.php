<!-- app/Views/absensi/absen_masuk.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Absensi Masuk</title>
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
    <h2>Absensi Masuk</h2>
    <form action="<?= base_url('absensi/absen_masuk') ?>" method="post">
        <input type="submit" name="submit" value="Absen Masuk">
    </form>
</body>

</html>