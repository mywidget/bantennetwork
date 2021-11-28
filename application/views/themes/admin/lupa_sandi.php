<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Forgot Password | Kalkulatorcetak</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>dist/css/theme.min.css">
        <script src="<?=base_url('assets/backend/');?>src/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <body>
        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                        <div class="lavalite-bg" style="background-image: url('<?=base_url('assets/backend/');?>img/auth/login-bg.jpg')">
                            <div class="lavalite-overlay"></div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                                <a href="/"><img src="<?=base_url('assets/backend/');?>src/img/brand.svg" alt=""></a>
                            </div>
                            <h3>Lupa Sandi</h3>
                            <p>Kami akan mengirimkan Anda tautan untuk mengatur ulang kata sandi.</p>
                            <form action="../index.html">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your email address" required="">
                                    <i class="ik ik-mail"></i>
                                </div>
                                <div class="sign-btn text-center">
                                    <button class="btn btn-theme">Kirim</button>
                                </div>
                            </form>
                            <div class="register">
                                <p>Belum punya akun? <a href="../daftar">Buat akun</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=base_url('assets/backend/');?>src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="<?=base_url('assets/backend/');?>plugins/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?=base_url('assets/backend/');?>plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?=base_url('assets/backend/');?>plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
        <script src="<?=base_url('assets/backend/');?>plugins/screenfull/dist/screenfull.js"></script>
        <script src="<?=base_url('assets/backend/');?>dist/js/theme.js"></script>
    </body>
</html>
