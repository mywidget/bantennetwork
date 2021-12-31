<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Search extends CI_Controller {
		
		public function __construct()
        {
            parent::__construct();
            $this->load->helper('date');
            $this->load->library('ajax_pagemobile');
			$this->perPage = 10;
		}
        
		public function index()
		{
			$data['title'] = 'Pencarian | '.tag_key('site_title';
			$data['description'] = tag_key('site_desc');
			$data['keywords'] = tag_key('site_desc');
			$data['canonical']=base_url('search/');
			$data['url_image'] = 'url_image';
			$data['json']=[
            "@context" => "https://schema.org",
            "@type" =>  "Organization",
            "name" =>  tag_key('site_name'),
            "url" =>  "https://www.lenternews.tv",
            "sameAs" => sosmed()
            ];
			
			$conditions['where'] = array(
			'posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y'
			);
			$conditions['returnType'] = 'count';
			$totalRec = $this->model_data->getBlog($conditions);
			// Pagination configuration 
			$config['target']      = '#postList-tab-0';
			$config['base_url']    = base_url('search/ajaxSearch');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $this->perPage;
			$config['link_func']   = 'searchAll';
			
			// Initialize pagination library 
			$this->ajax_pagemobile->initialize($config);
			
			// Get records 
			$conditions = array(
			'limit' => $this->perPage
			);
			// $where2 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y'];
			$conditions['where'] = array(
			'posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y'
			);
			// print_r($conditions);
			$data['populer'] = populer();
			$data['posts']    = $this->model_data->getBlog($conditions);
			
			$this->template->load(template().'/themes',template().'/search',$data);
		}
		
		function ajaxSearch()
        {
            // Define offset 
            $page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
                } else {
                $offset = $page;
			}
            $keywords = $this->input->post('keywords');
            if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
			}
            $sortBy = $this->input->post('sortBy');
            // if (!empty($sortBy)) {
			// $conditions['search']['sortBy'] = $sortBy;
			// }
			
			
            if (!empty($sortBy) AND $sortBy!=0) {
				$conditions['where'] = array(
				'posting.id_cat' => $sortBy
				);
			}
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getBlog($conditions);
            
            // Pagination configuration 
            $config['target']      = '#postList-tab-'.$sortBy;
            $config['base_url']    = base_url('search/ajaxSearch');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchAll';
            
            // Initialize pagination library 
            $this->ajax_pagemobile->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            
			if (!empty($sortBy) AND $sortBy!=0) {
				$conditions['where'] = array(
				'posting.id_cat' => $sortBy
				);
			}
			
            unset($conditions['returnType']);
			
			$data['tab'] = $sortBy;
            $data['posts'] = $this->model_data->getBlog($conditions);
            
			
            // Load the data list view 
            $this->load->view(template() . '/ajax-search', $data, false);
		}
	}
