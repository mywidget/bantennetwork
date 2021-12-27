<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Menu extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->perPage = 5;
			cek_session_login();	
		}
		
		
		public function index()
		{
			// echo $this->uri->segment(1);
			cek_menu_akses();
			$data['title']       = 'Menu Web';
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			$data['menusite']  	 = $this->model_app->view_order('menu','urutan','ASC');
			$this->template->load(backend().'/themes',backend().'/menu-web',$data);
		}
		
		public function crud(){
			// cek_session_login();	
			$type     = $this->input->get('type', TRUE);
			$gdata    = $this->input->get('data', TRUE);
			$id       = $this->input->get('id', TRUE);('id');
			$label    = $this->input->get('label', TRUE);
			$link     = $this->input->get('link', TRUE);
			$eclass   = $this->input->get('eclass', TRUE);
			$treeview = $this->input->get('parentc', TRUE);
			$aktif    = $this->input->get('aktif', TRUE);
			$submenu  = $this->input->get('submenu', TRUE);
			$posisi  = $this->input->get('posisi', TRUE);
			
			if($type=='get'){
				$data = array();
				$return = $this->db->query("SELECT * FROM menu WHERE idmenu='".$id."'")->row_array();	
				$data = array(
				'id'      => $return['idmenu'],
				'label'   => $return['nama_menu'],
				'link'    => $return['link'],
				'eclass'  => $return['icon'],
				'parentc' => $return['treeview'],
				'aktif'   => $return['aktif'],
				'level'   => $return['id_level'],
				'submenu' => $return['sub_menu'],
				'posisi' => $return['position']
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
					$qry = $this->db->query("update menu set parent_id = '".$row['parentID']."', urutan='$i' where idmenu = '".$row['id']."' ");
					$i++;
				}
				
			}elseif($type=='hapus')
			{
				function recursiveDelete($id) {
					$ci = & get_instance();
					$data = array('hapus'=>'hapus');
					$query = $ci->db->query("select * from menu where parent_id = '".$id."' ");
					if ($query->num_rows >0) {
						foreach ($query->result_array() as $current){
							recursiveDelete($current['idmenu']);
						}
					}
					$qry = $ci->db->query("delete from menu where idmenu = '".$id."' ");
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
			// 
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
					$this->db->query("update menu set nama_menu = '".$label."', link  = '".$link."', icon  = '".$eclass."', treeview  = '".$treeview."', aktif  = '".$aktif."', sub_menu  = '".$submenu."', id_level  = '".$level."' where idmenu = '".$id."' ");
					
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
					$row = $this->db->query("SELECT max(urutan)+1 as urutan FROM menu")->row_array();
					$qry = $this->db->query("insert into menu (nama_menu,link,icon,id_level,treeview,aktif,sub_menu,urutan) values ('".$label."', '".$link."', '".$eclass."', '".$level."', '".$treeview."', '".$aktif."','".$submenu."','".$row['urutan']."')");
					if($qry){
						$arr['ok']       = 'ok';
						$lastid          = $this->db->insert_id();
						$resultz         = $this->db->query("SELECT idmenu FROM menu");
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
		
	}		