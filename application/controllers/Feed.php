<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Feed extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper('xml');
	}

	function index() {

		$data = array(
			'encoding' 			=> 'utf-8',
			'feed_name' 		=> tag_key('site_title'),
			'feed_logo'			=> base_url('assets/frontend/images/favicon.png'),
			'feed_website'		=> base_url(),
			'feed_url' 			=> base_url().'feed/',
			'page_description' 	=> tag_key('site_desc'),
			'page_language' 	=> 'en-en',
			'creator_email' 	=> tag_key('site_mail'),
			'posts' 			=> $this->model_data->getsource(10)->result()
		);
		header("Content-Type: application/rss+xml");
		$this->load->view('rss', $data);
	}

}
