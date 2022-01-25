<?php 
	function getFirstPar($string){
        $string = substr($string,0, strpos($string, "</p>")+4);
        return $string;
    }
	
	function getFirstParp($string){
        $string = substr($string,0, strpos($string, "</p>")+4);
        $string = str_replace("<p>", "", str_replace("<p/>", "", $string));
        return $string;
    }
	function rp($angka){
		$konversi = ''.number_format($angka, 0, ',', '.');
		return $konversi;
	}
	function maxIDT($array,$key){
		$arr = max(array_column($array,$key));
		$data = $arr+1;
		return $data;
	}
	function slugify($string)
    {
        // Replace unsupported characters (add your owns if necessary)
        $string = str_replace("'", '-', $string);
        $string = str_replace(".", '-', $string);
        $string = str_replace("²", '2', $string);
		
        // Slugify and return the string
        return url_title(convert_accented_characters($string), 'dash', true);
	}
	function cleanString($text) {
		// 1) convert á ô => a o
		$text = preg_replace("/[áàâãªä]/u","a",$text);
		$text = preg_replace("/[ÁÀÂÃÄ]/u","A",$text);
		$text = preg_replace("/[ÍÌÎÏ]/u","I",$text);
		$text = preg_replace("/[íìîï]/u","i",$text);
		$text = preg_replace("/[éèêë]/u","e",$text);
		$text = preg_replace("/[ÉÈÊË]/u","E",$text);
		$text = preg_replace("/[óòôõºö]/u","o",$text);
		$text = preg_replace("/[ÓÒÔÕÖ]/u","O",$text);
		$text = preg_replace("/[úùûü]/u","u",$text);
		$text = preg_replace("/[ÚÙÛÜ]/u","U",$text);
		$text = preg_replace("/[’‘‹›‚]/u","'",$text);
		$text = preg_replace("/[“”«»„]/u",'"',$text);
		$text = str_replace("–","-",$text);
		$text = str_replace(" "," ",$text);
		$text = str_replace("ç","c",$text);
		$text = str_replace("Ç","C",$text);
		$text = str_replace("ñ","n",$text);
		$text = str_replace("Ñ","N",$text);
		
		//2) Translation CP1252. &ndash; => -
		$trans = get_html_translation_table(HTML_ENTITIES);
		$trans[chr(130)] = '&sbquo;';    // Single Low-9 Quotation Mark
		$trans[chr(131)] = '&fnof;';    // Latin Small Letter F With Hook
		$trans[chr(132)] = '&bdquo;';    // Double Low-9 Quotation Mark
		$trans[chr(133)] = '&hellip;';    // Horizontal Ellipsis
		$trans[chr(134)] = '&dagger;';    // Dagger
		$trans[chr(135)] = '&Dagger;';    // Double Dagger
		$trans[chr(136)] = '&circ;';    // Modifier Letter Circumflex Accent
		$trans[chr(137)] = '&permil;';    // Per Mille Sign
		$trans[chr(138)] = '&Scaron;';    // Latin Capital Letter S With Caron
		$trans[chr(139)] = '&lsaquo;';    // Single Left-Pointing Angle Quotation Mark
		$trans[chr(140)] = '&OElig;';    // Latin Capital Ligature OE
		$trans[chr(145)] = '&lsquo;';    // Left Single Quotation Mark
		$trans[chr(146)] = '&rsquo;';    // Right Single Quotation Mark
		$trans[chr(147)] = '&ldquo;';    // Left Double Quotation Mark
		$trans[chr(148)] = '&rdquo;';    // Right Double Quotation Mark
		$trans[chr(149)] = '&bull;';    // Bullet
		$trans[chr(150)] = '&ndash;';    // En Dash
		$trans[chr(151)] = '&mdash;';    // Em Dash
		$trans[chr(152)] = '&tilde;';    // Small Tilde
		$trans[chr(153)] = '&trade;';    // Trade Mark Sign
		$trans[chr(154)] = '&scaron;';    // Latin Small Letter S With Caron
		$trans[chr(155)] = '&rsaquo;';    // Single Right-Pointing Angle Quotation Mark
		$trans[chr(156)] = '&oelig;';    // Latin Small Ligature OE
		$trans[chr(159)] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis
		$trans['euro'] = '&euro;';    // euro currency symbol
		ksort($trans);
		
		foreach ($trans as $k => $v) {
			$text = str_replace($v, $k, $text);
		}
		
		// 3) remove <p>, <br/> ...
		$text = strip_tags($text);
		
		// 4) &amp; => & &quot; => '
		$text = html_entity_decode($text);
		
		// 5) remove Windows-1252 symbols like "TradeMark", "Euro"...
		$text = preg_replace('/[^(\x20-\x7F)]*/','', $text);
		
		$targets=array('\r\n','\n','\r','\t');
		$results=array(" "," "," ","");
		$text = str_replace($targets,$results,$text);
		
		//XML compatible
		/*
			$text = str_replace("&", "and", $text);
			$text = str_replace("<", ".", $text);
			$text = str_replace(">", ".", $text);
			$text = str_replace("\\", "-", $text);
			$text = str_replace("/", "-", $text);
		*/
		
		return ($text);
	} 
	function cleans($s) {
		$c = array (' ');
		$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','"');
		
		$s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
		
		$s = strtolower(str_replace($c, '_', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
		return $s;
	}
	function clean($text){
		$text = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode($text)));
		return $text;
	}
	function cleanTag($text){
		$text = preg_replace('/[^a-zA-Z0-9\s]/', ' ', strip_tags(html_entity_decode($text)));
		return $text;
	}
	function formatDate($d)
	{
		return str_replace('00:00:00', '', $d);
	}
    function tgl_exp($tglp){
		$tgl_post = date('Y-m-d',strtotime($tglp));
		return $tgl_post;		 
	}	
    function checkcard($data, $parent = 0, $parent_id = 0, $Nilai='') {
		static $i = 1;
		$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
		$tab = $i * 0 ;
		if (isset($data[$parent])) {
			$i++;
			$html ="";
			foreach ($data[$parent] as $v) {
				$child = checkcard($data, $v['idmenu'], $parent_id, $Nilai);
				//Edit Di Item
				
				$_arrNilai = explode(',', $Nilai);
				$_ck = (array_search($v['idmenu'], $_arrNilai) === false)? '' : 'checked';
				$html .= '<div class="checkbox">';
				$html .= ''.$ieTab .'<input type=checkbox name="data[]" class="minimal" value="'.$v['idmenu'].'" '.$_ck.'>&nbsp;'.$v['nama_menu'].'<br/>';
				$html .= "</div>";
				if ($child) { $i--; $html .= $child; }
			}
			return $html;
		}
	}
    function page_header(array $data){
	$html = "";
	$html .= '<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h5>'.$data['title'].'</h5>
                    <span>Kelola data '.$data['title'].'</span>
					</div>
            </div>
        </div>
        <div class="col-lg-4 d-sm-none d-md-block">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data '.$data['title'].'</li>
                </ol>
            </nav>
        </div>
    </div>
</div>';
return $html;
	}
    function card_header(array $data){
		$toltip = '';
		if(!empty($data['toltip'])){
			$toltip = $data['toltip'];
		}
		if(!empty($data['nama_app'])){
			$index = 'onClick="'.$data['nama_app'].'()"';
			$tambah = '<li><a href="#" '.$index.' data-toggle="tooltip" data-placement="left" title="" data-original-title="'.$toltip.'"><i class="ik ik-plus"></i></a></li>';
			}else{
			$tambah = '';
		}
		if(!empty($data['info'])){
			$info = '<li><a href="#" onClick="'.$data['info'].'()" data-toggle="tooltip" data-placement="left" title="" data-original-title="Info"><i class="ik ik-info"></i></a></li>';
			}else{
			$info = '';
		}
		
		$html = '<div class="card-header">
		<h3>'.$data['title'].'</h3>';
		$html .= '<div class="card-header-right">
		<ul class="list-unstyled card-option" style="width: 90px; overflow: visible!imporant;text-align:right">';
        $html .= '<li><a href="'.base_url('main').'" data-toggle="tooltip" data-placement="left" data-original-title="Beranda"><i class="ik ik-home"></i></a></li>';
		$html .= $tambah;
		$html .= $info;
		$html .= '</ul>
		</div>
		</div>';
		return $html;
	}
    function cekUser($val){
		$ci = & get_instance();
		$sql_bhn = $ci->db->query("SELECT * FROM gtbl_user where id_user='$val' AND aktif='Y'");
		if($sql_bhn->num_rows() >0){
			$rows=$sql_bhn->row_array();
			$data = array(
            'status'=>1,
            'email'=>$rows['email'],
            'nohp'=>$rows['no_hp'],
            'id'=>$rows['id_user'],
            'nama'=>$rows['nama_lengkap'],
            'img'=>$rows['profile_image'],
            'idlv'=>$rows['idlevel'],
            'parent'=>$rows['parent'],
            'alamat'=>$rows['alamat'],
            'idmenu'=>$rows['idmenu'],
            'lv'=>$rows['id_level']);
			}else{
			$data = array('status'=>0,'email'=>'','nohp'=>'','id'=>0,'nama'=>'','img'=>'','idlv'=>'','parent'=>'','web'=>'','secret'=>'','alamat'=>'','percetakan'=>'','idmenu'=>'','lv'=>'');
		}
		return $data;
	}
    function p_header(array $val_cols,$modul='home'){
		$i=0;
		foreach($val_cols as $key=>$value) {
			$StValue[$i] = $value;
			$i++;
		}
		$icon = !empty($StValue[0]) ? $StValue[0] : "layers";
		$bg = !empty($StValue[1]) ? $StValue[1] : "blue";
		$title = !empty($StValue[2]) ? $StValue[2] : "layers";
		$subtitle = !empty($StValue[3]) ? $StValue[3] : "layers";
		$urlsatu = !empty($StValue[4]) ? $StValue[4] : "layers";
		$urldua = !empty($StValue[5]) ? $StValue[5] : "layers";
		// return $bg;
		$html ='<div class="page-header">
		<div class="row align-items-end">
		<div class="col-lg-8">
		<div class="page-header-title">
		<i class="ik ik-'.$icon.' bg-'.$bg.'"></i>
		<div class="d-inline">
		<h5>'.$title.'</h5>
		<span>'.$subtitle.'</span>
		</div>
		</div>
		</div>
		<div class="col-lg-4">
		<nav class="breadcrumb-container" aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		<a href="./"><i class="ik ik-home"></i></a>
		</li>';
		if(!empty($StValue[4])){
			$html .='<li class="breadcrumb-item">
			<a href="#">'.$urlsatu.'</a>
			</li>';
		}
		$html .='<li class="breadcrumb-item active" aria-current="page">'.$urldua.'</li>
		</ol>
		</nav>
		</div>
		</div>
		</div>';
		return $html;
	}
    function check_menu($data, $parent = 0, $parent_id = 0, $Nilai = '')
	{
		static $i = 1;
		$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
		$tab = $i * 0;
		if (isset($data[$parent])) {
			$i++;
			$html = "";
			$a = 0;
			foreach ($data[$parent] as $v) {
				$child = check_menu($data, $v['id_level'], $parent_id, $Nilai);
				//Edit Di Item
				
				$_arrNilai = explode(',', $Nilai);
				$_ck = (array_search($v['id_level'], $_arrNilai) === false) ? '' : 'checked';
				$html .= '<div class="checkbox">';
				$html .= '' . $ieTab . '<input type=checkbox name="idlevel[]" id="idlevel' . $v['id_level'] . '" class="get_value" value="' . $v['id_level'] . '" ' . $_ck . ' >&nbsp;' . $v['nama'] . '<br/>';
				$html .= "</div>";
				if ($child) {
					$i--;
					$html .= $child;
				}
				$a++;
			}
			return $html;
		}
	}
    function CekMailUser($val){
		$ci = & get_instance();
		$sql_bhn = $ci->db->query("SELECT * FROM gtbl_user where email='$val'");
		if($sql_bhn->num_rows() >0){
			$rows=$sql_bhn->row_array();
			$data = array(
            'status'=>1,
            'email'=>$rows['email'],
            'nohp'=>$rows['no_hp'],
            'id'=>$rows['id_user'],
            'nama'=>$rows['nama_lengkap'],
            'img'=>$rows['profile_image'],
            'level'=>$rows['level'],
            'idlv'=>$rows['idlevel'],
            'parent'=>$rows['parent'],
            'alamat'=>$rows['alamat'],
            'idmenu'=>$rows['idmenu'],
            'lv'=>$rows['id_level']
            );
			}else{
			$data = array('status'=>0,'email'=>'','nohp'=>'','id'=>0,'nama'=>'','img'=>'','idlv'=>'','parent'=>'','web'=>'','secret'=>'','alamat'=>'','percetakan'=>'','idmenu'=>'','lv'=>'');
		}
		return $data;
	}
    function getDomain()
    {
        $CI =& get_instance();
        return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", $CI->config->slash_item('base_url'));
	}
    function curl($url, $data){
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $output = curl_exec($ch); 
        curl_close($ch);      
        return $output;
	}
    function multiexplode($delimiters,$string) {
		$ready = str_replace($delimiters, $delimiters[0], $string);
		$launch = explode($delimiters[0], $ready);
		return  $launch;
	}
    function kata($string, $limit, $break=" ", $pad="...") {
        // return with no change if string is shorter than $limit 
        if(strlen($string) <= $limit) 
        return $string; 
        $string = substr($string, 0, $limit); 
        if(false !== ($breakpoint = strrpos($string, $break))) { 
		$string = substr($string, 0, $breakpoint); } 
        return $string . $pad; 
	}
    function cetak($str){
        return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
	}
    
    function cetak_meta($str,$mulai,$selesai){
        return strip_tags(html_entity_decode(substr(str_replace('"','',$str),$mulai,$selesai), ENT_COMPAT, 'UTF-8'));
	}
    
    function getSearchTermToBold($text, $words){
        preg_match_all('~[A-Za-z0-9_äöüÄÖÜ]+~', $words, $m);
        if (!$m)
        return $text;
        $re = '~(' . implode('|', $m[0]) . ')~i';
        return preg_replace($re, '<b style="color:red">$0</b>', $text);
	}
    
    function tgl_indo($tgl){
        $tanggal = substr($tgl,8,2);
        $bulan = getBulan(substr($tgl,5,2));
        $tahun = substr($tgl,0,4);
        return $tanggal.' '.$bulan.' '.$tahun;       
	} 
    
    function tgl_simpan($tgl){
        $tanggal = substr($tgl,0,2);
        $bulan = substr($tgl,3,2);
        $tahun = substr($tgl,6,4);
        return $tahun.'-'.$bulan.'-'.$tanggal;       
	}
    
    function tgl_view($tgl){
        $tanggal = substr($tgl,8,2);
        $bulan = substr($tgl,5,2);
        $tahun = substr($tgl,0,4);
        return $tanggal.'-'.$bulan.'-'.$tahun;       
	}
    
    function tgl_grafik($tgl){
        $tanggal = substr($tgl,8,2);
        $bulan = getBulan(substr($tgl,5,2));
        $tahun = substr($tgl,0,4);
        return $tanggal.'_'.$bulan;       
	}   
    
    function generateRandomString($length = 10) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	} 
    
    function seo_title($s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','–');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
	}
    
    function hari_ini($w){
        $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $hari_ini = $seminggu[$w];
        return $hari_ini;
	}
    function xhari($tgl){
        $tanggal 	= strtotime($tgl);
		$hari_arr 	= Array ('0'=>'Minggu',
        '1'=>'Senin',
        '2'=>'Selasa',
        '3'=>'Rabu',
        '4'=>'Kamis',
        '5'=>'Jum`at',
        '6'=>'Sabtu'
        );
		$hari 	= @$hari_arr[date('w',$tanggal)];
        return $hari;	
	}
	function xjam($jam){
        $jam_post = date('H:i',strtotime($jam));
        return $jam_post;		 
	}
    function getBulan($bln){
        switch ($bln){
            case 1: 
            return "Januari";
            break;
            case 2:
            return "Februari";
            break;
            case 3:
            return "Maret";
            break;
            case 4:
            return "April";
            break;
            case 5:
            return "Mei";
            break;
            case 6:
            return "Juni";
            break;
            case 7:
            return "Juli";
            break;
            case 8:
            return "Agustus";
            break;
            case 9:
            return "September";
            break;
            case 10:
            return "Oktober";
            break;
            case 11:
            return "November";
            break;
            case 12:
            return "Desember";
            break;
		}
	} 
    function getBlnAgenda($bln){
        switch ($bln){
            case 1: 
            return "Jan";
            break;
            case 2:
            return "Feb";
            break;
            case 3:
            return "Mar";
            break;
            case 4:
            return "Apr";
            break;
            case 5:
            return "Mei";
            break;
            case 6:
            return "Jun";
            break;
            case 7:
            return "Jul";
            break;
            case 8:
            return "Agu";
            break;
            case 9:
            return "Sep";
            break;
            case 10:
            return "Okt";
            break;
            case 11:
            return "Nov";
            break;
            case 12:
            return "Des";
            break;
		}
	} 
    
    function cek_terakhir($datetime, $full = false) {
        $today = time();    
        $createdday= strtotime($datetime); 
        $datediff = abs($today - $createdday);  
        $difftext="";  
        $years = floor($datediff / (365*60*60*24));  
        $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
        $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
        $hours= floor($datediff/3600);  
        $minutes= floor($datediff/60);  
        $seconds= floor($datediff);  
        //year checker  
        if($difftext=="")  
        {  
            if($years>1)  
            $difftext=$years." Tahun";  
            elseif($years==1)  
            $difftext=$years." Tahun";  
		}  
        //month checker  
        if($difftext=="")  
        {  
            if($months>1)  
            $difftext=$months." Bulan";  
            elseif($months==1)  
            $difftext=$months." Bulan";  
		}  
        //month checker  
        if($difftext=="")  
        {  
            if($days>1)  
            $difftext=$days." Hari";  
            elseif($days==1)  
            $difftext=$days." Hari";  
		}  
        //hour checker  
        if($difftext=="")  
        {  
            if($hours>1)  
            $difftext=$hours." Jam";  
            elseif($hours==1)  
            $difftext=$hours." Jam";  
		}  
        //minutes checker  
        if($difftext=="")  
        {  
            if($minutes>1)  
            $difftext=$minutes." Menit";  
            elseif($minutes==1)  
            $difftext=$minutes." Menit";  
		}  
        //seconds checker  
        if($difftext=="")  
        {  
            if($seconds>1)  
            $difftext=$seconds." Detik";  
            elseif($seconds==1)  
            $difftext=$seconds." Detik";  
		}  
        return $difftext;  
	}
    function getYEmbedUrl($url){
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
        
        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
		}
        
        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
		}
        return 'https://www.youtube.com/embed/' . $youtube_id ;
	}
    function format_size($size) {
        $mod = 1024;
        $units = explode(' ','B KB MB GB TB PB');
        for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
		}
        return round($size, 2) . ' ' . $units[$i];
	}
    function folderSize ($dir)
    {
        $size = 0;
        foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : folderSize($each);
		}
        return $size;
	}
    function thumb($path,$fullname, $width, $height)
    {
        // Path to image thumbnail in your root
        $dir = $path;
        $url = base_url() . $path;
        // Get the CodeIgniter super object
        $CI = &get_instance();
        // get src file's extension and file name
        $extension = pathinfo($fullname, PATHINFO_EXTENSION);
        $filename = pathinfo($fullname, PATHINFO_FILENAME);
        $image_org = $dir . $filename . "." . $extension;
        $image_thumb = $dir . $filename . "-" . $height . '_' . $width . "." . $extension;
        $image_returned = $url . $filename . "-" . $height . '_' . $width . "." . $extension;
        
        if (!file_exists($image_thumb)) {
            // LOAD LIBRARY
            $CI->load->library('image_lib');
            // CONFIGURE IMAGE LIBRARY
            $config['source_image'] = $image_org;
            $config['new_image'] = $image_thumb;
            $config['width'] = $width;
            $config['height'] = $height;
            $CI->image_lib->initialize($config);
            $CI->image_lib->resize();
            $CI->image_lib->clear();
		}
        return $image_returned;
	}
    function potdesc($text,$jml){
        $text = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode($text)));
        //$kalimat = strip_tags($text); // membuat paragraf pada isi berita dan mengabaikan tag html
        $text = substr($text,0,$jml); // ambil sebanyak 200 karakter
        $text = substr($text,0,strrpos($text," ")); // potong per spasi kalimat
        return $text;
	}
    
    function strip_word_html($text, $allowed_tags = '')
    {
        mb_regex_encoding('UTF-8');
        //replace MS special characters first
        $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u', '/&ndash;/u', '/&quot;/u', '/ndash/u' );
        $replace = array('\'', '\'', '"', '"', '-');
        $text = preg_replace($search, $replace, $text);
        //make sure _all_ html entities are converted to the plain ascii equivalents - it appears
        //in some MS headers, some html entities are encoded and some aren't
        //$text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        //try to strip out any C style comments first, since these, embedded in html comments, seem to
        //prevent strip_tags from removing html comments (MS Word introduced combination)
        if(mb_stripos($text, '/*') !== FALSE){
            $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');
		}
        //introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be
        //'<1' becomes '< 1'(note: somewhat application specific)
        $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
        $text = strip_tags($text, $allowed_tags);
        //eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one
        $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text);
        //strip out inline css and simplify style tags
        $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu');
        $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>');
        $text = preg_replace($search, $replace, $text);
        //on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears
        //that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains
        //some MS Style Definitions - this last bit gets rid of any leftover comments */
        $num_matches = preg_match_all("/\<!--/u", $text, $matches);
        if($num_matches){
            $text = preg_replace('/\<!--(.)*--\>/isu', '', $text);
		}
        $text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $text);
        return $text;
	}                    						