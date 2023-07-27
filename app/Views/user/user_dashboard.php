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
                    <h1 class='text-bold bg-gray-dark color-palette'> Tanggal <br><span id="date"></span></h1>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Tambahkan script JavaScript -->
<script>
    // Fungsi untuk memperbarui jam dan tanggal secara real-time
    function updateClock() {
        const clockElement = document.getElementById('clock');
        const dateElement = document.getElementById('date');
        const currentTime = new Date();
        const hours = currentTime.getHours().toString().padStart(2, '0');
        const minutes = currentTime.getMinutes().toString().padStart(2, '0');
        const seconds = currentTime.getSeconds().toString().padStart(2, '0');
        const day = currentTime.getDate().toString().padStart(2, '0');

        // Array untuk nama bulan dalam Bahasa Indonesia
        const monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
            'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        const month = monthNames[currentTime.getMonth()];
        const year = currentTime.getFullYear();

        const clockString = `${hours}:${minutes}:${seconds}`;
        clockElement.innerText = clockString;

        const dateString = `${day} ${month} ${year}`;
        dateElement.innerText = dateString;
    }

    // Memperbarui jam setiap 1 detik
    setInterval(updateClock, 1000);

    // Memanggil fungsi updateClock() untuk pertama kali
    updateClock();
</script>