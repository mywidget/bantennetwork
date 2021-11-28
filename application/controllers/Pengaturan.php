<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Pengaturan extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        
        public function divisi()
		{
			$data['title']       = 'divisi | Kalkulatorcetak.com';
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			$this->template->load(backend().'/themes',backend().'/404',$data);
        }
        public function level()
		{
			$data['title']       = 'level | Kalkulatorcetak.com';
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			$this->template->load(backend().'/themes',backend().'/404',$data);
        }
        public function sosmed()
		{
			$data['title']       = 'sosmed | Kalkulatorcetak.com';
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			$this->template->load(backend().'/themes',backend().'/404',$data);
        }
        public function paket()
		{
			$data['title']       = 'paket | Kalkulatorcetak.com';
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			$this->template->load(backend().'/themes',backend().'/404',$data);
        }
        
    }            