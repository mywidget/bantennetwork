<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="fa fa-database bg-blue"></i>
                <div class="d-inline">
                    <h5>Backup DB</h5>
                    <span>Kelola database</span>
				</div>
			</div>
		</div>
        <div class="col-lg-4 d-sm-none d-md-block">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/"><i class="ik ik-home"></i></a>
					</li>
                    <li class="breadcrumb-item active" aria-current="page">Backup DB</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<form action="#" method="post">
			<div class="card">
				<div class="card-header  d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-warning">List File Database </h6>
					<span id="nestable-menu" class="float-right">
						<button type="button" class="btn btn-success btn-sm backup" data-toggle="tooltip" title="Backup DB"><i class="fa fa-database"></i> Klik Untuk Backup</button>
					</span>
				</div>
				<?php 
					$map = directory_map('./backup_db/', FALSE, TRUE); 
				?>
				<div class="card-body table-responsive">
					<div class="card-blocks">
						<table class="table align-items-center table-flush table-hover" id="dataTableHover">
							<thead>
								<tr>
									<th>Nama Database</th>
									<th>Tgl. Backup</th>
									<th style="width:15%!important">Aksi</th>
									<th style="width:5%!important">Hapus</th>
								</tr>
							</thead>
							
						</table>
					</div><!-- /.card -->
				</div><!-- /.card -->
			</div><!-- /.card -->
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('body').tooltip({selector: '[data-toggle="tooltip"]'});
		var dataTable1 = $('#dataTableHover').DataTable({   
			"ajax":{  
				url:base_url + 'backupdb/list_data',
				type:"POST"             
			},
			"order": [[ 0, 'desc' ]],
			"columnDefs": [
			{ "targets": [2,3], "orderable": false }
			]
			// dom: 'Bfrtip',
			// buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
			// ]
		});
		$(document).on('click', '.backup', function() {
			$.ajax({
				'url': base_url + 'backupdb/backupdb',
				'method': 'POST',
				beforeSend: function(){	 
					$(".se-pre-con").show();
				},
				success: function(data) {
					$(".se-pre-con").hide();
					if(data=='ok'){
						showNotif('bottom-right','Backup File!!!','Data berhasil dibackup','success');
						}else{
						showNotif('bottom-right','Peringatan!!!','Data gagal dibackup','warning');
					}
					dataTable1.ajax.reload();  
				}
			})
		});
		$(document).on('click', '.unzipdb', function() {
			var file = $(this).attr('data-file');
			$.ajax({
				'url': base_url + 'backupdb/unzipdb',
				'method': 'POST',
				'data': {file:file},
				'dataType':'json',
				beforeSend: function(){	 
					$(".se-pre-con").show();
				},
				success: function(data) {
					$(".se-pre-con").hide();
					if(data.ok=='ok'){
						showNotif('bottom-right','Extract DB!!!',data.msg,'success');
						}else{
						showNotif('bottom-right','Peringatan!!!',data.msg,'warning');
					}
					dataTable1.ajax.reload();  
				}
			})
		});
		$(document).on('click', '.restoredb', function() {
			var file = $(this).attr('data-file');
			// alert(file);
			$.ajax({
				'url': base_url + 'backupdb/restoredb',
				'method': 'POST',
				'data': {file:file},
				'dataType':'json',
				beforeSend: function () {
					$(".se-pre-con").show();
				},
				success: function(data) {
					$(".se-pre-con").hide();
					if(data.ok=='ok'){
						showNotif('bottom-right','Backup DB!!!',data.msg,'success');
						}else{
						showNotif('bottom-right','Peringatan!!!',data.msg,'warning');
					}
					// dataTable1.ajax.reload();  
					$(".se-pre-con").hide();
				}
			});
		});
		$(document).on('click', '.hapus', function(e) {
			e.preventDefault();
			var file = $(this).attr('data-file');
			$.ajax({
				'url': base_url + 'backupdb/hapusdb',
				'method': 'POST',
				'data':{file:file},
				'dataType':'json',
				beforeSend: function(){	 
					$(".se-pre-con").show();
				},
				success: function(data) {
					$(".se-pre-con").hide();
					if(data.ok=='ok'){
						showNotif('bottom-right','Hapus File!!!','File berhasil dihapus','success');
						dataTable1.ajax.reload();  
						}else{
						showNotif('bottom-right','Peringatan!!!','File gagal dihapus','warning');
					}
				}
			})
		});
	});
</script>