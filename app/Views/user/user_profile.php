<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <!-- left column -->
        <div class="col-md-12">
            <?php
            $session = session();
            $successMsg = $session->getFlashdata('success');
            if ($successMsg) {
                echo '<p style="color: green;">' . $successMsg . '</p>';
            }
            ?>
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('profile/save_user'); ?>" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" required class="form-control" id="username"
                                value="<?= $userUsername; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" required class="form-control" id="password"
                                placeholder="Password">
                        </div>
                        <div class='row'>
                            
                                    <div class="col-4 text-center"> <!-- Adjusted column size and added text-center class -->
                                        <button type="button" class="btn btn-primary btn-block" onclick="window.location.href='/absen/dashboard'">Back</button>
                                </div>
                            <div class='col-4'>
                            </div>
                            <div class="col-4 text-center"> <!-- Adjusted column size and added text-center class -->
                                <button type="submit" class="btn btn-danger btn-block">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
