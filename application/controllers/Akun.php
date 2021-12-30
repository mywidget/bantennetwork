<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Akun extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->perPage = 5;
            $this->tabel = 'data_';
            $this->mod = '_get';
            $this->iduser = $this->session->g_id; 
            cek_session_login();
            // $this->appconfig = appconfig();
        }
        
        public function pesan()
        {
            $data['title']       = 'Pesan | lenteranews.tv';
            $data['description'] = 'description';
            $data['keywords']    = 'keywords';
            $this->template->load(backend() . '/themes', backend() . '/404', $data);
        }
        
        public function profil()
        {
            $data['title']       = 'Profil | lenteranews.tv';
            $data['description'] = 'description';
            $data['keywords']    = 'keywords';
            $data['module']      = $this->uri->segment(2);
            $data['user']        = CekMailUser($this->session->g_email);
            $this->template->load(backend() . '/themes', backend() . '/profil', $data);
        }
        public function crud_profil()
        {
            $arr = ['error'];
            if ($this->input->post('type') == 'owner') {
                if ($this->input->post('img_url') == '') {
                    $data = [
                    'no_hp' => $this->input->post('no_hp'),
                    'nama_lengkap'   => $this->input->post('nama'),
                    'alamat'         => $this->input->post('alamat'),
                    ];
                    } else {
                    $data = [
                    'no_hp' => $this->input->post('no_hp'),
                    'nama_lengkap'   => $this->input->post('nama'),
                    'profile_image'  => $this->input->post('img_url'),
                    'alamat'         => $this->input->post('alamat'),
                    ];
                }
                $update = $this->model_app->update('gtbl_user', $data, array('id_user' => $this->session->g_id));
                if ($update['status'] == 'ok') {
                    $arr = [
                    'status' => 200,
                    'no_hp' => $this->input->post('no_hp'),
                    'nama_lengkap' => $this->input->post('nama'),
                    'profile_image' => $this->input->post('img_url'),
                    'alamat' => $this->input->post('alamat')
                    ];
                    } else {
                    $arr = ['status' => 404];
                }
            }
            if ($this->input->post('type') == 'marketing') {
                if ($this->input->post('img_url') == '') {
                    $data = [
                    'no_hp' => $this->input->post('no_hp'),
                    'nama_lengkap'   => $this->input->post('nama')
                    ];
                    } else {
                    $data = [
                    'no_hp' => $this->input->post('no_hp'),
                    'nama_lengkap'   => $this->input->post('nama'),
                    'profile_image'  => $this->input->post('img_url')
                    ];
                }
                
                $update = $this->model_app->update('gtbl_user', $data, array('id_user' => $this->session->g_id));
                if ($update['status'] == 'ok') {
                    $arr = [
                    'status' => 200, 'no_hp' => $_POST['no_hp'],
                    'nama_lengkap' => $_POST['nama'],
                    'profile_image' => $_POST['img_url']
                    ];
                    } else {
                    $arr = ['status' => 404];
                }
            }
            if ($this->input->post('type') == 'ganti') {
                $password = password_hash($this->input->post('pass2'), PASSWORD_DEFAULT);
                $update = $this->model_app->update('gtbl_user', array('password' => $password), array('id_user' => $this->session->g_id));
                if ($update['status'] == 'ok') {
                    $arr = ['status' => 200];
                    } else {
                    $arr = ['status' => 404];
                }
            }
            if ($this->input->post('type') == 'uplogo') {
                $arr = array('profit' => $this->input->post('profit'), 'logo' => $this->input->post('logo'));
                $where = array('id_user' => $this->session->g_id);
                $update = $this->model_app->update('gtbl_user', $arr, $where);
                if ($update['status'] == 'ok') {
                    $arr = ['status' => 200];
                    } else {
                    $arr = ['status' => 404];
                }
            }
            echo json_encode($arr, JSON_UNESCAPED_SLASHES);
        }
        
        public function load_data()
        {
            $app_detail = app_detail($this->session->g_id);
            // print_r($app_detail);
            if(empty($app_detail)){
                redirect('main');
                exit();
            }
            if(!empty($app_detail['status'])){
                echo "error";
                exit();
            }
            $mesin      = $app_detail['mesin'];
            $bahan      = $app_detail['bahan'];
            $katbahan   = $app_detail['katbahan'];
            $jenis      = $app_detail['jenis'];
            $kertas     = $app_detail['kertas'];
            $biaya      = $app_detail['biaya'];
            $insheet    = $app_detail['insheet'];
            $harga      = $app_detail['harga'];
            $produk     = $app_detail['produk'];
            $plano      = $app_detail['plano'];
            $theme      = $app_detail['theme'];
            
            
            $data['mesin']    = ['judul'=>$mesin['judul'],'slug'=>$mesin['slug']];
            $data['bahan']    = ['judul'=>$bahan['judul'],'slug'=>$bahan['slug']];
            $data['katbahan'] = ['judul'=>$katbahan['judul'],'slug'=>$katbahan['slug']];
            $data['jenis']    = ['judul'=>$jenis['judul'],'slug'=>$jenis['slug']];
            $data['kertas']   = ['judul'=>$kertas['judul'],'slug'=>$mesin['slug']];
            $data['biaya']    = ['judul'=>$biaya['judul'],'slug'=>$biaya['slug']];
            $data['insheet']  = ['judul'=>$insheet['judul'],'slug'=>$insheet['slug']];
            $data['harga']    = ['judul'=>$harga['judul'],'slug'=>$harga['slug']];
            $data['produk']   = ['judul'=>$produk['judul'],'slug'=>$produk['slug']];
            $data['plano']    = ['judul'=>$plano['judul'],'slug'=>$plano['slug']];
            $data['theme']    = ['judul'=>$theme['judul'],'slug'=>$theme['slug']];
            
            
            $data['count_mesin']    = countd($mesin['data_json'], 'mesin');
            $data['count_bahan']    = countd($bahan['data_json'], 'bahan');
            $data['count_katbahan'] = countd($katbahan['data_json'], 'katbahan');
            $data['count_jenis']    = countd($jenis['data_json'], 'jenis');
            $data['count_kertas']   = countd($kertas['data_json'], 'kertas');
            $data['count_biaya']    = countd($biaya['data_json'], 'biaya');
            $data['count_insheet']  = countd($insheet['data_json'], 'insheet');
            $data['count_harga']    = countd($harga['data_json'], 'hargaprint');
            $data['count_plano']    = countd($plano['data_json'], 'plano');
            $data['count_theme']    = countd($theme['data_json'], 'theme');
            
            
            $prod     = $produk['data_json'];
            $prod_arr = explode(",", $prod);
            $data['cp']       = count($prod_arr);
            $no       = 1;
            
            $data['mesin_index']    = encrypt_url($mesin['id']);
            $data['bahan_index']    = encrypt_url($bahan['id']);
            $data['katbahan_index'] = encrypt_url($katbahan['id']);
            $data['jenis_index']    = encrypt_url($jenis['id']);
            $data['kertas_index']   = encrypt_url($kertas['id']);
            $data['biaya_index']    = encrypt_url($biaya['id']);
            $data['insheet_index']  = encrypt_url($insheet['id']);
            $data['harga_index']    = encrypt_url($harga['id']);
            $data['plano_index']    = encrypt_url($plano['id']);
            $data['theme_index']    = encrypt_url($theme['id']);
            $data['produk_index']   = encrypt_url($produk['id']);
            
            $this->load->view(backend() . '/load_aplikasi', $data, false);
        }
        public function aplikasi()
        {
            
            $seo = $this->uri->segment(3);
            if(empty($seo)){
                $data['title']       = 'Aplikasi | lenteranews.tv';
                $data['description'] = 'description';
                $data['keywords']    = 'keywords';
                $this->template->load(backend() . '/themes', backend() . '/load_data', $data);
                }else{
                $getid = decrypt_url($this->uri->segment(4));
                checkint($getid);
                if ($seo) {
                    $data['title']       = 'Data Aplikasi | lenteranews.tv';
                    $data['description'] = 'description';
                    $data['keywords']    = 'keywords';
                    $data['url_main'] = $this->uri->segment(1);
                    $data['url_sub'] = $this->uri->segment(2);
                    $data['app_detail'] = app_detail($this->iduser);
                    $data['index'] = $this->uri->segment(4);
                    $data['_index'] = $getid;
                    $data['view'] = $seo;
                    $data['iduser'] = $this->iduser;
                    $this->template->load(backend() . '/themes', backend() . '/aplikasi/' . $seo, $data);
                }
                
            }
        }
        public function konsumen()
        {
            $data['title']       = 'konsumen | lenteranews.tv';
            $data['description'] = 'description';
            $data['keywords']    = 'keywords';
            $this->template->load(backend().'/themes',backend().'/konsumen',$data);
        }
        public function cari()
        {
            $seo = $this->uri->segment(3);
            if($seo=='konsumen'){
                $array_data = $this->model_aplikasi->data_array(['table'=>'data_konsumen','iduser'=>$this->iduser]);
                if(isset($array_data->$seo)){
                    $dataarr    = json_decode(json_encode($array_data), true);
                    $data['products']   = $dataarr[$seo];
                    }else{
                    $data['products']   = [];
                }
                // print_r($array_data->hargaprint);
                $data['search_filter']    = $this->input->post('search',TRUE);
                $data['limit']            = !empty($this->input->post('per-page',TRUE)) ? $this->input->post('per-page',TRUE) : 10;
                $data['page_number']    = $this->input->post('page-number',TRUE);
                $this->load->view(backend() . '/aplikasi/cari-konsumen', $data, false);
                }elseif($seo=='hitungan'){
                $array_data = $this->model_aplikasi->data_array(['table'=>'data_hitung','iduser'=>$this->iduser]);
                if(isset($array_data->hitung)){
                    $dataarr    = json_decode(json_encode($array_data), true);
                    $data['products']   = $dataarr['hitung'];
                    }else{
                    $data['products']   = [];
                }
                // print_r($array_data->hargaprint);
                $data['search_filter']    = $this->input->post('search',TRUE);
                $data['limit']            = !empty($this->input->post('per-page',TRUE)) ? $this->input->post('per-page',TRUE) : 10;
                $data['page_number']    = $this->input->post('page-number',TRUE);
                $this->load->view(backend() . '/aplikasi/cari-hasil', $data, false);
                }else{
                // echo $seo;
                $getid                    = decrypt_url($this->input->post('index'));
                checkint($getid);
                $data['iduser']           = $this->iduser;
                $data['view']             = $seo;
                $data['index']            = $this->input->post('index');
                $data['_index']           = $getid;
                $tabel                    = $this->tabel.$seo;
                $array_data               = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$getid,'iduser'=>$this->iduser]);
                if(isset($array_data->$seo)){
                    $dataarr                  = json_decode(json_encode($array_data), true);
                    $data['products']         = $dataarr[$seo];
                    }else{
                    $data['products']         = [];
                }
                // print_r($array_data->hargaprint);
                $data['search_filter']    = $this->input->post('search',TRUE);
                $data['limit']            = !empty($this->input->post('per-page',TRUE)) ? $this->input->post('per-page',TRUE) : 10;
                $data['page_number']    = $this->input->post('page-number',TRUE);
                $this->load->view(backend() . '/aplikasi/cari-' . $seo, $data, false);
            }
        } 
        public function crud()
        {
            $seo = $this->uri->segment(3);
            $type = $this->input->post('type',TRUE);
            $view = $this->input->post('view',TRUE);
            $tabel = $this->tabel.$view;
            // echo $tabel;
            //get
            if($type=='get')
            {
                $getid = decrypt_url($this->input->post('id',TRUE));
                $index = decrypt_url($this->input->post('index',TRUE));
                $modul = $view.$this->mod;
                // print_r($modul);
                $token = $this->security->get_csrf_hash();
                $where = array('tabel'=>$tabel,'getid'=>$getid,'index'=>$index,'iduser'=>$this->iduser,'token'=>$token);
                $data = $this->model_aplikasi->$modul($where);
                echo json_encode($data);
            }
            //modul
            if($type=='modul')
            {
                $GETID = decrypt_url($this->input->post('id',TRUE));   
                $index = decrypt_url($this->input->post('index',TRUE));
                if($view=='mesin' AND $GETID!='')
                {
                    $ARRAY = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                    foreach ($ARRAY->mesin as $item) {
                        if ($item->kdmesin == $GETID) {
                            $kdmesin = $item->kdmesin;
                            $exp = explode(" ",$item->modul);
                            break;
                        }
                    }
                    
                }
                if($view=='katbahan' AND $GETID!='')
                {
                    $ARRAY = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                    foreach ($ARRAY->katbahan as $item) {
                        if ($item->id_kategori == $GETID) {
                            $exp = explode(" ",$item->modul);
                            break;
                        }
                    }
                }
                if($view=='kertas' AND $GETID!='')
                {
                    $ARRAY = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                    foreach ($ARRAY->kertas as $item) {
                        if ($item->id == $GETID) {
                            $exp = explode(" ",$item->modul);
                            break;
                        }
                    }
                }
                if($view=='hargaprint' AND $GETID!='')
                {
                    $ARRAY = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                    foreach ($ARRAY->hargaprint as $item) {
                        if ($item->id == $GETID) {
                            $exp = explode(" ",$item->modul);
                            break;
                        }
                    }
                }
                
                $data = tag_modul($exp);
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
                
            }
            
        }
        
        public function modul_add()
        {
            // print_r($_POST);
            $name = $this->input->post('name',TRUE);
            $query = "SELECT * FROM modul where UPPER(tag_mod) LIKE '%".strtoupper($name)."%'";
            $result = $this->db->query($query);
            $rowcount=$result->num_rows();
            $data = array();
            if($rowcount >0){
                foreach($result->result_array() AS $row) {
                    $data[] = array("id"=>$row['tag_mod'],"name"=>$row['tag_mod']);
                }
                }else{
                $data = array('id'=>0,'name'=>'None');
            }
            echo json_encode($data);
        }
        
        public function simpan_drag()
        {
            $index = $this->input->post('index',TRUE);
            $_index = decrypt_url($index);
            $arrayItems = $this->input->post('dataIDList');
            $exp = explode(',',$arrayItems);
            foreach($exp AS $val){
                $itemDecode[] = decrypt_url($val);
            }
            $gabung = implode(',',$itemDecode);
            $order = 0;
            $sql = $this->db->query("UPDATE `data_produk` set data_json='$gabung' where id='$_index' AND id_user='$this->iduser'");
            if($sql)
            {
                $arr = [
                "status"=>200,
                'title' =>'Update data',
                'msg'   =>'Data berhasil diupdate',
                'index' =>$index
                ];
            }
            else
            {
                $arr = [
                "status"=>201,
                'title' =>'Update data',
                'msg'   =>'Data gagal diupdate',
                'index' =>$index
                ];
            }
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($arr));
        }
        public function tagihan($id=null)
        {
            $data['title']       = 'Tagihan | lenteranews.tv';
            $data['description'] = 'description';
            $data['keywords']    = 'keywords';
            if(!empty($id))
            {
                $conditions['where'] = array(
                'gtbl_user.id_user' => $this->session->g_id,
                'pembayaran.id_beli' => decrypt_url($id)
                );
                $data['row'] = $this->model_data->getPembelianDetail($conditions);
                $row = $this->model_data->getPembelianDetail($conditions);
                $data['paket'] = $this->model_app->view_where('paket',array('id'=>$row['id_paket']));
                $data['bank'] = $this->model_app->view_where('akun_bank',array('status'=>1));
                $this->template->load(backend() . '/themes', backend() . '/invoice', $data);
            }
            else
            {
                // $data = array();
                
                // Get record count 
                $conditions['returnType'] = 'count';
                $totalRec = $this->model_data->getTagihan($conditions);
                
                // Pagination configuration 
                $config['target']      = '#posts_tagihan';
                $config['base_url']    = base_url('akun/ajaxTagihan');
                $config['total_rows']  = $totalRec;
                $config['per_page']    = $this->perPage;
                $config['link_func']   = 'searchTagihan';
                
                // Initialize pagination library 
                $this->ajax_pagination->initialize($config);
                
                // Get records 
                $conditions = array(
                'limit' => $this->perPage
                );
                $conditions['where'] = array(
                'pembelian.id_user' => $this->session->g_id
                );
                $data['posts'] = $this->model_data->getTagihan($conditions);
                
                $this->template->load(backend() . '/themes', backend() . '/tagihan', $data);
            }
        }
        function ajaxTagihan()
        {
            // Define offset 
            $page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
                } else {
                $offset = $page;
            }
            $keywords = $this->input->post('keywords');
            if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
            }
            $sortBy = $this->input->post('sortBy');
            if (!empty($sortBy)) {
                $conditions['search']['sortBy'] = $sortBy;
            }
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getTagihan($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_tagihan';
            $config['base_url']    = base_url('akun/ajaxTagihan');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchTagihan';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            $conditions['where'] = array(
            'pembelian.id_user' => $this->session->g_id
            );
            unset($conditions['returnType']);
            $data['posts'] = $this->model_data->getTagihan($conditions);
            
            
            // Load the data list view 
            $this->load->view(backend() . '/ajax/ajax-tagihan', $data, false);
        }
        public function pengguna()
        {
            $data['title']      = 'Pengguna | lenteranews.tv';
            $data['description'] = 'description';
            $data['keywords']    = 'keywords';
            
            // $data = array();
            $cekUser = cekUser($this->iduser);
            $data['lv'] = $cekUser['lv'];
            $data['id_level'] = $cekUser['idlv'];
            $data['idmenu'] = $cekUser['idmenu'];
            // Get record count 
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPengguna($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('akun/ajaxPengguna');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchFilter';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions = array(
            'limit' => $this->perPage
            );
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
            
            $data['posts'] = $this->model_data->getPengguna($conditions);
            
            $this->template->load(backend() . '/themes', backend() . '/pengguna', $data);
        }
        function ajaxPengguna()
        {
            // Define offset 
            $page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
                } else {
                $offset = $page;
            }
            $keywords = $this->input->post('keywords');
            if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
            }
            $sortBy = $this->input->post('sortBy');
            if (!empty($sortBy)) {
                $conditions['search']['sortBy'] = $sortBy;
            }
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPengguna($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('akun/ajaxPengguna');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchFilter';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
            // $sWhere = "WHERE level='owner' AND parent='$iduser' OR level='marketing' AND parent='$iduser'";
            unset($conditions['returnType']);
            $data['posts'] = $this->model_data->getPengguna($conditions);
            
            
            // Load the data list view 
            $this->load->view(backend() . '/ajax/ajax-pengguna', $data, false);
        }
        
        public function appid()
        {
            $data['title']       = 'APPID | lenteranews.tv';
            $data['description'] = 'description';
            $data['keywords']    = 'keywords';
            
            if($this->session->g_level=='admin'){
                // $data = array();
                
                $conditions['where'] = array(
                'api_key.id_user' => $this->session->g_id
                );
                // Get record count 
                $conditions['returnType'] = 'count';
                $totalRec = $this->model_data->getAppid($conditions);
                
                // Pagination configuration 
                $config['target']      = '#posts_content';
                $config['base_url']    = base_url('akun/ajaxAppid');
                $config['total_rows']  = $totalRec;
                $config['per_page']    = $this->perPage;
                $config['link_func']   = 'searchFilter';
                
                // Initialize pagination library 
                $this->ajax_pagination->initialize($config);
                
                // Get records 
                $conditions = array(
                'limit' => $this->perPage
                );
                
                $conditions['where'] = array(
                'api_key.id_user' => $this->session->g_id
                );
                
                $data['fetchw'] = $this->model_data->getAppid($conditions);
                
                $this->template->load(backend().'/themes',backend().'/appidadm',$data);
                }else{
                $select = ['api_key.id_user','api_key.judul','api_key.app_id','api_key.domain','api_key.token','api_key.auth','api_key.expire','gtbl_user.app_secret'];
                $where = ['api_key.id_user'=>$this->iduser];
                $data['fetchw'] = $this->model_app->view_join($select,'api_key','gtbl_user','id_user',$where);
                $this->template->load(backend().'/themes',backend().'/appid',$data);
            }
            
        }
        
        function ajaxAppid()
        {
            // Define offset 
            $page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
                } else {
                $offset = $page;
            }
            $keywords = $this->input->post('keywords');
            if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
            }
            $sortBy = $this->input->post('sortBy');
            if (!empty($sortBy)) {
                $conditions['search']['sortBy'] = $sortBy;
            }
            
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getAppid($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('akun/ajaxAppid');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchFilter';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            
            // $sWhere = "WHERE level='owner' AND parent='$iduser' OR level='marketing' AND parent='$iduser'";
            unset($conditions['returnType']);
            $data['fetchw'] = $this->model_data->getAppid($conditions);
            
            
            // Load the data list view 
            $this->load->view(backend() . '/ajax/ajax-appid', $data, false);
        }
        public function bank()
        {
            $id = decrypt_url($this->input->post('id',TRUE));
            $row = $this->model_app->view_where('akun_bank',array('id'=>$id))->row_array();
            if($id > 0){
                $arr = [
                
                'status'  =>200,
                'id'      =>$id,
                'title'   =>$row['nama_bank'],
                'norek'   =>$row['norek'],
                'pemilik' =>$row['pemilik']];
                }else{
                
                $arr = [
                'status'  =>201,
                'id'      =>$id,
                'title'   =>'',
                'norek'   =>'',
                'pemilik' =>''];
                
            }
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($arr));
        }
        public function simpan_invoice()
        {
            $id = decrypt_url($this->input->post('id',TRUE));
            $idorder = $this->input->post('idorder',TRUE);
            $idinvoice = decrypt_url($this->input->post('idinvoice',TRUE));
            $update = $this->model_app->update('pembayaran', ['id_bayar'=>$id], ['id'=>$idinvoice]);
            if($update['status']=='ok')
            {
                $arr = [
                'status'  =>200,
                'msg'      =>'Data berhasil disimpan'];
            }
            else
            {
                $arr = [
                'status'  =>201,
                'msg'      =>'Data gagal disimpan'];
            }
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($arr));
        }
    }                                                                                                                                                                                      