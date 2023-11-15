<?php
use App\Models\DevisiModel;
use App\Models\JamModel;

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
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-body">
            <form action="<?= base_url('admin/saveUser'); ?>" method="post">

                <div class="container-fluid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

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

                                <div class="form-group">
                                    <label for="id_jam">Jam Kerja :</label>
                                    <select name="id_jam" id="id_jam" class="form-control" required>
                                        <?php
                                        $jamModel = new JamModel();
                                        $jamData = $jamModel->findAll();
                                        foreach ($jamData as $value) {
                                            echo '<option value="' . $value['id_jam'] . '">' . $value['shift'] . ' | ' . $value['jam_masuk_awal'] . ' - ' . $value['jam_masuk_akhir'] . ' | ' . $value['jam_keluar_awal'] . ' - ' . $value['jam_keluar_akhir'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" required class="form-control" id="nama"
                                        placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" required class="form-control" id="alamat"
                                        placeholder="Alamat">
                                </div>
                                <div class="form-group">
                                    <label for="devisi">Devisi / Bagian:<br></label>
                                    <select class="form-control select2" data-placeholder="Select a Devisi"
                                        id='id_devisi' name="id_devisi" required>
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
                                        <a href="javascript:history.go(-1);"
                                            class="btn btn-danger btn-block mt-5">Kembali</a>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary btn-block mt-5">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const devisiDropdown = document.getElementById('id_devisi');
        const jamDropdown = document.getElementById('id_jam');

        // Function to enable or disable the jam dropdown based on devisi selection
        function updateJamDropdown() {
            const selectedDevisi = devisiDropdown.options[devisiDropdown.selectedIndex].text;
            const isCS = selectedDevisi === 'CS';
            jamDropdown.disabled = isCS;
        }

        // Add event listener to the devisi dropdown
        devisiDropdown.addEventListener('change', updateJamDropdown);

        // Call the function on page load
        updateJamDropdown();
    });
</script>