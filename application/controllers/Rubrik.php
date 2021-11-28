<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Rubrik extends CI_Controller {
		
		
		public function index()
		{
			$data['title'] = 'Blog | kalkulatorcetak.com';
            $data['description'] = 'description';
            $data['keywords'] = 'keywords';
            $data['url_image'] = 'url_image';
			
			$data['json']=[
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
            ];
			$query = $this->db->query("SELECT * FROM `posting` where publish='Y' limit $limit")->result_array();
			$data['blog'] = $query;
            $this->template->load(template().'/themes',template().'/blog',$data);
		}
	
	}
