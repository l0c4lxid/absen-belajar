<!-- app/Views/absen_view.php -->
<!-- ... -->
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data
                <?= $judul ?>
            </h3>
            <!-- /.card-tools -->
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th class='text-center'>Waktu Masuk</th>
                        <th class='text-center'>Telat Masuk</th>
                        <th class='text-center'>Waktu Keluar</th>
                        <th class='text-center'>Telat Keluar</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $nomer = 1;
                    foreach ($allAbsenWithUserInfo as $absen): ?>
                        <tr>
                            <td>
                                <?= $nomer++ ?>.
                            </td>
                            <td>
                                <?php echo $absen['nama']; ?>
                            </td>
                            <td class='text-center'>
                                <?php echo $absen['tanggal_masuk']; ?>
                            </td>
                            <td class='text-center'>
                                <?php echo $absen['waktu_masuk']; ?>

                            </td>
                            <td class='text-center'>
                                <?php
                                if ($absen['masuk_telat'] == 1) {
                                    echo '<span style="color: red;">Terlambat</span>';
                                } elseif ($absen['masuk_telat'] == 2) {
                                    echo '<span style="color: green;">Tepat</span>';
                                }
                                ?>
                            </td>
                            <td class='text-center'>
                                <?php echo $absen['waktu_keluar']; ?>
                            </td>
                            <td class='text-center'>
                                <?php if ($absen['keluar_telat'] == 1) {
                                    echo '<span style="color: red;">Terlambat</span>';
                                } elseif ($absen['keluar_telat'] == 2) {
                                    echo '<span style="color: green;">Tepat</span>';
                                }
                                ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<!-- ... -->