<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Rubrik extends CI_Controller {
		
		function __construct() { 
			parent::__construct(); 
			$this->load->helper('date');
			$this->perPage     = 10; 
			$this->site_name   =  tag_key('site_name');
			$this->title       =  tag_key('site_title');
			$this->site_url    =  tag_key('site_url');
            $this->description =  tag_key('site_desc');
            $this->keywords    =  tag_key('site_keys');
		} 
		public function index()
		{
			$seo = $this->uri->segment(2);
			
			$data['title'] = ucwords(cleanTag($seo)).' | '.$this->title;
			$data['description'] = tag_key('site_desc');
			$data['keywords'] = $this->keywords;
			$data['canonical']=base_url().$seo;
			$data['url_image'] = "";
			$data['publisher']=sosmed_single('FB');
			$data['json'] =[
            "@context" => "https://schema.org",
            "@type" =>  "Organization",
            "name" =>  $this->site_name,
            "url" =>  $this->site_url,
            "sameAs" => sosmed()];
			
			$qry = $this->model_app->view_where('cat',['kategori_seo'=>$seo,'pub'=>'Y'])->row();
			// $qry = $this->db->query("SELECT * FROM `cat` where kategori_seo='$seo' AND pub='Y'");
			if(!empty($qry)){
				
				$id_cat = $qry->id_cat;
				$data['kategori'] =  $qry->nama_kategori;
				$data['kategoriseo'] =  $seo;
				$where1 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y','`posting`.`status`' => '2','id_cat'=>$id_cat];
				
				$data['headline1'] = $this->model_app->view_where_order_limit('posting',$where1,'tanggal','DESC',0,1)->result_array();
				$data['headline2'] = $this->model_app->view_where_order_limit('posting',$where1,'tanggal','DESC',2,4)->result_array();
				
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
				$config['base_url']    = base_url('rubrik/rubrikPagination/'); 
				$config['total_rows']  = $totalRec; 
				$config['per_page']    = $this->perPage; 
				
				// Initialize pagination library 
				$this->ajax_paging->initialize($config); 
				
				// Get records 
				$conditions = array( 
				'limit' => $this->perPage 
				); 
				$conditions['where'] = array(
				'kategori_seo' => $seo,
				'posting.tanggal <' => mdate("%Y-%m-%d %H:%i:%s")
				);
				$data['posts'] = $this->model_data->getProgram($conditions); 
				//end
				$this->template->load(template().'/themes',template().'/rubrik',$data);
				}else{
				$data = error_page();
				$this->template->load(template().'/themes',template().'/404',$data);
			}
		}
		function rubrikPagination(){ 
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