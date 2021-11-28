<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Master extends CI_Controller {
		function __construct(){
			parent::__construct();
			// $this->output->cache(1); 
			$this->perPage = 10;
            $this->iduser = $this->session->g_id; 
            cek_session_login();
			}
		
		function member(){
			$data['title']      = 'Member | Kalkulatorcetak.com';
            $data['description'] = 'description';
            $data['keywords']    = 'keywords';
            
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
            // $conditions['where'] = array(
            // 'parent' => $this->iduser
            // );
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
            
            // $conditions['where'] = array(
            // 'parent' => $this->iduser
            // );
			// $sWhere = "WHERE level='owner' AND parent='$iduser' OR level='marketing' AND parent='$iduser'";
            unset($conditions['returnType']);
            $data['posts'] = $this->model_data->getPengguna($conditions);
            
            
            // Load the data list view 
            $this->load->view(backend() . '/ajax/ajax-member', $data, false);
		}
		function modul(){
			$data['title']       = 'Modul | Kalkulatorcetak.com';
            $data['description'] = 'description';
            $data['keywords']    = 'keywords';
            
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getModul($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('master/ajaxModul');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchModul';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions = array(
            'limit' => $this->perPage
            );
            
            $data['posts'] = $this->model_data->getModul($conditions);
			$this->template->load(backend().'/themes',backend().'/modul',$data);
		}
		function ajaxModul()
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
			
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getModul($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('master/ajaxModul');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchModul';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            
            unset($conditions['returnType']);
            $data['posts'] = $this->model_data->getModul($conditions);
            
            
            // Load the data list view 
            $this->load->view(backend() . '/ajax/ajax-modul', $data, false);
		}
		function crud_modul()
		{
			$type = $this->input->post('type',TRUE);
			$ID = $this->input->post('id');
			$perpage = $this->input->post('perpage',TRUE);
			$cari = $this->input->post('cari',TRUE);
			if($type=='get')
			{
				$SQL = $this->model_app->edit('modul',['ID'=>$ID]);
				$return = $SQL->row_array();
				$arr = array(
				'id' => $return['ID'],
				'nama' => $return['nama_modul'],
				'ket' => $return['ket'],
				'tag' => $return['tag_mod'],
				'slug' => $return['slug'],
				'embed' => $return['embed'],
				'embed2' => $return['embed2'],
				'classn' => $return['className'],
				'warna' => $return['warna'],
				'pub' => $return['publish']
				);	
			}
			elseif($type=='edit')
			{
				
				$data = array(
				'nama_modul' => $this->input->post('nama'),
				'ket'        => $this->input->post('ket'),
				'tag_mod'    => $this->input->post('tag'),
				'slug'       => $this->input->post('slug'),
				'embed'      => $this->input->post('embed1'),
				'embed2'     => $this->input->post('embed2'),
				'className'  => $this->input->post('pupup'),
				'warna'      => $this->input->post('warna'),
				'publish'    => $this->input->post('pub')
				);	
				$update = $this->model_app->update('modul',$data, ['ID'=>$ID]);
				if($update['status']=='ok')
				{
					$arr =[
					'status'=>200,
					'perpage'=>$perpage,
					'cari'=>$cari,
					'title' =>'Update data',
					'msg'   =>'Data berhasil diupdate'];
				}
				else
				{
					$arr =[
					'status'=>201,
					'perpage'=>$perpage,
					'cari'=>$cari,
					'title' =>'Update data',
					'msg'   =>'Data gagal diupdate'];
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		function aplikasi(){
			$data['title']       = 'Aplikasi | Kalkulatorcetak.com';
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			$this->template->load(backend().'/themes',backend().'/404',$data);
		}
		
		function edit_member($id=""){
			$index = decrypt_url($id);
			$data['arr'] = $this->model_app->edit('gtbl_user', ['id_user'=>$index])->row();
			$this->load->view(backend() . '/form-edit-member', $data, false);
		}
		
		function simpan_pengguna(){
			$postid 	= decrypt_url($this->input->post('id',TRUE));
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
            "aktif"	        => $this->input->post('aktif',TRUE)
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
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($arr));
		}	
	}
?>