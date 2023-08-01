<div class="container-fluid">
    <div class="row ">
        <!-- left column -->
        <div class="col-md-12">
            <?php
            $session = session();
            $successMsg = $session->getFlashdata('success');
            if ($successMsg) {
                echo '<p style="color: green;">' . $successMsg . '</p>';
            }
            ?>
            <form action="<?= base_url('profile/save_user'); ?>" method="post">

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
                <div class='row'>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-block">Back to
                            Dashboard</button>
                    </div>
                    <div class="col-md-6">
                        <button href='<?= base_url('profile/user'); ?>' class="btn btn-danger btn-block">Simpan</button>
                    </div>
                </div>
                <!-- /.col -->


            </form>
        </div>
    </div>
</div>