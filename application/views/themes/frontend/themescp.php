
<!DOCTYPE html>
<html id="tempoco-2017" lang="en">
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="original-source" href="<?=$canonical; ?>" />
		<link rel="canonical" href="<?=$canonical; ?>" />
		<meta http-equiv="refresh" content="350" />
		
		<meta name="description" content="<?=$description;?>"/>
		<meta name="keywords" content="<?=$keywords;?>"/>
		
		<meta property="og:type" content="Website" />
		<meta property="og:title" content="<?=$title;?>" />
		<meta property="og:description" content="<?=$description;?>">
		<meta property="og:image" content="<?=$url_image; ?>" />
		<meta property="og:url" content="<?=$canonical; ?>" />
		<meta property="og:site_name" content="lenteranews.tv" />
		<meta property="og:locale" content="id_ID" />
		
		<meta content="all" name="robots"/>
		<meta content="index, follow, max-image-preview:large" name="robots"/>
		<meta content="index, follow" name="yahoobot"/>
		<link rel="image_src" href="<?=$url_image; ?>" />
		
		<meta name="adx:sections" content="home" />
		<link rel="alternate" type="application/rss+xml" title="Lenteranews.Tv RSS Feed" href="<?=base_url(); ?>/rss" />
		<link rel="shortcut icon" href="<?=base_url('assets/frontend/'); ?>images/favicon.png" type="image/x-icon">
		
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/frontend/'); ?>css/photoswipe.css">
		<link rel="stylesheet" href="<?=base_url('assets/frontend/'); ?>css/style.css"  />
		<link rel="stylesheet" href="<?=base_url('assets/frontend/'); ?>css/font-awesome.css">
		<link rel="stylesheet" href="<?=base_url('assets/frontend/'); ?>css/jssor.css">	
		<link rel="stylesheet" href="<?=base_url('assets/frontend/'); ?>css/iconpack-article.min.css">	
		<script async src="<?=base_url('assets/frontend/'); ?>js/jquery-3.4.1.min.js"></script>
		<script defer src="<?=base_url('assets/frontend/'); ?>js/core.js"></script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-158804877-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			
			gtag('config', 'UA-158804877-1');
			var tag = '';
		</script>
		<?php
			$attr = $this->uri->segment(1);
			if($attr=='detail'){ ?>
			<script>var detail = 'detail';</script>
			<?php }elseif($attr=='tag'){ 
				$_seo = cleanTag($this->uri->segment(2));
				$type = $this->input->get('type');
				$types = '';
				if(!empty($type)){
					$types = $this->input->get('type');
				}
			?>
			<script>
				var detail = '';var tag = 'tag';
				var base_url = "<?=base_url();?>";
				var keyseo = "<?=$_seo;?>";
				var types = "<?=$types;?>";
			</script>
			<?php }else{ ?>
			<script>var detail = '';</script>
		<?php } ?>
		<script defer src="<?=base_url('assets/frontend/'); ?>js/main-20180710v1.js?v3"></script>
		<?php if($attr!='detail' AND $attr!='tag'){ ?>
			<script defer src="<?=base_url('assets/frontend/'); ?>js/jssor.slider.min.js"></script>
			<script defer src="<?=base_url('assets/frontend/'); ?>js/option.js"></script>
		<?php } ?>
		<!--script defer src="<?=base_url('assets/frontend/'); ?>js/slider.js"></script-->
		<meta name="google-site-verification" content="" />
		<script type="application/ld+json">
			<?php echo json_encode($json,JSON_UNESCAPED_SLASHES); ?>
		</script>
		<link rel="preconnect" href="https://tags.crwdcntrl.net">
		<link rel="preconnect" href="https://bcp.crwdcntrl.net">
		<link rel="dns-prefetch" href="https://tags.crwdcntrl.net">            
		<link rel="dns-prefetch" href="https://bcp.crwdcntrl.net">
		<style>.async-hide { opacity: 0 !important} </style>
		
		
	</head>
	<body>
		<div class="container">
			<header>
				<div style="background:#fff;width:100%">
					<div class="container-desktop header-main">
						<div class="w-40">
							<a class="logo-tempo" href="https://lenteranews.tv">
								<img itemprop="image" src="<?=base_url('assets');?>/banner/logo.png" alt="Official logo LENTERANEWS.TV">
							</a>          
						</div>
						<div class="w-60">
							<img itemprop="image" src="/assets/banner/adv.jpg" alt="Banner">
						</div>
					</div>
				</div>
				<div class="header-bottom">
					<nav id="menu" class="menu clearfix">
						<div class="container-desktop scroll-container clearfix">
							<li><a id="Home" href="/">Home</a></li>
							<li><a id="News" href="<?=base_url('news');?>">News</a></li>
							<li><a id="Program" href="<?=base_url('program');?>">Program</a></li>
							<li><a id="Artikel" href="<?=base_url('artikel');?>">Artikel</a></li>
							<li><a id="Video" href="<?=base_url('video');?>">Video</a></li>
							<div id="search" class="col w-30" style="text-align:right;padding:2px 0 0 0">
								<form action="https://lenteranews.tv/search" method="get" id="text_cari">
									<div class="search">
										<a href="javascript:document.getElementById('text_cari').submit();"></a>
										<input type="search" placeholder="Cari berita" onfocus="this.placeholder = ''"
										onblur="this.placeholder = 'Cari berita'" name="q">
									</div>
								</form>
							</div>
						</div>
					</nav>
				</div>
			</header>
			
			<div class="content">
				<?php if($attr=='tag'  OR $attr=='search'){ ?>
					<main id="index" class="tag">
						<?php }else{ ?>
						<main id="home">
						<?php } ?>
						<div class="container-desktop">
							<div class="wrapper">
								<?php echo $contents; ?>
							</div>
						</div>
					</main>
				</div>
				<div class="footer">
					<footer>
						<div class="container-desktop">
							<div class="wrapper" style="padding:20px 0 !important">
								<div class="row clearfix">
									<div class="col w-30">
										<a class="logo-tempo" href="https://www.lenteranews.tv">
											<img itemprop="image" src="<?=base_url('assets');?>/banner/logo.png" alt="Official logo LENTERANEWS.TV">
										</a> 
										<p style="text-align:left;font-size:12pt">&copy; 2015 - 2021 Lenteranews.tv</p>
										<p style="text-align:left;font-size:12pt">All RIght Reserved</p>
									</div>
									<div class="cor w-65" style="float:right !important">
										<div class="cor w-60">
											<nav id="menufooter" class="menufooter">
												<div class="scroll-container" >
													<li><a id="Redaksi" href="<?=base_url('page/redaksi');?>">Redaksi</a></li>
													<li><a id="Pedoman" href="<?=base_url('page/pedoman-siber');?>">Pedoman Siber</a></li>
													<li><a id="About" href="<?=base_url('page/about-us');?>">About US</a></li>
													<li><a id="Disclaimer" href="<?=base_url('page/disclaimer');?>">Disclaimer</a></li>
													<li style="margin-right:0 !important;margin-right:0 !important"><a id="CopyrIght" href="<?=base_url('page/copyright');?>" style="margin-right:0 !important;margin-right:0 !important">CopyrIght</a></li>
												</div>
											</nav>
										</div>
										<div class="cor w-65">
											<span style="float:right !important;color:#fff;margin-right:25px">Follow US On Social Media</span>
											<ul class="social-media w-65" style="float:right !important;margin:10px 25px 0 0">
												<li><a class="instagram" href="https://www.instagram.com/" target="blank"></a></li>
												<li><a class="facebook" href="#" target="blank"></a></li>
												<li><a class="youtube" href="https://www.youtube.com/user/" target="blank"></a></li>
											</ul>
										</div>
									</div>
								</div>
								
								
							</div>
						</div>
						
					</footer>
				</div>
			</div>
			
		</body>
	</html>																