<?php
    $thnt = folderthn($item['folder']);
    $blnt = folderbln($item['folder']);
    $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/1300x670_'.$item['gambar'];
    $size = @getimagesize($opathFile);
    if($size !== false){
        $gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/1300x670_'.$item['gambar'];
        }else{
        $gambar = base_url()."assets/no_photo.jpg";
    }
    foreach($kategori as $rowz){
        $dataTz[$rowz['id_parent']][] = $rowz;
    }
    
?>
<div class="td-container td-post-template-default">
    <div class="td-container-border">
        <div class="td-pb-row">
            <div class="td-pb-span8 td-main-content" role="main">
                <div class="td-ss-main-content"><div class="clearfix"></div>
                    <article id="post-120415" class="post-120415 post type-post status-publish format-standard has-post-thumbnail hentry category-bisnis tag-boking-hotel tag-harga-hotel-di-anyer tag-hotel-di-kabupaten-serang tag-hotel-murah tag-kepala-satpol-pp-kabupaten-serang-ajat-sudrajat tag-pantai-anyer tag-protokol-kesehatan tag-satpol-pp-kabupaten-serang tag-tahun-baru" itemscope="" itemtype="https://schema.org/Article" 47="">
                        <div class="td-post-header td-pb-padding-side">
                            <div class="entry-crumbs"><span><a title="" class="entry-crumb" href="https://www.bantennews.co.id/">Beranda</a></span> <i class="td-icon-right td-bread-sep"></i> <span><a title="Lihat semua kiriman dalam Bisnis" class="entry-crumb" href="https://www.bantennews.co.id/category/bisnis/">Bisnis</a></span> <i class="td-icon-right td-bread-sep td-bred-no-url-last"></i> <span class="td-bred-no-url-last">Pemkab Serang Pastikan Pelayanan Hotel Laksanakan Prokes</span></div>
                            <!-- category --><ul class="td-category"><li class="entry-category"><a href="https://www.bantennews.co.id/category/bisnis/">Bisnis</a></li></ul>
                            <header>
                                <h1 class="entry-title">Pemkab Serang Pastikan Pelayanan Hotel Laksanakan Prokes</h1>
                                <div class="meta-info">
                                <!-- author --><div class="td-post-author-name"><div class="td-author-by">Oleh</div> <a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a><div class="td-author-line"> - </div> </div>                    <!-- date --><span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-12-27T16:12:03+07:00">Senin 27 Des 2021 16:12 WIB</time></span>                    <!-- modified date -->                    <!-- views -->                    <!-- comments -->                </div>
                            </header>
                        </div>
                        
                        <div class="td-post-sharing-top td-pb-padding-side">
                            <div id="td_social_sharing_article_top" class="td-post-sharing td-ps-bg td-ps-notext td-post-sharing-style1 ">
                                <div class="td-post-sharing-visible"><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-facebook" href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Fwww.bantennews.co.id%2Fpemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes%2F" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                    <div class="td-social-but-icon"><i class="td-icon-facebook"></i></div>
                                    <div class="td-social-but-text">Facebook</div>
                                    </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-twitter" href="https://twitter.com/intent/tweet?text=Pemkab+Serang+Pastikan+Pelayanan+Hotel+Laksanakan+Prokes&amp;url=https%3A%2F%2Fwww.bantennews.co.id%2Fpemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes%2F&amp;via=BantenNews.co.id+-Berita+Banten+Hari+Ini" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                    <div class="td-social-but-icon"><i class="td-icon-twitter"></i></div>
                                    <div class="td-social-but-text">Twitter</div>
                                    </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-pinterest" href="https://pinterest.com/pin/create/button/?url=https://www.bantennews.co.id/pemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes/&amp;media=https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19.jpeg&amp;description=Pemkab+Serang+Pastikan+Pelayanan+Hotel+Laksanakan+Prokes" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                    <div class="td-social-but-icon"><i class="td-icon-pinterest"></i></div>
                                    <div class="td-social-but-text">Pinterest</div>
                                    </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-whatsapp" href="https://api.whatsapp.com/send?text=Pemkab+Serang+Pastikan+Pelayanan+Hotel+Laksanakan+Prokes %0A%0A https://www.bantennews.co.id/pemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes/" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                    <div class="td-social-but-icon"><i class="td-icon-whatsapp"></i></div>
                                    <div class="td-social-but-text">WhatsApp</div>
                                    </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://www.bantennews.co.id/pemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes/&amp;title=Pemkab+Serang+Pastikan+Pelayanan+Hotel+Laksanakan+Prokes" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                    <div class="td-social-but-icon"><i class="td-icon-linkedin"></i></div>
                                    <div class="td-social-but-text">Linkedin</div>
                                    </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-telegram" href="https://telegram.me/share/url?url=https://www.bantennews.co.id/pemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes/&amp;text=Pemkab+Serang+Pastikan+Pelayanan+Hotel+Laksanakan+Prokes" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                    <div class="td-social-but-icon"><i class="td-icon-telegram"></i></div>
                                    <div class="td-social-but-text">Telegram</div>
                                    </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-line" href="https://line.me/R/msg/text/?Pemkab+Serang+Pastikan+Pelayanan+Hotel+Laksanakan+Prokes%0D%0Ahttps://www.bantennews.co.id/pemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes/">
                                    <div class="td-social-but-icon"><i class="td-icon-line"></i></div>
                                    <div class="td-social-but-text">LINE</div>
                                    </a></div><div class="td-social-sharing-hidden" style="display: none;"><ul class="td-pulldown-filter-list"></ul><a class="td-social-sharing-button td-social-handler td-social-expand-tabs" href="#" data-block-uid="td_social_sharing_article_top">
                                    <div class="td-social-but-icon"><i class="td-icon-plus td-social-expand-tabs-icon"></i></div>
                                </a></div></div></div>
                                <div class="td-post-content td-pb-padding-side">
                                    
                                    <!-- image --><div class="td-post-featured-image"><figure><a href="https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19.jpeg" data-caption="Pemerintah Kabupaten (Pemkab) Serang melalui Satuan Polisi Pamong Praja (Satpol PP) melakukan monitoring pelayanan hotel di sekitar Kecamatan Anyer dan Cinangka. " class="td-modal-image"><img class="entry-thumb td-animation-stack-type0-2" src="https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19-640x428.jpeg" srcset="https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19-640x428.jpeg 640w, https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19-300x200.jpeg 300w, https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19-768x513.jpeg 768w, https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19-250x167.jpeg 250w, https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19-629x420.jpeg 629w, https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19-537x360.jpeg 537w, https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19-681x455.jpeg 681w, https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19.jpeg 1024w" sizes="(max-width: 640px) 100vw, 640px" alt="" title="WhatsApp Image 2021-12-27 at 14.08.19" width="640" height="428"></a><figcaption class="wp-caption-text">Pemerintah Kabupaten (Pemkab) Serang melalui Satuan Polisi Pamong Praja (Satpol PP) melakukan monitoring pelayanan hotel di sekitar Kecamatan Anyer dan Cinangka. </figcaption></figure></div>
                                    <!-- content -->
                                    <div itemprop="articleBody" class="dable-content-wrapper"><p><strong>SERANG</strong> –&nbsp;Pemerintah Kabupaten (Pemkab) Serang melalui Satuan Polisi Pamong Praja (Satpol PP) melakukan monitoring pelayanan hotel di sekitar Kecamatan Anyer dan Cinangka. Hal tersebut untuk memastikan manajemen hotel melaksanakan protokol kesehatan (prokes) untuk pencegahan penyebaran Covid-19.</p>
                                        <p>Kepala Satpol PP Kabupaten Serang Ajat Sudrajat mengatakan, monitoring dilakukan sebagai bagian dari pelaksanaan Intruksi Bupati (Inbup) Serang Nomor 17 Tahun 2021 tentang Pencegahan dan Penanggulangan Covid-19 pada Natal dan Tahun Baru. “Termasuk kami monitoring, pengecekan penerapan aplikasi Peduli Lindungi di hotel-hotel sepanjang Anyer-Cinangka,” kata Ajat melalui keterangan tertulis, Senin (27/12/2021).</p><div class="td-a-rec td-a-rec-id-content_inline  tdi_2_823 td_block_template_1">
                                        </div>
                                        
                                        <p>Dalam proses monitoring, Satpol PP didampingi oleh aparatur TNI dari Kodim 0623/Cilegon dan kepolisian dari Polres Cilegon sebagai yang berwenang secara kewilayahan. Kemudian bersama pula Camat Cinangka dan Camat Anyer. “Kami sebagai bagian dari Satuan Tugas Penanganan Covid-19, mengoptimalisasi kerja sama untuk menanggulangi penyebaran Covid-19 selama libur Natal dan Tahun Baru,” ujar Ajat.</p>
                                        <p>Ajat menegaskan, seluruh hotel di wilayah Anyer dan Cinangka, wajib menyediakan barcode Peduli Lindungi bagi setiap tamu yang datang. “Tentu wajib juga menyediakan sarana protokol kesehatan. Kami cek seluruh hotel, dan wajib menjalankan Intruksi Bupati,” ujarnya.</p>
                                        <p>Menurutnya, seluruh hotel sudah mengetahui adanya Inbup Serang Nomor 17 Tahun 2021 melalui sosialisasi yang dilakukan oleh Perhimpunan Hotel dan Restoran Indonesia (PHRI) Kabupaten Serang. “Jadi tidak alasan untuk tidak melaksanakan. Semua wajib menjaga ketentraman, kenyaman, dan pencegahan penyebaran Covid-19,” ujar Ajat.</p>
                                        
                                        <p>Berdasarkan monitoring yang dilakukan, Ajat mengungkapkan, mayoritas hotel sudah menjalankan prokes dan menyediakan barcode aplikasi Peduli Lindungi. “Aplikasi ini sudah digunakan oleh sekira 75 persen hotel wilayah Anyer dan Cinangka,” ujar Ajat.</p>
                                        <p>Bagi yang belum menggunakan aplikasi Peduli Lindungi, Pemkab Serang memberikan panduan serta mendaftarkan akunnya. Siap mendampingi Diskominfosatik dan Disporapar Kabupaten Serang. “Bagi yang belum, kami akan cek kembali dan tindaklanjuti sampai semua hotel menggunakan aplikasi Peduli Lindungi. Ini sudah menjadi perintah Bupati Serang yang harus dijalankan,” ujarnya. <strong>(Red)</strong></p>
                                    </div>
                                </div>
                                
                                
                                <footer>
                                    <!-- post pagination -->            <!-- review -->
                                    <div class="td-post-source-tags td-pb-padding-side">
                                    <!-- source via -->                <!-- tags --><ul class="td-tags td-post-small-box clearfix"><li><span>LABEL</span></li><li><a href="https://www.bantennews.co.id/tag/boking-hotel/">boking hotel</a></li><li><a href="https://www.bantennews.co.id/tag/harga-hotel-di-anyer/">harga hotel di Anyer</a></li><li><a href="https://www.bantennews.co.id/tag/hotel-di-kabupaten-serang/">Hotel di kabupaten Serang</a></li><li><a href="https://www.bantennews.co.id/tag/hotel-murah/">hotel murah</a></li><li><a href="https://www.bantennews.co.id/tag/kepala-satpol-pp-kabupaten-serang-ajat-sudrajat/">Kepala Satpol PP Kabupaten Serang Ajat Sudrajat</a></li><li><a href="https://www.bantennews.co.id/tag/pantai-anyer/">Pantai Anyer</a></li><li><a href="https://www.bantennews.co.id/tag/protokol-kesehatan/">protokol kesehatan</a></li><li><a href="https://www.bantennews.co.id/tag/satpol-pp-kabupaten-serang/">satpol PP kabupaten serang</a></li><li><a href="https://www.bantennews.co.id/tag/tahun-baru/">Tahun baru</a></li></ul>            </div>
                                    
                                    <div class="td-post-sharing-bottom td-pb-padding-side"><div id="td_social_sharing_article_bottom" class="td-post-sharing td-ps-bg td-ps-notext td-post-sharing-style1 "><div class="td-post-sharing-visible"><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-facebook" href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Fwww.bantennews.co.id%2Fpemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes%2F" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                        <div class="td-social-but-icon"><i class="td-icon-facebook"></i></div>
                                        <div class="td-social-but-text">Facebook</div>
                                        </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-twitter" href="https://twitter.com/intent/tweet?text=Pemkab+Serang+Pastikan+Pelayanan+Hotel+Laksanakan+Prokes&amp;url=https%3A%2F%2Fwww.bantennews.co.id%2Fpemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes%2F&amp;via=BantenNews.co.id+-Berita+Banten+Hari+Ini" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                        <div class="td-social-but-icon"><i class="td-icon-twitter"></i></div>
                                        <div class="td-social-but-text">Twitter</div>
                                        </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-pinterest" href="https://pinterest.com/pin/create/button/?url=https://www.bantennews.co.id/pemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes/&amp;media=https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19.jpeg&amp;description=Pemkab+Serang+Pastikan+Pelayanan+Hotel+Laksanakan+Prokes" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                        <div class="td-social-but-icon"><i class="td-icon-pinterest"></i></div>
                                        <div class="td-social-but-text">Pinterest</div>
                                        </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-whatsapp" href="https://api.whatsapp.com/send?text=Pemkab+Serang+Pastikan+Pelayanan+Hotel+Laksanakan+Prokes %0A%0A https://www.bantennews.co.id/pemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes/" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                        <div class="td-social-but-icon"><i class="td-icon-whatsapp"></i></div>
                                        <div class="td-social-but-text">WhatsApp</div>
                                        </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://www.bantennews.co.id/pemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes/&amp;title=Pemkab+Serang+Pastikan+Pelayanan+Hotel+Laksanakan+Prokes" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                        <div class="td-social-but-icon"><i class="td-icon-linkedin"></i></div>
                                        <div class="td-social-but-text">Linkedin</div>
                                        </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-telegram" href="https://telegram.me/share/url?url=https://www.bantennews.co.id/pemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes/&amp;text=Pemkab+Serang+Pastikan+Pelayanan+Hotel+Laksanakan+Prokes" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                                        <div class="td-social-but-icon"><i class="td-icon-telegram"></i></div>
                                        <div class="td-social-but-text">Telegram</div>
                                        </a><a class="td-social-sharing-button td-social-sharing-button-js td-social-network td-social-line" href="https://line.me/R/msg/text/?Pemkab+Serang+Pastikan+Pelayanan+Hotel+Laksanakan+Prokes%0D%0Ahttps://www.bantennews.co.id/pemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes/">
                                        <div class="td-social-but-icon"><i class="td-icon-line"></i></div>
                                        <div class="td-social-but-text">LINE</div>
                                        </a></div><div class="td-social-sharing-hidden" style="display: none;"><ul class="td-pulldown-filter-list"></ul><a class="td-social-sharing-button td-social-handler td-social-expand-tabs" href="#" data-block-uid="td_social_sharing_article_bottom">
                                        <div class="td-social-but-icon"><i class="td-icon-plus td-social-expand-tabs-icon"></i></div>
                                    </a></div></div></div>            <!-- next prev -->            <!-- author box --><div class="td-author-name vcard author" style="display: none"><span class="fn"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a></span></div>	        <!-- meta --><span class="td-page-meta" itemprop="author" itemscope="" itemtype="https://schema.org/Person"><meta itemprop="name" content="Bantennews"></span><meta itemprop="datePublished" content="2021-12-27T16:12:03+07:00"><meta itemprop="dateModified" content="2021-12-27T16:12:03+07:00"><meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="https://www.bantennews.co.id/pemkab-serang-pastikan-pelayanan-hotel-laksanakan-prokes/"><span class="td-page-meta" itemprop="publisher" itemscope="" itemtype="https://schema.org/Organization"><span class="td-page-meta" itemprop="logo" itemscope="" itemtype="https://schema.org/ImageObject"><meta itemprop="url" content="https://www.bantennews.co.id/wp-content/uploads/2019/12/logo-banten-news-1.png"></span><meta itemprop="name" content="BantenNews.co.id -Berita Banten Hari Ini"></span><meta itemprop="headline " content="Pemkab Serang Pastikan Pelayanan Hotel Laksanakan Prokes"><span class="td-page-meta" itemprop="image" itemscope="" itemtype="https://schema.org/ImageObject"><meta itemprop="url" content="https://www.bantennews.co.id/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-27-at-14.08.19.jpeg"><meta itemprop="width" content="1024"><meta itemprop="height" content="684"></span>        </footer>
                                    
                    </article> <!-- /.post -->
                    
                    <div class="td_block_wrap td_block_related_posts tdi_3_1f3 td_with_ajax_pagination td-pb-border-top td_block_template_1" data-td-block-uid="tdi_3_1f3">
                        <h4 class="td-related-title">
                            <a id="tdi_4_061" class="td-related-left td-cur-simple-item" data-td_filter_value="" data-td_block_id="tdi_3_1f3" href="#">BERITA TERKAIT</a>
                            </h4><div id="tdi_3_1f3" class="td_block_inner">
                            
                            <div class="td-related-row">
                                
                                <div class="td-related-span4">
                                    
                                    <div class="td_module_related_posts td-animation-stack td_mod_related_posts">
                                        <div class="td-module-image">
                                        <div class="td-module-thumb"><a href="https://www.bantennews.co.id/pt-krakatau-steel-penuhi-kewajiban-pembayaran-utang-rp27-triliun/" rel="bookmark" class="td-image-wrap " title="PT Krakatau Steel Penuhi Kewajiban Pembayaran Utang Rp2,7 Triliun"><img class="entry-thumb td-animation-stack-type0-1" src="" alt="" title="PT Krakatau Steel Penuhi Kewajiban Pembayaran Utang Rp2,7 Triliun" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/12/IMG-20211227-WA0011-238x178.jpg" width="238" height="178"></a></div>                <a href="https://www.bantennews.co.id/category/bisnis/" class="td-post-category">Bisnis</a>            </div>
                                        <div class="item-details">
                                        <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/pt-krakatau-steel-penuhi-kewajiban-pembayaran-utang-rp27-triliun/" rel="bookmark" title="PT Krakatau Steel Penuhi Kewajiban Pembayaran Utang Rp2,7 Triliun">PT Krakatau Steel Penuhi Kewajiban Pembayaran Utang Rp2,7 Triliun</a></h3>            </div>
                                    </div>
                                    
                                </div> <!-- ./td-related-span4 -->
                                
                                <div class="td-related-span4">
                                    
                                    <div class="td_module_related_posts td-animation-stack td_mod_related_posts">
                                        <div class="td-module-image">
                                        <div class="td-module-thumb"><a href="https://www.bantennews.co.id/kenalkan-produk-pertanian-banten-stand-dwp-karantina-cilegon-diserbu/" rel="bookmark" class="td-image-wrap " title="Kenalkan Produk Pertanian Banten Stand DWP Karantina Cilegon Diserbu"><img class="entry-thumb td-animation-stack-type0-1" src="" alt="" title="Kenalkan Produk Pertanian Banten Stand DWP Karantina Cilegon Diserbu" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/12/FB_IMG_1640531792109-238x178.jpg" width="238" height="178"></a></div>                <a href="https://www.bantennews.co.id/category/bisnis/" class="td-post-category">Bisnis</a>            </div>
                                        <div class="item-details">
                                        <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/kenalkan-produk-pertanian-banten-stand-dwp-karantina-cilegon-diserbu/" rel="bookmark" title="Kenalkan Produk Pertanian Banten Stand DWP Karantina Cilegon Diserbu">Kenalkan Produk Pertanian Banten Stand DWP Karantina Cilegon Diserbu</a></h3>            </div>
                                    </div>
                                    
                                </div> <!-- ./td-related-span4 -->
                                
                                <div class="td-related-span4">
                                    
                                    <div class="td_module_related_posts td-animation-stack td_mod_related_posts">
                                        <div class="td-module-image">
                                            <div class="td-module-thumb"><a href="https://www.bantennews.co.id/bisnis-kue-kering-belvan-cake-and-bread-tangerang-yang-nikmat/" rel="bookmark" class="td-image-wrap " title="Bisnis Kue Kering Belvan Cake and Bread Tangerang yang Nikmat"><img class="entry-thumb td-animation-stack-type0-1" src="" alt="" title="Bisnis Kue Kering Belvan Cake and Bread Tangerang yang Nikmat" data-type="image_tag" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/12/IMG_20211226_162013-238x178.jpg" width="238" height="178"></a></div>
                                        <a href="https://www.bantennews.co.id/category/bisnis/" class="td-post-category">Bisnis</a>            </div>
                                        <div class="item-details">
                                        <h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/bisnis-kue-kering-belvan-cake-and-bread-tangerang-yang-nikmat/" rel="bookmark" title="Bisnis Kue Kering Belvan Cake and Bread Tangerang yang Nikmat">Bisnis Kue Kering Belvan Cake and Bread Tangerang yang Nikmat</a></h3>            </div>
                                    </div>
                                </div> <!-- ./td-related-span4 -->
                            </div><!--./row-fluid-->
                        </div>
                        <div class="td-next-prev-wrap">
                            <a href="#" class="td-ajax-prev-page ajax-page-disabled" id="prev-page-tdi_3_1f3" data-td_block_id="tdi_3_1f3"><i class="td-icon-font td-icon-menu-left"></i></a>
                            <a href="#" class="td-ajax-next-page" id="next-page-tdi_3_1f3" data-td_block_id="tdi_3_1f3"><i class="td-icon-font td-icon-menu-right"></i></a>
                        </div>
                    </div> <!-- ./block -->
                <div class="clearfix"></div></div>
            </div>
            <div class="td-pb-span4 td-main-sidebar" role="complementary">
                <div class="td-ss-main-sidebar" style="width: 339px; position: static; top: auto; bottom: auto;"><div class="clearfix"></div>
                    <aside class="widget_text td_block_template_1 widget widget_custom_html"><div class="textwidget custom-html-widget"><a href="https://play.google.com/store/apps/details?id=id.co.bantennews.app"><img class="aligncenter size-full wp-image-51901 jetpack-lazy-image jetpack-lazy-image--handled" src="https://www.bantennews.co.id/wp-content/uploads/2019/12/images.png" alt="" data-lazy-loaded="1" loading="eager" width="558" height="165"><noscript><img class="aligncenter size-full wp-image-51901" src="https://www.bantennews.co.id/wp-content/uploads/2019/12/images.png" alt="" width="558" height="165" /></noscript></a></div></aside><aside class="widget_text td_block_template_1 widget widget_custom_html"><div class="textwidget custom-html-widget"><a href="https://t.me/bantennewscoid"><img class="aligncenter size-full wp-image-108804 jetpack-lazy-image jetpack-lazy-image--handled" src="https://www.bantennews.co.id/wp-content/uploads/2021/08/Telegram-BN-1-1.jpg" alt="" data-lazy-loaded="1" loading="eager" width="650" height="366"><noscript><img class="aligncenter size-full wp-image-108804" src="https://www.bantennews.co.id/wp-content/uploads/2021/08/Telegram-BN-1-1.jpg" alt="" width="650" height="366" /></noscript></a></div></aside><aside class="widget_text td_block_template_1 widget widget_custom_html"><div class="textwidget custom-html-widget"><a href="https://www.bantennews.co.id/nonton-tv-online/"><img class="aligncenter size-full wp-image-91685 jetpack-lazy-image jetpack-lazy-image--handled" src="https://www.bantennews.co.id/wp-content/uploads/2021/02/banner-TV-BN-2.jpg" alt="" data-lazy-loaded="1" loading="eager" width="300" height="50"><noscript><img class="aligncenter size-full wp-image-91685" src="https://www.bantennews.co.id/wp-content/uploads/2021/02/banner-TV-BN-2.jpg" alt="" width="300" height="50" /></noscript></a></div></aside><aside class="widget_text td_block_template_1 widget widget_custom_html"><div class="textwidget custom-html-widget"><a href="https://www.suara.com/"><img class="aligncenter size-full wp-image-99993 jetpack-lazy-image jetpack-lazy-image--handled" src="https://www.bantennews.co.id/wp-content/uploads/2021/05/suara.jpg" alt="" data-lazy-loaded="1" loading="eager" width="300" height="30"><noscript><img class="aligncenter size-full wp-image-99993" src="https://www.bantennews.co.id/wp-content/uploads/2021/05/suara.jpg" alt="" width="300" height="30" /></noscript></a></div></aside><aside class="widget_text td_block_template_1 widget widget_custom_html"><div class="textwidget custom-html-widget"><img class="aligncenter size-full wp-image-109859 jetpack-lazy-image jetpack-lazy-image--handled" src="https://www.bantennews.co.id/wp-content/uploads/2021/09/IMG_20210903_133844.jpg" alt="" data-lazy-loaded="1" loading="eager" width="1775" height="982"><noscript><img class="aligncenter size-full wp-image-109859" src="https://www.bantennews.co.id/wp-content/uploads/2021/09/IMG_20210903_133844.jpg" alt="" width="1775" height="982" /></noscript></div></aside><aside class="widget_text td_block_template_1 widget widget_custom_html"><h4 class="block-title"><span>Baca Juga</span></h4><div class="textwidget custom-html-widget"><div id="SC_TBlock_565554" class="SC_TBlock">loading...</div> 
                        
                        
                        <div class="td-g-rec td-g-rec-id-sidebar tdi_7_129 td_block_template_1">
                            <script type="text/javascript">
                                var td_screen_width = document.body.clientWidth;
                                
                                if ( td_screen_width >= 1024 ) {
                                    /* large monitors */
                                    document.write('<span class="td-adspot-title">- Advertisement -</span><ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-6595675495886825" data-ad-slot=""></ins>');
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                }
                                
                                if ( td_screen_width >= 768  && td_screen_width < 1024 ) {
                                    /* portrait tablets */
                                    document.write('<span class="td-adspot-title">- Advertisement -</span><ins class="adsbygoogle" style="display:inline-block;width:200px;height:200px" data-ad-client="ca-pub-6595675495886825" data-ad-slot=""></ins>');
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                }
                                
                                if ( td_screen_width < 768 ) {
                                    /* Phones */
                                    document.write('<span class="td-adspot-title">- Advertisement -</span><ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-6595675495886825" data-ad-slot=""></ins>');
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                }
                            </script><span class="td-adspot-title">- Advertisement -</span><ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-6595675495886825" data-ad-slot=""></ins>
                        </div>
                        
                        <!-- end A --> 
                    <div class="clearfix"></div></div>
                    </div>
                </div> <!-- /.td-pb-row -->
            </div>
        </div>
        <script>
            var tdBlocksArray = []; //here we store all the items for the current page
            
            //td_block class - each ajax block uses a object of this class for requests
            function tdBlock() {
                this.id = '';
                this.block_type = 1; //block type id (1-234 etc)
                this.atts = '';
                this.td_column_number = '';
                this.td_current_page = 1; //
                this.post_count = 0; //from wp
                this.found_posts = 0; //from wp
                this.max_num_pages = 0; //from wp
                this.td_filter_value = ''; //current live filter value
                this.is_ajax_running = false;
                this.td_user_action = ''; // load more or infinite loader (used by the animation)
                this.header_color = '';
                this.ajax_pagination_infinite_stop = ''; //show load more at page x
            }
            var block_tdi_3_1f3 = new tdBlock();
            block_tdi_3_1f3.id = "tdi_3_1f3";
            block_tdi_3_1f3.atts = '{"limit":3,"ajax_pagination":"next_prev","live_filter":"cur_post_same_categories","td_ajax_filter_type":"td_custom_related","class":"tdi_3_1f3","td_column_number":3,"block_type":"td_block_related_posts","live_filter_cur_post_id":120415,"live_filter_cur_post_author":"2","block_template_id":"","header_color":"","ajax_pagination_infinite_stop":"","offset":"","td_ajax_preloading":"","td_filter_default_txt":"","td_ajax_filter_ids":"","el_class":"","color_preset":"","border_top":"","css":"","tdc_css":"","tdc_css_class":"tdi_3_1f3","tdc_css_class_style":"tdi_3_1f3_rand_style"}';
            block_tdi_3_1f3.td_column_number = "3";
            block_tdi_3_1f3.block_type = "td_block_related_posts";
            block_tdi_3_1f3.post_count = "3";
            block_tdi_3_1f3.found_posts = "2794";
            block_tdi_3_1f3.header_color = "";
            block_tdi_3_1f3.ajax_pagination_infinite_stop = "";
            block_tdi_3_1f3.max_num_pages = "932";
            tdBlocksArray.push(block_tdi_3_1f3);
        </script>                        