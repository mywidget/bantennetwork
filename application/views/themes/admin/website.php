<?=p_header(array('file-text','danger','Pengaturan','Pengaturan website','','Pengaturan'),$module);	?>
<div class="row">
	<div class="loadingcrud"></div>
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Pengaturan</a>
				</li>
				
			</ul>
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
					<div class="card-body">
						<form class="form-horizontal">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="site_name">Nama Website</label>
									<div class="input-group mb-3">
										<input type="text" name="site_name" value="<?=$setting['site_name'];?>" class="form-control" id="site_name" placeholder="Nama Website">
										<div class="input-group-append">
											<button class="btn btn-success" type="button" id="site_name_save" value="site_name_save">Simpan</button>
										</div>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label for="site_url">Url</label>
									<div class="input-group mb-3">
										<input type="text" name="site_url" value="<?=$setting['site_url'];?>" class="form-control" id="site_url" placeholder="Nama Website">
										<div class="input-group-append">
											<button class="btn btn-success" type="button" id="site_url_save" value="site_url_save">Simpan</button>
										</div>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="site_title">Tagline</label>
									<div class="input-group mb-3">
										<input type="text" name="site_title" value="<?=$setting['site_title'];?>" class="form-control" id="site_title" placeholder="Tagline Website" required>
										<div class="input-group-append">
											<button class="btn btn-success" type="button"  value="site_title_save">Simpan</button>
										</div>
									</div>
								</div>
								
								<div class="form-group col-md-6">
									<label for="site_keys">Keywords</label>
									<div class="input-group mb-3">
										<input type="text" name="site_keys" value="<?=$setting['site_keys'];?>" class="form-control" id="site_keys" placeholder="Keywords website">
										<div class="input-group-append">
											<button class="btn btn-success" type="button"  value="site_keys_save">Simpan</button>
										</div>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="site_desc">Deskripsi</label>
									<div class="input-group mb-3">
										<input type="text" name="site_desc" value="<?=$setting['site_desc'];?>" class="form-control" id="site_desc" placeholder="Deskripsi Website" required>
										<div class="input-group-append">
											<button class="btn btn-success" type="button" value="site_desc_save">Simpan</button>
										</div>
									</div>
								</div>
								
								<div class="form-group col-md-6">
									<label for="site_company">Nama Perusahaan</label>
									<div class="input-group mb-3">
										<input type="text" name="site_company" value="<?=$setting['site_company'];?>" class="form-control" id="site_company" placeholder="site_company">
										<div class="input-group-append">
											<button class="btn btn-success" type="button" value="site_company_save">Simpan</button>
										</div>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="site_phone">No. Telp</label>
									<div class="input-group mb-3">
										<input type="text" name="site_phone" value="<?=$setting['site_phone'];?>" class="form-control" id="site_phone" required>
										<div class="input-group-append">
											<button class="btn btn-success" type="button" value="site_desc_save">Simpan</button>
										</div>
									</div>
								</div>
								
								<div class="form-group col-md-6">
									<label for="site_mail">Email</label>
									<div class="input-group mb-3">
										<input type="text" name="site_mail" value="<?=$setting['site_mail'];?>" class="form-control" id="site_mail" placeholder="site_mail">
										<div class="input-group-append">
											<button class="btn btn-success" type="button" value="site_company_save">Simpan</button>
										</div>
									</div>
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
									<input type="file" id="input_icon" name="input_icon" class="file-upload-default"  accept="image/*">
									<div class="input-group col-xs-12">
										<input type="text" id="img_icon" value="<?=$setting['site_favicon'];?>" name="img_icon" class="form-control file-upload-info" readonly="" placeholder="Upload Favicon">
										<span class="input-group-append">
											<button class="file-upload-browse btn btn-primary" type="button">Cari Icon</button>
										</span>
									</div>
								</div>
							</div>
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
		
		
		
		$('button').on('click', function () {
			var fired_button = $(this).val();
			var dataString = {};
			if(fired_button=='site_name_save'){
				dataString = {type : "site_name",site_val : $("#site_name").val()};
				}else if(fired_button=='site_url_save'){
				dataString = {type : "site_url",site_val : $("#site_url").val()};
				}else if(fired_button=='site_title_save'){
				dataString = {type : "site_title",site_val : $("#site_title").val()};
				}else if(fired_button=='site_keys_save'){
				dataString = {type : "site_keys",site_val : $("#site_keys").val()};
				}else if(fired_button=='site_desc_save'){
				dataString = {type : "site_desc",site_val : $("#site_desc").val()};
				}else if(fired_button=='site_company_save'){
				dataString = {type : "site_company",site_val : $("#site_company").val()};
				}else if(fired_button=='site_phone_save'){
				dataString = {type : "site_phone",site_val : $("#site_phone").val()};
				}else if(fired_button=='site_mail_save'){
				dataString = {type : "site_mail",site_val : $("#site_mail").val()};
			}
			
			$.ajax({
				url: '<?php echo base_url()?>info/setting_save', /*point to server-side PHP script */
				dataType: 'json',  
				data: dataString,                         
				type: 'POST',
				beforeSend: function (xhr) {
					NProgress.start();
					$(".se-pre-con").fadeIn();
				},
				success: function(res){
					if(res.status==200){
						$("#"+res.name_id).val(res.name_val);
						showNotif('bottom-right','Update','Data berhasil di update','success');
					}
					NProgress.done();
					$(".se-pre-con").fadeOut('slow');
					} ,error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					NProgress.done();
					$(".se-pre-con").fadeOut('slow');
				}
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
			
            var file_data = $("#input_icon").prop('files')[0]; 
			var img_logo = $("#img_icon").val(); 
			// console.log(file_data)
			var form_data = new FormData(); 
			var ext = $("#input_icon").val().split('.').pop().toLowerCase();
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
			form_data.append('input_icon', file_data);  
			form_data.append('input_name', img_logo);  
			$.ajax({
				url: '<?php echo base_url()?>info/uploadIcon', /*point to server-side PHP script */
				dataType: 'json',  
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
				success: function(res){
					// $(".alert_success").show();
					if(res.status==200){
						$("#img_icon").val(res.name);
					}
					// window.location.hash = '#success_message';
				}
			});
		});
	});
	
</script>