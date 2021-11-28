<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Permalink extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->helper('string');
		}
		function index(){
			
		}
		public function save_routes()
		{
			
			$routes = $this->model_data->getdata_permalink();
			
			// Membuat content yang akan ditulis pada file permalink.php
			foreach( $routes as $value )
			{
				$data[] = '$route["' . $value['mask'] . '"] = "' . $value['real_url'] .'";';
			}
			
			$output = implode("\n", $data);
			
			$this->load->helper('file');
			write_file(APPPATH . "cache/permalink.php", $output);
		}
	}
?>