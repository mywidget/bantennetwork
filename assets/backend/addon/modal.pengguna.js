function searchFilter(page_num){
	page_num = page_num?page_num:0;
	var keywords = $('#keywords').val();
	var sortBy = $('#sortBy').val();
	$.ajax({
		type: 'POST',
		url: base_url+'akun/ajaxPengguna/'+page_num,
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
function pengguna(id)
{
	clearModalpengguna();
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id){
		// console.log('edit');
		$("#btn-pengguna").html("Update");
		$.ajax({
			type: "POST",
			url: base_url+"crud_data/load_data",
			dataType: 'json',
			data: {id:id,type:"get"},
			beforeSend: function () {
				// $('.se-pre-con').fadeIn();
			},
			success: function(res) {
				setModalpengguna( res );
				$('.se-pre-con').fadeOut("slow");
			}
		});
		}else{
		// console.log('new');
		$("#Modalpengguna").modal("show");
		$("#myModalLabel").html("Add data user");
		$("#type").val("new"); 
		$("#btn-bahan").html("Simpan");
	}
}
function setModalpengguna( data )
{
	
	$("#myModalLabel").html("Edit Data");
	$("#id").val(data.id);
	$("#type").val("edit");
	$("#mail").val(data.mail);
	$("#title").val(data.title);
	$("#daftar").val(data.tgldaftar);
	$("#phone").val(data.phone);
	$("#percetakan").val(data.percetakan);
	$("#nama_web").val(data.website);
	$("#alamat").val(data.address);
	$("#profit").val(data.profit);
	$("#data").val(data.data);
	$("#Modalpengguna").modal("show");
}
function submitPengguna()
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
	if($("#percetakan").val()==''){
		$("#percetakan").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#percetakan").focus();
		return;
	}
	if($("#nama_web").val()==''){
		$("#nama_web").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#nama_web").focus();
		return;
	}
	if($("#alamat").val()==''){
		$("#alamat").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#alamat").focus();
		return;
	}
	if($("#profit").val()==''){
		$("#profit").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#profit").focus();
		return;
	}
	var formData = $("#formpengguna").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_pengguna",
		dataType: 'json',
		data: formData,
		beforeSend: function () {
			NProgress.start();
			// $(".se-pre-con").fadeIn();　
		},
		success: function(data) {
			$(".se-pre-con").fadeOut('slow');　
			NProgress.done();
			if(data.status==200){
				showNotif('bottom-right',data.title,data.msg,'success');
				}else{
				showNotif('bottom-right',data.title,data.msg,'error');
			}
			$("#Modalpengguna").modal('hide');
			searchFilter();
			
		}
	});
}

//Hapus Data
function deletebahan(id)
{
	clearModalpengguna();
	// var search = $('#search').val();
	
	$.ajax({
		type: "POST",
		url: base_url+"akun/crud",
		dataType: 'json',
		data: {view:view,id:id,index:idindex,type:"get",cari:search,csfrData},
		beforeSend: function () {
			NProgress.start();
		},
		success: function(data) {
			NProgress.done();
			// $(".hidex").hide();
			$("#removeWarning").show();
			$("#btn-bahan").html("Hapus");
			$("#myModalLabel").html("Hapus Data");
			$("#id").val(data.id);
			$("#type").val("hapus");
			$("#mail").val(data.mail).removeAttr( "disabled" );
			$("#title").val(data.title).removeAttr( "disabled" );
			$("#daftar").val(data.tgldaftar).removeAttr( "disabled" );
			$("#phone").val(data.phone).removeAttr( "disabled" );
			$("#percetakan").val(data.percetakan).removeAttr( "disabled" );
			$("#nama_web").val(data.website).removeAttr( "disabled" );
			$("#alamat").val(data.address).removeAttr( "disabled" );
			$("#profit").val(data.profit).removeAttr( "disabled" );
			$("#data").val(data.data).removeAttr( "disabled" );
			$("#Modalpengguna").modal("show");
		}
	});
}

function clearModalpengguna()
{
	$("#removeWarning").hide();
	$(".hidex").show();
	$("#id").val("").removeAttr( "readonly" );
	$("#mail").val("").removeAttr( "disabled" );
	$("#title").val("").removeAttr( "disabled" );
	$("#daftar").val("").removeAttr( "disabled" );
	$("#phone").val("").removeAttr( "disabled" );
	$("#percetakan").val("").removeAttr( "disabled" );
	$("#nama_web").val("").removeAttr( "disabled" );
	$("#alamat").val("").removeAttr( "disabled" );
	$("#profit").val("").removeAttr( "disabled" );
	$("#data").val("").removeAttr( "disabled" );
	$("#type").val("");
}