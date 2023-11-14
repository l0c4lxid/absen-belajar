<div class="col-md-12">
    <?php
    $session = session();
    $successMsg = $session->getFlashdata('success');
    if ($successMsg) {
        echo '<p style="color: green;">' . $successMsg . '</p>';
    }
    ?>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data
                <?= $judul ?>
            </h3>

            <!-- /.card-tools -->
        </div>

        <div class="card-body">
            <form action=" <?= base_url('profile/save_admin'); ?>" method="post">


                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" required class="form-control " id="username"
                        value="<?= $userUsername; ?>">
                </div>


                <div class="form-group">
                    <label for="password">password</label>
                    <input type="text" name="password" required class="form-control " id="password"
                        placeholder="password">
                </div><br>


                <div class="row">
                    <div class="col-4">
                        <a href="<?= base_url('dashboard'); ?>" class="btn btn-primary btn-block">Kembali</a>
                    </div>
                    <div class="col-4">
                    
                    </div>
                    <div class="col-4">
                        <button href="<?= base_url('profile/admin'); ?>"
                            class="btn btn-danger btn-block">Simpan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>