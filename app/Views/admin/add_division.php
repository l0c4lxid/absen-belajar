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

<body>
    <form action="<?= base_url('devisi/savedivision'); ?>" method="post">
        <!-- left column -->
        <section class="content">
            <div class="container-fluid">
                <div class="row col-12">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Quick Example</h3>
                            </div>
                            <div class="card-body ">
                                <div class="form-group">
                                    <label for="devisi">Divisi Name:</label>
                                    <input name="devisi" type="text" class="form-control" id="devisi"
                                        placeholder="Enter Devisi">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Tambahkan kolom lain sesuai kebutuhan -->
    </form>
</body>