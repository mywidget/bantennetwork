<?php
    $thnt = folderthn($item['folder']);
    $blnt = folderbln($item['folder']);
    $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/864x467_'.$item['gambar'];
    $size = @getimagesize($opathFile);
    if($size !== false){
        $gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/864x467_'.$item['gambar'];
        }else{
        $gambar = base_url()."assets/no_photo.jpg";
    }
    
    $seo = base_url().$item['judul_seo'];
    $judul = $item['judul'];
    $caption = $item['caption'];
    $isi = $item['postingan'];
    $tanggal = tgl_post($item['tanggal']);
    $datePub = standard_date('DATE_ATOM', strtotime($item['tanggal']));
    $dateMod = standard_date('DATE_ATOM', strtotime($item['tanggal']));
?>
<div class="td-container td-post-template-default">
    <div class="td-container-border">
        <div class="td-pb-row">
            <div class="td-pb-span8 td-main-content" role="main">
                <div class="td-ss-main-content"><div class="clearfix"></div>
                    <article id="post-120415" class="post type-post" itemscope="" itemtype="https://schema.org/Article">
                        <div class="td-post-header td-pb-padding-side">
                            <div class="entry-crumbs">
                                <span><a title="" class="entry-crumb" href="<?=base_url();?>">Beranda</a></span> <i class="td-icon-right td-bread-sep"></i> 
                                <span><a title="Lihat semua kiriman dalam <?=$nama_kategori;?>" class="entry-crumb" href="<?=$kategori_seo;?>"><?=ucwords($nama_kategori);?></a>
                                </span> <i class="td-icon-right td-bread-sep td-bred-no-url-last"></i> 
                                <span class="td-bred-no-url-last"><?=$judul;?></span>
                            </div>
                            <!-- category -->
                            <ul class="td-category"><li class="entry-category"><a href="<?=$kategori_seo;?>"><?=ucwords($nama_kategori);?></a></li></ul>
                            <header>
                                <h1 class="entry-title"><?=$judul;?></h1>
                                <div class="meta-info">
                                    <!-- author -->
                                    <div class="td-post-author-name"><div class="td-author-by">Oleh</div> <a href="https://www.bantennews.co.id/author/redaksi-2/"><?=editor($item['id_publisher']);?></a>
                                        <div class="td-author-line"> - </div> 
                                    </div>
                                    <!-- date -->
                                    <span class="td-post-date">
                                        <time class="entry-date updated td-module-date" datetime="<?=$datePub;?>"><?=$tanggal;?></time>
                                    </span>
                                </div>
                            </header>
                        </div>
                        
                        <div class="td-post-sharing-top td-pb-padding-side">
                            <div id="td_social_sharing_article_top" class="td-post-sharing td-ps-bg td-ps-notext td-post-sharing-style1 ">
                                <div class="td-post-sharing-visible">
                                    <a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-facebook" href="https://www.facebook.com/sharer.php?u=<?=$seo;?>" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                        <div class="td-social-but-icon"><i class="td-icon-facebook"></i></div>
                                        <div class="td-social-but-text">Facebook</div>
                                    </a>
                                    <a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-twitter" href="https://twitter.com/intent/tweet?text=<?=$judul;?>&amp;url=<?=$seo;?>&amp;via=<?=tag_key('site_title');?>" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                        <div class="td-social-but-icon"><i class="td-icon-twitter"></i></div>
                                        <div class="td-social-but-text">Twitter</div>
                                    </a>
                                    <a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-whatsapp" href="https://api.whatsapp.com/send?text=<?=$judul;?>%0A%0A <?=$seo;?>" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                        <div class="td-social-but-icon"><i class="td-icon-whatsapp"></i></div>
                                        <div class="td-social-but-text">WhatsApp</div>
                                    </a>
                                    <a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-telegram" href="https://telegram.me/share/url?url=<?=$seo;?>&amp;text=<?=$judul;?>" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                        <div class="td-social-but-icon"><i class="td-icon-telegram"></i></div>
                                        <div class="td-social-but-text">Telegram</div>
                                    </a>
                                </div>
                                <div class="td-social-sharing-hidden" style="display: none;">
                                    <ul class="td-pulldown-filter-list"></ul>
                                    <a class="td-social-sharing-button td-social-handler td-social-expand-tabs" href="#" data-block-uid="td_social_sharing_article_top">
                                        <div class="td-social-but-icon">
                                            <i class="td-icon-plus td-social-expand-tabs-icon"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="td-post-content td-pb-padding-side">
                            <!-- image -->
                            <div class="td-post-featured-image">
                                <figure>
                                    <a href="<?=$gambar;?>" data-caption="<?=$caption;?>" class="td-modal-image"><img class="entry-thumb td-animation-stack-type0-2" src="<?=$gambar;?>" width="640" height="428"></a>
                                    <figcaption class="wp-caption-text"><?=$caption;?></figcaption>
                                </figure>
                            </div>
                            <!-- content -->
                            <div itemprop="articleBody" class="dable-content-wrapper">
                                <?=$isi;?>
                            </div>
                        </div>
                        
                        <footer>
                            <div class="td-post-source-tags td-pb-padding-side">
                                <!-- tags -->
                                <?=tagshow($item['id_post']);?>
                            </div>
                            
                            <div class="td-post-sharing-bottom td-pb-padding-side">
                                <div id="td_social_sharing_article_bottom" class="td-post-sharing td-ps-bg td-ps-notext td-post-sharing-style1 ">
                                    <div class="td-post-sharing-visible">
                                        <a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-facebook" href="https://www.facebook.com/sharer.php?u=<?=$seo;?>" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                            <div class="td-social-but-icon"><i class="td-icon-facebook"></i></div>
                                            <div class="td-social-but-text">Facebook</div>
                                        </a>
                                        <a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-twitter" href="https://twitter.com/intent/tweet?text=<?=$judul;?>&amp;url=<?=$seo;?>&amp;via=<?=tag_key('site_name');?>" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                            <div class="td-social-but-icon"><i class="td-icon-twitter"></i></div>
                                            <div class="td-social-but-text">Twitter</div>
                                        </a>
                                        <a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-whatsapp" href="https://api.whatsapp.com/send?text=<?=$judul;?>%0A%0A <?=$seo;?>" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                            <div class="td-social-but-icon"><i class="td-icon-whatsapp"></i></div>
                                            <div class="td-social-but-text">WhatsApp</div>
                                        </a>
                                        <a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-telegram" href="https://telegram.me/share/url?url=<?=$seo;?>&amp;text=<?=$judul;?>" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                            <div class="td-social-but-icon"><i class="td-icon-telegram"></i></div>
                                            <div class="td-social-but-text">Telegram</div>
                                        </a>
                                    </div>
                                    <div class="td-social-sharing-hidden" style="display: none;">
                                        <ul class="td-pulldown-filter-list"></ul>
                                        <a class="td-social-sharing-button td-social-handler td-social-expand-tabs" href="#" data-block-uid="td_social_sharing_article_top">
                                            <div class="td-social-but-icon">
                                                <i class="td-icon-plus td-social-expand-tabs-icon"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- next prev -->
                            
                            <!-- meta -->
                            <span class="td-page-meta" itemprop="author" itemscope="" itemtype="https://schema.org/Person">
                                <meta itemprop="name" content="Bantennews">
                            </span>
                            <meta itemprop="datePublished" content="<?=$datePub;?>">
                            <meta itemprop="dateModified" content="<?=$dateMod;?>">
                            <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="<?=$seo;?>">
                            <span class="td-page-meta" itemprop="publisher" itemscope="" itemtype="https://schema.org/Organization">
                                <span class="td-page-meta" itemprop="logo" itemscope="" itemtype="https://schema.org/ImageObject">
                                    <meta itemprop="url" content="<?=$gambar;?>">
                                </span>
                                <meta itemprop="name" content="<?=tag_key('site_title');?>">
                            </span>
                            <meta itemprop="headline " content="<?=$judul;?>">
                            <span class="td-page-meta" itemprop="image" itemscope="" itemtype="https://schema.org/ImageObject">
                                <meta itemprop="url" content="<?=$gambar;?>">
                            </span>
                        </footer>
                        
                    </article> <!-- /.post -->
                    
                    <div class="td_block_wrap td_block_related_posts tdi_3_1f3 td_with_ajax_pagination td-pb-border-top td_block_template_1" data-td-block-uid="tdi_3_1f3">
                        <?=$terkait;?>
                    </div> <!-- ./block -->
                <div class="clearfix"></div></div>
            </div>
            <div class="td-pb-span4 td-main-sidebar" role="complementary">
                <div class="td-ss-main-sidebar" style="width: 339px; position: static; top: auto; bottom: auto;">
                    <div class="clearfix"></div>
                    
                    <?=iklan(['status'=>'detail','id'=>5]);?>
                    
                    <!-- POPULER-->
                    <div class="vc_wp_rss wpb_content_element">
                        <div class="td_block_template_1 widget widget_rss">
                            <h4 class="block-title">
                                <span><a class="rsswidget" href="#">
                                    <img class="rss-widget-icon jetpack-lazy-image" style="border:0" src="#" alt="RSS" data-lazy-src="#" srcset="#" width="14" height="14"><noscript><img class="rss-widget-icon" style="border:0" width="14" height="14" src="" alt="RSS" />
                                    </noscript></a>
                                    <a class="rsswidget" href="#">POPULER</a>
                                </span>
                            </h4>
                            <?=$populer;?>
                        </div>
                    </div>
                    <!-- end A --> 
                <div class="clearfix"></div></div>
            </div>
        </div> <!-- /.td-pb-row -->
    </div>
</div>                                