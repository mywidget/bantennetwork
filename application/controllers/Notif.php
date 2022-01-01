<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Notif extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
             cek_session_login();
            $this->iduser = $this->session->g_id; 
        }
        
        
        public function notifadm()
        {
            $key = $this->input->post('key',TRUE);
            if($key=='admin')
            {
                $search = $this->model_app->hitung('gtbl_user',array('level'=>'admin','verify'=>1));
                if($search > 0){
                    $data = ['status'=>200,'count'=>$search];
                    }else{
                    $data = ['status'=>201,'count'=>0];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
            }
            if($key=='user')
            {
                $search = $this->model_app->hitung('gtbl_user',array('level'=>'user','verify'=>1));
                if($search > 0){
                    $data = ['status'=>200,'count'=>$search];
                    }else{
                    $data = ['status'=>201,'count'=>0];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
            }
            if($key=='berita')
            {
                $search = $this->model_app->hitung('posting',array('id_publisher'=>$this->iduser,'publish'=>'Y'));
                if($search > 0){
                    $data = ['status'=>200,'count'=>$search];
                    }else{
                    $data = ['status'=>201,'count'=>0];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
            }
            if($key=='rubrik')
            {
                $search = $this->model_app->hitung('cat',array('pub'=>'Y'));
                if($search > 0){
                    $data = ['status'=>200,'count'=>$search];
                    }else{
                    $data = ['status'=>201,'count'=>0];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
            }
        }
        
    }                                            