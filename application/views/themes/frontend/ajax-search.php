<?php 
	
	if(!empty($posts)){
		echo '<div id="ResultCari">';
		foreach($posts AS $item){ 
			$thnt = folderthn($item['folder']);
			$blnt = folderbln($item['folder']);
			$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/864x467_'.$item['gambar'];
			$size = @getimagesize($opathFile);
			if($size !== false){
				$gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/864x467_'.$item['gambar'];
				}else{
				$gambar = base_url()."assets/no_photo.jpg";
			}
			
			$nama_kategori = $item['nama_kategori'];
			$kategori_seo = $item['kategori_seo'];
			$judul = $item['judul'];
			$seo = base_url().$item['judul_seo'];
			$isi = ($item['postingan']);
			$tanggal = tgl_post($item['tanggal']);
			$datePub = standard_date('DATE_ATOM', strtotime($item['tanggal']));
			$dateMod = standard_date('DATE_ATOM', strtotime($item['tanggal']));
		?>
		<div class="td_module_10 td_module_wrap td-animation-stack">
			<div class="td-module-thumb">
				<a href="<?=$seo;?>" rel="bookmark" class="td-image-wrap " title="<?=$judul;?>"><img class="entry-thumb td-animation-stack-type0-2" src="<?=$gambar;?>" alt="" title="<?=$judul;?>" data-type="image_tag" data-img-url="<?=$gambar;?>" width="180" height="135"></a>
			</div>            
			<div class="item-details">
				<h3 class="entry-title td-module-title">
				<a href="<?=$seo;?>" rel="bookmark" title="<?=$judul;?>"><?=$judul;?></a></h3>
				<div class="meta-info">
					<a href="/rubrik/<?=$kategori_seo;?>" class="td-post-category"><?=$nama_kategori;?></a>
					<span class="td-post-author-name"><a href="#"><?=editor($item['id_publisher']);?></a> <span>-</span> </span>
					<span class="td-post-date">
						<time class="entry-date updated td-module-date" datetime="<?=$datePub;?>"><?=$tanggal;?>
						</time>
					</span>
				</div>
				
				<div class="td-excerpt isi">
					<?=$isi;?>
				</div>
			</div>
		</div>
		
	<?php } ?>
	<script>
		(function($){
			$(".isi").dotdotdot({	height: 100,	fallbackToLetter: true,	watch: true});
		})(jQuery);
		</script>
		<div class="page-nav td-pb-padding-side">
			<?php echo $this->paging_rubrik->create_links(); ?>
		</div>
	</div>
<?php }else{ echo "Data tidak ditemukan";} ?>
