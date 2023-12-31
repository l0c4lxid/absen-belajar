<!-- Include DataTables CSS -->
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data
                <?= $judul ?>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-tambah"><i
                        class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <div class='card-body'>
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
            <table id="example2" class="table table-bordered">
                <thead>
                    <tr>
                        <th class='text-center' width='50px'>No</th>
                        <th>Nama Devisi</th>
                        <th class='text-center'>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($devisi as $value): ?>
                        <tr>
                            <td class='text-center'>
                                <?= $no++ ?>
                            </td>
                            <td>
                                <?= $value['keterangan'] ?>
                            </td>
                            <td class='text-center'>
                                <button class="btn btn-flat btn-warning" data-toggle="modal"
                                    data-target="#modal-edit<?= $value['id_devisi'] ?>"><i class="fas fa-pencil-alt">
                                        Edit</i></button>
                                <button class="btn btn-flat btn-danger" data-toggle="modal"
                                    data-target="#modal-hapus<?= $value['id_devisi'] ?>"><i class="fas fa-trash">
                                        Hapus</i></button>
                            </td>
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
                <?php echo form_open('devisi/saveDivision') ?>
                <div class='form-group'>
                    <label>Nama Devisi</label>
                    <input type='text' id="keterangan" name="keterangan" class="form-control" required></input>
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

<?php foreach ($devisi as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['id_devisi'] ?>">
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
                    <?php echo form_open('devisi/updateDevisi/' . $value['id_devisi']) ?>
                    <div class='form-group'>
                        <label>Nama Devisi</label>
                        <input type='text' id="keterangan" name="keterangan" class="form-control"
                            value="<?= $value['keterangan'] ?>" required></input>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <?php
                        // Check if the division name is CS or SATPAM and add the disabled attribute accordingly
                        if ($value['keterangan'] !== 'CS') {
                            ?>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-primary" disabled>Simpan</button>
                        <?php } ?>
                    </div>
                    <?php echo form_close() ?>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-hapus<?= $value['id_devisi'] ?>">
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
                        <?= $value['keterangan'] ?>
                    </b>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <?php
                    // Check if the division name is CS or SATPAM and add the disabled attribute accordingly
                    if ($value['keterangan'] !== 'CS') {
                        ?>
                        <a href="<?= base_url('devisi/deleteDivision/' . $value['id_devisi']) ?>"
                            class="btn btn-danger">Hapus</a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-danger" disabled>Hapus</button>
                    <?php } ?>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
<?php } ?>