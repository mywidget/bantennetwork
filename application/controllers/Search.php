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
			$data['title'] = 'Pencarian | '.tag_key('site_title');
			$data['description'] = tag_key('site_desc');
			$data['keywords'] = tag_key('site_desc');
			$data['canonical']=base_url('search/');
			$data['url_image'] = 'url_image';
			$data['publisher']=sosmed_single('FB');
			$data['json']=[
            "@context" => "https://schema.org",
            "@type" =>  "Organization",
            "name" =>  tag_key('site_name'),
            "url" =>  tag_key('site_url'),
            "sameAs" => sosmed()
            ];
			
			if ($this->input->get('pencarian') !== FALSE) {
				$conditions['search']['keywords'] = $this->input->get('s',true);
				} else {
				$conditions['search']['keywords'] = array();
			}
			// print_r($conditions);
			$conditions['where'] = array(
			'posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y'
			);
			$conditions['returnType'] = 'count';
			$totalRec = $this->model_data->getBlog($conditions);
			// Pagination configuration 
			$config['target']      = '#ResultCari';
			$config['base_url']    = base_url('search/ajaxSearch');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $this->perPage;
			$config['link_func']   = 'searchAll';
			
			// Initialize pagination library 
			$this->paging_rubrik->initialize($config);
			
			// Get records 
			$conditions = array(
			'limit' => $this->perPage
			);
            
			
			if ($this->input->get('pencarian') !== FALSE) {
				$conditions['search']['keywords'] = $this->input->get('s',true);
				} else {
				$conditions['search']['keywords'] = array();
			}
			
			// $where2 = ['posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y'];
			$conditions['where'] = array(
			'posting.tanggal <'=>mdate("%Y-%m-%d %H:%i:%s"),'`posting`.`publish`' => 'Y'
			);
			// print_r($conditions);
			
            unset($conditions['returnType']);
			$data['posts']    = $this->model_data->getBlog($conditions);
			$data['keywords']    = $this->input->get('s',true);
			
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
            
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getBlog($conditions);
            
            // Pagination configuration 
            $config['target']      = '#ResultCari';
            $config['base_url']    = base_url('search/ajaxSearch');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchAll';
            
            // Initialize pagination library 
            $this->paging_rubrik->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            
			$keywords = $this->input->post('keywords');
            if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
			}
			
            unset($conditions['returnType']);
			
            $data['posts'] = $this->model_data->getBlog($conditions);
			$data['keywords'] = $keywords;
            
			
            // Load the data list view 
            $this->load->view(template() . '/ajax-search', $data, false);
		}
		
	}
