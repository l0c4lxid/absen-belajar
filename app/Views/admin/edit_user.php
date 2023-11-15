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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id_jam">Jam Kerja :</label>
                            <select name="id_jam" id="id_jam" class="form-control" required>
                                <?php
                                foreach ($jam as $value) {
                                    echo '<option value="' . $value['id_jam'] . '">' . $value['shift'] . ' | ' . $value['jam_masuk_awal'] . ' - ' . $value['jam_masuk_akhir'] . ' | ' . $value['jam_keluar_awal'] . ' - ' . $value['jam_keluar_akhir'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-3">
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
                    <div class="col-4 mt-5">
                        <a href="javascript:history.go(-1);" class="btn btn-primary btn-block">Kembali</a>
                    </div>
                    <div class="col-4">
                    </div>
                    <div class="col-4 mt-5">
                        <button class='btn btn-danger btn-block' type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>