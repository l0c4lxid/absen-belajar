<div class="col-md-12">
    <div class="card">
        <div class="card-body text-left text-primary">
            <form action="<?= base_url('admin/updateUser/' . $users['id_user']); ?>" method="post">
                <div class="row">

                    <div class="col-md-6">

                        <div class='form-group'>

                            <label for="username">Username:</label>
                            <input class="form-control" type="text" name="username" value="<?= $users['username']; ?>"
                                required><br>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class='form-group '>

                            <label for="password">Password:</label>
                            <input class="form-control" type="password" name="password">
                            <h5 class='text-warning'>Biarkan Jika tidak ingin di Ubah !!</h5>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class='form-group'>
                            <label for="nama">Nama :</label>
                            <input class="form-control" type="text" name="nama" value="<?= $users['nama']; ?>" required>
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
                            <select class="form-control" id="devisi" name="devisi" required>
                                <?php
                                foreach ($devisiData as $devisi) {
                                    $selected = ($devisi['id_devisi'] == $users['id_devisi']) ? 'selected' : '';
                                    echo '<option value="' . $devisi['id_devisi'] . '" ' . $selected . '>' . $devisi['keterangan'] . '</option>';
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