<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Ajax extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->helper('string');
			// $this->load->library('session');
		}
		function lainnya()
		{
			$postid = $this->input->post('id');
			if(!empty($postid)){
				
				// Count all records except already displayed
				$query = $this->db->query("SELECT COUNT(*) as num_rows FROM posting WHERE id_post < ".$postid." ORDER BY id_post DESC");
				$row = $query->row_array();
				$totalRowCount = $row['num_rows'];
				
				$showLimit = 5;
				// Get records from the database
				$query = $this->db->query("SELECT 
				`posting`.`id_post`,
				`posting`.`judul`,
				`posting`.`judul_seo`,
				`posting`.`tanggal`,
				`posting`.`folder`,
				`posting`.`gambar`,
				`posting`.`youtube`,
				`posting`.`durasi`,
				`cat`.`nama_kategori`
				FROM
				`cat`
				INNER JOIN `posting` ON (`cat`.`id_cat` = `posting`.`id_cat`) WHERE posting.id_post < ".$postid." ORDER BY posting.id_post DESC LIMIT ".$showLimit);
				
				if($query->num_rows() > 0)
				{
					foreach($query->result_array() AS $row2)
					{
						$postID = $row2['id_post'];
						$judul = $row2['judul'];
						$seo = base_url().$row2['judul_seo'];
						$tanggal = tgl_post($row2['tanggal']);
						$dateatom = standard_date('DATE_ATOM', strtotime($row2['tanggal']));
						$thnt = folderthn($row2['folder']);
						$blnt = folderbln($row2['folder']);
						$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row2['gambar'];
						$size = @getimagesize($opathFile);
						if($size !== false){
							$gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row2['gambar'];
							}else{
							$gambar = base_url()."assets/no_photo.jpg";
						}
						
					?>
					<div class="td-block-span6">
						<div class="td_module_7 td_module_wrap td-animation-stack">
							<div class="td-module-thumb">
								<a href="<?=$seo;?>" rel="bookmark" class="td-image-wrap " title="<?=$judul;?>" ><img  style="width: 100px; height: 75px; object-fit: cover;" src="<?=$gambar;?>" title="<?=$judul;?>" data-type="image_tag" data-img-url="<?=$gambar;?>" width="100" height="75">
									<noscript>
										<img class="entry-thumb" src="<?=$gambar;?>" alt="" title="<?=$judul;?>" data-type="image_tag" data-img-url="<?=$gambar;?>"  width="100" height="75" />
									</noscript>
								</a>
							</div>
							<div class="item-details">
								<h3 class="entry-title td-module-title title-more"><a href="<?=$seo;?>" rel="bookmark" title="<?=$judul;?>"><?=$judul;?></a></h3>
								<div class="meta-info">
								<span class="td-post-date"><time class="entry-date updated td-module-date" datetime="<?=$dateatom;?>" ><?=$tanggal;?></time></span></div>
							</div>
						</div>
					</div> <!-- ./td-block-span6 -->
					<?php }
					if($totalRowCount > $showLimit){ ?>
					<div class="td-load-more-wrap">
						<div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
							<a href="#show_more_main" id="<?php echo $postID; ?>" class="td_ajax_load_more td_ajax_load_more_js">Berita Lainnya<i class="td-icon-font td-icon-menu-down"></i>
							</a>
						</div>
						
					</div>
					<script>
					$(".title-more").dotdotdot({	height: 70,	fallbackToLetter: true,	watch: true});
					</script>
					<?php 
					}
				}
			}
		}
		
	}
?>