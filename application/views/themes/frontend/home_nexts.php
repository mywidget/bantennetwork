<?php if(!empty($next_data)){ ?>
	<div id="post_content_<?=$cat;?>" class="td_block_inner td-column-2">
		<div class="td-block-row">
			
			<?php
				$counter = 0;
				$num = 1;
				$html = '';
				
				foreach ($next_data->result() as $row)
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
					if($num < $limit){
						
						$html .= '<div class="td-block-span6"><div id="icon-container'.$cat.'" style="position:absolute;z-index:100;width:100%;height:100%;display:none"></div>
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
					$counter++;
					$num++;
				}
				echo $html;
				
			?>
		</div>
		
		<div class="td-next-prev-wrap">
			<a href="#prev" class="td-ajax-prev-page" id="prev-page-<?=$cat;?>" data-id="<?=$cat;?>"><i class="td-icon-font td-icon-menu-left"></i></a>
			<a href="#next" class="td-ajax-next-page" id="next-page-<?=$cat;?>" data-id="<?=$cat;?>"><i class="td-icon-font td-icon-menu-right"></i></a>
		</div>
	</div>	
	<script type="text/javascript">
	(function($){
		var offset=<?=$offset;?>;
		$("#next-page-<?=$cat;?>, #prev-page-<?=$cat;?>").click(function(){
			offset = ($(this).attr("id")=="next-page-<?=$cat;?>") ? offset + 4 : offset - 4;
			if (offset<0)
			offset=0;
			else
			loadCurrentPage<?=$cat;?>();
		});
		function loadCurrentPage<?=$cat;?>(){
			var nama = "<?=$nama;?>"
			var cat = "<?=$cat;?>";
			var limit = "<?=$limits;?>";
			var counter = "<?=$counter;?>";
			$.ajax({
				type: "POST",
				url: "/home/next_page",
				data:{offset:offset,cat:cat,nama:nama,limit:limit},
				cache: true,
				beforeSend: function (xhr) {
					$("#post_content_"+cat).addClass("td_block_inner_overflow td_animated_long td_fadeOut_to_1");
					$("#icon-container"+cat).show();
				},
				success: function (data) {
					if(data=="reload"){
						location.reload(); 
						return;
					}
					$("#icon-container"+cat).hide();
					$("#post_content_"+cat).removeClass("td_block_inner_overflow td_animated_long td_fadeOut_to_1");
					$("#post_content_"+cat).html(data);
				}
			});
		}
		
		
			var animation = bodymovin.loadAnimation({
				container: document.getElementById("icon-container<?=$cat;?>"), // required
				path: "/loading.json", // required
				renderer: "svg", // required
				loop: true, // optional
				autoplay: true, // optional
				name: "Demo Animation", // optional
			});
			$(".entry-title").dotdotdot({	height: 70,	fallbackToLetter: true,	watch: true});
			$(".title-sub").dotdotdot({	height: 50,	fallbackToLetter: true,	watch: true});
		})(jQuery);
	</script>	
<?php } ?>