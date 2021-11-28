<?php
	$id = $item['id_post'];
	$judul = $item['judul'];
	$alias = $item['alias'];
	$editor = $item['alias'];
	$idcat = $item['id_cat'];
	$caption = $item['caption'];
	$judul_seo = base_url().'detail/'.$item['judul_seo'];
	$tanggal = waktu_lalu_2($item['tanggal']);
	$isi = $item['postingan'];
	$thnt = folderthn($item['folder']);
    $blnt = folderbln($item['folder']);
    $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/1300x670_'.$item['gambar'];
    $size = @getimagesize($opathFile);
    if($size !== false){
        $gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/1300x670_'.$item['gambar'];
        }else{
        $gambar = base_url()."assets/no_photo.jpg";
	}
    foreach($kategori as $rowz){
        $dataTz[$rowz['id_parent']][] = $rowz;
	}
	
?>
<main id="detail-berita">
	<article id="artikel">
		<main class="breadcrumb-wrapper">
			<ol class="breadcrumb">
				<li>
					<a href="/">home</a>
				</li>
				<?=breadcrumb_tag($dataTz,0,0,$item['id_cat']);?>
				
			</ol>
		</main>
		<header>
			<div class="container wrapper">
				<h1><?=$judul;?></h1>
				<p id="penulis">
					<a href="#"><?=editor($item['id_publisher']);?></a>
				</p>
				<time datetime="<?=$tanggal;?>">
					<?=$tanggal;?>
				</time>
				
				<span class="social--texts">| Bagikan:</span>
				<!-- facebook -->
				<a class="facebook" href="https://www.facebook.com/share.php?u=<?=base_url('detail/').$item['judul_seo'];?>" target="blank"><i class="fab fa-facebook"></i></a>
				
				<!-- twitter -->
				<a class="twitter" href="https://twitter.com/intent/tweet?status=<?=$item['judul'];?>+<?=base_url('detail/').$item['judul_seo'];?>" target="blank"><i class="fab fa-twitter"></i></a>
				<!-- whatsapp -->
				<a class="whatsapp" href="https://api.whatsapp.com/send?text=<?=base_url('detail/').$item['judul_seo'];?>" target="blank"><i class="fab fa-whatsapp"></i></a>
				<span class="social--texts">| View: <?=$item['dibaca'];?></span>
				
			</div>
			<figure itemscope="" itemtype="http://schema.org/ImageObject">
				<?php
					$durasi = formatDate($item['durasi']);
                    if(!empty($durasi)){
						preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $item['youtube'], $matches);
						$idy = $matches[1];
						
						
					?>
					<div class="embed-container">
						<a href="<?=base_url('detail/').$item['judul_seo'];?>" target="_blank">
							<img itemprop="image" src="<?=$gambar;?>" data-original-src="<?=$gambar;?>" alt="<?=$item['caption'];?>" class="radius-10 lazy">
						</a>
						<iframe src="https://www.youtube.com/embed/<?=$idy;?>?autoplay=1" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" allow="autoplay" frameborder="0"></iframe>
					</div>
					<?php
						
					}else{ ?>
					<img src="<?=$gambar;?>" alt="<?=$judul;?>" class="img-responsive">
				<?php } ?>
				<figcaption itemprop="caption">
					<p><?=$item['caption'];?></p>
				</figcaption>
				
			</figure>
		</header>
		<section class="container content-artikel">
			<?=$isi;?>
			
			<ins class="adsbygoogle"
			style="display:block; text-align:center;"
			data-ad-layout="in-article"
			data-ad-format="fluid"
			data-ad-client="ca-pub-7978532385409235"
			data-ad-slot="7144386218"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</section>
		
		<div class="nextp">
		</div>
		<footer class="container">
			<section id="tag">
				<?=tagmobile($item['id_post']);?>
			</section>
			<section id="editor">
				<h4>
					<svg class="svg-inline--fa fa-square fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="square" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48z"></path></svg><!-- <i class="fas fa-square    "></i> -->
					<?=editor($item['id_publisher']);?>
				</h4>
			</section>
			
		</footer>
	</article>
	<main id="berita-terkini" class="container">
		
		<span>berita terbaru</span>
		
		<div class="postList">
			<?=$terbaru;?>
		</div>
		<section class="wrapper-lainnya">
			<div class="show_more_main" id="show_more_main<?php echo $id; ?>">
				<span class="loding" style="display: none;"><span class="loding_txt">LOADING</span></span>
				<span id="<?php echo $id; ?>" class="show_more" title="Load more posts">BERITA LAINNYA</span>
			</div>
		</section>
	</main>
</main>
<style>
	.content-artikel {
	text-align: justify;
	text-justify: inter-word;
	}
	.embed-container{position:relative;padding-bottom:56.25%;height:0;overflow:hidden;max-width:100%}.embed-container embed,.embed-container iframe,.embed-container object{position:absolute;top:0;left:0;width:100%;height:100%}
</style>		