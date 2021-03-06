<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Tag extends CI_Controller {
		public function __construct()
        {
            parent::__construct();
            $this->load->library('ajax_pagemobile');
            $this->load->library('ajax_paging');
			$this->perPage = 10;
		}
		
		public function index()
		{
			$seo = $this->uri->segment(2);
			$pilihtag = pilihtag($seo);
			$data['title'] = 'Topik - ' .ucwords($pilihtag).' | '.tag_key('site_title');
			$data['description'] = tag_key('site_desc');
			$data['keywords'] = tag_key('site_desc');
			$data['canonical']=base_url('search/');
			$data['url_image'] = 'url_image';
			$data['publisher']=sosmed_single('FB');
			$data['json']=[
            "@context" => "https://schema.org",
            "@type" =>  "Organization",
            "name" => tag_key('site_name'),
            "url" =>  tag_key('site_url'),
            "sameAs" => sosmed()
            ];
			
			
			
			if (!empty($seo)) {
				$type = $this->input->get('type');
				
				$conditions['search']['keywords'] = $pilihtag;
				if (!empty($type)) {
					$conditions['where'] = array(
					'cat.kategori_seo' => $type
					);
				}
				$conditions['returnType'] = 'count';
				$totalRec = $this->model_data->getTag($conditions);
				// Pagination configuration 
				$config['target']      = '#postTag';
				$config['base_url']    = base_url('tag/ajaxTag');
				$config['total_rows']  = $totalRec;
				$config['per_page']    = $this->perPage;
				$config['link_func']   = 'searchAll';
				
				// Initialize pagination library 
				$this->paging_rubrik->initialize($config);
				
				// Get records 
				$conditions = array(
				'limit' => $this->perPage
				);
				
				$conditions['search']['keywords'] = $pilihtag;
				if (!empty($type)) {
					$conditions['where'] = array(
					'cat.kategori_seo' => $type
					);
				}
				$data['rubrik'] = $this->model_app->view_where('cat',['pub'=>'Y']);
				$data['tags']    = $seo;
				$data['tag']    = $pilihtag;
				$data['populer'] = populer();
				$data['terbaru'] = terbaru();
				$data['posts']  = $this->model_data->getTag($conditions);
				$this->template->load(template().'/themes',template().'/tag_berita',$data);
				}else{
				$data = error_page();
				$this->template->load(template().'/themes',template().'/404',$data);
			}
		}
		function ajaxTagDesktop()
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
                $conditions['search']['keywords'] = ($keywords);
			}
             
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getTag($conditions);
            
            // Pagination configuration 
            $config['target']      = '#postTag';
            $config['base_url']    = base_url('tag/ajaxTag');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchAll';
            
            // Initialize pagination library 
            $this->paging_rubrik->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            
			if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
			}
            unset($conditions['returnType']);
			
            $data['posts'] = $this->model_data->getTag($conditions);
            
			
            // Load the data list view 
            $this->load->view(template() . '/ajax-tag', $data, false);
		}
		
		function ajaxTag()
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
            $totalRec = $this->model_data->getTag($conditions);
            
            // Pagination configuration 
            $config['target']      = '#postTag';
            $config['base_url']    = base_url('tag/ajaxTag');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchAll';
            
            // Initialize pagination library 
            $this->paging_rubrik->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
			}
            unset($conditions['returnType']);
			
			$data['tab'] = $sortBy;
            $data['posts'] = $this->model_data->getTag($conditions);
            
			
            // Load the data list view 
            $this->load->view(template() . '/ajax-tag', $data, false);
		}
	}
