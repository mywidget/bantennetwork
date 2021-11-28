<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Portal extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->helper('string');
		}
		function index(){
			$google_client = new Google_Client();
            $google_client->setClientId('527145062514-21nc4gbubb83ckqnij6vl3b3i63mfhe3.apps.googleusercontent.com'); //masukkan ClientID anda 
            $google_client->setClientSecret('9DUj8Av1C_YLfilNFH54y9d2'); //masukkan Client Secret Key anda
            $google_client->setRedirectUri('https://'.$_SERVER['HTTP_HOST'].'/auth/'); //Masukkan Redirect Uri anda
			$google_client->addScope('email');
            $google_client->addScope('profile');
			$login_button = '<a href="'.$google_client->createAuthUrl().'" class="btn mb-1 font-medium-4 border-danger"><i class="icon-google text-danger"></i><span class="px-1 text-danger">google</span> </a>';
			$data['login_button'] = $login_button;
			// echo json_encode($this->session->userdata('access_token')); 
			if (isset($_POST['submit'])){
				$data['title'] = 'Administrator &rsaquo; Log In';
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
					$data['error'] = '';
					$data['none'] = '';
					$data['show'] = 'display:none';
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