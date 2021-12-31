<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Home extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
			$this->perPage = 6;
			$this->title =  pengaturan('site_title');
            $this->description =  pengaturan('site_desc');
            $this->keywords =  pengaturan('site_keys');
		}
        
		
		function next_page(){
			$offset = $this->input->post('offset');
			$_limit = $this->input->post('limit');
			$idcat = $this->input->post('cat');
			$counter = $this->input->post('counter');
			if($_limit==1){
				$limit = 2;
				$limit_qry = 5;
				}else{
				$limit = 3;
				$limit_qry =6;
			}
				
			
			$qry = $this->db->query("SELECT * from cat WHERE id_cat=".$idcat);
			if($qry->num_rows() >0){
				$row = $qry->row_array();
				$id_cat = $row['id_cat'];
				
				$jml = $this->model_app->getCounter('posting',['id_cat'=>$id_cat,'publish'=>'Y']);
				$total = ($jml - $offset);
				
				if($total <= 0){
				echo "reload";exit();
				}
				
					
					$data['next_data'] = $this->model_app->view_where_order_limit('posting',['id_cat'=>$id_cat],'tanggal','DESC',$offset,$limit_qry);
					
					$data['nama'] = $this->input->post('nama');
					$data['limit'] = $limit;
					$data['limits'] = $_limit;
					$data['cat'] = $idcat;
					$data['offset'] = $offset;
					
					$this->load->view(template() . '/home_nexts', $data, false);
				
			}
		}
		function nextPage()
        {
            // Define offset 
            $page = $this->input->post('page');
            if (!$page) {
			$offset = 0;
			} else {
			$offset = $page;
			}
			$_limit = $this->input->post('limit');
            if($_limit==1){
				$limit = 2;
				$limit_qry = 5;
				}else{
				$limit = 3;
				$limit_qry = 6;
			}
			$cat = $this->input->post('cat');
			$link_func = $this->input->post('link_func');
			
			if (!empty($cat)) {
				$conditions['where'] = array(
				'posting.id_cat' => $cat
				);
			}
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getRows("posting",$conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content_'.$cat;
            $config['base_url']    = base_url('home/nextPage');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit_qry;
            $config['cur_tag_open']    = '';
            $config['cur_tag_close']    = '';
            $config['link_func']   = 'searchFilter'.$cat;
            
            // Initialize pagination library 
            $this->ajax_paging->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            
			if (!empty($cat)) {
				$conditions['where'] = array(
				'posting.id_cat' => $cat
				);
			}
			
            unset($conditions['returnType']);
            $data['next_data'] = $this->model_data->getRows("posting",$conditions);
			$data['nama'] = $this->input->post('nama');
            $data['limits'] = $limit;
            $data['cat'] = $cat;
            
            // Load the data list view 
			$this->load->view(template() . '/home_next', $data, false);
		}
		
		
	}									