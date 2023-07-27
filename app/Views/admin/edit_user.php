<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
</head>
<?php
use App\Models\DevisiModel;

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
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-left text-primary">
                <div class="row">
                    <div class="col-md-6">

                        <form action="<?= base_url('admin/updateUser/' . $users['id_user']); ?>" method="post">
                            <div class='form-group'>
                                <label for="nama">nama:</label>
                                <input class="form-control" type="text" name="nama" value="<?= $users['nama']; ?>"
                                    required>
                            </div>
                    </div>
                    <div class="col-md-6">

                        <div class='form-group'>

                            <label for="username">Username:</label>
                            <input class="form-control" type="text" name="username" value="<?= $users['username']; ?>"
                                required><br>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class='form-group'>

                            <label for="password">Password:</label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class='form-group'>
                            <label for="alamat">Alamat:</label>
                            <input class="form-control" type="text" name="alamat" value="<?= $users['alamat']; ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class='form-group'>
                            <label for="no_telp">no_telp:</label>
                            <input class="form-control" type="text" name="no_telp" value="<?= $users['no_telp']; ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class='form-group'>
                            <label for="devisi">Devisi:</label>
                            <select class="form-control" name="devisi" required>
                                <?php
                                $devisiModel = new DevisiModel();
                                $devisiData = $devisiModel->findAll();
                                foreach ($devisiData as $devisi) {
                                    echo '<option value="' . $devisi['devisi'] . '">' . $devisi['devisi'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <a href="javascript:history.go(-1);" class="btn btn-primary btn-block">Kembali</a>
                    </div>
                    <div class="col-6">
                        <button class='btn btn-danger btn-block' type="submit">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>