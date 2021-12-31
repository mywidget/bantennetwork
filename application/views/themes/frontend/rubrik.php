<div class="td-container td-category-container">
    <div class="td-container-border">
        <!-- big grid -->
        <div class="td-pb-row">
            <div class="td-pb-span12">
                <div class="td-subcategory-header">
                    <div class="td_block_wrap td_block_big_grid tdi_9_1cc td-grid-style-1 td-hover-1 td-big-grids td-pb-border-top td_block_template_1" data-td-block-uid="tdi_9_1cc">
                        </style><div id="tdi_9_1cc" class="td_block_inner"><div class="td-big-grid-wrapper">
                            <div class="td_module_mx5 td-animation-stack td-big-grid-post-0 td-big-grid-post td-big-thumb">
                                
                                <?php
                                    
                                    foreach($headline1 AS $row1)
                                    { 
                                        $seo = base_url().$row1['judul_seo'];
                                        $tanggal = tgl_post($row1['tanggal']);
                                        $dateatom = standard_date('DATE_ATOM', strtotime($row1['tanggal']));
                                        $thnt = folderthn($row1['folder']);
                                        $blnt = folderbln($row1['folder']);
                                        $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/681x400_'.$row1['gambar'];
                                        $size = @getimagesize($opathFile);
                                        if($size !== false){
                                            $gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/681x400_'.$row1['gambar'];
                                            }else{
                                            $gambar = base_url()."assets/no_photo.jpg";
										}
									?>
                                    <div class="td-module-thumb">
                                        <a href="<?=$seo;?>" rel="bookmark" class="td-image-wrap " title="<?=$row1['judul'];?>" >
                                            <img src="<?=$gambar;?>" title="<?=$row1['judul'];?>" data-type="image_tag" data-img-url="<?=$gambar;?>" width="681" height="400">
                                            <noscript><img class="entry-thumb" src="<?=$gambar;?>" alt="" title="<?=$row1['judul'];?>" data-type="image_tag" data-img-url="<?=$gambar;?>"  width="681" height="400" /></noscript>
										</a>
									</div>            
                                    <div class="td-meta-info-container">
                                        <div class="td-meta-align">
                                            <div class="td-big-grid-meta">
                                                <h3 class="entry-title td-module-title">
                                                    <a href="<?=$seo;?>" rel="bookmark" title="<?=$row1['judul'];?>"><?=$row1['judul'];?></a>
												</h3>
                                                <div class="td-module-meta-info">
                                                    <span class="td-post-author-name">
                                                        <a href="#"><?=editor($row1['id_publisher']);?></a> <span>-</span>
													</span>
                                                    <span class="td-post-date">
                                                        <time class="entry-date updated td-module-date" datetime="<?=$dateatom;?>" ><?=$tanggal;?>
														</time>
													</span>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
                            
                            <?php 
                                foreach($headline2 AS $row1)
                                { 
                                    $judul = $row1['judul'];
                                    $seo = base_url().$row1['judul_seo'];
                                    $tanggal = tgl_post($row1['tanggal']);
                                    $dateatom = standard_date('DATE_ATOM', strtotime($row1['tanggal']));
                                    $thnt = folderthn($row1['folder']);
                                    $blnt = folderbln($row1['folder']);
                                    $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/681x400_'.$row1['gambar'];
                                    $size = @getimagesize($opathFile);
                                    if($size !== false){
                                        $gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/681x400_'.$row1['gambar'];
                                        }else{
                                        $gambar = base_url()."assets/no_photo.jpg";
									}
								?>
                                <div class="td_module_mx6 td-animation-stack td-big-grid-post-4 td-big-grid-post td-tiny-thumb">
                                    
                                    <div class="td-module-thumb">
                                        <a href="<?=$seo;?>" rel="bookmark" class="td-image-wrap " title="<?=$judul;?>"><img class="entry-thumb td-animation-stack-type0-2" src="<?=$gambar;?>" alt="" title="<?=$judul;?>" data-type="image_tag" data-img-url="<?=$gambar;?>" width="238" height="178"></a>
									</div>            
                                    <div class="td-meta-info-container">
                                        <div class="td-meta-align">
                                            <div class="td-big-grid-meta">
                                                <h3 class="entry-title td-module-title"><a href="<?=$seo;?>" rel="bookmark" title="<?=$judul;?>"><?=$judul;?></a></h3>
                                                <div class="td-module-meta-info">
												<span class="td-post-date"><time class="entry-date updated td-module-date" datetime="<?=$dateatom;?>"><?=$tanggal;?></time></span></div>
											</div>
										</div>
									</div>
                                    
								</div>
							<?php } ?>
						</div>
                        <div class="clearfix"></div>
					</div>
				</div> <!-- ./block -->
			</div>
		</div>
	</div>
    
    <!-- content -->
    <div class="td-pb-row">
		<div class="td-pb-span8 td-main-content">
			<div class="td-ss-main-content">
				<div class="clearfix"></div>
				<div class="td-category-header td-pb-padding-side">
					<header>
						<h1 class="entry-title td-page-title"><span><?=$kategori;?></span></h1>
					</header>
					<div class="entry-crumbs">
						<span><a class="entry-crumb" href="/rubrik/<?=$kategoriseo;?>" title="">Beranda</a></span> <i class="td-icon-right td-bread-sep td-bred-no-url-last"></i> <span class="td-bred-no-url-last"><?=$kategori;?></span>
					</div>
				</div>
				<div id="show_rubrik">
					<div class="td-block-row">
						<?php
							foreach($posts as $row){
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
						
					</div><!--./row-fluid-->
					
					
					
					
					<div class="page-nav td-pb-padding-side">
						<?php echo $this->paging_rubrik->create_links(); ?>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="td-pb-span4 td-main-sidebar">
			<div class="td-ss-main-sidebar" style="width: 339px; position: static; top: auto; bottom: auto; z-index: 1;">
				<div class="clearfix"></div>
				  <?=iklan(['status'=>'detail','id'=>5]);?>
				
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	function searchRubrik(page_num){
		page_num = page_num?page_num:0;
		var cat = "<?=$kategoriseo;?>";
		$.ajax({
			type: 'POST',
			url: '/rubrik/rubrikPagination/'+page_num,
			data:'page='+page_num+'&cat='+cat,
			beforeSend: function(){
				$('.loading').show();
			},
			success: function(html){
				$('#show_rubrik').html(html);
				$('.loading').fadeOut("slow");
			}
		});
	}
	</script>			