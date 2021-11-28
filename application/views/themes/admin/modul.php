<div class="page-header">
	<div class="row align-items-end">
		<div class="col-lg-8">
			<div class="page-header-title">
				<i class="ik ik-edit bg-blue"></i>
				<div class="d-inline">
					<h5>Data Modul</h5>
					<span>Kelola data modul</span>
				</div>
			</div>
		</div>
		<div class="col-lg-4 d-sm-none d-md-block">
			<nav class="breadcrumb-container" aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="/"><i class="ik ik-home"></i></a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Modul</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">List Data</h3>
			</div><!-- /.card-header table-responsive-->
			<div class="card-body">
				<div class="row mb-10">
					<div class="col-md-2">
						<select id="sortBy" class="form-control" onchange="searchModul()">
                            <option value="">Sort By</option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
						</select>
					</div>
					<div class="col-md-8">
					</div>
					<div class="col-md-2">
						<input type="text" class="form-control" id="keywords" placeholder="cari invoice" onkeyup="searchModul()"/>
					</div>
					
				</div>
				<div id="posts_content">
					<?php
						if(!empty($posts)){ ?>
						<div class="posts_list">
							<table class="wp-list-table widefat fixed striped posts" id="table-modul">
								<thead>  
									<tr>
										<th style="width:2%;">No</th>
										<th>Title</th>
										<th>Warna</th>
										<th>Urutan</th>
										<th style="width:8%;">Status</th>
										<th style="width:8%;">Aksi</th>
									</tr>
								</thead>  
								<tbody> 
									<?php
										$no =1;
										foreach($posts AS $aRow){ 
											
											$btn = "<a href='#' class='text-success' onClick='showModalsp({$aRow['ID']})'>{$aRow['nama_modul']}</a>";	
											$data = "<a href='#' class='hint--top-left' aria-label='Edit data'  onClick='showModalsp({$aRow['ID']})' title='Edit Data'><i class='ik ik-edit'></i></a>";
											$postID = $aRow['ID'];
										?>
										<tr>  
											<td><?=$no++;?></td>  
											<td><?=$btn; ?></td>  
											<td><?=$aRow['warna']; ?></td>  
											<td><?=$aRow['urutan']; ?></td>  
											<td><?=$aRow['publish']; ?></td>  
											<td align="center" class="icon-list-item"><?=$data; ?></td>  
										</tr> 
									<?php } ?>
								</tbody>  
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
<!-- Modal add -->
<!-- Modal add -->
<div class="modal fade" id="myModalmod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Add Data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger" role="alert" id="removeWarning">
					Anda yakin ingin menghapus data ini
				</div>
				<form id="formModul">
					<input type="hidden" class="form-control" id="id" name="id">
					<input type="hidden" class="form-control" id="type" name="type">
					<input type="hidden" class="form-control" id="cari" name="cari">
					<input type="hidden" class="form-control" id="perpage" name="perpage">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<label for="nama">Nama Modul <span class="error_a" style="display:none;color:#ff0000;"></span></label>
								<div class="form-group mb-0">
									<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Modul" required autofocus />
								</div>
							</div>
							<div class="col-md-6">
								<label class="hide-sm" for="tag">Nama Tag <span class="error_b" style="display:none;color:#ff0000;"></span>
								</label> 
								<div class="form-group mb-0">
									<input class="form-control" id="tag" name="tag" placeholder="Nama Tag" required="" type="text">
								</div>
							</div>
							<div class="col-md-6">
								<label class="hide-sm" for="embed1">Embed Video 1<span class="error_c" style="display:none;color:#ff0000;"></span>
								</label> 
								<div class="form-group mb-0">
									<input class="form-control" id="embed1" name="embed1" placeholder="" type="text">
								</div>
							</div>
							<div class="col-md-6">
								<label class="hide-sm" for="embed2">Embed Video 2<span class="error_c" style="display:none;color:#ff0000;"></span>
								</label> 
								<div class="form-group mb-0">
									<input class="form-control" id="embed2" name="embed2" placeholder="" type="text">
								</div>
							</div>
							<div class="col-md-4">
								<label class="hide-sm" for="pupup">Popup Class <span class="error_d" style="display:none;color:#ff0000;"></span>
								</label> 
								<div class="form-group mb-0">
									<input class="form-control" id="pupup" name="pupup" placeholder="modal-lg" type="text">
								</div>
							</div>
							<div class="col-md-4">
								<label class="hide-sm" for="warna">BG Title Color <span class="error_c" style="display:none;color:#ff0000;"></span>
									<div class="form-group mb-0">
										<input type="text" id="warna" name="warna" class="form-control warna_title" data-control="hue">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group hidex mb-0">
										<label for="pub">Aktif <span class="error_h" style="display:none;color:#ff0000;"></span></label>
										<select name="pub" id="pub" class="custom-select form-control">
											<option value="">--Pilih--</option>
											<option value="Y">Ya</option>
											<option value="N">Tidak</option>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<label class="hide-sm" for="ket">Keterangan<span class="error_d" style="display:none;color:#ff0000;"></span>
									</label> 
									<div class="form-group mb-0">
										<textarea class="form-control" id="ket" name="ket"></textarea>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" onClick="submitModul()"  class="btn btn-success">Submit</button>
					<button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		var search = "";var nomor = 1;
	</script>
<script src="<?=base_url('assets/backend/');?>addon/modal.modul.js"></script>