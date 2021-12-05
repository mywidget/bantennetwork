<?=p_header(array('file-text','danger','Pengaturan','Pengaturan website','','Pengaturan'),$module);	?>
<div class="row">
	<div class="loadingcrud"></div>
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Pengaturan</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pills-sandi-tab" data-toggle="pill" href="#previous-sandi" role="tab" aria-controls="pills-sandi" aria-selected="false">Ganti Sandi</a>
				</li>
			</ul>
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
					<div class="card-body">
						<form class="form-horizontal">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="site_name">Nama Website</label>
									<input type="text" name="site_name" value="<?=$setting['site_name'];?>" class="form-control" id="site_name" placeholder="Nama Website">
								</div>
								<div class="form-group col-md-6">
									<label for="site_url">Url</label>
									<input type="text" name="site_url" value="<?=$setting['site_url'];?>" class="form-control" id="site_url" placeholder="site_url">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="site_title">Tagline</label>
									<input type="text" name="site_title" value="<?=$setting['site_title'];?>" class="form-control" id="site_title" placeholder="Tagline Website" required>
								</div>
								
								<div class="form-group col-md-6">
									<label for="site_keys">Keywords</label>
									<input type="text" name="site_keys" value="<?=$setting['site_keys'];?>" class="form-control" id="site_keys" placeholder="Keywords website">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="site_desc">Deskripsi</label>
									<input type="text" name="site_desc" value="<?=$setting['site_desc'];?>" class="form-control" id="site_desc" placeholder="Deskripsi Website" required>
								</div>
								
								<div class="form-group col-md-6">
									<label for="site_company">Nama Perusahaan</label>
									<input type="text" name="site_company" value="<?=$setting['site_company'];?>" class="form-control" id="site_company" placeholder="site_company">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Logo</label>
									<input type="file" id="input_logo"  name="input_logo" class="file-upload-default"  accept="image/*">
									<div class="input-group col-xs-12">
										<input type="text" id="img_logo" value="<?=$setting['site_logo'];?>" name="img_logo" class="form-control file-upload-info" readonly="" placeholder="Upload Logo">
										<span class="input-group-append">
											<button class="file-upload-browse btn btn-primary" type="button">Cari Logo</button>
										</span>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label>Favicon</label>
									<input type="file" id="input_icon"  class="file-upload-default"  accept="image/*">
									<div class="input-group col-xs-12">
										<input type="text" id="img_icon" value="<?=$setting['site_favicon'];?>" name="img_icon" class="form-control file-upload-info" readonly="" placeholder="Upload Favicon">
										<span class="input-group-append">
											<button class="file-upload-browse btn btn-primary" type="button">Cari Icon</button>
										</span>
									</div>
								</div>
							</div>
							<button id="simpan" class="btn btn-success" type="button">Update</button>
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
		
		$('#input_logo').on("change", function () {
			var file_data = $("#input_logo").prop('files')[0]; 
			var img_logo = $("#img_logo").val(); 
			// console.log(file_data)
			var form_data = new FormData(); 
			var ext = $("#input_logo").val().split('.').pop().toLowerCase();
			if ($.inArray(ext, ['png','jpg','jpeg']) == -1)   {
				alert("only jpg and png images allowed");
				return;
			}  
			var picsize = (file_data.size);
			if(picsize > 2097152) /* 2mb*/
			{
				alert("Image allowd less than 2 mb")
				return;
			}
			form_data.append('input_logo', file_data);  
			form_data.append('input_name', img_logo);  
			$.ajax({
				url: '<?php echo base_url()?>info/uploadLogo', /*point to server-side PHP script */
				dataType: 'json',  
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
				success: function(res){
					// $(".alert_success").show();
					if(res.status==200){
						$("#img_logo").val(res.name);
					}
					// window.location.hash = '#success_message';
				}
			});
		});
		$('#input_icon').on("change", function () {
			
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