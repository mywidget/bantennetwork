<?php 
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
		$arr = ['title' => 'halaman tidak ditemukan | lenternews.tv',
		'keywords' => 'berita terkini, berita banten',
		'description' => 'berita terkini, berita banten',
		'canonical' => base_url(),
		'url_image' => '#',
		'json'=>[
		"@context" => "https://schema.org",
		"@type" =>  "Organization",
		"name" =>  "Lentera News",
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
			$query = $ci->db->query("SELECT * FROM `themes` where publish='M'");
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
	function title(){
		$ci = & get_instance();
		$title = $ci->db->query("SELECT nama_website FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
		return $title['nama_website'];
	}
	
	function description(){
		$ci = & get_instance();
		$title = $ci->db->query("SELECT meta_deskripsi FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
		return $title['meta_deskripsi'];
	}
	
	function keywords(){
		$ci = & get_instance();
		$title = $ci->db->query("SELECT meta_keyword FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
		return $title['meta_keyword'];
	}
	
	function favicon(){
		$ci = & get_instance();
		$fav = $ci->db->query("SELECT favicon FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
		return $fav['favicon'];
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