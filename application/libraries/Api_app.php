<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Api_app {
		private $status; 
		private $produk; 
        private function exec_redirects($ch, &$redirects, $die=false) {
            $data = curl_exec($ch);
            
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($http_code == 301 || $http_code == 302) {
                list($header) = explode("\r\n\r\n", $data, 2);
                
                $matches = array();
                preg_match("/(Location:|URI:)[^(\n)]*/", $header, $matches);
                $url = trim(str_replace($matches[1], "", $matches[0]));
                
                $url_parsed = parse_url($url);
                if (isset($url_parsed)) {
                    curl_setopt($ch, CURLOPT_URL, $url);
                    $redirects++;
                    return $this->exec_redirects($ch, $redirects, true);
				}
			}
            
            list(, $body) = explode("\r\n\r\n", $data, 2);
            return $body;
		}
        
        public function panggil($opts){
            extract($opts);
            $endpoint = $siteapi.'/apiapp/mores/'; 
			
            // $ch = curl_init($endpoint); 
            // curl_setopt($ch, CURLOPT_HEADER, true);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
			$configs = array('secret'=>$appsecret,'app_id'=>$appid,'url_more'=>$more,'domain'=>$_SERVER['HTTP_HOST'],'start'=>$start,'limit'=>$limit);
			$arr =json_encode($configs);
			
            $ch = curl_init(); 
			// curl_setopt($ch, CURLOPT_URL, $siteapi);
			curl_setopt($ch, CURLOPT_URL, $endpoint);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: token '.$appsecret, 'User-Agent: Kalkulatorcetak'));
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
            $data = $this->exec_redirects($ch, $out); 
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if($statusCode == 200){
                $this->status = "ok";  
                $this->produk = $data;
                } else{
                $this->status = "Status Code: " . $statusCode;
			}
		}
		public function panggilMore($opts){
            extract($opts);
            $endpoint = $siteapi.'/apiapp/more/'.$start.'/'.$limit; 
			
            // $ch = curl_init($endpoint); 
            // curl_setopt($ch, CURLOPT_HEADER, true);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
			$configs = array('secret'=>$appsecret,'app_id'=>$appid,'url_more'=>$more,'domain'=>$_SERVER['HTTP_HOST'],'start'=>$start,'limit'=>$limit);
			$arr =json_encode($configs);
			
            $ch = curl_init(); 
			// curl_setopt($ch, CURLOPT_URL, $siteapi);
			curl_setopt($ch, CURLOPT_URL, $endpoint);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: token '.$appsecret, 'User-Agent: Kalkulatorcetak'));
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
            $data = $this->exec_redirects($ch, $out); 
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if($statusCode == 200){
                $this->status = "ok";  
                $this->produk = $data;
                } else{
                $this->status = "Status Code: " . $statusCode;
			}
		}
        
		public function kertas($opts){
            extract($opts);
            $endpoint = $siteapi.'/apis/'.$appid.'/ukuran/'.$mod.'/10'; 
        	
            $ch = curl_init($endpoint); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: token '.$appid, 'User-Agent: Kalkulatorcetak'));
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            $data = $this->exec_redirects($ch, $out); 
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
			
            if($statusCode == 200){
                $this->status = "ok";  
                $this->produk = $data;
                } else{
                $this->status = "Status Code: " . $statusCode;
			}
		}
		
		public function katbahan($opts){
            extract($opts);
            $endpoint = $siteapi.'/apis/'.$appid.'/katbahan/'.$mod.'/0'; 
        	
            $ch = curl_init($endpoint); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: token '.$appid, 'User-Agent: Kalkulatorcetak'));
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            $data = $this->exec_redirects($ch, $out); 
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
			
            if($statusCode == 200){
                $this->status = "ok";  
                $this->produk = $data;
                } else{
                $this->status = "Status Code: " . $statusCode;
			}
		}
		
		public function cariukuran($opts){
            extract($opts);
            $endpoint = $siteapi.'/cek/cariukuran/'.$appid; 
        	
            $ch = curl_init($endpoint); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: token '.$appsecret, 'User-Agent: Kalkulatorcetak'));
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            $data = $this->exec_redirects($ch, $out); 
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
			
            if($statusCode == 200){
                $this->status = "ok";  
                $this->produk = $data;
                } else{
                $this->status = "Status Code: " . $statusCode;
			}
		}
		
		public function cariukurans($opts){
            extract($opts);
			$endpoint = $siteapi.'/cek/cariukuran/'; 
			
			$configs = array('app_id'=>$appid,'domain'=>$_SERVER['HTTP_HOST']);
			$arr =json_encode($configs);
			
            $ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, $endpoint);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: token '.$appid, 'User-Agent: Kalkulatorcetak'));
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
            $data = $this->exec_redirects($ch, $out); 
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if($statusCode == 200){
                $this->status = "ok";  
                $this->produk = $data;
                } else{
                $this->status = "Status Code: " . $statusCode;
			}
		}
		
		public function mesin($opts){
            extract($opts);
            $endpoint = $siteapi.'/apis/'.$appid.'/mesin/'.$mod.'/0'; 
        	
            $ch = curl_init($endpoint); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: token '.$appid, 'User-Agent: Kalkulatorcetak'));
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            $data = $this->exec_redirects($ch, $out); 
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
			
            if($statusCode == 200){
                $this->status = "ok";  
                $this->produk = $data;
                } else{
                $this->status = "Status Code: " . $statusCode;
			}
		}
        function get_status() {
			return $this->status;
		}
        function get_data() {
			return $this->produk;
		}
	}					