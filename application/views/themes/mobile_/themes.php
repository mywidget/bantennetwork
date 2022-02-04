<!DOCTYPE html>
<html lang="id-ID" id="top">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title><?=$title;?></title>
		<meta http-equiv="content-language" content="In-Id" />
		<meta name="author" content="PT AKURAT SENTRA MEDIA">
		<meta name="robots" content="index,follow" />
		<meta name="googlebot" content="index,follow" />
		<meta name="googlebot-news" content="index,follow" />
		<meta name="language" content="id" />
		<meta name="geo.country" content="id" />
		<meta name="geo.placename" content="Indonesia" />
		<link rel="original-source" href="<?=$canonical; ?>" />
		<link rel="canonical" href="<?=$canonical; ?>" />
		
		<meta name="description" content="<?=$description;?>"/>
		<meta name="keywords" content="<?=$keywords;?>"/>
		<meta name="news_keywords" content="">
		
		<meta property="og:type" content="Website" />
		<meta property="og:image" content="<?=$url_image; ?>" />
		<meta property="og:title" content="<?=$title;?>" />
		<meta property="og:description" content="<?=$description;?>">
		<meta property="og:url" content="<?=$canonical; ?>" />
		<meta property="og:site_name" content="lenteranews.tv" />
		<meta property="fb:app_id" content="" />
		
		
		<meta name="twitter:card" content="" />
		<meta name="twitter:site" content="lenteranews.tv" />
		<meta name="twitter:creator" content="lenteranews.tv">
		<meta name="twitter:title" content="<?=$title;?>" />
		<meta name="twitter:description" content="<?=$description;?>" />
		<meta name="twitter:image" content="<?=$url_image;?>" />
		
		<meta name="google-site-verification" content="" />
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="application-name" content="Lenteranews">
		<link rel="shortcut icon" type="image/png" sizes="192x192" href="<?=base_url('assets/frontend/'); ?>images/favicon.png">
		<link rel="icon" type="image/png" sizes="192x192" href="<?=base_url('assets/frontend/'); ?>images/favicon.png">
		
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-title" content="web starter kit">
		<link rel="apple-touch-icon" href="<?=base_url('assets/frontend/'); ?>images/favicon.png">
		<meta name="msapplication-tilecolor" content="#660000">
		<meta name="theme-color" content="#b30000">
		
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/mobile'); ?>/css/imageviewer.css?id=aeff9a402d6a86eca4f9">
		<link rel="stylesheet" href="<?= base_url('assets/mobile'); ?>/css/main.css?id=a0fc61024dd60ed5d714">
		<link rel="stylesheet" href="<?= base_url('assets/mobile'); ?>/css/mobile-custom.css">
		<link href="<?= base_url('assets/mobile'); ?>/css/owl.carousel.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/mobile'); ?>/css/owl.theme.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/mobile'); ?>/css/owl.transitions.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/mobile'); ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/mobile'); ?>/css/flaticon.css" rel="stylesheet" type="text/css" />
		<script type="application/ld+json">
			<?php echo json_encode($json,JSON_UNESCAPED_SLASHES); ?>
		</script>
		<script src="<?= base_url('assets/mobile'); ?>/js/jquery.min.js"></script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-158804877-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			
			gtag('config', 'UA-158804877-1');
			var base_url ="<?=base_url();?>";
		</script>
		
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<a class="navbar-cari-btn" href="/search">
					<figure class="custom-icon">
						<img alt="image" src="<?= base_url('assets/'); ?>icon/fa-search.png">
					</figure></a>
					<div class="navbar-brand">
						<figure class="custom-icon">
							<img alt="image" src="<?= base_url('assets/'); ?>icon/fa-bar.png">
						</figure>
					</div>
					<h1 style="font-size: 0px; margin: 0;height:20px!important"><a href="/" id="logo"><img alt="#" src="<?= base_url('assets/'); ?>banner/logo.png" height="30"></a></h1>
			</div>
			<div class="side-nav-wrapper" id="indexNav">
				<div class="sidenav">
					<div id="main-menu" class="list-group">
						<a id="Home" href="/" class='list-group-item'>Home</a>
						<a id="News" href="<?=base_url('news');?>" class='list-group-item'>News</a>
						<a id="Program" href="<?=base_url('program');?>" class='list-group-item'>Program</a>
						<a id="Artikel" href="<?=base_url('artikel');?>" class='list-group-item'>Artikel</a>
						<a id="Video" href="<?=base_url('video');?>" class='list-group-item'>Video</a>
					</div>
					
					
					<div class="item row">
						<div class="col-xs-12 social">
							
						</div>
					</div>
				</div>
			</div>
			<div class="nav-slide-item">
				<ul class="container" id="slide-navbar">
					<li><a id="Home" href="/">Home</a></li>
					<li><a id="News" href="<?=base_url('news');?>">News</a></li>
					<li><a id="Program" href="<?=base_url('program');?>">Program</a></li>
					<li><a id="Artikel" href="<?=base_url('artikel');?>">Artikel</a></li>
					<li><a id="Video" href="<?=base_url('video');?>">Video</a></li>
				</ul>
			</div>
		</nav>
		<?php echo $contents; ?>
		<footer class="pb-0">
			<svg class="display-none" height="0" width="0">
				<radialgradient cx="30%" cy="107%" id="rg" r="150%">
					<stop offset="0" stop-color="#fdf497"></stop>
					<stop offset="0.05" stop-color="#fdf497"></stop>
					<stop offset="0.45" stop-color="#fd5949"></stop>
					<stop offset="0.6" stop-color="#d6249f"></stop>
					<stop offset="0.9" stop-color="#285AEB"></stop>
				</radialgradient></svg>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 top">
							<a href="#"><img alt="image" class="img-responsive" src="<?=base_url('assets');?>/banner/logo.png"></a>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sitemap">
							<a id="Redaksi" href="<?=base_url('page/redaksi');?>">Redaksi</a>
							<a id="Pedoman" href="<?=base_url('page/pedoman-siber');?>">Pedoman Siber</a>
							<a id="About" href="<?=base_url('page/about-us');?>">About US</a>
							<a id="Disclaimer" href="<?=base_url('page/disclaimer');?>">Disclaimer</a>
							
							<p>&copy; 2015 - 2021 Lenteranews.tv. all rights reserved.</p>
						</div>
					</div>
				</div><a href="#top" id="top"><span class="fa-layers fa-fw"><i class="fas fa-circle"></i> <i class="fa fa-chevron-up"></i></span></a>
		</footer>
		<script src="<?=base_url('assets/mobile');?>/js/jquery-3.3.1.min.js" type="text/javascript"></script>  
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
		<script src="<?=base_url('assets/mobile');?>/js/jquery.jscroll.min.js"></script>
		<script src="<?=base_url('assets/mobile');?>/js/manifest.js?id=7999d63793f040b855fb"></script>
		<script src="<?=base_url('assets/mobile');?>/js/vendor.js?id=d4f4646ee5c75f3196e0"></script>
		<script src="<?=base_url('assets/mobile');?>/js/imageviewer.min.js" type="text/javascript"></script> 
		<script src="<?=base_url('assets/mobile');?>/js/main.js?id=66785030c1786ff84b90"></script>
		
		<script>
			$(document).on('click','.show_more',function(){
				var ID = $(this).attr('id');
				$('.show_more').hide();
				$('.loding').show();
				$.ajax({
					type:'POST',
					url:'/ajax/lainnya',
					data:'id='+ID,
					success:function(html){
						$('#show_more_main'+ID).remove();
						$('.postList').append(html);
					}
				});
			});
			$(document).on('click','.show_more_cat',function(){
				var ID = $(this).attr('id');
				var seo = $(this).data('seo');
				console.log(seo);
				$('.show_more_cat').hide();
				$('.loding').show();
				$.ajax({
					type:'POST',
					url:'/ajax/rubrik_lainnya',
					data:{id:ID,seo:seo},
					success:function(html){
						$('#show_more_main'+ID).remove();
						$('.postList').append(html);
					}
				});
			});
		</script>
	</body>
</html>