<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Main extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->perPage = 5;
			cek_session_login();
		}
		
		public function index()
		{
			$data['title'] = 'Beranda | '.tag_key('site_title');
			$data['description'] = 'description';
			$data['keywords'] = 'keywords';
			$this->template->load(backend().'/themes',backend().'/content',$data);
		}
		
		public function profil()
		{
			$data['title'] = 'Profil | '.tag_key('site_title');
			$data['description'] = 'description';
			$data['keywords'] = 'keywords';
			$this->template->load(backend().'/themes',backend().'/content',$data);
		}
		
		public function menuadmin()
		{
			// echo $this->uri->segment(1);
			cek_menu_akses();
			$data['title']       = 'Menu Admin';
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			$this->template->load(backend().'/themes',backend().'/menuadmin',$data);
		}
		public function info(){
			cek_menu_akses();
			$data['title'] = 'Pengaturan Aplikasi';
			$data['description'] = 'description';
			$data['keywords'] = 'keywords';
			$data['rows'] = $this->model_app->views('info')->row_array();
			$this->template->load('main/themes','main/website/index',$data);
		}
		public function info_save(){
			if (isset($_POST['submit'])){
				$this->session->set_flashdata('message', '<script>notif("Data di simpan [Hanya demo]","success");</script>');
				redirect('main/info');
			}
		}
		public function info_save_ed(){
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'uploads/';
				$config['allowed_types'] = 'gif|jpg|png|ico|svg';
				$config['max_size'] = '1000'; // kb
				$this->load->library('upload', $config);
				
				$search=$this->model_app->view_where('info',array('id'=>1));
				if($search->num_rows()>0){
					$datas=$search->row();
					$nama_logo=$datas->logo;
					$nama_logo_bw=$datas->logo_bw;
					$nama_icon=$datas->favicon;
					$lunas=$datas->stamp_l;
					$blunas=$datas->stamp_b;
				}
				// print_r($search);
				// echo $nama_logo;
				if(!empty($_FILES["logo"]["name"])){
					$_logo=FCPATH."uploads/".$nama_logo;
					unlink($_logo);
					if(!$this->upload->do_upload('logo'))  
					{  
						echo $this->upload->display_errors();  
					}  
					else  
					{  
						$data = $this->upload->data();  
						$nama_logo = $data["file_name"];
					}  
				}
				
				if(!empty($_FILES["logo_bw"]["name"])){
					$_logo=FCPATH."uploads/".$nama_logo_bw;
					unlink($_logo);
					if(!$this->upload->do_upload('logo_bw'))  
					{  
						echo $this->upload->display_errors();  
					}  
					else  
					{  
						$data = $this->upload->data();  
						$nama_logo_bw = $data["file_name"];
					}  
				}
				if(!empty($_FILES["icon"]["name"])){
					$favicon=FCPATH."uploads/".$nama_icon;
					unlink($favicon);
					if(!$this->upload->do_upload('icon'))  
					{  
						echo $this->upload->display_errors();  
					}  
					else  
					{  
						$data = $this->upload->data();  
						$nama_icon = $data["file_name"];
					}  
				}
				if(!empty($_FILES["lunas"]["name"])){
					$favicon=FCPATH."uploads/".$lunas;
					unlink($favicon);
					if(!$this->upload->do_upload('lunas'))  
					{  
						echo $this->upload->display_errors();  
					}  
					else  
					{  
						$data = $this->upload->data();  
						$lunas = $data["file_name"];
					}  
				}
				if(!empty($_FILES["blunas"]["name"])){
					$favicon=FCPATH."uploads/".$blunas;
					unlink($favicon);
					if(!$this->upload->do_upload('blunas'))  
					{  
						echo $this->upload->display_errors();  
					}  
					else  
					{  
						$data = $this->upload->data();  
						$blunas = $data["file_name"];
					}  
				}
				$data = array('title'=>$this->input->post('title')
				,'deskripsi'=>$this->input->post('deskripsi')
				,'ket'=>$this->input->post('ket')
				,'email'=>$this->input->post('email')
				,'phone'=>$this->input->post('phone')
				,'fb'=>$this->input->post('fb')
				,'ig'=>$this->input->post('ig')
				,'logo'=>$nama_logo
				,'logo_bw'=>$nama_logo_bw
				,'stamp_l'=>$lunas
				,'stamp_b'=>$blunas
				,'warna_lunas'=>$this->input->post('warna_lunas')
				,'warna_blunas'=>$this->input->post('warna_blunas')
				,'tema'=>$this->input->post('tema')
				,'favicon'=>$nama_icon);	
				$where = array('id' => 1);
				$res= $this->model_app->update('info', $data, $where);
				if($res==true){
					$this->session->set_flashdata('message', '<script>notif("Data di simpan","success");</script>');
					redirect('main/info');
					}else{
					$this->session->set_flashdata('message', '<script>notif("Data gagal di simpan","danger");</script>');
					redirect('main/info');
				}
			}
		}
		
		public function json_chart(){
			$data=$this->model_data->get_chart();
			print json_encode($data);
		}
		public function crud(){
			// cek_session_login();	
			$type = $this->input->get('type', TRUE);
			$gdata = $this->input->get('data', TRUE);
			$id = $this->input->get('id', TRUE);('id');
			$label = $this->input->get('label', TRUE);
			$link = $this->input->get('link', TRUE);
			$eclass = $this->input->get('eclass', TRUE);
			$treeview = $this->input->get('parentc', TRUE);
			$aktif = $this->input->get('aktif', TRUE);
			$submenu = $this->input->get('submenu', TRUE);
			if($type=='get'){
				$data = array();
				$return = $this->db->query("SELECT * FROM menuadmin WHERE idmenu='".$id."'")->row_array();	
				$data = array(
				'id' => $return['idmenu'],
				'label' => $return['nama_menu'],
				'link' => $return['link'],
				'eclass' => $return['icon'],
				'parentc' => $return['treeview'],
				'aktif' => $return['aktif'],
				'level' => $return['id_level'],
				'submenu' => $return['link_on']
				);	
				echo json_encode($data);
				}elseif($type=='simpan'){
				$data = json_decode($this->input->get('data', TRUE));
				function parseJsonArray($jsonArray, $parentID = 0) {
					$return = array();
					foreach ($jsonArray as $subArray) {
						$returnSubSubArray = array();
						if (isset($subArray->children)) {
							$returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
						}
						$return[] = array('id' => $subArray->id, 'parentID' => $parentID);
						$return = array_merge($return, $returnSubSubArray);
					}
					return $return;
				}
				
				$readbleArray = parseJsonArray($data);
				
				$i=0;
				foreach($readbleArray as $row){
					$qry = $this->db->query("update menuadmin set idparent = '".$row['parentID']."', urutan='$i' where idmenu = '".$row['id']."' ");
					$i++;
				}
				
				}elseif($type=='hapus'){
				function recursiveDelete($id) {
					$ci = & get_instance();
					$data = array('hapus'=>'hapus');
					$query = $ci->db->query("select * from menuadmin where idparent = '".$id."' ");
					if ($query->num_rows >0) {
						foreach ($query->result_array() as $current){
							recursiveDelete($current['idmenu']);
						}
					}
					$qry = $ci->db->query("delete from menuadmin where idmenu = '".$id."' ");
					if($qry){
						$data = array('ok'=>'ok');;
						}else{
						$data = array('ok'=>'error');;
					}
					echo json_encode($data);
				}
				recursiveDelete($id);
			}
		}
		
		public function save_menu(){
			// cek_session_login();	
			$type = $this->input->get('type', TRUE);
			$id = $this->input->get('id', TRUE);('id');
			$label = $this->input->get('label', TRUE);
			$link = $this->input->get('link', TRUE);
			$eclass = $this->input->get('eclass', TRUE);
			$treeview = $this->input->get('parentc', TRUE);
			$aktif = $this->input->get('aktif', TRUE);
			$submenu = $this->input->get('submenu', TRUE);
			$level = $this->input->get('level', TRUE);
			///
			if($type=='simpan'){
				if($id != ''){
					$this->db->query("update menuadmin set nama_menu = '".$label."', link  = '".$link."', icon  = '".$eclass."', treeview  = '".$treeview."', aktif  = '".$aktif."', link_on  = '".$submenu."', id_level  = '".$level."' where idmenu = '".$id."' ");
					
					$arr['type']  = 'edit';
					$arr['label'] = $label;
					$arr['link']  = $link;
					$arr['eclass']  = $eclass;
					$arr['parentc']  = $treeview;
					$arr['aktif']  = $aktif;
					$arr['submenu']  = $submenu;
					$arr['level']  = $level;
					$arr['id']    = $id;
					} else {
					$row = $this->db->query("SELECT max(urutan)+1 as urutan FROM menuadmin")->row_array();
					$qry = $this->db->query("insert into menuadmin (nama_menu,link,icon,id_level,treeview,aktif,link_on,urutan) values ('".$label."', '".$link."', '".$eclass."', '".$level."', '".$treeview."', '".$aktif."','".$submenu."','".$row['urutan']."')");
					if($qry){
						$arr['ok']       = 'ok';
						$lastid          = $this->db->insert_id();
						$resultz         = $this->db->query("SELECT idmenu FROM menuadmin");
						foreach ($resultz->result_array() as $rowz){
							$ids_array[] = $rowz['idmenu'];
						}
						$data = implode(",",$ids_array);
						$this->db->query("update gtbl_user set idmenu = '".$data."'");
						$arr['menu'] = '<li class="dd-item dd3-item" data-id="'.$lastid.'" >
	                    <div class="dd-handle dd3-handle"></div>
	                    <div class="ns-row">
						<div class="ns-title" id="label_show'.$lastid.'">'.$label.'</div>
						<div class="ns-url" id="link_show'.$lastid.'">'.$link.'</div> 
						<div class="ns-class" id="eclass_show'.$lastid.'">'.$eclass.'</div>
						<div class="ns-actions">
						<a class="edit-button" id="'.$lastid.'" label="'.$label.'" link="'.$link.'" eclass="'.$eclass.'" parentc="'.$treeview.'"><i class="fa fa-pencil"></i></a>
						<a href="#" class="confirm-delete" data-id="'.$lastid.'" id="'.$lastid.'"><i class="fa fa-trash"></i></a>
						</div> 
	                    </div>
						<script>
						$(".confirm-delete").on("click", function(e) {
						e.preventDefault();
						var id = $(this).data("id");
						$("#myModalDel").data("id", id).modal("show");
						});
						</script>';
						}else{
						$arr['type'] = 'error';
					}
					$arr['type'] = 'add';
				}
			}
			
			echo json_encode($arr);
		}
		
		function ajaxAppid()
        {
            // Define offset 
            $page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
                } else {
                $offset = $page;
			}
            $keywords = $this->input->post('keywords');
            if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
			}
            $sortBy = $this->input->post('sortBy');
            if (!empty($sortBy)) {
                $conditions['search']['sortBy'] = $sortBy;
			}
            
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getAppid($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('main/ajaxAppid');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchFilter';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            
            // $sWhere = "WHERE level='owner' AND parent='$iduser' OR level='marketing' AND parent='$iduser'";
            unset($conditions['returnType']);
            $data['fetchw'] = $this->model_data->getAppid($conditions);
            
            
            // Load the data list view 
            $this->load->view(backend() . '/ajax/ajax-appidadm', $data, false);
		}
		
		
		public function database()
		{
			$data['title']       = 'Database | '.tag_key('site_title');
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			$this->template->load(backend().'/themes',backend().'/database',$data);
		}
		
	}		