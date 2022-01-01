<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Sosmed extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();
			$this->perPage = 5;
			cek_session_login();
            $this->title =  pengaturan('site_title');
            $this->description =  pengaturan('site_desc');
            $this->keywords =  pengaturan('site_keys');
		}
		public function sosmed()
		{
			$data['title']       = 'Sosmed | '.$this->title;
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			
			$data['posts'] =  $this->model_app->view_ordering("sosmed","id","DESC");
			$this->template->load(backend().'/themes',backend().'/list-sosmed',$data);
			
		}
		
		public function edit_sosmed()
		{
			$postid	= decrypt_url($this->input->post('id',TRUE));
			$qry 	=  $this->model_app->view_where('sosmed',['id'=>$postid]);
			
			if($qry->num_rows() > 0){
				$row = $qry->row();
				$arr = [
				'id'=>encrypt_url($row->id),
				'judul'=>$row->judul,
				'url'=>$row->link,
				'icon'=>$row->idkey,
				'publish'=>$row->publish,
				'tag'=>$row->tag,
				'urutan'=>$row->urutan
				];
				}else{
				$arr = [''];
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		public function update_sosmed()
		{
			
			$type 	= $this->input->post('type',TRUE);
			$icon 	= strtolower($this->input->post('judul',TRUE));
			
			if($type=='new'){
				$data_post 	= [
				"judul"	=> $this->input->post('judul',TRUE),
				"tag"	=> $this->input->post('tag',TRUE),
				"link"	=> $this->input->post('url',TRUE),
				"idkey"	=> $icon,
				"urutan"	=> $this->input->post('urutan',TRUE),
				"publish"	=> $this->input->post('publish',TRUE)
				];
				
				$insert = $this->model_app->input('sosmed', $data_post);
				if($insert['status']=='ok')
				{
					$arr = [
					'status'=>200,
					'title' =>'Update data',
					'msg'   =>'Data berhasil diinput'
					];
					}else{
					$arr = [
					'status'=>201,
					'title' =>'Update data',
					'msg'   =>'Data gagal diinput'
					];
				}
				}elseif($type=='edit'){
				$postid 	= decrypt_url($this->input->post('id',TRUE));
				
				$cek = $this->model_app->view_where('sosmed', ['id'=>$postid]);
				if($cek->num_rows() > 0)
				{
					
					$data_post 	= [
					"judul"		=> $this->input->post('judul',TRUE),
					"tag"	=> $this->input->post('tag',TRUE),
					"link"		=> $this->input->post('url',TRUE),
					"idkey"		=> $icon,
					"urutan"	=> $this->input->post('urutan',TRUE),
					"publish"	=> $this->input->post('publish',TRUE)
					];
					
					$update = $this->model_app->update('sosmed',$data_post, ['id'=>$postid]);
					if($update['status']=='ok')
					{
						$arr = [
						'status'=>200,
						'title' =>'Update data',
						'msg'   =>'Data berhasil diupdate'
						];
					}
					else
					{
						$arr = [
						'status'=>201,
						'title' =>'Update data',
						'msg'   =>'Data gagal diupdate'
						];
					}
					
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		
		public function delete_sosmed()
		{
			
			$id = decrypt_url($this->input->post('id',TRUE));
			$file = $this->input->post('file',TRUE);
			
			$cek = $this->model_app->view_where('sosmed', ['id'=>$id]);
			if($cek->num_rows() > 0)
			{
				$row = $cek->row();
				$delete = $this->model_app->hapus('sosmed', ['id'=>$id]);
				if($delete['status']=='ok')
				{
					$arr = [
					'status'=>200,
					'title' =>'Update data',
					'msg'   =>'Data berhasil dihapus'
					];
					}else{
					$arr = [
					'status'=>201,
					'title' =>'Update data',
					'msg'   =>'Data gagal dihapus'
					];
				}
				}else{
				$arr = [
				'status'=>201,
				'title' =>'Update data',
				'msg'   =>'Data gagal dihapus'
				];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
	}																		