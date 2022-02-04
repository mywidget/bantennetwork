<section id="article" class="clearfix">
	<div class="col w-70">
		<h5>Topik</h5>
		<h3><?=ucwords($tag);?></h3><br>
		<nav class="navigation">
			<a class="active" href="<?=base_url('tag/').$tags;?>">Semua</a>
			<?php foreach($rubrik->result_array() AS $val) { ?>
				<a class="" href="<?=base_url('tag/').$tags.'?type='.$val['kategori_seo'];?>"><?=$val['nama_kategori'];?></a>
			<?php } ?>
		</nav>
		<section class="list list-type-1">
			<div id="postTag"></div>
		</section>
	</div>
	<div class="col w-30">
		<!-- ads 1 -->
		<div class="ads rectangle">
			<div class="wrapper">		
				
				</div>
		</div>
		
		<!-- ads 2 -->
		<div class="ads rectangle">
			<div class="wrapper">
				
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
	</div>
</section>
<script>
	
	function searchAll(page_num){
		page_num = page_num?page_num:0;
		var keywords = keyseo;
		// var sortBy = $("#"+a).val();
		var sortBy = types;
		
		// console.log(sortBy);
		$.ajax({
			type: 'POST',
			url: base_url+'tag/ajaxtagdesktop/'+page_num,
			data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
			beforeSend: function(){
				$('.loading').fadeIn("slow");
			},
			success: function(html){
				$('#postTag').html(html);
				$('.loading').fadeOut("slow");
			}
		});
	}
</script>