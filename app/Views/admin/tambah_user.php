<!DOCTYPE html>
<html>

<head>
    <title>Add User</title>
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
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                <form action="<?= base_url('admin/saveUser'); ?>" method="post">
                    <div class="card-body col-md-12">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" required class="form-control" id="username"
                                placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="text" name="password" required class="form-control" id="password"
                                placeholder="password">
                        </div>
                        <div class="form-group">
                            <label for="nama">nama</label>
                            <input type="text" name="nama" required class="form-control" id="nama" placeholder="nama">
                        </div>
                        <div class="form-group">
                            <label for="alamat">alamat</label>
                            <input type="text" name="alamat" required class="form-control" id="alamat"
                                placeholder="alamat">
                        </div>
                        <div class="form-group">
                            <label for="no_telp">no_telp</label>
                            <input type="text" name="no_telp" required class="form-control" id="no_telp"
                                placeholder="no_telp">
                        </div>
                        <div class="form-group">
                            <label for="devisi">Devisi:</label>
                            <select class="form-control" name="devisi" required>
                                <?php
                                $devisiModel = new DevisiModel();
                                $devisiData = $devisiModel->findAll();
                                foreach ($devisiData as $devisi) {
                                    echo '<option value="' . $devisi['id_devisi'] . '">' . $devisi['keterangan'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:history.go(-1);" class="btn btn-danger btn-block">Kembali</a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </div>

                    </div>
                    <!-- <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div> -->
                </form>
            </div>
        </div>
    </div>


</body>

</html>