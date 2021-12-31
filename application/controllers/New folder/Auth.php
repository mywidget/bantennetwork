<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Auth extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            $data['title'] = 'Daftar';
            $data['description'] = 'description';
            $data['keywords'] = 'keywords';
            
            $google_client = new Google_Client();
            $google_client->setClientId('527145062514-21nc4gbubb83ckqnij6vl3b3i63mfhe3.apps.googleusercontent.com'); //masukkan ClientID anda 
            $google_client->setClientSecret('9DUj8Av1C_YLfilNFH54y9d2'); //masukkan Client Secret Key anda
            $google_client->setRedirectUri('https://'.$_SERVER['HTTP_HOST'].'/auth/'); //Masukkan Redirect Uri anda
            $google_client->addScope('email');
            $google_client->addScope('profile');
            
            $login_button = '';
            if(isset($_GET["code"]))
            {
                $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
                if(!isset($token["error"]))
                {
                    $google_client->setAccessToken($token['access_token']);
                    $this->session->set_userdata('access_token', $token['access_token']);
                    $google_service = new Google_Service_Oauth2($google_client);
                    $arrdata = $google_service->userinfo->get();
                    $current_datetime = date('Y-m-d H:i:s');
                    
                    $result = $this->db->query("SELECT * FROM gtbl_user WHERE email='".$arrdata['email']."'");
                    if($result->num_rows() > 0) {
                        $row= $result->row_array();
                        if($row['aktif']=='N'){
                            session_destroy();
                            exit("<center>Maaf sedang di blokir <a href='/'>Kembali</a></center>");
                            }else{
                            $user_data = array(
                            'g_user'    =>$row['username'],
                            'g_lengkap' =>$row['nama_lengkap'],
                            'g_image' 	=>$row['profile_image'],
                            'g_email'   =>$row['email'],
                            'g_pass'    =>$row['password'],
                            'g_sessid'  =>$row['id_session'],
                            'g_level'   =>$row['level'],
                            'g_secret'  =>$row['app_secret'],
                            'g_id'      =>$row['id_user'],
                            'go_id'     =>$row['google_id'],
                            'upload_image_file_manager'=>true
                            );
                            $this->session->set_userdata($user_data);
                            redirect('main');
                        }
                        }else{
                        $this->session->unset_userdata('access_token');
                        $this->session->unset_userdata('user_data');
                        echo "<center>Maaf email belum terdaftar <a href='/portal'>Kembali</a></center>";
                    }
                }
                
                // if(!$this->session->userdata('access_token'))
                // {
                // // redirect('portal');
                // }
                // else
                // {
                // // redirect('main');
                // }
                
                }else{
                echo "gagal";
            }
            if($this->session->userdata('user_data'))
            {
                redirect('main');
            }
        }
    }            