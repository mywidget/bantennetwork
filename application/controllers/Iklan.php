<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Iklan extends CI_Controller {
		
		
		public function index()
		{
			$data['title']       = 'Iklan | Lenteranews';
			$data['description'] = 'description';
			$data['keywords']    = 'keywords';
			
			$data['posts'] =  $this->model_app->view('banner')->result_array();
			$data['posisi'] = array(
			0=>'Header',
			1=>'Kanan-1',
			2=>'Kanan-2',
			3=>'Kiri',
			4=>'Kiri-1',
			5=>'Detail',
			6=>'Kiri-Detail',
			7=>'Kanan-Detail',
			8=>'Tengah',
			9=>'Terbaru'
			);
			$this->template->load(backend().'/themes',backend().'/list-iklan',$data);
			
		}
		
		public function edit()
		{
			$postid	= decrypt_url($this->input->post('id',TRUE));
			$qry 	=  $this->model_app->view_where('banner',['id_banner'=>$postid]);
			if($qry->num_rows() > 0){
				$row = $qry->row();
				$arr = [
				'id'=>encrypt_url($row->id_banner),
				'judul'=>$row->judul,
				'url'=>$row->link,
				'gambar'=>$row->gambar,
				'publish'=>$row->publish,
				'tanggal'=>$row->tanggal,
				'posisi'=>$row->posisi,
				'urutan'=>$row->urutan
				];
				}else{
				$arr = [''];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		public function update()
		{
			// print_r($_POST);
			// echo $_FILES['input_img']['name'];
			$postid 	= decrypt_url($this->input->post('id',TRUE));
			$file   = $this->input->post('img_del',TRUE);
			$config['upload_path']   = './assets/banner'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang image yang dizinkan
			$config['encrypt_name']  = TRUE; //enkripsi nama file
			$this->upload->initialize($config);
			if(!empty($_FILES['input_img']['name']))
			{
				if ($this->upload->do_upload('input_img'))
				{
					$cek = $this->model_app->view_where('banner', ['id_banner'=>$postid]);
					if($cek->num_rows() > 0)
					{
						$gambar = FCPATH.'assets/banner/'.$file;
						if(file_exists($gambar)){
							@unlink('./assets/post/'.$file);
						}
						$gbr = $this->upload->data();
						
						$data_post 	= [
						"judul"		=> $this->input->post('judul',TRUE),
						"tanggal"	=> $this->input->post('tanggal',TRUE),
						"posisi"	=> $this->input->post('posisi',TRUE),
						"link"		=> $this->input->post('url',TRUE),
						"gambar"	=> $gbr['file_name'],
						"publish"	=> $this->input->post('publish',TRUE)
						];
						
						$update = $this->model_app->update('banner',$data_post, ['id_banner'=>$postid]);
						if($update['status']=='ok')
						{
							$this->_create_thumbs_banner($gbr['file_name']);
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
					else
					{
						$arr = [
						'status'=>201,
						'title' =>'Update data',
						'msg'   =>'Data gagal diupdate'
						];
					}
				}
				else
				{
					$arr = [
					'status'=>201,
					'title' =>'Update data',
					'msg'   =>$this->upload->display_errors()
					];
				}
				}else{
				$data_post 	= [
				"judul"		=> $this->input->post('judul',TRUE),
				"tanggal"	=> $this->input->post('tanggal',TRUE),
				"posisi"	=> $this->input->post('posisi',TRUE),
				"link"		=> $this->input->post('url',TRUE),
				"publish"	=> $this->input->post('publish',TRUE)
				];
				
				$update = $this->model_app->update('banner',$data_post, ['id_banner'=>$postid]);
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
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		function _create_thumbs_banner($file_name){
			// Image resizing config
			$config = array(
			// Image Large
			array(
			'image_library' => 'GD2',
			'source_image'  => './assets/banner/'.$file_name,
			'maintain_ratio'=> TRUE,
			));
			
			$this->load->library('image_lib', $config[0]);
			foreach ($config as $item){
				$this->image_lib->initialize($item);
				if(!$this->image_lib->resize())
				{
					return false;
				}
				$this->image_lib->clear();
			}
		}
		public function delete()
		{
			
			$id = decrypt_url($this->input->post('id',TRUE));
			$file = $this->input->post('file',TRUE);
			
			$cek = $this->model_app->view_where('banner', ['id_banner'=>$id]);
			if($cek->num_rows() > 0)
			{
				$row = $cek->row();
				$delete = $this->model_app->hapus('banner', ['id_banner'=>$id]);
				if($delete['status']=='ok')
				{
					@unlink('./assets/banner/'.$file);
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