<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Info extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            cek_session_login();
            $this->title =  pengaturan('site_title');
            $this->description =  pengaturan('site_desc');
            $this->keywords =  pengaturan('site_keys');
        }
        
        
        
        public function website()
        {
            $data['title']          = 'Pengaturan | '.$this->title;
            $data['description']    = $this->description;
            $data['keywords']       = $this->keywords;
            $data['module']         = $this->uri->segment(2);
            $data['setting']        = ["site_name"  =>pengaturan('site_name'),
            "site_url" =>pengaturan('site_url'),
            "site_title" =>pengaturan('site_title'),
            "site_keys" =>pengaturan('site_keys'),
            "site_desc" =>pengaturan('site_desc'),
            "site_company" =>pengaturan('site_company'),
            "site_favicon" =>pengaturan('site_favicon'),
            "site_logo" =>pengaturan('site_logo')
            ];
            $this->template->load(backend() . '/themes', backend() . '/website', $data);
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
        public function uploadLogo(){
            extract($this->input->post());
            // echo $input_name;
            // print_r($_POST);exit();
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'jpg|jpeg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['encrypt_name']         = TRUE; //enkripsi nama file
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('input_logo'))
            {
                $error = array('error' => $this->upload->display_errors());
                $nama_file = "";
            }
            else
            {
                $cek = $this->model_app->view_where('setting', ["name"=>"site_logo"]);
                if($cek->num_rows() > 0)
                {
                    $row = $cek->row_array();
                    $gambar = FCPATH.'uploads/'.$row['value'];
                    if(file_exists($gambar)){
                        @unlink('./uploads/'.$row['value']);
                    }
                    }else{
                    $arr = ["status"=>404,"name"=>"error request"];
                }
                $filedata =  $this->upload->data();
                $nama_file = $filedata['file_name'];
                $data=["value"=>$nama_file];
            }
            $response=$this->model_app->update("setting", $data, ["name"=>"site_logo"]);
            if($response["status"]=="ok"){
                $arr = ["status"=>200,"name"=>$nama_file,"msg"=>$gambar];
                }else{
                $arr = ["status"=>404,"name"=>$nama_file,"msg"=>"error"];
            }
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($arr)); 
        }
    }            