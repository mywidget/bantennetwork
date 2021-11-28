<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Program extends CI_Controller {
		
		function __construct() { 
			parent::__construct(); 
			// Per page limit 
			$this->load->library('ajax_paging'); 
			$this->perPage = 10; 
		} 
		public function index()
		{
			$data['title'] = 'Program | lenternews.tv';
            $data['description'] = tag_key('site_desc');
			$data['keywords'] = tag_key('site_desc');
			$data['canonical']=base_url();
            $data['url_image'] = base_url('assets/thumb.jpg');
			
			$data['json']=[
            "@context" => "https://schema.org",
            "@type" =>  "Organization",
            "name" =>  "Lentera News",
            "url" =>  "https://www.lenternews.tv/program",
            "sameAs" => [
            "https://www.facebook.com/Lenternews",
            "https://twitter.com/Lenternews",
            "https://www.youtube.com/user/Lenternews",
            "https://www.pinterest.com/Lenternews/"
            ]
            ];
			$seo = $this->uri->segment(1);
			$qry = $this->db->query("SELECT * FROM `cat` where kategori_seo='$seo' AND pub='Y'");
			if($qry->num_rows()){
				$query = $qry->row_array();
				$where = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','`posting`.`status`' => '2','kategori_seo'=>$seo];
				$where2 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','kategori_seo'=>$seo];
				$where3 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','kategori_seo'=>'artikel'];
				$where1 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','posting.id_cat'=>$query['id_cat'],'`posting`.`status`' => '1'];
				$where4 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','posting.id_cat'=>$query['id_cat'],'`posting`.`status`' => '4'];
				$data['title'] = $query['nama_kategori'].' | Lenteranews';
				$data['description'] = tag_key('site_desc');
				$data['keywords'] = tag_key('site_desc');
				$data['canonical']=base_url('program');
				$data['url_image'] = base_url('assets/thumb.jpg');
				$data['berita'] =  $this->model_app->view_join_where('posting','cat','id_cat',$where,'tanggal','desc',5);
				$data['terbaru'] =  $this->model_app->view_join_where('posting','cat','id_cat',$where2,'tanggal','desc',8);
				$data['artikel'] = $this->model_app->view_join_where('posting','cat','id_cat',$where3,'tanggal','desc',3);
				$data['populer'] = $this->model_app->view_join_where('posting','cat','id_cat',$where4,'tanggal','desc',3);
				$data['sorotan'] = $this->model_app->view_join_where('posting','cat','id_cat',$where1,'tanggal','desc',3);
				$data['program'] =  $this->model_app->view_join_where('posting','cat','id_cat',['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'youtube is NOT NULL'=>NULL,'kategori_seo'=>'program'],'tanggal','desc',5);
				$data['pilihan'] =  $this->model_app->view_join_where('posting','cat','id_cat',['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'status'=>3],'tanggal','desc',5);
				$data['kategori'] =  $query['nama_kategori'];
				$data['seo'] =  $seo;
				$data['json']=[
				"@context" => "https://schema.org",
				"@type" =>  "Organization",
				"name" =>  "LENTERANEWS.TV",
				"url" =>  base_url($seo),
				"sameAs" => [
				"https://www.facebook.com/Lenternews",
				"https://twitter.com/Lenternews",
				"https://www.youtube.com/user/Lenternews"
				]
				];
				//start
				
				// Get record count 
				$conditions['returnType'] = 'count'; 
				$conditions['where'] = array(
				'kategori_seo' => $seo,
				'posting.tanggal <' => mdate("%Y-%m-%d %H:%i:%s")
				);
				$totalRec = $this->model_data->getProgram($conditions); 
				
				// Pagination configuration 
				$config['target']      = '#dataList'; 
				$config['base_url']    = base_url('program/programPagination/'); 
				$config['total_rows']  = $totalRec; 
				$config['per_page']    = $this->perPage; 
				
				// Initialize pagination library 
				$this->ajax_paging->initialize($config); 
				
				// Get records 
				$conditions = array( 
				'limit' => $this->perPage 
				); 
				$conditions['where'] = array(
				'kategori_seo' => 'program',
				'posting.tanggal <' => mdate("%Y-%m-%d %H:%i:%s")
				);
				$data['posts'] = $this->model_data->getProgram($conditions); 
				//end
				$this->template->load(template().'/themes',template().'/program',$data);
				}else{
				$data = error_page();
				$this->template->load(template().'/themes',template().'/404',$data);
			}
		}
		function programPagination(){ 
			// Define offset 
			$page = $this->input->post('page'); 
			if(!$page){ 
				$offset = 0; 
				}else{ 
				$offset = $page; 
			} 
			
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$conditions['where'] = array(
			'kategori_seo' =>'program',
			'posting.tanggal <' => mdate("%Y-%m-%d %H:%i:%s")
			);
			$totalRec = $this->model_data->getProgram($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataList'; 
			$config['base_url']    = base_url('program/programPagination/'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			
			// Initialize pagination library 
			$this->ajax_paging->initialize($config); 
			
			// Get records 
			$conditions = array( 
            'start' => $offset, 
            'limit' => $this->perPage 
			); 
			$conditions['where'] = array(
			'kategori_seo' => 'program',
			'posting.tanggal <' => mdate("%Y-%m-%d %H:%i:%s")
			);
			$data['posts'] = $this->model_data->getProgram($conditions); 
			
			// Load the data list view 
			$this->load->view('more/ajax-program', $data, false); 
		} 
		
	}
