<?php 
	function tglsl($tglp){
		$tgl_post = date('d/m/Y',strtotime($tglp));
		return $tgl_post;		 
	}
	function tgl_tiket($tgl,$Jam=true){
		$tanggal 	= strtotime($tgl);
		$hari 	= @$hari_arr[date('w',$tanggal)];
		$tggl 	= date('j',$tanggal);
		$bln 	= date('m',$tanggal);
		$thn 	= date('Y',$tanggal);
		$jam 	= $Jam ? date ('(H:i)',$tanggal) : '';
		return "$tggl/$bln/$thn $jam";	
		
	}
	function date_slash($date){
		$exp = explode('/',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	function date_slashh($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'/'.$exp[1].'/'.$exp[0];
		}
		return $date;
	}
	function time_ago($original)
	{
		date_default_timezone_set('Asia/Jakarta');
		$chunks = array(
		array(60 * 60 * 24 * 365, 'tahun'),
		array(60 * 60 * 24 * 30, 'bulan'),
		array(60 * 60 * 24 * 7, 'minggu'),
		array(60 * 60 * 24, 'hari'),
		array(60 * 60, 'jam'),
		array(60, 'menit'),
		);
		$today = time();
		$since = $today - $original;
		
		if ($since > 604800)
		{
			$print = date("M jS", $original);
			if ($since > 31536000)
			{
				$print .= ", " . date("Y", $original);
			}
			return $print;
		}
		
		for ($i = 0, $j = count($chunks); $i < $j; $i++)
		{
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];
			
			if (($count = floor($since / $seconds)) != 0)
			break;
		}
		
		$print = ($count == 1) ? '1 ' . $name : "$count {$name}";
		return $print . ' yang lalu';
	}
	function waktu_lalu($timestamp)
	{
		$selisih = time() - strtotime($timestamp) ;
		
		$detik = $selisih ;
		$menit = round($selisih / 60 );
		$jam = round($selisih / 3600 );
		$hari = round($selisih / 86400 );
		$minggu = round($selisih / 604800 );
		$bulan = round($selisih / 2419200 );
		$tahun = round($selisih / 29030400 );
		
		if ($detik <= 60) {
			$waktu = $detik.' detik yang lalu';
			} else if ($menit <= 60) {
			$waktu = $menit.' menit yang lalu';
			} else if ($jam <= 24) {
			$waktu = $jam.' jam yang lalu';
			} else if ($hari <= 7) {
			$waktu = $hari.' hari yang lalu';
			} else if ($minggu <= 4) {
			$waktu = $minggu.' minggu yang lalu';
			} else if ($bulan <= 12) {
			$waktu = $bulan.' bulan yang lalu';
			} else {
			$waktu = $tahun.' tahun yang lalu';
		}
		
		return $waktu;
	}
	function waktu_lalu_2($timestamp)
	{
		$selisih = time() - strtotime($timestamp) ;
		
		$detik = $selisih ;
		$menit = round($selisih / 60 );
		$jam = round($selisih / 3600 );
		$hari = round($selisih / 86400 );
		$minggu = round($selisih / 604800 );
		$bulan = round($selisih / 2419200 );
		$tahun = round($selisih / 29030400 );
		
		if ($detik <= 60) {
			$waktu = $detik.'d';
			} else if ($menit <= 60) {
			$waktu = $menit.'m';
			} else if ($jam <= 24) {
			$tgl = date($timestamp, $detik);
			$jam_post = date('H:i',strtotime($tgl));
			$waktu = $jam_post;
			} else if ($hari <= 7) {
			$tgl = date($timestamp, $detik);
			$jam_post = date('H:i',strtotime($tgl));
			$waktu = $jam_post;
			} else if ($minggu <= 4) {
			$tgl = date($timestamp, $detik);
			$jam_post = date('H:i',strtotime($tgl));
			$waktu = $jam_post;
			} else if ($bulan <= 12) {
			$tgl = date($timestamp, $detik);
			$jam_post = date('H:i',strtotime($tgl));
			$waktu = $jam_post;
			} else {
			$tgl = date($timestamp, $detik);
			$jam_post = date('H:i',strtotime($tgl));
			$waktu = $jam_post;
		}
		
		return $waktu;
	}
	//end timeago
	//fungsi combobox
	function combotgl($awal, $akhir, $var, $terpilih){
		echo "<select name=$var>";
		for ($i=$awal; $i<=$akhir; $i++){
			$lebar=strlen($i);
			switch($lebar){
				case 1:
				{
					$g="0".$i;
					break;     
				}
				case 2:
				{
					$g=$i;
					break;     
				}      
			}  
			if ($i==$terpilih)
			echo "<option value=$g selected>$g</option>";
			else
			echo "<option value=$g>$g</option>";
		}
		echo "</select> ";
	}
	
	function combobln($awal, $akhir, $var, $terpilih){
		echo "<select name=$var>";
		for ($bln=$awal; $bln<=$akhir; $bln++){
			$lebar=strlen($bln);
			switch($lebar){
				case 1:
				{
					$b="0".$bln;
					break;     
				}
				case 2:
				{
					$b=$bln;
					break;     
				}      
			}  
			if ($bln==$terpilih)
			echo "<option value=$b selected>$b</option>";
			else
			echo "<option value=$b>$b</option>";
		}
		echo "</select> ";
	}
	
	function combothn($awal, $akhir, $var, $terpilih){
		echo "<select name=$var>";
		for ($i=$awal; $i<=$akhir; $i++){
			if ($i==$terpilih)
			echo "<option value=$i selected>$i</option>";
			else
			echo "<option value=$i>$i</option>";
		}
		echo "</select> ";
	}
	
	function combonamabln($awal, $akhir, $var, $terpilih){
		$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
		"Juni", "Juli", "Agustus", "September", 
		"Oktober", "November", "Desember");
		echo "<select name=$var>";
		for ($bln=$awal; $bln<=$akhir; $bln++){
			if ($bln==$terpilih)
			echo "<option value=$bln selected>$nama_bln[$bln]</option>";
			else
			echo "<option value=$bln>$nama_bln[$bln]</option>";
		}
		echo "</select> ";
	}
	
	//fungsi kalender
	function buatkalender($tanggal,$bulan,$tahun) {
		$bulanan=array(1=>"Januari","Februari","Maret","April",
		"Mei","Juni","Juli","Agustus","September", 
		"Oktober","November","Desember");
		$bln=date("n");
		$thn=date("Y");
		
		$jmlhari = date("t",mktime(0,0,0,$bulan,1,$tahun));
		$haritglsatu = date("w",mktime(0,0,0,$bulan,1,$tahun));
		
		$kalender = "<table cellspacing=1 cellpadding=4  
		border=0 class=tabel_data>\n";
		$kalender .= "<tr class=tr_terang>
		<td colspan=7>$bulanan[$bln], $thn
		</td></tr>\n";
		
		$kalender .= "<tr class=tr_judul>
		<td>M</td><td>S</td><td>S</td><td>R</td>
		<td>K</td><td>J</td><td>S</td></tr>\n";
		$a 	  = 1;
		$adabaris   = TRUE;
		$mulaicetak = 0;
		while ($adabaris) {
			$kalender .= "<tr align=center class=tr_terang>";
			for ($i = 0; $i < 7; $i++ ) {
				if ($mulaicetak < $haritglsatu) {
					$kalender .= "<td>&nbsp;</td>";
					$mulaicetak++;
				} 
				elseif ($a <= $jmlhari) {
					$tt = $a;
					if ($a == $tanggal) { 
						$tt = "<span style='color: blue; font-weight: bold; 
						font-size: larger; text-decoration: blink;'>
						$tt</span>"; 
					}
					if ($i == 0) { 
						$tt = "<font color=\"#FF0000\">$tt</font>"; 
					}
					$kalender .= "<td>$tt</td>";
					$a++;
				} 
				else {
					$kalender .= "<td>&nbsp;</td>";
				}
			}
			$kalender .= "</tr>\n";
			if ($a <= $jmlhari) { 
				$adabaris = TRUE; 
			} 
			else { 
				$adabaris = FALSE; 
			}
		}
		$kalender .= "</table>\n";
		return $kalender;
	}
	function tanggal($tglp){
		$tgl_post = date('Y-m-d',strtotime($tglp));
		return $tgl_post;		 
	}
	
	function tanggal_post($tglp){
		$tgl_post = date('Y-m-d H:i',strtotime($tglp));
		return $tgl_post;		 
	}
	function tanggal2($tglp){
		$tgl_post = date('d/m/Y H:i',strtotime($tglp));
		return $tgl_post;		 
	}
	function tgl_update($tglp){
		$tgl_post = date('d F Y',strtotime($tglp));
		return $tgl_post;		 
	}
	function jam_update($jam){
		$jam_post = date('H:i:s',strtotime($jam));
		return $jam_post;		 
	}
	function durasi($tgl,$Jam=true){
	$tanggal 	= strtotime($tgl);
	$jam 	= $Jam ? date ('H:i',$tanggal) : '';
	return $jam;	
}
	function hari_update($day){
		$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
		$day_post = $array_hari[date('N',strtotime($day))];
		return $day_post;		 
	}	
	function foldertgl($thn){
		$tahun = date('d',strtotime($thn));
		return $tahun;		 
	}
	function folderthn($thn){
		$tahun = date('Y',strtotime($thn));
		return $tahun;		 
	}
	function folderbln($bln1){
		$bulan = date('m',strtotime($bln1));
		return $bulan;		 
	}
	
	function bulan($tgl){
		$tanggal 	= strtotime($tgl);
		$bln_array 	= array (
		'01'=>'JAN',
		'02'=>'FEB',
		'03'=>'MAR',
		'04'=>'APR',
		'05'=>'MAY',
		'06'=>'JUN',
		'07'=>'JUL',
		'08'=>'AUG',
		'09'=>'SEP',
		'10'=>'OcT',
		'11'=>'NOV',
		'12'=>'DEC'
		);
		$bln 	= @$bln_array[date('m',$tanggal)];
		return $bln;	
		
	}
	function tgl_post($tgl,$Jam=true,$Wib=true){
		$tanggal 	= strtotime($tgl);
		$bln_array 	= array (
		'01'=>'Jan',
		'02'=>'Feb',
		'03'=>'Mar',
		'04'=>'Apr',
		'05'=>'May',
		'06'=>'Jun',
		'07'=>'Jul',
		'08'=>'Aug',
		'09'=>'Sep',
		'10'=>'Oct',
		'11'=>'Nov',
		'12'=>'Des'
		);
		$hari_arr 	= Array (	'0'=>'Minggu',
		'1'=>'Senin',
		'2'=>'Selasa',
		'3'=>'Rabu',
		'4'=>'Kamis',
		'5'=>'Jumat',
		'6'=>'Sabtu'
		);
		$hari 	= @$hari_arr[date('w',$tanggal)];
		$tggl 	= date('j',$tanggal);
		$bln 	= @$bln_array[date('m',$tanggal)];
		$thn 	= date('Y',$tanggal);
		$jam 	= $Jam ? date ('H:i',$tanggal) : '';
		$wib	= $Wib ? 'WIB' :'';
		return "$hari, $tggl $bln $thn $jam $wib";	
		
	}
	
	function datetimes($tgl,$Jam=true,$Wib=true){
		$tanggal 	= strtotime($tgl);
		$bln_array 	= array (
		'01'=>'Januari',
		'02'=>'Februari',
		'03'=>'Maret',
		'04'=>'April',
		'05'=>'Mei',
		'06'=>'Juni',
		'07'=>'Juli',
		'08'=>'Agustus',
		'09'=>'September',
		'10'=>'Oktober',
		'11'=>'November',
		'12'=>'Desember'
		);
		$hari_arr 	= Array (	'0'=>'Minggu',
		'1'=>'Senin',
		'2'=>'Selasa',
		'3'=>'Rabu',
		'4'=>'Kamis',
		'5'=>'Jumat',
		'6'=>'Sabtu'
		);
		$hari 	= @$hari_arr[date('w',$tanggal)];
		$tggl 	= date('j',$tanggal);
		$bln 	= @$bln_array[date('m',$tanggal)];
		$thn 	= date('Y',$tanggal);
		$jam 	= $Jam ? date ('H:i',$tanggal) : '';
		$wib	= $Wib ? 'WIB' :'';
		return "$hari, $tggl $bln $thn $jam $wib";	
		
	}
	function dtimes($tgl,$Jam=true,$Wib=true){
		$tanggal 	= strtotime($tgl);
		$hari_arr 	= Array (	'0'=>'Minggu',
		'1'=>'Senin',
		'2'=>'Selasa',
		'3'=>'Rabu',
		'4'=>'Kamis',
		'5'=>'Jumat',
		'6'=>'Sabtu'
		);
		$hari 	= @$hari_arr[date('w',$tanggal)];
		$tggl 	= date('j',$tanggal);
		$bln 	= date('m',$tanggal);
		$thn 	= date('Y',$tanggal);
		$jam 	= $Jam ? date ('H:i',$tanggal) : '';
		$wib	= $Wib ? 'WIB' :'';
		return "$hari, $tggl/$bln/$thn $jam $wib";	
		
	}
?>