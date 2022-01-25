<?php
	if(empty($this->session->g_email))
	{
		redirect('portal');
		exit();
	}
	// $user_data = $this->session->userdata('user_data');
	$g_email = $this->session->g_email;
	$User = CekMailUser($g_email);
	
?>
<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title><?=$title;?></title>
		<meta name="description" content="<?=$description;?>">
		<meta name="keywords" content="<?=$keywords;?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta content="#FABA23" name="theme-color">
		<link rel="icon" href="<?=base_url('assets/backend/');?>img/ico/favicon.ico" type="image/x-icon" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@200;400&display=swap" rel="stylesheet">   
		<link href="//fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/bootstrap/dist/css/bootstrap.min.css">
		<link href="<?=base_url('assets/');?>css/nucleo-icons.css" rel="stylesheet" />
		<link href="<?=base_url('assets/');?>css/nucleo-svg.css" rel="stylesheet" />
		<!-- Font Awesome Icons -->
		<link href="<?=base_url('assets/');?>css/nucleo-svg.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/font-awesome/css/font-awesome.min.css">
		<!--link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/fontawesome-free/css/all.min.css"-->
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/icon-kit/dist/css/iconkit.min.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/ionicons/dist/css/ionicons.min.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/perfect-scrollbar/css/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/weather-icons/css/weather-icons.min.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/c3/c3.min.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/owl.carousel/dist/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>dist/css/theme.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>dist/css/colors.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>dist/css/w3.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>dist/css/table.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>dist/css/loading.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>dist/css/404.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>dist/css/bootstrap-image-checkbox.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/');?>plugins/sweetalert2/dist/sweetalert2.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/');?>plugins/nprogress/nprogress.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/icon-picker/simple-iconpicker.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/selectize/css/selectize.css" />
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/jquery-minicolors/jquery.minicolors.css" />
		
		<!--link rel="stylesheet" href="plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css"-->
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/select2/dists/css/select2.min.css">
		<link rel="stylesheet" href="<?=base_url('assets/backend/');?>plugins/mohithg-switchery/dist/switchery.min.css">
		<!-- CSS Files -->
		<!--link href="dist/css/argon-design-system.css?v=1.2.0" rel="stylesheet" /-->
		<link href="<?=base_url('assets/backend/');?>dist/css/custom.css?v=1.0" rel="stylesheet" />
		<link href="<?=base_url('assets/');?>css/hint.css" rel="stylesheet" />
		<link href="<?=base_url('assets/');?>css/sidenav.css" rel="stylesheet" />
		<link href="<?=base_url('assets/backend/');?>plugins/autocomplate/jquery-ui.min.css" rel="stylesheet"/>
		
		<script src="<?=base_url('assets/backend/');?>src/js/vendor/modernizr-2.8.3.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/jquery/jquery.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/jquery.easing/jquery.easing.min.js"></script>
		<script type="text/javascript" src="<?=base_url('assets/backend/');?>plugins/autocomplate/jquery-ui.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/popper.js/dist/umd/popper.min.js"></script>
		<!--script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script-->
		<script src="<?=base_url('assets/');?>js/core/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?=base_url('assets/');?>js/jquery.jscroll.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>js/jquery.sortable.js"></script>
		<script src="<?=base_url('assets/backend/');?>js/validation.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/sweetalert2/dist/sweetalert.js" type="text/javascript"></script>
		
		<script src="<?=base_url('assets/backend/');?>plugins/icon-picker/simple-iconpicker.js" type="text/javascript"></script>
		
		<script src="<?=base_url('assets/backend/');?>plugins/selectize/js/standalone/selectize.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/chart.js/Chart.bundle.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/nprogress/nprogress.js"></script>
		<script src="<?=base_url('assets/backend/');?>js/antrian_ajax.js"></script>
		<script>
			var base_url = "<?=base_url();?>";
			document.addEventListener("DOMContentLoaded", () => {
				setTimeout(function() {$('.se-pre-con').fadeOut('slow'); }, 500);
			});
			$(document).ready(function() {
				$('input[rel="txtTooltip"]').tooltip();
			});
			// notif_billing();
			function notif_billing(){
				$.ajaxQueue({
					type: 'POST',
					url: '/notif/billing',
					data: {key: 'cart'},
					cache: false,
					dataType:"json",
					success: function (data) {
						if (data.status==200) {
							$('.count-cart').html(data.count);
							notif_detail(data.count);
						}
					}
				});
			}
			function notif_detail(a){
				var count = $('.count-cart').text();
				$.ajaxQueue({
					type: 'POST',
					url: '/notif/billing',
					data: {key: 'detail'},
					cache: false,
					success: function (data) {
						console.log(data);
						if (a > 0) {
							$('.cart-detail').html(data);
						}
					}
				});
			}
		</script>
		
	</head>
	
	<body>
		<div class="wrapper">
			<header class="header-top no-print" header-theme="dark">
				<div class="container-fluid">
					<div class="d-flex justify-content-between">
						<div class="top-menu d-flex align-items-center">
							<button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
							<button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
						</div>
						<div class="top-menu d-flex align-items-center">
							<a href="/" target="_blank" class="nav-link"><i class="ik ik-chrome"></i></a>
							<!--div class="dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="notiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-bell"></i><span class="badge bg-danger count-notif">0</span></a>
								<div class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="notiDropdown">
								<h4 class="header">Notifikasi</h4>
								<div class="notifications-wrap count-detail">
								
								</div>
								<div class="footer"><a href="javascript:void(0);">Lihat detail</a></div>
								</div>
							</div-->
							<button type="button" class="nav-link ml-10" id="apps_modal_btn" data-toggle="modal" data-target="#appsModal"><i class="ik ik-grid"></i></button>
							<div class="dropdown">
								<a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="<?=$User['img']; ?>" alt=""></a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
									<a class="dropdown-item" href="<?=base_url('profil');?>"><i class="ik ik-user dropdown-icon"></i> Profile</a>
									<a class="dropdown-item" href="<?=base_url('pesan-masuk');?>"><i class="ik ik-mail dropdown-icon"></i> Pesan Masuk</a>
									<a class="dropdown-item" href="<?=base_url();?>logout"><i class="ik ik-power dropdown-icon"></i> Logout</a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</header>
			<div class="page-wrap">
				<div class="app-sidebar colored no-print">
					<?php 
						include "sidebar.php"; 
					?>
				</div>
				
				<div class="main-content">
					<div class="container-fluid">
						<?php echo $contents; ?>
					</div>
				</div>
				<footer class="footer no-print">
					<div class="w-100 clearfix">
						<span class="text-center text-sm-left d-md-inline-block">Copyright © 2022 <?=tag_key('site_name');?> v2.0. All Rights Reserved. Page rendered in <strong>{elapsed_time}</strong> seconds. </span>
						<span class="float-none float-sm-right mt-1 mt-sm-0 text-center"></span>
					</div>
				</footer>
			</div>
		</div>
		<!-- ////////////////////////////////////////////////////////////////////////////-->
		
		<div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog" aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ik ik-x-circle"></i></button>
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="quick-search">
						<div class="container">
							<div class="row">
								<div class="col-md-4 ml-auto mr-auto">
									<div class="input-wrap">
										<input type="text" id="quick-search" onkeyup="myFunction()" class="form-control" placeholder="Cari..." />
										<i class="ik ik-search"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-body d-flex align-items-center">
						<div class="container">
							<div class="apps-wrap">
								<?php
									$sqp = $this->db->query("SELECT * from gtbl_user where email='$g_email'");
									$np =  $sqp->row_array();
									$idmp = $np['id_level'];
									$sidemenup = $np['idmenu'];
									$sqlp= $this->db->query("select * from menuadmin where idmenu IN ($sidemenup) AND idparent='0' AND aktif='Y' AND treeview!='header' order by urutan ");
									if($sqlp->num_rows() > 0){
										foreach ($sqlp->result_array() as $m)
										{
											$idlm = $m['id_level']; 
											$menuid = explode(",",$idlm);
											if (in_array($idmp, $menuid)){
												$nama_menu = $m['nama_menu'];
												$id_nama_menu = $m['nama_menu'];
												// echo $nama_menu;
												
												
												$sub= $this->db->query("SELECT * FROM menuadmin WHERE idmenu IN ($sidemenup) AND idparent=$m[idmenu] AND aktif='Y' AND treeview!='header' order by urutan");
												$jml= $sub->num_rows();
												// apabila sub menu ditemukan                
												if ($jml > 0){
													// echo 1;
													foreach ($sub->result_array() as $w)
													{
														$subids = $w['idmenu'];
														$sublvm = $w['id_level'];
														///
														$menuidsubs = explode(",",$sidemenup);
														if (in_array($subids, $menuidsubs)){
															$menulvs = explode(",",$sublvm);
															if (in_array($idmp, $menulvs)){
																if($w['treeview']!='treeview' AND $w['treeview']!='header'){
																	echo '<div class="app-item">
																	<a href="'.base_url('main/').$w['link'].'"><i class="fa '.$w['icon'].'"></i><span>'.$w['nama_menu'].'</span></a>
																	</div>';
																}
															}
														}
													}
												}
												if($m['treeview']!='treeview' AND $m['treeview']!='header'){
													echo '<div class="app-item"><a href="'.base_url('main/').$m['link'].'"><i class="fa '.$m['icon'].'"></i><span>'.$nama_menu.'</span></a></div>';
												}
												
											}
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="se-pre-con">
			<div class="loadingio-spinner-ellipsis-xx7opoxijwd"><div class="ldio-krq236z3xop">
				<div></div><div></div><div></div><div></div><div></div>
			</div></div>
		</div>
		<script src="<?=base_url('assets/backend/');?>plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/screenfull/dist/screenfull.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/moment/moment.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/jquery-minicolors/jquery.minicolors.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/mohithg-switchery/dist/switchery.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/d3/dist/d3.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/select2/dists/js/select2.min.js"></script>
		
		<script src="<?=base_url('assets/backend/');?>plugins/c3/c3.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>js/tables.js"></script>
		
		<script src="<?=base_url('assets/backend/');?>js/app.js"></script>
		<script src="<?=base_url('assets/backend/');?>js/widgets.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>plugins/summernote/dist/summernote-bs4.min.js"></script>
		<script src="<?=base_url('assets/backend/');?>dist/js/theme.js"></script>
		<script src="<?=base_url('assets/backend/');?>js/layouts.js"></script>
		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		<script>
			function myFunction() {
				// Declare variables
				var input, filter, ul, li, a, i, txtValue;
				input = document.getElementById('quick-search');
				filter = input.value.toUpperCase();
				ul = document.getElementById("myUL");
				li = ul.getElementsByTagName('li');
				
				// Loop through all list items, and hide those who don't match the search query
				for (i = 0; i < li.length; i++) {
					a = li[i].getElementsByTagName("a")[0];
					txtValue = a.textContent || a.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						li[i].style.display = "";
						} else {
						li[i].style.display = "none";
					}
				}
			}
			// (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			// function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			// e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			// e.src='https://www.google-analytics.com/analytics.js';
			// r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			// ga('create','UA-XXXXX-X','auto');ga('send','pageview');
			
			// $(document).ready(function() {
			// $(".se-pre-con").fadeIn(300);　
			// setTimeout(function(){
			// $(".se-pre-con").fadeOut(300);
			// },100);
			// $(".selectpicker").select2({
			// placeholder: "Pilih jenis",
			// width: '100%' // need to override the changed default
			// });
			// });
			
			function notif(m,t){
				$.notify({
					message: m 
					},{
					offset: 50,
					type: t,
					animate: {
						enter: 'animated fadeInRight',
						exit: 'animated fadeOutRight'
					},
					placement: {
						from: 'bottom',
						align: 'right'
					}
					
				});
			}
			
			
			function salert(sicon,stitle,stext){
				Swal.fire({
					icon: sicon,
					title: stitle,
					text: stext,
					footer: '<a href="#">Mengapa saya memiliki masalah ini?</a>'
				});
			}
			showToastPosition = function (position,judul,teks,ikon) {
				'use strict';
				resetToastPosition();
				$.toast({
					heading: judul,
					text: teks,
					position: String(position),
					icon: ikon,
					stack: false,
					loaderBg: '#f96868'
				})
			}
			resetToastPosition = function() {
				$('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
				$(".jq-toast-wrap").css({
					"top": "",
					"left": "",
					"bottom": "",
					"right": ""
				}); //to remove previous position style
			}
			showNotif = function(position,title,msg,style) {
				'use strict';
				resetToastPosition();
				$.toast({
					heading: title,
					text: msg,
					position: String(position),
					icon: style,
					stack: false,
					loaderBg: '#f96868'
				})
			}
			
			// $(".select2").select2();
			$(".select2").select2({
				placeholder: "--Pilih--",
				allowClear: true
			});
			NProgress.configure({
				showSpinner: false 
			});
			// NProgress.start();
			// setTimeout(function() {$('.se-pre-con').fadeOut('slow'); }, 1000);
			// $(window).load(function() {
			// // Animate loader off screen
			// $(".se-pre-con").fadeOut("slow");;
			// });
		</script>
		
	</body>
</html>