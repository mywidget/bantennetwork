<div class="td-container">
    <div class="td-container-border">
        <div class="td-pb-row">
			<div class="td-pb-span8 td-main-content">
				<div class="td-ss-main-content"><div class="clearfix"></div>
					<div class="td-page-header td-pb-padding-side">
						<div class="entry-crumbs"><span><a title="" class="entry-crumb" href="/">Beranda</a></span> <i class="td-icon-right td-bread-sep td-bred-no-url-last"></i> <span class="td-bred-no-url-last">pencarian</span></div>                                    
						<h1 class="entry-title td-page-title">
							<span class="td-search-query"><?=$keywords;?></span> - <span> hasil pencarian</span>
						</h1>
						
						<div class="search-page-search-wrap">
							<form method="get" class="td-search-form-widget" action="/search/">
								<div role="search">
									<input class="td-widget-search-input" type="text" value="<?=$keywords;?>" name="s" id="s"><input class="wpb_button wpb_btn-inverse btn" type="submit" id="searchsubmit" value="pencarian">
								</div>
							</form>
							<div class="td_search_subtitle">
							Jika Anda tidak puas dengan hasilnya, silakan melakukan pencarian lain    </div>
						</div>
					</div>
					<!-- module -->
					
					<?php
						
						if(!empty($posts)){
							echo '<div id="ResultCari">';
							foreach($posts as $item){
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
							
							<?php
							} ?>
							<div class="page-nav td-pb-padding-side">
								<?php echo $this->paging_rubrik->create_links(); ?>
							</div>
					</div>
					<?php }else{
						echo "Tidak ada hasil untuk pencarian Anda";
					}
				?>
			<div class="clearfix"></div></div>
		</div>
		<div class="td-pb-span4 td-main-sidebar">
		<div class="td-ss-main-sidebar" style="width: 339px; position: static; top: auto; bottom: auto; z-index: 1;">
		<div class="clearfix"></div>
		 <?=iklan(['status'=>'detail','id'=>5]);?>
		<div class="clearfix"></div>
		</div>
		</div>
	</div> <!-- /.td-pb-row -->
</div>
</div>
<script>
	function searchAll(page_num){
		page_num = page_num?page_num:0;
		var keywords = "<?=$keywords;?>";
		$.ajax({
			type: 'POST',
			url: '/search/ajaxSearch/'+page_num,
			data:'page='+page_num+'&keywords='+keywords,
			beforeSend: function(){
				$('.loading').show();
			},
			success: function(html){
				$('#ResultCari').html(html);
				$('.loading').fadeOut("slow");
			}
		});
	}
	(function($){
		$(".isi").dotdotdot({	height: 100,	fallbackToLetter: true,	watch: true});
	})(jQuery);
	</script>		