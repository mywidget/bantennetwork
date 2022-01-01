<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Crud_data extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            // $this->output->cache(1); 
            $this->tabel = 'data_';
            $this->iduser = $this->session->g_id;   
        }
        
        public function simpan_mesin()
        {
            $view = $this->input->post('view',TRUE);
            $type = $this->input->post('type',TRUE);
            if(empty($view) || empty($type)){
                redirect('main');
                exit();
            }
            
            $tabel = $this->tabel.$view;
            if($type=='new' AND $view=='mesin')
            {
                $_index = $this->input->post('id_index',TRUE);
                $index = decrypt_url($_index);
                $arr = $this->input->post();
                $array_data = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $modul=implode(' ',$this->input->post('modul'));
                $maxid = maxIDT($array_data->$view,'kdmesin');
                
                $valdata['kdmesin']               = $maxid;
                $valdata['namamesin']             = $this->input->post('nama_mesin',TRUE);
                $valdata['jumlahmin']             = $this->input->post('jumlah_min',TRUE);
                $valdata['hargamin']              = $this->input->post('harga_min',TRUE);
                $valdata['hargalebih']            = $this->input->post('harga_lebih',TRUE);
                $valdata['hargaminbw']            = !empty($this->input->post('min_bw',TRUE)) ? $this->input->post('min_bw',TRUE) : 0;
                $valdata['hargalebihbw']          = !empty($this->input->post('lebih_bw',TRUE)) ? $this->input->post('lebih_bw',TRUE) : 0;
                $valdata['hargamintintakhusus']   = !empty($this->input->post('min_khusus',TRUE)) ? $this->input->post('min_khusus',TRUE) : 0;
                $valdata['hargalebihtintakhusus'] = !empty($this->input->post('lebih_khusus',TRUE)) ? $this->input->post('lebih_khusus',TRUE) : 0;
                $valdata['biayabbplatsama']       = $this->input->post('plat_sama',TRUE);
                $valdata['lebarcetak']            = number_format($this->input->post('lebarc',TRUE),1,".",",");
                $valdata['panjangcetak']          = number_format($this->input->post('panjangc',TRUE),1,".",",");
                $valdata['lebarkertas']           = number_format($this->input->post('lebar',TRUE),1,".",",");
                $valdata['panjangkertas']         = number_format($this->input->post('panjang',TRUE),1,".",",");
                $valdata['min_panjang']           = number_format($this->input->post('min_panjang',TRUE),1,".",",");
                $valdata['min_lebar']             =  number_format($this->input->post('min_lebar',TRUE),1,".",",");
                $valdata['hargactp']              = $this->input->post('harga_ctp',TRUE);
                $valdata['replat']                = $this->input->post('replat',TRUE);
                $valdata['jenis_mesin']           = $this->input->post('jenis_mesin',TRUE);
                $valdata['aktif']                 = $this->input->post('aktif',TRUE);
                $valdata['tarikan']               = $this->input->post('tarikan',TRUE);
                $valdata['modul']                 = $modul;
                array_push($array_data->$view, $valdata);
                
                $updateData =  json_encode($array_data,JSON_NUMERIC_CHECK); 
                // echo $insert; 
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status" =>200,
                    'title'  =>'Simpan data',
                    'msg'    =>'Data berhasil disimpan',
                    'index'  =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                    }else{
                    $arr = [
                    "status" =>201,
                    'title'  =>'Simpan data',
                    'msg'    =>'Data gagal disimpan',
                    'index'  =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            
            if($type=='edit' AND $view=='mesin'){
                
                $nomor   = $this->input->post('nomor',TRUE);
                $cari    = $this->input->post('cari',TRUE);
                $getid   = decrypt_url($this->input->post('kdmesin',TRUE));
                $index   = decrypt_url($this->input->post('id_index',TRUE));
                $_index  = $this->input->post('id_index',TRUE);
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                $modul   =implode(' ',$this->input->post('modul'));
                
                foreach ($valdata as $key => $entry) 
                {
                    if ($entry->kdmesin == $getid) 
                    {
                        $valdata[$key]->namamesin = $this->input->post('nama_mesin',TRUE);
                        $valdata[$key]->jumlahmin = $this->input->post('jumlah_min',TRUE);
                        $valdata[$key]->hargamin = $this->input->post('harga_min',TRUE);
                        $valdata[$key]->hargalebih = $this->input->post('harga_lebih',TRUE);
                        $valdata[$key]->hargaminbw = $this->input->post('min_bw',TRUE);
                        $valdata[$key]->hargalebihbw = $this->input->post('lebih_bw',TRUE);
                        $valdata[$key]->hargamintintakhusus = $this->input->post('min_khusus',TRUE);
                        $valdata[$key]->hargalebihtintakhusus = $this->input->post('lebih_khusus',TRUE);
                        $valdata[$key]->biayabbplatsama = $this->input->post('plat_sama',TRUE);
                        $valdata[$key]->lebarcetak = number_format($this->input->post('lebarc',TRUE),1,".",",");
                        $valdata[$key]->panjangcetak = number_format($this->input->post('panjangc',TRUE),1,".",",");
                        $valdata[$key]->lebarkertas = number_format($this->input->post('lebar',TRUE),1,".",",");
                        $valdata[$key]->panjangkertas = number_format($this->input->post('panjang',TRUE),1,".",",");
                        $valdata[$key]->min_panjang = number_format($this->input->post('min_panjang',TRUE),1,".",",");
                        $valdata[$key]->min_lebar = number_format($this->input->post('min_lebar',TRUE),1,".",",");
                        $valdata[$key]->hargactp = $this->input->post('harga_ctp',TRUE);
                        $valdata[$key]->replat = $this->input->post('replat',TRUE);
                        $valdata[$key]->jenis_mesin = $this->input->post('jenis_mesin',TRUE);
                        $valdata[$key]->aktif = $this->input->post('aktif',TRUE);
                        $valdata[$key]->tarikan = number_format($this->input->post('tarikan',TRUE),1,".",",");
                        $valdata[$key]->modul = $modul;
                    }
                }
                // print_r($data);
                $updateData = json_encode($data,JSON_NUMERIC_CHECK);
                
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    'status'=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                    }else{
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            if($type=='hapus' AND $view=='mesin')
            {
                $nomor  = $this->input->post('nomor',TRUE);
                $cari   = $this->input->post('cari',TRUE);
                $getid  = decrypt_url($this->input->post('kdmesin',TRUE));
                $_index = $this->input->post('id_index',TRUE);
                $index  = decrypt_url($_index);
                //cek
                $valcek = $this->model_aplikasi->data_arrray(['table'=>'data_hargaprint','index'=>$index,'iduser'=>$this->iduser]);
                $cek = 0;
                foreach ($valcek->hargaprint as $key => $entry) 
                {
                    if ($entry->kdmesin == $getid) 
                    {
                        $cek = 1;
                    }
                }
                
                //
                
                if($cek==0)
                {
                    $valdata = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                    if(count($valdata->$view) > 1)
                    {
                        foreach ($valdata->mesin as $key => $entry) 
                        {
                            if ($entry->kdmesin == $getid) 
                            {
                                unset($entry); 
                                }else{
                                $new[] = $entry;
                            }
                        }
                        $arr2['mesin'] = array_values($new); 
                        // print_r($arr2);
                        $updateData = json_encode($arr2);  
                        $hapus = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                        if($hapus['status']=='ok')
                        {
                            $arr =[
                            "status"=>200,
                            'title' =>'Hapus data',
                            'msg'   =>'Data berhasil dihapus',
                            'index' =>$_index,
                            'cari'  =>$cari,
                            'page'  =>$nomor
                            ];
                        }
                        else
                        {
                            $arr =[
                            "status"=>201,
                            'title' =>'Hapus data',
                            'msg'   =>'Data gagal dihapus',
                            'index' =>$_index,
                            'cari'  =>$cari,
                            'page'  =>$nomor
                            ];
                        }    
                    }
                    else
                    {
                        $arr =[
                        "status"=>201,
                        'title'=>'Hapus data',
                        'msg'=>'Maaf sisakan satu',
                        'index'=>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor
                        ];
                    }
                }
                else
                {
                    
                    $arr = [
                    "status"=>201,
                    'title' =>'Hapus data',
                    'msg'   =>'Maaf mesin/printer masih digunakan',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            
        }
        //crud_bahan
        public function simpan_bahan()
        {
            $view = $this->input->post('view',TRUE);
            $type = $this->input->post('type',TRUE);
            if(empty($view) || empty($type)){
                redirect('main');
                exit();
            }
            $tabel = $this->tabel.$view;
            if($type=='new' AND $view=='bahan')
            {
                $getid   = decrypt_url($this->input->post('id',TRUE));
                $_index  = $this->input->post('id_index',TRUE);
                $index   = decrypt_url($_index);
                $cats     = $this->input->post('cats',TRUE);
                $array_data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                
                $maxid                  = maxIDT($array_data->bahan,'Kd_Bhn');
                $valdata['Kd_Bhn']      = $maxid;
                $valdata['id_kategori'] = $this->input->post('kategori');
                $valdata['Nm_Bhn']      = $this->input->post('Nm_Bhn');
                $valdata['Harga_Bahan'] = $this->input->post('Harga_Bahan');
                $valdata['Tinggi']      = $this->input->post('Tinggi');
                $valdata['Lebar']       = $this->input->post('Lebar');
                $valdata['Tebal']       = $this->input->post('Tebal');
                $valdata['Ceklist']     = 0;
                $valdata['publish']     = $this->input->post('publish');
                array_push($array_data->bahan, $valdata);
                
                $insert =  json_encode($array_data,JSON_NUMERIC_CHECK); 
                // echo $insert; 
                $new = $this->model_app->update($tabel,['data_json'=>$insert], ['id'=>$index,'id_user'=>$this->iduser]);
                if($new['status']=='ok')
                {
                    $arr =[
                    "status"=>200,
                    'title'=>'Simpan data',
                    'msg'=>'Data berhasil disimpan',
                    'index'=>$_index,
                    'cats'  =>$cats,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                else
                {
                    $arr =[
                    "status"=>201,
                    'title'=>'Simpan data',
                    'msg'=>'Data gagal disimpan',
                    'index'=>$_index,
                    'cats'  =>$cats,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            
            //edit
            if($type=='edit' AND $view=='bahan')
            {
                $nomor    = $this->input->post('nomor',TRUE);
                $cari     = $this->input->post('cari',TRUE);
                $cats     = $this->input->post('kat',TRUE);
                $getid    = decrypt_url($this->input->post('id',TRUE));
                $_index   = $this->input->post('id_index',TRUE);
                $index    = decrypt_url($_index);
                
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                foreach ($valdata as $key => $entry) 
                {
                    if ($entry->Kd_Bhn == $getid) 
                    {
                        $valdata[$key]->id_kategori	= $this->input->post('kategori');
                        $valdata[$key]->Nm_Bhn		= $this->input->post('Nm_Bhn');
                        $valdata[$key]->Harga_Bahan	= $this->input->post('Harga_Bahan');
                        $valdata[$key]->Tinggi		= $this->input->post('Tinggi');
                        $valdata[$key]->Lebar		= $this->input->post('Lebar');
                        $valdata[$key]->Tebal		= $this->input->post('Tebal');
                        $valdata[$key]->Ceklist		= 0;
                        $valdata[$key]->publish		= $this->input->post('publish');
                    }
                }
                // print_r($data);
                $updateData = json_encode($data,JSON_NUMERIC_CHECK);
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'index' =>$_index,
                    'cats'  =>$cats,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'index' =>$_index,
                    'cats'  =>$cats,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            
            //edit
            if($type=='hapus' AND $view=='bahan')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                
                $getid  = decrypt_url($this->input->post('id',TRUE));
                $_index = $this->input->post('id_index',TRUE);
                $index  = decrypt_url($_index);
                $valdata = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                if(count($valdata->$view) > 1)
                {
                    foreach ($valdata->$view as $key => $entry) 
                    {
                        if ($entry->Kd_Bhn == $getid) 
                        {
                            unset($entry); 
                            }else{
                            $new[] = $entry;
                        }
                    }
                    $arrUpdate[$view] = array_values($new);
                    $updateHapus = json_encode($arrUpdate);  
                    
                    $hapus = $this->model_app->update($tabel,['data_json'=>$updateHapus], ['id'=>$index,'id_user'=>$this->iduser]);
                    if($hapus['status']=='ok')
                    {
                        $arr =[
                        "status"=>200,
                        'title' =>'Hapus data',
                        'msg'   =>'Data berhasil dihapus',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                    else
                    {
                        $arr =[
                        "status"=>201,
                        'title' =>'Hapus data',
                        'msg'   =>'Data gagal dihapus',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Hapus data',
                    'msg'   =>'Maaf sisakan satu',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
        }
        
        //crud_katbahan
        public function simpan_katbahan()
        {
            // print_r($_POST);
            $view = $this->input->post('view',TRUE);
            $type = $this->input->post('type',TRUE);
            if(empty($view) || empty($type)){
                redirect('main');
                exit();
            }
            $tabel = $this->tabel.$view;
            //create
            if($type=='new' AND $view=='katbahan')
            {
                
                $_index = $this->input->post('id_index',TRUE);
                $index = decrypt_url($_index);
                $modul = implode(' ',$this->input->post('modul'));
                $array_data = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $maxid = maxIDT($array_data->$view,'id_kategori');
                
                $valdata['id_kategori']   = $maxid;
                $valdata['nama_kategori'] = $this->input->post('nama_kategori',TRUE);
                $valdata['id_jenis']      = $this->input->post('jenis',TRUE);
                $valdata['pub']           = $this->input->post('publish',TRUE);
                $valdata['hrg_a3']        = $this->input->post('print_a3',TRUE);
                $valdata['modul']         = $modul;
                
                array_push($array_data->$view, $valdata);
                
                $insertData =  json_encode($array_data,JSON_NUMERIC_CHECK); 
                $insert     = $this->model_app->update($tabel,['data_json'=>$insertData], ['id'=>$index,'id_user'=>$this->iduser]);
                
                if($insert['status']=='ok')
                {
                    $arr =[
                    "status"=>200,
                    'title' =>'Simpan data',
                    'msg'   =>'Data berhasil disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                else
                {
                    $arr =[
                    "status"=>201,
                    'title' =>'Simpan data',
                    'msg'   =>'Data gagal disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //update
            if($type=='edit' AND $view=='katbahan')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                $getid   = decrypt_url($this->input->post('id',TRUE));
                $_index  = $this->input->post('id_index',TRUE);
                $index   = decrypt_url($_index);
                $modul   = implode(' ',$this->input->post('modul'));
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                
                foreach ($valdata as $key => $entry) {
                    if ($entry->id_kategori == $getid) {
                        $valdata[$key]->nama_kategori 	= $this->input->post('nama_kategori');
                        $valdata[$key]->id_jenis 		= $this->input->post('jenis');
                        $valdata[$key]->pub 			= $this->input->post('publish');
                        $valdata[$key]->hrg_a3 			= $this->input->post('print_a3');
                        $valdata[$key]->modul 			= $modul;
                    }
                }
                
                $updateData = json_encode($data,JSON_NUMERIC_CHECK);
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //delete
            if($type=='hapus' AND $view=='katbahan')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                
                $getid  = decrypt_url($this->input->post('id',TRUE));
                $_index = $this->input->post('id_index',TRUE);
                $index  = decrypt_url($_index);
                //cek
                $valcek = $this->model_aplikasi->data_arrray(['table'=>'data_bahan','index'=>$index,'iduser'=>$this->iduser]);
                $cek = 0;
                foreach ($valcek->bahan as $key => $entry) 
                {
                    if ($entry->id_kategori == $getid) 
                    {
                        $cek = 1;
                    }
                }
                //
                if($cek==0)
                {
                    $valdata = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                    if(count($valdata->$view) > 1)
                    {
                        foreach ($valdata->$view as $key => $entry) 
                        {
                            if ($entry->id_kategori == $getid) 
                            {
                                unset($entry); 
                                }else{
                                $new[] = $entry;
                            }
                        }
                        $arrUpdate[$view] = array_values($new);
                        $updateHapus = json_encode($arrUpdate);  
                        
                        $hapus = $this->model_app->update($tabel,['data_json'=>$updateHapus], ['id'=>$index,'id_user'=>$this->iduser]);
                        if($hapus['status']=='ok')
                        {
                            $arr =[
                            "status"=>200,
                            'title' =>'Hapus data',
                            'msg'   =>'Data berhasil dihapus',
                            'index' =>$_index,
                            'cari'  =>$cari,
                            'page'  =>$nomor];
                        }
                        else
                        {
                            $arr =[
                            "status"=>201,
                            'title' =>'Hapus data',
                            'msg'   =>'Data gagal dihapus',
                            'index' =>$_index,
                            'cari'  =>$cari,
                            'page'  =>$nomor];
                        }
                    }
                    else
                    {
                        $arr = [
                        "status"=>201,
                        'title' =>'Hapus data',
                        'msg'   =>'Maaf sisakan satu',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor
                        ];
                    }
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Hapus data',
                    'msg'   =>'Maaf bahan masih digunakan',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
        }
        
        //crud_jenisbahan
        public function simpan_jenis()
        {
            // print_r($_POST);
            $view = $this->input->post('view',TRUE);
            $type = $this->input->post('type',TRUE);
            if(empty($view) || empty($type)){
                redirect('main');
                exit();
            }
            $tabel = $this->tabel.$view;
            //create
            if($type=='new' AND $view=='jenis')
            {
                $_index = $this->input->post('id_index',TRUE);
                $index = decrypt_url($_index);
                
                $array_data = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $maxid = maxIDT($array_data->$view,'id_jenis');
                
                $valdata['id_jenis']   = $maxid;
                $valdata['nama_jenis'] = $this->input->post('nama_jenis',TRUE);
                $valdata['pubj']       = $this->input->post('pub',TRUE);
                
                array_push($array_data->$view, $valdata);
                
                $insertData =  json_encode($array_data); 
                $insert = $this->model_app->update($tabel,['data_json'=>$insertData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($insert['status']=='ok')
                {
                    $arr =[
                    "status"=>200,
                    'title' =>'Simpan data',
                    'msg'   =>'Data berhasil disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                else
                {
                    $arr =[
                    "status"=>201,
                    'title' =>'Simpan data',
                    'msg'   =>'Data gagal disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //update
            if($type=='edit' AND $view=='jenis')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                
                $getid   = decrypt_url($this->input->post('id',TRUE));
                $_index  = $this->input->post('id_index',TRUE);
                $index   = decrypt_url($_index);
                
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                foreach ($valdata as $key => $entry) 
                {
                    if ($entry->id_jenis == $getid) 
                    {
                        
                        $valdata[$key]->nama_jenis = $this->input->post('nama_jenis',TRUE);
                        $valdata[$key]->pubj       = $this->input->post('pub',TRUE);
                        
                    }
                }
                // print_r($data);
                $updateData = json_encode($data);
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //delete
            if($type=='hapus' AND $view=='jenis')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                
                $getid  = decrypt_url($this->input->post('id',TRUE));
                $_index = $this->input->post('id_index',TRUE);
                $index  = decrypt_url($_index);
                
                $valcek = $this->model_aplikasi->data_arrray(['table'=>'data_katbahan','index'=>$index,'iduser'=>$this->iduser]);
                $cek = 0;
                foreach ($valcek->katbahan as $key => $entry) 
                {
                    if ($entry->id_jenis == $getid) 
                    {
                        $cek = 1;
                    }
                }
                if($cek==0)
                {
                    $valdata = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                    if(count($valdata->$view) > 1)
                    {
                        foreach ($valdata->$view as $key => $entry) 
                        {
                            if ($entry->id_jenis == $getid) 
                            {
                                unset($entry); 
                                }else{
                                $new[] = $entry;
                            }
                        }
                        
                        $arrUpdate[$view] = array_values($new);
                        $updateHapus      = json_encode($arrUpdate);  
                        
                        $hapus = $this->model_app->update($tabel,['data_json'=>$updateHapus], ['id'=>$index,'id_user'=>$this->iduser]);
                        if($hapus['status']=='ok')
                        {
                            $arr =[
                            "status"=>200,
                            'title' =>'Hapus data',
                            'msg'   =>'Data berhasil dihapus',
                            'index' =>$_index,
                            'cari'  =>$cari,
                            'page'  =>$nomor];
                        }
                        else
                        {
                            $arr =[
                            "status"=>201,
                            'title' =>'Hapus data',
                            'msg'   =>'Data gagal dihapus',
                            'index' =>$_index,
                            'cari'  =>$cari,
                            'page'  =>$nomor];
                        }
                        }else{
                        $arr = [
                        "status"=>201,
                        'title' =>'Hapus data',
                        'msg'   =>'Maaf sisakan satu',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor
                        ];
                    }
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title'=>'Hapus data',
                    'msg'=>'Maaf bahan masih digunakan',
                    'index'=>$_index,
                    'cari'=>$cari,
                    'page'=>$nomor
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
        } //end jenis
        //crud_kertas
        public function simpan_kertas()
        {
            // print_r($_POST);
            $view = $this->input->post('view',TRUE);
            $type = $this->input->post('type',TRUE);
            if(empty($view) || empty($type)){
                redirect('main');
                exit();
            }
            $tabel = $this->tabel.$view;
            //create
            if($type=='new' AND $view=='kertas')
            {
                $_index = $this->input->post('id_index',TRUE);
                $index = decrypt_url($_index);
                $modul = implode(' ',$this->input->post('modul'));
                $array_data = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $maxid = maxIDT($array_data->$view,'id');
                
                $valdata['id']         = $maxid;
                $valdata['ket_ukuran'] = $this->input->post('ket_ukuran');
                $valdata['panjang']    = $this->input->post('panjang');
                $valdata['lebar']      = $this->input->post('lebar');
                $valdata['modul']      = $modul;
                
                array_push($array_data->$view, $valdata);
                
                $insertData =  json_encode($array_data,JSON_NUMERIC_CHECK); 
                $insert     = $this->model_app->update($tabel,['data_json'=>$insertData], ['id'=>$index,'id_user'=>$this->iduser]);
                
                if($insert['status']=='ok')
                {
                    $arr =[
                    "status"=>200,
                    'title' =>'Simpan data',
                    'msg'   =>'Data berhasil disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                else
                {
                    $arr =[
                    "status"=>201,
                    'title' =>'Simpan data',
                    'msg'   =>'Data gagal disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //update
            if($type=='edit' AND $view=='kertas')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                $getid   = decrypt_url($this->input->post('id',TRUE));
                $_index  = $this->input->post('id_index',TRUE);
                $index   = decrypt_url($_index);
                $modul   = implode(' ',$this->input->post('modul'));
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                
                foreach ($valdata as $key => $entry) 
                {
                    if ($entry->id == $getid) 
                    {
                        
                        $valdata[$key]->ket_ukuran = $this->input->post('ket_ukuran',TRUE);
                        $valdata[$key]->panjang    = $this->input->post('panjang',TRUE);
                        $valdata[$key]->lebar      = $this->input->post('lebar',TRUE);
                        $valdata[$key]->modul      = $modul;
                        
                    }
                }
                
                $updateData = json_encode($data,JSON_NUMERIC_CHECK);
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr,JSON_NUMERIC_CHECK));
            }
            //delete
            if($type=='hapus' AND $view=='kertas')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                
                $getid  = decrypt_url($this->input->post('id',TRUE));
                $_index = $this->input->post('id_index',TRUE);
                $index  = decrypt_url($_index);
                
                $valdata = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                if(count($valdata->$view) > 1)
                {
                    foreach ($valdata->$view as $key => $entry) 
                    {
                        if ($entry->id == $getid) 
                        {
                            unset($entry); 
                            }else{
                            $new[] = $entry;
                        }
                    }
                    $arrUpdate[$view] = array_values($new);
                    $updateHapus = json_encode($arrUpdate);  
                    
                    $hapus = $this->model_app->update($tabel,['data_json'=>$updateHapus], ['id'=>$index,'id_user'=>$this->iduser]);
                    if($hapus['status']=='ok')
                    {
                        $arr =[
                        "status"=>200,
                        'title' =>'Hapus data',
                        'msg'   =>'Data berhasil dihapus',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                    else
                    {
                        $arr =[
                        "status"=>201,
                        'title' =>'Hapus data',
                        'msg'   =>'Data gagal dihapus',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                    }else{
                    $arr = [
                    "status"=>201,
                    'title' =>'Hapus data',
                    'msg'   =>'Maaf sisakan satu',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
        }
        public function simpan_biaya()
        {
            $view = $this->input->post('view',TRUE);
            $type = $this->input->post('type',TRUE);
            if(empty($view) || empty($type)){
                redirect('main');
                exit();
            }
            $tabel = $this->tabel.$view;
            //create
            if($type=='new' AND $view=='biaya')
            {
                $_index     = $this->input->post('id_index',TRUE);
                $index      = decrypt_url($_index);
                $array_data = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $maxid      = maxIDT($array_data->$view,'KdBiaya');
                
                $valdata['KdBiaya']    = $maxid;
                $valdata['Nama_Biaya'] = $this->input->post('nama_biaya');
                $valdata['JumlahMin']  = !empty($this->input->post('jumlahmin')) ? $this->input->post('jumlahmin') : 0;
                $valdata['HargaMin']   = !empty($this->input->post('hargamin')) ? $this->input->post('hargamin') : 0;
                $valdata['HargaLebih'] = !empty($this->input->post('hargalebih')) ? $this->input->post('hargalebih') : 0;
                $valdata['Groups']     = $this->input->post('groups');
                $valdata['Panjang']    = !empty($this->input->post('panjang')) ? $this->input->post('panjang') : 0;
                $valdata['Lebar']      = !empty($this->input->post('lebar')) ? $this->input->post('lebar') : 0 ;
                $valdata['publish']    = $this->input->post('publish');
                
                array_push($array_data->$view, $valdata);
                
                $insertData =  json_encode($array_data,JSON_NUMERIC_CHECK); 
                $insert     = $this->model_app->update($tabel,['data_json'=>$insertData], ['id'=>$index,'id_user'=>$this->iduser]);
                
                if($insert['status']=='ok')
                {
                    $arr =[
                    "status"=>200,
                    'title' =>'Simpan data',
                    'msg'   =>'Data berhasil disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                else
                {
                    $arr =[
                    "status"=>201,
                    'title' =>'Simpan data',
                    'msg'   =>'Data gagal disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //update
            if($type=='edit' AND $view=='biaya')
            {
                $nomor   = $this->input->post('nomor',TRUE);
                $cari    = $this->input->post('cari',TRUE);
                $getid   = decrypt_url($this->input->post('id',TRUE));
                $_index  = $this->input->post('id_index',TRUE);
                $index   = decrypt_url($_index);
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                
                foreach ($valdata as $key => $entry) 
                {
                    if ($entry->KdBiaya == $getid) 
                    {
                        
                        $valdata[$key]->Nama_Biaya  = $this->input->post('nama_biaya',TRUE);
						$valdata[$key]->JumlahMin   = number_format($this->input->post('jumlahmin',TRUE),2,".","");
						$valdata[$key]->HargaMin    = !empty($this->input->post('hargamin',TRUE)) ? $this->input->post('hargamin') : 0;
						$valdata[$key]->HargaLebih  = !empty($this->input->post('hargalebih',TRUE)) ? $this->input->post('hargalebih') : 0;
						$valdata[$key]->Groups      = $this->input->post('groups',TRUE);
						$valdata[$key]->Panjang     = !empty($this->input->post('panjang')) ? $this->input->post('panjang',TRUE) : 0;
						$valdata[$key]->Lebar       = !empty($this->input->post('lebar')) ? $this->input->post('lebar',TRUE) : 0;
						$valdata[$key]->status      = 1;
						$valdata[$key]->publish     = $this->input->post('publish',TRUE);
                        
                    }
                }
                
                $updateData = json_encode($data,JSON_NUMERIC_CHECK);
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //delete
            if($type=='hapus' AND $view=='biaya')
            {
                // print_r($_POST);
                $nomor  = $this->input->post('nomor',TRUE);
                $cari   = $this->input->post('cari',TRUE);
                $getid  = decrypt_url($this->input->post('id',TRUE));
                $_index = $this->input->post('id_index',TRUE);
                $index  = decrypt_url($_index);
                
                $valdata = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                if(count($valdata->$view) > 1)
                {
                    foreach ($valdata->$view as $key => $entry) 
                    {
                        if ($entry->KdBiaya == $getid) 
                        {
                            unset($entry); 
                            }else{
                            $new[] = $entry;
                        }
                    }
                    $arrUpdate[$view] = array_values($new);
                    $updateHapus = json_encode($arrUpdate);  
                    
                    $hapus = $this->model_app->update($tabel,['data_json'=>$updateHapus], ['id'=>$index,'id_user'=>$this->iduser]);
                    if($hapus['status']=='ok')
                    {
                        $arr =[
                        "status"=>200,
                        'title' =>'Hapus data',
                        'msg'   =>'Data berhasil dihapus',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                    else
                    {
                        $arr =[
                        "status"=>201,
                        'title' =>'Hapus data',
                        'msg'   =>'Data gagal dihapus',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Hapus data',
                    'msg'   =>'Maaf sisakan satu',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
        }
        //insheet
        public function simpan_insheet()
        {
            $view = $this->input->post('view',TRUE);
            $type = $this->input->post('type',TRUE);
            if(empty($view) || empty($type)){
                redirect('main');
                exit();
            }
            $tabel = $this->tabel.$view;
            //create
            if($type=='new' AND $view=='insheet')
            {
                $_index     = $this->input->post('id_index',TRUE);
                $index      = decrypt_url($_index);
                $array_data = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                
                $maxid                 = maxIDT($array_data->$view,'id_insheet');
                $valdata['id_insheet'] = $maxid;
                $valdata['dari']       = $this->input->post('dari',TRUE);
                $valdata['sampai']     = $this->input->post('sampai',TRUE);
                $valdata['insheet']    = number_format($this->input->post('insheet',TRUE),2);
                $valdata['insheet_bb'] = number_format($this->input->post('insheet_bb',TRUE),2);
                
                array_push($array_data->$view, $valdata);
                
                $insertData =  json_encode($array_data,JSON_NUMERIC_CHECK); 
                $insert     = $this->model_app->update($tabel,['data_json'=>$insertData], ['id'=>$index,'id_user'=>$this->iduser]);
                
                if($insert['status']=='ok')
                {
                    $arr =[
                    "status"=>200,
                    'title' =>'Simpan data',
                    'msg'   =>'Data berhasil disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                else
                {
                    $arr =[
                    "status"=>201,
                    'title' =>'Simpan data',
                    'msg'   =>'Data gagal disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //update
            if($type=='edit' AND $view=='insheet')
            {
                $nomor   = $this->input->post('nomor',TRUE);
                $cari    = $this->input->post('cari',TRUE);
                $getid   = decrypt_url($this->input->post('id',TRUE));
                $_index  = $this->input->post('id_index',TRUE);
                $index   = decrypt_url($_index);
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                
                foreach ($valdata as $key => $entry) 
                {
                    if ($entry->id_insheet == $getid) 
                    {
                        
                        $valdata[$key]->dari       = $this->input->post('dari',TRUE);
                        $valdata[$key]->sampai     = $this->input->post('sampai',TRUE);
                        $valdata[$key]->insheet    = number_format($this->input->post('insheet',TRUE),2);
                        $valdata[$key]->insheet_bb = number_format($this->input->post('insheet_bb',TRUE),2);
                        
                    }
                }
                
                $updateData = json_encode($data,JSON_NUMERIC_CHECK);
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //delete
            if($type=='hapus' AND $view=='insheet')
            {
                // print_r($_POST);
                $nomor  = $this->input->post('nomor',TRUE);
                $cari   = $this->input->post('cari',TRUE);
                $getid  = decrypt_url($this->input->post('id',TRUE));
                $_index = $this->input->post('id_index',TRUE);
                $index  = decrypt_url($_index);
                
                $valdata = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                if(count($valdata->$view) > 1)
                {
                    foreach ($valdata->$view as $key => $entry) 
                    {
                        if ($entry->id_insheet == $getid) 
                        {
                            unset($entry); 
                            }else{
                            $new[] = $entry;
                        }
                    }
                    $arrUpdate[$view] = array_values($new);
                    $updateHapus = json_encode($arrUpdate);  
                    
                    $hapus = $this->model_app->update($tabel,['data_json'=>$updateHapus], ['id'=>$index,'id_user'=>$this->iduser]);
                    if($hapus['status']=='ok')
                    {
                        $arr =[
                        "status"=>200,
                        'title' =>'Hapus data',
                        'msg'   =>'Data berhasil dihapus',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                    else
                    {
                        $arr =[
                        "status"=>201,
                        'title' =>'Hapus data',
                        'msg'   =>'Data gagal dihapus',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Hapus data',
                    'msg'   =>'Maaf sisakan satu',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
        } //end insheet_bb
        
        //crud_hargaprint
        public function simpan_hargaprint()
        {
            $view = $this->input->post('view',TRUE);
            $type = $this->input->post('type',TRUE);
            if(empty($view) || empty($type)){
                redirect('main');
                exit();
            }
            $tabel = $this->tabel.$view;
            //create
            if($type=='new' AND $view=='hargaprint')
            {
                
                $_index = $this->input->post('id_index',TRUE);
                $index = decrypt_url($_index);
                $modul = implode(' ',$this->input->post('modul'));
                $array_data = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $maxid = maxIDT($array_data->$view,'id');
                
                $valdata['id'] = $maxid;
                $valdata['kdmesin'] = $this->input->post('kdmesin',TRUE);
                $valdata['jml_min'] = $this->input->post('jml_min',TRUE);
                $valdata['jml_max'] = $this->input->post('jml_max',TRUE);
                $valdata['harga']   = $this->input->post('harga',TRUE);
                $valdata['harga_laminating'] = $this->input->post('laminating',TRUE);
                $valdata['modul']   = $modul;
                
                array_push($array_data->$view, $valdata);
                
                $insertData =  json_encode($array_data,JSON_NUMERIC_CHECK); 
                $insert     = $this->model_app->update($tabel,['data_json'=>$insertData], ['id'=>$index,'id_user'=>$this->iduser]);
                
                if($insert['status']=='ok')
                {
                    $arr =[
                    "status"=>200,
                    'title' =>'Simpan data',
                    'msg'   =>'Data berhasil disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                else
                {
                    $arr =[
                    "status"=>201,
                    'title' =>'Simpan data',
                    'msg'   =>'Data gagal disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //update
            if($type=='edit' AND $view=='hargaprint')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                $getid   = decrypt_url($this->input->post('id',TRUE));
                $_index  = $this->input->post('id_index',TRUE);
                $index   = decrypt_url($_index);
                $modul   = implode(' ',$this->input->post('modul'));
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                
                foreach ($valdata as $key => $entry) {
                    if ($entry->id == $getid) {
                        $valdata[$key]->kdmesin = $this->input->post('kdmesin',TRUE);
                        $valdata[$key]->jml_min = $this->input->post('jml_min',TRUE);
                        $valdata[$key]->jml_max = $this->input->post('jml_max',TRUE);
                        $valdata[$key]->harga = $this->input->post('harga',TRUE);
                        $valdata[$key]->harga_laminating = $this->input->post('laminating',TRUE);
                        $valdata[$key]->modul = $modul;
                    }
                }
                
                $updateData = json_encode($data,JSON_NUMERIC_CHECK);
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //delete
            if($type=='hapus' AND $view=='hargaprint')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                
                $getid  = decrypt_url($this->input->post('id',TRUE));
                $_index = $this->input->post('id_index',TRUE);
                $index  = decrypt_url($_index);
                
                $valdata = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                if(count($valdata->$view) > 1)
                {
                    foreach ($valdata->$view as $key => $entry) 
                    {
                        if ($entry->id == $getid) 
                        {
                            unset($entry); 
                            }else{
                            $new[] = $entry;
                        }
                    }
                    $arrUpdate[$view] = array_values($new);
                    $updateHapus = json_encode($arrUpdate);  
                    
                    $hapus = $this->model_app->update($tabel,['data_json'=>$updateHapus], ['id'=>$index,'id_user'=>$this->iduser]);
                    if($hapus['status']=='ok')
                    {
                        $arr =[
                        "status"=>200,
                        'title' =>'Hapus data',
                        'msg'   =>'Data berhasil dihapus',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                    else
                    {
                        $arr =[
                        "status"=>201,
                        'title' =>'Hapus data',
                        'msg'   =>'Data gagal dihapus',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Hapus data',
                    'msg'   =>'Maaf sisakan satu',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
        } //end hargaprint view_where_ordering($table,$data,$order,$ordering)
        public function get_produk()
        {
            $getid  = decrypt_url($this->input->post('id',TRUE));
            $where = ['id'=>$getid,'id_user'=>$this->iduser];
            $data['produk'] = $this->model_app->edit('data_produk', $where)->row_array();
            $data['modul'] = $this->model_app->view_where_ordering('modul',['publish'=>'Y'],'urutan','ASC');
            $this->load->view(backend() . '/aplikasi/load_produk', $data, false);
        }
        public function simpan_produk()
        {
			$index = $this->input->post('id_index',TRUE);
			$ptype = $this->input->post('type',TRUE);
			$GETID  = decrypt_url($index);
			if($GETID > 0) {
				if($ptype=='produk') {
					$valdata = $this->input->post('data_produk');
					if(!empty($valdata)):
					$updateData = implode(',',$valdata);
                    $update = $this->model_app->update('data_produk',['data_json'=>$updateData], ['id'=>$GETID,'id_user'=>$this->iduser]);
                    if($update['status']=='ok')
                    {
                        $arr = [
                        "status"=>200,
                        "index"=>$index,
                        'title' =>'Simpan data',
                        'msg'   =>'Data berhasil disimpan',
                        'kelas' =>'success'
                        ];
                    }
                    else
                    {
                        $arr = [
                        "status"=>201,
                        "index"=>'',
                        'title' =>'Simpan data',
                        'msg'   =>'Data gagal disimpan',
                        'kelas' =>'error'
                        ];
                    }
					endif;
                    $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($arr));
                }
            }
        }
        //crud_plano
        public function simpan_plano()
        {
            // print_r($_POST);
            $view = $this->input->post('view',TRUE);
            $type = $this->input->post('type',TRUE);
            if(empty($view) || empty($type)){
                redirect('main');
                exit();
            }
            $tabel = $this->tabel.$view;
            //create
            if($type=='new' AND $view=='plano')
            {
                $_index = $this->input->post('id_index',TRUE);
                $index = decrypt_url($_index);
                
                $array_data = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $maxid = maxIDT($array_data->$view,'id');
                
                $valdata['id']         = $maxid;
                $valdata['ket_ukuran'] = $this->input->post('nama',TRUE);
                $valdata['panjang']    = $this->input->post('panjang',TRUE);
                $valdata['lebar']      = $this->input->post('lebar',TRUE);
                
                array_push($array_data->$view, $valdata);
                
                $insertData =  json_encode($array_data,JSON_NUMERIC_CHECK); 
                $insert = $this->model_app->update($tabel,['data_json'=>$insertData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($insert['status']=='ok')
                {
                    $arr =[
                    "status"=>200,
                    'title' =>'Simpan data',
                    'msg'   =>'Data berhasil disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                else
                {
                    $arr =[
                    "status"=>201,
                    'title' =>'Simpan data',
                    'msg'   =>'Data gagal disimpan',
                    'index' =>$_index,
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //update
            if($type=='edit' AND $view=='plano')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                
                $getid   = decrypt_url($this->input->post('id',TRUE));
                $_index  = $this->input->post('id_index',TRUE);
                $index   = decrypt_url($_index);
                
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                foreach ($valdata as $key => $entry) 
                {
                    if ($entry->id == $getid) 
                    {
                        
                        $valdata[$key]->ket_ukuran = $this->input->post('nama',TRUE);
                        $valdata[$key]->panjang    = $this->input->post('panjang',TRUE);
                        $valdata[$key]->lebar      = $this->input->post('lebar',TRUE);
                        
                    }
                }
                // print_r($data);
                $updateData = json_encode($data,JSON_NUMERIC_CHECK);
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //delete
            if($type=='hapus' AND $view=='plano')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                
                $getid  = decrypt_url($this->input->post('id',TRUE));
                $_index = $this->input->post('id_index',TRUE);
                $index  = decrypt_url($_index);
                
                $valdata = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                if(count($valdata->$view) > 1)
                {
                    foreach ($valdata->$view as $key => $entry) 
                    {
                        if ($entry->id == $getid) 
                        {
                            unset($entry); 
                            }else{
                            $new[] = $entry;
                        }
                    }
                    
                    $arrUpdate[$view] = array_values($new);
                    $updateHapus      = json_encode($arrUpdate);  
                    
                    $hapus = $this->model_app->update($tabel,['data_json'=>$updateHapus], ['id'=>$index,'id_user'=>$this->iduser]);
                    if($hapus['status']=='ok')
                    {
                        $arr =[
                        "status"=>200,
                        'title' =>'Hapus data',
                        'msg'   =>'Data berhasil dihapus',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                    else
                    {
                        $arr =[
                        "status"=>201,
                        'title' =>'Hapus data',
                        'msg'   =>'Data gagal dihapus',
                        'index' =>$_index,
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                    }else{
                    $arr = [
                    "status"=>201,
                    'title' =>'Hapus data',
                    'msg'   =>'Maaf sisakan satu',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
        }
        //crud_theme
        public function simpan_theme()
        {
            $view = $this->input->post('view',TRUE);
            $type = $this->input->post('type',TRUE);
            
            if(empty($view) || empty($type)){
                redirect('main');
                exit();
            }
            $tabel = $this->tabel.$view;
            //update
            if($type=='edit' AND $view=='theme')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                
                $getid   = decrypt_url($this->input->post('id',TRUE));
                $_index  = $this->input->post('id_index',TRUE);
                $index   = decrypt_url($_index);
                
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                foreach ($valdata as $key => $entry) 
                {
                    if ($entry->id == $getid) 
                    {
                        
                        $valdata[$key]->nama  = $this->input->post('nama',TRUE);
                        $valdata[$key]->kolom = $this->input->post('kolom',TRUE);
                        $valdata[$key]->limit = $this->input->post('limit',TRUE);
                        
                    }
                }
                // print_r($data);
                $updateData = json_encode($data,JSON_NUMERIC_CHECK);
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //pub
            if($type=='pub' AND $view=='theme')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                
                $getid   = decrypt_url($this->input->post('id',TRUE));
                $_index  = $this->input->post('index',TRUE);
                $index   = decrypt_url($_index);
                
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                $customShift['theme'] = customShift($valdata, $getid);
                // print_r($data);
                $updateData = json_encode($customShift,JSON_NUMERIC_CHECK);
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                foreach ($valdata as $key => $entry) 
                {
                    if ($entry->id == $getid) 
                    {
                        $valdata[$key]->pub  = $this->input->post('pub',TRUE);
                        }else{
                        $valdata[$key]->pub  = "N";
                    }
                }
                // print_r($data);
                $update_Data = json_encode($data,JSON_NUMERIC_CHECK);
                $this->model_app->update($tabel,['data_json'=>$update_Data], ['id'=>$index,'id_user'=>$this->iduser]);
                
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
        }
        //crud limit
        public function simpan_limit()
        {
            $view = $this->input->post('view',TRUE);
            $type = $this->input->post('type',TRUE);
            
            if(empty($view) || empty($type)){
                redirect('main');
                exit();
            }
            $tabel = $this->tabel.$view;
            //update
            if($type=='edit' AND $view=='limit')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                
                $getid   = decrypt_url($this->input->post('id',TRUE));
                $_index  = $this->input->post('id_index',TRUE);
                $index   = decrypt_url($_index);
                
                $data    = $this->model_aplikasi->data_arrray(['table'=>$tabel,'index'=>$index,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                foreach ($valdata as $key => $entry) 
                {
                    if ($entry->id == $getid) 
                    {
                        
                        $valdata[$key]->nama  = $this->input->post('nama',TRUE);
                        $valdata[$key]->klass = $this->input->post('cklass',TRUE);
                        $valdata[$key]->style = $this->input->post('cstyle',TRUE);
                        $valdata[$key]->pub = $this->input->post('pub',TRUE);
                        
                    }
                }
                // print_r($data);
                $updateData = json_encode($data,JSON_NUMERIC_CHECK);
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id'=>$index,'id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'index' =>$_index,
                    'cari'  =>$cari,
                    'page'  =>$nomor];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //pub
        }
        //crud konsumen
        public function simpan_konsumen()
        {
            $view = $this->input->post('view',TRUE);
            $type = $this->input->post('type',TRUE);
            
            if(empty($view) || empty($type)){
                redirect('main');
                exit();
            }
            $tabel = $this->tabel.$view;
            //create
            if($type=='new' AND $view=='konsumen')
            {
                
                $array_data = $this->model_aplikasi->data_array(['table'=>$tabel,'iduser'=>$this->iduser]);
                $maxid = maxIDT($array_data->$view,'id');
                
                $valdata['id']          = $maxid;
				$valdata['nama']       = $this->input->post('nama',TRUE);
				$valdata['jabatan']    = $this->input->post('jabatan',TRUE);
				$valdata['email']      = $this->input->post('email',TRUE);
				$valdata['telp']       = $this->input->post('telp',TRUE);
				$valdata['alamat']     = $this->input->post('alamat',TRUE);
				$valdata['perusahaan'] = $this->input->post('perusahaan',TRUE);
				$valdata['tgl']        = date('Y-m-d');
                
                array_push($array_data->$view, $valdata);
                
                $insertData =  json_encode($array_data,JSON_NUMERIC_CHECK); 
                $insert = $this->model_app->update($tabel,['data_json'=>$insertData], ['id_user'=>$this->iduser]);
                if($insert['status']=='ok')
                {
                    $arr =[
                    "status"=>200,
                    'title' =>'Simpan data',
                    'msg'   =>'Data berhasil disimpan',
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                else
                {
                    $arr =[
                    "status"=>201,
                    'title' =>'Simpan data',
                    'msg'   =>'Data gagal disimpan',
                    'cari'  =>'',
                    'page'  =>1
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //update
            if($type=='edit' AND $view=='konsumen')
            {
                $nomor = $this->input->post('nomor',TRUE);
                $cari  = $this->input->post('cari',TRUE);
                
                $getid   = decrypt_url($this->input->post('id',TRUE));
                
                $data    = $this->model_aplikasi->data_array(['table'=>$tabel,'iduser'=>$this->iduser]);
                $valdata = $data->$view;
                foreach ($valdata as $key => $entry) 
                {
                    if ($entry->id == $getid) 
                    {
                        $valdata[$key]->nama       = $this->input->post('nama',TRUE);
                        $valdata[$key]->jabatan    = $this->input->post('jabatan',TRUE);
                        $valdata[$key]->email      = $this->input->post('email',TRUE);
                        $valdata[$key]->telp       = $this->input->post('telp',TRUE);
                        $valdata[$key]->perusahaan = $this->input->post('perusahaan',TRUE);
                        $valdata[$key]->alamat     = $this->input->post('alamat',TRUE);
                    }
                }
                // print_r($data);
                $updateData = json_encode($data,JSON_NUMERIC_CHECK);
                $update = $this->model_app->update($tabel,['data_json'=>$updateData], ['id_user'=>$this->iduser]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate',
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate',
                    'cari'  =>$cari,
                    'page'  =>$nomor];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
            //delete
            if($type=='hapus' AND $view=='konsumen')
            {
                // print_r($_POST);
                $nomor  = $this->input->post('nomor',TRUE);
                $cari   = $this->input->post('cari',TRUE);
                $getid  = decrypt_url($this->input->post('id',TRUE));
                
                
                $valdata = $this->model_aplikasi->data_array(['table'=>$tabel,'iduser'=>$this->iduser]);
                if(count($valdata->$view) > 1)
                {
                    foreach ($valdata->$view as $key => $entry) 
                    {
                        if ($entry->id == $getid) 
                        {
                            unset($entry); 
                            }else{
                            $new[] = $entry;
                        }
                    }
                    $arrUpdate[$view] = array_values($new);
                    $updateHapus = json_encode($arrUpdate);  
                    
                    $hapus = $this->model_app->update($tabel,['data_json'=>$updateHapus], ['id_user'=>$this->iduser]);
                    if($hapus['status']=='ok')
                    {
                        $arr =[
                        "status"=>200,
                        'title' =>'Hapus data',
                        'msg'   =>'Data berhasil dihapus',
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                    else
                    {
                        $arr =[
                        "status"=>201,
                        'title' =>'Hapus data',
                        'msg'   =>'Data gagal dihapus',
                        'cari'  =>$cari,
                        'page'  =>$nomor];
                    }
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Hapus data',
                    'msg'   =>'Maaf sisakan satu',
                    'cari'  =>$cari,
                    'page'  =>$nomor
                    ];
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
            }
        }
        public function load_data()
        {
            $getid   = decrypt_url($this->input->post('id',TRUE));
            $get_data = $this->model_app->view_where('gtbl_user',['id_user'=>$getid])->result_array();
            // echo "<pre>";
            // echo $get_data[0]['email'];
            // echo "</pre>";
            
            $data = [
            "id"                 => encrypt_url($get_data[0]['id_user']),
            "title"              => $get_data[0]['nama_lengkap'],
            "address"            => $get_data[0]['alamat'],
            "mail"               => $get_data[0]['email'],
            "phone"              => $get_data[0]['no_hp'],
            "tgldaftar"          => tanggal($get_data[0]['tgl_daftar']),
            "img_profil"         => $get_data[0]['profile_image'],
            "aktif"            => $get_data[0]['aktif'],
            "profit"             => $get_data[0]['profit'],
            "img_logo"           => $get_data[0]['logo'],
            "stamp"              => $get_data[0]['stamp'],
            "percetakan"         => $get_data[0]['percetakan'],
            "website"            => $get_data[0]['nama_web']
            ];
            // print_r($array);
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
        }
        
        public function load_appid()
        {
            
            $type   = $this->input->post('type',TRUE);
            if($type=='get'){
                
                $getid   = decrypt_url($this->input->post('id',TRUE));
                $get_data = $this->model_app->view_where('api_key',['id'=>$getid])->row_array();
                $key = $this->model_app->view_where('gtbl_user',['id_user'=>$get_data['id_user']])->row_array();
                
                $arr         = [
                "id"         => encrypt_url($get_data['id']),
                "token"      => encrypt_url($get_data['auth']),
                "title"      => $get_data['judul'],
                "appid"      => $get_data['app_id'],
                "secret"     => $key['app_secret'],
                "website"    => $get_data['domain'],
                "expire"     => tanggal($get_data['expire']),
                "pub"        => $get_data['pub'],
                ];
                }elseif($type=='new'){
                $data        = [
                "judul"      => $this->input->post('title',TRUE),
                "id_user"    => $this->iduser,
                "app_id"     => $this->input->post('appid',TRUE),
                "domain"     => $this->input->post('website',TRUE),
                "expire"     => $this->input->post('expire',TRUE),
                "pub"        => $this->input->post('publish',TRUE)];
                
                $update = $this->model_app->input('api_key',$data);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data',
                    'msg'   =>'Data berhasil diupdate '
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate'
                    ];
                }
                }elseif($type=='edit'){
                
                $id     = decrypt_url($this->input->post('id',TRUE));
                $token  = decrypt_url($this->input->post('token',TRUE));
                
                $data = [
                "judul"   => $this->input->post('title',TRUE),
                "app_id"   => $this->input->post('appid',TRUE),
                "domain" => $this->input->post('website',TRUE),
                "expire" => $this->input->post('expire',TRUE),
                "pub" => $this->input->post('publish',TRUE)];
                
                // $update = $this->model_app->update('api_key',$data, ['auth'=>$token,'id'=>$id]);
                $update = $this->model_app->update('api_key',$data, ['id'=>$id]);
                if($update['status']=='ok')
                {
                    $arr = [
                    "status"=>200,
                    'title' =>'Update data '.$id,
                    'msg'   =>'Data berhasil diupdate '.$token
                    ];
                }
                else
                {
                    $arr = [
                    "status"=>201,
                    'title' =>'Update data',
                    'msg'   =>'Data gagal diupdate'
                    ];
                }
            }
            // print_r($array);
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($arr));
        }
        public function simpan_pengguna()
        {
            print_r($_POST);
            // $postid   = decrypt_url($this->input->post('id',TRUE));
            
            // $data = [
            // "id"                 => encrypt_url($get_data[0]['id_user']),
            // "title"              => $get_data[0]['nama_lengkap'],
            // "address"            => $get_data[0]['alamat'],
            // "mail"               => $get_data[0]['email'],
            // "phone"              => $get_data[0]['no_hp'],
            // "tgldaftar"          => tanggal($get_data[0]['tgl_daftar']),
            // "img_profil"         => $get_data[0]['profile_image'],
            // "publish"            => $get_data[0]['aktif'],
            // "profit"             => $get_data[0]['profit'],
            // "img_logo"           => $get_data[0]['logo'],
            // "stamp"              => $get_data[0]['stamp'],
            // "percetakan"         => $get_data[0]['percetakan'],
            // "website"            => $get_data[0]['nama_web']
            // ];
            // $data_post = [
            
            // ]
            // $update = $this->model_app->update('gtbl_user',$data_post, ['id_user'=>$postid]);
            // if($update['status']=='ok')
            // {
            // $arr = [
            // "status"=>200,
            // 'title' =>'Update data',
            // 'msg'   =>'Data berhasil diupdate',
            // 'cari'  =>$cari,
            // 'page'  =>$nomor
            // ];
            // }
            // else
            // {
            // $arr = [
            // "status"=>201,
            // 'title' =>'Update data',
            // 'msg'   =>'Data gagal diupdate',
            // 'cari'  =>$cari,
            // 'page'  =>$nomor];
            // }
        }
    }                            