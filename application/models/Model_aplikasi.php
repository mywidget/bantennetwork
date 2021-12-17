<?php 
	class Model_aplikasi extends CI_model{
		
		public function api(array $val)
		{
		}
		public function mesin_get(array $val){
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE  id='".$val['index']."' AND id_user='".$val['iduser']."'");
			if($sql->num_rows==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			
			foreach ($ARRAY->mesin as $item) {
				if ($item->kdmesin == $val['getid']) {
					$data        	= array(
					'kdmesin'       => encrypt_url($item->kdmesin),
					'namamesin'     => $item->namamesin,
					'jumlah_min'    => $item->jumlahmin,
					'harga_min'     => $item->hargamin,
					'harga_lebih'   => $item->hargalebih,
					'plat_sama'     => $item->biayabbplatsama,
					'harga_ctp'     => $item->hargactp,
					'min_bw'        => $item->hargaminbw,
					'lebih_bw'      => $item->hargalebihbw,
					'min_khusus'    => $item->hargamintintakhusus,
					'lebih_khusus'  => $item->hargalebihtintakhusus,
					'aktif'         => $item->aktif,
					'panjang'       => $item->panjangkertas,
					'lebar'         => $item->lebarkertas,
					'min_panjang'   => $item->min_panjang,
					'min_lebar'     => $item->min_lebar,
					'panjangc'      => $item->panjangcetak,
					'lebarc'        => $item->lebarcetak,
					'replat'        => $item->replat,
					'jenis_mesin'   => $item->jenis_mesin,
					'tarikan'       => $item->tarikan,
					'exp'           => explode(" ",$item->modul),
					'token'         => $val['token']
					);
					break;
				}
			}
			return $data;
		}
		public function data_array(array $val)
		{
			
			$sql = $this->db->query("SELECT * FROM ".$val['table']." WHERE  id_produk='".$val['id']."'");
			if($sql->num_rows() > 0){
				$rows=$sql->row_array();
				if(!empty($rows['detail']))
				{
					$dataJson = $rows['detail'];
					}else{
					$dataJson = '{"detail":[{"id":1,"harga":"0","bahan":"-","satuan":"-"}]}';
				}
				$array_data = json_decode($dataJson);
				}else{
				$array_data = ['status'=>'error'];
			}
			return $array_data;
		}
		public function data_arrray(array $val)
		{
			
			$sql = $this->db->query("SELECT * FROM ".$val['table']." WHERE id='".$val['index']."' AND id_user='".$val['iduser']."'");
			if($sql->num_rows() > 0){
				$rows=$sql->row_array();
				$dataJson = $rows['data_json'];
				$array_data = json_decode($dataJson);
				}else{
				$array_data = ['status'=>'error'];
			}
			return $array_data;
		}
		public function bahan_get(array $val)
		{
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE  id='".$val['index']."' AND id_user='".$val['iduser']."'");
			if($sql->num_rows==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			foreach ($ARRAY->bahan as $item) {
				if ($item->Kd_Bhn == $val['getid']) {
					$data = array(
					'kd_bhn'	    => encrypt_url($item->Kd_Bhn),
					'id_kategori'	=> $item->id_kategori,
					'nm_bhn'	    => $item->Nm_Bhn,
					'harga_bahan'	=> $item->Harga_Bahan,
					'tinggi'	    => $item->Tinggi,
					'lebar'	        => $item->Lebar,
					'tebal'	        => $item->Tebal,
					'publish'	    => $item->publish
					);
					break;
				}
			}
			return $data;
		}
		public function katbahan_get(array $val)
		{
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE  id='".$val['index']."' AND id_user='".$val['iduser']."'");
			if($sql->num_rows()==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			foreach ($ARRAY->katbahan as $item) {
				if ($item->id_kategori == $val['getid']) {
					$data = array(
					'index'   => encrypt_url($val['index']),
					'idcat'   => encrypt_url($item->id_kategori),
					'nama'    => $item->nama_kategori,
					'jenis'   => $item->id_jenis,
					'hrg_a3'  => $item->hrg_a3,
					'publish' => $item->pub,
					);	
					break;
				}
			}
			return $data;
		}
		
		public function jenis_get(array $val)
		{
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE  id='".$val['index']."' AND id_user='".$val['iduser']."'");
			if($sql->num_rows()==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			foreach ($ARRAY->jenis as $item) {
				if ($item->id_jenis == $val['getid']) {
					$data = array(
					'id' => encrypt_url($item->id_jenis),
					'index' => encrypt_url($val['index']),
					'nama_jenis' => $item->nama_jenis,
					'pub' => $item->pubj
					);	
					break;
				}
			}
			return $data;
		}
		
		public function plano_get(array $val)
		{
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE  id='".$val['index']."' AND id_user='".$val['iduser']."'");
			if($sql->num_rows()==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			
			foreach ($ARRAY->plano as $item) {
				if ($item->id == $val['getid']) {
					$data = array(
					'index' => encrypt_url($val['index']),
					'id' => encrypt_url($item->id),
					'nama' => $item->ket_ukuran,
					'panjang' => $item->panjang,
					'lebar' => $item->lebar
					);	
					break;
				}
			}
			return $data;
		}
		public function kertas_get(array $val)
		{
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE  id='".$val['index']."' AND id_user='".$val['iduser']."'");
			if($sql->num_rows()==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			foreach ($ARRAY->kertas as $item) {
				if ($item->id == $val['getid']) {
					
					$data = array(
					'index'         => encrypt_url($val['index']),
					'id_kategori'   => encrypt_url($item->id),
					'ket_ukuran'    => $item->ket_ukuran,
					'panjang'       => $item->panjang,
					'lebar'         => $item->lebar,
					'exp'           => explode(" ",$item->modul)
					);
					
					break;
				}
			}
			return $data;
		}
		public function biaya_get(array $val)
		{
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE  id='".$val['index']."' AND id_user='".$val['iduser']."'");
			if($sql->num_rows()==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			foreach ($ARRAY->biaya as $item) {
				if ($item->KdBiaya == $val['getid']) {
					
					$data = array(
					'index'      => encrypt_url($val['index']),
					'id'         => encrypt_url($item->KdBiaya),
					'nama_biaya' => $item->Nama_Biaya,
					'jumlahmin'  => $item->JumlahMin,
					'hargamin'   => $item->HargaMin,
					'hargalebih' => $item->HargaLebih,
					'groups'     => $item->Groups,
					'panjang'    => $item->Panjang,
					'lebar'      => $item->Lebar,
					'pub'        => $item->publish
					);	
					
					break;
				}
			}
			return $data;
		}
		public function insheet_get(array $val)
		{
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE  id='".$val['index']."' AND id_user='".$val['iduser']."'");
			if($sql->num_rows()==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			foreach ($ARRAY->insheet as $item) {
				if ($item->id_insheet == $val['getid']) {
					$data        = array(
					'index'      => encrypt_url($val['index']),
					'id'         => encrypt_url($item->id_insheet),
					'dari'       => $item->dari,
					'sampai'     => $item->sampai,
					'insheet'    => $item->insheet,
					'insheet_bb' => $item->insheet_bb
					);	
					break;
				}
			}
			return $data;
		}
		
		public function hargaprint_get(array $val)
		{
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE  id='".$val['index']."' AND id_user='".$val['iduser']."'");
			if($sql->num_rows()==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			foreach ($ARRAY->hargaprint as $item) {
				if ($item->id == $val['getid']) {
					$data = array(
					'index'      => encrypt_url($val['index']),
					'id'         => encrypt_url($item->id),
					'kdmesin'    => $item->kdmesin,
					'jml_min'    => $item->jml_min,
					'jml_max'    => $item->jml_max,
					'harga'      => $item->harga,
					'laminating' => $item->harga_laminating,
					'exp'        => explode(" ",$item->modul)
					);	
					break;
				}
			}
			return $data;
		}
		public function theme_get(array $val)
		{
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE  id='".$val['index']."' AND id_user='".$val['iduser']."'");
			if($sql->num_rows()==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			foreach ($ARRAY->theme as $item) {
				if ($item->id == $val['getid']) {
					$data = array(
					'index'	=> encrypt_url($val['index']),
					'id'	=> encrypt_url($item->id),
					'nama'  => $item->nama,
					'kolom' => $item->kolom,
					'pub'   => $item->pub
					);	
					break;
				}
			}
			
			return $data;
		}
		public function themeget(array $val)
		{
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE id_user='".$val['iduser']."'");
			if($sql->num_rows()==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			$arr = $ARRAY->theme;
			$arr = $arr[0];
			$data = array(
			'kolom' => $arr->kolom
			);	
			return $data;
		}
		public function limit_get(array $val)
		{
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE  id='".$val['index']."' AND id_user='".$val['iduser']."'");
			if($sql->num_rows()==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			foreach ($ARRAY->limit as $item) {
				if ($item->id == $val['getid']) {
					$data = array(
					'index'	=> encrypt_url($val['index']),
					'id'	=> encrypt_url($item->id),
					'nama'  => $item->nama,
					'klass' => $item->klass,
					'style' => $item->style,
					'pub'   => $item->pub
					);	
					break;
				}
			}
			
			return $data;
		}
		public function konsumen_get(array $val)
		{
			$sql = $this->db->query("SELECT * FROM ".$val['tabel']." WHERE  id_user='".$val['iduser']."'");
			if($sql->num_rows()==0){
				$data = array("status"=>500);
			}
			$rows=$sql->row_array();
			$dataJson = $rows['data_json'];
			$ARRAY = json_decode($dataJson);
			foreach ($ARRAY->konsumen as $item) {
				if ($item->id == $val['getid']) {
					
					$data = array(
					'id'	       => encrypt_url($item->id),
					'tgl'          => $item->tgl,
					'nama'         => $item->nama,
					'telp'         => $item->telp,
					'email'        => $item->email,
					'alamat'       => $item->alamat,
					'jabatan'      => $item->jabatan,
					'perusahaan'   => $item->perusahaan
					);	
					break;
				}
			}
			
			return $data;
		}
	}														