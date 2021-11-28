<?php
   
    $opathFile = FCPATH.'assets/page/'.$item['photo'];
    $size = @getimagesize($opathFile);
    if($size !== false){
        $gambar = base_url().'assets/page/'.$item['photo'];
        }else{
        $gambar = base_url()."assets/no_photo.jpg";
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
                        
                    </div>
                </div>
                <?php if($item['status']==0){ ?>
                <figure itemscope="" itemtype="http://schema.org/ImageObject">
                    <div class="embed-container">
                        <a href="<?=base_url('page/').$item['judul_seo'];?>" target="_blank">
                            <img itemprop="image" src="<?=$gambar;?>" data-original-src="<?=$gambar;?>" alt="" class="radius-10 lazy">
                        </a>
                        
                    </div>
                </figure>
                <?php } ?>
                <div id="isi" class="isi" itemprop="articleBody">
                    <?=$item['isi'];?>
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
            
        </div>
        
    </div> <!-- end col-70 -->
    
    <div class="col w-30">
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
        
    </div>  <!-- end w-30 -->
</section>
<style>
    .isi {
    text-align: justify;
    text-justify: inter-word;
    }
    /* container */
    
</style>