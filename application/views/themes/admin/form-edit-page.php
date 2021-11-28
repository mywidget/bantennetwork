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
<form class="forms-update" id="formId" method="POST" action="<?=base_url('berita/update_page');?>" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header"><h3>Form edit</h3></div>
				<div class="card-body">
					<div class="form-group">
						<label for="judul">Judul</label>
						<input type="hidden" class="form-control" id="id" name="id" value="<?=encrypt_url($post->id_page);?>">
						<input type="text" class="form-control" id="judul" name="judul" value="<?=$post->judul;?>">
					</div>
					<div class="form-group mt-2">
						<textarea class="form-control" id="editor" name="summernote" rows="5"><?=$post->isi;?></textarea>
					</div>
					
				</div>
			</div>
			
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header"><h3>Pengaturan</h3></div>
				<div class="card-body">
					<div class="text-center"> 
						<img src="<?=base_url('assets/page/').$post->photo;?>" id="avatar" class="rounded" height="150">
					</div>
					
					<div class="text-center"> 
						<div class="form-group col-xs-12 mt-3">
							<div class="input-group">
								<input type="file" id="input_img"  name="input_img" class="file-upload-default"  accept="image/*">
								<input type="text" id="img_url" name="img_url" class="form-control file-upload-info" readonly="" placeholder="Pilih Gambar" required>
								<input type="hidden" id="img_del" name="img_del" value="<?=$post->photo;?>" readonly="">
								<span class="input-group-append">
									<button class="file-upload-browse btn btn-success" type="button">Browse</button>
								</span>
							</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="pub" class="col-sm-3 col-form-label">Publish</label>
						<div class="col-sm-9">
							<select name="pub" id="pub" class="custom-select">
								<?php
									if($post->pub==0){ ?>
									<option value="0" selected>Ya</option>
									<option value="1">Tidak</option>
									<?php }else{ ?>
									<option value="0">Ya</option>
									<option value="1" selected>Tidak</option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="status" class="col-sm-3 col-form-label">Tampilkan Gambar</label>
						<div class="col-sm-9">
							<select name="status" id="status" class="custom-select">
								<?php
									if($post->status==0){ ?>
									<option value="0" selected>Ya</option>
									<option value="1">Tidak</option>
									<?php }else{ ?>
									<option value="0">Ya</option>
									<option value="1" selected>Tidak</option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group mt-3">
						<button type="submit" name="submit" class="btn btn-success mr-2">Simpan</button>
						<a href="/berita/page" type="submit" class="btn btn-danger mr-2">Batal</a>
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
	}
	$(".forms-update").submit();
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
</script>		
<style>
	span.cursor{cursor: pointer;}
</style>	