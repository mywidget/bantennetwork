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
					foreach($query->result_array() AS $row)
					{
						$thnt = folderthn($row['folder']);
                        $blnt = folderbln($row['folder']);
                        $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
                        $size = @getimagesize($opathFile);
                        if($size !== false){
                            $gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
                            }else{
                            $gambar = base_url()."assets/no_photo.jpg";
						}
						$postID = $row['id_post'];
						if(!empty($durasi)){
							$label = '<h6 style="width:50%;text-align:center;background:#ff0000;border-radius:10px;color:#fff;position:relative;z-index:5;top:70px;left:55px">VIDEO</h6>';
							}else{
							$label = '<h6 style="width:50%;text-align:center;background:#ff0000;border-radius:10px;color:#fff;position:relative;z-index:5;top:70px;left:5px">'.$row['nama_kategori'].'</h6>';
						}
					?>
					<section class="row">
						<a class="col-xs-4 col-sm-4 col-md-4 col-lg-4" href="<?=base_url('detail/').$row['judul_seo'];?>"><img alt="Image" src="<?=$gambar;?>"></a>
						<article class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<header>
								<div class="info">
									<p class="categori"><?=$row['nama_kategori'];?></p><time datetime="15-01-2018 10:18"><?=dtimes($row['tanggal'],true,false);?></time>
									</div><a href="<?=base_url('detail/').$row['judul_seo'];?>">
								<h5><?=$row['judul'];?></h5></a>
							</header>
						</article>
					</section>
					<?php }
					if($totalRowCount > $showLimit){ ?>
					<section class="wrapper-lainnya">
						<div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
							<span id="<?php echo $postID; ?>" class="show_more" title="Load more posts">BERITA LAINNYA</span>
						</div>
					</section>
					<?php 
					}
				}
			}
		}
		function rubrik_lainnya()
		{
			$seo = $this->input->post('seo');
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
				INNER JOIN `posting` ON (`cat`.`id_cat` = `posting`.`id_cat`) WHERE cat.kategori_seo='".$seo."' AND posting.id_post < ".$postid." ORDER BY posting.id_post DESC LIMIT ".$showLimit);
				
				if($query->num_rows() > 0)
				{
					foreach($query->result_array() AS $row)
					{
						$thnt = folderthn($row['folder']);
                        $blnt = folderbln($row['folder']);
                        $opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
                        $size = @getimagesize($opathFile);
                        if($size !== false){
                            $gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
                            }else{
                            $gambar = base_url()."assets/no_photo.jpg";
						}
						$postID = $row['id_post'];
						if(!empty($durasi)){
							$label = '<h6 style="width:50%;text-align:center;background:#ff0000;border-radius:10px;color:#fff;position:relative;z-index:5;top:70px;left:55px">VIDEO</h6>';
							}else{
							$label = '<h6 style="width:50%;text-align:center;background:#ff0000;border-radius:10px;color:#fff;position:relative;z-index:5;top:70px;left:5px">'.$row['nama_kategori'].'</h6>';
						}
					?>
					<section class="row">
						<a class="col-xs-4 col-sm-4 col-md-4 col-lg-4" href="<?=base_url('detail/').$row['judul_seo'];?>"><img alt="Image" src="<?=$gambar;?>"></a>
						<article class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<header>
								<div class="info">
									<p class="categori"><?=$row['nama_kategori'];?></p><time datetime="15-01-2018 10:18"><?=dtimes($row['tanggal'],true,false);?></time>
									</div><a href="<?=base_url('detail/').$row['judul_seo'];?>">
								<h5><?=$row['judul'];?></h5></a>
							</header>
						</article>
					</section>
					<?php }
					if($totalRowCount > $showLimit){ ?>
					<section class="wrapper-lainnya">
						<div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
							<span id="<?=$postID; ?>" data-seo="<?=$seo;?>" class="show_more_cat" title="Load more posts"> LAINNYA</span>
						</div>
					</section>
					<?php 
					}
				}
			}
		}
		function more(){
			$postid = $this->input->post('id');
			if(!empty($postid)){
				
				// Count all records except already displayed
				$query = $this->db->query("SELECT COUNT(*) as num_rows FROM posting WHERE id_post < ".$_POST['id']." ORDER BY id_post DESC");
				$row = $query->row_array();
				$totalRowCount = $row['num_rows'];
				
				$showLimit = 4;
				
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
				INNER JOIN `posting` ON (`cat`.`id_cat` = `posting`.`id_cat`) WHERE posting.id_post < ".$_POST['id']." ORDER BY posting.id_post DESC LIMIT $showLimit");
				
				if($query->num_rows() > 0){ 
					foreach($query->result_array() AS $row){
						$thnt = folderthn($row['folder']);
						$blnt = folderbln($row['folder']);
						$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
						$size = @getimagesize($opathFile);
						if($size !== false){
							$gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
							}else{
							$gambar = base_url()."assets/no_photo.jpg";
						}
						$postID = $row['id_post'];
						if(!empty($durasi)){
							$label = '<h6 style="width:50%;text-align:center;background:#ff0000;border-radius:10px;color:#fff;position:relative;z-index:5;top:70px;left:55px">VIDEO</h6>';
							}else{
							$label = '<h6 style="width:50%;text-align:center;background:#ff0000;border-radius:10px;color:#fff;position:relative;z-index:5;top:70px;left:5px">'.$row['nama_kategori'].'</h6>';
						}
					?>
					<li>
						<div class="card card-type-1">
							<div class="wrapper clearfix">
								<a class="col terkini" href="/detail/<?=$row['judul_seo'];?>" style="background: #eee">
									<?=$label;?>
									<img loading="lazy" src="<?=$gambar;?>" alt="<?=$row['judul'];?>" class="terkini lazy" width="150">
								</a>
								<a class="col terkini" href="/detail/<?=$row['judul_seo'];?>">
									<span class="col terkini"><?=tgl_tiket($row['tanggal'],true,true);?></span>
									<h2 class="title terkini"><?=$row['judul'];?></h2>
								</a>
							</div>
						</div>
						<div class="dotted"></div>
					</li>
					<?php }
					if($totalRowCount > $showLimit){ ?>
					<div class="w-70" style="margin:0 auto">
						<div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
							<span class="loding" style="display: none;"><span class="loding_txt">LOADING</span></span>
							<span id="<?php echo $postID; ?>" class="show_more" title="Load more posts">BERITA LAINNYA</span>
						</div>
					</div>
					<?php }
				}
			}
		}
	}
?>