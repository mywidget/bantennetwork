<div class="td-main-content-wrap">
    <div class="td-container tdc-content-wrap">
        <div class="td-container-border">
            <div itemprop="articleBody" class="dable-content-wrapper">
                <div class="tdc-row">
                    <div class="vc_row wpb_row td-pb-row" >
                        <div class="vc_column  wpb_column vc_column_container tdc-column td-pb-span12">
                            <div class="wpb_wrapper">
                                <div class="td_block_wrap td_block_big_grid_6 td-grid-style-1 td-hover-1 td-big-grids td-pb-border-top td_block_template_1">
                                    <div class="td_block_inner">
                                        <div class="td-big-grid-wrapper">
                                            <div class="td_module_mx11 td-animation-stack td-big-grid-post-0 td-big-grid-post td-big-thumb">
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
                                            
                                            <div class="td-big-grid-scroll">
                                                <?php
                                                    $num = 1;
                                                    foreach($headline2 AS $row2)
                                                    { 
                                                        $judul = $row2['judul'];
                                                        $seo = base_url().$row2['judul_seo'];
                                                        $thnt = folderthn($row2['folder']);
                                                        $blnt = folderbln($row2['folder']);
                                                        $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row2['gambar'];
                                                        $size = @getimagesize($opathFile);
                                                        if($size !== false){
                                                            $gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row2['gambar'];
                                                            }else{
                                                            $gambar = base_url()."assets/no_photo.jpg";
                                                        }
                                                    ?>
                                                    <div class="td_module_mx10 td-animation-stack td-big-grid-post-<?=$num++;?> td-big-grid-post td-small-thumb">
                                                        <div class="td-module-thumb">
                                                            <a href="<?=$seo;?>" rel="bookmark" class="td-image-wrap " title="<?=$judul;?>" >
                                                                <img src="<?=$gambar;?>" title="<?=$judul;?>" data-type="image_tag" data-img-url="<?=$gambar;?>" width="340" height="220">
                                                                <noscript>
                                                                    <img class="entry-thumb" src="<?=$gambar;?>" alt="" title="<?=$judul;?>" data-type="image_tag" data-img-url="<?=$gambar;?>"  width="340" height="220" />
                                                                </noscript>
                                                            </a>
                                                        </div>            
                                                        <div class="td-meta-info-container">
                                                            <div class="td-meta-align">
                                                                <div class="td-big-grid-meta">
                                                                    <h3 class="entry-title td-module-title"><a href="<?=$seo;?>" rel="bookmark" title="<?=$judul;?>"><?=$judul;?></a></h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                
                                            </div></div>
                                            <div class="clearfix"></div>
                                    </div>
                                </div>
                                <!-- ./block -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tdc-row">
                    <div class="vc_row td-ss-row wpb_row td-pb-row" >
                        <div class="vc_column wpb_column vc_column_container tdc-column td-pb-span8">
                            <div class="wpb_wrapper">
                                <div class="td-fix-index" style="padding:10px">
                                    <?=iklan(['status'=>'homeatas','id'=>1]);?>
                                </div>
                                <div class="td_block_wrap  td-pb-border-top td_block_template_1">
                                    <h2 class="block-title" style="margin-top:10px"><span class="td-pulldown-size">BERITA TERKINI</span></h2>
                                    <div class="td_block_inner">
                                        <div class="td-block-row postList">
                                            <?php
                                                $postID =0;
                                                foreach($terkini AS $row2)
                                                { 
                                                    $postID = $row2['id_post'];
                                                    $judul = $row2['judul'];
                                                    $seo = base_url().$row2['judul_seo'];
                                                    $tanggal = tgl_post($row2['tanggal']);
                                                    $dateatom = standard_date('DATE_ATOM', strtotime($row2['tanggal']));
                                                    $thnt = folderthn($row2['folder']);
                                                    $blnt = folderbln($row2['folder']);
                                                    $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row2['gambar'];
                                                    $size = @getimagesize($opathFile);
                                                    if($size !== false){
                                                        $gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row2['gambar'];
                                                        }else{
                                                        $gambar = base_url()."assets/no_photo.jpg";
                                                    }
                                                ?>
                                                <div class="td-block-span6">
                                                    <div class="td_module_7 td_module_wrap td-animation-stack">
                                                        <div class="td-module-thumb">
                                                            <a href="<?=$seo;?>" rel="bookmark" class="td-image-wrap " title="<?=$judul;?>" ><img  style="width: 100px; height: 75px; object-fit: cover;" src="<?=$gambar;?>" title="<?=$judul;?>" data-type="image_tag" data-img-url="<?=$gambar;?>" width="100" height="75">
                                                                <noscript>
                                                                    <img class="entry-thumb" src="<?=$gambar;?>" alt="" title="<?=$judul;?>" data-type="image_tag" data-img-url="<?=$gambar;?>"  width="100" height="75" />
                                                                </noscript>
                                                            </a>
                                                        </div>
                                                        <div class="item-details">
                                                            <h3 class="entry-title td-module-title"><a href="<?=$seo;?>" rel="bookmark" title="<?=$judul;?>"><?=$judul;?></a></h3>
                                                            <div class="meta-info">
                                                            <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="<?=$dateatom;?>" ><?=$tanggal;?></time></span></div>
                                                        </div>
                                                    </div>
                                                </div> <!-- ./td-block-span6 -->
                                            <?php } ?>
                                        </div><!--./row-fluid-->
                                    </div>
                                    <div class="td-load-more-wrap">
                                        <div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
                                            <a href="#show_more_main" id="<?php echo $postID; ?>" class="td_ajax_load_more td_ajax_load_more_js">Berita Lainnya<i class="td-icon-font td-icon-menu-down"></i>
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div> <!-- ./block -->
                                <div class="td-fix-index" style="margin-bottom:5px">
                                    <?=iklan(['status'=>'homebawah','id'=>2]);?>
                                </div>
                                <?=load_block(1);?>
                                <div class="td-fix-index" style="margin-bottom:5px">
                                    <?=iklan(['status'=>'homebawah','id'=>8]);?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="vc_column wpb_column vc_column_container tdc-column td-pb-span4">
                            <div class="wpb_wrapper">
                                <?=iklan(['status'=>'home','id'=>3]);?>
                                <div class="wpb_wrapper td_block_wrap vc_raw_html tdi_30_b15 ">
                                    <?=load_block(2);?>
                                </div>
                                <?=iklan(['status'=>'home','id'=>4]);?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--div id="tdi_41_f33" class="tdc-row">
                    <div class="vc_row tdi_42_ab9  wpb_row td-pb-row" >
                    <div class="vc_column tdi_44_abb  wpb_column vc_column_container tdc-column td-pb-span12">
                    <div class="wpb_wrapper"></div>
                    </div>
                    </div>
                </div-->
            </div>
        </div>
    </div>
</div> <!-- /.td-main-content-wrap -->
<script>
    $(document).on('click','.td_ajax_load_more',function(){
        var ID = $(this).attr('id');
        $('.td_ajax_load_more').hide();
        $('.loding').show();
        $.ajax({
			type:'POST',
			url:'/ajax/lainnya',
			data:'id='+ID,
			success:function(html){
                $('#show_more_main'+ID).remove();
                $('.postList').append(html);
            }
        });
    });
    (function($){
        $(".entry-title").dotdotdot({	height: 70,	fallbackToLetter: true,	watch: true});
        $(".title-sub").dotdotdot({	height: 50,	fallbackToLetter: true,	watch: true});
    })(jQuery);
    
</script>