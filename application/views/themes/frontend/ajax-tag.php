<?php 
	
	if(!empty($posts)){ ?>
	
	<?php foreach($posts AS $row){ 
		$postID = $row['id_post'];
		$thnt = folderthn($row['folder']);
		$blnt = folderbln($row['folder']);
		$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
		$size = @getimagesize($opathFile);
		if($size !== false){
			$gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
			}else{
			$gambar = base_url()."assets/no_photo.jpg";
		}
		
		$nama_kategori = $row['nama_kategori'];
		$kategori_seo = $row['kategori_seo'];
		$judul = $row['judul'];
		$seo = base_url().$row['judul_seo'];
		$isi =cleanString($row['postingan']);
		$isi =kalimat($isi,100);
		$tanggal =tgl_post($row['tanggal']);
		$datePub = standard_date('DATE_ATOM', strtotime($row['tanggal']));
		$dateMod = standard_date('DATE_ATOM', strtotime($row['tanggal']));
	?>
	<div class="td-block-span6">
		<!-- module -->
		<div class="td_module_4 td_module_wrap td-animation-stack">
			<div class="td-module-image">
				<div class="td-module-thumb"><a href="<?=$seo;?>" rel="bookmark" class="td-image-wrap " title="<?=$judul;?>"><img class="entry-thumb td-animation-stack-type0-2" src="<?=$gambar;?>" alt="" title="<?=$judul;?>" data-type="image_tag" data-img-url="<?=$gambar;?>" width="300" height="194"></a></div>
				<a href="/rubrik/<?=$kategori_seo;?>" class="td-post-category"><?=$nama_kategori;?></a>
			</div>
			
			<h3 class="entry-title td-module-title"><a href="<?=$seo;?>" rel="bookmark" title="<?=$judul;?>"><?=$judul;?></a></h3>
			<div class="meta-info">
				<span class="td-post-author-name">
					<a href="#"><?=editor($row['id_publisher']);?></a> 
				<span>-</span> </span>
				<span class="td-post-date">
					<time class="entry-date updated td-module-date" datetime="<?=$datePub;?>"><?=$tanggal;?></time>
				</span>
			</div>
			
			<div class="td-excerpt">
				<?=$isi;?>
			</div>
		</div>
	</div> <!-- ./td-block-span6 -->
	<?php } ?>
	<script>
		(function($){
			$(".entry-title").dotdotdot({	height: 70,	fallbackToLetter: true,	watch: true});
		})(jQuery);
	</script>
	<p><?php echo $this->ajax_paging->create_links(); ?></p>
	
<?php }else{ echo "Data tidak ditemukan";} ?>
