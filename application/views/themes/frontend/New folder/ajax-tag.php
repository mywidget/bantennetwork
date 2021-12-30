<?php if(!empty($posts)){ ?>
	<div class="postTag">
		<ul class="wrapper">
			<?php foreach($posts AS $row){ 
				$postID = $row['id_post'];
				$thnt = folderthn($row['folder']);
				$blnt = folderbln($row['folder']);
				$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
				$size = @getimagesize($opathFile);
				if($size !== false){
					$gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
					}else{
					$gambar = base_url()."assets/no_photo.jpg";
				}
				$durasi = formatDate($row['durasi']);
				if(!empty($durasi)){
					$label = '<span style="background:#ff0000">VIDEO</span>';
					}else{
					$label = '<span style="background:#000040;border-radius:15px;padding:2px 5px;color:#fff">'.$row['nama_kategori'].'</span>';
				}
				$seo = base_url('detail/').$row['judul_seo'];
				$isi =cleanString($row['postingan']);
			?>
			<li>
				<div class="card card-type-1">
					<div class="wrapper clearfix">
						<a class="col" href="<?=$seo;?>">
							<img loading="lazy" src="<?=$gambar;?>">
						</a>
						<a class="col" href="<?=$seo;?>">
							<h6 style="color:crimson"><?=$row['nama_kategori'];?></h6>
							<h2 class="title"><?=$row['judul'];?></h2>
							<p><?=kata($isi,100);?></p>
							<span class="col"><?=datetimes($row['tanggal'],true,true);?></span>
						</a>
					</div>
				</div>
			</li>
			<?php } ?>
		</ul>
		<p><?php echo $this->ajax_paging->create_links(); ?></p>
	</div>
<?php }else{ echo "Data tidak ditemukan";} ?>
