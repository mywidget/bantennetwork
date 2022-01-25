<?=p_header(array('file-text','danger','Profil','Profil pengguna','','Profil'),$module);?>
<?php
	// print_r($_cek);
	$cekUser = cekUser($this->session->g_id);
	// print_r($cekUser);
	if($cekUser['parent']!=0){
		$type = 'marketing';
		$readonly = 'readonly';
		}else{
		$type = 'owner';
		$readonly = '';
	}
?>
<div class="row">
	<div class="loadingcrud"></div>
	<div class="col-lg-4 col-md-5">
		<div class="card">
			<div class="card-body">
				<div class="text-center"> 
					<img src="<?=$user['img']; ?>" id="avatar" class="rounded-circle" width="150">
					<h4 class="card-title mt-10" id="attr_nama1"><?=$user['nama']; ?></h4>
					<p class="card-subtitle"><?=ucfirst($user['level']); ?></p>
				</div>
			</div>
			<hr class="mb-0"> 
			<div class="card-body"> 
				<small class="text-muted d-block">Email address </small>
				<h6><?=$user['email']; ?></h6> 
				<small class="text-muted d-block pt-10">No. Handphone</small>
				<h6 id="attr_hp1"><?=$user['nohp']; ?></h6> 
				<small class="text-muted d-block pt-10">Alamat</small>
				<h6 id="attr_alamat"><?=$user['alamat']; ?></h6>
			</div>
		</div>
	</div>
	<div class="col-lg-8 col-md-7">
		<div class="card">
			<ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Profil</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Pengaturan</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pills-sandi-tab" data-toggle="pill" href="#previous-sandi" role="tab" aria-controls="pills-sandi" aria-selected="false">Ganti Sandi</a>
				</li>
			</ul>
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
					<div class="card-body">
						<div class="row">
							<div class="col-md-3 col-6"> <strong>Nama Lengkap</strong>
								<br>
								<p class="text-muted" id="attr_nama2"><?=$user['nama']; ?></p>
							</div>
							<div class="col-md-3 col-6"> <strong>No. Handphone</strong>
								<br>
								<p class="text-muted" id="attr_hp2"><?=$user['nohp']; ?></p>
							</div>
							<div class="col-md-6 col-6"> <strong>Email</strong>
								<br>
								<p class="text-muted"><?=$user['email']; ?></p>
							</div>
						</div>
						<hr>
						<p class="mt-30" id="attr_alamat"><?=$user['alamat']; ?></p>
						<hr>
					</div>
				</div>
				<div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
					<div class="card-body">
						<form class="form-horizontal">
							<div class="form-group">
								<label>Avatar</label>
								<input type="file" id="input_img"  class="file-upload-default"  accept="image/*">
								<div class="input-group col-xs-12">
									<input type="text" id="img_url" name="img_url" class="form-control file-upload-info" readonly="" placeholder="Upload Image">
									<span class="input-group-append">
										<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
									</span>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="email">Email</label>
									<input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control" id="email" placeholder="Email" readonly>
									<input type="hidden" name="type" value="<?php echo $type; ?>" class="form-control" id="type" readonly>
								</div>
								<div class="form-group col-md-6">
									<label for="nama_lengkap">Nama Lengkap</label>
									<input type="text" name="nama_lengkap" value="<?php echo $user['nama']; ?>" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="no_hp">No. Handphone</label>
									<input type="text" name="no_hp" value="<?php echo $user['nohp']; ?>" class="form-control" id="no_hp" placeholder="No. Handphone">
								</div>
								<div class="form-group col-md-6">
									<label for="alamat">Alamat</label>
									<input type="text" name="alamat" value="<?php echo $user['alamat']; ?>" class="form-control" id="alamat" placeholder="Alamat Percetakan" <?=$readonly;?>>
								</div>
							</div>
							<button id="simpan" class="btn btn-success" type="button">Update Profile</button>
						</form>
					</div>
				</div>
				<div class="tab-pane fade" id="previous-sandi" role="tabpanel" aria-labelledby="pills-sandi-tab">
					<div class="card-body">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="password1">Kata Sandi</label>
								<input type="password" name="password1" class="form-control" id="password1" placeholder="Password Pengguna" required>
								<label for="password2">Konfirmasi kata sandi</label>
								<input type="password" name="password2" class="form-control" id="password2" placeholder="Password Pengguna" required>
							</div>
							
							<button id="update" class="btn btn-success" type="button">Ganti Sandi</button>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>	
<script>
	$('document').ready(function () {
		var hash = document.location.hash;
		if (hash) {
			$('#pills-tab a[href="' + hash + '"]').tab('show');
		} 
		
		$('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
			window.location.hash = $(e.target).attr('href');
		});
		$(".loadingcrud").hide();
		$('.file-upload-browse').on('click', function() {
			var file = $(this).parent().parent().parent().find('.file-upload-default');
			file.trigger('click');
		});
		$('.file-upload-default').on('change', function() {
			$(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
		});
		$('#update').on('click', function () {
			if($("#password1").val() === ''){
				showNotif('bottom-right','Ganti Sandi','Sandi masih kosong','error');
				return;
			}
			if($("#password2").val() === ''){ 
				showNotif('bottom-right','Ganti Sandi','Ulangi sandi masih kosong','error');
				return;
			}
			if($("#password1").val() != $("#password2").val()){ 
				showNotif('bottom-right','Ganti Sandi','Sandi tidak cocok','error');
				return;
			}
			var dataString = {
				type : 'ganti',
				pass1 : $("#password1").val(),
				pass2 : $("#password2").val()
			};
			
			$.ajax({
				type: "POST",
				url: base_url+"akun/crud_profil/",
				data: dataString,
				cache : false,
				dataType: "json",
				beforeSend: function (xhr) {
					NProgress.start();
					$(".se-pre-con").fadeIn();
				},
				success: function(data){
					if(data.status==200){
						showNotif('bottom-right','Ganti sandi','Data berhasil di update','success');
						$("#password1").val("");
					}   $("#password2").val("");
					$(".se-pre-con").fadeOut('slow');
					NProgress.done();
					// console.log(data);
					} ,error: function(xhr, status, error) {
					showNotif('bottom-right','Ganti sandi',error,'error');
				},
			});
		});
		$('#updateLogo').on('click', function () {
			if($("#profit").val() === ''){
				showNotif('bottom-right','Update','Profit kosong','error');
				return;
			}
			var dataString = {
				type : 'uplogo',
				profit : $("#profit").val(),
				logo : $("#logo_url").val()
			};
			
			$.ajax({
				type: "POST",
				url: base_url+"akun/crud_profil/",
				data: dataString,
				cache : false,
				dataType: "json",
				beforeSend: function (xhr) {
					$(".se-pre-con").fadeIn();
					NProgress.start();
				},
				success: function(data){
					if(data.status==200){
						showNotif('bottom-right','Update','Data berhasil di update','success');
					}
					$(".se-pre-con").fadeOut('slow');
					NProgress.done();
					// console.log(data);
					} ,error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
				},
			});
		});
		$('#simpan').on('click', function () {
			if($("#img_url").val() === ''){ 
				var dataString = {
					type : $("#type").val(),
					img_url : '',
					nama : $("#nama_lengkap").val(),
					email : $("#email").val(),
					no_hp : $("#no_hp").val(),
					percetakan : $("#percetakan").val(),
					nama_web : $("#nama_web").val(),
					alamat : $("#alamat").val()
				};
				}else{
				var dataString = {
					type : $("#type").val(),
					img_url : $("#img_url").val(),
					nama : $("#nama_lengkap").val(),
					email : $("#email").val(),
					no_hp : $("#no_hp").val(),
					percetakan : $("#percetakan").val(),
					nama_web : $("#nama_web").val(),
					alamat : $("#alamat").val()
				};
			}
			$.ajax({
				type: "POST",
				url: base_url+"akun/crud_profil/",
				data: dataString,
				cache : false,
				dataType: "json",
				beforeSend: function (xhr) {
					NProgress.start();
					$(".se-pre-con").fadeIn();
				},
				success: function(data){
					if(data.status==200){
						$('#attr_hp1,#attr_hp2').html(data.no_hp);
						$('#attr_nama1,#attr_nama2').html(data.nama_lengkap);
						$('#attr_alamat').html(data.alamat);
						$('#attr_web').html(data.nama_web);
						showNotif('bottom-right','Update Profil','Data berhasil di update','success');
						$("#img_url").val('');
					}
					$(".se-pre-con").fadeOut('slow');
					NProgress.done();
					// console.log(data);
					} ,error: function(xhr, status, error) {
					showNotif('bottom-right','Update Profil',error,'error');
				},
			});
			
		});
		
		$('#input_img').on("change", function () {
			
            var $files = $(this).get(0).files;
            if ($files.length) {
				
                // Reject big files
                if ($files[0].size > $(this).data("max-size") * 1024) {
                    console.log("Please select a smaller file");
                    return false;
				}
				
				var mm =Math.random().toString(36).substring(7) + new Date().getTime(); //to add new name of file
                // Replace ctrlq with your own API key
                var apiKey = 'cbd5cef362ea6c393746b4762f8c1f81';
                var apiUrl = 'https://api.imgbb.com/1/upload?name='+mm+'&key='+apiKey;
				
                var formData = new FormData();
                formData.append("image", $files[0]);
				
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": apiUrl,
                    "method": "POST",
                    "datatype": "json",
                    "mimeType": "multipart/form-data",
                    "processData": false,
                    "contentType": false,
                    "data": formData,
                    beforeSend: function (xhr) {
						$(".se-pre-con").fadeIn();
						NProgress.start();
                        // console.log("Uploading | 上传中");
					},
                    success: function (res) {
                        // console.log(res.url);
						
						$(".loadingcrud").hide();
                        // $('body').append('<img src="' + res.data.link + '" />');
					},
                    error: function (xhr, status, error) {
						showNotif('bottom-right','Update Profil',error,'error');
						$(".se-pre-con").fadeOut('slow');
						NProgress.done();
						$("#img_url").val('');
                        // alert("Failed | 上传失败");
					}
				}
                $.ajax(settings).done(function (response) {
					var jx = JSON.parse(response);
					$("#img_url").val(jx.data.url);
					$('#avatar').attr('src', jx.data.url);
					$('.avatar').attr('src', jx.data.url);
					$(".se-pre-con").fadeOut('slow');
					NProgress.done();
					showNotif('bottom-right','Upload Image','Data berhasil di upload','success');
                    // console.log("Done | 成功");
				});
			}
		});
		$('#input_logo').on("change", function () {
			
            var $files = $(this).get(0).files;
            if ($files.length) {
				
                // Reject big files
                if ($files[0].size > $(this).data("max-size") * 1024) {
                    console.log("Please select a smaller file");
                    return false;
				}
				
				var mm =Math.random().toString(36).substring(7) + new Date().getTime(); //to add new name of file
                // Replace ctrlq with your own API key
                var apiKey = 'e41e84702d59f507a5fec9ced34faf02';
                var apiUrl = 'https://api.imgbb.com/1/upload?name='+mm+'&key='+apiKey;
				
                var formData = new FormData();
                formData.append("image", $files[0]);
				
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": apiUrl,
                    "method": "POST",
                    "datatype": "json",
                    "mimeType": "multipart/form-data",
                    "processData": false,
                    "contentType": false,
                    "data": formData,
                    beforeSend: function (xhr) {
						$(".se-pre-con").fadeIn();
						NProgress.start();
                        // console.log("Uploading | 上传中");
					},
                    success: function (res) {
                        // console.log(res.url);
						
						$(".se-pre-con").fadeOut('slow');
						NProgress.done();
                        // $('body').append('<img src="' + res.data.link + '" />');
					},
                    error: function (xhr, status, error) {
						showNotif('bottom-right','Update Profil',error,'error');
						$(".se-pre-con").fadeOut('slow');
						NProgress.done();
						$("#logo_url").val('');
                        // alert("Failed | 上传失败");
					}
				}
                $.ajax(settings).done(function (response) {
					var jx = JSON.parse(response);
					$("#logo_url").val(jx.data.url);
					$('#img-logo').attr('src', jx.data.url);
					// $('.avatar').attr('src', jx.data.url);
					$(".se-pre-con").fadeOut('slow');
					NProgress.done();
					showNotif('bottom-right','Upload Image','Data berhasil di upload','success');
                    // console.log("Done | 成功");
				});
			}
		});
	});
	
</script>