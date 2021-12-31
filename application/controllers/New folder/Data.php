<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Data extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->appconfig = appconfig();
        }
        
        public function detail_hitung()
        {
            $data['title'] = 'Detail hitung | Kalkulatorcetak.com';
            $data['description'] = 'description';
            $data['keywords'] = 'keywords';
            
            $data['secret'] = $this->appconfig['APPS_SECRETS'];
            $data['app_id'] = $this->appconfig['APPS_IDS'];
            $data['site_api'] = SITE_API;
            
            if(isset($_POST['submit'])){
                $sub  = (isset($_POST['submit']) ? $_POST['submit'] : '');
                $val1 = (isset($_POST['data1']) ? $_POST['data1'] : '');
                $val2 = (isset($_POST['data2']) ? $_POST['data2'] : '');
                $val3 = (isset($_POST['data3']) ? $_POST['data3'] : '');
                $val4 = (isset($_POST['data4']) ? $_POST['data4'] : '');
                $val5 = (isset($_POST['data5']) ? $_POST['data5'] : '');
                $val6 = (isset($_POST['data6']) ? $_POST['data6'] : '');
                $val7 = (isset($_POST['data7']) ? $_POST['data7'] : '');
                $val8 = (isset($_POST['data8']) ? $_POST['data8'] : '');
                if(!empty($val1)){
                    foreach ($val1 as $key=> $value) {
                        $datan1 = $val1[$sub];
                    }
                    }else{
                    $datan1 = "";
                }
                if(!empty($val2)){
                    foreach ($val2 as $key=> $value) {
                        $datan2 = $val2[$sub];
                    }
                    }else{
                    $datan2 = "";
                }
                if(!empty($val3)){
                    foreach ($val3 as $key=> $value) {
                        $datan3 = $val3[$sub];
                    }
                    }else{
                    $datan3 = "";
                }
                if(!empty($val4)){
                    foreach ($val4 as $key=> $value) {
                        $datan4 = $val4[$sub];
                    }
                    }else{
                    $datan4 = "";
                }
                if(!empty($val5)){
                    foreach ($val5 as $key=> $value) {
                        $datan5 = $val5[$sub];
                    }
                    }else{
                    $datan5 = "";
                }
                if(!empty($val6)){
                    foreach ($val6 as $key=> $value) {
                        $datan6 = $val6[$sub];
                    }
                    }else{
                    $datan6 = "";
                }
                if(!empty($val7)){
                    foreach ($val7 as $key=> $value) {
                        $datan7 = $val7[$sub];
                    }
                    }else{
                    $datan7 = "";
                }
                if(!empty($val8)){
                    foreach ($val8 as $key=> $value) {
                        $datan8 = $val8[$sub];
                    }
                    }else{
                    $datan8 = "";
                }
                
                $ket= $_POST['ket']; $jumlahcetak= $_POST['jumlahcetak'];
                if(!empty($datan1)){
                    $hasil= base64_decode($datan1);
                    }else{
                    $hasil="";
                }
                if(!empty($datan2)){
                    $hasil2= base64_decode($datan2);
                    }else{
                    $hasil2="";
                }
                if(!empty($datan3)){
                    $hasil3= base64_decode($datan3);
                    }else{
                    $hasil3="";
                }
                if(!empty($datan4)){
                    $hasil4= base64_decode($datan4);
                    }else{
                    $hasil4="";
                }
                if(!empty($datan5)){
                    $hasil5= base64_decode($datan5);
                    }else{
                    $hasil5="";
                }
                if(!empty($datan6)){
                    $hasil6= base64_decode($datan6);
                    }else{
                    $hasil6="";
                }
                if(!empty($datan7)){
                    $hasil7= base64_decode($datan7);
                    }else{
                    $hasil7="";
                }
                if(!empty($datan8)){
                    $hasil8= base64_decode($datan8);
                    }else{
                    $hasil8="";
                }
                //
                $valsubmit = $datan1.','.$datan2.','.$datan3.','.$datan4.','.$datan5.','.$datan6.','.$datan7.','.$datan8;
                $exclude_array = explode(',', $valsubmit); //Explode on comma
                $exclude_array = array_filter($exclude_array, function($var){
                    return (trim($var) !== ''); //Return true if not empty string
                });
                $datax = implode(",",$exclude_array);
                $array= json_decode(rawurldecode($hasil),true);
                $array2= json_decode(rawurldecode($hasil2),true);
                $array3= json_decode(rawurldecode($hasil3),true);
                $array4= json_decode(rawurldecode($hasil4),true);
                $array5= json_decode(rawurldecode($hasil5),true);
                $array6= json_decode(rawurldecode($hasil6),true);
                $array7= json_decode(rawurldecode($hasil7),true);
                $array8= json_decode(rawurldecode($hasil8),true);
                
                $total1 = 0;
                $total2 = 0;
                $total3 = 0;
                $total4 = 0;
                $total5 = 0;
                $total6 = 0;
                $total7 = 0;
                $total8 = 0;
                $data['array'] = $array;
                $data['array2'] = $array2;
                $data['array3'] = $array3;
                $data['array4'] = $array4;
                $data['array5'] = $array5;
                $data['array6'] = $array6;
                $data['array7'] = $array7;
                $data['array8'] = $array8;
                $data['ket']= $_POST['ket']; 
                $data['jumlahcetak']= $_POST['jumlahcetak'];
                $this->load->view('detail_hitung',$data);
                }else{
                $this->load->view('detail_error',$data);
            }
        }
        public function detail_data()
        {
            $data['title'] = 'Detail hitung | Kalkulatorcetak.com';
            $data['description'] = 'description';
            $data['keywords'] = 'keywords';
            
            $data['secret'] = $this->appconfig['APPS_SECRETS'];
            $data['app_id'] = $this->appconfig['APPS_IDS'];
            $data['site_api'] = SITE_API;
            $GETID = decrypt_url($this->uri->segment(2));
            $id_user = decrypt_url($this->uri->segment(3));
            
            $sql = $this->db->query("SELECT * FROM `data_hitung` WHERE  id_user='$id_user'");
            
            $rows=$sql->row_array();
            $dataJson = $rows['data_json'];
            $ARRAY = json_decode($dataJson);
            
            foreach ($ARRAY->hitung as $item) {
                if ($item->id == $GETID) {
                    $KodeId = $item->id;
                    $keterangan = $item->keterangan;
                    $datan1 = $item->hasil1;
                    $datan2 = $item->hasil2;
                    $datan3 = $item->hasil3;
                    $datan4 = $item->hasil4;
                    $datan5 = $item->hasil5;
                    $datan6 = $item->hasil6;
                    $datan7 = $item->hasil7;
                    $datan8 = $item->hasil8;
                    break;
                }
            }
            if($GETID !== null && !is_numeric( $GETID ) ) {
                echo '<div class="container" style="padding:20px 20px;background:#400000;color:#fff;text-align:center">
                <div class="row">
                <div class="col-sm-12">Data tidak ditemukan</div>
                </div>
                </div>';
                exit();
            }
            if($KodeId!=$GETID){
                echo '<div class="container" style="padding:20px 20px;background:#400000;color:#fff;text-align:center">
                <div class="row">
                <div class="col-sm-12">Data tidak ditemukan</div>
                </div>
                </div>';
                exit();
            }
            // $hasil1= base64_decode($datan1);
            // $hasil2= base64_decode($datan2);
            // $hasil3= base64_decode($datan3);
            // $hasil4= base64_decode($datan4);
            // $hasil5= base64_decode($datan5);
            // $hasil6= base64_decode($datan6);
            // $hasil7= base64_decode($datan7);
            // $hasil8= base64_decode($datan8);
            // // if(isset($_POST['submit']))
            // {
            // $sub  = (isset($_POST['submit']) ? $_POST['submit'] : '');
            // $val1 = (isset($_POST['data1']) ? $_POST['data1'] : '');
            // $val2 = (isset($_POST['data2']) ? $_POST['data2'] : '');
            // $val3 = (isset($_POST['data3']) ? $_POST['data3'] : '');
            // $val4 = (isset($_POST['data4']) ? $_POST['data4'] : '');
            // $val5 = (isset($_POST['data5']) ? $_POST['data5'] : '');
            // $val6 = (isset($_POST['data6']) ? $_POST['data6'] : '');
            // $val7 = (isset($_POST['data7']) ? $_POST['data7'] : '');
            // $val8 = (isset($_POST['data8']) ? $_POST['data8'] : '');
            // if(!empty($val1)){
            // foreach ($val1 as $key=> $value) {
            // $datan1 = $val1[$sub];
            // }
            // }else{
            // $datan1 = "";
            // }
            // if(!empty($val2)){
            // foreach ($val2 as $key=> $value) {
            // $datan2 = $val2[$sub];
            // }
            // }else{
            // $datan2 = "";
            // }
            // if(!empty($val3)){
            // foreach ($val3 as $key=> $value) {
            // $datan3 = $val3[$sub];
            // }
            // }else{
            // $datan3 = "";
            // }
            // if(!empty($val4)){
            // foreach ($val4 as $key=> $value) {
            // $datan4 = $val4[$sub];
            // }
            // }else{
            // $datan4 = "";
            // }
            // if(!empty($val5)){
            // foreach ($val5 as $key=> $value) {
            // $datan5 = $val5[$sub];
            // }
            // }else{
            // $datan5 = "";
            // }
            // if(!empty($val6)){
            // foreach ($val6 as $key=> $value) {
            // $datan6 = $val6[$sub];
            // }
            // }else{
            // $datan6 = "";
            // }
            // if(!empty($val7)){
            // foreach ($val7 as $key=> $value) {
            // $datan7 = $val7[$sub];
            // }
            // }else{
            // $datan7 = "";
            // }
            // if(!empty($val8)){
            // foreach ($val8 as $key=> $value) {
            // $datan8 = $val8[$sub];
            // }
            // }else{
            // $datan8 = "";
            // }
            
            
            if(!empty($datan1)){
            $hasil= base64_decode($datan1);
            }else{
            $hasil="";
            }
            if(!empty($datan2)){
            $hasil2= base64_decode($datan2);
            }else{
            $hasil2="";
            }
            if(!empty($datan3)){
            $hasil3= base64_decode($datan3);
            }else{
            $hasil3="";
            }
            if(!empty($datan4)){
            $hasil4= base64_decode($datan4);
            }else{
            $hasil4="";
            }
            if(!empty($datan5)){
            $hasil5= base64_decode($datan5);
            }else{
            $hasil5="";
            }
            if(!empty($datan6)){
            $hasil6= base64_decode($datan6);
            }else{
            $hasil6="";
            }
            if(!empty($datan7)){
            $hasil7= base64_decode($datan7);
            }else{
            $hasil7="";
            }
            if(!empty($datan8)){
            $hasil8= base64_decode($datan8);
            }else{
            $hasil8="";
            }
            //
            $valsubmit = $datan1.','.$datan2.','.$datan3.','.$datan4.','.$datan5.','.$datan6.','.$datan7.','.$datan8;
            $exclude_array = explode(',', $valsubmit); //Explode on comma
            $exclude_array = array_filter($exclude_array, function($var){
            return (trim($var) !== ''); //Return true if not empty string
            });
            $datax = implode(",",$exclude_array);
            $array= json_decode(rawurldecode($hasil),true);
            $array2= json_decode(rawurldecode($hasil2),true);
            $array3= json_decode(rawurldecode($hasil3),true);
            $array4= json_decode(rawurldecode($hasil4),true);
            $array5= json_decode(rawurldecode($hasil5),true);
            $array6= json_decode(rawurldecode($hasil6),true);
            $array7= json_decode(rawurldecode($hasil7),true);
            $array8= json_decode(rawurldecode($hasil8),true);
            
            $data['total1'] = 0;
            $data['total2'] = 0;
            $data['total3'] = 0;
            $data['total4'] = 0;
            $data['total5'] = 0;
            $data['total6'] = 0;
            $data['total7'] = 0;
            $data['total8'] = 0;
            $data['array'] = $array;
            $data['array2'] = $array2;
            $data['array3'] = $array3;
            $data['array4'] = $array4;
            $data['array5'] = $array5;
            $data['array6'] = $array6;
            $data['array7'] = $array7;
            $data['array8'] = $array8;
            $data['ket']= $keterangan; 
            $data['jumlahcetak']= $array['jmlcetak'];;
            $this->load->view('detail_hitung',$data);
            // }else{
            // $this->load->view('detail_error',$data);
            // }
        }
        
    }                                