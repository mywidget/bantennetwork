<div class="td_block_wrap td_block_15  td-pb-full-cell td-pb-border-top td_block_template_1">
	<h4 class="block-title"><span class="td-pulldown-size"><?=$nama;?></span></h4>
	<div id="post_content_<?=$cat;?>" class="td_block_inner td-column-2">
		<div class="td-block-row">
			
			<?php
				$num = 1;
				$html = '';
				foreach ($next_data as $row)
				{
					$penulis = 'Bantennetwork';
					$judul = $row->judul;
					$seo = $row->judul_seo;
					$tanggal = tgl_post($row->tanggal);
					$dateatom = standard_date('DATE_ATOM', strtotime($row->tanggal));
					$thnt = folderthn($row->folder);
					$blnt = folderbln($row->folder);
					$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row->gambar;
					$size = @getimagesize($opathFile);
					if($size !== false){
						$gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row->gambar;
						}else{
						$gambar = base_url()."assets/no_photo.jpg";
					}
					if($num < $limits){
						
						$html .= '<div class="td-block-span6">
						<div class="td_module_mx1 td_module_wrap td-animation-stack">
						<div class="td-block14-border"></div>
						<div class="td-module-thumb"><a href="'.$seo.'" rel="bookmark" class="td-image-wrap " title="'.$judul.'" ><img style="width: 341px; height: 220px; object-fit: cover;" src="'.$gambar.'" title="'.$judul.'" data-type="image_tag" data-img-url="'.$gambar.'" width="341" height="220"><noscript><img class="entry-thumb" src="'.$gambar.'" alt="" title="'.$judul.'" data-type="image_tag" data-img-url="'.$gambar.'"  width="341" height="220" /></noscript></a></div>        
						
						<div class="meta-info">
						<h3 class="entry-title td-module-title"><a href="'.$seo.'" rel="bookmark" title="'.$judul.'">'.$judul.'</a></h3>
						<div class="td-editor-date">
						<span class="td-post-author-name"><a href="#">'.$penulis.'</a> <span>-</span> </span><span class="td-post-date"><time class="entry-date updated td-module-date" datetime="'.$tanggal.'" >'.$dateatom.'</time></span>
						</div>
						</div>
						</div>
						</div> <!-- ./td-block-span6 -->';
						}else{
						
						$html .='<div class="td-block-span6">
						<div class="td_module_mx2 td_module_wrap td-animation-stack">
						<div class="td-module-thumb"><a href="'.$seo.'" rel="bookmark" class="td-image-wrap " title="'.$judul.'" ><img src="'.$gambar.'"  style="width: 80px; height: 60px; object-fit: cover;" title="'.$judul.'" data-type="image_tag" data-img-url="'.$gambar.'" width="80" height="60"><noscript><img class="entry-thumb" src="'.$gambar.'" alt="" title="'.$judul.'" data-type="image_tag" data-img-url="'.$gambar.'"  width="80" height="60" /></noscript></a></div>            
						<div class="item-details">
						<h3 class="entry-title td-module-title title-sub"><a href="'.$seo.'" rel="bookmark" title="'.$judul.'">'.$judul.'</a></h3>
						<div class="meta-info">
						<span class="td-post-date"><time class="entry-date updated td-module-date" datetime="'.$dateatom.'" >'.$tanggal.'</time></span></div>
						</div>
						
						</div>
						
						</div> <!-- ./td-block-span6 -->';
					}
					$num++;
				}
				echo $html;
			?>
		</div>
		<?=$this->ajax_paging->create_links();?>
	</div>	
</div>	
<script>
	
	(function($){
		
		$(".entry-title").dotdotdot({	height: 70,	fallbackToLetter: true,	watch: true});
		$(".title-sub").dotdotdot({	height: 50,	fallbackToLetter: true,	watch: true});
	})(jQuery);
</script>