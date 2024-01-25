<style>
    .clock-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 150px;
        font-size: 3rem;
        font-weight: bold;
        color: #333;
    }
</style>

<div class="col-md-12">
    <div class="card">
        <div class="card-body text-center text-primary">
            <div class="row">
                <!-- Bagian pukul di sebelah kanan -->
                <div class="col-md-6">
                    <h1 class='text-bold bg-gray-dark color-palette'>Pukul <br><span id="clock"></span></h1>
                </div>
                <!-- Bagian tanggal di sebelah kiri -->
                <div class="col-md-6">
                    <h1 class='text-bold bg-gray-dark color-palette'>Hari / Tanggal <br><span id="date"></span></h1>
                </div>
            </div>
            <!-- <div class='row'>

                <form action="<?= base_url('absensi/absen_masuk') ?>" method="post">
                    <input class="btn btn-primary" type="submit" name="submit" value="Absen Masuk">
                </form>
            </div> -->
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
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="info-box bg-Secondary">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                        <div class="info-box-content">
                            <?php if (!$hasAbsenToday): ?>
                                <form action="<?= base_url('absensi/absen_masuk') ?>" method="post">
                                    <input class="btn btn-primary col-md-6" type="submit" name="submit" value="Absen Masuk">
                                </form>
                            <?php else: ?>
                                <form>
                                    <button class="btn btn-secondary col-md-6" disabled>Absen Sudah Dilakukan</button>
                                </form>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- /.info-box-content -->
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="info-box bg-Secondary">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                        <div class="info-box-content d-flex justify-content-center align-items-center">

                            <?php if (!$hasAbsenToday): ?>
                                <button class="btn btn-secondary col-md-6" disabled>Belum Absen Masuk!!</button>
                            <?php elseif (!$BeritaAcara): ?>
                                <button class="btn btn-secondary col-md-6" disabled>Isi Dulu Berita Acara</button>
                            <?php elseif (!$hasAbsenTodayKeluar): ?>
                                <button class="btn btn-danger col-md-6" data-toggle="modal" data-target="#absenKeluarModal"
                                    id='btnKeluar'>Absen Keluar</button>
                            <?php else: ?>
                                <button class="btn btn-secondary col-md-6" disabled>Absen Keluar Sudah Dilakukan</button>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
                <?php if ($hasAbsenToday && (!$BeritaAcara)): ?>
                    <div class="col-md-12">
                        <div class="card-header">
                            <h3 class="card-title text-danger">
                                Isi berita acara!!
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('absensi/berita_acara') ?>" method="post">
                                <textarea id="summernote" name="berita_acara"
                                    placeholder="Masukkan berita acara Anda di sini..."></textarea>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </form>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <!-- /.info-box -->
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal" id="absenKeluarModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Absen Keluar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <p>Apakah Anda yakin ingin melakukan Absen Keluar?</p>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <a href="<?= base_url('absensi/absen_keluar') ?>" class="btn btn-danger">Ya, Absen Keluar</a>
            </div>

        </div>
    </div>
</div>

<!-- Tambahkan script JavaScript -->
<script>
    // Fungsi untuk memperbarui jam, hari, dan tanggal secara real-time
    function updateClock() {
        const clockElement = document.getElementById('clock');
        const dateElement = document.getElementById('date');
        const currentTime = new Date();
        const hours = currentTime.getHours();
        const minutes = currentTime.getMinutes();
        const seconds = currentTime.getSeconds();
        const day = currentTime.getDate();

        // Array untuk nama bulan dalam Bahasa Indonesia
        const monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
            'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Array untuk nama hari dalam Bahasa Indonesia
        const dayNames = [
            'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
        ];

        const dayName = dayNames[currentTime.getDay()]; // Mendapatkan nama hari dari tanggal saat ini
        const month = monthNames[currentTime.getMonth()];
        const year = currentTime.getFullYear();

        const clockString = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        clockElement.innerText = clockString;

        const dateString = `${dayName}, ${day.toString().padStart(2, '0')} ${month} ${year}`; // Menyusun format tanggal dan nama hari
        dateElement.innerText = dateString;


    }

    // Memperbarui jam setiap 1 detik
    setInterval(updateClock, 1000);

    // Memanggil fungsi updateClock() untuk pertama kali
    updateClock();
</script>
<!-- ... (your existing HTML code) -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jamKeluarAwal = '<?= $jamKeluarAwal ?>'; // Replace with the actual value from your PHP data
        const jamKeluarAkhir = '<?= $jamKeluarAkhir ?>'; // Replace with the actual value from your PHP data
        const btnKeluarElement = document.getElementById('btnKeluar');

        // Function to check if the current time is within the allowed range
        function isCurrentTimeInRange() {
            const currentTime = new Date().toLocaleTimeString('en-US', { timeZone: 'Asia/Jakarta', hour12: false });
            return currentTime >= jamKeluarAwal && currentTime <= jamKeluarAkhir;
        }

        // Check if the current time is within the allowed range
        if (!isCurrentTimeInRange()) {
            btnKeluarElement.disabled = true; // Disable the button
        }

        // Optional: Add an event listener to show a message if the button is clicked outside the allowed range
        btnKeluarElement.addEventListener('click', function () {
            if (!isCurrentTimeInRange()) {
                alert('Absen keluar hanya dapat dilakukan antara jam ' + jamKeluarAwal + ' - ' + jamKeluarAkhir);
                return false; // Prevent the button click
            }
        });
    });
</script>