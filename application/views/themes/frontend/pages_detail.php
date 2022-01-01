<?php
    
    $opathFile = FCPATH.'assets/page/'.$item['photo'];
    $size = @getimagesize($opathFile);
    $gambar = '';
    if($item['status']=0){
        if($size !== false){
            $gambar = base_url().'assets/page/'.$item['photo'];
            }else{
            $gambar = base_url()."assets/no_photo.jpg";
        }
    }
    $judul = $item['judul'];
    $seo = base_url('page/').$item['judul_seo'];
    $isi = $item['isi'];
    $tanggal = tgl_post($item['create_date']);
    $datePub = standard_date('DATE_ATOM', strtotime($item['create_date']));
    $dateMod = standard_date('DATE_ATOM', strtotime($item['create_date']));
?>
<div class="td-container td-post-template-default">
    <div class="td-container-border">
        <div class="td-pb-row">
            <div class="td-pb-span8 td-main-content" role="main">
                <div class="td-ss-main-content"><div class="clearfix"></div>
                    
                    
                    <article id="post-441" class="post-441 post type-post status-publish format-standard hentry category-uncategorized" itemscope="" itemtype="https://schema.org/Article" 47="">
                        <div class="td-post-header td-pb-padding-side">
                            <div class="entry-crumbs"><span><a title="" class="entry-crumb" href="/">Beranda</a></span> <i class="td-icon-right td-bread-sep"></i> <span><a title="Lihat semua kiriman dalam halaman" class="entry-crumb" href="/page">Page</a></span> <i class="td-icon-right td-bread-sep td-bred-no-url-last"></i> <span class="td-bred-no-url-last"><?=$judul;?></span></div>
                            <!-- category --><ul class="td-category"><li class="entry-category"><a href="/page/">Page</a></li></ul>
                            <header>
                                <h1 class="entry-title"><?=$judul;?></h1>
                                <div class="meta-info">
                                    
                                    <!-- author -->
                                    <div class="td-post-author-name"><div class="td-author-by">Oleh</div> <a href="#">Bantennetwork</a><div class="td-author-line"> - </div> 
                                    </div>
                                    <!-- date -->
                                    <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="<?=$datePub;?>"><?=$tanggal;?></time>
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
                            <!-- content -->
                            <div itemprop="articleBody" class="dable-content-wrapper">
                                <?=$isi;?>
                            </div>
                            
                            
                            <footer>
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
                            </footer>
                            
                        </article> <!-- /.post -->
                        
                        
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="td-pb-span4 td-main-sidebar" role="complementary">
                    <div class="td-ss-main-sidebar" style="width: 339px; position: static; top: auto; bottom: auto; z-index: 1;">
                        <div class="clearfix"></div>
                        <?=iklan(['status'=>'detail','id'=>5]);?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div> <!-- /.td-pb-row -->
        </div>
    </div>        