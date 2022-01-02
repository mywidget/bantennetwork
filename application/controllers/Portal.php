<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Portal extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->helper('string');
		}
		function index(){
			$data['login_button'] = '';
			// echo json_encode($this->session->userdata('access_token')); 
			if (isset($_POST['submit'])){
				$data['title'] = 'Administrator &rsaquo; Log In';
				$data['sub_1'] = '<h3>Masuk dengan</h3>';
				$data['sub_2'] = '<p>Atau gunakan akun detail</p>';
				$data['error'] = '';
				$data['none'] = '';
				$data['show'] = 'display:none';
				$email_user = $this->input->post('user_email');
				$password = $this->input->post('user_password');
				$cek = $this->model_app->cek_user($email_user);
				$total = $cek->num_rows();
				if ($total > 0){
					$row = $cek->row_array();
					$hash = $row['password'];
					if (password_verify($password, $hash)) {
						$user_data = array(
						'g_user'    =>$row['username'],
						'g_lengkap' =>$row['nama_lengkap'],
						'g_image' 	=>$row['profile_image'],
						'g_email'   =>$row['email'],
						'g_pass'    =>$row['password'],
						'g_sessid'  =>$row['id_session'],
						'g_level'   =>$row['level'],
						'g_id'      =>$row['id_user'],
						'go_id'     =>$row['google_id'],
						'random_filemanager_key' =>session_id(),
						'upload_image_file_manager'=>true
						);
						$this->session->set_userdata($user_data);
						$none = "display:none";
						$show = "";
						redirect('main');
						}else{
						echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Username atau Password Salah!!</center></div>');
						$data['title'] = 'Username atau Password salah!';
						$this->load->view('themes/admin/login', $data);
					}
					}else{
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Username atau Password Salah!!</center></div>');
					$data['title'] = 'username salah atau akun anda sedang diblokir';
					$data['username'] = $password;
					$this->load->view('themes/admin/login', $data);
				}
				}else{
				
				if(isset($this->session->g_email))
				{
					redirect('main');
					}else{
					$data['title'] = 'Administrator &rsaquo; Log In';
					$data['title'] = 'Administrator &rsaquo; Log In';
					$data['sub_1'] = '<h3>Login Akun</h3>';
					$data['sub_2'] = '';
					$data['error'] = '';
					$data['none'] = '';
					$data['show'] = 'display:none';
					
					$data['setting'] = ["site_name"  =>pengaturan('site_name'),
					"site_url" =>pengaturan('site_url'),
					"site_title" =>pengaturan('site_title'),
					"site_keys" =>pengaturan('site_keys'),
					"site_desc" =>pengaturan('site_desc'),
					"site_company" =>pengaturan('site_company'),
					"site_favicon" =>pengaturan('site_favicon'),
					"site_logo" =>pengaturan('site_logo')
					];
					
					$this->load->view('themes/admin/login', $data);
				}
			}
		}
		function lupa_password(){
			$data['title'] = 'Lupa sandi';
			$this->load->view('themes/admin/lupa_sandi', $data);
		}
	}
?>