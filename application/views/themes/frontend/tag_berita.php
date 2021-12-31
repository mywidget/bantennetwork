<div class="td-container td-post-template-default">
    <div class="td-container-border">
        <div class="td-pb-row">
            <div class="td-pb-span8 td-main-content">
                <div class="td-ss-main-content">
                    <div class="clearfix"></div>
                    <div class="td-page-header td-pb-padding-side">
                        <div class="entry-crumbs"><span><a title="" class="entry-crumb" href="/">Beranda</a></span> <i class="td-icon-right td-bread-sep td-bred-no-url-last"></i> <span class="td-bred-no-url-last">Label</span> <i class="td-icon-right td-bread-sep td-bred-no-url-last"></i> <span class="td-bred-no-url-last"><?=ucwords($tag);?></span></div>
                        <h1 class="entry-title td-page-title">
                            <span>Label: <?=ucwords($tag);?></span>
                        </h1>
                    </div>
                    
                    
                    <div class="td-block-row">
                        <div id="postTag"></div>
                    </div><!--./row-fluid-->
                    
                <div class="clearfix"></div></div>
            </div>
            <div class="td-pb-span4 td-main-sidebar" role="complementary">
                <div class="td-ss-main-sidebar" style="width: 339px; position: static; top: auto; bottom: auto;"><div class="clearfix"></div>
                    
                    <?=iklan(['status'=>'detail','id'=>5]);?>
                    <!-- end A --> 
                <div class="clearfix"></div></div>
            </div>
        </div> <!-- /.td-pb-row -->
    </div>
</div>

<script>
	searchAll();
	function searchAll(page_num){
        var keyseo = "<?=$tag;?>";
		page_num = page_num?page_num:0;
		var keywords = keyseo;
		// var sortBy = $("#"+a).val();
		var sortBy = "";
		
		// console.log(sortBy);
		$.ajax({
			type: 'POST',
			url: '/tag/ajaxtagdesktop/'+page_num,
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