<div id="show_rubrik">
    <div class="td-block-row">
        <?php if(!empty($posts)){ foreach($posts as $row){ 
            $judul = $row['judul'];
            $seo = $row['judul_seo'];
            $tanggal = tgl_post($row['tanggal']);
            $dateatom = standard_date('DATE_ATOM', strtotime($row['tanggal']));
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
        <div class="td-block-span6">
								<!-- module -->
								<div class="td_module_1 td_module_wrap td-animation-stack">
									<div class="td-module-image">
										<div class="td-module-thumb">
											<a class="td-image-wrap" href="<?=$seo;?>" rel="bookmark" title="<?=$judul;?>"><img alt="" class="entry-thumb td-animation-stack-type0-2" data-img-url="<?=$gambar;?>" data-type="image_tag" height="160" src="<?=$gambar;?>" title="<?=$judul;?>" width="300"></a>
										</div><a class="td-post-category" href="/rubrik/<?=$kategoriseo;?>"><?=$kategori;?></a>
									</div>
									<h3 class="entry-title td-module-title"><a href="<?=$seo;?>" rel="bookmark" title="<?=$judul;?>"><?=$judul;?></a></h3>
									<div class="meta-info">
										<span class="td-post-author-name"><a href="#"><?=editor($row['id_publisher']);?></a> <span>-</span></span> <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="<?=$dateatom;?>"><?=$tanggal;?></time></span>
									</div>
								</div>
							</div><!-- ./td-block-span6 -->
        <?php } ?>
        </div>
        <div class="page-nav td-pb-padding-side">
            <?php echo $this->paging_rubrik->create_links(); ?>
        </div>
    </div>
    <script>
		(function($){
			$(".entry-title").dotdotdot({	height: 70,	fallbackToLetter: true,	watch: true});
		})(jQuery);
	</script>
    <?php }else{ ?>
    <p>Post not found...</p>
<?php } ?>