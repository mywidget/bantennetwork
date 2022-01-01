<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Akun extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->perPage = 5;
            $this->tabel = 'data_';
            $this->mod = '_get';
            $this->iduser = $this->session->g_id; 
            cek_session_login();
            // $this->appconfig = appconfig();
        }
        
        
        public function profil()
        {
            $data['title']       = 'Profil |' .tag_key('site_name');
            $data['description'] = 'description';
            $data['keywords']    = 'keywords';
            $data['module']      = $this->uri->segment(2);
            $data['user']        = CekMailUser($this->session->g_email);
            $this->template->load(backend() . '/themes', backend() . '/profil', $data);
        }
        public function crud_profil()
        {
            $arr = ['error'];
            if ($this->input->post('type') == 'owner') {
                if ($this->input->post('img_url') == '') {
                    $data = [
                    'no_hp' => $this->input->post('no_hp'),
                    'nama_lengkap'   => $this->input->post('nama'),
                    'alamat'         => $this->input->post('alamat'),
                    ];
                    } else {
                    $data = [
                    'no_hp' => $this->input->post('no_hp'),
                    'nama_lengkap'   => $this->input->post('nama'),
                    'profile_image'  => $this->input->post('img_url'),
                    'alamat'         => $this->input->post('alamat'),
                    ];
                }
                $update = $this->model_app->update('gtbl_user', $data, array('id_user' => $this->session->g_id));
                if ($update['status'] == 'ok') {
                    $arr = [
                    'status' => 200,
                    'no_hp' => $this->input->post('no_hp'),
                    'nama_lengkap' => $this->input->post('nama'),
                    'profile_image' => $this->input->post('img_url'),
                    'alamat' => $this->input->post('alamat')
                    ];
                    } else {
                    $arr = ['status' => 404];
                }
            }
            if ($this->input->post('type') == 'marketing') {
                if ($this->input->post('img_url') == '') {
                    $data = [
                    'no_hp' => $this->input->post('no_hp'),
                    'nama_lengkap'   => $this->input->post('nama')
                    ];
                    } else {
                    $data = [
                    'no_hp' => $this->input->post('no_hp'),
                    'nama_lengkap'   => $this->input->post('nama'),
                    'profile_image'  => $this->input->post('img_url')
                    ];
                }
                
                $update = $this->model_app->update('gtbl_user', $data, array('id_user' => $this->session->g_id));
                if ($update['status'] == 'ok') {
                    $arr = [
                    'status' => 200, 'no_hp' => $_POST['no_hp'],
                    'nama_lengkap' => $_POST['nama'],
                    'profile_image' => $_POST['img_url']
                    ];
                    } else {
                    $arr = ['status' => 404];
                }
            }
            if ($this->input->post('type') == 'ganti') {
                $password = password_hash($this->input->post('pass2'), PASSWORD_DEFAULT);
                $update = $this->model_app->update('gtbl_user', array('password' => $password), array('id_user' => $this->session->g_id));
                if ($update['status'] == 'ok') {
                    $arr = ['status' => 200];
                    } else {
                    $arr = ['status' => 404];
                }
            }
            if ($this->input->post('type') == 'uplogo') {
                $arr = array('profit' => $this->input->post('profit'), 'logo' => $this->input->post('logo'));
                $where = array('id_user' => $this->session->g_id);
                $update = $this->model_app->update('gtbl_user', $arr, $where);
                if ($update['status'] == 'ok') {
                    $arr = ['status' => 200];
                    } else {
                    $arr = ['status' => 404];
                }
            }
            echo json_encode($arr, JSON_UNESCAPED_SLASHES);
        }
        public function crud()
        {
            $seo = $this->uri->segment(3);
            $type = $this->input->post('type',TRUE);
            $view = $this->input->post('view',TRUE);
            $tabel = $this->tabel.$view;
            // echo $tabel;
            //get
            if($type=='get')
            {
                $getid = decrypt_url($this->input->post('id',TRUE));
                $index = decrypt_url($this->input->post('index',TRUE));
                $modul = $view.$this->mod;
                // print_r($modul);
                $token = $this->security->get_csrf_hash();
                $where = array('tabel'=>$tabel,'getid'=>$getid,'index'=>$index,'iduser'=>$this->iduser,'token'=>$token);
                $data = $this->model_aplikasi->$modul($where);
                echo json_encode($data);
            }
           
                
                $data = tag_modul($exp);
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
                
            }
        public function pengguna()
        {
            $data['title']      = 'Pengguna';
            $data['description'] = 'description';
            $data['keywords']    = 'keywords';
            
            // $data = array();
            $cekUser = cekUser($this->iduser);
            $data['lv'] = $cekUser['lv'];
            $data['id_level'] = $cekUser['idlv'];
            $data['idmenu'] = $cekUser['idmenu'];
            // Get record count 
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPengguna($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('akun/ajaxPengguna');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchFilter';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions = array(
            'limit' => $this->perPage
            );
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
            
            $data['posts'] = $this->model_data->getPengguna($conditions);
            
            $this->template->load(backend() . '/themes', backend() . '/pengguna', $data);
        }
        function ajaxPengguna()
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
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPengguna($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('akun/ajaxPengguna');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchFilter';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
            // $sWhere = "WHERE level='owner' AND parent='$iduser' OR level='marketing' AND parent='$iduser'";
            unset($conditions['returnType']);
            $data['posts'] = $this->model_data->getPengguna($conditions);
            
            
            // Load the data list view 
            $this->load->view(backend() . '/ajax/ajax-pengguna', $data, false);
        }
        public function load_data()
        {
            $getid   = decrypt_url($this->input->post('id',TRUE));
            $get_data = $this->model_app->view_where('gtbl_user',['id_user'=>$getid])->result_array();
            $data = [
            "id"                 => encrypt_url($get_data[0]['id_user']),
            "title"              => $get_data[0]['nama_lengkap'],
            "mail"               => $get_data[0]['email'],
            "phone"              => $get_data[0]['no_hp'],
            "tgldaftar"          => tanggal($get_data[0]['tgl_daftar']),
            "aktif"            => $get_data[0]['aktif'],
            ];
            // print_r($array);
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
        }
        function simpan_pengguna(){
			$type 		= $this->input->post('type',TRUE);
			if($type=='new'){
				$data ='';
				if(!empty($this->input->post('data',TRUE))){
					$data_cat	= $this->input->post('data',TRUE);
					$data		= implode(',',$data_cat);
				}
				$query = $this->db->get_where('hak_akses',['id_level'=>$this->input->post('id_level',TRUE)]);
				$row = $query->row_array();
				if($this->input->post('password',TRUE))
				{
					$password = password_hash($this->input->post('password',TRUE), PASSWORD_DEFAULT);
					$data_post 	= [
					"nama_lengkap"	=> $this->input->post('title',TRUE),
					"password"	    => $password,
					"email"	        => $this->input->post('mail',TRUE),
					"no_hp"	        => $this->input->post('phone',TRUE),
					"tgl_daftar"	=> $this->input->post('daftar',TRUE),
					"aktif"	        => $this->input->post('aktif',TRUE),
					"level"	    	=> $row['level'],
					"id_level"	    => $this->input->post('id_level',TRUE),
					"parent"	    => $this->iduser,
					"idmenu"	    => $data
					];
				}
				else
				{
					$data_post 	= [
					"nama_lengkap"	=> $this->input->post('title',TRUE),
					"email"	        => $this->input->post('mail',TRUE),
					"no_hp"	        => $this->input->post('phone',TRUE),
					"tgl_daftar"	=> $this->input->post('daftar',TRUE),
					"aktif"	        => $this->input->post('aktif',TRUE),
					"level"	    	=> $row['level'],
					"id_level"	    => $this->input->post('id_level',TRUE),
					"parent"	    => $this->iduser,
					"idmenu"	    => $data
					];
				}
				$insert = $this->model_app->input('gtbl_user',$data_post);
				if($insert['status']=='ok')
				{
					$arr = [
					'status'=>200,
					'title' =>'Input data',
					'msg'   =>'Data berhasil Input'
					];
				}
				else
				{
					$arr = [
					'status'=>201,
					'title' =>'Input data',
					'msg'   =>'Data gagal Input'
					];
				}
			}
			if($type=='edit'){
				$postid 	= decrypt_url($this->input->post('id',TRUE));
				$data ='';
				$query = $this->db->get_where('hak_akses',['id_level'=>$this->input->post('id_level',TRUE)]);
				$row = $query->row_array();
				if(!empty($this->input->post('data',TRUE))){
					$data_cat	= $this->input->post('data',TRUE);
					$data		= implode(',',$data_cat);
				}
				if($this->input->post('password',TRUE))
				{
					$password = password_hash($this->input->post('password',TRUE), PASSWORD_DEFAULT);
					$data_post 	= [
					"nama_lengkap"	=> $this->input->post('title',TRUE),
					"password"	    => $password,
					"email"	        => $this->input->post('mail',TRUE),
					"no_hp"	        => $this->input->post('phone',TRUE),
					"tgl_daftar"	=> $this->input->post('daftar',TRUE),
					"aktif"	        => $this->input->post('aktif',TRUE),
					"level"	    	=> $row['level'],
					"idlevel"	    => '2,3,4',
					"id_level"	    => $this->input->post('id_level',TRUE),
					"idmenu"	    => $data
					];
				}
				else
				{
					$data_post 	= [
					"nama_lengkap"	=> $this->input->post('title',TRUE),
					"email"	        => $this->input->post('mail',TRUE),
					"no_hp"	        => $this->input->post('phone',TRUE),
					"tgl_daftar"	=> $this->input->post('daftar',TRUE),
					"aktif"	        => $this->input->post('aktif',TRUE),
					"level"	    	=> $row['level'],
					"idlevel"	    => '2,3,4',
					"id_level"	    => $this->input->post('id_level',TRUE),
					"idmenu"	    => $data
					];
				}
				
				$update = $this->model_app->update('gtbl_user',$data_post, ['id_user'=>$postid]);
				if($update['status']=='ok')
				{
					$arr = [
					'status'=>200,
					'title' =>'Update data',
					'msg'   =>'Data berhasil diupdate'
					];
				}
				else
				{
					$arr = [
					'status'=>201,
					'title' =>'Update data',
					'msg'   =>'Data gagal diupdate'
					];
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
    }                                                                                                                                                                                          