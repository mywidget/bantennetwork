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
			'feed_name' 		=> 'Lenteranews Feed',
			'feed_logo'			=> base_url('assets/frontend/images/favicon.png'),
			'feed_website'		=> base_url(),
			'feed_url' 			=> base_url().'feed/',
			'page_description' 	=> 'Berita Terkini, Berita Hari Ini Banten dan Indonesia - Lenteranews.tv',
			'page_language' 	=> 'en-en',
			'creator_email' 	=> 'lenteranews.tv@gmail.com',
			'posts' 			=> $this->model_data->getsource(10)->result()
		);
		header("Content-Type: application/rss+xml");
		$this->load->view('rss', $data);
	}

}
