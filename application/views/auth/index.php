<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="shortcut icon" href="<?= BASE_THEME . '/img/logo1.jpg' ?>">
    <title>AHASS 669 | PT Astra Honda Motor</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= BASE_THEME . '/modules/bootstrap/css/bootstrap.min' ?>.css">
    <link rel="stylesheet" href="<?= BASE_THEME . '/modules/fontawesome/css/all.min' ?>.css">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= BASE_THEME . '/css/style' ?>.css">
    <link rel="stylesheet" href="<?= BASE_THEME . '/css/components' ?>.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->

    <script src="<?= BASE_THEME . '/modules/jquery.min.js' ?>"></script>
    <script src="<?= BASE_THEME . '/modules/datatables/datatables.js' ?>"></script>
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="<?= BASE_THEME . '/img/logo.svg' ?>" alt="logo" width="150">
                        </div>

                        <div class="card card-danger">
                            <div class="card-body">
                                <?= $this->session->flashdata('message') ?>
                                <form method="POST" action="<?= BASE_URL . 'auth/' ?>" class="needs-validation">
                                    <div class="form-group">
                                        <label for="Username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username..." value="<?= set_value('username') ?>">
                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Katasandi</label>
                                        </div>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Katasandi...">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-dark btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                                <div class="text-center mt-4 mb-3">
                                    <div class="text-job text-muted">Apa Anda Customer?</div>
                                </div>
                                <div class="form-group">
                                    <a href=" <?= BASE_URL . 'auth/customer' ?>" type="submit" class="btn btn-lg btn-block btn-dark" tabindex="4">
                                        Customer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= BASE_THEME . '/modules/popper.js' ?>"></script>
    <script src="<?= BASE_THEME . '/modules/tooltip.js' ?>"></script>
    <script src="<?= BASE_THEME . '/modules/bootstrap/js/bootstrap.min.js' ?>"></script>
    <script src="<?= BASE_THEME . '/modules/nicescroll/jquery.nicescroll.min.js' ?>"></script>
    <script src="<?= BASE_THEME . '/modules/moment.min.js' ?>"></script>
    <script src="<?= BASE_THEME . '/js/stisla.js' ?>"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?= BASE_THEME . '/js/scripts.js' ?>"></script>
    <script src="<?= BASE_THEME . '/js/custom.js' ?>"></script>
</body>

</html>