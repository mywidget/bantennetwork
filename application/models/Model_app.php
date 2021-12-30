<?php 
    class Model_app extends CI_model{
        public function view($table){
            return $this->db->get($table);
        }
        
        public function hitung($table,$where){
            $this->db->from($table);
            $this->db->where($where);
            return $this->db->count_all_results();
        }
        
        public function insert($table,$data){
            return $this->db->insert($table, $data);
        }
        public function pilih($table,$data){
            if($this->db->get_where($table, $data))
            {
                $arr['status'] =  "ok";
                $arr['msg'] =  "Input berhasil";
                }else{
                $arr['status'] =  "error";
                $arr['msg'] =  "Gagal input data";
            }
            return $arr;
        }
        public function hapus($table, $where){
            if($this->db->delete($table, $where))
            {
                $arr['status'] =  "ok";
                $arr['msg'] =  "Input berhasil";
                }else{
                $arr['status'] =  "error";
                $arr['msg'] =  "Gagal input data";
            }
            return $arr;
        }
        public function input($table,$data){
            if($this->db->insert($table, $data))
            {
                $arr['status'] =  "ok";
                $arr['msg'] =  "Input berhasil";
                $arr['id'] = $this->db->insert_id();
                }else{
                $arr['status'] =  "error";
                $arr['msg'] =  "Gagal input data";
                $arr['id'] =  "";
            }
            return $arr;
        }
        
        public function edit($table, $data){
            return $this->db->get_where($table, $data);
        }
        
        public function update($table, $data, $where){
            if($this->db->update($table, $data, $where))
            {
                $arr['status'] =  "ok";
                $arr['msg'] =  "Input berhasil";
                $arr['id'] = $this->db->insert_id();
                }else{
                $arr['status'] =  "error";
                $arr['msg'] =  "Gagal input data";
                $arr['id'] =  "";
            }
            return $arr;
        }
        
        public function delete($table, $where){
            return $this->db->delete($table, $where);
        }
        
        public function view_where($table,$data){
            $this->db->where($data);
            return $this->db->get($table);
        }
        
        public function view_ordering_limit($table,$order,$ordering,$baris,$dari){
            $this->db->select('*');
            $this->db->order_by($order,$ordering);
            $this->db->limit($dari, $baris);
            return $this->db->get($table);
        }
        
        public function view_ordering($table,$order,$ordering){
            $this->db->select('*');
            $this->db->from($table);
            $this->db->order_by($order,$ordering);
            return $this->db->get()->result_array();
        }
        
        public function view_order($table,$order,$ordering){
            $this->db->select('*');
            $this->db->from($table);
            $this->db->order_by($order,$ordering);
            return $this->db->get()->result();
        }
        
        public function view_where_ordering($table,$data,$order,$ordering){
            $this->db->where($data);
            $this->db->order_by($order,$ordering);
            return $this->db->get($table);
            return $query->result_array();
        }
        
        public function view_join_one($table1,$table2,$field,$order,$ordering){
            $this->db->select('*');
            $this->db->from($table1);
            $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
            $this->db->order_by($order,$ordering);
            return $this->db->get()->result_array();
        }
        public function view_join($select,$table1,$table2,$field,$where){
            $this->db->select($select);
            $this->db->from($table1);
            $this->db->where($where);
            $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
            return $this->db->get()->row_array();
        }
        
        public function view_join_where($table1,$table2,$field,$where,$order,$ordering,$baris,$dari){
            $this->db->select('*');
            $this->db->from($table1);
            $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
            $this->db->where($where);
            $this->db->order_by($order,$ordering);
            $this->db->limit($dari, $baris);
            return $this->db->get()->result_array();
        }
        
        // public function view_join_wheres($table1,$table2,$field1,$field2,$where,$order,$ordering,$baris){
            // $this->db->select('*');
            // $this->db->from($table1);
            // $this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
            // $this->db->where($where);
            // $this->db->order_by($order,$ordering);
            // $this->db->limit($baris);
            // return $this->db->get()->result();
        // }
        public function view_jointwo_where($from,$table1,$table2,$join1,$join2,$where,$order,$ordering,$baris){
            $this->db->select('*');
            $this->db->from($from);
            $this->db->join($table1, $join1);
            $this->db->join($table2, $join2);
            $this->db->where($where);
            $this->db->order_by($order,$ordering);
            $this->db->limit($baris);
            return $this->db->get()->result_array();
        }
        
        public function cek_login($username,$password,$table){
            return $this->db->query("SELECT * FROM $table where email='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."' AND aktif='Y'");
        }
        
        public function cek_user($username){
            return $this->db->query("SELECT * FROM gtbl_user where email='".$this->db->escape_str($username)."' AND aktif='Y'");
        }
        
        public function image_count($directory) {
            $count = count(glob("./$directory/*.*"));
            return $count;
        }
        
        public function dir_size($directory) {
            $size = 0;
            foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
                $size += $file->getSize();
            }
            return $size;
        }
        function getPosting($key,$where,$order,$ordering,$limit)
		{
			$this->db->select('*'); 
            $this->db->from('posting');
            // $this->db->where('FIND_IN_SET('$oidcats', CONCAT(id_cat, ',')));
            $this->db->where("FIND_IN_SET(".$key.", id_cat)");
            $this->db->where($where);
            $this->db->order_by($order,$ordering);
            $this->db->limit($limit);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
			return $result; 
		}
        function kategori_tag($id_cat)
		{
			$this->db->select('*'); 
            $this->db->from('cat');
            $this->db->where_in('id_cat', $id_cat);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
			return $result; 
		}
    }                