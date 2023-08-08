<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAMA |
        <?= $judul ?>
    </title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">

    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/favicon.png">
    <style>
        body {
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <p class="h1"><b>SAMA</b> - Login</p>
                <img src="<?= base_url('/img/login.jpg') ?>" width='250px' alt="Logo login"
                    class="img-fluid mx-auto d-block">
            </div>
            <?php
            $session = session();
            $errorMsg = $session->getFlashdata('error');
            if ($errorMsg) {
                echo $errorMsg;
            }
            ?>
            <div class="card-body">
                <b>
                    <p class="login-box-msg">Silahkan Login Terlebih Dahulu</p>
                </b><br>
                <?php echo form_open('auth/login') ?>
                <div class="input-group mb-3">
                    <input name="username" id='username' type="username" class="form-control" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input name="password" id='username' type="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?php echo form_close(); ?>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <script>
        // Array of image URLs
        const imageUrls = [

            "url('https://images.pexels.com/photos/1546251/pexels-photo-1546251.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')",
            "url('https://images.pexels.com/photos/3587347/pexels-photo-3587347.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')",
            "url('https://images.pexels.com/photos/3527795/pexels-photo-3527795.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')",
            "url('https://images.pexels.com/photos/3587343/pexels-photo-3587343.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')",
            "url('https://images.pexels.com/photos/11167643/pexels-photo-11167643.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')",
            // Add more image URLs as needed
        ];

        // Function to get a random number between 0 and max
        function getRandomNumber(max) {
            return Math.floor(Math.random() * max);
        }

        // Set random background image on page load
        document.addEventListener('DOMContentLoaded', function () {
            const randomIndex = getRandomNumber(imageUrls.length);
            const randomImageUrl = imageUrls[randomIndex];
            document.body.style.backgroundImage = randomImageUrl;
        });
    </script>
</body>

</html>