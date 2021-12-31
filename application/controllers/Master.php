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