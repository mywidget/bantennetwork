<header id="homepage">
    <div class="owl-carousel owl-theme content" id="slide-header">
		<?php foreach($berita AS $row){ 
			$thnt = folderthn($row['folder']);
			$blnt = folderbln($row['folder']);
			$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/1300x670_'.$row['gambar'];
			$size = @getimagesize($opathFile);
			if($size !== false){
				$gambar = '/assets/post/'.$thnt.'/'.$blnt.'/1300x670_'.$row['gambar'];
				}else{
				$gambar = "/assets/no_photo.jpg";
			}
		?>
		<div class="item">
			<a href="/detail/<?=$row['judul_seo'];?>">
				<figure>
					<img alt="Image" src="<?=$gambar;?>">
				</figure>
				<div class="content__text">
					<p class="categori"><?=$row['nama_kategori'];?></p>
					<p class="date"><?=dtimes($row['tanggal'],true,true);?></p>
					<h4><?=$row['judul'];?></h4>
				</div></a>
		</div>
		<?php } ?>
	</div>
</header>

<main class="container" id="berita-terkini">
	<header>
	<h4><span>program</span></h4>
	</header>
	<div class="postList">
		<?php foreach($terbaru AS $row){ 
			$postID = $row['id_post'];
			$thnt = folderthn($row['folder']);
			$blnt = folderbln($row['folder']);
			$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
			$size = @getimagesize($opathFile);
			if($size !== false){
				$gambar = '/assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
				}else{
				$gambar = "/assets/no_photo.jpg";
			}
			$durasi = formatDate($row['durasi']);
			if(!empty($durasi)){
				$label = '<span style="background:#ff0000">VIDEO</span>';
				}else{
				$label = '<span style="background:#000040;border-radius:15px;padding:2px 5px;color:#fff">'.$row['nama_kategori'].'</span>';
			}
		?>
		<section class="row">
			<a class="col-xs-4 col-sm-4 col-md-4 col-lg-4" href="<?=$row['judul_seo'];?>"><img alt="Image" src="<?=$gambar;?>" width="143"></a>
			<article class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<header>
					<div class="info">
						<p class="categori"><?=$label;?></p>
						<time datetime="<?=dtimes($row['tanggal'],true,false);?>"><?=datetimes($row['tanggal'],true,true);?></time>
						</div><a href="/detail/<?=$row['judul_seo'];?>">
					<h5><?=$row['judul'];?></h5></a>
				</header>
			</article>
		</section>
		<?php } ?>
	</div>
	<section class="wrapper-lainnya">
		<div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
			<span class="loding" style="display: none;"><span class="loding_txt">LOADING</span></span>
			<span id="<?=$postID; ?>" data-seo="<?=$seo;?>" class="show_more_cat" title="Load more posts">LAINNYA</span>
		</div>
	</section>
	<div class="banner-iklan" id="banner-top">
		<?php echo iklan(['status'=>'home','id'=>9]);?>
	</div>
	<header>
	<h4><span>artikel</span></h4>
	</header>
	<div class="postList">
		<?php foreach($artikel AS $row){ 
			$postID = $row['id_post'];
			$thnt = folderthn($row['folder']);
			$blnt = folderbln($row['folder']);
			$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
			$size = @getimagesize($opathFile);
			if($size !== false){
				$gambar = '/assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
				}else{
				$gambar = "/assets/no_photo.jpg";
			}
		?>
		<section class="row">
			<a class="col-xs-4 col-sm-4 col-md-4 col-lg-4" href="<?=$row['judul_seo'];?>"><img alt="Image" src="<?=$gambar;?>" width="143"></a>
			<article class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<header>
					<div class="info">
						<p class="categori"><?=$row['nama_kategori'];?></p><time datetime="<?=dtimes($row['tanggal'],true,false);?>"><?=datetimes($row['tanggal'],true,true);?></time>
						</div><a href="/detail/<?=$row['judul_seo'];?>">
					<h5><?=$row['judul'];?></h5></a>
				</header>
			</article>
		</section>
		<?php } ?>
	</div>
	<section class="wrapper-lainnya">
		<div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
			<span id="<?=$postID; ?>" data-seo="artikel" class="show_more_cat" title="Load more posts">LAINNYA</span>
		</div>
	</section>
</main>


