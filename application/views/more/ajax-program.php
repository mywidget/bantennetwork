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