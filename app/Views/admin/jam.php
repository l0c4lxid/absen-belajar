<!-- app/Views/jadwal/index.php -->
<!-- Include DataTables CSS -->

<div class="col-md-12">

    <?php
    $session = session();
    $successMsg = $session->getFlashdata('success');
    $errorMsg = $session->getFlashdata('error');
    if ($successMsg) {
        echo $successMsg;
    }
    if ($errorMsg) {
        echo $errorMsg;
    }
    ?>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data
                <?= $judul ?>
            </h3>
            <div class="card-tools"> <button type="button" class="btn btn-tool" data-toggle="modal"
                    data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <div class='card-body'>


            <table id="example2" class="table table-bordered">
                <thead>
                    <tr>
                        <th class='text-center'>Shift</th>
                        <th class='text-center'>Masuk</th>
                        <th class='text-center'>Keluar</th>
                        <th class='text-center'>Atur</th>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($schedules as $value): ?>
                        <tr>
                            <td class='text-center'>
                                <?= $value['shift']; ?>
                            </td>
                            <td class='text-center'>
                                <?= $value['jam_masuk_awal']; ?> -
                                <?= $value['jam_masuk_akhir']; ?>
                            </td>
                            <td class='text-center'>
                                <?= $value['jam_keluar_awal']; ?> -
                                <?= $value['jam_keluar_akhir']; ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-flat btn-warning" data-toggle="modal"
                                    data-target="#modal-edit<?= $value['id_jam'] ?>"><i class="fas fa-pencil-alt">
                                        Edit</i></button>

                                <?php if ($value['shift'] !== 'CS'): ?>
                                    <button class="btn btn-flat btn-danger" data-toggle="modal"
                                        data-target="#modal-hapus<?= $value['id_jam'] ?>"><i class="fas fa-trash">
                                            Hapus</i></button>
                                <?php else: ?>
                                    <button class="btn btn-flat btn-danger" data-toggle="modal"
                                        data-target="#modal-hapus<?= $value['id_jam'] ?>" disabled><i class="fas fa-trash">
                                            Hapus</i></button>
                                <?php endif; ?>
                            </td>

                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data
                Jadwal CS
            </h3>
            <div class="card-tools">
            </div>
            <!-- /.card-tools -->
        </div>
        <div class='card-body'>
            <table id="example2" class="table table-bordered">
                <thead>
                    <tr>
                        <th class='text-center'>Masuk Pertama</th>
                        <th class='text-center'>Keluar Pertama</th>
                        <th class='text-center'>Masuk Kedua</th>
                        <th class='text-center'>Keluar Kedua</th>
                        <th class='text-center'>Atur</th>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($cs as $value): ?>
                        <tr>

                            <td class='text-center'>
                                <?= $value['jam_masuk_awal']; ?>
                            </td>
                            <td class="text-center">
                                <?= $value['jam_masuk_akhir']; ?>
                            </td>
                            <td class='text-center'>
                                <?= $value['jam_keluar_awal']; ?>
                            </td>
                            <td class="text-center">
                                <?= $value['jam_keluar_akhir']; ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-flat btn-warning" data-toggle="modal"
                                    data-target="#modal-editcs<?= $value['id_jam'] ?>"><i class="fas fa-pencil-alt">
                                        Edit</i></button>


                                <button class="btn btn-flat btn-danger" data-toggle="modal"
                                    data-target="#modal-hapus<?= $value['id_jam'] ?>" disabled><i class="fas fa-trash">
                                        Hapus</i></button>

                            </td>

                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah
                    <?= $judul ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="notification" class="card card-warning shadow" style="display: none;">
                    <div class="card-header col-md-12">
                        <h3 class="card-title text-center">Jam Keluar Awal harus lebih awal dari Jam Keluar Akhir!</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" onclick="hideNotification()"><i
                                    class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php echo form_open('jam/savejam', ['id' => 'form-tambah']) ?>
                <div class='form-group'>
                    <label>Shift</label>
                    <input type='text' id="shift" name="shift" class="form-control" required></input>
                </div>
                <div class='form-group'>
                    <label>Jam Masuk Awal</label>
                    <input type='time' id="jam_masuk_awal" name="jam_masuk_awal" class="form-control" required></input>
                </div>
                <div class='form-group'>
                    <label>Jam Masuk Akhir</label>
                    <input type='time' id="jam_masuk_akhir" name="jam_masuk_akhir" class="form-control"
                        required></input>
                </div>
                <div class='form-group'>
                    <label>Jam Keluar Awal</label>
                    <input type='time' id="jam_keluar_awal" name="jam_keluar_awal" class="form-control"
                        required></input>
                </div>
                <div class='form-group'>
                    <label>Jam Keluar Akhir</label>
                    <input type='time' id="jam_keluar_akhir" name="jam_keluar_akhir" class="form-control"
                        required></input>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>

                </div>

                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>

<?php foreach ($schedules as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['id_jam'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit
                        <?= $judul ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notification" class="card card-warning shadow" style="display: none;">
                        <div class="card-header col-md-12">
                            <h3 class="card-title text-center">Jam Keluar Awal harus lebih awal dari Jam Keluar Akhir!</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" onclick="hideNotification()"><i
                                        class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_open('jam/updatejam/' . $value['id_jam'], ['id' => 'form-edit-' . $value['id_jam']]) ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class='form-group'>
                                <label>Nama Jadwal</label>
                                <input type='text' id="shift" name="shift" class="form-control"
                                    value="<?= $value['shift'] ?>" required>
                            </div>
                        </div>
                        <!-- Left Column -->
                        <div class="col-md-6">

                            <div class='form-group'>
                                <label>Batas Masuk Awal</label>
                                <input type='time' id="jam_masuk_awal" name="jam_masuk_awal" class="form-control"
                                    value="<?= $value['jam_masuk_awal'] ?>" required>
                            </div>

                            <div class='form-group'>
                                <label>Batas Keluar Awal</label>
                                <input type='time' id="jam_keluar_awal" name="jam_keluar_awal" class="form-control"
                                    value="<?= $value['jam_keluar_awal'] ?>" required>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class='form-group'>
                                <label>Batas Masuk Akhir</label>
                                <input type='time' id="jam_masuk_akhir" name="jam_masuk_akhir" class="form-control"
                                    value="<?= $value['jam_masuk_akhir'] ?>" required>
                            </div>
                            <div class='form-group'>
                                <label>Jam Keluar Akhir</label>
                                <input type='time' id="jam_keluar_akhir" name="jam_keluar_akhir" class="form-control"
                                    value="<?= $value['jam_keluar_akhir'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>

                    </div>
                    <?php echo form_close() ?>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-hapus<?= $value['id_jam'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus
                        <?= $judul ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Ingin Hapus Data ?<br>
                    <b>
                        <?= $value['shift'] ?>
                    </b>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

                    <a href="<?= base_url('jam/deletejam/' . $value['id_jam']) ?>" class="btn btn-danger">Hapus</a>

                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
<?php } ?>

<?php foreach ($cs as $key => $value) { ?>
    <div class="modal fade" id="modal-editcs<?= $value['id_jam'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit
                        <?= $judul ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notification" class="card card-warning shadow" style="display: none;">
                        <div class="card-header col-md-12">
                            <h3 class="card-title text-center">Jam Keluar Awal harus lebih awal dari Jam Keluar Akhir!</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" onclick="hideNotification()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_open('jam/updatejam/' . $value['id_jam'], ['id' => 'form-edit-' . $value['id_jam']]) ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class='form-group'>
                                <label>Nama Jadwal</label>
                                <input type='text' id="shift" name="shift" class="form-control"
                                    value="<?= $value['shift'] ?>" required>
                            </div>
                        </div>
                        <!-- Left Column -->
                        <div class="col-md-6">

                            <div class='form-group'>
                                <label>Jam Masuk Pertama</label>
                                <input type='time' id="jam_masuk_awal" name="jam_masuk_awal" class="form-control"
                                    value="<?= $value['jam_masuk_awal'] ?>" required>
                            </div>

                            <div class='form-group'>
                                <label>Jam Masuk Kedua</label>
                                <input type='time' id="jam_keluar_awal" name="jam_keluar_awal" class="form-control"
                                    value="<?= $value['jam_keluar_awal'] ?>" required>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class='form-group'>
                                <label>Jam keluar Pertama</label>
                                <input type='time' id="jam_masuk_akhir" name="jam_masuk_akhir" class="form-control"
                                    value="<?= $value['jam_masuk_akhir'] ?>" required>
                            </div>
                            <div class='form-group'>
                                <label>Jam Keluar Kedua</label>
                                <input type='time' id="jam_keluar_akhir" name="jam_keluar_akhir" class="form-control"
                                    value="<?= $value['jam_keluar_akhir'] ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </div>
<?php } ?>

<!-- Your existing code... -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var formTambah = document.getElementById('form-tambah');
        var formEditElements = document.querySelectorAll('.edit-form');
        var notification = document.getElementById('notification');

        formTambah.addEventListener('submit', function (event) {
            if (!validateJam(formTambah)) {
                event.preventDefault();
            }
        });

        formEditElements.forEach(function (formEdit) {
            formEdit.addEventListener('submit', function (event) {
                if (!validateJam(formEdit)) {
                    event.preventDefault();
                }
            });
        });

        function validateJam(form) {
            var jamAwalMasuk = form.querySelector('[name="jam_masuk_awal"]');
            var jamAkhirMasuk = form.querySelector('[name="jam_masuk_akhir"]');
            var jamAwalKeluar = form.querySelector('[name="jam_keluar_awal"]');
            var jamAkhirKeluar = form.querySelector('[name="jam_keluar_akhir"]');
            var jamAwalMasukValue = jamAwalMasuk.value;
            var jamAkhirMasukValue = jamAkhirMasuk.value;
            var jamAwalKeluarValue = jamAwalKeluar.value;
            var jamAkhirKeluarValue = jamAkhirKeluar.value;

            // Validasi jam masuk
            if (jamAwalMasukValue && jamAkhirMasukValue) {
                if (jamAwalMasukValue >= jamAkhirMasukValue) {
                    showNotification('Jam masuk akhir harus lebih dari jam masuk awal.');
                    return false;
                }
            }

            // Validasi jam keluar
            if (jamAwalKeluarValue && jamAkhirKeluarValue) {
                if (jamAwalKeluarValue >= jamAkhirKeluarValue) {
                    showNotification('Jam keluar akhir harus lebih dari jam keluar awal.');
                    return false;
                }
            }

            // Validasi jam masuk terhadap jam keluar
            if (jamAkhirMasukValue && jamAwalKeluarValue) {
                if (jamAkhirMasukValue >= jamAwalKeluarValue) {
                    showNotification('Jam keluar awal harus lebih dari jam masuk akhir.');
                    return false;
                }
            }

            // Menyembunyikan notifikasi jika validasi berhasil
            hideNotification();
            return true;
        }

        function showNotification(message) {
            // Menampilkan notifikasi
            notification.querySelector('.card-title').innerHTML = message;
            notification.style.display = 'block';
        }

        function hideNotification() {
            // Menyembunyikan notifikasi
            notification.style.display = 'none';
        }

        // Tambahkan event listener untuk tombol "x"
        var closeButton = notification.querySelector('.btn-tool');
        closeButton.addEventListener('click', function () {
            hideNotification();
        });

        function showNotificationEdit(id) {
            // Show notification for the specific edit form
            var notificationEdit = document.getElementById('notification-edit' + id);
            notificationEdit.style.display = 'block';
        }

        function hideNotificationEdit(id) {
            // Hide notification for the specific edit form
            var notificationEdit = document.getElementById('notification-edit' + id);
            notificationEdit.style.display = 'none';
        }
    });
</script>