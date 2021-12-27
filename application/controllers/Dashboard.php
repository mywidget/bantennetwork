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
            $where1 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','`posting`.`status`' => '1'];
            //headlin 
            $where2 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y'];
            $where3 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','`posting`.`status`' => '2'];
            $where4 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y'];
            $where5 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','`posting`.`status`' => '3'];
            $tanggal = date('Y-m-d H:i:s');
            $data = [
            'title'=>'Berita Terkini, Berita Hari Ini Banten dan Indonesia - Lenteranews.tv',
            'description' => tag_key('site_desc'),
            'keywords' => tag_key('site_keys'),
            'canonical'=>base_url(),
            'url_image'=>base_url('assets/thumb.jpg'),
            'json'=>[
            "@context" => "https://schema.org",
            "@type" =>  "Organization",
            "name" =>  "Lentera News",
            "url" =>  "https://www.lenternews.tv",
            "sameAs" => [
            "https://www.facebook.com/Lenternews",
            "https://twitter.com/Lenternews",
            "https://www.youtube.com/user/Lenternews",
            "https://www.pinterest.com/Lenternews/"
            ]
            ],
            'headline1'=>$this->model_app->view_join_where('posting','cat','id_cat',$where1,'tanggal','desc',1),
            'headline2'=>$this->model_app->view_join_where('posting','cat','id_cat',$where2,'tanggal','desc',2),
            'headline3'=>$this->model_app->view_join_where('posting','cat','id_cat',$where3,'tanggal','desc',3),
            'populer'=>$this->model_app->view_join_where('posting','cat','id_cat',$where5,'tanggal','desc',3),
            // 'artikel'=>$this->model_app->view_join_where('posting','cat','id_cat',['kategori_seo'=>'artikel'],'tanggal','desc',3),
            'artikel'=>$this->model_app->getPosting(8,['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'publish'=>'Y'],'tanggal','desc',3),
            'pilihan'=>$this->model_app->view_join_where('posting','cat','id_cat',['posting.tanggal < NOW()','status'=>3],'tanggal','desc',1),
            'video'=>$this->model_app->view_join_where('posting','cat','id_cat',['posting.tanggal < NOW()','TIME(durasi)!='=>'00:00:00'],'tanggal','desc',4),
            // 'program'=>$this->model_app->view_join_where('posting','cat','id_cat',['TIME(durasi)='=>'00:00:00','kategori_seo'=>'program'],'tanggal','desc',5)
            'program'=>$this->model_app->getPosting(3,['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'publish'=>'Y','TIME(durasi)='=>'00:00:00'],'tanggal','desc',5)
            ];
           
            $this->template->load(template().'/themes',template().'/content',$data);
        }
    }                