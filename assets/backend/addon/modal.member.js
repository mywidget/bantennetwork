function searchFilter(page_num){
	page_num = page_num?page_num:0;
	var keywords = $('#keywords').val();
	var sortBy = $('#sortBy').val();
	$.ajax({
		type: 'POST',
		url: base_url+'master/ajaxMember/'+page_num,
		data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
		beforeSend: function(){
			$('.loading').show();
		},
		success: function(html){
			$('#posts_content').html(html);
			$('.loading').fadeOut("slow");
		}
	});
}
//Tampilkan Modal 
function member()
{
	
	clearModalmember();
	// console.log('new');
	$("#Modalmember").modal("show");
	$("#myModalLabel").html("Add data user");
	$("#type").val("new"); 
	$("#btn-bahan").html("Simpan");
	
}

function submitMember()
{
	// console.log('submit');
	if($("#mail").val()==''){
		$("#mail").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#mail").focus();
		return;
	}
	if($("#title").val()==''){
		$("#title").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#title").focus();
		return;
	}
	if($("#daftar").val()==''){
		$("#daftar").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#daftar").focus();
		return;
	}
	if($("#phone").val()==''){
		$("#phone").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#phone").focus();
		return;
	}
	if($("#alamat").val()==''){
		$("#alamat").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#alamat").focus();
		return;
	}
	
	var formData = $("#formmember").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"master/simpan_pengguna",
		dataType: 'json',
		data: formData,
		beforeSend: function () {
			NProgress.start();
			$(".se-pre-con").fadeIn();　
		},
		success: function(data) {
			$(".se-pre-con").fadeOut('slow');　
			NProgress.done();
			if(data.status==200){
				showNotif('bottom-right',data.title,data.msg,'success');
				}else{
				showNotif('bottom-right',data.title,data.msg,'error');
			}
			$("#myModal").modal('hide');
			searchFilter();
			} ,error: function(xhr, status, error) {
			showNotif('bottom-right','Update',error,'error');
			$(".se-pre-con").fadeOut('slow');
		}
	});
}

function simpanMember()
{
	// console.log('submit');
	if($("#mail").val()==''){
		$("#mail").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#mail").focus();
		return;
	}
	if($("#title").val()==''){
		$("#title").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#title").focus();
		return;
	}
	if($("#daftar").val()==''){
		$("#daftar").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#daftar").focus();
		return;
	}
	if($("#phone").val()==''){
		$("#phone").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#phone").focus();
		return;
	}
	if($("#alamat").val()==''){
		$("#alamat").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#alamat").focus();
		return;
	}
	
	var formData = $("#formAdd").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"master/simpan_pengguna",
		dataType: 'json',
		data: formData,
		beforeSend: function () {
			NProgress.start();
			$(".se-pre-con").fadeIn();　
		},
		success: function(data) {
			$(".se-pre-con").fadeOut('slow');　
			NProgress.done();
			if(data.status==200){
				showNotif('bottom-right',data.title,data.msg,'success');
				}else{
				showNotif('bottom-right',data.title,data.msg,'error');
			}
			$("#Modalmember").modal('hide');
			searchFilter();
			} ,error: function(xhr, status, error) {
			showNotif('bottom-right','Update',error,'error');
			$(".se-pre-con").fadeOut('slow');
		}
	});
}

//Hapus Data
function deletepost(id,file)
{
	// console.log(a);
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})
	
	swalWithBootstrapButtons.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Yes, delete it!',
		cancelButtonText: 'No, cancel!',
		reverseButtons: true
		}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: "POST",
				url: "/master/deletepost/",
				data: {'id' : id,'file':file},
				cache : false,
				dataType:'json',
				beforeSend: function (xhr) {
					// $("#load").show();
				},
				success: function(data){
					if(data.status=='ok'){
						swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Data berhasil dihapus.',
                            'success'
						)
						}else if(data.status=='error_delete'){
						swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Akun tidak boleh dihapus.',
                            'error'
						)
						}else{
						swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Data gagal dihapus.',
                            'error'
						)
					}
					searchFilter();
					} ,error: function(xhr, status, error) {
					swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
					)
				},
			});
			
            } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
			swalWithBootstrapButtons.fire(
                'Cancelled',
                'Data gagal dihapus',
                'error'
			)
		}
	})
	// window.location.href='/artikel/deletepost/'+a;
}
function clearModalmember()
{
	console.log('clear');
	$("#removeWarning").hide();
	$(".hidex").show();
	$("#id").val("").removeAttr("readonly");
	$("#mail").val("").removeAttr("readonly");
	$("#mail").val("").removeAttr("disabled");
	$("#title").val("").removeAttr("disabled");
	$("#daftar").val("").removeAttr("disabled");
	$("#phone").val("").removeAttr("disabled");
	$("#alamat").val("").removeAttr("disabled");
	$("#data").val("").removeAttr("disabled");
	$("#type").val("");
}