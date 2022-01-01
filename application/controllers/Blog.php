<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Blog extends CI_Controller {
		
		public function __construct()
        {
            parent::__construct();
			$this->load->helper('date');
		}
		
		public function detail()
		{
			
			$seo = $this->uri->segment(1);
			if($seo){
				$qry = $this->model_data->detailPost(['judul_seo'=>$seo,'publish'=>'Y']);
				if($qry->num_rows()){
					$query = $qry->row_array();
					$rowcat = $this->model_data->getCat(['id_cat'=>$query['id_cat']])->row_array();
					// print_r($rowcat);
					$thnt = folderthn($query['folder']);
					$blnt = folderbln($query['folder']);
					$data['title'] = $query['judul'].' | '.tag_key('site_title');
					$data['description'] = tag_key('site_desc');
					$data['keywords'] = tag_key('site_keys');
					$data['canonical']=base_url().$query['judul_seo'];
					$data['url_image'] = base_url().'assets/post/'.$thnt.'/'.$blnt.'/'.$query['gambar'];
					$data['publisher']=sosmed_single('FB');
					$start = strpos($query['postingan'], '<p>');
					$end = strpos($query['postingan'], '</p>', $start);
					$paragraph = substr($query['postingan'], $start, $end-$start+4);
					
					$data['json']=[
					"@context"=>"http://schema.org",
					"@type"=>"NewsArticle",
					"mainEntityOfPage"=>[
					"@type"=>"WebPage",
					"@id"=>base_url($seo)
					],
					"headline"=>$query['judul'],
					"author"=>[
					"@type"=>"Person",
					"name"=>$query['nama_lengkap']
					],
					"editor"=>[
					"@type"=>"Person",
					"name"=>"Administrator"
					],
					"keywords"=>!empty($query['kata_kunci'])?$query['kata_kunci'] : "berita terkini",
					"image"=>[
					"@type"=>"ImageObject",
					"url"=>base_url().'assets/post/'.$thnt.'/'.$blnt.'/'.$query['gambar'],
					"caption"=>$query['caption']
					],
					"description"=>!empty($query['deskripsi'])?$query['deskripsi']:cleanString($paragraph),
					"articleBody"=>cleanString($query['postingan']),
					"datePublished"=>standard_date('DATE_ATOM', strtotime($query['tanggal'])),
					"dateModified"=>standard_date('DATE_ATOM', strtotime($query['dateModified'])),
					"publisher"=>[
					"@type"=>"Organization",
					"name"=>tag_key('site_name'),
					"logo"=>[
					"@type"=>"ImageObject",
					"url"=>base_url('assets/banner/logo.png'),
					"width"=>"710",
					"height"=>"228"
					]
					]
					];
					$dibaca = $query['dibaca'] +1;
					insert_baca($dibaca,$query['id_post']);
					insert_populer($query['id_post'],$query['id_cat'],date('Y-m-d'));
					$data['kategori'] = $this->model_app->view('cat')->result_array();
					$data['nama_kategori'] = strtolower($rowcat['nama_kategori']);
					$data['kategori_seo'] = strtolower($rowcat['nama_kategori']);
					$data['populer'] = populer();
					$data['terkait'] = terkait($query['judul'],$query['id_post']);
					$data['item'] = $query;
					$this->template->load(template().'/themes',template().'/detail_berita',$data);
					}else{
					$data = error_page();
				$this->template->load(template().'/themes',template().'/404',$data);
				}
				}else{
				$data = error_page();
				$this->template->load(template().'/themes',template().'/404',$data);
			}
		}
	}
