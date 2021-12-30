<div style="position:relative;top:0;left:0;width:100%;overflow:hidden;margin:10px 0 20px 0;border-radius:10px;">
    <!--#region Jssor Slider Begin -->
    <div id="slider1_container" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1064px; height: 500px;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?=base_url('assets');?>/loading/spin.svg" />
        </div>
        
        <!-- Slides Container -->
        <div data-u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1064px;  height: 500px; overflow: hidden;">
            <?php
                
                foreach($headline AS $row)
                {
                    $thnt = folderthn($row['folder']);
                    $blnt = folderbln($row['folder']);
                    $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/1300x670_'.$row['gambar'];
                    $size = @getimagesize($opathFile);
                    if($size !== false){
                        $gambar = '/assets/post/'.$thnt.'/'.$blnt.'/1300x670_'.$row['gambar'];
                        }else{
                        $gambar = "/assets/no_photo.jpg";
                    }
                    $durasi = formatDate($row['durasi']);
                    if(!empty($durasi)){
                        $label = '<a href="'.base_url('detail/').$row['judul_seo'].'"><i class="fa fa-play"></i> &nbsp;WATCH VIDEO</a>';
                        }else{
                        $label = '<a href="'.base_url('detail/').$row['judul_seo'].'"><i class="fa fa-newspaper-o"></i> &nbsp;DETAIL</a>';
                    }
                ?>
                     <div>
                    <div style="top: 0px; left: 0px; width: 1064px; height: 500px; position: absolute; display: block; overflow: hidden; background-color:#000; background-image: none;">
                    <img data-u="image" src="<?=$gambar;?>" alt="detail/dua-badak-jawa-lahir-terekam-video-trap-di-tnuk-pandeglang" class="lazy" data-src="<?=$gambar;?>" style="top: 0px; left: 0px; width: 1300px; height: 670px; position: absolute; display: block; max-width: 10000px; z-index: 1;" data-events="auto" data-display="block" border="0"></div><div style="top: 0px; left: 0px; width: 1300px; height: 670px; position: absolute; display: block; transform-style: preserve-3d; z-index: 1;" data-events="auto" data-display="block">
                        <a href="<?=base_url().$row['judul_seo'];?>">
                            
                            <div class="shadow">
                                <img src="<?=base_url('assets/');?>shadow.png" alt="shadow_0" class="lazy" data-src="<?=base_url('assets/');?>shadow.png" data-events="auto" data-display="inline" style="z-index: 1;">
                            </div>
                        </a>
                        
                        <div class="title-big_slider" style="color:#fff;">
                        <a href="<?=base_url('detail/').$row['judul_seo'];?>"><h1 class="h1_slider" ><?=$row['judul'];?></h1></a>
                            <div class="title-small_slider hide-m">
                                <a href="/<?=$row['kategori_seo'];?>"><div class="hedlinecat"><?=$row['nama_kategori'];?></div></a>
                            </div>
                            <div class="playin">
                                <?=$label;?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>  
        </div>
        
        <!--#region Bullet Navigator Skin Begin -->
        <!-- Help: https://www.jssor.com/development/slider-with-bullet-navigator.html -->
        <style>
            .jssorb051 .i {position:absolute;cursor:pointer;}
            .jssorb051 .i .b {fill:#fff;fill-opacity:0.5;stroke:#000;stroke-width:400;stroke-miterlimit:10;stroke-opacity:0.5;}
            .jssorb051 .i:hover .b {fill-opacity:.7;}
            .jssorb051 .iav .b {fill-opacity: 1;}
            .jssorb051 .i.idn {opacity:.3;}
        </style>
        <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                </svg>
            </div>
        </div>
        <!--#endregion Bullet Navigator Skin End -->
        
        <!--#region Arrow Navigator Skin Begin -->
        <!-- Help: https://www.jssor.com/development/slider-with-arrow-navigator.html -->
        <style>
            .jssora051 {display:block;position:absolute;cursor:pointer;}
            .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
            .jssora051:hover {opacity:.8;}
            .jssora051.jssora051dn {opacity:.5;}
            .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
        </style>
        <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
            </svg>
        </div>
        <!--#endregion Arrow Navigator Skin End -->
        
    </div>
    <!--#endregion Jssor Slider End -->
</div>

<section id="section-1" class="clearfix">
    
    
    <div class="col w-30" style="float:left !important;">
        <div class="col w-100" style="background:#EDEDED;float:left !important;border-radius:10px">
            <section id="update" class="list list-type-1" style="margin-bottom:15px;padding:0 10px">
                <div class="wrapper">
                    <a href="#" class="box-title blue-500" style="position:relative;top:-15px;z-index: 2;border-radius:15px;font-size:12pt">Artikel</a>
                    <div class="post-list" id="dataList">
                        <!-- Display posts list -->
                        <?php if(!empty($posts)){ foreach($posts as $row){ 
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
                        <li>
                            <div class="card card-type-1">
                                <div class="wrapper clearfix">
                                    <a class="col terkini" href="<?=base_url('detail/').$row['judul_seo'];?>" style="background: #eee">
                                        <img loading="lazy" src="<?=$gambar;?>" alt="<?=$row['judul'];?>" class="terkini" width="150">
                                    </a>
                                    <a class="col terkini" href="<?=base_url('detail/').$row['judul_seo'];?>">
                                        <h6 style="color:crimson;"><?=$row['nama_kategori'];?></h6>
                                        <h2 class="title terkini"><?=$row['judul'];?></h2>
                                    </a>
                                    <a class="col terkini" href="<?=base_url('detail/').$row['judul_seo'];?>">
                                        <span class="col terkini"><?=tgl_tiket($row['tanggal'],true,true);?></span>
                                    </a>
                                </div>
                            </div>
                            <div class="dotted"></div>
                        </li>
                        <?php } }else{ ?>
                        <p>Post(s) not found...</p>
                        <?php } ?>
                       <div class="w-50">
                        <?php echo $this->ajax_paging->create_links(); ?>
                    </div>
                    </div>
                </div>
                
            </section>
    </div>
</div>

<div class="col w-70" style="float:right !important;">
    <div class="col w-100" style="float:left !important;background:#EDEDED;border-radius: 10px;padding:10px;margin-bottom:10px">
        <section id="berita-populer" class="berita-populer">
            <a href="/sorotan" class="box-title blue-500 populer" style="margin-left:20px">
                SOROTAN
            </a>
            
            <div class="row clearfix">
                <?php 
                    foreach($sorotan AS $row):
                    $thnt = folderthn($row['folder']);
                    $blnt = folderbln($row['folder']);
                    $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
                    $size = @getimagesize($opathFile);
                    if($size !== false){
                        $gambar = '/assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
                        }else{
                        $gambar = "/assets/no_photo_2.jpg";
                    }
                ?>
                <li class="col w-30" style="position:relative">
                    <div class="card card-type-4">
                        <div class="wrapper clearfix">
                            <a class="col populer" href="/detail/<?=$row['judul_seo'];?>">
                                <img loading="lazy" src="<?=$gambar;?>" alt="<?=potdesc($row['judul'],50);?>" width="400">
                            </a>
                            <a class="col populer" href="/detail/<?=$row['judul_seo'];?>">
                                <h2 class="title"><?=$row['judul'];?></h2>
                            </a>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </div>
            <!-- end berita populer -->
        </section>
        <section id="berita-populer" class="berita-populer">
            <a href="/populer" class="box-title blue-500 populer" style="margin-left:20px">
                POPULER
            </a>
            
            <div class="row clearfix">
                <?php 
                    foreach($populer AS $row):
                    $thnt = folderthn($row['folder']);
                    $blnt = folderbln($row['folder']);
                    $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
                    $size = @getimagesize($opathFile);
                    if($size !== false){
                        $gambar = '/assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
                        }else{
                        $gambar = "/assets/no_photo_2.jpg";
                    }
                ?>
                <li class="col w-30" style="position:relative">
                    <div class="card card-type-4">
                        <div class="wrapper clearfix">
                            <a class="col populer" href="/detail/<?=$row['judul_seo'];?>">
                                <img loading="lazy" src="<?=$gambar;?>" alt="<?=potdesc($row['postingan'],50);?>" width="400">
                            </a>
                            <a class="col populer" href="/detail/<?=$row['judul_seo'];?>">
                                <h2 class="title"><?=$row['judul'];?></h2>
                            </a>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
                
            </div>
            <!-- end berita pilihan -->
        </section>
        
    </div>
   
    <div class="col w-100" style="background:#fff;margin-top:20px;">
        <section id="tabs popular" class="tab tab-type-1 terpopuler  " style="border:3px solid #000040;border-radius:10px;padding:10px">
            <a href="/program" class="col box-title red-500 berita-pilihan" style="margin-left:20px">PROGRAM</a>
            <nav class="tab-pagination program">
                <div class="col w-70">
                    
                </div>
            </nav>
            <div class="tab-content" style="overflow:hidden;height:400px">
                <div class="wrapper">
                    <div id="popular-1" class="tab-content-slide selected">
                        <?php 
                            $no=1;
                            foreach($program AS $row){
                                $thnt = folderthn($row['folder']);
                                $blnt = folderbln($row['folder']);
                                $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
                                $size = @getimagesize($opathFile);
                                if($size !== false){
                                    $gambar = '/assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
                                    }else{
                                    $gambar = "/assets/no_video.jpg";
                                }
                                if($no==1){
                                    
                                ?>
                                <li>
                                    <div class="card card-type-1 ">
                                        <div class="wrapper clearfix">
                                            <a class="col berita-pilihan" href="/detail/<?=$row['judul_seo'];?>" style="background: #eee">
                                                <img loading="lazy" src="<?=$gambar;?>" alt="<?=$row['judul'];?>" width="354">
                                            </a>
                                            <a class="col berita-pilihan" href="/detail/<?=$row['judul_seo'];?>">
                                                <h2 class="title"><?=$row['judul'];?></h2>
                                            </a>
                                            <a class="col berita-pilihan" href="/detail/<?=$row['judul_seo'];?>">
                                                <p><?=potdesc($row['postingan'],100);?></p>
                                            </a>
                                            <a class="col berita-pilihan" href="<?=$row['judul_seo'];?>">
                                                <span class="col" style="background:#ff0000;padding:5px;color:#fff;border-radius:10px;font-weight:bold">SELENGKAPNYA...</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <?php }else{ 
                                    $label='';
                                        if(!empty($row['label'])){
                                            $query = $this->model_app->view_where('label',['id'=>$row['label']])->row();
                                            $color = $query->color;
                                            $label ='<span style="background:'.$color.';color:#fff;padding:2px 5px;text-transform: uppercase;border-radius:10px;">'.$query->name.'</span>';
                                        }
                                ?>
                                 <li>
                                        <div class="card card-type-1">
                                            <div class="wrapper clearfix">
                                                <a class="col berita-pilihan" href="/detail/<?=$row['judul_seo'];?>" style="background: #eee">
                                                    <img loading="lazy" src="<?=$gambar;?>" alt="<?=$row['judul'];?>" width="158">
                                                </a>
                                                <a class="col berita-pilihan" href="/detail/<?=$row['judul_seo'];?>">
                                                    <span class="col"><?=tgl_tiket($row['tanggal'],false,false).$label;?></span>
                                                    <br>
                                                    <h2 class="title"><?=$row['judul'];?></h2>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                            <?php } $no++; } ?>
                            
                    </div>
                    
                    <div id="popular-2" class="tab-content-slide"></div>
                    <div id="popular-3" class="tab-content-slide"></div>
                    <div id="popular-4" class="tab-content-slide"></div>
                    <div id="popular-5" class="tab-content-slide"></div>
                    <!-- <div id="popular-10" class="tab-content-slide"></div> -->
                </div>
            </div>
        </section>
    </div>
</div>

</section>

