<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Page extends CI_Controller {
		
        
		
		public function index()
		{
			$seo = $this->uri->segment(2);
			
			if($seo){
				$qry = $this->model_data->pagePost(['judul_seo'=>$seo,'pub'=>0]);
				if($qry->num_rows()){
					$query = $qry->row_array();
					
					$data['title'] = $query['judul'].' | '.tag_key('site_title';
					$data['description'] = tag_key('site_desc');
					$data['keywords'] = tag_key('site_desc');
					$data['canonical']=base_url('detail/').$query['judul_seo'];
					$data['url_image'] = base_url().'assets/page/'.$query['photo'];
					
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
					"name"=>''
					],
					"editor"=>[
					"@type"=>"Person",
					"name"=>"Administrator"
					],
					"keywords"=>"",
					"image"=>[
					"@type"=>"ImageObject",
					"url"=>base_url().'assets/page/'.$query['photo'],
					"caption"=>""
					],
					"description"=>'',
					"articleBody"=>cleanString($query['isi']),
					"datePublished"=>"",
					"dateModified"=>"",
					"publisher"=>[
					"@type"=>"Organization",
					"name"=>tag_key('site_name'),
					"logo"=>[
					"@type"=>"ImageObject",
					"url"=>logo(),
					"width"=>"710",
					"height"=>"228"
					]
					]
					];
					
					$data['item'] = $query;
					
					
					$this->template->load(template().'/themes',template().'/pages_detail',$data);
					
					}else{
					$data = error_page();
					$this->template->load(template().'/themes',template().'/404',$data);
				}
			}
		}
	}	