<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Berita extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
			cek_session_login();
			$this->perPage = 10;
			$this->title =  pengaturan('site_title');
            $this->description =  pengaturan('site_desc');
            $this->keywords =  pengaturan('site_keys');
			$this->iduser = $this->session->g_id; 
			$this->level = $this->session->g_level; 
		}
        
        public function post()
		{
			$data['title']       = 'Data berita | '.$this->title;
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			$seo = $this->uri->segment(3);
			
			//query list berita
			if(empty($seo))
			{
				if($this->level!='admin'){	
					$conditions['where'] = array(
					'id_publisher' => $this->iduser
					);
				}
				
				$conditions['returnType'] = 'count';
				$totalRec = $this->model_data->getBlog($conditions);
				
				// Pagination configuration 
				$config['target']      = '#posts_content';
				$config['base_url']    = base_url('berita/ajaxBlog');
				$config['total_rows']  = $totalRec;
				$config['per_page']    = $this->perPage;
				$config['link_func']   = 'searchFilter';
				
				// Initialize pagination library 
				$this->ajax_pagination->initialize($config);
				
				// Get records 
				$conditions = array(
				'limit' => $this->perPage
				);
				
				$data['kategori'] = $this->model_app->view_where('cat',['pub'=>'Y'])->result();
				$data['posts']    = $this->model_data->getBlog($conditions);
				
				$this->template->load(backend().'/themes',backend().'/list-berita',$data);
				//add post
				}elseif($seo      =='addpost'){
				$data['kategori'] = $this->model_app->view('cat')->result();
				$data['label']    = $this->model_app->view('label')->result();
				$data['author']   = $this->model_app->view('gtbl_user')->result();
				$data['tanggal']  = date('Y-m-d');
				$data['jam']      = date('H:i');
				$this->template->load(backend().'/themes',backend().'/form-berita',$data);
				//edit post
				}elseif($seo      =='editpost'){
				$getid            = decrypt_url($this->uri->segment(4));
				$data['kategori'] = $this->model_app->view('cat')->result_array();
				$data['author']   = $this->model_app->view('gtbl_user')->result();
				$data['label']    = $this->model_app->view('label')->result();
				$data['post']     = $this->model_app->view_where('posting',['id_post'=>$getid])->row();
				$this->template->load(backend().'/themes',backend().'/formedit-berita',$data);
			}
		}
		
		function ajaxBlog()
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
			$cat = $this->input->post('cat');
			
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_publisher' => $this->iduser
				);
			}
			
			// Get record count 
			$conditions['returnType'] = 'count';
			$totalRec = $this->model_data->getBlog($conditions);
			
			// Pagination configuration 
			$config['target']      = '#posts_content';
			$config['base_url']    = base_url('berita/ajaxBlog');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $this->perPage;
			$config['link_func']   = 'searchFilter';
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config);
			
			// Get records 
			$conditions['start'] = $offset;
			$conditions['limit'] = $this->perPage;
			
			//sort berdasarkan rubrik
			if (!empty($cat)) {
				$conditions['where'] = array(
				'posting.id_cat' => $cat
				);
			}
			
			unset($conditions['returnType']);
			$data['offset'] = $offset;
			$data['posts'] = $this->model_data->getBlog($conditions);
			
			// Load the data list view 
			$this->load->view(backend() . '/ajax/ajax-blog', $data, false);
		}
		
		//query update berita
		public function update_blog()
		{
			//dekript id berita
			$id     = decrypt_url($this->input->post('id',TRUE));
			$file   = $this->input->post('img_del',TRUE);
			
			
			$youtube   = $this->input->post('youtube',TRUE);
			//jika id youutbe kosong
			if($youtube=='https://www.youtube.com/watch?v='){
				$youtube   = '';
			}
			
			//post rubrik
			$id_cat    = $this->input->post('cat',TRUE);
			
			//post tag array
			$tag    = $this->input->post('tag',TRUE);
			
			if(!empty($tag)){
				$tag=implode(',',$tag);
			}
			//post tanggal
			$tanggal = $this->input->post('tanggal',TRUE);
			//post jam
			$jam     = $this->input->post('jam',TRUE);
			//gabung tanggal dan jam
			$date    = $tanggal.' '.$jam;
			//folder berdasarkan tahun
			$tahun   = folderthn($tanggal);
			//folder berdasarkan bulan
			$bulan   = folderbln($tanggal);
			//buat jika folder tidak ada
			if (!is_dir('assets/post/'.$tahun.'/'.$bulan)) {
				mkdir('./assets/post/' . $tahun.'/'.$bulan, 0777, TRUE);
			}
			$fileExt = pathinfo($_FILES["input_img"]["name"], PATHINFO_EXTENSION);
			$newName = slugify($this->input->post('judul',TRUE)).'.'.$fileExt; 
			
			//confih upload
			$config['upload_path']   = './assets/post/'.$tahun.'/'.$bulan; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg'; //type yang image yang dizinkan
			$config['max_size']		 = 2048;
			$config['encrypt_name']  = FALSE; //enkripsi nama file
			$config['file_name']  = $newName; //enkripsi nama file
			
			$this->upload->initialize($config);
			
			//jika id kosong lakukan update
			if($id > 0){
				//update jika file di ganti
				if(!empty($_FILES['input_img']['name']))
				{
					if ($this->upload->do_upload('input_img'))
					{
						$cek = $this->model_app->view_where('posting', ['id_post'=>$id]);
						if($cek->num_rows() > 0)
						{
							
							
							$gambar = FCPATH.'assets/post/'.$tahun.'/'.$bulan.'/'.$file;
							if(file_exists($gambar)){
								@unlink('./assets/post/'.$tahun.'/'.$bulan.'/'.$file);
								@unlink('./assets/post/'.$tahun.'/'.$bulan.'/341x200_'.$file);
								@unlink('./assets/post/'.$tahun.'/'.$bulan.'/681x400_'.$file);
								@unlink('./assets/post/'.$tahun.'/'.$bulan.'/864x467_'.$file);
							}
							$gbr             = $this->upload->data();
							//Compress Image
							$data            = [
							'id_cat'         => $id_cat,
							'id_publisher'   => $this->input->post('author',TRUE),
							'judul'          => $this->input->post('judul',TRUE),
							'judul_seo'      => slugify($this->input->post('judul',TRUE)),
							'publish'        => $this->input->post('pub',TRUE),
							'postingan'      => $this->input->post('summernote',FALSE),
							'kata_kunci'	 => $tag,
							'deskripsi'		 => $this->input->post('deskripsi',TRUE),
							'status'         => $this->input->post('status',TRUE),
							'tanggal'        => $date,
							'folder'         => $date,
							'dateModified'	 => date('Y-m-d H:i:s'),
							'gambar'         => $newName,
							'caption'        => $this->input->post('caption',TRUE),
							'tag'            => $tag,
							'youtube'        => $youtube,
							'durasi'         => $this->input->post('durasi',TRUE),
							'dibaca'         => $this->input->post('dibaca',TRUE),
							];
							
							$update = $this->model_app->update('posting', $data, ['id_post'=>$id]);
							if($update['status']=='ok')
							{
								$this->session->set_flashdata('message', "update");
								$this->_create_thumbs($tahun,$bulan,$newName);
								redirect('berita/post');
								}else{
								redirect('berita/post/editpost/'.$this->input->post('id',TRUE));
							}
							}else{
						}
						}else{
						echo $this->upload->display_errors();
					}
					//udate jika tidak file tidak di ganti
					}else{
					//array data dan post requet
					$data            = [
					'id_cat'         => $id_cat,
					'id_publisher'   => $this->input->post('author',TRUE),
					'judul'          => $this->input->post('judul',TRUE),
					'judul_seo'      => slugify($this->input->post('judul',TRUE)),
					'publish'        => $this->input->post('pub',TRUE),
					'postingan'      => $this->input->post('summernote',FALSE),
					'status'         => $this->input->post('status',TRUE),
					'tanggal'        => $date,
					'dateModified'	 => date('Y-m-d H:i:s'),
					'caption'        => $this->input->post('caption',TRUE),
					'kata_kunci'	 => $tag,
					'deskripsi'		 => $this->input->post('deskripsi',TRUE),
					'tag'            => $tag,
					'youtube'        => $youtube,
					'durasi'         => $this->input->post('durasi',TRUE),
					'dibaca'         => $this->input->post('dibaca',TRUE),
					];
					//query update
					$update = $this->model_app->update('posting', $data, ['id_post'=>$id]);
					if($update['status']=='ok')
					{
						$this->session->set_flashdata('message', "update");
						redirect('berita/post');
						}else{
						redirect('berita/post/editpost/'.$this->input->post('id',TRUE));
					}
				}
				}else{
				//insert
				
				$deskripsi 		= getFirstPar($this->input->post('deskripsi',TRUE));
				if(empty($deskripsi)){
					$getPar 	= getFirstPar($this->input->post('summernote',TRUE));
					$deskripsi 	= cleanString($getPar);
				}
				
				if(!empty($_FILES['input_img']['name']))
				{
					if ($this->upload->do_upload('input_img'))
					{
						 
						$gbr             = $this->upload->data();
						$data            = [
						'id_cat'         => $id_cat,
						'id_publisher'   => $this->input->post('author',TRUE),
						'judul'          => $this->input->post('judul',TRUE),
						'judul_seo'      => slugify($this->input->post('judul',TRUE)),
						'publish'        => $this->input->post('pub',TRUE),
						'postingan'      => $this->input->post('summernote',FALSE),
						'status'         => $this->input->post('status',TRUE),
						'tanggal'        => $date,
						'folder'         => $date,
						'dateModified'	 => date('Y-m-d H:i:s'),
						'gambar'         => $newName,
						'caption'        => $this->input->post('caption',TRUE),
						'kata_kunci'	 => $tag,
						'deskripsi'		 => $deskripsi,
						'tag'            => $tag,
						'youtube'        => $youtube,
						'durasi'         => $this->input->post('durasi',TRUE),
						'dibaca'         => $this->input->post('dibaca',TRUE),
						];
						
						$insert = $this->model_app->input('posting', $data);
						if($insert['status']=='ok')
						{
							$this->session->set_flashdata('message', "insert");
							$this->_create_thumbs($tahun,$bulan,$newName);
							redirect('berita/post');
							}else{
							redirect('berita/post/addpost');
						}
						}else{
						echo $this->upload->display_errors();
					}
					
					}else{
					$data            = [
					'id_cat'         => $id_cat,
					'id_publisher'   => $this->input->post('author',TRUE),
					'judul'          => $this->input->post('judul',TRUE),
					'judul_seo'      => slugify($this->input->post('judul',TRUE)),
					'publish'        => $this->input->post('pub',TRUE),
					'postingan'      => $this->input->post('summernote',FALSE),
					'status'         => $this->input->post('status',TRUE),
					'tanggal'        => $date,
					'folder'         => $date,
					'dateModified'	 => date('Y-m-d H:i:s'),
					'caption'        => $this->input->post('caption',TRUE),
					'kata_kunci'	 => $tag,
					'deskripsi'		 => $deskripsi,
					'tag'            => $tag,
					'youtube'        => $youtube,
					'durasi'         => $this->input->post('durasi',TRUE),
					'dibaca'         => $this->input->post('dibaca',TRUE),
					];
					
					$insert = $this->model_app->input('posting', $data);
					if($insert['status']=='ok')
					{
						$this->session->set_flashdata('message', "insert");
						redirect('berita/post');
						}else{
						redirect('berita/post/addpost');
					}
				}
			}
		}
		public function update_page()
		{
			$id     = decrypt_url($this->input->post('id',TRUE));
			$file   = $this->input->post('img_del',TRUE);
			$isi_page   = $this->input->post('summernote',FALSE);
			
			$config['upload_path']   = './assets/page'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg'; //type yang image yang dizinkan
			$config['encrypt_name']  = TRUE; //enkripsi nama file
			
			$this->upload->initialize($config);
			//update halaman
			if($id > 0){
				if(!empty($_FILES['input_img']['name']))
				{
					if ($this->upload->do_upload('input_img'))
					{
						$cek = $this->model_app->view_where('page', ['id_page'=>$id]);
						if($cek->num_rows() > 0)
						{
							$gambar = FCPATH.'assets/page/'.$file;
							if(file_exists($gambar)){
								@unlink('./assets/page/'.$file);
							}
							
							$gbr = $this->upload->data();
							
							$data       = [
							'judul'     => $this->input->post('judul',TRUE),
							'judul_seo' => slugify($this->input->post('judul',TRUE)),
							'isi'       => $isi_page,
							'pub'       => $this->input->post('pub',TRUE),
							'status'    => $this->input->post('status',TRUE),
							'photo'    	=> $gbr['file_name']
							];
							
							$update = $this->model_app->update('page', $data, ['id_page'=>$id]);
							if($update['status']=='ok')
							{
								$this->_create_thumbs_page($gbr['file_name']);
								redirect('berita/page');
								}else{
								redirect('berita/page');
							}
							}else{
							redirect('berita/page/addpost');
						}
						}else{
						echo $this->upload->display_errors();
					}
					}else{
					
					$data       = [
					'judul'     => $this->input->post('judul',TRUE),
					'judul_seo' => slugify($this->input->post('judul',TRUE)),
					'isi'       => $isi_page,
					'pub'       => $this->input->post('pub',TRUE),
					'status'    => $this->input->post('status',TRUE)
					];
					
					$update = $this->model_app->update('page', $data, ['id_page'=>$id]);
					if($update['status']=='ok')
					{
						$this->_create_thumbs_page($gbr['file_name']);
						redirect('berita/page');
						}else{
						redirect('berita/page');
					}
				}
				}else{
				//insert
				if(!empty($_FILES['input_img']['name']))
				{
					if ($this->upload->do_upload('input_img'))
					{
						$gbr             = $this->upload->data();
						$data       = [
						'judul'     => $this->input->post('judul',TRUE),
						'judul_seo' => slugify($this->input->post('judul',TRUE)),
						'isi'       => $isi_page,
						'pub'       => $this->input->post('pub',TRUE),
						'status'    => $this->input->post('status',TRUE),
						'photo'    	=> $gbr['file_name']
						];
						
						$insert = $this->model_app->input('page', $data);
						if($insert['status']=='ok')
						{
							$this->_create_thumbs_page($gbr['file_name']);
							redirect('berita/page');
							}else{
							redirect('berita/page/addpost');
						}
						}else{
						echo $this->upload->display_errors();
					}
					
					}else{
					echo "image kosong atau type image tidak sesuai";
					redirect('berita/page/addpost');
				}
			}
		}
		function _create_thumbs($tahun,$bulan,$file_name){
			// Image resizing config
			$config = array(
			// Image Large
			array(
			'image_library' => 'GD2',
			'source_image'  => './assets/post/'.$tahun.'/'.$bulan.'/'.$file_name,
			'maintain_ratio'=> FALSE,
			'width'         => 684,
			'height'        => 467,
			'new_image'     => './assets/post/'.$tahun.'/'.$bulan.'/864x467_'.$file_name
			),
			// image Medium
			array(
			'image_library' => 'GD2',
			'source_image'  => './assets/post/'.$tahun.'/'.$bulan.'/'.$file_name,
			'maintain_ratio'=> FALSE,
			'width'         => 681,
			'height'        => 400,
			'new_image'     => './assets/post/'.$tahun.'/'.$bulan.'/681x400_'.$file_name
			),
			// Image Small
			array(
			'image_library' => 'GD2',
			'source_image'  => './assets/post/'.$tahun.'/'.$bulan.'/'.$file_name,
			'maintain_ratio'=> FALSE,
			'width'         => 340,
			'height'        => 220,
			'new_image'     => './assets/post/'.$tahun.'/'.$bulan.'/341x200_'.$file_name
			));
			
			$this->load->library('image_lib', $config[0]);
			foreach ($config as $item){
				$this->image_lib->initialize($item);
				if(!$this->image_lib->resize())
				{
					return false;
				}
				$this->image_lib->clear();
			}
		}
		function _create_thumbs_page($file_name){
			// Image resizing config
			$config = array(
			// Image Large
			array(
			'image_library' => 'GD2',
			'source_image'  => './assets/page/'.$file_name,
			'maintain_ratio'=> FALSE,
			'width'         => 800,
			'height'        => 600
			));
			
			$this->load->library('image_lib', $config[0]);
			foreach ($config as $item){
				$this->image_lib->initialize($item);
				if(!$this->image_lib->resize())
				{
					return false;
				}
				$this->image_lib->clear();
			}
		}
		public function deletepost()
		{
			
			// $id = decrypt_url($this->uri->segment(3));
			$id = decrypt_url($this->input->post('id',TRUE));
			$file = $this->input->post('file',TRUE);
			
			$cek = $this->model_app->view_where('posting', ['id_post'=>$id]);
			if($cek->num_rows() > 0)
			{
				$row = $cek->row();
				$folderthn = folderthn($row->tanggal);
				$folderbln = folderbln($row->tanggal);
				$delete = $this->model_app->hapus('posting', ['id_post'=>$id]);
				if($delete['status']=='ok')
				{
					@unlink('./assets/post/'.$folderthn.'/'.$folderbln.'/'.$file);
					@unlink('./assets/post/'.$folderthn.'/'.$folderbln.'/316x177_'.$file);
					@unlink('./assets/post/'.$folderthn.'/'.$folderbln.'/600x400_'.$file);
					@unlink('./assets/post/'.$folderthn.'/'.$folderbln.'/1300x670_'.$file);
					$arr = ['status'=>'ok'];
					}else{
					$arr = ['status'=>'error'];
				}
				}else{
				$arr = ['status'=>'error'];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		public function kategori()
		{
			// echo $this->uri->segment(1);
			cek_menu_akses();
			$data['title']       = 'Kategori Berita';
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			$data['hakakses']    = $this->model_app->view_where('hak_akses',['publish'=>'Y'])->result_array();
			$data['kategori']    = $this->model_app->view_where_ordering('cat',['pub'=>'Y'],'urutan','ASC')->result();
			$this->template->load(backend().'/themes',backend().'/kategori',$data);
		}
		public function save_menu(){
			
			$type    = $this->input->get('type', TRUE);
			$id      = $this->input->get('id', TRUE);('id');
			$label   = $this->input->get('label', TRUE);
			$link    = slugify($this->input->get('link', TRUE));
			$eclass  = $this->input->get('eclass', TRUE);
			$aktif   = $this->input->get('aktif', TRUE);
			$submenu = $this->input->get('submenu', TRUE);
			
			///
			if($type=='simpan'){
				if($id != ''){
					$this->db->query("update cat set nama_kategori = '".$label."', kategori_seo  = '".$link."', css_class  = '".$eclass."', pub  = '".$aktif."', mods  = '".$submenu."'  where id_cat= '".$id."' ");
					
					$arr['type']     = 'edit';
					$arr['label']    = $label;
					$arr['link']     = $link;
					$arr['eclass']   = $eclass;
					$arr['aktif']    = $aktif;
					$arr['submenu']  = $submenu;
					$arr['id']       = $id;
					
					} else {
					
					$row = $this->db->query("SELECT max(urutan)+1 as urutan FROM cat")->row_array();
					$qry = $this->db->query("insert into cat (nama_kategori,kategori_seo,css_class,pub,mods,urutan) values ('".$label."', '".$link."', '".$eclass."', '".$aktif."','".$submenu."','".$row['urutan']."')");
					if($qry){
						$arr['ok']       = 'ok';
						$lastid          = $this->db->insert_id();
						$resultz         = $this->db->query("SELECT id_cat FROM cat");
						foreach ($resultz->result_array() as $rowz){
							$ids_array[] = $rowz['id_cat'];
						}
						$data = implode(",",$ids_array);
						$arr['menu'] = '<li class="dd-item dd3-item" data-id="'.$lastid.'" >
						<div class="dd-handle dd3-handle"></div>
						<div class="ns-row">
						<div class="ns-title" id="label_show'.$lastid.'">'.$label.'</div>
						<div class="ns-url" id="link_show'.$lastid.'">'.$link.'</div> 
						<div class="ns-class" id="eclass_show'.$lastid.'">'.$eclass.'</div>
						<div class="ns-actions">
						<a class="edit-button" id="'.$lastid.'" label="'.$label.'" link="'.$link.'" eclass="'.$eclass.'"><i class="fa fa-pencil"></i></a>
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
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		public function crud(){
			
			$type     = $this->input->get('type', TRUE);
			$gdata    = $this->input->get('data', TRUE);
			$id       = $this->input->get('id', TRUE);('id');
			$label    = $this->input->get('label', TRUE);
			$link     = slugify($this->input->get('link', TRUE));
			$eclass   = $this->input->get('eclass', TRUE);
			$treeview = $this->input->get('parentc', TRUE);
			$aktif    = $this->input->get('aktif', TRUE);
			$submenu  = $this->input->get('submenu', TRUE);
			
			if($type=='get'){
				$data 	= array();
				$return = $this->db->query("SELECT * FROM cat WHERE id_cat='".$id."'")->row_array();	
				$data 	= array(
				'id'      => $return['id_cat'],
				'label'   => $return['nama_kategori'],
				'link'    => $return['kategori_seo'],
				'eclass'  => $return['css_class'],
				'aktif'   => $return['pub'],
				'submenu' => $return['mods']
				);	
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
				
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
					$qry = $this->db->query("update cat set id_parent = '".$row['parentID']."', urutan='$i' where id_cat= '".$row['id']."' ");
					$i++;
				}
				
				}elseif($type=='hapus'){
				function recursiveDelete($id) {
					$ci      = & get_instance();
					$data    = array('hapus'=>'hapus');
					$query   = $ci->db->query("select * from cat where id_parent = '".$id."' ");
					if ($query->num_rows >0) {
						foreach ($query->result_array() as $current){
							recursiveDelete($current['idmenu']);
						}
					}
					$qry = $ci->db->query("delete from cat where id_cat= '".$id."' ");
					if($qry){
						$data = array('ok'=>'ok');;
						}else{
						$data = array('ok'=>'error');;
					}
					$this->output
					->set_content_type('application/json')
					->set_output(json_encode($data));
					
				}
				recursiveDelete($id);
			}
		}
		public function tag()
		{
			$res = $this->db->query("SELECT tag FROM `posting`");
			$TampungData = array();
			foreach($res->result_array() AS $data_tags){
				$tags = explode(',',strtolower(trim($data_tags['tag'])));
				if(empty($data_tags['tag'])){echo'';}else{
					foreach($tags as $val) {
						$TampungData[] = $val;
					}
				}
			}
			$totalTags = count($TampungData);
			$jumlah_tag = array_count_values($TampungData);
			ksort($jumlah_tag);
			if ($totalTags > 0) {
				$output = array();
				foreach($jumlah_tag as $key=>$val) {
					// $output[] = '<option value="'.$key.'">'.$key.'</options>';
					$output[] = array("id"=>$key,"name"=>$key);
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($output));
			
		}
		public function cari_tag(){
			$id  = $this->input->post('id',TRUE);
			$tag = $this->input->post('tag',TRUE);
			$exp = explode(",",$tag);
			foreach ($exp as  $row)
			{
				$data[] = array("id"=>$row,"name"=>$row);
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function post_tag(){
			$tag = $this->input->post('tag',TRUE);
			// $tag = implode(",",$tag);
			$arr = array();
			if(!empty($tag)){
				foreach($tag as $val){
					$slug = slugify($val);
					$cek = $this->model_app->view_where('tag',['tag_seo'=>$slug]);
					if($cek->num_rows() == 0){
						$insert = $this->model_app->input('tag', ['nama_tag'=>$val,'tag_seo'=>$slug]);
						if($insert['status']=='ok')
						{
							$arr = ['status'=>'ok'];
							}else{
							$arr = ['status'=>'error'];
						}
					}
				}
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		public function page()
		{
			$data['title']       = 'Page | '.$this->title;
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			$seo = $this->uri->segment(3);
			if(empty($seo)){
				$data['posts'] =  $this->model_app->view('page')->result_array();
				$this->template->load(backend().'/themes',backend().'/list-page',$data);
				
				//add
				}elseif($seo      =='addpost'){
				$data['author']   = $this->model_app->view('gtbl_user')->result();
				$data['tanggal']  = date('Y-m-d');
				$data['jam']      = date('H:i');
				$this->template->load(backend().'/themes',backend().'/form-add-page',$data);
				//edit
				}elseif($seo      =='editpost'){
				$getid            = decrypt_url($this->uri->segment(4));
				$data['post']     = $this->model_app->view_where('page',['id_page'=>$getid])->row();
				$this->template->load(backend().'/themes',backend().'/form-edit-page',$data);
			}
			
		}
		public function deletepage()
		{
			
			// $id = decrypt_url($this->uri->segment(3));
			$id = decrypt_url($this->input->post('id',TRUE));
			$file = $this->input->post('file',TRUE);
			
			$cek = $this->model_app->view_where('page', ['id_page'=>$id]);
			if($cek->num_rows() > 0)
			{
				$row = $cek->row();
				$delete = $this->model_app->hapus('page', ['id_page'=>$id]);
				if($delete['status']=='ok')
				{
					@unlink('./assets/page/'.$file);
					$arr = ['status'=>'ok'];
					}else{
					$arr = ['status'=>'error'];
				}
				}else{
				$arr = ['status'=>'error'];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
	}																			