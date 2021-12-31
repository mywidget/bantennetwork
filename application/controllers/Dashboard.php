<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Dashboard extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('date');
        }
        
        public function index()
        {
            //headline 1 row
            $where1 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','`posting`.`status`' => '2'];
            $where2 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','`posting`.`status`' => '2'];
            $where3 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','`posting`.`status`' => '2'];
            $where4 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y'];
            $where5 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','`posting`.`status`' => '2'];
            $tanggal = date('Y-m-d H:i:s');
            
            $data = [
            'title'=>tag_key('site_title'),
            'description' => tag_key('site_desc'),
            'keywords' => tag_key('site_keys'),
            'canonical'=>base_url(),
            'url_image'=>base_url('assets/thumb.jpg'),
            'publisher'=>sosmed_single('FB'),
            'headline1'=>$this->model_app->view_join_where('posting','cat','id_cat',$where1,'tanggal','DESC',0,1),
            'headline2'=>$this->model_app->view_join_where('posting','cat','id_cat',$where2,'tanggal','desc',1,5),
            'terkini'=>$this->model_app->view_join_where('posting','cat','id_cat',$where5,'tanggal','desc',0,10),
            ];
            
            $data['json'] =[
            "@context" => "https://schema.org",
            "@type" =>  "Organization",
            "name" =>  tag_key('site_name'),
            "url" =>  tag_key('site_url'),
            "sameAs" => sosmed()];
            
            $this->template->load(template().'/themes',template().'/content',$data);
        }
    }                    