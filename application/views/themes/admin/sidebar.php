<div class="sidebar-header">
	<a class="header-brand" href="index.html">
		<div class="logo-img">
			<img src="<?=base_url('uploads/').tag_key('site_favicon');?>" width="32" class="header-brand-img" alt="">
		</div>
		<span class="text">Adminpanel</span>
	</a>
	<button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
	<button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
</div>
<div class="sidebar-content">
	<div class="nav-container">
		<nav id="main-menu-navigation" class="navigation-main">
			<div class="nav-lavel">Navigation</div>
			<div class="nav-item">
				<a href="/main"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
			</div>
			<?php
				$sq = $this->db->query("SELECT * from gtbl_user where email='$g_email'");
				$n =  $sq->row_array();
				$idm = $n['id_level'];
				$sidemenu = $n['idmenu'];
				$sql= $this->db->query("select * from menuadmin where idmenu IN ($sidemenu) AND idparent='0' AND aktif='Y' order by urutan ");
				if($sql->num_rows() > 0){
					$no =1;
					foreach ($sql->result_array() as $m)
					{
						$_sql= $this->db->query("select count(idparent) as jum from menuadmin where idparent='$m[idmenu]' AND aktif='Y'");
						$_m=$_sql->row_array();
						$idlm = $m['id_level']; 
						$menuid = explode(",",$idlm);
						// print_r($menuid);
						if (in_array($idm, $menuid)){
							$nama_menu = $m['nama_menu'];
							$id_nama_menu = $m['nama_menu'];
							// echo $nama_menu;
							if($m['treeview']=='header'){
								echo '<div class="nav-lavel">'.$nama_menu.'</div>';
								}elseif($m['treeview']=='treeview'){
								echo '<div class="nav-item has-sub">';
								echo '<a href="javascript:void(0)"><i class="fa '.$m['icon'].'"></i><span>'.$nama_menu.'</span><span class="badge badge-danger">'.$_m['jum'].'</span></a>';
								$sub= $this->db->query("SELECT * FROM menuadmin WHERE idmenu IN ($sidemenu) AND idparent=$m[idmenu] AND aktif='Y' order by urutan");
								$jml= $sub->num_rows();
								// apabila sub menu ditemukan                
								if ($jml > 0){
									foreach ($sub->result_array() as $w)
									{
										$subid = $w['idmenu'];
										$sublv = $w['id_level'];
										///
										$menuidsub = explode(",",$sidemenu);
										if (in_array($subid, $menuidsub)){
											$menulv = explode(",",$sublv);
											if (in_array($idm, $menulv)){
												echo '<div class="submenu-content">
												<a href="'.base_url().$w['link'].'" class="menu-item"><i class="ik ik-minus"></i> '.$w['nama_menu'].'</a>
												</div>';
											}
										}
									}
								}
								echo "</div>";
								}else{
								echo '<div class="nav-item"><a href="'.base_url().$m['link'].'"><i class="fa '.$m['icon'].'"></i><span>'.$nama_menu.'</span></a></div>';
							}
						}
					}
				}
			?>
		</nav>
	</div>
</div>		
<script type="text/javascript">
	var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname + window.location.search
	var pathArray = newURL.split("/");
	var url = window.location.protocol + "//" + window.location.host +'/' + pathArray[3]+'/'+pathArray[4];
	// console.log(urls);
	// var url = pathArray;
	// untuk sidebar menu
	$('nav.navigation-main > .nav-item a').filter(function() {
		return this.href == url;
	}).parent().siblings().removeClass('active').end().addClass('active');
	
	// for sub
	$('.nav-item a').filter(function() {
		return this.href == url;
	}).closest('.has-sub').addClass('active open');
	
	$('.menu-item').filter(function() {
		return this.href == url;
	}).closest("a").siblings().removeClass('active').end().addClass('active').css({ display: "block" });
</script> 		