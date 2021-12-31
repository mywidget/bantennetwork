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
			<div class="td-block-row">
				<div class="td-block-span6">
					<!-- module -->
					<div class="td_module_1 td_module_wrap td-animation-stack">
						<div class="td-module-image">
							<div class="td-module-thumb">
								<a class="td-image-wrap" href="https://www.bantennews.co.id/kampanye-hari-anti-kekerasan-terhadap-perempuan-nazla-perempuan-harus-cerdas/" rel="bookmark" title="Kampanye Hari Anti Kekerasan terhadap Perempuan, Nazla: Perempuan Harus Cerdas"><img alt="" class="entry-thumb td-animation-stack-type0-2" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/12/IMG-20211203-WA0008-e1638500163918-300x160.jpg" data-type="image_tag" height="160" src="https://www.bantennews.co.id/wp-content/uploads/2021/12/IMG-20211203-WA0008-e1638500163918-300x160.jpg" title="Kampanye Hari Anti Kekerasan terhadap Perempuan, Nazla: Perempuan Harus Cerdas" width="300"></a>
							</div><a class="td-post-category" href="https://www.bantennews.co.id/category/artis/">Artis</a>
						</div>
						<h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/kampanye-hari-anti-kekerasan-terhadap-perempuan-nazla-perempuan-harus-cerdas/" rel="bookmark" title="Kampanye Hari Anti Kekerasan terhadap Perempuan, Nazla: Perempuan Harus Cerdas">Kampanye Hari Anti Kekerasan terhadap Perempuan, Nazla: Perempuan Harus Cerdas</a></h3>
						<div class="meta-info">
							<span class="td-post-author-name"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span></span> <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-12-03T11:05:41+07:00">Jumat 3 Des 2021 🕐 11:05 WIB</time></span> <span class="td-module-comments"><a href="https://www.bantennews.co.id/kampanye-hari-anti-kekerasan-terhadap-perempuan-nazla-perempuan-harus-cerdas/#respond">0</a></span>
						</div>
					</div>
				</div><!-- ./td-block-span6 -->
				<div class="td-block-span6">
					<!-- module -->
					<div class="td_module_1 td_module_wrap td-animation-stack">
						<div class="td-module-image">
							<div class="td-module-thumb">
								<a class="td-image-wrap" href="https://www.bantennews.co.id/puteri-indonesia-dipastikan-tidak-akan-ikut-miss-universe-2021-di-israel/" rel="bookmark" title="Puteri Indonesia Dipastikan Tidak Akan Ikut Miss Universe 2021 di Israel"><img alt="" class="entry-thumb td-animation-stack-type0-2" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/26513-puteri-indonesia-2020-300x160.jpg" data-type="image_tag" height="160" src="https://www.bantennews.co.id/wp-content/uploads/2021/11/26513-puteri-indonesia-2020-300x160.jpg" title="Puteri Indonesia Dipastikan Tidak Akan Ikut Miss Universe 2021 di Israel" width="300"></a>
							</div><a class="td-post-category" href="https://www.bantennews.co.id/category/artis/">Artis</a>
						</div>
						<h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/puteri-indonesia-dipastikan-tidak-akan-ikut-miss-universe-2021-di-israel/" rel="bookmark" title="Puteri Indonesia Dipastikan Tidak Akan Ikut Miss Universe 2021 di Israel">Puteri Indonesia Dipastikan Tidak Akan Ikut Miss Universe 2021 di Israel</a></h3>
						<div class="meta-info">
							<span class="td-post-author-name"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span></span> <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-29T12:05:31+07:00">Senin 29 Nov 2021 🕐 12:05 WIB</time></span> <span class="td-module-comments"><a href="https://www.bantennews.co.id/puteri-indonesia-dipastikan-tidak-akan-ikut-miss-universe-2021-di-israel/#respond">0</a></span>
						</div>
					</div>
				</div><!-- ./td-block-span6 -->
			</div><!--./row-fluid-->
			<div class="td-block-row">
				<div class="td-block-span6">
					<!-- module -->
					<div class="td_module_1 td_module_wrap td-animation-stack">
						<div class="td-module-image">
							<div class="td-module-thumb">
								<a class="td-image-wrap" href="https://www.bantennews.co.id/sekda-cilegon-bangga-jaseng-mendunia-lewat-film-yuni/" rel="bookmark" title="Sekda Cilegon Bangga Jaseng Mendunia Lewat Film Yuni"><img alt="" class="entry-thumb td-animation-stack-type0-2" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/09/Screenshot_2021-09-17-10-27-36-41_1c337646f29875672b5a61192b9010f9-300x160.jpg" data-type="image_tag" height="160" src="https://www.bantennews.co.id/wp-content/uploads/2021/09/Screenshot_2021-09-17-10-27-36-41_1c337646f29875672b5a61192b9010f9-300x160.jpg" title="Sekda Cilegon Bangga Jaseng Mendunia Lewat Film Yuni" width="300"></a>
							</div><a class="td-post-category" href="https://www.bantennews.co.id/category/artis/">Artis</a>
						</div>
						<h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/sekda-cilegon-bangga-jaseng-mendunia-lewat-film-yuni/" rel="bookmark" title="Sekda Cilegon Bangga Jaseng Mendunia Lewat Film Yuni">Sekda Cilegon Bangga Jaseng Mendunia Lewat Film Yuni</a></h3>
						<div class="meta-info">
							<span class="td-post-author-name"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span></span> <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-20T11:02:10+07:00">Sabtu 20 Nov 2021 🕐 11:02 WIB</time></span> <span class="td-module-comments"><a href="https://www.bantennews.co.id/sekda-cilegon-bangga-jaseng-mendunia-lewat-film-yuni/#respond">0</a></span>
						</div>
					</div>
				</div><!-- ./td-block-span6 -->
				<div class="td-block-span6">
					<!-- module -->
					<div class="td_module_1 td_module_wrap td-animation-stack">
						<div class="td-module-image">
							<div class="td-module-thumb">
								<a class="td-image-wrap" href="https://www.bantennews.co.id/bahasa-jaseng-go-internasional-lewat-film-yuni-pemkot-serang-beri-apresiasi/" rel="bookmark" title="Bahasa Jaseng Go Internasional lewat Film Yuni, Pemkot Serang Beri Apresiasi"><img alt="" class="entry-thumb td-animation-stack-type0-2" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211118-WA0002-300x160.jpg" data-type="image_tag" height="160" src="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211118-WA0002-300x160.jpg" title="Bahasa Jaseng Go Internasional lewat Film Yuni, Pemkot Serang Beri Apresiasi" width="300"></a>
							</div><a class="td-post-category" href="https://www.bantennews.co.id/category/artis/">Artis</a>
						</div>
						<h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/bahasa-jaseng-go-internasional-lewat-film-yuni-pemkot-serang-beri-apresiasi/" rel="bookmark" title="Bahasa Jaseng Go Internasional lewat Film Yuni, Pemkot Serang Beri Apresiasi">Bahasa Jaseng Go Internasional lewat Film Yuni, Pemkot Serang Beri Apresiasi</a></h3>
						<div class="meta-info">
							<span class="td-post-author-name"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span></span> <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-18T08:04:03+07:00">Kamis 18 Nov 2021 🕐 08:04 WIB</time></span> <span class="td-module-comments"><a href="https://www.bantennews.co.id/bahasa-jaseng-go-internasional-lewat-film-yuni-pemkot-serang-beri-apresiasi/#respond">0</a></span>
						</div>
					</div>
				</div><!-- ./td-block-span6 -->
			</div><!--./row-fluid-->
			<div class="td-block-row">
				<div class="td-block-span6">
					<!-- module -->
					<div class="td_module_1 td_module_wrap td-animation-stack">
						<div class="td-module-image">
							<div class="td-module-thumb">
								<a class="td-image-wrap" href="https://www.bantennews.co.id/dua-warga-banten-akan-hadiri-internasioanl-festival-film-of-india/" rel="bookmark" title="Dua Warga Banten Akan Hadiri Internasioanl Festival Film Of India"><img alt="" class="entry-thumb td-animation-stack-type0-2" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/09/Screenshot_2021-09-17-10-27-36-41_1c337646f29875672b5a61192b9010f9-300x160.jpg" data-type="image_tag" height="160" src="https://www.bantennews.co.id/wp-content/uploads/2021/09/Screenshot_2021-09-17-10-27-36-41_1c337646f29875672b5a61192b9010f9-300x160.jpg" title="Dua Warga Banten Akan Hadiri Internasioanl Festival Film Of India" width="300"></a>
							</div><a class="td-post-category" href="https://www.bantennews.co.id/category/artis/">Artis</a>
						</div>
						<h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/dua-warga-banten-akan-hadiri-internasioanl-festival-film-of-india/" rel="bookmark" title="Dua Warga Banten Akan Hadiri Internasioanl Festival Film Of India">Dua Warga Banten Akan Hadiri Internasioanl Festival Film Of India</a></h3>
						<div class="meta-info">
							<span class="td-post-author-name"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span></span> <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-17T14:01:13+07:00">Rabu 17 Nov 2021 🕐 14:01 WIB</time></span> <span class="td-module-comments"><a href="https://www.bantennews.co.id/dua-warga-banten-akan-hadiri-internasioanl-festival-film-of-india/#respond">0</a></span>
						</div>
					</div>
				</div><!-- ./td-block-span6 -->
				<div class="td-block-span6">
					<!-- module -->
					<div class="td_module_1 td_module_wrap td-animation-stack">
						<div class="td-module-image">
							<div class="td-module-thumb">
								<a class="td-image-wrap" href="https://www.bantennews.co.id/film-sepeda-presiden-akan-tayang-akhir-tahun-ini/" rel="bookmark" title="Film Sepeda Presiden Akan Tayang Akhir Tahun Ini"><img alt="" class="entry-thumb td-animation-stack-type0-2" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/10217-flim-sepeda-presiden-siaran-pers-300x160.jpg" data-type="image_tag" height="160" src="https://www.bantennews.co.id/wp-content/uploads/2021/11/10217-flim-sepeda-presiden-siaran-pers-300x160.jpg" title="Film Sepeda Presiden Akan Tayang Akhir Tahun Ini" width="300"></a>
							</div><a class="td-post-category" href="https://www.bantennews.co.id/category/artis/">Artis</a>
						</div>
						<h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/film-sepeda-presiden-akan-tayang-akhir-tahun-ini/" rel="bookmark" title="Film Sepeda Presiden Akan Tayang Akhir Tahun Ini">Film Sepeda Presiden Akan Tayang Akhir Tahun Ini</a></h3>
						<div class="meta-info">
							<span class="td-post-author-name"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span></span> <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-15T14:05:38+07:00">Senin 15 Nov 2021 🕐 14:05 WIB</time></span> <span class="td-module-comments"><a href="https://www.bantennews.co.id/film-sepeda-presiden-akan-tayang-akhir-tahun-ini/#respond">0</a></span>
						</div>
					</div>
				</div><!-- ./td-block-span6 -->
			</div><!--./row-fluid-->
			<div class="td-block-row">
				<div class="td-block-span6">
					<!-- module -->
					<div class="td_module_1 td_module_wrap td-animation-stack">
						<div class="td-module-image">
							<div class="td-module-thumb">
								<a class="td-image-wrap" href="https://www.bantennews.co.id/arawinda-kirana-pemeran-yuni-raih-pemeran-utama-perempuan-terbaik-ffi-2021/" rel="bookmark" title="Arawinda Kirana, Pemeran YUNI Raih Pemeran Utama Perempuan Terbaik FFI 2021"><img alt="" class="entry-thumb td-animation-stack-type0-2" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211111-WA0000-300x160.jpg" data-type="image_tag" height="160" src="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211111-WA0000-300x160.jpg" title="Arawinda Kirana, Pemeran YUNI Raih Pemeran Utama Perempuan Terbaik FFI 2021" width="300"></a>
							</div><a class="td-post-category" href="https://www.bantennews.co.id/category/artis/">Artis</a>
						</div>
						<h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/arawinda-kirana-pemeran-yuni-raih-pemeran-utama-perempuan-terbaik-ffi-2021/" rel="bookmark" title="Arawinda Kirana, Pemeran YUNI Raih Pemeran Utama Perempuan Terbaik FFI 2021">Arawinda Kirana, Pemeran YUNI Raih Pemeran Utama Perempuan Terbaik FFI 2021</a></h3>
						<div class="meta-info">
							<span class="td-post-author-name"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span></span> <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-11T10:03:17+07:00">Kamis 11 Nov 2021 🕐 10:03 WIB</time></span> <span class="td-module-comments"><a href="https://www.bantennews.co.id/arawinda-kirana-pemeran-yuni-raih-pemeran-utama-perempuan-terbaik-ffi-2021/#respond">0</a></span>
						</div>
					</div>
				</div><!-- ./td-block-span6 -->
				<div class="td-block-span6">
					<!-- module -->
					<div class="td_module_1 td_module_wrap td-animation-stack">
						<div class="td-module-image">
							<div class="td-module-thumb">
								<a class="td-image-wrap" href="https://www.bantennews.co.id/kecelakaan-maut-yang-menimpa-artis-vanessa-angel-akibat-sopir-ngantuk/" rel="bookmark" title="Kecelakaan Maut yang Menimpa Artis Vanessa Angel Akibat Sopir Ngantuk"><img alt="" class="entry-thumb td-animation-stack-type0-2" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211104-WA0045-300x160.jpg" data-type="image_tag" height="160" src="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG-20211104-WA0045-300x160.jpg" title="Kecelakaan Maut yang Menimpa Artis Vanessa Angel Akibat Sopir Ngantuk" width="300"></a>
							</div><a class="td-post-category" href="https://www.bantennews.co.id/category/artis/">Artis</a>
						</div>
						<h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/kecelakaan-maut-yang-menimpa-artis-vanessa-angel-akibat-sopir-ngantuk/" rel="bookmark" title="Kecelakaan Maut yang Menimpa Artis Vanessa Angel Akibat Sopir Ngantuk">Kecelakaan Maut yang Menimpa Artis Vanessa Angel Akibat Sopir Ngantuk</a></h3>
						<div class="meta-info">
							<span class="td-post-author-name"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span></span> <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-05T02:17:11+07:00">Jumat 5 Nov 2021 🕐 02:17 WIB</time></span> <span class="td-module-comments"><a href="https://www.bantennews.co.id/kecelakaan-maut-yang-menimpa-artis-vanessa-angel-akibat-sopir-ngantuk/#respond">0</a></span>
						</div>
					</div>
				</div><!-- ./td-block-span6 -->
			</div><!--./row-fluid-->
			<div class="td-block-row">
				<div class="td-block-span6">
					<!-- module -->
					<div class="td_module_1 td_module_wrap td-animation-stack">
						<div class="td-module-image">
							<div class="td-module-thumb">
								<a class="td-image-wrap" href="https://www.bantennews.co.id/mukjizat-anak-artis-vanessa-angel-selamat-dalam-kecelakaan-maut/" rel="bookmark" title="Mukjizat, Anak Artis Vanessa Angel Selamat dalam Kecelakaan Maut"><img alt="" class="entry-thumb td-animation-stack-type0-2" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG_20211104_205804-300x160.jpg" data-type="image_tag" height="160" src="https://www.bantennews.co.id/wp-content/uploads/2021/11/IMG_20211104_205804-300x160.jpg" title="Mukjizat, Anak Artis Vanessa Angel Selamat dalam Kecelakaan Maut" width="300"></a>
							</div><a class="td-post-category" href="https://www.bantennews.co.id/category/artis/">Artis</a>
						</div>
						<h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/mukjizat-anak-artis-vanessa-angel-selamat-dalam-kecelakaan-maut/" rel="bookmark" title="Mukjizat, Anak Artis Vanessa Angel Selamat dalam Kecelakaan Maut">Mukjizat, Anak Artis Vanessa Angel Selamat dalam Kecelakaan Maut</a></h3>
						<div class="meta-info">
							<span class="td-post-author-name"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span></span> <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-11-04T21:05:34+07:00">Kamis 4 Nov 2021 🕐 21:05 WIB</time></span> <span class="td-module-comments"><a href="https://www.bantennews.co.id/mukjizat-anak-artis-vanessa-angel-selamat-dalam-kecelakaan-maut/#respond">0</a></span>
						</div>
					</div>
				</div><!-- ./td-block-span6 -->
				<div class="td-block-span6">
					<!-- module -->
					<div class="td_module_1 td_module_wrap td-animation-stack">
						<div class="td-module-image">
							<div class="td-module-thumb">
								<a class="td-image-wrap" href="https://www.bantennews.co.id/sinetron-dari-jendela-smp-dinilai-plagiat-serial-netflix-squid-game/" rel="bookmark" title="Sinetron Dari Jendela SMP Dinilai Plagiat Serial Netflix Squid Game"><img alt="" class="entry-thumb td-animation-stack-type0-2" data-img-url="https://www.bantennews.co.id/wp-content/uploads/2021/10/WhatsApp-Image-2021-10-24-at-14.26.25-300x160.jpeg" data-type="image_tag" height="160" src="https://www.bantennews.co.id/wp-content/uploads/2021/10/WhatsApp-Image-2021-10-24-at-14.26.25-300x160.jpeg" title="Sinetron Dari Jendela SMP Dinilai Plagiat Serial Netflix Squid Game" width="300"></a>
							</div><a class="td-post-category" href="https://www.bantennews.co.id/category/artis/">Artis</a>
						</div>
						<h3 class="entry-title td-module-title"><a href="https://www.bantennews.co.id/sinetron-dari-jendela-smp-dinilai-plagiat-serial-netflix-squid-game/" rel="bookmark" title="Sinetron Dari Jendela SMP Dinilai Plagiat Serial Netflix Squid Game">Sinetron Dari Jendela SMP Dinilai Plagiat Serial Netflix Squid Game</a></h3>
						<div class="meta-info">
							<span class="td-post-author-name"><a href="https://www.bantennews.co.id/author/redaksi-2/">Bantennews</a> <span>-</span></span> <span class="td-post-date"><time class="entry-date updated td-module-date" datetime="2021-10-24T23:13:25+07:00">Minggu 24 Okt 2021 🕐 23:13 WIB</time></span> <span class="td-module-comments"><a href="https://www.bantennews.co.id/sinetron-dari-jendela-smp-dinilai-plagiat-serial-netflix-squid-game/#respond">0</a></span>
						</div>
					</div>
				</div><!-- ./td-block-span6 -->
			</div><!--./row-fluid-->
			<div class="page-nav td-pb-padding-side">
				<span class="current">1</span><a class="page" href="https://www.bantennews.co.id/category/artis/page/2/" title="2">2</a><a class="page" href="https://www.bantennews.co.id/category/artis/page/3/" title="3">3</a><span class="extend">...</span><a class="last" href="https://www.bantennews.co.id/category/artis/page/23/" title="23">23</a><a href="https://www.bantennews.co.id/category/artis/page/2/"><i class="td-icon-menu-right"></i></a><span class="pages">Halaman 1 dari 23</span>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="td-pb-span4 td-main-sidebar">
		<div class="td-ss-main-sidebar" style="width: 339px; position: static; top: auto; bottom: auto; z-index: 1;">
			<div class="clearfix"></div>
			
			
			<div class="clearfix"></div>
		</div>
	</div>
</div>
</div>
</div>