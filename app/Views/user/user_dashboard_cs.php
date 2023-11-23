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
            <div class="row">
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="info-box bg-Secondary">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                        <div class="info-box-content">
                            <form action="<?= base_url('absensi/absen_masuk_dua') ?>" method="post">
                                <button class="btn btn-primary col-md-6" type="submit" name="submit" id='btnMasuk'
                                    <?= ($countAbsenMasuk >= 2 || $countAbsenKeluar >= 2) ? 'disabled' : '' ?>>Absen
                                    Masuk</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.info-box-content -->
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="info-box bg-Secondary">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                        <div class="info-box-content d-flex justify-content-center align-items-center">
                            <button class="btn btn-danger col-md-6" data-toggle="modal" data-target="#absenKeluarModal"
                                id='btnKeluar' <?= ($countAbsenMasuk > 2 || $countAbsenKeluar >= 2) ? 'disabled' : '' ?>>Absen Keluar</button>
                        </div>
                    </div>
                </div>
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
                <a href="<?= base_url('absensi/absen_keluar_dua') ?>" class="btn btn-danger">Ya, Absen Keluar</a>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var jamSekarang = "<?php echo $jamSekarang; ?>"; // Get the current time from PHP
        var countAbsenMasuk = <?php echo $countAbsenMasuk; ?>; // Get the count of Absen Masuk from PHP
        var countAbsenKeluar = <?php echo $countAbsenKeluar; ?>; // Get the count of Absen Keluar from PHP
        var masuk_2_kurang = "<?php echo $masuk_2_kurang; ?>";
        var keluar_2_tambah = "<?php echo $keluar_2_tambah; ?>";
        var keluar_2 = "<?php echo $keluar_2; ?>";
        var keluar_1 = "<?php echo $keluar_1; ?>";
        var masuk_1_kurang = "<?php echo $masuk_1_kurang; ?>";


        // Compare time values directly
        if (countAbsenMasuk === 0 && (jamSekarang <= masuk_1_kurang || jamSekarang >= keluar_2_tambah)) {
            document.getElementById("btnMasuk").disabled = true;
        }
        if (countAbsenKeluar === 0 && (jamSekarang <= keluar_1 || jamSekarang >= keluar_2_tambah)) {
            document.getElementById("btnKeluar").disabled = true;
        }

        if (countAbsenMasuk === 1 && (jamSekarang <= masuk_2_kurang || jamSekarang >= keluar_2_tambah)) {
            document.getElementById("btnMasuk").disabled = true;
        }

        if (countAbsenKeluar === 1 && (jamSekarang <= keluar_2 || jamSekarang >= keluar_2_tambah)) {
            document.getElementById("btnKeluar").disabled = true;
        }
    });
</script>