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

<section id="article" class="clearfix">
    <div class="col w-70">
        <div class="wrapper">
            
            <nav class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item" href="/"><span itemprop="name">Home</span></a></li>
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item" href=""><span itemprop="name"></span><?=$item['judul'];?></a></li>
            </nav>
            <style>
                .embed-container{position:relative;padding-bottom:56.25%;height:0;overflow:hidden;max-width:100%}.embed-container embed,.embed-container iframe,.embed-container object{position:absolute;top:0;left:0;width:100%;height:100%}
            </style>
            <article itemscope="" itemtype="http://schema.org/NewsArticle">
                
                <h1 itemprop="headline" class="434">
                <?=$item['judul'];?></h1>
                <div class="sub-head" style="font-size: 14px; margin-bottom: initial;">
                    <div id="author" class="author" style="padding:0px">
                        Editor: <h4 itemprop="editor" style="margin-top:0px;font-size:inherit"><?=editor($item['id_publisher']);?></h4>
                        | <span id="date" class="date" itemprop="datePublished"><?=tgl_tiket($item['tanggal'],true,true);?></span><?=breadcrumb_tag($dataTz,0,0,$item['id_cat']);?>
                    </div>
                </div>
                
                <figure itemscope="" itemtype="http://schema.org/ImageObject">
                    <div class="embed-container">
                        <a href="<?=base_url('detail/').$item['judul_seo'];?>" target="_blank">
                            <img itemprop="image" src="<?=$gambar;?>" data-original-src="<?=$gambar;?>" alt="<?=$item['caption'];?>" class="radius-10 lazy">
                        </a>
                        <?php
                            if($item['youtube']!=''){
                                preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $item['youtube'], $matches);
                                $idy = "";
                                if(!empty($matches[1])){
                                    $idy = $matches[1];
                                }
                                echo '<iframe src="https://www.youtube.com/embed/'.$idy.'?autoplay=1" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" allow="autoplay" frameborder="0"></iframe>';
                            }
                        ?>
                    </div>
                    <figcaption itemprop="caption">
                        <p><?=$item['caption'];?></p>
                    </figcaption>
                </figure>
                <div class="sub-heads clearfix">
                    
                    <div class="col w-70">
                        <div id="share">
                            <span class="social--texts">Bagikan:</span>
                            <!-- facebook -->
                            <a class="facebook" href="https://www.facebook.com/share.php?u=<?=base_url('detail/').$item['judul_seo'];?>" target="blank"><i class="fa fa-facebook"></i></a>
                            
                            <!-- twitter -->
                            <a class="twitter" href="https://twitter.com/intent/tweet?status=<?=$item['judul'];?>+<?=base_url('detail/').$item['judul_seo'];?>" target="blank"><i class="fa fa-twitter"></i></a>
                            <!-- whatsapp -->
                            <a class="whatsapp" href="https://api.whatsapp.com/send?text=<?=base_url('detail/').$item['judul_seo'];?>" target="blank"><i class="fa fa-whatsapp"></i></a>
                            
                        </div>
                    </div>
                    <div class="cor w-20">
                        <span class="social--text">View: <?=$item['dibaca'];?></span>
                    </div>
                </div>
                <div id="isi" class="isi" itemprop="articleBody">
                    <?=$item['postingan'];?>
                    <!-- inline piano -->
                    <ins class="adsbygoogle"
                    style="display:block; text-align:center;"
                    data-ad-layout="in-article"
                    data-ad-format="fluid"
                    data-ad-client="ca-pub-7978532385409235"
                    data-ad-slot="7144386218"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </article>
            
            <section id="section" class="kanal-pilihan">
                <div class="wrapper clearfix">
                    <div class="read__tagging clearfix">
                        <?=tagshow($item['id_post']);?>
                    </div>
                    <!-- Artikel Terkait -->
                    <div id="terkait" class="col w-100">
                        <div class="related__inline ga--related mt2 clearfix"><h3><span>Berita Terkait</span></h3>
                            <?=$terkait;?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
    </div> <!-- end col-70 -->
    
    <div class="col w-30">
        <br>
        <!-- TERPOPULER -->
        <div class="ads rectangle">
            <div class="wrapper">		
                <div id="mr_3" class="rectangle-ads" style="width:auto;height:auto;text-align: center;">
                    <?php echo iklan(['status'=>'detail','id'=>5]);?>
                </div>
            </div>
        </div>
        
        <section id="popular" class="terpopuler list list-type-1 terpopulerbg">
            <div class="wrapper">
                
                <a href="#" class="box-title" style="color:#fff;font-size:16pt;margin-left:55px">
                    terpopuler
                </a>
                <hr class="bottom">
                <?=$populer;?>
                
            </div>
        </section>
        <!-- END TERPOPULER -->
        
        <!-- Terkini -->
        <section id="update" class="list list-type-1 terbarubg mtop-30">
            <div class="wrapper">
                <a href="#" class="box-title red-500 tengah radius-10 top-10">Berita Terbaru</a>
                <?=$terbaru;?>
            </div>
            <section class="list list-type-1" style="margin-bottom: 5px;">
                <a href="/indeks" class="box-title selengkapnya radius-10" style="background:#ff0000;color:#fff;margin-top:10px">
                Berita lainnya</a>
            </section>
        </section>
        
        
    </div>  <!-- end w-30 -->
</section>
<style>
    .isi {
    text-align: justify;
    text-justify: inter-word;
    }
    /* container */
    
    #share {
  	text-align: center;
    float:left
    }
    
    /* buttons */
    
    #share a {
	width: 25px;
  	height: 25px;
  	display: inline-block;
  	margin:8px 0 0 0;
  	font-size: 20px;
  	color: #fff;
    }
    
    #share a:hover {
	opacity: 1;
    }
    
    /* icons */
    
    #share i {
  	position: relative;
  	top: 50%;
  	transform: translateY(-50%);
    }
    
    /* colors */
    
    .facebook {
 	background: #3b5998;
    }
    
    .twitter {
  	background: #55acee;
    }
    
    .whatsapp {
  	background: #4DC247;
    }
    
    .linkedin {
  	background: #0077b5;
    }
    
    .pinterest {
  	background: #cb2027;
    }
</style>