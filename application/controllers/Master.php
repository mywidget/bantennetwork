<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Master extends CI_Controller {
		function __construct(){
			parent::__construct();
			// $this->output->cache(1); 
			$this->perPage = 10;
            $this->iduser = $this->session->g_id; 
            $this->level = $this->session->g_level; 
            cek_session_login();
		}
		
		function pengguna(){
			$data['title']      = 'Pengguna | '.tag_key('site_name');
            $data['description'] = 'description';
            $data['keywords']    = 'keywords';
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
            $cekUser = cekUser($this->iduser);
            $data['lv'] = $cekUser['lv'];
            $data['id_level'] = $cekUser['idlv'];
            $data['idmenu'] = $cekUser['idmenu'];
            // Get record count 
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
            $data['posts'] = $this->model_data->getPengguna($conditions);
            
            $this->template->load(backend() . '/themes', backend() . '/member', $data);
		}
		function ajaxMember()
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
            $config['base_url']    = base_url('akun/ajaxMember');
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
            $this->load->view(backend() . '/ajax/ajax-member', $data, false);
		}
		
		function edit_member($id=""){
			$index = decrypt_url($id);
			$data['arr'] = $this->model_app->edit('gtbl_user', ['id_user'=>$index])->row();
			$this->load->view(backend() . '/form-edit-member', $data, false);
		}
		function simpan_pengguna(){
			$type = $this->input->post('type',TRUE);
			$query = $this->db->get_where('hak_akses',['id_level'=>$this->input->post('id_level',TRUE)]);
			$row = $query->row_array();
			if($type=='new'){
				$data ='';
				if(!empty($this->input->post('data',TRUE))){
					$data_cat	= $this->input->post('data',TRUE);
					$data		= implode(',',$data_cat);
				}
				$query = $this->model_app->view_where('gtbl_user',['email'=>$this->input->post('mail',TRUE)]);
				if($query->num_rows() > 0){
					$arr = [
					'status'=>201,
					'title' =>'Input data',
					'msg'   =>'Data sudah ada'
					];
					}else{
					
					
					if($this->input->post('password',TRUE))
					{
						$password = password_hash($this->input->post('password',TRUE), PASSWORD_DEFAULT);
						$data_post 	= [
						"nama_lengkap"	=> $this->input->post('title',TRUE),
						"password"	    => $password,
						"alamat"	    => $this->input->post('alamat',TRUE),
						"email"	        => $this->input->post('mail',TRUE),
						"no_hp"	        => $this->input->post('phone',TRUE),
						"tgl_daftar"	=> $this->input->post('daftar',TRUE),
						"aktif"	        => $this->input->post('aktif',TRUE),
						"level"	    	=> $row['level'],
						"parent"	    => $this->iduser,
						"idlevel"	    => '2,3,4,5,6',
						"id_level"	    => $this->input->post('id_level',TRUE),
						"idmenu"	    => $data
						];
					}
					else
					{
						$data_post 	= [
						"nama_lengkap"	=> $this->input->post('title',TRUE),
						"alamat"	    => $this->input->post('alamat',TRUE),
						"email"	        => $this->input->post('mail',TRUE),
						"no_hp"	        => $this->input->post('phone',TRUE),
						"tgl_daftar"	=> $this->input->post('daftar',TRUE),
						"aktif"	        => $this->input->post('aktif',TRUE),
						"level"	    	=> $row['level'],
						"idlevel"	    => '2,3,4,5,6',
						"parent"	    => $this->iduser,
						"id_level"	    => $this->input->post('id_level',TRUE),
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
					"alamat"	    => $this->input->post('alamat',TRUE),
					"email"	        => $this->input->post('mail',TRUE),
					"no_hp"	        => $this->input->post('phone',TRUE),
					"tgl_daftar"	=> $this->input->post('daftar',TRUE),
					"aktif"	        => $this->input->post('aktif',TRUE),
					"level"	    	=> $row['level'],
					"id_level"	    => $this->input->post('id_level',TRUE),
					"idmenu"	    => $data
					];
				}
				else
				{
					$data_post 	= [
					"nama_lengkap"	=> $this->input->post('title',TRUE),
					"alamat"	    => $this->input->post('alamat',TRUE),
					"email"	        => $this->input->post('mail',TRUE),
					"no_hp"	        => $this->input->post('phone',TRUE),
					"tgl_daftar"	=> $this->input->post('daftar',TRUE),
					"aktif"	        => $this->input->post('aktif',TRUE),
					"level"	    	=> $row['level'],
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
				if($type==''){
					$arr = [
					'status'=>201,
					'title' =>'Input data',
					'msg'   =>'Data gagal'
					];
				}
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($arr));
		}	
		public function deletepost()
		{
			
			// $id = decrypt_url($this->uri->segment(3));
			$id = decrypt_url($this->input->post('id',TRUE));
			$cek_posting = cek_posting($id);
			if($cek_posting===false){
				$cek = $this->model_app->view_where('gtbl_user', ['id_user'=>$id]);
				if($cek->num_rows() > 0)
				{
					$row = $cek->row();
					if($row->level!='admin'){
						$delete = $this->model_app->hapus('gtbl_user', ['id_user'=>$id]);
						if($delete['status']=='ok')
						{
							$arr = ['status'=>'ok','id'=>$cek_posting];
							}else{
							$arr = ['status'=>'error'];
						}
						}else{
						$arr = ['status'=>'error_delete','id'=>$cek_posting];
					}
					}else{
					$arr = ['status'=>'error'];
				}
				
				}else{
				$arr = ['status'=>'error_delete','id'=>$cek_posting];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		
	}
?>