
<div id="post_content_<?=$cat;?>" class="td_block_inner td-column-2">
	<div class="td-block-row">
<?php
	$gambar = base_url()."assets/no_photo.jpg";
	$seo = base_url();
	$judul = "Bantennetwork No Data";
	$penulis = "Bantennetwork";
	$tanggal = date("Y-m-d H:i:s");
	$dateatom = standard_date('DATE_ATOM', strtotime($tanggal));
		echo '<div class="td-block-span6">
			<div class="td_module_mx1 td_module_wrap td-animation-stack">
				<div class="td-block14-border"></div>
				<div class="td-module-thumb"><a href="'.$seo.'" rel="bookmark" class="td-image-wrap "><img style="width: 341px; height: 220px; object-fit: cover;" src="'.$gambar.'" title="'.$judul.'" data-type="image_tag" ></a></div>        
				<div class="meta-info">
					<h3 class="entry-title td-module-title"><a href="'.$seo.'" rel="bookmark" title="'.$judul.'">'.$judul.'</a></h3>
					<div class="td-editor-date">
						<span class="td-post-author-name"><a href="#">'.$penulis.'</a> <span>-</span> </span><span class="td-post-date"><time class="entry-date updated td-module-date" datetime="'.$tanggal.'" >'.$dateatom.'</time></span>
					</div>
				</div>
			</div>
		</div> <!-- ./td-block-span6 -->';
		?>
	</div>
	
	<div class="td-next-prev-wrap">
		<a href="#prev" class="td-ajax-prev-page" id="prev-page-<?=$cat;?>" data-id="<?=$cat;?>"><i class="td-icon-font td-icon-menu-left"></i></a>
		<a href="#next" class="td-ajax-next-page" id="next-page-<?=$cat;?>" data-id="<?=$cat;?>"><i class="td-icon-font td-icon-menu-right"></i></a>
	</div>
</div>