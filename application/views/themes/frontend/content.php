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
                                                                    <span class="td-post-author-name">
                                                                        <a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span>
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
                                                
                                            </div></div><div class="clearfix"></div>
                                    </div>
                                </div>
                                <!-- ./block -->
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tdi_7_60f" class="tdc-row">
                    <div class="vc_row td-ss-row wpb_row td-pb-row" >
                        <div class="vc_column wpb_column vc_column_container tdc-column td-pb-span8">
                            <div class="wpb_wrapper">
                                <div class="td-fix-index">
                                </div>
                                <div class="td_block_wrap  td-pb-border-top td_block_template_1">
                                    <h2 class="block-title"><span class="td-pulldown-size">BERITA TERKINI</span></h2>
                                    <div class="td_block_inner">
                                        <div class="td-block-row">
                                            <?php
                                                foreach($terkini AS $row2)
                                                { 
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
                                        <a href="#" class="td_ajax_load_more td_ajax_load_more_js">Berita Lainnya<i class="td-icon-font td-icon-menu-down"></i>
                                        </a>
                                    </div>
                                </div> <!-- ./block -->
                                <?=blok_widget(array('id'=>1));?>
                            
                                
                                <style>
/* custom css */
.tdi_25_68f .td-post-vid-time{
					display: block;
				}
</style><script>var block_tdi_25_68f = new tdBlock();
block_tdi_25_68f.id = "tdi_25_68f";
block_tdi_25_68f.atts = '{"custom_title":"Peristiwa","category_id":"23","limit":"6","ajax_pagination":"next_prev","block_type":"td_block_15","separator":"","custom_url":"","title_tag":"","block_template_id":"","border_top":"","color_preset":"","mx1_tl":"","mx2_tl":"","post_ids":"","category_ids":"","tag_slug":"","autors_id":"","installed_post_types":"","sort":"","offset":"","show_modified_date":"","video_popup":"","video_rec":"","video_rec_title":"","show_vid_t":"block","el_class":"","td_ajax_filter_type":"","td_ajax_filter_ids":"","td_filter_default_txt":"All","td_ajax_preloading":"","f_header_font_header":"","f_header_font_title":"Block header","f_header_font_settings":"","f_header_font_family":"","f_header_font_size":"","f_header_font_line_height":"","f_header_font_style":"","f_header_font_weight":"","f_header_font_transform":"","f_header_font_spacing":"","f_header_":"","f_ajax_font_title":"Ajax categories","f_ajax_font_settings":"","f_ajax_font_family":"","f_ajax_font_size":"","f_ajax_font_line_height":"","f_ajax_font_style":"","f_ajax_font_weight":"","f_ajax_font_transform":"","f_ajax_font_spacing":"","f_ajax_":"","f_more_font_title":"Load more button","f_more_font_settings":"","f_more_font_family":"","f_more_font_size":"","f_more_font_line_height":"","f_more_font_style":"","f_more_font_weight":"","f_more_font_transform":"","f_more_font_spacing":"","f_more_":"","mx1f_title_font_header":"","mx1f_title_font_title":"Article title","mx1f_title_font_settings":"","mx1f_title_font_family":"","mx1f_title_font_size":"","mx1f_title_font_line_height":"","mx1f_title_font_style":"","mx1f_title_font_weight":"","mx1f_title_font_transform":"","mx1f_title_font_spacing":"","mx1f_title_":"","mx1f_cat_font_title":"Article category tag","mx1f_cat_font_settings":"","mx1f_cat_font_family":"","mx1f_cat_font_size":"","mx1f_cat_font_line_height":"","mx1f_cat_font_style":"","mx1f_cat_font_weight":"","mx1f_cat_font_transform":"","mx1f_cat_font_spacing":"","mx1f_cat_":"","mx1f_meta_font_title":"Article meta info","mx1f_meta_font_settings":"","mx1f_meta_font_family":"","mx1f_meta_font_size":"","mx1f_meta_font_line_height":"","mx1f_meta_font_style":"","mx1f_meta_font_weight":"","mx1f_meta_font_transform":"","mx1f_meta_font_spacing":"","mx1f_meta_":"","mx2f_title_font_header":"","mx2f_title_font_title":"Article title","mx2f_title_font_settings":"","mx2f_title_font_family":"","mx2f_title_font_size":"","mx2f_title_font_line_height":"","mx2f_title_font_style":"","mx2f_title_font_weight":"","mx2f_title_font_transform":"","mx2f_title_font_spacing":"","mx2f_title_":"","mx2f_cat_font_title":"Article category tag","mx2f_cat_font_settings":"","mx2f_cat_font_family":"","mx2f_cat_font_size":"","mx2f_cat_font_line_height":"","mx2f_cat_font_style":"","mx2f_cat_font_weight":"","mx2f_cat_font_transform":"","mx2f_cat_font_spacing":"","mx2f_cat_":"","mx2f_meta_font_title":"Article meta info","mx2f_meta_font_settings":"","mx2f_meta_font_family":"","mx2f_meta_font_size":"","mx2f_meta_font_line_height":"","mx2f_meta_font_style":"","mx2f_meta_font_weight":"","mx2f_meta_font_transform":"","mx2f_meta_font_spacing":"","mx2f_meta_":"","ajax_pagination_infinite_stop":"","css":"","tdc_css":"","td_column_number":2,"header_color":"","class":"tdi_25_68f","tdc_css_class":"tdi_25_68f","tdc_css_class_style":"tdi_25_68f_rand_style"}';
block_tdi_25_68f.td_column_number = "2";
block_tdi_25_68f.block_type = "td_block_15";
block_tdi_25_68f.post_count = "6";
block_tdi_25_68f.found_posts = "5880";
block_tdi_25_68f.header_color = "";
block_tdi_25_68f.ajax_pagination_infinite_stop = "";
block_tdi_25_68f.max_num_pages = "980";
tdBlocksArray.push(block_tdi_25_68f);
</script>
                                
                            </div>
                        </div>
                        
                        <div class="vc_column tdi_28_f11  wpb_column vc_column_container tdc-column td-pb-span4">
                            <div class="wpb_wrapper"><div class="wpb_wrapper td_block_wrap vc_raw_html tdi_30_b15 "></div><div class="td_block_wrap td_block_15 tdi_31_256 td-pb-full-cell td-pb-border-top td_block_template_1"  data-td-block-uid="tdi_31_256" >
                                <h4 class="block-title"><span class="td-pulldown-size">BISNIS</span></h4><div id=tdi_31_256 class="td_block_inner td-column-1">
                                    
                                    <div class="td-block-span12">
                                        
                                        <div class="td_module_mx1 td_module_wrap td-animation-stack">
                                            <div class="td-block14-border"></div>
                                            <div class="td-module-thumb"><a href="https://www.bantennews.co.id/pesan-baja-pt-krakatau-steel-kini-bisa-lewat-aplikasi-smartphone/" rel="bookmark" class="td-image-wrap " title="Pesan Baja PT Krakatau Steel Kini Bisa Lewat Aplikasi Smartphone" ><img class="entry-thumb" src alt title="Pesan Baja PT Krakatau Steel Kini Bisa Lewat Aplikasi Smartphone" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211127-WA0002-341x220.jpg" width="341" height="220"><noscript><img class="entry-thumb" src="" alt="" title="Pesan Baja PT Krakatau Steel Kini Bisa Lewat Aplikasi Smartphone" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211127-WA0002-341x220.jpg"  width="341" height="220" /></noscript></a></div>        
                                            
                                            <div class="meta-info">
                                                <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/pesan-baja-pt-krakatau-steel-kini-bisa-lewat-aplikasi-smartphone/" rel="bookmark" title="Pesan Baja PT Krakatau Steel Kini Bisa Lewat Aplikasi Smartphone">Pesan Baja PT Krakatau Steel Kini Bisa Lewat Aplikasi Smartphone</a></h3>            <div class="td-editor-date">
                                                <span class="td-post-author-name"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span> </span>                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-28T04:05:52+07:00" >Minggu, 28 Nov 2021 | 04:05 WIB</time></span>            </div>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                    </div> <!-- ./td-block-span12 -->
                                    
                                    <div class="td-block-span12">
                                        
                                        
                                        <div class="td_module_mx2 td_module_wrap td-animation-stack">
                                            
                                            <div class="td-module-thumb"><a href="https://www.bantennews.co.id/harga-kripto-naik-terdampak-tren-metaverse-sejumlah-negara-siapkan-kedutaan-digital/" rel="bookmark" class="td-image-wrap " title="Harga Kripto Naik Terdampak Tren Metaverse, Sejumlah Negara Siapkan Kedutaan Digital" ><img class="entry-thumb" src alt title="Harga Kripto Naik Terdampak Tren Metaverse, Sejumlah Negara Siapkan Kedutaan Digital" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/06/IMG_20210605_203542-80x60.jpg" width="80" height="60"><noscript><img class="entry-thumb" src="" alt="" title="Harga Kripto Naik Terdampak Tren Metaverse, Sejumlah Negara Siapkan Kedutaan Digital" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/06/IMG_20210605_203542-80x60.jpg"  width="80" height="60" /></noscript></a></div>            
                                            <div class="item-details">
                                                <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/harga-kripto-naik-terdampak-tren-metaverse-sejumlah-negara-siapkan-kedutaan-digital/" rel="bookmark" title="Harga Kripto Naik Terdampak Tren Metaverse, Sejumlah Negara Siapkan Kedutaan Digital">Harga Kripto Naik Terdampak Tren Metaverse, Sejumlah Negara Siapkan Kedutaan Digital</a></h3>                <div class="meta-info">
                                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-27T00:05:44+07:00" >Sabtu, 27 Nov 2021 | 00:05 WIB</time></span>                                    </div>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                    </div> <!-- ./td-block-span12 -->
                                    
                                    <div class="td-block-span12">
                                        
                                        
                                        <div class="td_module_mx2 td_module_wrap td-animation-stack">
                                            
                                            <div class="td-module-thumb"><a href="https://www.bantennews.co.id/pt-ks-luncurkan-guard-rail-produk-baja-hilir-terbaru/" rel="bookmark" class="td-image-wrap " title="PT KS Luncurkan Guard Rail Produk Baja Hilir Terbaru" ><img class="entry-thumb" src alt title="PT KS Luncurkan Guard Rail Produk Baja Hilir Terbaru" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211126-WA0001-80x60.jpg" width="80" height="60"><noscript><img class="entry-thumb" src="" alt="" title="PT KS Luncurkan Guard Rail Produk Baja Hilir Terbaru" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211126-WA0001-80x60.jpg"  width="80" height="60" /></noscript></a></div>            
                                            <div class="item-details">
                                                <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/pt-ks-luncurkan-guard-rail-produk-baja-hilir-terbaru/" rel="bookmark" title="PT KS Luncurkan Guard Rail Produk Baja Hilir Terbaru">PT KS Luncurkan Guard Rail Produk Baja Hilir Terbaru</a></h3>                <div class="meta-info">
                                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-26T05:17:49+07:00" >Jumat, 26 Nov 2021 | 05:17 WIB</time></span>                                    </div>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                    </div> <!-- ./td-block-span12 -->
                                    
                                    <div class="td-block-span12">
                                        
                                        
                                        <div class="td_module_mx2 td_module_wrap td-animation-stack">
                                            
                                            <div class="td-module-thumb"><a href="https://www.bantennews.co.id/lindungi-konsumen-timbangan-pedagang-di-kota-tangerang-diuji-tera/" rel="bookmark" class="td-image-wrap " title="Lindungi Konsumen, Timbangan Pedagang di Kota Tangerang Diuji Tera" ><img class="entry-thumb" src alt title="Lindungi Konsumen, Timbangan Pedagang di Kota Tangerang Diuji Tera" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG_20211124_233805-80x60.jpg" width="80" height="60"><noscript><img class="entry-thumb" src="" alt="" title="Lindungi Konsumen, Timbangan Pedagang di Kota Tangerang Diuji Tera" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG_20211124_233805-80x60.jpg"  width="80" height="60" /></noscript></a></div>            
                                            <div class="item-details">
                                                <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/lindungi-konsumen-timbangan-pedagang-di-kota-tangerang-diuji-tera/" rel="bookmark" title="Lindungi Konsumen, Timbangan Pedagang di Kota Tangerang Diuji Tera">Lindungi Konsumen, Timbangan Pedagang di Kota Tangerang Diuji Tera</a></h3>                <div class="meta-info">
                                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-25T06:05:49+07:00" >Kamis, 25 Nov 2021 | 06:05 WIB</time></span>                                    </div>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                    </div> <!-- ./td-block-span12 -->
                                    
                                    <div class="td-block-span12">
                                        
                                        
                                        <div class="td_module_mx2 td_module_wrap td-animation-stack">
                                            
                                            <div class="td-module-thumb"><a href="https://www.bantennews.co.id/perumahan-dongkrak-investasi-dan-ekonomi-baru-di-tangerang-raya/" rel="bookmark" class="td-image-wrap " title="Perumahan Dongkrak Investasi dan Ekonomi Baru di Tangerang Raya" ><img class="entry-thumb" src alt title="Perumahan Dongkrak Investasi dan Ekonomi Baru di Tangerang Raya" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2020/09/IMG_20200915_205104-80x60.jpg" width="80" height="60"><noscript><img class="entry-thumb" src="" alt="" title="Perumahan Dongkrak Investasi dan Ekonomi Baru di Tangerang Raya" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2020/09/IMG_20200915_205104-80x60.jpg"  width="80" height="60" /></noscript></a></div>            
                                            <div class="item-details">
                                                <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/perumahan-dongkrak-investasi-dan-ekonomi-baru-di-tangerang-raya/" rel="bookmark" title="Perumahan Dongkrak Investasi dan Ekonomi Baru di Tangerang Raya">Perumahan Dongkrak Investasi dan Ekonomi Baru di Tangerang Raya</a></h3>                <div class="meta-info">
                                                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-25T04:13:56+07:00" >Kamis, 25 Nov 2021 | 04:13 WIB</time></span>                                    </div>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                    </div> <!-- ./td-block-span12 --></div></div> <!-- ./block --><div  class="vc_wp_rss wpb_content_element"><div class="td_block_template_1 widget widget_rss"><h4 class="block-title"><span><a class="rsswidget" href="https://www.bantennews.co.id/bantenesia/feed"><img class="rss-widget-icon jetpack-lazy-image" style="border:0" width="14" height="14" src="https://www.bantennews.co.id/wp-includes/images/rss.png" alt="RSS" data-lazy-src="https://www.bantennews.co.id/wp-includes/images/rss.png?is-pending-load=1" srcset="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"><noscript><img class="rss-widget-icon" style="border:0" width="14" height="14" src="https://www.bantennews.co.id/wp-includes/images/rss.png" alt="RSS" /></noscript></a> <a class="rsswidget" href="https://www.bantennews.co.id/bantenesia">BANTENESIA FEED</a></span></h4><ul><li><a class='rsswidget' href='https://www.bantennews.co.id/bantenesia/mata-kuliah-sosiolinguistik-jadi-minat-mahasiswa-di-prodi-sastra-indonesia-universitas-pamulang/'>Mata Kuliah Sosiolinguistik, Jadi Minat Mahasiswa di Prodi Sastra Indonesia Universitas Pamulang</a> <span class="rss-date">Sabtu, 27 Nov 2021 | 02:58 WIB</span> <cite>TEGUH FIRMAN S</cite></li><li><a class='rsswidget' href='https://www.bantennews.co.id/bantenesia/tokoh-politik-bukti-bahwa-retorika-berpengaruh-dalam-politik/'>Tokoh Politik Bukti Bahwa Retorika Berpengaruh dalam Politik</a> <span class="rss-date">Sabtu, 27 Nov 2021 | 02:57 WIB</span> <cite>Nyayu Fajrina Dwi Lestari</cite></li><li><a class='rsswidget' href='https://www.bantennews.co.id/bantenesia/toleransi-antar-umat-beragama-pada-novel-ayat-ayat-cinta-2/'>Toleransi Antar Umat Beragama pada Novel Ayat-ayat Cinta 2</a> <span class="rss-date">Sabtu, 27 Nov 2021 | 02:56 WIB</span> <cite>Adi Hermawan</cite></li><li><a class='rsswidget' href='https://www.bantennews.co.id/bantenesia/bersama-hashmicro-ima-sc-telkom-university-mengajak-audiens-untuk-mempersiapkan-karir-sebagai-corporate-marketing/'>Bersama HashMicro, IMA SC Telkom University Mengajak Audiens untuk Mempersiapkan Karir sebagai Corporate Marketing</a> <span class="rss-date">Jumat, 26 Nov 2021 | 04:06 WIB</span> <cite>vanecia</cite></li></ul></div></div><div class="td_block_wrap td_block_15 tdi_36_f33 td-pb-full-cell td_with_ajax_pagination td-pb-border-top td_block_template_1"  data-td-block-uid="tdi_36_f33" >
                                    <style>
                                        /* custom css */
                                        .tdi_36_f33 .td-post-vid-time{
                                        display: block;
                                        }
                                        </style><h4 class="block-title"><span class="td-pulldown-size">Kesehatan</span></h4><div id=tdi_36_f33 class="td_block_inner td-column-1">
                                        
                                        <div class="td-block-span12">
                                            
                                            <div class="td_module_mx1 td_module_wrap td-animation-stack">
                                                <div class="td-block14-border"></div>
                                                <div class="td-module-thumb"><a href="https://www.bantennews.co.id/63-1-persen-masyarakat-banten-puas-dengan-kinerja-wahidin-dalam-penanganan-covid-19/" rel="bookmark" class="td-image-wrap " title="63,1 Persen Masyarakat Banten Puas dengan Kinerja Wahidin dalam Penanganan Covid-19" ><img class="entry-thumb" src alt title="63,1 Persen Masyarakat Banten Puas dengan Kinerja Wahidin dalam Penanganan Covid-19" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211127-WA0003-341x220.jpg" width="341" height="220"><noscript><img class="entry-thumb" src="" alt="" title="63,1 Persen Masyarakat Banten Puas dengan Kinerja Wahidin dalam Penanganan Covid-19" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211127-WA0003-341x220.jpg"  width="341" height="220" /></noscript></a></div>        
                                                
                                                <div class="meta-info">
                                                    <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/63-1-persen-masyarakat-banten-puas-dengan-kinerja-wahidin-dalam-penanganan-covid-19/" rel="bookmark" title="63,1 Persen Masyarakat Banten Puas dengan Kinerja Wahidin dalam Penanganan Covid-19">63,1 Persen Masyarakat Banten Puas dengan Kinerja Wahidin dalam Penanganan Covid-19</a></h3>            <div class="td-editor-date">
                                                    <span class="td-post-author-name"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span> </span>                <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-27T22:00:52+07:00" >Sabtu, 27 Nov 2021 | 22:00 WIB</time></span>            </div>
                                                </div>
                                                
                                            </div>
                                            
                                            
                                        </div> <!-- ./td-block-span12 -->
                                        
                                        <div class="td-block-span12">
                                            
                                            
                                            <div class="td_module_mx2 td_module_wrap td-animation-stack">
                                                
                                                <div class="td-module-thumb"><a href="https://www.bantennews.co.id/polda-banten-gelar-keroyok-vaksinasi-lansia-di-pandeglang/" rel="bookmark" class="td-image-wrap " title="Polda Banten Gelar Keroyok Vaksinasi Lansia di Pandeglang" ><img class="entry-thumb" src alt title="Polda Banten Gelar Keroyok Vaksinasi Lansia di Pandeglang" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211127-WA0013-80x60.jpg" width="80" height="60"><noscript><img class="entry-thumb" src="" alt="" title="Polda Banten Gelar Keroyok Vaksinasi Lansia di Pandeglang" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211127-WA0013-80x60.jpg"  width="80" height="60" /></noscript></a></div>            
                                                <div class="item-details">
                                                    <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/polda-banten-gelar-keroyok-vaksinasi-lansia-di-pandeglang/" rel="bookmark" title="Polda Banten Gelar Keroyok Vaksinasi Lansia di Pandeglang">Polda Banten Gelar Keroyok Vaksinasi Lansia di Pandeglang</a></h3>                <div class="meta-info">
                                                    <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-27T14:10:39+07:00" >Sabtu, 27 Nov 2021 | 14:10 WIB</time></span>                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                            
                                        </div> <!-- ./td-block-span12 -->
                                        
                                        <div class="td-block-span12">
                                            
                                            
                                            <div class="td_module_mx2 td_module_wrap td-animation-stack">
                                                
                                                <div class="td-module-thumb"><a href="https://www.bantennews.co.id/satgas-covid-19-pastikan-wni-kini-bisa-masuk-ke-singapura-tanpa-karantina/" rel="bookmark" class="td-image-wrap " title="Satgas Covid-19 Pastikan WNI Kini Bisa Masuk ke Singapura Tanpa Karantina" ><img class="entry-thumb" src alt title="Satgas Covid-19 Pastikan WNI Kini Bisa Masuk ke Singapura Tanpa Karantina" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2020/12/IMG_20201208_231538-80x60.jpg" width="80" height="60"><noscript><img class="entry-thumb" src="" alt="" title="Satgas Covid-19 Pastikan WNI Kini Bisa Masuk ke Singapura Tanpa Karantina" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2020/12/IMG_20201208_231538-80x60.jpg"  width="80" height="60" /></noscript></a></div>            
                                                <div class="item-details">
                                                    <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/satgas-covid-19-pastikan-wni-kini-bisa-masuk-ke-singapura-tanpa-karantina/" rel="bookmark" title="Satgas Covid-19 Pastikan WNI Kini Bisa Masuk ke Singapura Tanpa Karantina">Satgas Covid-19 Pastikan WNI Kini Bisa Masuk ke Singapura Tanpa Karantina</a></h3>                <div class="meta-info">
                                                    <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-26T11:04:06+07:00" >Jumat, 26 Nov 2021 | 11:04 WIB</time></span>                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                            
                                        </div> <!-- ./td-block-span12 -->
                                        
                                        <div class="td-block-span12">
                                            
                                            
                                            <div class="td_module_mx2 td_module_wrap td-animation-stack">
                                                
                                                <div class="td-module-thumb"><a href="https://www.bantennews.co.id/capaian-vaksinasi-covid-19-kabupaten-tangerang-tembus-19-juta-penduduk/" rel="bookmark" class="td-image-wrap " title="Capaian Vaksinasi Covid-19 Kabupaten Tangerang Tembus 1,9 Juta Penduduk" ><img class="entry-thumb" src alt title="Capaian Vaksinasi Covid-19 Kabupaten Tangerang Tembus 1,9 Juta Penduduk" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/10/IMG_20211022_221245-80x60.jpg" width="80" height="60"><noscript><img class="entry-thumb" src="" alt="" title="Capaian Vaksinasi Covid-19 Kabupaten Tangerang Tembus 1,9 Juta Penduduk" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/10/IMG_20211022_221245-80x60.jpg"  width="80" height="60" /></noscript></a></div>            
                                                <div class="item-details">
                                                    <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/capaian-vaksinasi-covid-19-kabupaten-tangerang-tembus-19-juta-penduduk/" rel="bookmark" title="Capaian Vaksinasi Covid-19 Kabupaten Tangerang Tembus 1,9 Juta Penduduk">Capaian Vaksinasi Covid-19 Kabupaten Tangerang Tembus 1,9 Juta Penduduk</a></h3>                <div class="meta-info">
                                                    <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-26T10:02:57+07:00" >Jumat, 26 Nov 2021 | 10:02 WIB</time></span>                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                            
                                        </div> <!-- ./td-block-span12 -->
                                        
                                        <div class="td-block-span12">
                                            
                                            
                                            <div class="td_module_mx2 td_module_wrap td-animation-stack">
                                                
                                                <div class="td-module-thumb"><a href="https://www.bantennews.co.id/waspadai-penyakit-cacingan-pada-anak-bisa-pengaruhi-gizi-dan-tumbuh-kembang/" rel="bookmark" class="td-image-wrap " title="Waspadai Penyakit Cacingan Pada Anak, Bisa Pengaruhi Gizi dan Tumbuh Kembang" ><img class="entry-thumb" src alt title="Waspadai Penyakit Cacingan Pada Anak, Bisa Pengaruhi Gizi dan Tumbuh Kembang" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2019/12/IMG_20191226_014548-80x60.jpg" width="80" height="60"><noscript><img class="entry-thumb" src="" alt="" title="Waspadai Penyakit Cacingan Pada Anak, Bisa Pengaruhi Gizi dan Tumbuh Kembang" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2019/12/IMG_20191226_014548-80x60.jpg"  width="80" height="60" /></noscript></a></div>            
                                                <div class="item-details">
                                                    <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/waspadai-penyakit-cacingan-pada-anak-bisa-pengaruhi-gizi-dan-tumbuh-kembang/" rel="bookmark" title="Waspadai Penyakit Cacingan Pada Anak, Bisa Pengaruhi Gizi dan Tumbuh Kembang">Waspadai Penyakit Cacingan Pada Anak, Bisa Pengaruhi Gizi dan Tumbuh Kembang</a></h3>                <div class="meta-info">
                                                    <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-26T06:05:26+07:00" >Jumat, 26 Nov 2021 | 06:05 WIB</time></span>                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                            
                                        </div> <!-- ./td-block-span12 --></div><div class="td-next-prev-wrap"><a href="#" class="td-ajax-prev-page ajax-page-disabled" id="prev-page-tdi_36_f33" data-td_block_id="tdi_36_f33"><i class="td-icon-font td-icon-menu-left"></i></a><a href="#"  class="td-ajax-next-page" id="next-page-tdi_36_f33" data-td_block_id="tdi_36_f33"><i class="td-icon-font td-icon-menu-right"></i></a></div></div> <!-- ./block --></div></div></div></div><div id="tdi_41_f33" class="tdc-row"><div class="vc_row tdi_42_ab9  wpb_row td-pb-row" >
                                        <div class="vc_column tdi_44_abb  wpb_column vc_column_container tdc-column td-pb-span12">
                                        <div class="wpb_wrapper"></div></div></div></div></div>                </div>
    </div>
</div> <!-- /.td-main-content-wrap -->