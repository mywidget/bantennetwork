<?php 
	function blok_widget(array $val){
		$ci = & get_instance();
		
		$qry = $ci->db->query("SELECT * from cat WHERE id_cat=".$val['id']);
		$html ="";
		if($val['limit']==1){
			$limit = 2;
			$limit_qry = 5;
			}else{
			$limit = 3;
			$limit_qry = 6;
		}
		if($qry->num_rows() >0){
			$row = $qry->row_array();
			$id_cat = $row['id_cat'];
			$judul_kategori = $row['nama_kategori'];
			$html .=  '<div class="td_block_wrap td_block_15  td-pb-full-cell td-pb-border-top td_block_template_1">
			<h4 class="block-title">
			<span class="td-pulldown-size">'.$judul_kategori.'</span></h4>
			<div id="tdi_25_68" class="td_block_inner td-column-2">
			<div class="td-block-row">';
			
			$conditions['returnType'] = 'count';
			$totalRec = $ci->model_data->getRows("posting",$conditions);
			// Pagination configuration 
			$config['target']      = '#tdi_'.$id_cat;
			$config['base_url']    = base_url('home/ajaxblog');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = 6;
			$config['link_func']   = 'searchFilter'.$id_cat;
			
			// Initialize pagination library 
			$ci->ajax_paging->initialize($config);
			
			// Get records 
			$conditions = array(
			'limit' => 6
			);
			
			
			$qryberita =  $ci->model_data->getRows("posting",$conditions);
			
			// $qryberita = $ci->db->query("SELECT * from posting WHERE id_cat='$id_cat' order by tanggal DESC LIMIT $limit_qry");
			// if($qryberita->num_rows() >0){
			$num =1;
			foreach ($qryberita as $row)
			{
				$penulis = 'Bantennetwork';
				$judul = $row->judul;
				$seo = $row->judul_seo;
				$tanggal = tgl_post($row->tanggal);
				$dateatom = standard_date('DATE_ATOM', strtotime($row->tanggal));
				$thnt = folderthn($row->folder);
				$blnt = folderbln($row->folder);
				$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row->gambar;
				$size = @getimagesize($opathFile);
				if($size !== false){
					$gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row->gambar;
					}else{
					$gambar = base_url()."assets/no_photo.jpg";
				}
				if($num < $limit){
					
					$html .= '<div class="td-block-span6">
					<div class="td_module_mx1 td_module_wrap td-animation-stack">
					<div class="td-block14-border"></div>
					<div class="td-module-thumb"><a href="'.$seo.'" rel="bookmark" class="td-image-wrap " title="'.$judul.'" ><img style="width: 341px; height: 220px; object-fit: cover;" src="'.$gambar.'" title="'.$judul.'" data-type="image_tag" data-img-url="'.$gambar.'" width="341" height="220"><noscript><img class="entry-thumb" src="'.$gambar.'" alt="" title="'.$judul.'" data-type="image_tag" data-img-url="'.$gambar.'"  width="341" height="220" /></noscript></a></div>        
					
					<div class="meta-info">
					<h3 class="entry-title td-module-title"><a href="'.$seo.'" rel="bookmark" title="'.$judul.'">'.$judul.'</a></h3>
					<div class="td-editor-date">
					<span class="td-post-author-name"><a href="#">'.$penulis.'</a> <span>-</span> </span><span class="td-post-date"><time class="entry-date updated td-module-date" datetime="'.$tanggal.'" >'.$dateatom.'</time></span>
					</div>
					</div>
					</div>
					</div> <!-- ./td-block-span6 -->';
					}else{
					
					$html .='<div class="td-block-span6">
					<div class="td_module_mx2 td_module_wrap td-animation-stack">
					<div class="td-module-thumb"><a href="'.$seo.'" rel="bookmark" class="td-image-wrap " title="'.$judul.'" ><img src="'.$gambar.'"  style="width: 80px; height: 60px; object-fit: cover;" title="'.$judul.'" data-type="image_tag" data-img-url="'.$gambar.'" width="80" height="60"><noscript><img class="entry-thumb" src="'.$gambar.'" alt="" title="'.$judul.'" data-type="image_tag" data-img-url="'.$gambar.'"  width="80" height="60" /></noscript></a></div>            
					<div class="item-details">
					<h3 class="entry-title td-module-title title-sub"><a href="'.$seo.'" rel="bookmark" title="'.$judul.'">'.$judul.'</a></h3>
					<div class="meta-info">
					<span class="td-post-date"><time class="entry-date updated td-module-date" datetime="'.$dateatom.'" >'.$tanggal.'</time></span></div>
					</div>
					
					</div>
					
					</div> <!-- ./td-block-span6 -->';
				}
				$num++;
			}
			// }
			$html .= '</div><!--./row-fluid-->
			</div>
			<div class="td-next-prev-wrap">
			<a href="#" class="td-ajax-prev-page" id="prev-page-tdi_25_'.$id_cat.'" data-id="tdi_25_'.$id_cat.'"><i class="td-icon-font td-icon-menu-left"></i></a>
			<a href="#" class="td-ajax-next-page" id="next-page-tdi_25_'.$id_cat.'" data-id="tdi_25_'.$id_cat.'"><i class="td-icon-font td-icon-menu-right"></i></a>
			</div>
			</div> ';
			$html .= $ci->ajax_paging->create_links();
			$html .= '<script>
			jQuery(document).ready(function($){
			function searchFilter'.$id_cat.'(page_num){
			page_num = page_num?page_num:0;
			var cat = $(this).attr("data-id");
			$.ajax({
			type: "POST",
			url: "/home/ajaxblog/"+page_num,
			data:{page:page_num,cat:cat},
			beforeSend: function(){
			$(".loading").show();
			},
			success: function(html){
			$("#tdi_'.$id_cat.'").html(html);
			$(".loading").fadeOut("slow");
			}
			});
			}
			});
			</script>';
			return $html;
			
		}
	}
	
	function blok_widgetxx(array $val){
		$ci = & get_instance();
		$qry = $ci->db->query("SELECT * from cat WHERE id_cat=".$val['id']);
		$html ="";
		if($qry->num_rows() >0){
			$row = $qry->row_array();
			$id_cat = $row['id_cat'];
			$judul_kategori = $row['nama_kategori'];
			$html .=  '<div class="td_block_wrap td_block_15  td-pb-full-cell td-pb-border-top td_block_template_1">
			<h4 class="block-title">
			<span class="td-pulldown-size">'.$judul_kategori.'</span></h4>
			<div id="tdi_25_68f" class="td_block_inner td-column-2">
			<div class="td-block-row">';
			$qryberita = $ci->db->query("SELECT * from posting WHERE id_cat='$id_cat' order by tanggal DESC LIMIT 0,".$val['limit']);
			if($qryberita->num_rows() >0){
				foreach ($qryberita->result() as $row)
				{
					$penulis = 'Bantennetwork';
					$judul = $row->judul;
					$seo = $row->judul_seo;
					$tanggal = tgl_post($row->tanggal);
					$dateatom = standard_date('DATE_ATOM', strtotime($row->tanggal));
					$thnt = folderthn($row->folder);
					$blnt = folderbln($row->folder);
					$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row->gambar;
					$size = @getimagesize($opathFile);
					if($size !== false){
						$gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row->gambar;
						}else{
						$gambar = base_url()."assets/no_photo.jpg";
					}
					$html .= '<div class="td-block-span6">
					<div class="td_module_mx1 td_module_wrap td-animation-stack">
					<div class="td-block14-border"></div>
					<div class="td-module-thumb"><a href="'.$seo.'" rel="bookmark" class="td-image-wrap " title="'.$judul.'" ><img style="width: 341px; height: 220px; object-fit: cover;" src="'.$gambar.'" title="'.$judul.'" data-type="image_tag" data-img-url="'.$gambar.'" width="341" height="220"><noscript><img class="entry-thumb" src="'.$gambar.'" alt="" title="'.$judul.'" data-type="image_tag" data-img-url="'.$gambar.'"  width="341" height="220" /></noscript></a></div>        
					
					<div class="meta-info">
					<h3 class="entry-title td-module-title"><a href="'.$seo.'" rel="bookmark" title="'.$judul.'">'.$judul.'</a></h3>
					<div class="td-editor-date">
					<span class="td-post-author-name"><a href="#">'.$penulis.'</a> <span>-</span> </span><span class="td-post-date"><time class="entry-date updated td-module-date" datetime="'.$tanggal.'" >'.$dateatom.'</time></span>
					</div>
					</div>
					</div>
					</div> <!-- ./td-block-span6 -->';
				}
			}
			$html .= '</div><!--./row-fluid-->
			
			<div class="td-block-row">';
			$qryberita = $ci->db->query("SELECT * from posting WHERE id_cat='$id_cat' order by tanggal DESC LIMIT 2,4");
			if($qryberita->num_rows() >0){
				foreach ($qryberita->result() as $row)
				{
					$judul = $row->judul;
					$seo = $row->judul_seo;
					$tanggal = tgl_post($row->tanggal);
					$dateatom = standard_date('DATE_ATOM', strtotime($row->tanggal));
					$thnt = folderthn($row->folder);
					$blnt = folderbln($row->folder);
					$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row->gambar;
					$size = @getimagesize($opathFile);
					if($size !== false){
						$gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/341x200_'.$row->gambar;
						}else{
						$gambar = base_url()."assets/no_photo.jpg";
					}
					$html .='<div class="td-block-span6">
					<div class="td_module_mx2 td_module_wrap td-animation-stack">
					<div class="td-module-thumb"><a href="'.$seo.'" rel="bookmark" class="td-image-wrap " title="'.$judul.'" ><img src="'.$gambar.'"  style="width: 80px; height: 60px; object-fit: cover;" title="'.$judul.'" data-type="image_tag" data-img-url="'.$gambar.'" width="80" height="60"><noscript><img class="entry-thumb" src="'.$gambar.'" alt="" title="'.$judul.'" data-type="image_tag" data-img-url="'.$gambar.'"  width="80" height="60" /></noscript></a></div>            
					<div class="item-details">
					<h3 class="entry-title td-module-title title-sub"><a href="'.$seo.'" rel="bookmark" title="'.$judul.'">'.$judul.'</a></h3>
					<div class="meta-info">
					<span class="td-post-date"><time class="entry-date updated td-module-date" datetime="'.$dateatom.'" >'.$tanggal.'</time></span></div>
					</div>
					
					</div>
					
					</div> <!-- ./td-block-span6 -->';
				}
			}
			$html .='</div><!--./row-fluid-->
			</div>
			<div class="td-next-prev-wrap">
			<a href="#prev" class="td-ajax-prev-page" id="prev-page-tdi_25_'.$id_cat.'" data-td_block_id="tdi_25_'.$id_cat.'"><i class="td-icon-font td-icon-menu-left"></i></a>
			<a href="#next" class="td-ajax-next-page" id="next-page-tdi_25_'.$id_cat.'" data-td_block_id="tdi_25_'.$id_cat.'"><i class="td-icon-font td-icon-menu-right"></i></a>
			</div>
			</div> ';
			
			return $html;
			
		}
	}
	function load_block($posisi)
	{
		$ci = & get_instance();
		$html = '';
		$data = $ci->model_app->view_where_ordering('widget',['pub'=>0,'posisi'=>$posisi],'urutan','ASC');
		if($data->num_rows() >0){
			foreach ($data->result_array() as $row)
			{
				$html .= blok_widget(array('id'=>$row['id_cat'],'limit'=>$row['jml']));
			}
		}
		return $html;
	}
	
	function sosmed()
	{
		$ci = & get_instance();
		$html = '';
		$data = $ci->model_app->view_where_ordering('sosmed',['publish'=>'Y'],'urutan','ASC');
		if($data->num_rows() >0){
			foreach ($data->result_array() as $row)
			{
				$implode[] = $row['link'];
			}
			$html .= json_encode($implode);
		}
		return $html;
	}
	
	function sosmed_single($val)
	{
		$ci = & get_instance();
		$html = '';
		$data = $ci->model_app->view_where('sosmed',['publish'=>'Y','tag'=>$val]);
		if($data->num_rows() >0){
			$row = $data->row_array();
			$html .=$row['link'];
		}
		return $html;
	}
	
	function logo()
	{
		$html = base_url('uploads/').tag_key('site_logo');
		return $html;
	}
	
	function tag_key($val)
	{
		$ci = & get_instance();
		$data = $ci->model_app->view_where('setting',['name'=>$val])->row();
		return $data->value;
	}
	function kalimat($text,$jml){
		$kalimat = strip_tags($text); // membuat paragraf pada isi berita dan mengabaikan tag html
		$text = substr($kalimat,0,$jml); // ambil sebanyak 200 karakter
		$text = substr($kalimat,0,strrpos($text," ")); // potong per spasi kalimat
		return $text;
	}
	function error_page()
	{
		$arr = ['title' => 'halaman tidak ditemukan',
		'keywords' => 'berita terkini, berita banten',
		'description' => 'berita terkini, berita banten',
		'canonical' => base_url(),
		'url_image' => '#',
		'json'=>[
		"@context" => "https://schema.org",
		"@type" =>  "Organization",
		"name" =>  "Banten Network",
		"url" =>  "https://www.lenternews.tv",
		"sameAs" => [
		"https://www.facebook.com/Lenternews",
		"https://twitter.com/Lenternews",
		"https://www.youtube.com/user/Lenternews",
		"https://www.pinterest.com/Lenternews/"
		]
		]
		];
		return $arr;
	}
	function menu_atas(){
		$ci = & get_instance();
		$list = $ci->model_aplikasi->CategoryList(1);
		return $list;
	}
	
	function menu_bawah(){
		$ci = & get_instance();
		$list = $ci->model_aplikasi->BottomList(1);
		return $list;
	}
	
	function iklan(array $val){
		$ci = & get_instance();
		$img = "";
		$table = 'banner';
		$qry = $ci->db->query("SELECT * from banner WHERE posisi=".$val['id']);
		if($qry->num_rows() >0){
			$row = $qry->row();
			if($val['status']=='home'){
				$img .= '<a href="'.$row->link.'" target="_blank" style="width:280px !important;height:100% !important"><img src="/assets/banner/'.$row->gambar.'" width="280" alt="lenteranews.tv"  /></a>';
				}elseif($val['status']=='cat'){
				$row = $ci->db->query("SELECT * from banner WHERE posisi=".$val['id'])->row();
				$img .= '<a href="'.$row->link.'" target="_blank" style="width:300px !important;height:100% !important"><img src="/assets/banner/'.$row->gambar.'" width="300" alt="lenteranews.tv"  /></a>';
				}elseif($val['status']=='detail'){
				$row = $ci->db->query("SELECT * from banner WHERE posisi=".$val['id'])->row();
				$img .= '<a href="'.$row->link.'" target="_blank" style="width:300px !important;height:100% !important"><img src="/assets/banner/'.$row->gambar.'" width="300" alt="lenteranews.tv"  /></a>';
			}
		}
		return $img;
	}
	function terbaru(){
		$ci = & get_instance();
		$sqlp = $ci->db->query("SELECT 
		`posting`.`judul`,
		`posting`.`folder`,
		`posting`.`gambar`,
		`posting`.`tanggal`,
		`posting`.`judul_seo`
		FROM
		`posting`
		WHERE
		`posting`.`publish` = 'Y' order by tanggal desc limit 5");
		$html ='';
		foreach($sqlp->result_array() AS $row){
			$judul = $row['judul'];
			$judul_seo = base_url('detail/').$row['judul_seo'];
			$thnt = folderthn($row['folder']);
			$blnt = folderbln($row['folder']);
			$opathFile = FCPATH.'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
			$size = @getimagesize($opathFile);
			if($size !== false){
				$gambar = base_url().'assets/post/'.$thnt.'/'.$blnt.'/316x177_'.$row['gambar'];
				}else{
				$gambar = base_url()."assets/no_photo.jpg";
			}
			if ($ci->agent->is_mobile())
			{
				$html .='<section class="item">
				<a class="col-xs-4 col-sm-4 col-md-4 col-lg-4" href="'.$judul_seo.'"><img alt="Image" src="'.$gambar.'"></a>
				<article class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<header>
				<div class="info">
				<p class="categori"><?=$nama_kategori;?></p><time datetime="'.dtimes($row['tanggal'],true,false).'">'.dtimes($row['tanggal'],true,true).'</time>
				</div><a href="'.$judul_seo.'">
				<h5>'.$judul.'</h5></a>
				</header>
				</article>
				</section>';
				}else{
				$html .='<li>
				<div class="card card-type-1">
				<div class="wrapper clearfix">
				<a class="col terkini" href="'.$judul_seo.'" style="background: #eee">
				<img loading="lazy" src="'.$gambar.'" alt="'.$judul.'" class="terkini" width="150">
				</a>
				<a class="col terkini" href="'.$judul_seo.'">
				<h2 class="title terkini">'.$judul.'</h2>
				</a>
				<a class="col terkini" href="'.$judul_seo.'">
				<span class="col terkini">2 jam lalu</span>
				</a>
				</div>
				</div>
				</li>';
			}
		}
		return $html;
	}
	function insert_baca($str,$id){
		$ci = & get_instance();
		$ci->db->query("UPDATE posting SET dibaca='$str' WHERE id_post='$id'");
	}
	function insert_populer($id,$idcat,$tanggalbaca){
		$ci = & get_instance();
		$cekdata = $ci->db->query("SELECT klik,id_cat FROM populer WHERE id_post='$id' AND tanggalklik='$tanggalbaca' AND jenis=0");
		$ada = $cekdata->num_rows();
		if($ada == 1 ){
			$rowk = $cekdata->row_array();
			$klik = $rowk['klik']+1;
			$id_kategori = $rowk['id_cat'];
			if($id_kategori == $idcat){
				$ci->db->query("UPDATE populer SET klik='$klik' WHERE id_post='$id' AND tanggalklik='$tanggalbaca' AND jenis='0'");
				}else{
				$ci->db->query("UPDATE populer SET klik='$klik',id_cat='$idcat' WHERE id_post='$id' AND tanggalklik='$tanggalbaca' AND jenis='0'");
			}
			}else{
			$ci->db->query("INSERT INTO populer(id_post,id_cat,tanggalklik,klik,jenis) VALUES('$id','$idcat','$tanggalbaca',1,0)");
			$ci->db->query("delete from populer where tanggalklik !='$tanggalbaca'");
		}
	}
	function populer(){
		$ci = & get_instance();
		$sqlp = $ci->db->query("SELECT 
		`posting`.`judul`,
		`posting`.`judul_seo`,
		`posting`.`dibaca`
		FROM
		`posting`
		INNER JOIN `populer` ON (`posting`.`id_post` = `populer`.`id_post`) order by klik desc limit 5");
		$html ='';
		$no =1;
		foreach($sqlp->result_array() AS $row){
			$judul = $row['judul'];
			$judul_seo = base_url('detail/').$row['judul_seo'];
			if ($ci->agent->is_mobile())
			{
				$html .= '<li>
				<a href="'.$judul_seo.'">
				<p>'.$judul.'</p></a>
				</li>';
				}else{
				$html .=' <li>
				<div class="card card-type-1" style="border-bottom:2px solid #fff;color:#fff;">
				<div class="wrapper clearfix">
				<a class="col" href="'.$judul_seo.'" style="background: #fff; width: 40px; height: 40px;">
				'.$no.'</a>
				<a class="col" href="'.$judul_seo.'">
				<h2 class="title-putih">'.$judul.'</h2>
				<span class="col radius-10 hitam" style="padding:5px;margin-left:10px;margin-bottom:5px">'.$row['dibaca'].'</span>
				</a>
				</div>
				</div>
				</li>';
				$no++;
			}
		}
		return $html;
	}
	function terkait($judul,$id){
		$ci = & get_instance();
		$judul = clean($judul);
		$sqlx2 = $ci->db->query("SELECT *, MATCH(judul, postingan) AGAINST('$judul') AS score
		FROM posting WHERE MATCH(judul, postingan) AGAINST('$judul') AND id_post !='$id' AND publish='Y' ORDER BY score DESC LIMIT 6");
		$html ='';
		foreach($sqlx2->result_array() AS $data){
			if ($ci->agent->is_mobile())
			{
				$html .= '<section class="row">
				<a href="'.base_url('detail/').$data['judul_seo'].'" class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<img src="#" alt="'.$data['judul'].'">
				</a>
				<article class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<header>
				<div class="info">
				<p class="categori">News</p>
				<time datetime="'.$data['tanggal'].'">
				'.$data['tanggal'].'
				</time>
				</div>
				<a href="'.base_url('detail/').$data['judul_seo'].'">
				<h5>'.$data['judul'].'</h5>
				</a>
				</header>
				</article>
				</section>';
				}else{
				$html .= '<h4 class="related__inline__title" data-gtm-vis-recent-on-screen-2485677_383="247302" data-gtm-vis-first-on-screen-2485677_383="247302" data-gtm-vis-total-visible-time-2485677_383="2000" data-gtm-vis-has-fired-2485677_383="1"><a href="'.base_url('detail/').$data['judul_seo'].'">'.$data['judul'].'</a>
				</h4>';
			}
		}
		return $html;
	}
	function editor($id){
		$ci = & get_instance();
		$query = $ci->db->query("SELECT * FROM `gtbl_user` where id_user='$id'");
		if ($query->num_rows()>=1){
			$tmp = $query->row_array();
			return $tmp['nama_lengkap'];
			}else{
			return 'Administrator';
		}
	}
	function tagshow($id){
		$ci = & get_instance();
		$res = $ci->db->query("SELECT tag FROM `posting` WHERE id_post=".$id);
		$TampungData = array();
		foreach($res->result_array() AS $data_tags){
			$tags = explode(',',strtolower(trim($data_tags['tag'])));
			if(empty($data_tags['tag'])){echo'';}else{
				foreach($tags as $val) {
					$TampungData[] = $val;
				}}
		}
		$jumlah_tag = array_count_values($TampungData);
		ksort($jumlah_tag);
		if ($jumlah_tag){
			$output = array();
			echo '<h3 class="tag tag--article clearfix">
			<div class="col w-10 tag__article__teaser col-offset-0">Tag:</div>
			<div class="col w-70">
			<ul class="tag__article__wrap">';
			foreach($jumlah_tag as $key=>$val) {
				$output[] = '<li class="tag__article__item"><a class="tag__article__link" href="/tag/'.seo_title($key).'">'.strtoupper($key).'</a></li>';
			}
			echo '</ul>
			</div>
			</h3>';
			$tagss= implode(' ',$output);
			return $tagss;
		}
		
	}
	function tagmobile($id){
		$ci = & get_instance();
		$res = $ci->db->query("SELECT tag FROM `posting` WHERE id_post=".$id);
		$TampungData = array();
		foreach($res->result_array() AS $data_tags){
			$tags = explode(',',strtolower(trim($data_tags['tag'])));
			if(empty($data_tags['tag'])){echo'';}else{
				foreach($tags as $val) {
					$TampungData[] = $val;
				}}
		}
		$jumlah_tag = array_count_values($TampungData);
		ksort($jumlah_tag);
		if ($jumlah_tag){
			$output = array();
			foreach($jumlah_tag as $key=>$val) {
				$output[] = '<a href="/tag/'.seo_title($key).'">'.strtoupper($key).'</a>';
			}
			$tagss= implode(' ',$output);
			return $tagss;
		}
		
	}
	
	function checkbox($data, $parent = 0, $parent_id = 0, $Nilai='') {
		static $i = 1;
		$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
		$tab = $i * 0 ;
		if (isset($data[$parent])) {
			$i++;
			$html ='';
			foreach ($data[$parent] as $v) {
				$child = checkbox($data, $v['idmenu'], $parent_id, $Nilai);
				//Edit Di Item
				
				$_arrNilai = explode(',', $Nilai);
				$_ck = (array_search($v['idmenu'], $_arrNilai) === false)? '' : 'checked';
				$html .= '<div class="custom-control custom-checkbox">';
				$html .= ''.$ieTab .'<input type=checkbox name="data[]" id="checkb'.$v['idmenu'].'" class="custom-control-input" value="'.$v['idmenu'].'" '.$_ck.'>&nbsp;<label for="checkb'.$v['idmenu'].'" class="custom-control-label">'.$v['nama_menu'].'</label>';
				$html .= "</div>";
				if ($child) { $i--; $html .= $child; }
			}
			return $html;
		}
	}
	function checkbox_rubrik($data, $parent = 0, $parent_id = 0, $Nilai='') {
		static $i = 1;
		$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
		$tab = $i * 0 ;
		if (isset($data[$parent])) {
			$i++;
			$html = "";
			foreach ($data[$parent] as $v) {
				$child = checkbox_rubrik($data, $v['id_cat'], $parent_id, $Nilai);
				//Edit Di Item
				
				$_arrNilai = explode(',', $Nilai);
				$_ck = (array_search($v['id_cat'], $_arrNilai) === false)? '' : 'checked';
				$html .= '<div class="">';
				$html .= ''.$ieTab .'<input type="checkbox" name="data[]" class="minimal" value="'.$v['id_cat'].'" '.$_ck.'>&nbsp;'.$v['nama_kategori'].'<br/>';
				$html .= "</div>";
				if ($child) { $i--; $html .= $child; }
			}
			return $html;
		}
	}
	function select_kbox($data, $parent = 0, $parent_id = 0, $Nilai='') {
		static $i = 1;
		$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
		$tab = $i * 0 ;
		if (isset($data[$parent])) {
			$i++;
			$html = "";
			foreach ($data[$parent] as $v) {
				$child = select_kbox($data, $v['id_cat'], $parent_id, $Nilai);
				//Edit Di Item
				
				$_arrNilai = explode(',', $Nilai);
				$_ck = (array_search($v['id_cat'], $_arrNilai) === false)? '' : 'selected';
				$html .= ''.$ieTab .'<option value="'.$v['id_cat'].'" '.$_ck.'>&nbsp;'.$v['nama_kategori'].'</option>';
				
				if ($child) { 
					$i--; $html .= $child; 
				}
			}
			return $html;
		}
	}
	function produk_jenis($data, $parent = 0, $parent_id = 0, $Nilai='') {
		static $i = 1;
		$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
		$tab = $i * 0 ;
		if (isset($data[$parent])) {
			$i++;
			$html = "";
			foreach ($data[$parent] as $v) {
				$child = produk_jenis($data, $v['id_jenis'], $parent_id, $Nilai);
				//Edit Di Item
				
				$_arrNilai = explode(',', $Nilai);
				// $_arrNilai = $Nilai;
				$_ck = (array_search($v['id_jenis'], $_arrNilai) === false)? '' : 'selected';
				$html .= ''.$ieTab .'<option value="'.$v['id_jenis'].'" '.$_ck.'>&nbsp;'.$Nilai.$v['nama_jenis'].'</option>';
				
				if ($child) { 
					$i--; $html .= $child; 
				}
			}
			return $html;
		}
	}
	function breadcrumb_tag($data, $parent = 0, $parent_id = 0, $Nilai=''){
		static $i = 1;
		$ieTab = str_repeat("&nbsp;|&nbsp;", $i * 1);
		$tab = $i * 0 ;
		if (isset($data[$parent])) {
			$i++;
			$html = "";
			// $html = '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">';
			foreach ($data[$parent] as $v) {
				$child = breadcrumb_tag($data, $v['id_cat'], $parent_id, $Nilai);
				//Edit Di Item
				
				$_arrNilai = explode(',', $Nilai);
				$_ck = (array_search($v['id_cat'], $_arrNilai) === false)? '' : 'selected';
				if($_ck){
					$html .= $ieTab.'<a  href="'.$v['kategori_seo'].'"><span itemprop="name">'.$v['nama_kategori'].'</span></a>';
				}
				if ($child) { 
					$i--; $html .= $child; 
				}
			}
			// $html .= "</li>";
			return $html;
		}
	}
	function cek_menu_akses(){
		$ci = & get_instance();
		$session = $ci->session->g_sessid;
		$link_menu = $ci->uri->uri_string();
		if(isset($session)){
			$menu = $ci->db->query("SELECT * FROM menuadmin WHERE link='$link_menu'")->row_array();
			$user = $ci->db->query("SELECT * FROM gtbl_user WHERE id_session='$session'")->row_array();
			$people = explode(",",$user['idmenu']);
			if (!in_array($menu['idmenu'], $people)){;
				redirect(base_url().'my404');
			}
			}else{
			redirect(base_url());
		}
	}
	
	function template(){
		$ci = & get_instance();
		if ($ci->agent->is_mobile())
		{ 
			$query = $ci->db->query("SELECT * FROM `themes` where publish='Y'");
			}else{
			$query = $ci->db->query("SELECT * FROM `themes` where publish='Y'");
		}
		if ($query->num_rows()>=1){
			$tmp = $query->row_array();
			return $tmp['folder'];
			}else{
			return 'errors';
		}
	}
	function backend(){
		$ci = & get_instance();
		$query = $ci->db->query("SELECT * FROM `themes` where publish='N'");
		if ($query->num_rows()>=1){
			$tmp = $query->row_array();
			return $tmp['folder'];
			}else{
			return 'errors';
		}
	}
	function pengaturan($val){
		$ci = & get_instance();
		$title = $ci->db->query("SELECT * FROM setting where name='$val'")->row_array();
		return $title['value'];
	}
	
	
	function cek_session_admin(){
		$ci = & get_instance();
		$session = $ci->session->g_level;
		if ($session != 'admin'){
			redirect(base_url());
		}
	}
	function cek_session_login(){
		$ci = & get_instance();
		$session = $ci->session->g_level;
		if (!isset($session)){
			redirect(base_url());
		}
	}    
	function data_style($id){
		$ci = & get_instance();
		$rows = $ci->db->query("SELECT * FROM `data_style` where id_user='$id'")->row_array();
		$arrs = $rows['data_json'];
		$dataJson = $rows['data_json'];
		$data = json_decode($dataJson,true);
		if(!empty($data)){
			$arrt = $data['theme'];
			}else{
			$arrt = array('limit'=>6,'kolom'=>4,'klass'=>'tiga');
		}
		return $arrt;
	}    																																									