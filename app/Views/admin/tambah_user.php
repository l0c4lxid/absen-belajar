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

<div class="container-fluid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form action="<?= base_url('admin/saveUser'); ?>" method="post">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" required class="form-control" id="username"
                            placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" required class="form-control" id="password"
                            placeholder="Password">
                    </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" required class="form-control" id="nama" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" required class="form-control" id="alamat" placeholder="Alamat">
                </div>
                <div class="form-group">
                    <label for="devisi">Devisi / Bagian:</label>
                    <select class="form-control" name="id_devisi" required>
                        <?php
                        $devisiModel = new DevisiModel();
                        $devisiData = $devisiModel->findAll();
                        foreach ($devisiData as $devisi) {
                            echo '<option value="' . $devisi['id_devisi'] . '">' . $devisi['keterangan'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="no_telp">No Telepon</label>
                    <input type="number" name="no_telp" required class="form-control" id="no_telp"
                        placeholder="Nomer Telepon">
                </div>

                <div class="row">
                    <div class="col-6">
                        <a href="javascript:history.go(-1);" class="btn btn-danger btn-block mt-5">Kembali</a>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block mt-5">Simpan</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>