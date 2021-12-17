<?php 
	class Model_data extends CI_model{
		
		function getsource($limit = NULL){
			$this->db->select('*'); 
			$this->db->from('posting'); 
			$this->db->where('tanggal <',mdate("%Y-%m-%d %H:%i:%s")); 
			$this->db->order_by('tanggal', 'desc');
			$this->db->limit(10); 
			return $this->db->get(); 
		}
		
		function getProgram($params = array()){ 
			$this->db->select('*'); 
			$this->db->from('cat'); 
			$this->db->join('posting', '`cat`.`id_cat` = `posting`.`id_cat`');
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			} 
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('id_post', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('tanggal', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		} 
		
		//model produk
		function getProduk($params = array()){
			// print_r($params);
			
			$this->db->select('*'); 
			$this->db->from('jenis_produk'); 
			$this->db->join('produk', '`jenis_produk`.`id_jenis` = `produk`.`kategori_produk`');
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('nama_produk', $params['search']['keywords']); 
				} 
			}
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`produk`.`nama_produk`', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('produk.id_produk', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('produk.id_produk', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		function getBlog($params = array()){
			// print_r($params);
			$dbprefix = $this->db->dbprefix('cat');
			
			$this->db->select('*'); 
			$this->db->from($dbprefix); 
			$this->db->join('posting', '`cat`.`id_cat` = `posting`.`id_cat`');
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('judul', $params['search']['keywords']); 
				} 
			}
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`posting`.`judul`', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('posting.id_post', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('posting.id_post', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		function getTagDesktop($params = array()){
			print_r($params);
			$dbprefix = $this->db->dbprefix('cat');
			
			$this->db->select('*'); 
			$this->db->from($dbprefix); 
			$this->db->join('posting', '`cat`.`id_cat` = `posting`.`id_cat`');
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('tag', $params['search']['keywords']); 
				} 
			}
			// if(!empty($params['search']['sortBy'])){ 
				// if(!empty($params['search']['keywords'])){ 
					// $this->db->like('tag', $params['search']['keywords']); 
				// } 
			// }
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('posting.id_post', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('posting.id_post', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getTag($params = array()){
			// print_r($params);
			$dbprefix = $this->db->dbprefix('cat');
			
			$this->db->select('*'); 
			$this->db->from($dbprefix); 
			$this->db->join('posting', '`cat`.`id_cat` = `posting`.`id_cat`');
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('tag', $params['search']['keywords']); 
				} 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('posting.id_post', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('posting.id_post', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		public function getdata_permalink()
		{
			$this->db->select('*');
			$this->db->from('permalink');
			$data = $this->db->get();
			return $data->result_array();
		}
		public function get_categories(){
			
			$this->db->select('*');
			$this->db->from('menuadmin');
			$this->db->where('idparent', 0);
			$this->db->where('aktif', 'Y');
			$this->db->order_by('urutan','ASC');
			$parent = $this->db->get();
			
			$categories = $parent->result();
			$i=0;
			foreach($categories as $p_cat){
				
				$categories[$i]->sub = $this->sub_categories($p_cat->idmenu);
				$i++;
			}
			return $categories;
		}
		
		public function sub_categories($id){
			
			$this->db->select('*');
			$this->db->from('menuadmin');
			$this->db->where('idparent', $id);
			$this->db->where('aktif', 'Y');
			$this->db->order_by('urutan','ASC');
			
			$child = $this->db->get();
			$categories = $child->result();
			$i=0;
			foreach($categories as $p_cat){
				
				$categories[$i]->sub = $this->sub_categories($p_cat->idmenu);
				$i++;
			}
			return $categories;       
		}
		
		function detailPost($where){
			$this->db->select('*'); 
			$this->db->from('gtbl_user'); 
			$this->db->join('posting', '`gtbl_user`.`id_user` = `posting`.`id_publisher`');
			// $this->db->join('cat', '`posting`.`id_cat` = `cat`.`id_cat`');
			$this->db->where($where);
			return $this->db->get();
		}
		function pagePost($where){
			$this->db->select('*'); 
			$this->db->from('page'); 
			$this->db->where($where);
			return $this->db->get();
		}
		function getCat($where){
			$this->db->select('*'); 
			$this->db->from('cat'); 
			$this->db->where($where);
			return $this->db->get();
		}
		function getPost($params = array()){ 
			$this->db->select('*'); 
			$this->db->from('gtbl_user'); 
			$this->db->join('posting', '`gtbl_user`.`id_user` = `posting`.`id_publisher`');
			$this->db->join('cat', '`posting`.`id_cat` = `cat`.`id_cat`');
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			} 
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('`posting`.`judul`', $params['search']['keywords']); 
					$this->db->or_like('`posting`.`tanggal`', $params['search']['keywords']); 
				} 
			}
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`posting`.`id_post`', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('id_post', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('id_post', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		function getRows($table,$params = array()){ 
			$this->db->select('*'); 
			$this->db->from($table); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			} 
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('id', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getPengguna($params = array()){ 
			$dbprefix = $this->db->dbprefix('gtbl_user');
			
			$this->db->select('*'); 
			$this->db->from($dbprefix); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('nama_lengkap', $params['search']['keywords']); 
				} 
			}
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`gtbl_user`.`id_user`', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('gtbl_user.id_user', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('gtbl_user.id_user', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
	}									