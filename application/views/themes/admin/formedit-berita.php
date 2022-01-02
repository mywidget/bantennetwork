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
<form class="forms-update" method="POST" action="<?=base_url('berita/update_blog');?>" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header"><h3>Form edit</h3></div>
				<div class="card-body">
				<div class="row">
					<div class="col-md-9">
						<div class="form-group mb-2">
							<label for="judul">Judul</label>
							<input type="hidden" class="form-control" id="id" name="id" value="<?=encrypt_url($post->id_post);?>">
							<input type="text" class="form-control" id="judul" name="judul" value="<?=$post->judul;?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="dibaca">Viewer</label>
							<input type="number" class="form-control" id="dibaca" name="dibaca" value="<?=$post->dibaca;?>">
						</div>
					</div>
					</div>
					
					<div class="row">
						<div class="col-md-9">
							<div class="form-group">
								<label for="judul">Youtube : https://www.youtube.com/watch?v=</label>
								<input type="text" class="form-control" id="youtube" name="youtube" value="<?=$post->youtube;?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="durasi">Durasi</label>
								<input type="text" class="form-control" id="durasi" name="durasi" value="<?=durasi($post->durasi);?>">
							</div>
						</div>
					</div>
					<div class="form-group mt-2">
						<textarea class="form-control" id="editor" name="summernote" rows="6"><?=$post->postingan;?></textarea>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label for="keyword">Keyword : pisahkan dengan koma</label>
								<textarea class="form-control" id="keyword" name="keyword" rows="2"><?=$post->kata_kunci;?></textarea>
							</div>
						</div>
						<div class="col-md-7">
							<div class="form-group">
								<label for="deskripsi">Deskripsi</label>
								<textarea class="form-control" id="deskripsi" name="deskripsi" rows="2"><?=$post->deskripsi;?></textarea>
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
					<div class="text-center"> 
						<img src="<?=base_url('assets/post/').folderthn($post->tanggal).'/'.folderbln($post->tanggal).'/341x200_'.$post->gambar;?>" id="avatar" class="rounded" height="200">
					</div>
					<div class="form-group row mt-2">
						<label for="caption" class="col-sm-3 col-form-label">caption</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="caption" name="caption" value="<?=$post->caption;?>">
						</div>
					</div>
					
					<div class="text-center"> 
						<div class="form-group col-xs-12 mt-3">
							<div class="input-group">
								<input type="file" id="input_img" name="input_img" class="file-upload-default"  accept="image/*">
								<input type="text" id="img_url" name="img_url" value="<?=$post->gambar;?>" class="form-control file-upload-info" readonly="" placeholder="Upload Image" accept="image/*">
								<input type="hidden" id="img_del" name="img_del" value="<?=$post->gambar;?>" readonly="">
								<span class="input-group-append">
									<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
								</span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="chosen-tags">Tambah tag</label>
						<select placeholder="Pilih Katakunci Atau Create" name="tag[]" class="selectize-control" id="chosen-tags" multiple>
						</select>
					</div>
					
					<div class="form-group row">
						<label for="cat" class="col-sm-3 col-form-label">Kategori</label>
						<div class="col-sm-9">
							<select id="cat" name="cat[]" class="form-control select2">
								<?php
									foreach($kategori as $rowz){
										$dataTz[$rowz['id_parent']][] = $rowz;
									}
									echo select_kbox($dataTz,0,0,$post->id_cat);
								?>
							</select>
						</div>
					</div>
					<?php
						$pilihan_status = array(0=>'Terbaru', 1=>'Sorotan',2=>'Headline',3=>'Editor Choice',4=>'Populer');
						$pilihan_posisi = '';
						foreach ($pilihan_status as $key=>$status) 
						{
							$pilihan_posisi .= "<option value=$key";
							if ($key == $post->status) 
							{
								$pilihan_posisi .= " selected";
							}
							$pilihan_posisi .= ">$status</option>\r\n";
						}
					?>
					<div class="form-group row">
						<label for="status" class="col-sm-3 col-form-label">Status</label>
						<div class="col-sm-9">
							<select name="status" id="status" class="form-control">
								<?=$pilihan_posisi;?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="author" class="col-sm-3 col-form-label">Author</label>
						<div class="col-sm-9">
							<select id="author" name="author" class="form-control">
								<?php
									foreach($author as $row){
										if($row->id_user==$post->id_user){
											echo '<option value="'.$row->id_user.'" selected>'.$row->nama_lengkap.'</option>';    
											}else{
											echo '<option value="'.$row->id_user.'">'.$row->nama_lengkap.'</option>';    
										}
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
						<div class="col-sm-5">
							<input type="date" class="form-control" id="tanggal" name="tanggal" value="<?=tanggal($post->tanggal);?>">
						</div>
						<div class="col-sm-4 pl-0">
							<input type="time" class="form-control" id="jam" name="jam" value="<?=jam_update($post->tanggal);?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="pub" class="col-sm-3 col-form-label">Publish</label>
						<div class="col-sm-9">
							<select name="pub" id="pub" class="form-control">
								<?php 
									if($post->publish=='Y'){
										echo '<option value="Y" selected>Ya</option>';
										echo '<option value="N">Tidak</option>';
										}else{
										echo '<option value="Y">Ya</option>';
										echo '<option value="N" selected>Tidak</option>';
									} ?>
							</select>
						</div>
					</div>
					<div class="form-group mt-3">
						<button type="submit" class="btn btn-primary mr-2">Update</button>
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
	var tagid = "<?=$post->id_post;?>";
	var tag = "<?=$post->tag;?>";
	var label = "<?=$post->label;?>";
	$('document').ready(function () {
	//tag
	$('#chosen-tags').selectize({
	labelField: 'name',
	valueField: 'id',
	searchField: 'name',
	plugins: ['remove_button'],
	options: [],
	create: true,
	load: function(query, callback) {
	if (!query.length) return callback();
	// console.log(csfrData);
	$.ajax({
	url: base_url+'berita/tag/',
	type: 'POST',
	dataType: 'json',
	data: {
	type: 'modul',
	name: query
	},
	error: function() {
	callback();
	},
	success: function(res) {
	callback(res);
	}
	});
	},
	onInitialize: function(){
	var selectize = this;
	if(tagid!=""){
	$.post(base_url+"berita/cari_tag",{tag:tag,id:tagid}, function( data ) {
	selectize.addOption(data); // This is will add to option
	var selected_items = [];
	$.each(data, function( i, obj) {
	selected_items.push(obj.id);
});
selectize.setValue(selected_items); //this will set option values as default
});
}
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