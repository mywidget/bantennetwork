<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h5>Pengguna</h5>
                    <span>Kelola data pengguna</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 d-sm-none d-md-block">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data pengguna</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="card">
            <?=card_header(['title'=>'Kelola Pengguna','nama_app'=>'pengguna','type'=>'modal','url'=>'','info'=>'info','toltip'=>'Tambah pengguna']);?>
            <div class="card-body">
                <div class="row mb-10">
                    <div class="col-md-2">
                        <select id="sortBy" class="form-control" onchange="searchFilter()">
                            <option value="">Sort By</option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="keywords" placeholder="cari data" onkeyup="searchFilter()"/>
                    </div>
                    
                </div>
                <div class="loading-overlay" style="display:none"><div class="overlay-content">Loading.....</div></div>
                <div id="posts_content">
                    <?php if(!empty($posts)){ ?>
                        <div class="posts_list">
                            <table class="wp-list-table widefat fixed striped posts" id="table-api"> 
                                <thead>  
                                    <tr>
                                        <th style="width:2%;">No.</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No. HP</th>
                                        <th style="width:5%;">Level</th>
                                        <th style="width:2%;text-align:center">Status</th>
                                        <th style="width:12%;text-align:right">Aksi</th>
                                    </tr>
                                </thead>  
                                <tbody> 
                                    <?php
                                        $no =1;
                                        foreach($posts as $aRow){
                                            $kode = encrypt_url($aRow['id_user']);
                                            
                                        ?>
                                        <tr>  
                                            <td><?=$no++;?></td>  
                                            <td><a href="javascript:pengguna('<?=$kode;?>');" class="hint--right" aria-label="Edit data"><?=$aRow['nama_lengkap'];?></a></td>
                                            <td><?=$aRow['email']; ?></td>
                                            <td><?=$aRow['no_hp']; ?></td>
                                            <td><?=$aRow['level']; ?></td>
                                            <td align="center"><?=$aRow['aktif']; ?></td>  
                                            <td align='right'>
                                                <a href="javascript:pengguna('<?=$kode;?>');" class="text-green hint--left" aria-label="Edit data"><i class='ik ik-edit'></i> Edit</a> | 
                                                <a href="javascript:deletepengguna('<?=$kode;?>');" class="text-red hint--left" aria-label="Hapus"><i class='ik ik-trash'> Hapus</i></a>
                                            </td>
                                        </tr> 
                                    <?php }  ?>
                                </tbody>  
                                <tfoot>
                                    <tr>
                                        <th style="width:2%;">No.</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No. HP</th>
                                        <th style="width:5%;">Level</th>
                                        <th style="width:2%;text-align:center">Status</th>
                                        <th style="width:12%;text-align:right">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>  
                        </div>
                        <?php echo $this->ajax_pagination->create_links(); ?>
                        <?php }else{ ?>
                        <table class='table table-bordered'>
                            <tr>
                                <td>Belum ada data</td>
                            </tr>
                        </table>
                    <?php } ?>
                </div>
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div>
</div>
<div class="modal fade" id="Modalpengguna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h4 class="modal-title" id="myModalLabel">Add Data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
			<div class="modal-body">
				<div class="alert alert-danger" role="alert" id="removeWarning">
					Anda yakin ingin menghapus data ini
                </div>
				<form id="formpengguna">
					<input type="hidden" class="form-control" id="id" name="id">
					
					<div class="row">
                        <div class="col-md-6">
                            <div class="card-block">
                                <div class="form-group">
                                    <label for="mail">Email</label>
                                    <input type="email" name="mail" value="" class="form-control" id="mail" placeholder="Email" required="">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password Pengguna" value="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Nama Lengkap</label>
                                    <input type="text" name="title" value="" class="form-control" id="title" placeholder="Nama Lengkap" required="">
                                </div>
                                <div class="form-group">
                                    <label for="daftar">TGL. Daftar </label>
                                    <input type="date" name="daftar" class="form-control dpd1"  id="daftar">
                                </div>
                                <div class="form-group">
                                    <label for="phone">No. Handphone</label>
                                    <input type="text" name="phone" value="" class="form-control" id="phone" placeholder="No. Handphone">
                                </div>
                                <div class="form-group">
                                    <label for="percetakan">Nama Percetakan</label>
                                    <input type="text" name="percetakan" class="form-control" id="percetakan" placeholder="Percetakan">
                                </div>
                                <div class="form-group">
                                    <label for="percetakan">Alamat Website</label>
                                    <input type="text" name="nama_web"  class="form-control" id="nama_web" placeholder="https://">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat Percetakan</label>
                                    <input type="text" name="alamat" value="Serang Banten" class="form-control" id="alamat" placeholder="Alamat Percetakan">
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-block">
                                <div class="form-group">
                                    <label for="profit">Profit</label>
                                    <input type="text" name="profit" value="0" class="form-control" id="profit" placeholder="profit">
                                </div>
                                <div class="over-user">
                                    <div class="form-group">
                                        <label for="profit">Menu Akses</label>
                                    </div>
                                    <input id="selectAll" type="checkbox" checked> <label for='selectAll'> Select All</label>
                                    <!-- text input -->
                                    <?php
                                        if($this->session->g_level=="admin") {
                                            $resultz = $this->db->query("SELECT * FROM menuadmin where aktif='Y' order by urutan");
                                            }else{
                                            $resultz = $this->db->query("SELECT * FROM menuadmin where FIND_IN_SET('$lv', CONCAT(id_level, ',')) AND aktif='Y' order by urutan");
                                        }
                                        // $resultz = $db->query("select * FROM menuadmin where id_level IN ($id_level)");
                                        foreach($resultz->result_array() AS $rowz) {
                                            $dataTz[$rowz['idparent']][] = $rowz;
                                        }
                                        echo checkcard($dataTz,0,$rowz['idparent'],$idmenu);
                                    ?>
                                </div>
                               <div class="form-group">
							<label>Level Akses</label>
							<select name='id_level' class="form-control custom-select">
								<?php
									if($this->session->g_level=="admin") {
										$tampil=$this->db->query("SELECT * FROM hak_akses");
										foreach($tampil->result_array() AS $we){
											echo "<option value=$we[id_level] selected>$we[nama]</option>"; 
										}
										}else{
										$tampil = $this->db->query("select * FROM hak_akses where id_level IN ($id_level)");
										if ($id_level==0){
											echo "<option value=0 selected>Pilih Level Akses</option>"; 
										}
										foreach($tampil->result_array() AS $w){
											if ($lv==$w['id_level']){
											echo "<option value=$w[id_level] selected>$w[nama]</option>";}
											else{
											echo "<option value=$w[id_level]>$w[nama]</option>";}}
									}
								?>
							</select>
						</div>
                                <div class="form-group">
                                    <label>Aktif</label>
                                    <div class="">
                                        <label>
                                            <input type="radio" class="minimal" name="aktif" id="optionsRadios1" value="N" checked="">
                                            Tidak
                                            <input type="radio" class="minimal" name="aktif" id="optionsRadios2" value="Y">
                                            Ya
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
			<div class="modal-footer">
				<button type="button" onClick="submitPengguna()" id="btn-bahan" class="btn btn-success">Submit</button>
				<button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/backend/');?>addon/modal.pengguna.js"></script>