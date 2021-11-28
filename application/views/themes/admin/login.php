<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login | User kalkulatorcetak</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="/assets/img/favicon.png" type="image/x-icon" />
		
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>dist/css/theme.min.css">
        <link rel="stylesheet" href="<?=base_url('assets/backend/');?>dist/css/loading.css">
        <script src="<?=base_url('assets/backend/');?>src/js/vendor/modernizr-2.8.3.min.js"></script>
	</head>
	
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		
        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                        <div class="lavalite-bg" style="background-image: url('<?=base_url('assets/backend/');?>img/auth/login-bg.jpg')">
                            <div class="lavalite-overlay"></div>
						</div>
					</div>
                    <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
						<?php echo $this->session->flashdata('message'); ?>
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                                <a href="/"><img src="<?=base_url('assets/banner/');?>logo.png" alt="" width="100"></a>
							</div>
                            <h3>Masuk dengan</h3>
							<div class="card-title text-xs-center">
								<?=$login_button;?>
							</div>
                            <p>Atau gunakan akun detail</p>
							<div class="containers" style="<?=$show;?>">
								<div class="yellow"></div>
								<div class="red"></div>
								<div class="blue"></div>
								<div class="violet"></div>
							</div>
                            <form action="" method="post">
								<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                <div class="form-group">
                                    <input type="text" name="user_email" class="form-control" id="user-email" placeholder="Email"  required>
                                    <i class="ik ik-user"></i>
								</div>
                                <div class="form-group">
                                    <input type="password" name="user_password" class="form-control" id="user-password" placeholder="Enter Password" required>
                                    <i class="ik ik-lock"></i>
								</div>
                               
                                <div class="sign-btn text-center">
                                    <button type="submit" name="submit" class="btn btn-theme">Masuk</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
        
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=base_url('assets/backend/');?>src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="<?=base_url('assets/backend/');?>plugins/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?=base_url('assets/backend/');?>plugins/bootstrap/dist/js/bootstrap.min.js"></script>
	</body>
</html>