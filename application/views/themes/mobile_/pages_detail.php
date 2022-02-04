<?php
	$judul = $item['judul'];
	$isi = $item['isi'];
	
    $opathFile = FCPATH.'assets/page/'.$item['photo'];
    $size = @getimagesize($opathFile);
    if($size !== false){
        $gambar = base_url().'assets/page/'.$item['photo'];
        }else{
        $gambar = base_url()."assets/no_photo.jpg";
	}
    
?>
<main id="detail-berita">
	<article id="artikel">
		<main class="breadcrumb-wrapper">
			<ol class="breadcrumb">
				<li>
					<a href="/">home</a>
				</li>
				
				
			</ol>
		</main>
		<header>
			<div class="container wrapper">
				<h1><?=$judul;?></h1>
			</div>
			<figure itemscope="" itemtype="http://schema.org/ImageObject">
				<?php
					
                    if($item['status']==0)
					{
						
					?>
					<img src="<?=$gambar;?>" alt="<?=$judul;?>" class="img-responsive">
				<?php } ?>
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
	</article>
</main>
<style>
	.content-artikel {
	text-align: justify;
	text-justify: inter-word;
	}
	.embed-container{position:relative;padding-bottom:56.25%;height:0;overflow:hidden;max-width:100%}.embed-container embed,.embed-container iframe,.embed-container object{position:absolute;top:0;left:0;width:100%;height:100%}
</style>		