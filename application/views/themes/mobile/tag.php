<main class="container mb-3" style="margin-bottom:20px">
	<header>
		<h4>Topik <?=ucwords($tag);?></h4>
		<input hidden type="text" name="tab-css" class="tab" value="<?=($tag);?>" id="tag" />
	</header>
	<?php if(!empty($posts)){ ?>
		<div id="postTag">
			<main class="" id="berita-terkini" style="margin-bottom:20px">
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
				?>
				<section class="row">
					<a class="col-xs-4 col-sm-4 col-md-4 col-lg-4" href="<?=base_url('detail/').$row['judul_seo'];?>"><img alt="Image" src="<?=$gambar;?>" width="143"></a>
					<article class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
						<header>
							<div class="info">
								<p class="categori"><?=$label;?></p>
								<time datetime="<?=dtimes($row['tanggal'],true,false);?>"><?=datetimes($row['tanggal'],true,true);?></time>
								</div><a href="<?=base_url();?>detail/<?=$row['judul_seo'];?>">
							<h5><?=$row['judul'];?></h5></a>
						</header>
					</article>
				</section>
				<?php } ?>
				<?php echo $this->ajax_pagemobile->create_links(); ?>
				
			</main>
		</div>
	<?php }else{ echo "Data tidak ditemukan";} ?>
</main>		
<script>
	function searchAll(page_num){
		page_num = page_num?page_num:0;
		var keywords = $('#tag').val();
		
		// console.log(sortBy);
		$.ajax({
			type: 'POST',
			url: base_url+'tag/ajaxTag/'+page_num,
			data:'page='+page_num+'&keywords='+keywords,
			beforeSend: function(){
				// $('.loading').fadeIn("slow");
			},
			success: function(html){
				$('#postTag').html(html);
				// $('.loading').fadeOut("slow");
			}
		});
		}
</script>		