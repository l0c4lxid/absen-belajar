<!DOCTYPE html>
<html>

<head>
    <title>Admin Profile</title>
</head>
<?php
$session = session();
$successMsg = $session->getFlashdata('success');
if ($successMsg) {
    echo '<p style="color: green;">' . $successMsg . '</p>';
}
?>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <form action="<?= base_url('profile/save_admin'); ?>" method="post">
                    <div class="card-body col-md-12">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" required class="form-control" id="username"
                                value="<?= $userUsername; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="text" name="password" required class="form-control" id="password"
                                placeholder="password">
                        </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <button type="submit" class="btn btn-primary btn-block">Back to
                    Dashboard</button>
            </div>
            <div class="col-6">
                <button href='<?= base_url('profile/admin'); ?>' class="btn btn-danger btn-block">Simpan</button>
            </div>
            <!-- /.col -->
        </div>
    </div>
    </form>
</body>

</html>