<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h5>Blog</h5>
                    <span>Kelola data blog</span>
				</div>
			</div>
		</div>
        <div class="col-lg-4 d-sm-none d-md-block">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/"><i class="ik ik-home"></i></a>
					</li>
                    <li class="breadcrumb-item active" aria-current="page">blog</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<form class="forms-update" id="formId" method="POST" action="<?=base_url('berita/update_blog');?>" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header"><h3>Form edit</h3></div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-9">
							<div class="form-group">
								<label for="judul">Judul</label>
								<input type="hidden" class="form-control" id="id" name="id">
								<input type="text" class="form-control" id="judul" name="judul">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="dibaca">Viewer</label>
								<input type="number" class="form-control" id="dibaca" name="dibaca" value="1">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-9">
							<div class="form-group">
								<label for="youtube" id="copy">Youtube : https://www.youtube.com/watch?v=</label>
								<div class="input-group input-group-danger" onclick="paste()">
									<span class="input-group-prepend cursor"><label class="input-group-text"><i class="ik ik-youtube" ></i></label></span>
									<input type="text" class="form-control" id="youtube" name="youtube">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="durasi">Durasi</label>
								<input type="text" class="form-control" id="durasi" name="durasi" value="00:00">
							</div>
						</div>
					</div>
					<div class="form-group mt-2">
						<textarea class="form-control" id="editor" name="summernote" rows="5"></textarea>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label for="keyword">Keyword : pisahkan dengan koma</label>
								<textarea class="form-control" id="keyword" name="keyword" rows="2"></textarea>
							</div>
						</div>
						<div class="col-md-7">
							<div class="form-group">
								<label for="deskripsi">Deskripsi</label>
								<textarea class="form-control" id="deskripsi" name="deskripsi" rows="2"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header"><h3>Pengaturan</h3></div>
				<div class="card-body">
					<div class="text-center mb-2"> 
						<img src="" id="avatar" class="rounded" height="210">
					</div>
					<div class="form-group row">
						<label for="caption" class="col-sm-3 col-form-label">caption</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="caption" name="caption">
						</div>
					</div>
					
					<div class="text-center"> 
						<div class="form-group col-xs-12 mt-3">
							<div class="input-group">
								<input type="file" id="input_img"  name="input_img" class="file-upload-default"  accept="image/*">
								<input type="text" accept="image/*" id="img_url" name="img_url" class="form-control file-upload-info" readonly="" placeholder="Pilih Gambar" required>
								<span class="input-group-append">
									<button class="file-upload-browse btn btn-success" type="button">Browse</button>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="chosen-tags">Tambah tag</label>
						<select placeholder="Pilih tag" name="tag[]" class="selectize-control" id="chosen-tags" multiple>
						</select>
					</div>
					<div class="form-group row">
						<label for="cat" class="col-sm-3 col-form-label">Rubrik</label>
						<div class="col-sm-9">
							<select id="cat" name="cat" class="form-control" placeholder="pilih kategori">
								<?php
									foreach($kategori as $row){
										echo '<option value="'.$row->id_cat.'">'.$row->nama_kategori.'</option>';    
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="status" class="col-sm-3 col-form-label">Status</label>
						<div class="col-sm-9">
							<select name="status" id="status" class="custom-select">
								<option value="0" selected>Terbaru</option>
								<option value="2" selected>Headline</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Author</label>
						<div class="col-sm-9">
							<select id="author" name="author" class="form-control">
								<?php
									foreach($author as $row){
										echo '<option value="'.$row->id_user.'">'.$row->nama_lengkap.'</option>';    
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Tanggal</label>
						<div class="col-sm-5">
							<input type="date" class="form-control" id="tanggal" name="tanggal" value="<?=$tanggal;?>">
						</div>
						<div class="col-sm-4">
							<input type="time" class="form-control" id="jam" name="jam" value="<?=$jam;?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="pub" class="col-sm-3 col-form-label">Publish</label>
						<div class="col-sm-9">
							<select name="pub" id="pub" class="custom-select">
								<option value="Y" selected>Ya</option>
								<option value="N">Tidak</option>
							</select>
						</div>
					</div>
					<div class="form-group mt-3">
						<button type="submit" name="submit" class="btn btn-success mr-2">Simpan</button>
						<a href="/berita/post" type="submit" class="btn btn-danger mr-2">Batal</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script src="<?=base_url('assets/backend/');?>ckeditor/ckeditor.js"></script>
<?php
	if ($this->agent->is_mobile())
	{ 
	?>
	<script src="<?=base_url('assets/backend/');?>ckeditor/config-mobile.js"></script>	
	<?php }else{ ?>
	<script src="<?=base_url('assets/backend/');?>ckeditor/configs.js"></script>
<?php } ?>
<script>
	
	function paste() {
		var pasteText = $("#copy").text();
		// console.log(pasteText);
		$("#youtube").val(pasteText);
	}
	$('form').submit(function ()
	{
		// e.preventDefault();
		var messageLength = CKEDITOR.instances['editor'].getData().replace(/<[^>]*>/gi, '').length;
		if($("#judul").val()==""){
			showNotif('top-center','Input Data','Judul Harus diisi','warning');
			$("#judul").focus();
			return false;
			}else if(!messageLength){
			showNotif('top-center','Input Data','Berita masih kosong','warning');
			CKEDITOR.instances['editor'].focus();
			return false;
			}else if($("#img_url").val()==""){
			showNotif('top-center','Input Data','Gambar belum dipilih','warning');
			return false;
		}
		// console.log(editor);
		$(".forms-update").submit();
	}); 
	$('document').ready(function () 
	{
		
		$('#chosen-tags').selectize({
			labelField: 'name',
			valueField: 'id',
			searchField: 'name',
			plugins: ['remove_button'],
			persist: true,
			create: true,
			options: [],
			onBlur: function () {
				var tags = $("#chosen-tags").val();
				$.ajax({
					type: "POST",
					url: "/berita/post_tag",
					dataType: 'json',
					data: {tag: tags},
					beforeSend: function (xhr) {
						$(".se-pre-con").fadeIn();
					},
					success: function(res) {
						$(".se-pre-con").fadeOut();
						// showNotif('bottom-right','Input','tag berhasil di simpan','success');
						} ,error: function(xhr, status, error) {
						showNotif('bottom-right','Update',error,'error');
						$(".se-pre-con").fadeOut('slow');
					}
				});
			},
			load: function(query, callback) {
				if (!query.length) return callback();
				$.ajax({
					url: base_url+'berita/tag/',
					type: 'POST',
					dataType: 'json',
					data: {
						name: query,
					},
					error: function() {
						callback();
					},
					success: function(res) {
						callback(res);
					}
				});
			}
		});
		$('.file-upload-browse').on('click', function() {
			var file = $(this).parent().parent().parent().find('.file-upload-default');
			file.trigger('click');
		});
		$('.file-upload-default').on('change', function() {
			$(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
		});
		$('#input_img').on("change", function () {
			
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("input_img").files[0]);
			
			oFReader.onload = function(oFREvent) {
				document.getElementById("avatar").src = oFREvent.target.result;
			};
		});
	});
</script>		
<style>
</style>		