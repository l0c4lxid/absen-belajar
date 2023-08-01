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
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Devisi</th>
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
                            <td>
                                <?php echo $absen['tanggal_masuk']; ?>
                            </td>
                            <td>
                                <?php echo $absen['waktu_masuk']; ?>
                            </td>
                            <td>
                                <?php echo $absen['waktu_keluar']; ?>
                            </td>
                            <td>
                                <?php echo $absen['keterangan']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<!-- ... -->