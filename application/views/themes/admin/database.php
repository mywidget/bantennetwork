<?php
	
	$cekmesin          = cekCount('data_mesin','id','judul','count',$this->session->g_id);
	$data_jenis        = cekCount('data_jenis','id','judul','count',$this->session->g_id);
	$data_katbahan     = cekCount('data_katbahan','id','judul','count',$this->session->g_id);
	$data_bahan        = cekCount('data_bahan','id','judul','count',$this->session->g_id);
	$data_ukurankertas = cekCount('data_kertas','id','judul','count',$this->session->g_id);
	$data_plano        = cekCount('data_plano','id','judul','count',$this->session->g_id);
	$data_insheet      = cekCount('data_insheet','id','judul','count',$this->session->g_id);
	$data_hargaprint   = cekCount('data_hargaprint','id','judul','count',$this->session->g_id);
	$data_biaya        = cekCount('data_biaya','id','judul','count',$this->session->g_id);
	$data_produk       = cekCount('data_produk','id','judul','count',$this->session->g_id);
	$data_style        = cekCount('data_theme','id','judul','count',$this->session->g_id);
	$data_hitung       = cekCount('data_hitung','id','judul','count',$this->session->g_id);
	$data_konsumen     = cekCount('data_konsumen','id','judul','count',$this->session->g_id);
	$data_surat        = cekCount('data_surat','id','judul','count',$this->session->g_id);
	$penawaran_harga   = cekCount('penawaran_harga','id','judul','count',$this->session->g_id);
	$data_setting      = cekCount('data_limit','id','judul','count',$this->session->g_id);
	$data_counter      = cekCount('data_counter','id','judul','count',$this->session->g_id);
	
	$cekdata = cekData([
	'mesin'=>$cekmesin['status'],
	'jenis'=>$data_jenis['status'],
	'katbahan'=>$data_katbahan['status'],
	'bahan'=>$data_bahan['status'],
	'ukuran'=>$data_ukurankertas['status'],
	'plano'=>$data_plano['status'],
	'insheet'=>$data_insheet['status'],
	'hargaprint'=>$data_hargaprint['status'],
	'biaya'=>$data_biaya['status'],
	'produk'=>$data_produk['status'],
	'style'=>$data_style['status'],
	'hitung'=>$data_hitung['status'],
	'konsumen'=>$data_konsumen['status'],
	'surat'=>$data_surat['status'],
	'penawaran'=>$penawaran_harga['status'],
	'setting'=>$data_setting['status'],
	'counter'=>$data_counter['status']]
	);
	
	
	
?>
<div class="page-header">
	<div class="row align-items-end">
		<div class="col-lg-8">
			<div class="page-header-title">
				<i class="ik ik-database bg-blue"></i>
				<div class="d-inline">
					<h5>Database</h5>
					<span>List database </span>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<nav class="breadcrumb-container" aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="/"><i class="ik ik-home"></i></a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Database</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-12 col-md-6 col-sm-12">
		<div class="card">
			<?php
				if($cekdata==false){
					echo '<div class="card-header"><h3><button class="btn btn-warning" id="install">Cek & Install Data</button></h3></div>';
					}else{
					echo '<div class="card-header"><h3>List Data</h3></div>';
				};
			?>
			
			<div class="card-body p-1">
				<?php
					// if($_cek['status']!='error'){
				?>
				<ul class="list-group list-group-flush" id="list-group">
					<li class="list-group-item"><span class="tag-pill float-xs-right mr-3"><b>Status</b></span><span class=" tag-pill  float-xs-right mr-2"><b>Count</b></span><b>Title</b></li>
					<?php
						
						if($cekmesin['status']==1){
							$cmesin = countd($cekmesin['count'],'mesin');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$cmesin.'</span>1. '.ucwords($cekmesin['judul']).'</li>';
							}else{
							$cmesin = countd($cekmesin['count'],'mesin');
							$u_link = "";
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$cmesin.'</span>'.ucwords($cekmesin['judul']).'</li>';
						}
						
						if($data_jenis['status']==1){
							$c_jenis= countd($data_jenis['count'],'jenis');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_jenis.'</span>2. '.ucwords($data_jenis['judul']).'</li>';
							}else{
							$u_link = "";
							$c_jenis = countd($data_jenis['count'],'jenis');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_jenis.'</span>'.ucwords($data_jenis['judul']).'</li>';
						}
						
						if($data_katbahan['status']==1){
							$ckatbahan = countd($data_katbahan['count'],'katbahan');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$ckatbahan.'</span>3. '.ucwords($data_katbahan['judul']).'</li>';
							}else{
							$u_link = "";
							$ckatbahan = countd($data_katbahan['count'],'katbahan');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$ckatbahan.'</span>'.ucwords($data_katbahan['judul']).'</li>';
						}
						
						if($data_bahan['status']==1){
							$ckatbahan = countd($data_bahan['count'],'bahan');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$ckatbahan.'</span>4. '.ucwords($data_bahan['judul']).'</li>';
							}else{
							$u_link = "";
							$ckatbahan = countd($data_bahan['count'],'bahan');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$ckatbahan.'</span>'.ucwords($data_bahan['judul']).'</li>';
						}
						if($data_ukurankertas['status']==1){
							$c_count = countd($data_ukurankertas['count'],'kertas');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_count.'</span>5. '.ucwords($data_ukurankertas['judul']).'</li>';
							}else{
							$u_link = "";
							$c_count = countd($data_ukurankertas['count'],'kertas');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_count.'</span>'.ucwords($data_ukurankertas['judul']).'</li>';
						}
						if($data_plano['status']==1){
							$c_count = countd($data_plano['count'],'plano');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_count.'</span>6. '.ucwords($data_plano['judul']).'</li>';
							}else{
							$u_link = "";
							$c_count = countd($data_plano['count'],'plano');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_count.'</span>'.ucwords($data_plano['judul']).'</li>';
						}
						if($data_insheet['status']==1){
							$c_count = countd($data_insheet['count'],'insheet');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_count.'</span>7. '.ucwords($data_insheet['judul']).'</li>';
							}else{
							$u_link = "";
							$c_count = countd($data_insheet['count'],'insheet');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_count.'</span>'.ucwords($data_insheet['judul']).'</li>';
						}
						if($data_hargaprint['status']==1){
							$c_count = countd($data_hargaprint['count'],'hargaprint');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_count.'</span>8. '.ucwords($data_hargaprint['judul']).'</li>';
							}else{
							$u_link = "";
							$c_count = countd($data_hargaprint['count'],'hargaprint');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_count.'</span>'.ucwords($data_hargaprint['judul']).'</li>';
						}
						if($data_biaya['status']==1){
							$c_count = countd($data_biaya['count'],'biaya');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_count.'</span>9. '.ucwords($data_biaya['judul']).'</li>';
							}else{
							$u_link = "";
							$c_count = countd($data_biaya['count'],'biaya');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_count.'</span>'.ucwords($data_biaya['judul']).'</li>';
						}
						if($data_produk['status']==1){
							$produk = $data_produk['count'];
							$prod_arr = explode(",", $produk);
							$cproduk = count($prod_arr);
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$cproduk.'</span>10.'.ucwords($data_produk['judul']).'</li>';
							}else{
							$u_link = "";
							$produk = $data_produk['count'];
							$prod_arr = explode(",", $produk);
							$cproduk = count($prod_arr);
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$cproduk.'</span>'.ucwords($data_produk['judul']).'</li>';
						}
						if($data_style['status']==1){
							$c_count = countd($data_style['count'],'theme');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_count.'</span>11.'.ucwords($data_style['judul']).'</li>';
							}else{
							$u_link = "";
							$c_count = countd($data_style['count'],'theme');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_count.'</span>'.ucwords($data_style['judul']).'</li>';
						}
						
						if($data_hitung['status']==1){
							$c_count = countd($data_hitung['count'],'hitung');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_count.'</span>12.'.ucwords($data_hitung['judul']).'</li>';
							}else{
							$u_link = "";
							$c_count = countd($data_hitung['count'],'hitung');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_count.'</span>'.ucwords($data_hitung['judul']).'</li>';
						}
						if($data_konsumen['status']==1){
							$c_count = countd($data_konsumen['count'],'konsumen');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_count.'</span>13.'.ucwords($data_konsumen['judul']).'</li>';
							}else{
							$u_link = "";
							$c_count = countd($data_konsumen['count'],'konsumen');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_count.'</span>'.ucwords($data_konsumen['judul']).'</li>';
						}
						if($data_surat['status']==1){
							$c_count = countd($data_surat['count'],'surat');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_count.'</span>14.'.ucwords($data_surat['judul']).'</li>';
							}else{
							$u_link = "";
							$c_count = countd($data_surat['count'],'surat');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_count.'</span>'.ucwords($data_surat['judul']).'</li>';
						}
						if($penawaran_harga['status']==1){
							$c_count = countd($penawaran_harga['count'],'penawaran');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_count.'</span>15.'.ucwords($penawaran_harga['judul']).'</li>';
							}else{
							$u_link = "";
							$c_count = countd($penawaran_harga['count'],'penawaran');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_count.'</span>'.ucwords($penawaran_harga['judul']).'</li>';
						}
						if($data_setting['status']==1){
							$c_count = countd($data_setting['count'],'limit');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_count.'</span>16.'.ucwords($data_setting['judul']).'</li>';
							}else{
							$u_link = "";
							$c_count = countd($data_setting['count'],'limit');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_count.'</span>'.ucwords($data_setting['judul']).'</li>';
						}
						if($data_counter['status']==1){
							$c_count = countd($data_counter['count'],'counter');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-info float-xs-right">Ok</span><span class="tag tag-warning tag-pill bg-success float-xs-right">'.$c_count.'</span>17.'.ucwords($data_counter['judul']).'</li>';
							}else{
							$u_link = "";
							$c_count = countd($data_counter['count'],'counter');
							echo '<li class="list-group-item"><span class="tag tag-danger tag-pill bg-warning float-xs-right"><a href="'.$u_link.'">Install</a></span><span class="tag tag-warning tag-pill bg-danger float-xs-right">'.$c_count.'</span>'.ucwords($data_counter['judul']).'</li>';
						}
						
					?>
				</ul>
				<?php
					// }else{
					// echo '<div class="col-md-12"><div class="alert bg-danger alert-danger text-white no-print" role="alert">
					// Akun belum diverifikasi
					// </div></div>';
					// }
				?>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).on('click', '#install', function(e){
		$.ajax({
			type: "POST",
			url: base_url+"master/install",
			dataType: 'json',
			data: {type:"install"},
			beforeSend: function () {
				$('.se-pre-con').fadeIn();
			},
			success: function(res) {
				if(res.status=='ok'){
					$("#list-group").load(location.href + " #list-group");
					next(res.jenis);
					console.log(res);
				}
				$('.se-pre-con').fadeOut("slow");
			}
		});
	});
	
	function next(str)
	{
		$.ajax({
			type: "POST",
			url: base_url+"master/install",
			dataType: 'json',
			data: {type:str},
			beforeSend: function () {
				$('.se-pre-con').fadeIn();
			},
			success: function(res) {
				console.log(res);
				if(res.status=='ok'){
					$("#list-group").load(location.href + " #list-group");
					next1(res.jenis);
					}else if(res.jenis=='counter'){
					$("#list-group").load(location.href + " #list-group");
					// next(res.jenis);
					$('.se-pre-con').fadeOut("slow");
					}else{
					$('.se-pre-con').fadeOut("slow");
				}
			}
		});
	}
	function next1(str)
	{
		$.ajax({
			type: "POST",
			url: base_url+"master/install",
			dataType: 'json',
			data: {type:str},
			beforeSend: function () {
				$('.se-pre-con').fadeIn();
			},
			success: function(res) {
				console.log(res);
				if(res.status=='ok'){
					$("#list-group").load(location.href + " #list-group");
					next(res.jenis);
					}else if(res.jenis=='counter'){
					$("#list-group").load(location.href + " #list-group");
					// next(res.jenis);
					$('.se-pre-con').fadeOut("slow");
					}else{
					$('.se-pre-con').fadeOut("slow");
				}
			}
		});
	}
	
</script>