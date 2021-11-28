<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Administrator extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->helper('string');
			$this->load->model('User_model');
		}
		function index(){
			redirect('main');
		}
		function error(){
			$this->template->load('administrator/template','administrator/error');
		}
		function home(){
			if ($this->session->level=='admin'){
				$this->template->load('administrator/template','administrator/view_home_admin');
				}else{
				$data['users'] = $this->model_app->view_where('users',array('username'=>$this->session->username))->row_array();
				$data['modul'] = $this->model_app->view_join_one('users','users_modul','id_session','id_umod','DESC');
				$this->template->load('administrator/template','administrator/view_home_users',$data);
			}
		}
		
		// Controller Modul Menu websizeinfo
		
		function websizeinfo(){
			if ($this->session->level=='admin'){
				$this->template->load('administrator/template','administrator/view_websizeinfo');
			}
		}
		
		function identitaswebsite(){
			cek_menu_akses('identitaswebsite',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/images/';
				$config['allowed_types'] = 'gif|jpg|png|ico';
				$config['max_size'] = '500'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('j');
				$hasil=$this->upload->data();
				
				if ($hasil['file_name']==''){
					$data = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
					'email'=>$this->db->escape_str($this->input->post('b')),
					'url'=>$this->db->escape_str($this->input->post('c')),
					'facebook'=>$this->input->post('d'),
					'rekening'=>$this->db->escape_str($this->input->post('e')),
					'no_telp'=>$this->db->escape_str($this->input->post('f')),
					'meta_deskripsi'=>$this->input->post('g'),
					'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
					'maps'=>$this->input->post('i'));
					}else{
					$data = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
					'email'=>$this->db->escape_str($this->input->post('b')),
					'url'=>$this->db->escape_str($this->input->post('c')),
					'facebook'=>$this->input->post('d'),
					'rekening'=>$this->db->escape_str($this->input->post('e')),
					'no_telp'=>$this->db->escape_str($this->input->post('f')),
					'meta_deskripsi'=>$this->input->post('g'),
					'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
					'favicon'=>$hasil['file_name'],
					'maps'=>$this->input->post('i'));
				}
				$where = array('id_identitas' => $this->input->post('id'));
				$this->model_app->update('identitas', $data, $where);
				
				redirect('administrator/identitaswebsite');
				}else{
				$proses = $this->model_app->edit('identitas', array('id_identitas' => 1))->row_array();
				$data = array('record' => $proses);
				$this->template->load('administrator/template','administrator/mod_identitas/view_identitas',$data);
			}
		}
		
		// Controller Modul Menu Website
		function menuadmin(){
			cek_menu_akses('menuadmin',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('menuadmin','urutan','ASC');
			$this->template->load('administrator/template','administrator/mod_menuadmin/view_menu',$data);
		}
		function crud(){
			cek_session_login();	
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
				'eclass' => $return['classes'],
				'parentc' => $return['treeview'],
				'aktif' => $return['aktif'],
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
						$data = array(0=>'ok');;
						}else{
						$data = array(0=>'error');;
					}
					echo json_encode($data);
				}
				recursiveDelete($id);
			}
		}
		function save_menu(){
			cek_session_login();	
			$type = $this->input->get('type', TRUE);
			$id = $this->input->get('id', TRUE);('id');
			$label = $this->input->get('label', TRUE);
			$link = $this->input->get('link', TRUE);
			$eclass = $this->input->get('eclass', TRUE);
			$treeview = $this->input->get('parentc', TRUE);
			$aktif = $this->input->get('aktif', TRUE);
			$submenu = $this->input->get('submenu', TRUE);
			///
			if($type=='simpan'){
				if($id != ''){
					$this->db->query("update menuadmin set nama_menu = '".$label."', link  = '".$link."', classes  = '".$eclass."', treeview  = '".$treeview."', aktif  = '".$aktif."', link_on  = '".$submenu."' where idmenu = '".$id."' ");
					
					$arr['type']  = 'edit';
					$arr['label'] = $label;
					$arr['link']  = $link;
					$arr['eclass']  = $eclass;
					$arr['parentc']  = $treeview;
					$arr['aktif']  = $aktif;
					$arr['submenu']  = $submenu;
					$arr['id']    = $id;
					} else {
					$row = $this->db->query("SELECT max(urutan)+1 as urutan FROM menuadmin")->row_array();
					$qry = $this->db->query("insert into menuadmin (nama_menu,link,classes,treeview,aktif,link_on,urutan,id_level) values ('".$label."', '".$link."', '".$eclass."', '".$treeview."', '".$aktif."','".$submenu."','".$row['urutan']."','1')");
					if($qry){
						$arr['ok'] = 'ok';
						$lastid = $this->db->insert_id();
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
		function menuwebsite(){
			cek_menu_akses('menuwebsite',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('menu','urutan','ASC');
			$this->template->load('administrator/template','administrator/mod_menu/view_menu',$data);
		}
		
		function tambah_menuwebsite(){
			cek_menu_akses('menuwebsite',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('id_parent'=>$this->db->escape_str($this->input->post('b')),
				'nama_menu'=>$this->db->escape_str($this->input->post('c')),
				'link'=>$this->db->escape_str($this->input->post('a')),
				'position'=>$this->db->escape_str($this->input->post('d')),
				'urutan'=>$this->db->escape_str($this->input->post('e')),
				'deskripsi'=>$this->db->escape_str($this->input->post('g')));
				$this->model_app->insert('menu',$data);
				redirect('administrator/menuwebsite');
				}else{
				$proses = $this->model_app->view_where_ordering('menu', array('position' => 'Bottom'), 'id_menu','DESC');
				$data = array('record' => $proses);
				$this->template->load('administrator/template','administrator/mod_menu/view_menu_tambah',$data);
			}
		}
		
		function edit_menuwebsite(){
			cek_menu_akses('menuwebsite',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('id_parent'=>$this->db->escape_str($this->input->post('b')),
				'nama_menu'=>$this->db->escape_str($this->input->post('c')),
				'link'=>$this->db->escape_str($this->input->post('a')),
				'position'=>$this->db->escape_str($this->input->post('d')),
				'urutan'=>$this->db->escape_str($this->input->post('e')),
				'deskripsi'=>$this->db->escape_str($this->input->post('g')),
				'aktif'=>$this->db->escape_str($this->input->post('f')));
				$where = array('id_menu' => $this->input->post('id'));
				$this->model_app->update('menu', $data, $where);
				redirect('administrator/menuwebsite');
				}else{
				$menu_utama = $this->model_app->view_where_ordering('menu', array('position' => 'Bottom'), 'id_menu','DESC');
				$proses = $this->model_app->edit('menu', array('id_menu' => $id))->row_array();
				$data = array('rows' => $proses, 'record' => $menu_utama);
				$this->template->load('administrator/template','administrator/mod_menu/view_menu_edit',$data);
			}
		}
		
		function delete_menuwebsite(){
			cek_menu_akses('menuwebsite',$this->session->id_session);
			$id = array('id_menu' => $this->uri->segment(3));
			$this->model_app->delete('menu',$id);
			redirect('administrator/menuwebsite');
		}
		
		
		// Controller Modul Halaman Baru
		
		function halamanbaru(){
			cek_menu_akses('halamanbaru',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('halamanstatis','id_halaman','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('halamanstatis',array('username'=>$this->session->username),'id_halaman','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_halaman/view_halaman',$data);
		}
		
		function tambah_halamanbaru(){
			cek_menu_akses('halamanbaru',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_statis/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'judul_seo'=>seo_title($this->input->post('a')),
					'isi_halaman'=>$this->input->post('b'),
					'tgl_posting'=>date('Y-m-d'),
					'username'=>$this->session->username,
					'dibaca'=>'0',
					'jam'=>date('H:i:s'),
					'hari'=>hari_ini(date('w')));
					}else{
            		$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'judul_seo'=>seo_title($this->input->post('a')),
					'isi_halaman'=>$this->input->post('b'),
					'tgl_posting'=>date('Y-m-d'),
					'gambar'=>$hasil['file_name'],
					'username'=>$this->session->username,
					'dibaca'=>'0',
					'jam'=>date('H:i:s'),
					'hari'=>hari_ini(date('w')));
				}
				$this->model_app->insert('halamanstatis',$data);
				redirect('administrator/halamanbaru');
				}else{
				$this->template->load('administrator/template','administrator/mod_halaman/view_halaman_tambah');
			}
		}
		
		function edit_halamanbaru(){
			cek_menu_akses('halamanbaru',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_statis/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'judul_seo'=>seo_title($this->input->post('a')),
					'isi_halaman'=>$this->input->post('b'));
					}else{
            		$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'judul_seo'=>seo_title($this->input->post('a')),
					'isi_halaman'=>$this->input->post('b'),
					'gambar'=>$hasil['file_name']);
				}
				$where = array('id_halaman' => $this->input->post('id'));
				$this->model_app->update('halamanstatis', $data, $where);
				redirect('administrator/halamanbaru');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('halamanstatis', array('id_halaman' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('halamanstatis', array('id_halaman' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_halaman/view_halaman_edit',$data);
			}
		}
		
		function delete_halamanbaru(){
			// cek_menu_akses('halamanbaru',$this->session->id_session);
			cek_menu_akses('halamanbaru',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_halaman' => $this->uri->segment(3));
				}else{
				$id = array('id_halaman' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('halamanstatis',$id);
			redirect('administrator/halamanbaru');
		}
		
		// Controller Modul List Berita
		
		function listberita(){
			cek_menu_akses('listberita',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('berita','id_berita','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('berita',array('username'=>$this->session->username),'id_berita','DESC');
			}
			$data['rss'] = $this->model_utama->view_joinn('berita','users','kategori','username','id_kategori','id_berita','DESC',0,10);
			$data['iden'] = $this->model_utama->view_where('identitas',array('id_identitas' => 1))->row_array();
			$this->load->view('administrator/rss',$data);
			$this->template->load('administrator/template','administrator/mod_berita/view_berita',$data);
		}
		
		function tambah_listberita(){ 
			cek_menu_akses('listberita',$this->session->id_session);
			if (isset($_POST['submit'])){
				$cek_judul=$this->model_app->view_where('berita', array('judul' => $this->db->escape_str($this->input->post('b'))));
				$this->session->set_userdata('judul',$this->db->escape_str($this->input->post('b')));   
				$this->session->set_userdata('isi',$this->db->escape_str($this->input->post('h')));   
				if($cek_judul->num_rows()>0){
					redirect('administrator/tambah_listberita');
					}else{
					// $config['image_library'] = 'gd2';
					$config['upload_path'] = 'asset/foto_berita/';
					$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
					$config['max_size'] = '3000'; // kb
					$this->load->library('upload', $config);
					$this->upload->do_upload('k');
					$hasil=$this->upload->data();
					
					$config['source_image'] = 'asset/foto_berita/'.$hasil['file_name'];
					// $config['wm_text'] = '';
					// $config['wm_type'] = 'text';
					// $config['wm_font_path'] = './system/fonts/texb.ttf';
					// $config['wm_font_size'] = '18';
					// $config['wm_font_color'] = 'ffffff';
					// $config['wm_vrt_alignment'] = 'middle';
					// $config['wm_hor_alignment'] = 'center';
					// $config['wm_padding'] = '20';
					// $this->load->library('image_lib',$config);
					// $this->image_lib->watermark();
					
					if ($this->session->level == 'kontributor'){ $status = 'N'; }else{ $status = 'Y'; }
					if ($this->input->post('j')!=''){
						$tag_seo = $this->input->post('j');
						$tag=implode(',',$tag_seo);
						}else{
						$tag = '';
					}
					if ($hasil['file_name']==''){
						$data = array('id_kategori'=>$this->db->escape_str($this->input->post('a')),
						'username'=>$this->session->username,
						'judul'=>$this->db->escape_str($this->input->post('b')),
						'sub_judul'=>$this->db->escape_str($this->input->post('c')),
						'youtube'=>$this->db->escape_str($this->input->post('d')),
						'judul_seo'=>seo_title($this->input->post('b')),
						'headline'=>$this->db->escape_str($this->input->post('e')),
						'aktif'=>$this->db->escape_str($this->input->post('f')),
						'utama'=>$this->db->escape_str($this->input->post('g')),
						'isi_berita'=>$this->input->post('h'),
						'keterangan_gambar'=>$this->input->post('i'),
						'hari'=>xhari($this->input->post('k')),
						'tanggal'=>$this->input->post('k'),
						'jam'=>xjam($this->input->post('k')),
						'dibaca'=>'0',
						'tag'=>$tag,
						'status'=>$status);
						}else{
						$data = array('id_kategori'=>$this->db->escape_str($this->input->post('a')),
						'username'=>$this->session->username,
						'judul'=>$this->db->escape_str($this->input->post('b')),
						'sub_judul'=>$this->db->escape_str($this->input->post('c')),
						'youtube'=>$this->db->escape_str($this->input->post('d')),
						'judul_seo'=>seo_title($this->input->post('b')),
						'headline'=>$this->db->escape_str($this->input->post('e')),
						'aktif'=>$this->db->escape_str($this->input->post('f')),
						'utama'=>$this->db->escape_str($this->input->post('g')),
						'isi_berita'=>$this->input->post('h'),
						'keterangan_gambar'=>$this->input->post('i'),
						'hari'=>xhari($this->input->post('k')),
						'tanggal'=>$this->input->post('k'),
						'jam'=>xjam($this->input->post('k')),
						'gambar'=>$hasil['file_name'],
						'dibaca'=>'0',
						'tag'=>$tag,
						'status'=>$status);
					}
					$this->session->unset_userdata('judul');
					$this->session->unset_userdata('isi');
					$this->model_app->insert('berita',$data);
					redirect('administrator/listberita');
				}
				}else{
				$data['tag'] = $this->model_app->view_ordering('tag','id_tag','DESC');
				$data['record'] = $this->model_app->view_ordering('kategori','id_kategori','DESC');
				$this->template->load('administrator/template','administrator/mod_berita/view_berita_tambah',$data);
			}
		}
		
		function edit_listberita(){
			cek_menu_akses('listberita',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_berita/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('k');
				$hasil=$this->upload->data();
				// $config['image_library'] = 'gd2';
				$config['source_image'] = 'asset/foto_berita/'.$hasil['file_name'];
				// $config['wm_text'] = '';
				// $config['wm_type'] = 'text';
				// $config['wm_font_path'] = './system/fonts/texb.ttf';
				// $config['wm_font_size'] = '18';
				// $config['wm_font_color'] = 'ffffff';
				// $config['wm_vrt_alignment'] = 'middle';
				// $config['wm_hor_alignment'] = 'center';
				// $config['wm_padding'] = '20';
				// $this->load->library('image_lib',$config);
				// $this->image_lib->initialize($config);
				// if (!$this->image_lib->watermark()) {
				// $this->handle_error($this->image_lib->display_errors());
				// }
				
				if ($this->session->level == 'kontributor'){ $status = 'N'; }else{ $status = 'Y'; }
				if ($this->input->post('j')!=''){
					$tag_seo = $this->input->post('j');
					$tag=implode(',',$tag_seo);
					}else{
					$tag = '';
				}
				if ($hasil['file_name']==''){
                    $data = array('id_kategori'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'judul'=>$this->db->escape_str($this->input->post('b')),
					'sub_judul'=>$this->db->escape_str($this->input->post('c')),
					'youtube'=>$this->db->escape_str($this->input->post('d')),
					'judul_seo'=>seo_title($this->input->post('b')),
					'headline'=>$this->db->escape_str($this->input->post('e')),
					'aktif'=>$this->db->escape_str($this->input->post('f')),
					'utama'=>$this->db->escape_str($this->input->post('g')),
					'isi_berita'=>$this->input->post('h'),
					'keterangan_gambar'=>$this->input->post('i'),
					'hari'=>xhari($this->input->post('k')),
					'tanggal'=>$this->input->post('k'),
					'jam'=>xjam($this->input->post('k')),
					'dibaca'=>'0',
					'tag'=>$tag,
					'status'=>$status);
					}else{
                    $data = array('id_kategori'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'judul'=>$this->db->escape_str($this->input->post('b')),
					'sub_judul'=>$this->db->escape_str($this->input->post('c')),
					'youtube'=>$this->db->escape_str($this->input->post('d')),
					'judul_seo'=>seo_title($this->input->post('b')),
					'headline'=>$this->db->escape_str($this->input->post('e')),
					'aktif'=>$this->db->escape_str($this->input->post('f')),
					'utama'=>$this->db->escape_str($this->input->post('g')),
					'isi_berita'=>$this->input->post('h'),
					'keterangan_gambar'=>$this->input->post('i'),
					'hari'=>xhari($this->input->post('k')),
					'tanggal'=>$this->input->post('k'),
					'jam'=>xjam($this->input->post('k')),
					'gambar'=>$hasil['file_name'],
					'dibaca'=>'0',
					'tag'=>$tag,
					'status'=>$status);
				}
				$where = array('id_berita' => $this->input->post('id'));
				$this->model_app->update('berita', $data, $where);
				redirect('administrator/listberita');
				}else{
				$tag = $this->model_app->view_ordering('tag','id_tag','DESC');
				$record = $this->model_app->view_ordering('kategori','id_kategori','DESC');
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('berita', array('id_berita' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('berita', array('id_berita' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses,'tag' => $tag,'record' => $record);
				$this->template->load('administrator/template','administrator/mod_berita/view_berita_edit',$data);
			}
		}
		
		function publish_listberita(){
			cek_session_admin();
			if ($this->uri->segment(4)=='Y'){
				$data = array('status'=>'N');
				}else{
				$data = array('status'=>'Y');
			}
			$where = array('id_berita' => $this->uri->segment(3));
			$this->model_app->update('berita', $data, $where);
			redirect('administrator/listberita');
		}
		
		function delete_listberita(){
			cek_menu_akses('listberita',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_berita' => $this->uri->segment(3));
				}else{
				$id = array('id_berita' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('berita',$id);
			redirect('administrator/listberita');
		}
		
		
		// Controller Modul Kategori Berita
		
		function kategoriberita(){
			cek_menu_akses('kategoriberita',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('kategori','id_kategori','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('kategori',array('username'=>$this->session->username),'id_kategori','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_kategori/view_kategori',$data);
		}
		
		function tambah_kategoriberita(){
			cek_menu_akses('kategoriberita',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('nama_kategori'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'kategori_seo'=>seo_title($this->input->post('a')),
				'aktif'=>$this->db->escape_str($this->input->post('b')),
				'sidebar'=>$this->db->escape_str($this->input->post('c')));
				$this->model_app->insert('kategori',$data);
				redirect('administrator/kategoriberita');
				}else{
				$this->template->load('administrator/template','administrator/mod_kategori/view_kategori_tambah');
			}
		}
		
		function edit_kategoriberita(){
			cek_menu_akses('kategoriberita',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('nama_kategori'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'kategori_seo'=>seo_title($this->input->post('a')),
				'aktif'=>$this->db->escape_str($this->input->post('b')),
				'sidebar'=>$this->db->escape_str($this->input->post('c')));
				$where = array('id_kategori' => $this->input->post('id'));
				$this->model_app->update('kategori', $data, $where);
				redirect('administrator/kategoriberita');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('kategori', array('id_kategori' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('kategori', array('id_kategori' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_kategori/view_kategori_edit',$data);
			}
		}
		
		function delete_kategoriberita(){
			cek_menu_akses('kategoriberita',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_kategori' => $this->uri->segment(3));
				}else{
				$id = array('id_kategori' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('kategori',$id);
			redirect('administrator/kategoriberita');
		}
		
		
		// Controller Modul Tag Berita
		
		function tagberita(){
			cek_menu_akses('tagberita',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('tag','id_tag','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('tag',array('username'=>$this->session->username),'id_tag','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_tag/view_tag',$data);
		}
		
		function tambah_tagberita(){
			cek_menu_akses('tagberita',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'tag_seo'=>seo_title($this->input->post('a')),
				'count'=>'0');
				$this->model_app->insert('tag',$data);	
				redirect('administrator/tagberita');
				}else{
				$this->template->load('administrator/template','administrator/mod_tag/view_tag_tambah');
			}
		}
		
		function edit_tagberita(){
			cek_menu_akses('tagberita',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'tag_seo'=>seo_title($this->input->post('a')));
				$where = array('id_tag' => $this->input->post('id'));
				$this->model_app->update('tag', $data, $where);
				redirect('administrator/tagberita');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('tag', array('id_tag' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('tag', array('id_tag' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_tag/view_tag_edit',$data);
			}
		}
		
		function delete_tagberita(){
			cek_menu_akses('tagberita',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_tag' => $this->uri->segment(3));
				}else{
				$id = array('id_tag' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('tag',$id);
			redirect('administrator/tagberita');
		}
		
		
		// Controller Modul Komentar Berita
		
		function komentarberita(){
			cek_menu_akses('komentarberita',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('komentar','id_komentar','DESC');
			$this->template->load('administrator/template','administrator/mod_komentar/view_komentar',$data);
		}
		
		function edit_komentarberita(){
			cek_menu_akses('komentarberita',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('nama_komentar'=>$this->input->post('a'),
				'url'=>$this->input->post('b'),
				'isi_komentar'=>$this->input->post('c'),
				'aktif'=>$this->input->post('d'),
				'email'=>$this->input->post('e'));
				$where = array('id_komentar' => $this->input->post('id'));
				$this->model_app->update('komentar', $data, $where);
				redirect('administrator/komentarberita');
				}else{
				$proses = $this->model_app->edit('komentar', array('id_komentar' => $id))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_komentar/view_komentar_edit',$data);
			}
		}
		
		function delete_komentarberita(){
			cek_menu_akses('komentarberita',$this->session->id_session);
			$id = array('id_komentar' => $this->uri->segment(3));
			$this->model_app->delete('komentar',$id);
			redirect('administrator/komentarberita');
		}
		
		
		// Controller Modul Sensor Komentar Berita
		
		function sensorkomentar(){
			cek_menu_akses('sensorkomentar',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('katajelek','id_jelek','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('katajelek',array('username'=>$this->session->username),'id_jelek','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_sensorkomentar/view_sensorkomentar',$data);
		}
		
		function tambah_sensorkomentar(){
			cek_menu_akses('sensorkomentar',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('kata'=>$this->input->post('a'),
				'username'=>$this->session->username,
				'ganti'=>$this->input->post('b'));
				$this->model_app->insert('katajelek',$data);	
				redirect('administrator/sensorkomentar');
				}else{
				$this->template->load('administrator/template','administrator/mod_sensorkomentar/view_sensorkomentar_tambah');
			}
		}
		
		function edit_sensorkomentar(){
			cek_menu_akses('sensorkomentar',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$this->model_berita->tag_berita_update();
				$data = array('kata'=>$this->input->post('a'),
				'username'=>$this->session->username,
				'ganti'=>$this->input->post('b'));
				$where = array('id_jelek' => $this->input->post('id'));
				$this->model_app->update('katajelek', $data, $where);
				redirect('administrator/sensorkomentar');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('katajelek', array('id_jelek' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('katajelek', array('id_jelek' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_sensorkomentar/view_sensorkomentar_edit',$data);
			}
		}
		
		function delete_sensorkomentar(){
			cek_menu_akses('sensorkomentar',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_jelek' => $this->uri->segment(3));
				}else{
				$id = array('id_jelek' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('katajelek',$id);
			redirect('administrator/sensorkomentar');
		}
		
		
		// Controller Modul Album
		
		function album(){
			cek_menu_akses('album',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('album','id_album','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('album',array('username'=>$this->session->username),'id_album','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_album/view_album',$data);
		}
		function save_album(){
			// cek_menu_akses('album',$this->session->id_session);
			$config['upload_path'] = './asset/img_album/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('filea');
            $hasil=$this->upload->data();
			if ($hasil['file_name']==''){
                $data = array('jdl_album'=>$this->input->post('judul'),
				'album_seo'=>seo_title($this->input->post('judul')),
				'keterangan'=>$this->input->post('ket'),
				'aktif'=>'Y',
				'hits_album'=>'0',
				'tgl_posting'=>date('Y-m-d'),
				'jam'=>date('H:i:s'),
				'hari'=>hari_ini(date('w')),
				'username'=>$this->session->username);
				// $str = $this->db->last_query();
				// $arr = array('ok'=>'ok','id'=>$str,'judul'=>$this->input->post('judul'));
				}else{
				$data = array('jdl_album'=>$this->input->post('judul'),
				'album_seo'=>seo_title($this->input->post('judul')),
				'keterangan'=>$this->input->post('ket'),
				'gbr_album'=>$hasil['file_name'],
				'aktif'=>'Y',
				'hits_album'=>'0',
				'tgl_posting'=>date('Y-m-d'),
				'jam'=>date('H:i:s'),
				'hari'=>hari_ini(date('w')),
				'username'=>$this->session->username);
				// $str = $this->db->last_query();
			}
			$result = $this->model_app->insert('album',$data);
			$insert_id = $this->db->insert_id();
			$arr = array('ok'=>'ok','id'=>$insert_id,'text'=>$this->input->post('judul'));
			
			echo json_encode($arr);
		}
		
		function update_album(){
			cek_menu_akses('album',$this->session->id_session);
			$id = $this->input->post('id');
			if($id>0){
				$config['upload_path'] = './asset/img_album/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('fileb');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('jdl_album'=>$this->input->post('judulb'),
					'album_seo'=>seo_title($this->input->post('judulb')),
					'keterangan'=>$this->input->post('ketb'),
					'aktif'=>$this->input->post('d'));
					}else{
					$search=$this->model_app->view_where('album', $id);
					if($search->num_rows()>0){
						$data=$search->row();
						$gambar="asset/img_album/".$data->gbr_album;
						unlink($gambar);
					}
					$data = array('jdl_album'=>$this->input->post('judulb'),
					'album_seo'=>seo_title($this->input->post('judulb')),
					'keterangan'=>$this->input->post('ketb'),
					'gbr_album'=>$hasil['file_name'],
					'aktif'=>$this->input->post('d'));
				}
				$where = array('id_album' => $this->input->post('id'));
				$this->model_app->update('album', $data, $where);
				}else{
				$arr = array('error'=>'error');
			}
			echo json_encode($arr);
		}
		function tambah_album(){
			cek_menu_akses('album',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/img_album/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('jdl_album'=>$this->input->post('a'),
					'album_seo'=>seo_title($this->input->post('a')),
					'keterangan'=>$this->input->post('b'),
					'aktif'=>'Y',
					'hits_album'=>'0',
					'tgl_posting'=>date('Y-m-d'),
					'jam'=>date('H:i:s'),
					'hari'=>hari_ini(date('w')),
					'username'=>$this->session->username);
					}else{
					$data = array('jdl_album'=>$this->input->post('a'),
					'album_seo'=>seo_title($this->input->post('a')),
					'keterangan'=>$this->input->post('b'),
					'gbr_album'=>$hasil['file_name'],
					'aktif'=>'Y',
					'hits_album'=>'0',
					'tgl_posting'=>date('Y-m-d'),
					'jam'=>date('H:i:s'),
					'hari'=>hari_ini(date('w')),
					'username'=>$this->session->username);
				}
				
				$this->model_app->insert('album',$data);  
				redirect('administrator/album');
				}else{
				$this->template->load('administrator/template','administrator/mod_album/view_album_tambah');
			}
		}
		
		function edit_album(){
			cek_menu_akses('album',$this->session->id_session);
			$id = $this->input->post('id');
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/img_album/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('jdl_album'=>$this->input->post('a'),
					'album_seo'=>seo_title($this->input->post('a')),
					'keterangan'=>$this->input->post('b'),
					'aktif'=>$this->input->post('d'));
					}else{
					$data = array('jdl_album'=>$this->input->post('a'),
					'album_seo'=>seo_title($this->input->post('a')),
					'keterangan'=>$this->input->post('b'),
					'gbr_album'=>$hasil['file_name'],
					'aktif'=>$this->input->post('d'));
				}
				$where = array('id_album' => $this->input->post('id'));
				$this->model_app->update('album', $data, $where);
				redirect('administrator/album');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('album', array('id_album' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('album', array('id_album' => $id, 'username' => $this->session->username))->row_array();
				}
				// $data['type'] = $this->input->post('type');
				$data = array('rows' => $proses);
				// $this->template->load('administrator/template','administrator/mod_album/view_album_edit',$data);
				$this->load->view('administrator/mod_gallery/view_gallery_modal', $data, false);
			}
		}
		
		// function delete_album(){
        // cek_menu_akses('album',$this->session->id_session);
        // if ($this->session->level=='admin'){
		// $id = array('id_album' => $this->uri->segment(3));
        // }else{
		// $id = array('id_album' => $this->uri->segment(3), 'username'=>$this->session->username);
        // }
        // $this->model_app->delete('album',$id);
        // redirect('administrator/album');
		// }
		function delete_album(){
			// cek_session_akses('album',$this->session->id_session);
			cek_menu_akses('album',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_album' => $this->uri->segment(3));
				}else{
				$id = array('id_album' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$search=$this->model_app->view_where('album', $id);
			if($search->num_rows()>0){
				$data=$search->row();
				$gambar="asset/img_album/".$data->gbr_album;
				unlink($gambar);
			}
			$this->model_app->delete('album',$id);
			redirect('administrator/album');
		}
		function delete_album_ajax(){
			// cek_menu_akses('album',$this->session->id_session);
			// cek_session_akses('album',$this->session->id_session);
			$album_code=$this->input->post('album_code');
			// $this->db->where('product_code', $product_code);
			if ($this->session->level=='admin'){
				$id = array('id_album' => $album_code);
				}else{
				$id = array('id_album' => $album_code, 'username'=>$this->session->username);
			}
			$search=$this->model_app->view_where('album', $id);
			if($search->num_rows()>0){
				$data=$search->row();
				$gambar="asset/img_album/".$data->gbr_album;
				unlink($gambar);
			}
			$data= $this->model_app->delete('album',$id);
			echo json_encode($data);
		}
		
		// Controller Modul Gallery
		
		function gallery(){
			cek_menu_akses('gallery',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_join_one('gallery','album','id_album','id_gallery','DESC');
				}else{
				$data['record'] = $this->model_app->view_join_where('gallery','album','id_album',array('gallery.username'=>$this->session->username),'id_gallery','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_gallery/view_gallery',$data);
		}
		
		// function tambah_gallery(){
        // cek_menu_akses('gallery',$this->session->id_session);
        // if (isset($_POST['submit'])){
		// $config['upload_path'] = 'asset/img_galeri/';
		// $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
		// $config['max_size'] = '3000'; // kb
		// $this->load->library('upload', $config);
		// $this->upload->do_upload('d');
		// $hasil=$this->upload->data();
		// if ($hasil['file_name']==''){
		// $data = array('id_album'=>$this->input->post('a'),
		// 'username'=>$this->session->username,
		// 'jdl_gallery'=>$this->input->post('b'),
		// 'gallery_seo'=>seo_title($this->input->post('b')),
		// 'keterangan'=>$this->input->post('c'));
		// }else{
		// $data = array('id_album'=>$this->input->post('a'),
		// 'username'=>$this->session->username,
		// 'jdl_gallery'=>$this->input->post('b'),
		// 'gallery_seo'=>seo_title($this->input->post('b')),
		// 'keterangan'=>$this->input->post('c'),
		// 'gbr_gallery'=>$hasil['file_name']);
		// }
		// $this->model_app->insert('gallery',$data);  
		// redirect('administrator/gallery');
        // }else{
		// $data['record'] = $this->model_app->view_ordering('album','id_album','DESC');
		// $this->template->load('administrator/template','administrator/mod_gallery/view_gallery_tambah',$data);
        // }
		// }
		function autocompleteData() {
			$returnData = array();
			
			$conditions['searchTerm'] = $this->input->get('term');
			$conditions['conditions']['aktif'] = 'Y';
			$skillData = $this->model_app->getRows($conditions);
			
			if(!empty($skillData)){
				foreach ($skillData as $row){
					// $data[] = array("id"=>$row['id'], "text"=>$row['name']);
					$data['id'] = $row['id_album'];
					$data['text'] = $row['jdl_album'];
					array_push($returnData, $data);
				}
				}else{
				$data['id'] = 0;
				$data['text'] = "Data tidak ada";
				array_push($returnData, $data);
			}
			
			echo json_encode($returnData);die;
		}
		function multipleImageStore(){
			cek_menu_akses('gallery',$this->session->id_session);
			$countfiles = count($_FILES['files']['name']);
			
			for($i=0;$i<$countfiles;$i++){
				
				if(!empty($_FILES['files']['name'][$i])){
					
					// Define new $_FILES array - $_FILES['file']
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];
					
					// Set preference
					$config['upload_path'] = 'asset/img_galeri/'; 
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = '10000'; // max_size in kb
					$config['file_name'] = $_FILES['files']['name'][$i];
					
					//Load upload library
					$this->load->library('upload',$config); 
					$this->upload->initialize($config);
					// $arr = array('msg' => 'Tanpa foto', 'success' => false);
					// File upload
					if($this->upload->do_upload('file')){
						$fileData = $this->upload->data();
						$uploadData[$i]['id_album'] = $this->input->post('a');
						$uploadData[$i]['username'] = $this->session->username;
						$uploadData[$i]['jdl_gallery'] = $this->input->post('b');
						$uploadData[$i]['gallery_seo'] = seo_title($this->input->post('b'));
						$uploadData[$i]['gbr_gallery'] = $fileData['file_name'];
					}
				}
				
			}
            if(!empty($uploadData)){
				$insert = $this->model_app->insertgbr($uploadData);
				$arr = array('msg' => 'Foto berhasil di tambahkan', 'success' => true);
			}
			echo json_encode($arr);
			
		}
		function tambah_gallery(){
			// cek_session_akses('gallery',$this->session->id_session);
			cek_menu_akses('gallery',$this->session->id_session);
            $data['record'] = $this->model_app->view_ordering('album','id_album','DESC');
            $this->template->load('administrator/template','administrator/mod_gallery/view_gallery_tambah',$data);
			
		}
		function edit_gallery(){
			cek_menu_akses('gallery',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/img_galeri/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('d');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('id_album'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'jdl_gallery'=>$this->input->post('b'),
					'gallery_seo'=>seo_title($this->input->post('b')));
					}else{
					$data = array('id_album'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'jdl_gallery'=>$this->input->post('b'),
					'gallery_seo'=>seo_title($this->input->post('b')),
					'gbr_gallery'=>$hasil['file_name']);
				}
				$where = array('id_gallery' => $this->input->post('id'));
				$this->model_app->update('gallery', $data, $where);
				redirect('administrator/gallery');
				}else{
				$record = $this->model_app->view_ordering('album','id_album','DESC');
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('gallery', array('id_gallery' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('gallery', array('id_gallery' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses,'record' => $record);
				$this->template->load('administrator/template','administrator/mod_gallery/view_gallery_edit',$data);
				// $this->load->view(template().'/administrator/mod_gallery/view_gallery_edit', $data, false);
			}
		}
		
		function delete_gallery(){
			cek_menu_akses('gallery',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_gallery' => $this->uri->segment(3));
				}else{
				$id = array('id_gallery' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$search=$this->model_app->view_where('gallery', $id);
			if($search->num_rows()>0){
				$data=$search->row();
				$gambar="asset/img_galeri/".$data->gbr_album;
				unlink($gambar);
			}
			$this->model_app->delete('gallery',$id);
			redirect('administrator/gallery');
		}
		
		
		// Controller Modul Video
		
		function video(){
			cek_menu_akses('video',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_join_one('video','playlist','id_playlist','id_video','DESC');
				}else{
				$data['record'] = $this->model_app->view_join_where('video','playlist','id_playlist',array('video.username'=>$this->session->username),'id_video','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_video/view_video',$data);
		}
		
		function tambah_video(){
			cek_menu_akses('video',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/img_video/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('d');
				$hasil=$this->upload->data();
				
				if ($this->input->post('f')!=''){
					$tag_seo = $this->input->post('f');
					$tag=implode(',',$tag_seo);
					}else{
					$tag = '';
				}
				
				if ($hasil['file_name']==''){
					$data = array('id_playlist'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'jdl_video'=>$this->input->post('b'),
					'video_seo'=>seo_title($this->input->post('b')),
					'keterangan'=>$this->input->post('c'),
					'video'=>'',
					'utama'=>$this->input->post('g'),
					'youtube'=>$this->input->post('e'),
					'dilihat'=>'0',
					'hari'=>hari_ini(date('w')),
					'tanggal'=>date('Y-m-d'),
					'jam'=>date('H:i:s'),
					'tagvid'=>$tag);
					}else{
					$data = array('id_playlist'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'jdl_video'=>$this->input->post('b'),
					'video_seo'=>seo_title($this->input->post('b')),
					'keterangan'=>$this->input->post('c'),
					'gbr_video'=>$hasil['file_name'],
					'video'=>'',
					'utama'=>$this->input->post('g'),
					'youtube'=>$this->input->post('e'),
					'dilihat'=>'0',
					'hari'=>hari_ini(date('w')),
					'tanggal'=>date('Y-m-d'),
					'jam'=>date('H:i:s'),
					'tagvid'=>$tag);
				}
				$this->model_app->insert('video',$data);  
				redirect('administrator/video');
				}else{
				$data['record'] = $this->model_app->view_ordering('playlist','id_playlist','DESC');
				$data['tag'] = $this->model_app->view_ordering('tagvid','id_tag','DESC');
				$this->template->load('administrator/template','administrator/mod_video/view_video_tambah',$data);
			}
		}
		
		function edit_video(){
			cek_menu_akses('video',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/img_video/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('d');
				$hasil=$this->upload->data();
				
				if ($this->input->post('f')!=''){
					$tag_seo = $this->input->post('f');
					$tag=implode(',',$tag_seo);
					}else{
					$tag = '';
				}
				
				if ($hasil['file_name']==''){
					$data = array('id_playlist'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'jdl_video'=>$this->input->post('b'),
					'video_seo'=>seo_title($this->input->post('b')),
					'keterangan'=>$this->input->post('c'),
					'video'=>'',
					'utama'=>$this->input->post('g'),
					'youtube'=>$this->input->post('e'),
					'tagvid'=>$tag);
					}else{
					$data = array('id_playlist'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'jdl_video'=>$this->input->post('b'),
					'video_seo'=>seo_title($this->input->post('b')),
					'keterangan'=>$this->input->post('c'),
					'gbr_video'=>$hasil['file_name'],
					'video'=>'',
					'utama'=>$this->input->post('g'),
					'youtube'=>$this->input->post('e'),
					'tagvid'=>$tag);
				}
				
				$where = array('id_video' => $this->input->post('id'));
				$this->model_app->update('video', $data, $where);
				redirect('administrator/video');
				}else{
				$record = $this->model_app->view_ordering('playlist','id_playlist','DESC');
				$tag = $this->model_app->view_ordering('tagvid','id_tag','DESC');
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('video', array('id_video' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('video', array('id_video' => $id, 'username' => $this->session->username))->row_array();
				}
				
				$data = array('rows' => $proses,'record' => $record, 'tag' => $tag);
				$this->template->load('administrator/template','administrator/mod_video/view_video_edit',$data);
			}
		}
		
		function delete_video(){
			cek_menu_akses('video',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_video' => $this->uri->segment(3));
				}else{
				$id = array('id_video' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('video',$id);
			redirect('administrator/video');
		}
		
		
		// Controller Modul Playlist
		
		function playlist(){
			cek_menu_akses('playlist',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('playlist','id_playlist','DESC');
			$this->template->load('administrator/template','administrator/mod_playlist/view_playlist',$data);
		}
		
		function tambah_playlist(){
			cek_menu_akses('playlist',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/img_playlist/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('b');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('jdl_playlist'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'playlist_seo'=>seo_title($this->input->post('a')),
					'aktif'=>'Y');
					}else{
					$data = array('jdl_playlist'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'playlist_seo'=>seo_title($this->input->post('a')),
					'gbr_playlist'=>$hasil['file_name'],
					'aktif'=>'Y');
				}
				$this->model_app->insert('playlist',$data);  
				redirect('administrator/playlist');
				}else{
				$this->template->load('administrator/template','administrator/mod_playlist/view_playlist_tambah');
			}
		}
		
		function edit_playlist(){
			cek_menu_akses('playlist',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/img_playlist/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('b');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('jdl_playlist'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'playlist_seo'=>seo_title($this->input->post('a')),
					'aktif'=>$this->input->post('c'));
					}else{
					$data = array('jdl_playlist'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'playlist_seo'=>seo_title($this->input->post('a')),
					'gbr_playlist'=>$hasil['file_name'],
					'aktif'=>$this->input->post('c'));
				}
				$where = array('id_playlist' => $this->input->post('id'));
				$this->model_app->update('playlist', $data, $where);
				redirect('administrator/playlist');
				}else{
				$proses = $this->model_app->edit('playlist', array('id_playlist' => $id))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_playlist/view_playlist_edit',$data);
			}
		}
		
		function delete_playlist(){
			cek_menu_akses('playlist',$this->session->id_session);
			$id = array('id_playlist' => $this->uri->segment(3));
			$this->model_app->delete('playlist',$id);
			redirect('administrator/playlist');
		}
		
		
		// Controller Modul Tag Video
		
		function tagvideo(){
			cek_menu_akses('tagvideo',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('tagvid','id_tag','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('tagvid',array('username'=>$this->session->username),'id_tag','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_tagvideo/view_tag',$data);
		}
		
		function tambah_tagvideo(){
			cek_menu_akses('tagvideo',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'tag_seo'=>seo_title($this->input->post('a')),
				'count'=>'0');
				$this->model_app->insert('tagvid',$data);  
				redirect('administrator/tagvideo');
				}else{
				$this->template->load('administrator/template','administrator/mod_tagvideo/view_tag_tambah');
			}
		}
		
		function edit_tagvideo(){
			cek_menu_akses('tagvideo',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'tag_seo'=>seo_title($this->input->post('a')));
				$where = array('id_tag' => $this->input->post('id'));
				$this->model_app->update('tagvid', $data, $where);
				redirect('administrator/tagvideo');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('tagvid', array('id_tag' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('tagvid', array('id_tag' => $id, 'username' => $this->session->username))->row_array();
				}
				
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_tagvideo/view_tag_edit',$data);
			}
		}
		
		function delete_tagvideo(){
			cek_menu_akses('tagvideo',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_tag' => $this->uri->segment(3));
				}else{
				$id = array('id_tag' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('tagvid',$id);
			redirect('administrator/tagvideo');
		}
		
		
		// Controller Modul Komentar Video
		
		function komentarvideo(){
			cek_menu_akses('komentarvideo',$this->session->id_session);
			$data['record'] = $this->model_app->view_join_one('komentarvid','video','id_video','id_komentar','DESC');
			$this->template->load('administrator/template','administrator/mod_komentarvideo/view_komentar',$data);
		}
		
		function edit_komentarvideo(){
			cek_menu_akses('komentarvideo',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('nama_komentar'=>$this->input->post('a'),
				'url'=>$this->input->post('b'),
				'isi_komentar'=>$this->input->post('c'),
				'aktif'=>$this->input->post('d'));
				$where = array('id_komentar' => $this->input->post('id'));
				$this->model_app->update('komentarvid', $data, $where);
				redirect('administrator/komentarvideo');
				}else{
				$proses = $this->model_app->edit('komentarvid', array('id_komentar' => $id))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_komentarvideo/view_komentar_edit',$data);
			}
		}
		
		function delete_komentarvideo(){
			cek_menu_akses('komentarvideo',$this->session->id_session);
			$id = array('id_komentar' => $this->uri->segment(3));
			$this->model_app->delete('komentarvid',$id);
			redirect('administrator/komentarvideo');
		}
		
		// Controller Modul Iklan Atas
		
		function iklanatas(){
			cek_menu_akses('iklanatas',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('iklanatas','id_iklanatas','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('iklanatas',array('username'=>$this->session->username),'id_iklanatas','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_iklanatas/view_iklanatas',$data);
		}
		
		function tambah_iklanatas(){
			cek_menu_akses('iklanatas',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_iklanatas/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'url'=>$this->input->post('b'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'url'=>$this->input->post('b'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$this->model_app->insert('iklanatas',$data);  
				redirect('administrator/iklanatas');
				}else{
				$this->template->load('administrator/template','administrator/mod_iklanatas/view_iklanatas_tambah');
			}
		}
		
		function edit_iklanatas(){
			cek_menu_akses('iklanatas',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_iklanatas/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'url'=>$this->input->post('b'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'url'=>$this->input->post('b'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$where = array('id_iklanatas' => $this->input->post('id'));
				$this->model_app->update('iklanatas', $data, $where);
				redirect('administrator/iklanatas');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('iklanatas', array('id_iklanatas' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('iklanatas', array('id_iklanatas' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_iklanatas/view_iklanatas_edit',$data);
			}
		}
		
		function delete_iklanatas(){
			cek_menu_akses('iklanatas',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_iklanatas' => $this->uri->segment(3));
				}else{
				$id = array('id_iklanatas' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('iklanatas',$id);
			redirect('administrator/iklanatas');
		}
		
		
		// Controller Modul Iklan Home
		
		function iklanhome(){
			cek_menu_akses('iklanhome',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('iklantengah','id_iklantengah','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('iklantengah',array('username'=>$this->session->username),'id_iklantengah','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_iklanhome/view_iklanhome',$data);
		}
		
		function tambah_iklanhome(){
			cek_menu_akses('iklanhome',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_iklantengah/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'url'=>$this->input->post('b'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'url'=>$this->input->post('b'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$this->model_app->insert('iklantengah',$data);  
				redirect('administrator/iklanhome');
				}else{
				$this->template->load('administrator/template','administrator/mod_iklanhome/view_iklanhome_tambah');
			}
		}
		
		function edit_iklanhome(){
			cek_menu_akses('iklanhome',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_iklantengah/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'url'=>$this->input->post('b'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'url'=>$this->input->post('b'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$where = array('id_iklantengah' => $this->input->post('id'));
				$this->model_app->update('iklantengah', $data, $where);
				redirect('administrator/iklanhome');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('iklantengah', array('id_iklantengah' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('iklantengah', array('id_iklantengah' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_iklanhome/view_iklanhome_edit',$data);
			}
		}
		
		function delete_iklanhome(){
			cek_menu_akses('iklanhome',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_iklantengah' => $this->uri->segment(3));
				}else{
				$id = array('id_iklantengah' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('iklantengah',$id);
			redirect('administrator/iklanhome');
		}
		
		
		// Controller Modul Iklan Sidebar
		
		function iklansidebar(){
			cek_menu_akses('iklansidebar',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('pasangiklan','id_pasangiklan','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('pasangiklan',array('username'=>$this->session->username),'id_pasangiklan','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_iklansidebar/view_iklansidebar',$data);
		}
		
		function tambah_iklansidebar(){
			cek_menu_akses('iklansidebar',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_pasangiklan/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'url'=>$this->input->post('b'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'url'=>$this->input->post('b'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$this->model_app->insert('pasangiklan',$data);
				redirect('administrator/iklansidebar');
				}else{
				$this->template->load('administrator/template','administrator/mod_iklansidebar/view_iklansidebar_tambah');
			}
		}
		
		function edit_iklansidebar(){
			cek_menu_akses('iklansidebar',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_pasangiklan/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'url'=>$this->input->post('b'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'username'=>$this->session->username,
					'url'=>$this->input->post('b'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$where = array('id_pasangiklan' => $this->input->post('id'));
				$this->model_app->update('pasangiklan', $data, $where);
				redirect('administrator/iklansidebar');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('pasangiklan', array('id_pasangiklan' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('pasangiklan', array('id_pasangiklan' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_iklansidebar/view_iklansidebar_edit',$data);
			}
		}
		
		function delete_iklansidebar(){
			cek_menu_akses('iklansidebar',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_pasangiklan' => $this->uri->segment(3));
				}else{
				$id = array('id_pasangiklan' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('pasangiklan',$id);
			redirect('administrator/iklansidebar');
		}
		
		
		// Controller Modul banner Link
		
		function banner(){
			cek_menu_akses('banner',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('banner','id_banner','DESC');
			$this->template->load('administrator/template','administrator/mod_banner/view_banner',$data);
		}
		
		function tambah_banner(){
			cek_menu_akses('banner',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_banner/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$this->model_app->insert('banner',$data);  
				redirect('administrator/banner');
				}else{
				$this->template->load('administrator/template','administrator/mod_banner/view_banner_tambah');
			}
		}
		
		function edit_banner(){
			cek_menu_akses('banner',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_banner/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$where = array('id_banner' => $this->input->post('id'));
				$this->model_app->update('banner', $data, $where);
				redirect('administrator/banner');
				}else{
				$proses = $this->model_app->edit('banner', array('id_banner' => $id))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_banner/view_banner_edit',$data);
			}
		}
		
		function delete_banner(){
			cek_menu_akses('banner',$this->session->id_session);
			$id = array('id_banner' => $this->uri->segment(3));
			$this->model_app->delete('banner',$id);
			redirect('administrator/banner');
		}
		
		// Controller Modul opd Link
		
		function opd(){
			cek_menu_akses('opd',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('opd','id_opd','DESC');
			$this->template->load('administrator/template','administrator/mod_opd/view_opd',$data);
		}
		
		function tambah_opd(){
			cek_menu_akses('opd',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_opd/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$this->model_app->insert('opd',$data);  
				redirect('administrator/opd');
				}else{
				$this->template->load('administrator/template','administrator/mod_opd/view_opd_tambah');
			}
		}
		
		function edit_opd(){
			cek_menu_akses('opd',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_opd/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$where = array('id_opd' => $this->input->post('id'));
				$this->model_app->update('opd', $data, $where);
				redirect('administrator/opd');
				}else{
				$proses = $this->model_app->edit('opd', array('id_opd' => $id))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_opd/view_opd_edit',$data);
			}
		}
		
		function delete_opd(){
			cek_menu_akses('opd',$this->session->id_session);
			$id = array('id_opd' => $this->uri->segment(3));
			$this->model_app->delete('opd',$id);
			redirect('administrator/opd');
		}
		
		// Controller Modul desa Link
		
		function desa(){
			cek_menu_akses('desa',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('desa','id_desa','DESC');
			$this->template->load('administrator/template','administrator/mod_desa/view_desa',$data);
		}
		
		function tambah_desa(){
			cek_menu_akses('desa',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_desa/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$this->model_app->insert('desa',$data);  
				redirect('administrator/desa');
				}else{
				$this->template->load('administrator/template','administrator/mod_desa/view_desa_tambah');
			}
		}
		
		function edit_desa(){
			cek_menu_akses('desa',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_desa/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$where = array('id_desa' => $this->input->post('id'));
				$this->model_app->update('desa', $data, $where);
				redirect('administrator/desa');
				}else{
				$proses = $this->model_app->edit('desa', array('id_desa' => $id))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_desa/view_desa_edit',$data);
			}
		}
		
		function delete_desa(){
			cek_menu_akses('desa',$this->session->id_session);
			$id = array('id_desa' => $this->uri->segment(3));
			$this->model_app->delete('desa',$id);
			redirect('administrator/desa');
		}
		
		// Controller Modul pemimpin
		
		function pemimpin(){
			cek_menu_akses('pemimpin',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('pemimpin','id_pemimpin','DESC');
			$this->template->load('administrator/template','administrator/mod_pemimpin/view_pemimpin',$data);
		}
		
		function tambah_pemimpin(){
			cek_menu_akses('pemimpin',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_pemimpin/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$this->model_app->insert('pemimpin',$data);  
				redirect('administrator/pemimpin');
				}else{
				$this->template->load('administrator/template','administrator/mod_pemimpin/view_pemimpin_tambah');
			}
		}
		
		function edit_pemimpin(){
			cek_menu_akses('pemimpin',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_pemimpin/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'tgl_posting'=>date('Y-m-d'));
					}else{
					$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'url'=>$this->input->post('b'),
					'deskripsi'=>$this->input->post('d'),
					'gambar'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'));
				}
				$where = array('id_pemimpin' => $this->input->post('id'));
				$this->model_app->update('pemimpin', $data, $where);
				redirect('administrator/pemimpin');
				}else{
				$proses = $this->model_app->edit('pemimpin', array('id_pemimpin' => $id))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_pemimpin/view_pemimpin_edit',$data);
			}
		}
		
		function delete_pemimpin(){
			cek_menu_akses('pemimpin',$this->session->id_session);
			$id = array('id_pemimpin' => $this->uri->segment(3));
			$this->model_app->delete('pemimpin',$id);
			redirect('administrator/pemimpin');
		}
		
		
		
		
		
		
		// Controller Modul inovasi
		
		function Inovasi(){
			cek_menu_akses('inovasi',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('inovasi','id_inovasi','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('inovasi',array('username'=>$this->session->username),'id_inovasi','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_inovasi/view_inovasi',$data);
		}
		
		function tambah_inovasi(){
			cek_menu_akses('inovasi',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/img_inovasi/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('jdl_inovasi'=>$this->input->post('a'),
					'inovasi_seo'=>seo_title($this->input->post('a')),
					'ket'=>$this->input->post('k'),
					'keterangan'=>$this->input->post('b'),
					'aktif'=>'Y',
					'hits_inovasi'=>'0',
					'tgl_posting'=>date('Y-m-d'),
					'jam'=>date('H:i:s'),
					'hari'=>hari_ini(date('w')),
					'username'=>$this->session->username);
					}else{
					$data = array('jdl_inovasi'=>$this->input->post('a'),
					'inovasi_seo'=>seo_title($this->input->post('a')),
					'ket'=>$this->input->post('k'),
					'keterangan'=>$this->input->post('b'),
					'gbr_inovasi'=>$hasil['file_name'],
					'aktif'=>'Y',
					'hits_inovasi'=>'0',
					'tgl_posting'=>date('Y-m-d'),
					'jam'=>date('H:i:s'),
					'hari'=>hari_ini(date('w')),
					'username'=>$this->session->username);
				}
				
				$this->model_app->insert('inovasi',$data);  
				redirect('administrator/inovasi');
				}else{
				$this->template->load('administrator/template','administrator/mod_inovasi/view_inovasi_tambah');
			}
		}
		
		function edit_inovasi(){
			cek_menu_akses('inovasi',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/img_inovasi/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('jdl_inovasi'=>$this->input->post('a'),
					'inovasi_seo'=>seo_title($this->input->post('a')),
					'ket'=>$this->input->post('k'),
					'keterangan'=>$this->input->post('b'),
					'aktif'=>$this->input->post('d'));
					}else{
					$data = array('jdl_inovasi'=>$this->input->post('a'),
					'inovasi_seo'=>seo_title($this->input->post('a')),
					'ket'=>$this->input->post('k'),
					'keterangan'=>$this->input->post('b'),
					'gbr_inovasi'=>$hasil['file_name'],
					'aktif'=>$this->input->post('d'));
				}
				$where = array('id_inovasi' => $this->input->post('id'));
				$this->model_app->update('inovasi', $data, $where);
				redirect('administrator/inovasi');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('inovasi', array('id_inovasi' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('inovasi', array('id_inovasi' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_inovasi/view_inovasi_edit',$data);
			}
		}
		
		function delete_inovasi(){
			cek_menu_akses('inovasi',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_inovasi' => $this->uri->segment(3));
				}else{
				$id = array('id_inovasi' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('inovasi',$id);
			redirect('administrator/inovasi');
		}
		
		
		
		
		
		
		
		
		
		// Controller Modul Kategori Bank Data
		
		function kategoribankdata(){
			cek_menu_akses('kategoribankdata',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('kat_bankdata','id_kat_bankdata','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('kat_bankdata',array('username'=>$this->session->username),'id_kat_bankdata','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_kat_bankdata/view_kat_bankdata',$data);
		}
		
		function tambah_kat_bankdata(){
			cek_menu_akses('kategoribankdata',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('nama_kat_bankdata'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'kat_bankdata_seo'=>seo_title($this->input->post('a')),
				'aktif'=>$this->db->escape_str($this->input->post('b')),
				'sidebar'=>$this->db->escape_str($this->input->post('c')));
				$this->model_app->insert('kat_bankdata',$data);
				redirect('administrator/kategoribankdata');
				}else{
				$this->template->load('administrator/template','administrator/mod_kat_bankdata/view_kat_bankdata_tambah');
			}
		}
		
		function edit_kat_bankdata(){
			cek_menu_akses('kategoribankdata',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('nama_kat_bankdata'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'kat_bankdata_seo'=>seo_title($this->input->post('a')),
				'aktif'=>$this->db->escape_str($this->input->post('b')),
				'sidebar'=>$this->db->escape_str($this->input->post('c')));
				$where = array('id_kat_bankdata' => $this->input->post('id'));
				$this->model_app->update('kat_bankdata', $data, $where);
				redirect('administrator/kategoribankdata');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('kat_bankdata', array('id_kat_bankdata' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('kat_bankdata', array('id_kat_bankdata' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_kat_bankdata/view_kat_bankdata_edit',$data);
			}
		}
		
		function delete_kat_bankdata(){
			cek_menu_akses('kategoribankdata',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_kat_bankdata' => $this->uri->segment(3));
				}else{
				$id = array('id_kat_bankdata' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('kat_bankdata',$id);
			redirect('administrator/kategoribankdata');
		}
		
		// Controller Modul Bank Data
		
		function bankdata(){
			cek_menu_akses('bankdata',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_join_one('bankdata','kat_bankdata','id_kat_bankdata','id_bankdata','DESC');
				}else{
				$data['record'] = $this->model_app->view_join_where('bankdata','kat_bankdata','id_kat_bankdata',array('bankdata.username'=>$this->session->username),'id_bankdata','DESC');
			}
			
			$this->template->load('administrator/template','administrator/mod_bankdata/view_bankdata',$data);
		}
		
		function tambah_bankdata(){
			cek_menu_akses('bankdata',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/files/';
				$config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
				$config['max_size'] = '100000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('b');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('id_kat_bankdata'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'judul'=>$this->db->escape_str($this->input->post('d')),
					'judul_seo'=>seo_title($this->input->post('c')),
					'nama_file'=>$hasil['file_name'],
					'hari'=>hari_ini(date('w')),
					'tgl_posting'=>date('Y-m-d'),
					'jam'=>date('H:i:s'),
					'hits'=>'0');
					}else{
					$data = array('id_kat_bankdata'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'judul'=>$this->db->escape_str($this->input->post('d')),
					'judul_seo'=>seo_title($this->input->post('c')),
					'nama_file'=>$hasil['file_name'],
					'hari'=>hari_ini(date('w')),
					'tgl_posting'=>date('Y-m-d'),
					'jam'=>date('H:i:s'),
					'hits'=>'0');
				}
				$this->model_app->insert('bankdata',$data);
				redirect('administrator/bankdata');
				}else{
				$data['record'] = $this->model_app->view_ordering('kat_bankdata','id_kat_bankdata','DESC');
				$this->template->load('administrator/template','administrator/mod_bankdata/view_bankdata_tambah',$data);
			}
		}
		
		function edit_bankdata(){
			cek_menu_akses('bankdata',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/files/';
				$config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
				// $config['max_size'] = '100000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('b');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
                    $data = array('id_kat_bankdata'=>$this->input->post('a'),
					'judul'=>$this->db->escape_str($this->input->post('d')),
					'judul_seo'=>seo_title($this->input->post('c')));
					}else{
					$data = array('id_kat_bankdata'=>$this->input->post('a'),
					'judul'=>$this->db->escape_str($this->input->post('d')),
					'judul_seo'=>seo_title($this->input->post('c')),
					'nama_file'=>$hasil['file_name']);
				}
				$where = array('id_bankdata' => $this->input->post('id'));
				$this->model_app->update('bankdata', $data, $where);
				redirect('administrator/bankdata');
				}else{
				$record = $this->model_app->view_ordering('kat_bankdata','id_kat_bankdata','DESC');
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('bankdata', array('id_bankdata' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('bankdata', array('id_bankdata' => $id, 'username' => $this->session->username))->row_array();
				}
				
				$data = array('rows' => $proses,'record' => $record);
				$this->template->load('administrator/template','administrator/mod_bankdata/view_bankdata_edit',$data);
			}
		}
		
		function delete_bankdata(){
			cek_menu_akses('bankdata',$this->session->id_session);
			$id = array('id_bankdata' => $this->uri->segment(3));
			$iddel = $this->uri->segment(3);
			$search=$this->model_app->view_where('bankdata', array('id_bankdata' => $iddel));
			if($search->num_rows()>0){
				$data=$search->row();
				$file="asset/files/".$data->nama_file;
				if(file_exists($gambar)){
					unlink($file);
				}
			}
			$this->model_app->delete('bankdata',$id);
			redirect('administrator/bankdata');
		}
		
		
		
		
		// Controller Modul Kategori Reformasi Birokrasi
		
		function kategorirefbirokrasi(){
			cek_menu_akses('kategorirefbirokrasi',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('kat_refbirokrasi','id_kat_refbirokrasi','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('kat_refbirokrasi',array('username'=>$this->session->username),'id_kat_refbirokrasi','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_kat_refbirokrasi/view_kat_refbirokrasi',$data);
		}
		
		function tambah_kat_refbirokrasi(){
			cek_menu_akses('kategorirefbirokrasi',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('nama_kat_refbirokrasi'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'kat_refbirokrasi_seo'=>seo_title($this->input->post('a')),
				'aktif'=>$this->db->escape_str($this->input->post('b')),
				'sidebar'=>$this->db->escape_str($this->input->post('c')));
				$this->model_app->insert('kat_refbirokrasi',$data);
				redirect('administrator/kategorirefbirokrasi');
				}else{
				$this->template->load('administrator/template','administrator/mod_kat_refbirokrasi/view_kat_refbirokrasi_tambah');
			}
		}
		
		function edit_kat_refbirokrasi(){
			cek_menu_akses('kategorirefbirokrasi',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('nama_kat_refbirokrasi'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'kat_refbirokrasi_seo'=>seo_title($this->input->post('a')),
				'aktif'=>$this->db->escape_str($this->input->post('b')),
				'sidebar'=>$this->db->escape_str($this->input->post('c')));
				$where = array('id_kat_refbirokrasi' => $this->input->post('id'));
				$this->model_app->update('kat_refbirokrasi', $data, $where);
				redirect('administrator/kategorirefbirokrasi');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('kat_refbirokrasi', array('id_kat_refbirokrasi' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('kat_refbirokrasi', array('id_kat_refbirokrasi' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_kat_refbirokrasi/view_kat_refbirokrasi_edit',$data);
			}
		}
		
		function delete_kat_refbirokrasi(){
			cek_menu_akses('kategorirefbirokrasi',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_kat_refbirokrasi' => $this->uri->segment(3));
				}else{
				$id = array('id_kat_refbirokrasi' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('kat_refbirokrasi',$id);
			redirect('administrator/kategorirefbirokrasi');
		}
		
		// Controller Modul Reformasi Birokrasi
		
		function refbirokrasi(){
			cek_menu_akses('refbirokrasi',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_join_one('refbirokrasi','kat_refbirokrasi','id_kat_refbirokrasi','id_refbirokrasi','DESC');
				}else{
				$data['record'] = $this->model_app->view_join_where('refbirokrasi','kat_refbirokrasi','id_kat_refbirokrasi',array('refbirokrasi.username'=>$this->session->username),'id_refbirokrasi','DESC');
			}
			
			$this->template->load('administrator/template','administrator/mod_refbirokrasi/view_refbirokrasi',$data);
		}
		
		function tambah_refbirokrasi(){
			cek_menu_akses('refbirokrasi',$this->session->id_session);
			
			if (isset($_POST['submit'])){
				print_r($_POST);
				exit();
				$config['upload_path'] = 'asset/files/';
				$config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
				$config['max_size'] = '100000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('b');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('id_kat_refbirokrasi'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'judul'=>$this->db->escape_str($this->input->post('d')),
					'judul_seo'=>seo_title($this->input->post('c')),
					'nama_file'=>$hasil['file_name'],
					'hari'=>hari_ini(date('w')),
					'tgl_posting'=>date('Y-m-d'),
					'jam'=>date('H:i:s'),
					'hits'=>'0');
					}else{
					$data = array('id_kat_refbirokrasi'=>$this->input->post('a'),
					'username'=>$this->session->username,
					'judul'=>$this->db->escape_str($this->input->post('d')),
					'judul_seo'=>seo_title($this->input->post('c')),
					'nama_file'=>$hasil['file_name'],
					'hari'=>hari_ini(date('w')),
					'tgl_posting'=>date('Y-m-d'),
					'jam'=>date('H:i:s'),
					'hits'=>'0');
				}
				$this->model_app->insert('refbirokrasi',$data);
				redirect('administrator/refbirokrasi');
				}else{
				$data['record'] = $this->model_app->view_ordering('kat_refbirokrasi','id_kat_refbirokrasi','DESC');
				$this->template->load('administrator/template','administrator/mod_refbirokrasi/view_refbirokrasi_tambah',$data);
			}
		}
		
		function edit_refbirokrasi(){
			cek_menu_akses('refbirokrasi',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/files/';
				$config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
				// $config['max_size'] = '100000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('b');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
                    $data = array('id_kat_refbirokrasi'=>$this->input->post('a'),
					'judul'=>$this->db->escape_str($this->input->post('d')),
					'judul_seo'=>seo_title($this->input->post('c')));
					}else{
					$data = array('id_kat_refbirokrasi'=>$this->input->post('a'),
					'judul'=>$this->db->escape_str($this->input->post('d')),
					'judul_seo'=>seo_title($this->input->post('c')),
					'nama_file'=>$hasil['file_name']);
				}
				$where = array('id_refbirokrasi' => $this->input->post('id'));
				$this->model_app->update('refbirokrasi', $data, $where);
				redirect('administrator/refbirokrasi');
				}else{
				$record = $this->model_app->view_ordering('kat_refbirokrasi','id_kat_refbirokrasi','DESC');
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('refbirokrasi', array('id_refbirokrasi' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('refbirokrasi', array('id_refbirokrasi' => $id, 'username' => $this->session->username))->row_array();
				}
				
				$data = array('rows' => $proses,'record' => $record);
				$this->template->load('administrator/template','administrator/mod_refbirokrasi/view_refbirokrasi_edit',$data);
			}
		}
		
		function delete_refbirokrasi(){
			cek_menu_akses('refbirokrasi',$this->session->id_session);
			$id = array('id_refbirokrasi' => $this->uri->segment(3));
			$iddel = $this->uri->segment(3);
			$search=$this->model_app->view_where('refbirokrasi', array('id_refbirokrasi' => $iddel));
			if($search->num_rows()>0){
				$data=$search->row();
				$file="asset/files/".$data->nama_file;
				if(file_exists($file)){
					unlink($file);
				}
			}
			$this->model_app->delete('refbirokrasi',$id);
			redirect('administrator/refbirokrasi');
		}
		
		
		
		
		// Controller Modul Logo
		
		function logowebsite(){
			cek_menu_akses('logowebsite',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/logo/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('logo');
				$hasil=$this->upload->data();
				$datadb = array('gambar'=>$hasil['file_name']);
				$where = array('id_logo' => $this->input->post('id'));
				$this->model_app->update('logo', $datadb, $where);
				redirect('administrator/logowebsite');
				}else{
				$data['record'] = $this->model_app->view('logo');
				$this->template->load('administrator/template','administrator/mod_logowebsite/view_logowebsite',$data);
			}
		}
		
		
		// Controller Modul Template Website
		
		function templatewebsite(){
			cek_menu_akses('templatewebsite',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('templates','id_templates','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('templates',array('username'=>$this->session->username),'id_templates','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_template/view_template',$data);
		}
		
		function tambah_templatewebsite(){
			cek_menu_akses('templatewebsite',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'pembuat'=>$this->input->post('b'),
				'folder'=>$this->input->post('c'));
				$this->model_app->insert('templates',$data);
				redirect('administrator/templatewebsite');
				}else{
				$this->template->load('administrator/template','administrator/mod_template/view_template_tambah');
			}
		}
		
		function edit_templatewebsite(){
			cek_menu_akses('templatewebsite',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'pembuat'=>$this->input->post('b'),
				'folder'=>$this->input->post('c'));
				$where = array('id_templates' => $this->input->post('id'));
				$this->model_app->update('templates', $data, $where);
				redirect('administrator/templatewebsite');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('templates', array('id_templates' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('templates', array('id_templates' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_template/view_template_edit',$data);
			}
		}
		
		function aktif_templatewebsite(){
			cek_menu_akses('templatewebsite',$this->session->id_session);
			$id = $this->uri->segment(3);
			if ($this->uri->segment(4)=='Y'){ $aktif = 'N'; }else{ $aktif = 'Y'; }
			
			$data = array('aktif'=>$aktif);
			$where = array('id_templates' => $id);
			$this->model_app->update('templates', $data, $where);
			
			$dataa = array('aktif'=>'N');
			$wheree = array('id_templates !=' => $id);
			$this->model_app->update('templates', $dataa, $wheree);
			
			redirect('administrator/templatewebsite');
		}
		
		function delete_templatewebsite(){
			cek_menu_akses('templatewebsite',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_templates' => $this->uri->segment(3));
				}else{
				$id = array('id_templates' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('templates',$id);
			redirect('administrator/templatewebsite');
		}
		
		
		// Controller Modul Download
		
		function background(){
			cek_menu_akses('background',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('gambar'=>$this->input->post('a'));
				$where = array('id_background' => 1);
				$this->model_app->update('background', $data, $where);
				redirect('administrator/background');
				}else{
				$proses = $this->model_app->edit('background', array('id_background' => 1))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_background/view_background',$data);
			}
		}
		
		
		// Controller Modul Download
		
		function download(){
			cek_menu_akses('download',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('download','id_download','DESC');
			$this->template->load('administrator/template','administrator/mod_download/view_download',$data);
		}
		
		function tambah_download(){
			cek_menu_akses('download',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/files/';
				$config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
				$config['max_size'] = '50000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('b');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'tgl_posting'=>date('Y-m-d'),
					'hits'=>'0');
					}else{
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'nama_file'=>$hasil['file_name'],
					'tgl_posting'=>date('Y-m-d'),
					'hits'=>'0');
				}
				$this->model_app->insert('download',$data);
				redirect('administrator/download');
				}else{
				$this->template->load('administrator/template','administrator/mod_download/view_download_tambah');
			}
		}
		
		function edit_download(){
			cek_menu_akses('download',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/files/';
				$config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
				$config['max_size'] = '50000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('b');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')));
					}else{
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
					'nama_file'=>$hasil['file_name']);
				}
				$where = array('id_download' => $this->input->post('id'));
				$this->model_app->update('download', $data, $where);
				redirect('administrator/download');
				}else{
				$proses = $this->model_app->edit('download', array('id_download' => $id))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_download/view_download_edit',$data);
			}
		}
		
		function delete_download(){
			cek_menu_akses('download',$this->session->id_session);
			$id = array('id_download' => $this->uri->segment(3));
			$this->model_app->delete('download',$id);
			redirect('administrator/download');
		}
		
		
		// Controller Modul Kategori Agenda
		
		function kategoriagenda(){
			cek_menu_akses('kategoriagenda',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('kat_agenda','id_kat_agenda','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('kat_agenda',array('username'=>$this->session->username),'id_kat_agenda','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_kat_agenda/view_kat_agenda',$data);
		}
		
		function tambah_kat_agenda(){
			cek_menu_akses('kat_agenda',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('nama_kat_agenda'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'kat_agenda_seo'=>seo_title($this->input->post('a')),
				'aktif'=>$this->db->escape_str($this->input->post('b')),
				'sidebar'=>$this->db->escape_str($this->input->post('c')));
				$this->model_app->insert('kat_agenda',$data);
				redirect('administrator/kategoriagenda');
				}else{
				$this->template->load('administrator/template','administrator/mod_kat_agenda/view_kat_agenda_tambah');
			}
		}
		
		function edit_kat_agenda(){
			cek_menu_akses('kat_agenda',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('nama_kat_agenda'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'kat_agenda_seo'=>seo_title($this->input->post('a')),
				'aktif'=>$this->db->escape_str($this->input->post('b')),
				'sidebar'=>$this->db->escape_str($this->input->post('c')));
				$where = array('id_kat_agenda' => $this->input->post('id'));
				$this->model_app->update('kat_agenda', $data, $where);
				redirect('administrator/kategoriagenda');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('kat_agenda', array('id_kat_agenda' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('kat_agenda', array('id_kat_agenda' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_kat_agenda/view_kat_agenda_edit',$data);
			}
		}
		
		function delete_kat_agenda(){
			cek_menu_akses('kat_agenda',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_kat_agenda' => $this->uri->segment(3));
				}else{
				$id = array('id_kat_agenda' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('kat_agenda',$id);
			redirect('administrator/kategoriagenda');
		}
		
		// Controller Modul Agenda
		
		function agenda(){
			cek_menu_akses('agenda',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_join_one('agenda','kat_agenda','id_kat_agenda','id_agenda','DESC');
				}else{
				$data['record'] = $this->model_app->view_join_where('agenda','kat_agenda','id_kat_agenda',array('agenda.username'=>$this->session->username),'id_agenda','DESC');
			}
			
			$this->template->load('administrator/template','administrator/mod_agenda/view_agenda',$data);
		}
		
		function tambah_agenda(){
			cek_menu_akses('agenda',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_agenda/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				$ex = explode(' - ',$this->input->post('f'));
				$exx = explode('/',$ex[0]);
				$exy = explode('/',$ex[1]);
				$mulai = $exx[2].'-'.$exx[0].'-'.$exx[1];
				$selesai = $exy[2].'-'.$exy[0].'-'.$exy[1];
				if ($hasil['file_name']==''){
					
                    $data = array('id_kat_agenda'=>$this->input->post('h'),
					'tema'=>$this->db->escape_str($this->input->post('a')),
					'tema_seo'=>seo_title($this->input->post('a')),
					'isi_agenda'=>$this->input->post('b'),
					
					'tbg'=>$this->db->escape_str($this->input->post('k')),
					
					'tempat'=>$this->db->escape_str($this->input->post('d')),
					'pengirim'=>$this->db->escape_str($this->input->post('g')),
					'tgl_mulai'=>$mulai,
					'tgl_selesai'=>$selesai,
					
					'hari'=>hari_ini(date('w')),
					
					'tgl_posting'=>date('Y-m-d'),
					'jam'=>$this->db->escape_str($this->input->post('e')),
					'dibaca'=>'0',
					'username'=>$this->session->username);
					}else{
                    $data = array('id_kat_agenda'=>$this->input->post('h'),
					'tema'=>$this->db->escape_str($this->input->post('a')),
					'tema_seo'=>seo_title($this->input->post('a')),
					'isi_agenda'=>$this->input->post('b'),
					
					'tbg'=>$this->db->escape_str($this->input->post('k')),
					
					'tempat'=>$this->db->escape_str($this->input->post('d')),
					'pengirim'=>$this->db->escape_str($this->input->post('g')),
					'gambar'=>$hasil['file_name'],
					'tgl_mulai'=>$mulai,
					'tgl_selesai'=>$selesai,
					
					'hari'=>hari_ini(date('w')),
					
					'tgl_posting'=>date('Y-m-d'),
					'jam'=>$this->db->escape_str($this->input->post('e')),
					'dibaca'=>'0',
					'username'=>$this->session->username);
				}
				$this->model_app->insert('agenda',$data);
				redirect('administrator/agenda');
				}else{
				$data['record'] = $this->model_app->view_ordering('kat_agenda','id_kat_agenda','DESC');
				$this->template->load('administrator/template','administrator/mod_agenda/view_agenda_tambah',$data);
			}
		}
		
		function edit_agenda(){
			cek_menu_akses('agenda',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_agenda/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('c');
				$hasil=$this->upload->data();
				$ex = explode(' - ',$this->input->post('f'));
				$exx = explode('/',$ex[0]);
				$exy = explode('/',$ex[1]);
				$mulai = $exx[2].'-'.$exx[0].'-'.$exx[1];
				$selesai = $exy[2].'-'.$exy[0].'-'.$exy[1];
				if ($hasil['file_name']==''){
                    $data = array('id_kat_agenda'=>$this->input->post('h'),
					'tema'=>$this->db->escape_str($this->input->post('a')),
					'tema_seo'=>seo_title($this->input->post('a')),
					'isi_agenda'=>$this->input->post('b'),
					
					'tbg'=>$this->db->escape_str($this->input->post('k')),
					
					'tempat'=>$this->db->escape_str($this->input->post('d')),
					'pengirim'=>$this->db->escape_str($this->input->post('g')),
					'tgl_mulai'=>$mulai,
					'tgl_selesai'=>$selesai,
					'jam'=>$this->db->escape_str($this->input->post('e')));
					}else{
                    $data = array('id_kat_agenda'=>$this->input->post('h'),
					'tema'=>$this->db->escape_str($this->input->post('a')),
					'tema_seo'=>seo_title($this->input->post('a')),
					'isi_agenda'=>$this->input->post('b'),
					
					'tbg'=>$this->db->escape_str($this->input->post('k')),
					
					'tempat'=>$this->db->escape_str($this->input->post('d')),
					'pengirim'=>$this->db->escape_str($this->input->post('g')),
					'gambar'=>$hasil['file_name'],
					'tgl_mulai'=>$mulai,
					'tgl_selesai'=>$selesai,
					'jam'=>$this->db->escape_str($this->input->post('e')));
				}
				
				$where = array('id_agenda' => $this->input->post('id'));
				$this->model_app->update('agenda', $data, $where);
				redirect('administrator/agenda');
				}else{
				$record = $this->model_app->view_ordering('kat_agenda','id_kat_agenda','DESC');
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('agenda', array('id_agenda' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('agenda', array('id_agenda' => $id, 'username' => $this->session->username))->row_array();
				}
				
				$data = array('rows' => $proses,'record' => $record);
				$this->template->load('administrator/template','administrator/mod_agenda/view_agenda_edit',$data);
			}
		}
		
		function delete_agenda(){
			cek_menu_akses('agenda',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_agenda' => $this->uri->segment(3));
				}else{
				$id = array('id_agenda' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('agenda',$id);
			redirect('administrator/agenda');
		}
		
		
		
		
				// Controller Modul Kategori RB
		
		function kategorirb(){
			cek_menu_akses('kategorirb',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('kategorirb','id_kategorirb','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('kategorirb',array('username'=>$this->session->username),'id_kategorirb','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_kategorirb/view_kategorirb',$data);
		}
		
		function tambah_kategorirb(){
			cek_menu_akses('kategorirb',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('nama_kategorirb'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'kategorirb_seo'=>seo_title($this->input->post('a')),
				'aktif'=>$this->db->escape_str($this->input->post('b')),
				'sidebar'=>$this->db->escape_str($this->input->post('c')));
				$this->model_app->insert('kategorirb',$data);
				redirect('administrator/kategorirb');
				}else{
				$this->template->load('administrator/template','administrator/mod_kategorirb/view_kategorirb_tambah');
			}
		}
		
		function edit_kategorirb(){
			cek_menu_akses('kategorirb',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('nama_kategorirb'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'kategorirb_seo'=>seo_title($this->input->post('a')),
				'aktif'=>$this->db->escape_str($this->input->post('b')),
				'sidebar'=>$this->db->escape_str($this->input->post('c')));
				$where = array('id_kategorirb' => $this->input->post('id'));
				$this->model_app->update('kategorirb', $data, $where);
				redirect('administrator/kategorirb');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('kategorirb', array('id_kategorirb' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('kategorirb', array('id_kategorirb' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_kategorirb/view_kategorirb_edit',$data);
			}
		}
		
		function delete_kategorirb(){
			cek_menu_akses('kategorirb',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_kategorirb' => $this->uri->segment(3));
				}else{
				$id = array('id_kategorirb' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('kategorirb',$id);
			redirect('administrator/kategorirb');
		}
		
		
		
		
				// Controller Modul Media RB
		
		function mediarb(){
			cek_menu_akses('mediarb',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_join_one('mediarb','kategorirb','id_kategorirb','id_mediarb','DESC');
				}else{
				$data['record'] = $this->model_app->view_join_where('mediarb','kategorirb','id_kategorirb',array('mediarb.username'=>$this->session->username),'id_mediarb','DESC');
			}
			
			$this->template->load('administrator/template','administrator/mod_mediarb/view_mediarb',$data);
		}
		
		function tambah_mediarb(){
			cek_menu_akses('mediarb',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('id_kategorirb'=>$this->input->post('h'),
				'nama'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'nama_seo'=>seo_title($this->input->post('a')),
				'tahun'=>$this->db->escape_str($this->input->post('b')),
				'nilai'=>$this->db->escape_str($this->input->post('c')));
				
				//'aktif'=>$this->db->escape_str($this->input->post('d')),
				//'sidebar'=>$this->db->escape_str($this->input->post('e')));
				$this->model_app->insert('mediarb',$data);
				redirect('administrator/mediarb');
				}else{
				$data['record'] = $this->model_app->view_ordering('kategorirb','id_kategorirb','DESC');
				$this->template->load('administrator/template','administrator/mod_mediarb/view_mediarb_tambah',$data);
			}
		}
		
		function edit_mediarb(){
			cek_menu_akses('mediarb',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('id_kategorirb'=>$this->input->post('h'),
				'nama'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'nama_seo'=>seo_title($this->input->post('a')),
				'tahun'=>$this->db->escape_str($this->input->post('b')),
				'nilai'=>$this->db->escape_str($this->input->post('c')));
				
				
				//'aktif'=>$this->db->escape_str($this->input->post('d')),
				//'sidebar'=>$this->db->escape_str($this->input->post('e')));
				$where = array('id_mediarb' => $this->input->post('id'));
				$this->model_app->update('mediarb', $data, $where);
				redirect('administrator/mediarb');
				}else{
				$record = $this->model_app->view_ordering('kategorirb','id_kategorirb','DESC');
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('mediarb', array('id_mediarb' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('mediarb', array('id_mediarb' => $id, 'username' => $this->session->username))->row_array();
				}
				
				$data = array('rows' => $proses,'record' => $record);
				$this->template->load('administrator/template','administrator/mod_mediarb/view_mediarb_edit',$data);
			}
		}
		
		function delete_mediarb(){
			cek_menu_akses('mediarb',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_mediarb' => $this->uri->segment(3));
				}else{
				$id = array('id_mediarb' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('mediarb',$id);
			redirect('administrator/mediarb');
		}
		
		
		
		
		
		
		
		// Controller Modul Sekilas Info
		
		function sekilasinfo(){
			cek_menu_akses('sekilasinfo',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('sekilasinfo','id_sekilas','DESC');
			$this->template->load('administrator/template','administrator/mod_sekilasinfo/view_sekilasinfo',$data);
		}
		
		function tambah_sekilasinfo(){
			cek_menu_akses('sekilasinfo',$this->session->id_session);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_info/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '5000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('b');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('info'=>$this->input->post('a'),
					'tgl_posting'=>date('Y-m-d'),
					'aktif'=>'Y');
					}else{
					$data = array('info'=>$this->input->post('a'),
					'tgl_posting'=>date('Y-m-d'),
					'gambar'=>$hasil['file_name'],
					'aktif'=>'Y');
				}
				$this->model_app->insert('sekilasinfo',$data);
				redirect('administrator/sekilasinfo');
				}else{
				$this->template->load('administrator/template','administrator/mod_sekilasinfo/view_sekilasinfo_tambah');
			}
		}
		
		function edit_sekilasinfo(){
			cek_menu_akses('sekilasinfo',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_info/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '5000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('b');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('info'=>$this->input->post('a'),
					'aktif'=>$this->input->post('f'));
					}else{
					$data = array('info'=>$this->input->post('a'),
					'gambar'=>$hasil['file_name'],
					'aktif'=>$this->input->post('f'));
				}
				
				$where = array('id_sekilas' => $this->input->post('id'));
				$this->model_app->update('sekilasinfo', $data, $where);
				redirect('administrator/sekilasinfo');
				}else{
				$proses = $this->model_app->edit('sekilasinfo', array('id_sekilas' => $id))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_sekilasinfo/view_sekilasinfo_edit',$data);
			}
		}
		
		function delete_sekilasinfo(){
			cek_menu_akses('sekilasinfo',$this->session->id_session);
			$id = array('id_sekilas' => $this->uri->segment(3));
			$this->model_app->delete('sekilasinfo',$id);
			redirect('administrator/sekilasinfo');
		}
		
		
		
		// Controller Modul Jajak Pendapat
		
		function jajakpendapat(){
			cek_menu_akses('jajakpendapat',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('poling','id_poling','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('poling',array('username'=>$this->session->username),'id_poling','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_jajakpendapat/view_jajakpendapat',$data);
		}
		
		function tambah_jajakpendapat(){
			cek_menu_akses('jajakpendapat',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('pilihan'=>$this->input->post('a'),
				'status'=>$this->input->post('b'),
				'username'=>$this->session->username,
				'rating'=>'0',
				'aktif'=>$this->input->post('c'));
				$this->model_app->insert('poling',$data);
				redirect('administrator/jajakpendapat');
				}else{
				$this->template->load('administrator/template','administrator/mod_jajakpendapat/view_jajakpendapat_tambah');
			}
		}
		
		function edit_jajakpendapat(){
			cek_menu_akses('jajakpendapat',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('pilihan'=>$this->input->post('a'),
				'status'=>$this->input->post('b'),
				'aktif'=>$this->input->post('c'));
				$where = array('id_poling' => $this->input->post('id'));
				$this->model_app->update('poling', $data, $where);
				redirect('administrator/jajakpendapat');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('poling', array('id_poling' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('poling', array('id_poling' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_jajakpendapat/view_jajakpendapat_edit',$data);
			}
		}
		
		function delete_jajakpendapat(){
			cek_menu_akses('jajakpendapat',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_poling' => $this->uri->segment(3));
				}else{
				$id = array('id_poling' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('poling',$id);
			redirect('administrator/jajakpendapat');
		}
		
		
		// Controller Modul YM
		
		function ym(){
			cek_menu_akses('ym',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('mod_ym','id','DESC');
			$this->template->load('administrator/template','administrator/mod_ym/view_ym',$data);
		}
		
		function tambah_ym(){
			cek_menu_akses('ym',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('nama'=>$this->db->escape_str($this->input->post('a')),
				'username'=>seo_title($this->input->post('b')),
				'ym_icon'=>$this->input->post('c'));
				$this->model_app->insert('mod_ym',$data);
				redirect('administrator/ym');
				}else{
				$this->template->load('administrator/template','administrator/mod_ym/view_ym_tambah');
			}
		}
		
		function edit_ym(){
			cek_menu_akses('ym',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('nama'=>$this->db->escape_str($this->input->post('a')),
				'username'=>seo_title($this->input->post('b')),
				'ym_icon'=>$this->input->post('c'));
				$where = array('id' => $this->input->post('id'));
				$this->model_app->update('mod_ym', $data, $where);
				redirect('administrator/ym');
				}else{
				$proses = $this->model_app->edit('mod_ym', array('id' => $id))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_ym/view_ym_edit',$data);
			}
		}
		
		function delete_ym(){
			cek_menu_akses('ym',$this->session->id_session);
			$id = array('id' => $this->uri->segment(3));
			$this->model_app->delete('mod_ym',$id);
			redirect('administrator/ym');
		}
		
		// Controller Modul Alamat
		
		function alamat(){
			cek_menu_akses('alamat',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('alamat'=>$this->input->post('a'));
				$where = array('id_alamat' => 1);
				$this->model_app->update('mod_alamat', $data, $where);
				redirect('administrator/alamat');
				}else{
				$proses = $this->model_app->edit('mod_alamat', array('id_alamat' => 1))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_alamat/view_alamat',$data);
			}
		}
		
		
		// Controller Modul Pesan Masuk
		
		function pesanmasuk(){
			cek_menu_akses('pesanmasuk',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('hubungi','id_hubungi','DESC');
			$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk',$data);
		}
		
		function detail_pesanmasuk(){
			cek_menu_akses('pesanmasuk',$this->session->id_session);
			$id = $this->uri->segment(3);
			$this->db->query("UPDATE hubungi SET dibaca='Y' where id_hubungi='$id'");
			if (isset($_POST['submit'])){
				$nama           = $this->input->post('a');
				$email           = $this->input->post('b');
				$subject         = $this->input->post('c');
				$message         = $this->input->post('isi')." <br><hr><br> ".$this->input->post('d');
				// Konfigurasi email
				$config = [
				'mailtype'  => 'html',
				'charset'   => 'utf-8',
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_user' => 'btelematika@gmail.com',    // Ganti dengan email gmail kamu
				'smtp_pass' => 'KlungkungSanti981',      // Password gmail kamu
				'smtp_port' => 465,
				'crlf'      => "\r\n",
				'newline'   => "\r\n"
				];
				
				// Load library email dan konfigurasinya
				$this->load->library('email', $config);
				
				// Email dan nama pengirim
				$this->email->from($email, $nama);
				
				// Email penerima
				$this->email->to('klungkungkab.go.id@gmail.com'); // Ganti dengan email tujuan kamu
				
				// Lampiran email, isi dengan url/path file
				// $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');
				
				// Subject email
				$this->email->subject('Balasan email');
				
				// Isi email
				$this->email->message($message);
				
				// Tampilkan pesan sukses atau error
				if ($this->email->send()) {
					echo 'Sukses! email berhasil dikirim.';
					} else {
					echo 'Error! email tidak dapat dikirim.';
				}
				// $nama           = $this->input->post('a');
				// $email           = $this->input->post('b');
				// $subject         = $this->input->post('c');
				// $message         = $this->input->post('isi')." <br><hr><br> ".$this->input->post('d');
				
				// $this->email->from('klungkungkab.go.id@gmail.com', 'http://php.net/smtp
				// ;SMTP=localhost
				
				// ');
				// $this->email->to($email);
				// $this->email->cc('');
				// $this->email->bcc('');
				
				// $this->email->subject($subject);
				// $this->email->message($message);
				// $this->email->set_mailtype("html");
				// $this->email->send();
				
				// $config['protocol'] = 'sendmail';
				// $config['mailpath'] = '/usr/sbin/sendmail';
				// $config['charset'] = 'utf-8';
				// $config['wordwrap'] = TRUE;
				// $config['mailtype'] = 'html';
				// $this->email->initialize($config);
				
				// $proses = $this->model_app->edit('hubungi', array('id_hubungi' => $id))->row_array();
				// $data = array('rows' => $proses);
				// $this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk_detail',$data);
				}else{
				$proses = $this->model_app->edit('hubungi', array('id_hubungi' => $id))->row_array();
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk_detail',$data);
			}
		}
		
		function delete_pesanmasuk(){
			cek_menu_akses('pesanmasuk',$this->session->id_session);
			$id = array('id_hubungi' => $this->uri->segment(3));
			$this->model_app->delete('hubungi',$id);
			redirect('administrator/pesanmasuk');
		}
		
		
		// Controller Modul User
		
		function manajemenuser(){
			cek_menu_akses('manajemenuser',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('users','username','DESC');
			$this->template->load('administrator/template','administrator/mod_users/view_users',$data);
		}
		
		function tambah_manajemenuser(){
			cek_menu_akses('manajemenuser',$this->session->id_session);
			// $id = $this->session->username;
			
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_user/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '1000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('f');
				$hasil=$this->upload->data();
				$data_cat = $this->input->post('data');
				$input_data=implode(',',$data_cat);
				if ($hasil['file_name']==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
					'idmenu'=>$input_data,
					'password'=>password_hash($this->input->post('b'), PASSWORD_DEFAULT),
					'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
					'email'=>$this->db->escape_str($this->input->post('d')),
					'no_telp'=>$this->db->escape_str($this->input->post('e')),
					'level'=>$this->db->escape_str($this->input->post('g')),
					'blokir'=>'N',
					'id_session'=>md5($this->input->post('a')).'-'.date('YmdHis'));
					}else{
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
					'idmenu'=>$input_data,
					'password'=>password_hash($this->input->post('b'), PASSWORD_DEFAULT),
					'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
					'email'=>$this->db->escape_str($this->input->post('d')),
					'no_telp'=>$this->db->escape_str($this->input->post('e')),
					'foto'=>$hasil['file_name'],
					'level'=>$this->db->escape_str($this->input->post('g')),
					'blokir'=>'N',
					'id_session'=>md5($this->input->post('a')).'-'.date('YmdHis'));
				}
				$this->model_app->insert('users',$data);
				
				// $mod=count($this->input->post('modul'));
				// $modul=$this->input->post('modul');
				// $sess = md5($this->input->post('a')).'-'.date('YmdHis');
				// for($i=0;$i<$mod;$i++){
                // $datam = array('id_session'=>$sess,
				// 'id_modul'=>$modul[$i]);
                // $this->model_app->insert('users_modul',$datam);
				// }
				
				redirect('administrator/edit_manajemenuser/'.$this->input->post('a'));
				}else{
				$proses = $this->model_app->view_where_ordering('modul', array('publish' => 'Y','status' => 'user'), 'id_modul','DESC');
				$data = array('record' => $proses);
				$this->template->load('administrator/template','administrator/mod_users/view_users_tambah',$data);
			}
		}
		
		function edit_manajemenuser(){
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_user/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '1000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('f');
				$hasil=$this->upload->data();
				$data_cat = $this->input->post('data');
				$input_data=implode(',',$data_cat);
				if ($hasil['file_name']=='' AND $this->input->post('b') ==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
					'idmenu'=>$input_data,
					'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
					'email'=>$this->db->escape_str($this->input->post('d')),
					'no_telp'=>$this->db->escape_str($this->input->post('e')),
					'blokir'=>$this->input->post('h'));
					}elseif ($hasil['file_name']!='' AND $this->input->post('b') ==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
					'idmenu'=>$input_data,
					'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
					'email'=>$this->db->escape_str($this->input->post('d')),
					'no_telp'=>$this->db->escape_str($this->input->post('e')),
					'foto'=>$hasil['file_name'],
					'blokir'=>$this->input->post('h'));
					}elseif ($hasil['file_name']=='' AND $this->input->post('b') !=''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
					'idmenu'=>$input_data,
					'password'=>password_hash($this->input->post('b'), PASSWORD_DEFAULT),
					'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
					'email'=>$this->db->escape_str($this->input->post('d')),
					'no_telp'=>$this->db->escape_str($this->input->post('e')),
					'blokir'=>$this->input->post('h'));
					}elseif ($hasil['file_name']!='' AND $this->input->post('b') !=''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
					'idmenu'=>$input_data,
					'password'=>password_hash($this->input->post('b'), PASSWORD_DEFAULT),
					'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
					'email'=>$this->db->escape_str($this->input->post('d')),
					'no_telp'=>$this->db->escape_str($this->input->post('e')),
					'foto'=>$hasil['file_name'],
					'blokir'=>$this->input->post('h'));
				}
				$where = array('username' => $this->input->post('id'));
				$res= $this->model_app->update('users', $data, $where);
				if($res==true){
					echo $this->session->set_flashdata('message', '<span style="color:red">sukses!</span>');
					redirect('administrator/edit_manajemenuser/'.$this->input->post('id'));
					}else{
					echo $this->session->set_flashdata('message', '<span style="color:red">error!</span>');
					redirect('administrator/edit_manajemenuser/'.$this->input->post('id'));
				}
				}else{
				if ($this->session->username==$this->uri->segment(3) OR $this->session->level=='admin'){
					$proses = $this->model_app->edit('users', array('username' => $id))->row_array();
					$akses = $this->model_app->view_join_where('users_modul','modul','id_modul', array('id_session' => $proses['id_session']),'id_umod','DESC');
					$modul = $this->model_app->view_where_ordering('modul', array('publish' => 'Y','status' => 'user'), 'id_modul','DESC');
					$data = array('rows' => $proses, 'record' => $modul, 'akses' => $akses);
					$this->template->load('administrator/template','administrator/mod_users/view_users_edit',$data);
					}else{
					redirect('administrator/edit_manajemenuser/'.$this->session->username);
				}
			}
		}
		
		function delete_manajemenuser(){
			cek_menu_akses('manajemenuser',$this->session->id_session);
			$id = array('username' => $this->uri->segment(3));
			$this->model_app->delete('users',$id);
			redirect('administrator/manajemenuser');
		}
		
		function delete_akses(){
			cek_session_admin();
			$id = array('id_umod' => $this->uri->segment(3));
			$this->model_app->delete('users_modul',$id);
			redirect('administrator/edit_manajemenuser/'.$this->uri->segment(4));
		}
		
		
		
		// Controller Modul Modul
		
		function manajemenmodul(){
			cek_menu_akses('manajemenmodul',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('modul','id_modul','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('modul',array('username'=>$this->session->username),'id_modul','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_modul/view_modul',$data);
		}
		
		function tambah_manajemenmodul(){
			cek_menu_akses('manajemenmodul',$this->session->id_session);
			if (isset($_POST['submit'])){
				$data = array('nama_modul'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'link'=>$this->db->escape_str($this->input->post('b')),
				'static_content'=>'',
				'gambar'=>'',
				'publish'=>$this->db->escape_str($this->input->post('c')),
				'status'=>$this->db->escape_str($this->input->post('e')),
				'aktif'=>$this->db->escape_str($this->input->post('d')),
				'urutan'=>'0',
				'link_seo'=>'');
				$this->model_app->insert('modul',$data);
				redirect('administrator/manajemenmodul');
				}else{
				$this->template->load('administrator/template','administrator/mod_modul/view_modul_tambah');
			}
		}
		
		function edit_manajemenmodul(){
			cek_menu_akses('manajemenmodul',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('nama_modul'=>$this->db->escape_str($this->input->post('a')),
				'username'=>$this->session->username,
				'link'=>$this->db->escape_str($this->input->post('b')),
				'static_content'=>'',
				'gambar'=>'',
				'publish'=>$this->db->escape_str($this->input->post('c')),
				'status'=>$this->db->escape_str($this->input->post('e')),
				'aktif'=>$this->db->escape_str($this->input->post('d')),
				'urutan'=>'0',
				'link_seo'=>'');
				$where = array('id_modul' => $this->input->post('id'));
				$this->model_app->update('modul', $data, $where);
				redirect('administrator/manajemenmodul');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('modul', array('id_modul' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('modul', array('id_modul' => $id, 'username' => $this->session->username))->row_array();
				}
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_modul/view_modul_edit',$data);
			}
		}
		
		function delete_manajemenmodul(){
			cek_menu_akses('manajemenmodul',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_modul' => $this->uri->segment(3));
				}else{
				$id = array('id_modul' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$this->model_app->delete('modul',$id);
			redirect('administrator/manajemenmodul');
		}
		
		function logout(){
			$this->session->sess_destroy();
			redirect('main');
		}
		
		function linkmenu(){
			cek_menu_akses('menuwebsite',$this->session->id_session);
			$data['record'] = $this->model_app->view_ordering('link','urutan','ASC');
			$this->template->load('administrator/template','administrator/mod_link/view_link',$data);
		}
		
		function tambah_linkmenu(){
			cek_menu_akses('menuwebsite',$this->session->id_session);
			
			if (isset($_POST['submit'])){
				$config['upload_path'] = 'asset/foto_link/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
				$config['max_size'] = '3000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('k');
				$hasil=$this->upload->data();
				if ($hasil['file_name']==''){
					$data = array('id_parent'=>$this->db->escape_str($this->input->post('b')),
					'nama_menu'=>$this->db->escape_str($this->input->post('c')),
					'link'=>$this->db->escape_str($this->input->post('a')),
					'aktif'=>"Ya",
					'groupname'=>$this->db->escape_str($this->input->post('h')),
					'urutan'=>$this->db->escape_str($this->input->post('e')),
					'deskripsi'=>$this->db->escape_str($this->input->post('g')),
					'icon'=>$this->db->escape_str($this->input->post('l')));
					}else{
					$data = array('id_parent'=>$this->db->escape_str($this->input->post('b')),
					'nama_menu'=>$this->db->escape_str($this->input->post('c')),
					'link'=>$this->db->escape_str($this->input->post('a')),
					'aktif'=>"Ya",
					'groupname'=>$this->db->escape_str($this->input->post('h')),
					'urutan'=>$this->db->escape_str($this->input->post('e')),
					'deskripsi'=>$this->db->escape_str($this->input->post('g')),
					'gambar'=>$hasil['file_name'],
					'icon'=>$this->db->escape_str($this->input->post('l')));
					
				}
				
				$this->model_app->insert('link',$data);
				redirect('administrator/linkmenu');
				}else{
				$proses = $this->model_app->view_where_ordering('link', array('id_parent' => 0), 'id_link','DESC');
				$data = array('record' => $proses);
				$this->template->load('administrator/template','administrator/mod_link/view_link_tambah',$data);
			}
		}
		
		function edit_linkmenu(){
			cek_menu_akses('menuwebsite',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				$data = array('id_parent'=>$this->db->escape_str($this->input->post('b')),
				'nama_menu'=>$this->db->escape_str($this->input->post('c')),
				'link'=>$this->db->escape_str($this->input->post('a')),
				'position'=>$this->db->escape_str($this->input->post('d')),
				'urutan'=>$this->db->escape_str($this->input->post('e')),
				'deskripsi'=>$this->db->escape_str($this->input->post('g')),
				'aktif'=>$this->db->escape_str($this->input->post('f')));
				$where = array('id_menu' => $this->input->post('id'));
				$this->model_app->update('menu', $data, $where);
				redirect('administrator/menuwebsite');
				}else{
				$menu_utama = $this->model_app->view_where_ordering('menu', array('position' => 'Bottom'), 'id_menu','DESC');
				$proses = $this->model_app->edit('menu', array('id_menu' => $id))->row_array();
				$data = array('rows' => $proses, 'record' => $menu_utama);
				$this->template->load('administrator/template','administrator/mod_menu/view_menu_edit',$data);
			}
		}
		
		// Controller Modul pengumuman
		
		function pengumuman(){
			cek_menu_akses('pengumuman',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('pengumuman','id_pengumuman','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('pengumuman',array('username'=>$this->session->username),'id_pengumuman','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_pengumuman/view_pengumuman',$data);
		}
		
		function tambah_pengumuman(){
			cek_menu_akses('pengumuman',$this->session->id_session);
			if (isset($_POST['submit'])){
				$cek_judul=$this->model_app->view_where('pengumuman', array('tema' => $this->db->escape_str($this->input->post('a'))));
				if($cek_judul->num_rows()>0){
					redirect('administrator/tambah_pengumuman');
					}else{
					$data = array();
					$config['upload_path'] = 'asset/foto_pengumuman/';
					$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|pdf|PDF';
					$config['max_size'] = '100000'; // kb
					$config['detect_mime'] = TRUE;
					$config['file_ext_tolower'] = TRUE;
					$config['encrypt_name'] = TRUE;
					// $new_name = time().$_FILES["userfiles"]['name'];
					// $config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					$ex = explode(' - ',$this->input->post('f'));
					$exx = explode('/',$ex[0]);
					$exy = explode('/',$ex[1]);
					$mulai = $exx[2].'-'.$exx[0].'-'.$exx[1];
					$selesai = $exy[2].'-'.$exy[0].'-'.$exy[1];
					$lokasi_img	= $_FILES['c']['tmp_name'];
					$lokasi_pdf	= $_FILES['h']['tmp_name'];
					
					//
					if(empty($lokasi_img) AND empty($lokasi_pdf)){
						$nama_gbr = $this->input->post('co');
						$nama_file = $this->input->post('ho');
						}elseif(!empty($lokasi_img) AND empty($lokasi_pdf)){
						// script upload file pertama
						$this->upload->do_upload('c');
						$gbr = $this->upload->data();
						$nama_gbr = $gbr['file_name'];
						$nama_file = $this->input->post('ho');
						}elseif(empty($lokasi_img) AND !empty($lokasi_pdf)){
						// script uplaod file kedua
						$this->upload->do_upload('h');
						$file = $this->upload->data();
						$nama_gbr = $this->input->post('co');
						$nama_file = $file['file_name'];
						}else{
						// script upload file pertama
						$this->upload->do_upload('c');
						$gbr = $this->upload->data();
						$nama_gbr = $gbr['file_name'];
						// script uplaod file kedua
						$this->upload->do_upload('h');
						$file = $this->upload->data();
						$nama_file = $file['file_name'];
					}
					$data = array('tema'=>$this->db->escape_str($this->input->post('a')),
					'tema_seo'=>seo_title($this->input->post('a')),
					'isi_pengumuman'=>$this->input->post('b'),
					'tempat'=>$this->db->escape_str($this->input->post('d')),
					'pengirim'=>$this->db->escape_str($this->input->post('g')),
					'gambar'=>$nama_gbr,
					'nama_file'=>$nama_file,
					'tgl_mulai'=>$mulai,
					'tgl_selesai'=>$selesai,
					'tgl_posting'=>date('Y-m-d'),
					'jam'=>$this->db->escape_str($this->input->post('e')),
					'dibaca'=>'0',
					'username'=>$this->session->username);
					
					$this->model_app->insert('pengumuman',$data);
					redirect('administrator/pengumuman');
				}
				}else{
				$this->template->load('administrator/template','administrator/mod_pengumuman/view_pengumuman_tambah');
			}
		}
		
		function edit_pengumuman(){
			
			cek_menu_akses('pengumuman',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				
				$data = array();
				$config['upload_path'] = 'asset/foto_pengumuman/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|pdf|PDF';
				$config['max_size'] = '100000'; // kb
				$config['detect_mime'] = TRUE;
				$config['file_ext_tolower'] = TRUE;
				$config['encrypt_name'] = TRUE;
				// $new_name = time().$_FILES["userfiles"]['name'];
				// $config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$ex = explode(' - ',$this->input->post('f'));
				$exx = explode('/',$ex[0]);
				$exy = explode('/',$ex[1]);
				$mulai = $exx[2].'-'.$exx[0].'-'.$exx[1];
				$selesai = $exy[2].'-'.$exy[0].'-'.$exy[1];
				$lokasi_img	= $_FILES['c']['tmp_name'];
				$lokasi_pdf	= $_FILES['h']['tmp_name'];
				if(empty($lokasi_img) AND empty($lokasi_pdf)){
					$nama_gbr = $this->input->post('co');
					$nama_file = $this->input->post('ho');
					}elseif(!empty($lokasi_img) AND empty($lokasi_pdf)){
					$gambar="asset/foto_pengumuman/".$this->input->post('co');
					if(file_exists($gambar)){
						unlink($gambar);
					}
					// script upload file pertama
					$this->upload->do_upload('c');
					$gbr = $this->upload->data();
					$nama_gbr = $gbr['file_name'];
					$nama_file = $this->input->post('ho');
					
					}elseif(empty($lokasi_img) AND !empty($lokasi_pdf)){
					$gambar="asset/foto_pengumuman/".$this->input->post('ho');
					if(file_exists($gambar)){
						unlink($gambar);
					}
					// script uplaod file kedua
					$this->upload->do_upload('h');
					$file = $this->upload->data();
					$nama_gbr = $this->input->post('co');
					$nama_file = $file['file_name'];
					}else{
					$gbr_exist="asset/foto_pengumuman/".$this->input->post('co');
					if(file_exists($gbr_exist)){
						unlink($gbr_exist);
					}
					$file_exist="asset/foto_pengumuman/".$this->input->post('ho');
					if(file_exists($file_exist)){
						unlink($file_exist);
					}
					// script upload file pertama
					$this->upload->do_upload('c');
					$gbr = $this->upload->data();
					$nama_gbr = $gbr['file_name'];
					// script uplaod file kedua
					$this->upload->do_upload('h');
					$file = $this->upload->data();
					$nama_file = $file['file_name'];
				}
				
				$data = array('tema'=>$this->db->escape_str($this->input->post('a')),
				'tema_seo'=>seo_title($this->input->post('a')),
				'isi_pengumuman'=>$this->input->post('b'),
				'tempat'=>$this->db->escape_str($this->input->post('d')),
				'pengirim'=>$this->db->escape_str($this->input->post('g')),
				'gambar'=>$nama_gbr,
				'nama_file'=>$nama_file,
				'tgl_mulai'=>$mulai,
				'tgl_selesai'=>$selesai,
				'jam'=>$this->db->escape_str($this->input->post('e')));
				
				$where = array('id_pengumuman' => $this->input->post('id'));
				$this->model_app->update('pengumuman', $data, $where);
				redirect('administrator/pengumuman');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('pengumuman', array('id_pengumuman' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('pengumuman', array('id_pengumuman' => $id, 'username' => $this->session->username))->row_array();
				}
				
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_pengumuman/view_pengumuman_edit',$data);
			}
		}
		
		function delete_pengumuman(){
			cek_menu_akses('pengumuman',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_pengumuman' => $this->uri->segment(3));
				}else{
				$id = array('id_pengumuman' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$iddel = $this->uri->segment(3);
			$search=$this->model_app->view_where('pengumuman', array('id_pengumuman' => $iddel));
			if($search->num_rows()>0){
				$data=$search->row();
				$gambar="asset/foto_pengumuman/".$data->gambar;
				$file="asset/foto_pengumuman/".$data->nama_file;
				if(file_exists($gambar)){
					unlink($gambar);
				}
				if(file_exists($gambar)){
					unlink($file);
				}
				$this->model_app->delete('pengumuman',$id);
			}
			redirect('administrator/pengumuman');
		}
		
		
		
		
		
		
		
		
		// Controller Modul birokrasi
		
		function birokrasi(){
			cek_menu_akses('birokrasi',$this->session->id_session);
			if ($this->session->level=='admin'){
				$data['record'] = $this->model_app->view_ordering('birokrasi','id_birokrasi','DESC');
				}else{
				$data['record'] = $this->model_app->view_where_ordering('birokrasi',array('username'=>$this->session->username),'id_birokrasi','DESC');
			}
			$this->template->load('administrator/template','administrator/mod_birokrasi/view_birokrasi',$data);
		}
		
		function tambah_birokrasi(){
			cek_menu_akses('birokrasi',$this->session->id_session);
			if (isset($_POST['submit'])){
				$cek_judul=$this->model_app->view_where('birokrasi', array('tema' => $this->db->escape_str($this->input->post('a'))));
				if($cek_judul->num_rows()>0){
					redirect('administrator/tambah_birokrasi');
					}else{
					$data = array();
					$config['upload_path'] = 'asset/foto_birokrasi/';
					$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|pdf|PDF';
					$config['max_size'] = '100000'; // kb
					$config['detect_mime'] = TRUE;
					$config['file_ext_tolower'] = TRUE;
					$config['encrypt_name'] = TRUE;
					// $new_name = time().$_FILES["userfiles"]['name'];
					// $config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					$ex = explode(' - ',$this->input->post('f'));
					$exx = explode('/',$ex[0]);
					$exy = explode('/',$ex[1]);
					$mulai = $exx[2].'-'.$exx[0].'-'.$exx[1];
					$selesai = $exy[2].'-'.$exy[0].'-'.$exy[1];
					$lokasi_img	= $_FILES['c']['tmp_name'];
					$lokasi_pdf	= $_FILES['h']['tmp_name'];
					
					//
					if(empty($lokasi_img) AND empty($lokasi_pdf)){
						$nama_gbr = $this->input->post('co');
						$nama_file = $this->input->post('ho');
						}elseif(!empty($lokasi_img) AND empty($lokasi_pdf)){
						// script upload file pertama
						$this->upload->do_upload('c');
						$gbr = $this->upload->data();
						$nama_gbr = $gbr['file_name'];
						$nama_file = $this->input->post('ho');
						}elseif(empty($lokasi_img) AND !empty($lokasi_pdf)){
						// script uplaod file kedua
						$this->upload->do_upload('h');
						$file = $this->upload->data();
						$nama_gbr = $this->input->post('co');
						$nama_file = $file['file_name'];
						}else{
						// script upload file pertama
						$this->upload->do_upload('c');
						$gbr = $this->upload->data();
						$nama_gbr = $gbr['file_name'];
						// script uplaod file kedua
						$this->upload->do_upload('h');
						$file = $this->upload->data();
						$nama_file = $file['file_name'];
					}
					$data = array('tema'=>$this->db->escape_str($this->input->post('a')),
					'tema_seo'=>seo_title($this->input->post('a')),
					'isi_birokrasi'=>$this->input->post('b'),
					'tempat'=>$this->db->escape_str($this->input->post('d')),
					'pengirim'=>$this->db->escape_str($this->input->post('g')),
					'gambar'=>$nama_gbr,
					'nama_file'=>$nama_file,
					'tgl_mulai'=>$mulai,
					'tgl_selesai'=>$selesai,
					'tgl_posting'=>date('Y-m-d'),
					'jam'=>$this->db->escape_str($this->input->post('e')),
					'dibaca'=>'0',
					'username'=>$this->session->username);
					
					$this->model_app->insert('birokrasi',$data);
					redirect('administrator/birokrasi');
				}
				}else{
				$this->template->load('administrator/template','administrator/mod_birokrasi/view_birokrasi_tambah');
			}
		}
		
		function edit_birokrasi(){
			
			cek_menu_akses('birokrasi',$this->session->id_session);
			$id = $this->uri->segment(3);
			if (isset($_POST['submit'])){
				
				$data = array();
				$config['upload_path'] = 'asset/foto_birokrasi/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|pdf|PDF';
				$config['max_size'] = '100000'; // kb
				$config['detect_mime'] = TRUE;
				$config['file_ext_tolower'] = TRUE;
				$config['encrypt_name'] = TRUE;
				// $new_name = time().$_FILES["userfiles"]['name'];
				// $config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$ex = explode(' - ',$this->input->post('f'));
				$exx = explode('/',$ex[0]);
				$exy = explode('/',$ex[1]);
				$mulai = $exx[2].'-'.$exx[0].'-'.$exx[1];
				$selesai = $exy[2].'-'.$exy[0].'-'.$exy[1];
				$lokasi_img	= $_FILES['c']['tmp_name'];
				$lokasi_pdf	= $_FILES['h']['tmp_name'];
				if(empty($lokasi_img) AND empty($lokasi_pdf)){
					$nama_gbr = $this->input->post('co');
					$nama_file = $this->input->post('ho');
					}elseif(!empty($lokasi_img) AND empty($lokasi_pdf)){
					$gambar="asset/foto_birokrasi/".$this->input->post('co');
					if(file_exists($gambar)){
						unlink($gambar);
					}
					// script upload file pertama
					$this->upload->do_upload('c');
					$gbr = $this->upload->data();
					$nama_gbr = $gbr['file_name'];
					$nama_file = $this->input->post('ho');
					
					}elseif(empty($lokasi_img) AND !empty($lokasi_pdf)){
					$gambar="asset/foto_birokrasi/".$this->input->post('ho');
					if(file_exists($gambar)){
						unlink($gambar);
					}
					// script uplaod file kedua
					$this->upload->do_upload('h');
					$file = $this->upload->data();
					$nama_gbr = $this->input->post('co');
					$nama_file = $file['file_name'];
					}else{
					$gbr_exist="asset/foto_birokrasi/".$this->input->post('co');
					if(file_exists($gbr_exist)){
						unlink($gbr_exist);
					}
					$file_exist="asset/foto_birokrasi/".$this->input->post('ho');
					if(file_exists($file_exist)){
						unlink($file_exist);
					}
					// script upload file pertama
					$this->upload->do_upload('c');
					$gbr = $this->upload->data();
					$nama_gbr = $gbr['file_name'];
					// script uplaod file kedua
					$this->upload->do_upload('h');
					$file = $this->upload->data();
					$nama_file = $file['file_name'];
				}
				
				$data = array('tema'=>$this->db->escape_str($this->input->post('a')),
				'tema_seo'=>seo_title($this->input->post('a')),
				'isi_birokrasi'=>$this->input->post('b'),
				'tempat'=>$this->db->escape_str($this->input->post('d')),
				'pengirim'=>$this->db->escape_str($this->input->post('g')),
				'gambar'=>$nama_gbr,
				'nama_file'=>$nama_file,
				'tgl_mulai'=>$mulai,
				'tgl_selesai'=>$selesai,
				'jam'=>$this->db->escape_str($this->input->post('e')));
				
				$where = array('id_birokrasi' => $this->input->post('id'));
				$this->model_app->update('birokrasi', $data, $where);
				redirect('administrator/birokrasi');
				}else{
				if ($this->session->level=='admin'){
					$proses = $this->model_app->edit('birokrasi', array('id_birokrasi' => $id))->row_array();
					}else{
					$proses = $this->model_app->edit('birokrasi', array('id_birokrasi' => $id, 'username' => $this->session->username))->row_array();
				}
				
				$data = array('rows' => $proses);
				$this->template->load('administrator/template','administrator/mod_birokrasi/view_birokrasi_edit',$data);
			}
		}
		
		function delete_birokrasi(){
			cek_menu_akses('birokrasi',$this->session->id_session);
			if ($this->session->level=='admin'){
				$id = array('id_birokrasi' => $this->uri->segment(3));
				}else{
				$id = array('id_birokrasi' => $this->uri->segment(3), 'username'=>$this->session->username);
			}
			$iddel = $this->uri->segment(3);
			$search=$this->model_app->view_where('birokrasi', array('id_birokrasi' => $iddel));
			if($search->num_rows()>0){
				$data=$search->row();
				$gambar="asset/foto_birokrasi/".$data->gambar;
				$file="asset/foto_birokrasi/".$data->nama_file;
				if(file_exists($gambar)){
					unlink($gambar);
				}
				if(file_exists($gambar)){
					unlink($file);
				}
				$this->model_app->delete('birokrasi',$id);
			}
			redirect('administrator/birokrasi');
		}
		function get_data_album(){
			// cek_menu_akses('album',$this->session->id_session);
			$list = $this->User_model->get_datatables();
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {
				$no++;
				$edit = '<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-id="'.$field->id_album.'" data-target="#myModal">Edit</a>';
				$hapus = '<a href="javascript:void(0);" id="show_data" class="btn btn-danger btn-sm item_delete" data-album_code="'.$field->id_album.'">Delete</a>';
				$row = array();
				$row[] = $no;
				$row[] = $field->jdl_album;
				$row[] = $field->tgl_posting;
				$row[] = $field->aktif;
				$row[] = $edit;
				$row[] = $hapus;
				$data[] = $row;
			}
			
			$output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->User_model->count_all(),
            "recordsFiltered" => $this->User_model->count_filtered(),
            "data" => $data,
			);
			//output dalam format JSON
			echo json_encode($output);
		}
		function get_album(){
			cek_menu_akses('album',$this->session->id_session);
			$ida=$this->input->get('id');
			$data=$this->User_model->get_album_by_kode($ida);
			echo json_encode($data);
		}
		public function upload() {
			$config['upload_path'] = 'asset/files/';
            $config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
            $config['max_size'] = '100000'; // kb
            $this->load->library('upload', $config);
			
			
			$file_name = null;
			
			if ($this->upload->do_upload('userfile')) {
				$uploaded_file = $this->upload->data();
				$file_name = $uploaded_file['file_name'];
			}
			if ($file_name == "") {
				$file_name = 'listing-default.png';
				$data = array('id_kat_bankdata'=>$this->input->post('a'),
				'username'=>$this->session->username,
				'judul'=>$this->db->escape_str($this->input->post('d')),
				'judul_seo'=>seo_title($this->input->post('d')),
				'hari'=>hari_ini(date('w')),
				'tgl_posting'=>date('Y-m-d'),
				'jam'=>date('H:i:s'),
				'pub'=>$this->db->escape_str($this->input->post('pub')),
				'hits'=>'0');
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('result' => 0)));
				} else {
				$data = array('id_kat_bankdata'=>$this->input->post('a'),
				'username'=>$this->session->username,
				'judul'=>$this->db->escape_str($this->input->post('d')),
				'judul_seo'=>seo_title($this->input->post('d')),
				'nama_file'=>$file_name,
				'hari'=>hari_ini(date('w')),
				'tgl_posting'=>date('Y-m-d'),
				'jam'=>date('H:i:s'),
				'pub'=>$this->db->escape_str($this->input->post('pub')),
				'hits'=>'0');
				
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('result' => 1)));
				// redirect('administrator/bankdata');
			}
            $this->model_app->insert('bankdata',$data);
			// redirect('administrator/bankdata');
		}
		public function upload_edit() {
			$config['upload_path'] = 'asset/files/';
            $config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
            $config['max_size'] = '100000'; // kb
            $this->load->library('upload', $config);
			
			
			$file_name = null;
			
			if ($this->upload->do_upload('userfile')) {
				$uploaded_file = $this->upload->data();
				$file_name = $uploaded_file['file_name'];
			}
			if ($file_name == "") {
				$file_name = 'listing-default.png';
				$data = array('id_kat_bankdata'=>$this->input->post('a'),
				'judul'=>$this->db->escape_str($this->input->post('d')),
				'pub'=>$this->db->escape_str($this->input->post('pub')),
				'judul_seo'=>seo_title($this->input->post('c')));
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('result' => 0)));
				} else {
				$data = array('id_kat_bankdata'=>$this->input->post('a'),
				'judul'=>$this->db->escape_str($this->input->post('d')),
				'pub'=>$this->db->escape_str($this->input->post('pub')),
				'judul_seo'=>seo_title($this->input->post('c')),
				'nama_file'=>$file_name);
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('result' => 1)));
				// redirect('administrator/bankdata');
			}
			$where = array('id_bankdata' => $this->input->post('id'));
            $this->model_app->update('bankdata', $data, $where);
			// redirect('administrator/bankdata');
		}
		public function upload_refbirokrasi() {
			$config['upload_path'] = 'asset/files/';
            $config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
            $config['max_size'] = '100000'; // kb
            $this->load->library('upload', $config);
			
			
			$file_name = null;
			
			if ($this->upload->do_upload('userfile')) {
				$uploaded_file = $this->upload->data();
				$file_name = $uploaded_file['file_name'];
			}
			if ($file_name == "") {
				$file_name = 'listing-default.png';
				$data = array('id_kat_refbirokrasi'=>$this->input->post('a'),
				'username'=>$this->session->username,
				'judul'=>$this->db->escape_str($this->input->post('d')),
				'judul_seo'=>seo_title($this->input->post('d')),
				'hari'=>hari_ini(date('w')),
				'tgl_posting'=>date('Y-m-d'),
				'jam'=>date('H:i:s'),
				'pub'=>$this->db->escape_str($this->input->post('pub')),
				'hits'=>'0');
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('result' => 0)));
				} else {
				$data = array('id_kat_refbirokrasi'=>$this->input->post('a'),
				'username'=>$this->session->username,
				'judul'=>$this->db->escape_str($this->input->post('d')),
				'judul_seo'=>seo_title($this->input->post('d')),
				'nama_file'=>$file_name,
				'hari'=>hari_ini(date('w')),
				'tgl_posting'=>date('Y-m-d'),
				'jam'=>date('H:i:s'),
				'pub'=>$this->db->escape_str($this->input->post('pub')),
				'hits'=>'0');
				
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('result' => 1)));
				// redirect('administrator/bankdata');
			}
            $this->model_app->insert('refbirokrasi',$data);
			// redirect('administrator/bankdata');
		}
		
		public function upload_editrefbirokrasi() {
			$config['upload_path'] = 'asset/files/';
            $config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
            $config['max_size'] = '100000'; // kb
            $this->load->library('upload', $config);
			
			
			$file_name = null;
			
			if ($this->upload->do_upload('userfile')) {
				$uploaded_file = $this->upload->data();
				$file_name = $uploaded_file['file_name'];
			}
			if ($file_name == "") {
				$file_name = 'listing-default.png';
				$data = array('id_kat_refbirokrasi'=>$this->input->post('a'),
				'judul'=>$this->db->escape_str($this->input->post('d')),
				'pub'=>$this->db->escape_str($this->input->post('pub')),
				'judul_seo'=>seo_title($this->input->post('c')));
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('result' => 0)));
				} else {
				$data = array('id_kat_refbirokrasi'=>$this->input->post('a'),
				'judul'=>$this->db->escape_str($this->input->post('d')),
				'pub'=>$this->db->escape_str($this->input->post('pub')),
				'judul_seo'=>seo_title($this->input->post('c')),
				'nama_file'=>$file_name);
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('result' => 1)));
				// redirect('administrator/bankdata');
			}
			$where = array('id_refbirokrasi' => $this->input->post('id'));
            $this->model_app->update('refbirokrasi', $data, $where);
			// redirect('administrator/bankdata');
		}
		public function chart() {
			$this->template->load('administrator/template','administrator/mod_chart/view_chart');
		}
		function grafikperiode(){
			$grupby = $this->input->get('grupby', TRUE);
			$startdate = $this->input->get('startdate', TRUE);
			$enddate = $this->input->get('enddate', TRUE);
			$start = date_slash($startdate);
			$end = date_slash($enddate);
			// echo formatthn($start);
			$queryc = sprintf("SELECT 
			DATE(`statistik`.`tanggal`) AS tanggal,
			MONTH(`statistik`.`tanggal`) AS bulan,
			YEAR(`statistik`.`tanggal`) AS tahun,
			count(*) AS `Totals`
			FROM
			`statistik`
			WHERE  `tanggal` BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE)
			GROUP BY $grupby");
			$grafik =  $this->db->query($queryc);
			$jum = 0;
			$bln=array(1=> "Jan", "Feb", "Mar", "Apr", "Mei", 
			"Jun", "Jul", "Agust", "Sept", 
			"Okt", "Nov", "Dec");
			foreach ($grafik->result_array() as $row){
				$jum = $jum + $row['Totals'];
				if($grupby=='tanggal'){
					$periode = tglPesan($start).' - '.tglPesan($end);
					}elseif($grupby=='bulan'){
					$periode = $bln[$row['bulan']];
					}else{
					$periode = $row['tahun'];
				}
				$data[]=array(
				'jml'=>$row['Totals'],
				'tanggal'=>datechart($row['tanggal']).' ' .$bln[$row['bulan']] .' ' .formatthn($row['tahun']),
				'bulan'=>$bln[$row['bulan']]. ' ' .$row['tahun'],
				'tahun'=>$row['tahun']
				);	
			}
			$data1=array('jml'=>0,'tanggal'=>'Batas','bulan'=>'Batas','tahun'=>'Batas','periode'=>$periode);	
			array_push($data,$data1);
			print json_encode($data);
		}
		function grafik_perperiode(){
			$tgl = date("Y-m-d");
			$bln = date("m");
			$thn = date("Y");
			$tanggal_pinjam = $thn.'-'.$bln.'-01';
			$tgp = new DateTime($tanggal_pinjam);
			$tgk = new DateTime($tgl);
			$durasi = $tgk->diff($tgp);
			$limit = $durasi->days;
			$grafik =  $this->db->query("SELECT count(*) as Totals, DATE(`tanggal`) AS tgl,
			MONTH(`tanggal`) AS bulan,
			YEAR(`tanggal`) AS tahun FROM statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT $limit");
			// $data = array();
			$jum = 0;
			$bln=array(1=> "Jan", "Feb", "Mar", "Apr", "Mei", 
			"Jun", "Jul", "Agust", "Sept", 
			"Okt", "Nov", "Dec");
			foreach ($grafik->result_array() as $row){
				
				// $jum = $jum + $row['Totals'];
				$data[]=array(
				'jml'=>$row['Totals'],
				'tanggal'=>datechart($row['tgl']).' ' .$bln[$row['bulan']] .' ' .formatthn($row['tahun']),
				'bulan'=>$bln[$row['bulan']]. ' ' .$row['tahun'],
				'tahun'=>$row['tahun'], 
				);	
			}
			print json_encode($data);
		}
		//end
	}
?>