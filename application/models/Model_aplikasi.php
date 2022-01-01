<?php 
	class Model_aplikasi extends CI_model{
	
		public function data_arrray(array $val)
		{
			$sql = $this->db->query("SELECT * FROM cat WHERE  id_user='".$val['iduser']."'");
			if($sql->num_rows() > 0){
				$rows=$sql->row_array();
				$dataJson = $rows['data_json'];
				$array_data = json_decode($dataJson);
				}else{
				$array_data = 0;
			}
			return $array_data;
		}
		function hasChild($parent_id)
		{
			$sql = $this->db->query("SELECT COUNT(*) as count FROM menu WHERE parent_id = '" . $parent_id . "' AND aktif='Y' AND  position='Bottom' order by urutan")->row();
			return $sql->count;
		}
		function CategoryList($id)
		{
			$list = "";
			$sql = "SELECT * FROM menu  WHERE parent_id=0 AND aktif='Y' AND position='Bottom' order by urutan";
			$qry = $this->db->query($sql);
			$parent =  $qry->result();
			//print_r($parent);
			$mainlist = '<ul id="menu-td-demo-header-menu-1" class="sf-menu">';
			foreach($parent as $pr){
				$mainlist .= $this->CategoryTree($list,$pr->idmenu,$pr->nama_menu,$pr->link,$append = 0);
				
			}
			$list .= "</li></ul>";
			return $mainlist;
		}
		function CategoryTree($list,$id,$name,$url,$append)
		{
			$list = '<li class="menu-item">';
			$list .= '<a href="'.base_url().$url.'">'.$name.'</a>';
			
			
			if ($this->hasChild($id)) // check if the id has a child
			{
				$append++;
				$list .= '<ul class="sub-menu collapse" id="submenu-1-2"';
				$sql = "SELECT * FROM menu WHERE parent_id =$id AND aktif='Y' AND position='Bottom' order by urutan";
				$qry = $this->db->query($sql);;
				$child = $qry->result();
				foreach($child as $pr){
					$list .= $this->CategoryTree($list,$pr->idmenu,$pr->nama_menu,$pr->link,$append);
				};
				$list .= "</ul>";
			}
			return $list;
		}
		
		function MenuMobile($id)
		{
			$list = "";
			$sql = "SELECT * FROM menu  WHERE parent_id=0 AND aktif='Y' AND position='Bottom' order by urutan";
			$qry = $this->db->query($sql);
			$parent =  $qry->result();
			//print_r($parent);
			$mainlist = '<ul id="menu-td-demo-header-menu" class="td-mobile-main-menu">';
			foreach($parent as $pr){
				$mainlist .= $this->MenuTree($list,$pr->idmenu,$pr->nama_menu,$pr->link,$append = 0);
				
			}
			$list .= "</li></ul>";
			return $mainlist;
		}
		function MenuTree($list,$id,$name,$url,$append)
		{
			$list = '<li class="menu-item">';
			$list .= '<a href="'.base_url().$url.'">'.$name.'</a>';
			
			
			if ($this->hasChild($id)) // check if the id has a child
			{
				$append++;
				$list .= '<ul class="sub-menu"';
				$sql = "SELECT * FROM menu WHERE parent_id =$id AND aktif='Y' AND position='Bottom' order by urutan";
				$qry = $this->db->query($sql);;
				$child = $qry->result();
				foreach($child as $pr){
					$list .= $this->MenuTree($list,$pr->idmenu,$pr->nama_menu,$pr->link,$append);
				};
				$list .= "</ul>";
			}
			return $list;
		}
		
		function CategoryList2($id)
		{
			$list = "";
			$sql = "SELECT * FROM menu  WHERE parent_id=0 ";
			$qry = $this->db->query($sql);
			$parent =  $qry->result();
			//print_r($parent);
			$mainlist = '<ul id="menu-td-demo-header-menu" class="td-mobile-main-menu">';
			foreach($parent as $pr){
				$mainlist .= $this->CategoryTree2($list,$pr->idmenu,$pr->nama_menu,$append = 0);
				
			}
			$list .= "</li></ul>";
			return $mainlist;
		}
		function CategoryTree2($list,$id,$name,$append)
		{
			$list = '<li class="menu-item">';
			$list .= '<a href="#">'.$name.'</a>';
			// $list .= '<a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
						// data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
						// aria-expanded="false" aria-label="Toggle navigation">Info</a>';
			
			if ($this->hasChild($id)) // check if the id has a child
			{
				$append++;
				$list .= '<ul class="sub-menu collapse" id="submenu-1-2"';
				$sql = "SELECT * FROM menu WHERE parent_id =$id";
				$qry = $this->db->query($sql);;
				$child = $qry->result();
				foreach($child as $pr){
					$list .= $this->CategoryTree2($list,$pr->idmenu,$pr->parent_id,$append);
				};
				$list .= "</ul>";
			}
			return $list;
		}
		//bottom menu-item
		function hasChildBottom($parent_id)
		{
			$sql = $this->db->query("SELECT COUNT(*) as count FROM menu WHERE parent_id = '" . $parent_id . "' AND aktif='Y' AND  position='Top' order by urutan")->row();
			return $sql->count;
		}
		function BottomList($id)
		{
			$list = "";
			$sql = "SELECT * FROM menu  WHERE parent_id=0 AND aktif='Y' AND position='Top'";
			$qry = $this->db->query($sql);
			$parent =  $qry->result();
			//print_r($parent);
			$mainlist = '<ul id="menu-td-demo-footer-menu" class="td-subfooter-menu">';
			foreach($parent as $pr){
				$mainlist .= $this->CategoryTree2($list,$pr->idmenu,$pr->nama_menu,$append = 0);
				
			}
			$list .= "</li></ul>";
			return $mainlist;
		}
		function BottomTree($list,$id,$name,$link,$append)
		{
			$list = '<li class="menu-item">';
			$list .= '<a href="'.$link.'">'.$name.'</a>';
			// $list .= '<a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
						// data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
						// aria-expanded="false" aria-label="Toggle navigation">Info</a>';
			
			if ($this->hasChildBottom($id)) // check if the id has a child
			{
				$append++;
				$list .= '<ul class="sub-menu collapse" id="submenu-1-2"';
				$sql = "SELECT * FROM menu WHERE parent_id ='$id' AND aktif='Y' AND position='Top'";
				$qry = $this->db->query($sql);;
				$child = $qry->result();
				foreach($child as $pr){
					$list .= $this->BottomTree($list,$pr->idmenu,$pr->parent_id,$pr->link,$append);
				};
				$list .= "</ul>";
			}
			return $list;
		}
	}														