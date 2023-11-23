<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data
                <?= $judul ?>
            </h3>

            <!-- /.card-tools -->
        </div>
        <form action="<?= base_url('absensi/laporan'); ?>" method="GET">

            <div class="container card-body">
                <?php
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="id_user">Pilih Pengguna:</label>
                            <select class="custom-select form-control" name="id_user" id="id_user">
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user['id_user'] ?>">
                                        <?= $user['nama'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- Pilih Bulan -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <select class="custom-select form-control" name="bulan" id="bulan">
                                <?php $bulanIndonesia = array(
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember'
                                ); ?>
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?php echo $i; ?>">
                                        <?php echo $bulanIndonesia[$i]; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Pilih Tahun -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tahun">Pilih Tahun:</label>
                            <select class="custom-select form-control" name="tahun" id="tahun">
                                <?php $tahunSekarang = date("Y"); ?>
                                <?php for ($tahun = $tahunSekarang; $tahun >= $tahunSekarang - 5; $tahun--): ?>
                                    <option value="<?php echo $tahun; ?>">
                                        <?php echo $tahun; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Tampilkan data absensi jika ada -->
        <div class='card-body'>
            <?php if (!empty($absensi)): ?>
                <table id="example1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th class='text-center'>Nama</th>
                            <th class='text-center'>Tanggal</th>
                            <th class='text-center'>Waktu Masuk</th>
                            <th class='text-center'>Waktu Masuk Telat</th>
                            <th class='text-center'>Waktu Keluar</th>
                            <th class='text-center'>Waktu Keluar Telat</th>
                            <!-- <th>Keterangan</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomer = 1;
                        foreach ($absensi as $absen): ?>
                            <tr>
                                <td class='text-center'>
                                    <?= $nomer++ ?>.
                                </td>
                                <td class='text-center'>
                                    <?= $userInfo[$absen['id_user']]['nama'] ?>
                                </td>
                                <td class='text-center'>
                                    <?php echo tanggal_indonesia($absen['jam_masuk']) . ', ' . date('d', strtotime($absen['jam_masuk'])) . ' ' . $bulanIndonesia[date('n', strtotime($absen['jam_masuk']))] . ' ' . date('Y', strtotime($absen['jam_masuk'])); ?>
                                </td>

                                <td class='text-center'>
                                    <?php echo date('H:i:s', strtotime($absen['jam_masuk'])); ?>
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
                                    <?php
                                    // Tampilkan waktu keluar jika tidak NULL, jika NULL, jangan tampilkan apa pun
                                    if ($absen['jam_keluar'] !== NULL) {
                                        echo date('H:i:s', strtotime($absen['jam_keluar']));
                                    }
                                    ?>
                                </td>
                                <td class='text-center'>
                                    <?php
                                    if ($absen['keluar_telat'] == 1) {
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
            <?php else: ?>
                <p>No data found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Helper Function to Convert Date to Bahasa Indonesia -->
<?php
function tanggal_indonesia($date)
{
    $hari = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );

    return $hari[date('w', strtotime($date))];
}
?>