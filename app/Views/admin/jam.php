<!-- app/Views/jadwal/index.php -->
<!-- Include DataTables CSS -->
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data
                <?= $judul ?>
            </h3>
            <div class="card-tools">
            </div>
            <!-- /.card-tools -->
        </div>
        <div class='card-body'>
            <table id="example2" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Untuk User</th>
                        <th>Entry 1</th>
                        <th>Exit 1</th>
                        <th>Entry 2</th>
                        <th>Exit 2</th>
                        <th class='text-center'>Atur</th>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($schedules as $schedule): ?>
                        <tr>
                            <td>
                                Nama
                            </td>
                            <td>
                                <?= $schedule['masuk_1']; ?>
                            </td>
                            <td>
                                <?= $schedule['keluar_1']; ?>

                            </td>
                            <td>
                                <?= $schedule['masuk_2']; ?>

                            </td>
                            <td>
                                <?= $schedule['keluar_2']; ?>
                            </td>
                            <td class="text-center">

                            </td>
                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>