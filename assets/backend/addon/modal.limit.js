$(document).on('click', '.page-link', function(e){
	e.preventDefault();
	
	var page_number = $(this).data('page-number');
	var current_query;
	
	if( $(this).data('query') ) {
		current_query = '?' + $(this).data('query');
	}
	else {
		current_query = '';
	}
	var search = $('#search').val();
	$('#nomor').val(page_number);
	$.post(base_url+'akun/cari/'+view + current_query, {'index' : idindex,'search':search,'page-number' : page_number}, function(data){
		$('#all-limit').html(data);
		}).done(function() {
		NProgress.start();
		}).always(function() {
		NProgress.done();
	});
});
load_data(idindex,search,nomor);
function load_data(idindex,search,nomor){
	var search = search?search:'';
	var nomor = nomor?nomor:1;
	$.post(base_url+'akun/cari/'+view, {'index' : idindex,'search':search,'page-number' : nomor},function(data){
		$('#all-limit').html(data);
		}).done(function() {
		NProgress.start();　
		}).always(function() {
		NProgress.done();
	});
}

function load_klik(){
	$('#cats').val(null).trigger("change")
	$('#search').val('');
	$('#filter-form').submit();
}
$(document).on('change', '#cats', function(e){
	e.preventDefault();
	$('#filter-form').submit();
});
$(document).on('submit', '#filter-form', function(e){
	e.preventDefault();
	
	var form = $(this);
	// console.log(form);
	$.post(base_url+'akun/cari/'+view, $(form).serialize(), function(data){
		$('#all-limit').html(data);
		}).done(function() {
		NProgress.start();　
		}).always(function() {
		NProgress.done();
	});
})
//
//Tampilkan Modal 
function limit(id)
{
	clearModallimit();
	
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id){
		// console.log('edit');
		$("#btn-limit").html("Update");
		var search = $('#search').val();
		$.ajax({
			type: "POST",
			url: base_url+"akun/crud",
			dataType: 'json',
			data: {view:view,id:id,index:idindex,type:"get"},
			beforeSend: function () {
				$('.se-pre-con').show();
			},
			success: function(res) {
				setModallimit( res );
				$('#cari').val(search);
				$('.se-pre-con').fadeOut("slow");
			}
		});
		}else{
		// console.log('new');
		$("#Modallimit").modal("show");
		$("#myModalLabel").html("Add data");
		$("#type").val("new"); 
		$("#btn-limit").html("Simpan");
	}
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModallimit( data )
{
	
	$("#myModalLabel").html("Edit Data");
	$("#index").val(data.index);
	$("#id").val(data.id);
	$("#type").val("edit");
	$("#nama").val(data.nama);
	$("#cstyle").val(data.klass);
	$("#cklass").val(data.style);
	$("#pub").val(data.pub);
	$("#Modallimit").modal("show");
}
$("input").keyup(function(){
	$("input").removeClass("form-control-warning");
});
$("select").change(function(){
	$("select").removeClass("form-control-warning");
});
//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submitlimit()
{
	if($("#nama").val()==''){
		$("#nama").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#nama").focus() 
		return;
	}
	if($("#cstyle").val()==''){
		$("#cstyle").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#cstyle").focus();
		return;
	}
	if($("#cklass").val()==''){
		$("#cklass").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#cklass").focus();
		return;
	}
	if($("#pub").val()==''){
		$("#pub").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus dipilih','warning');
		$("#pub").focus();
		return;
	}
	var formData = $("#formlimit").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_limit",
		dataType: 'json',
		data: formData,
		beforeSend: function () {
			$(".se-pre-con").fadeIn(300);　
		},
		success: function(data) {
			$(".se-pre-con").fadeOut(300);　
			if(data.status==200){
				showNotif('bottom-right',data.title,data.msg,'success');
				}else{
				showNotif('bottom-right',data.title,data.msg,'error');
			}
			$("#Modallimit").modal('hide');
			load_data(data.index,data.cari,data.page);
		}
	});
}
//Hapus Data
function deletelimit(id)
{
	clearModallimit();
	$.ajax({
		type: "POST",
		url: base_url+"akun/crud",
		dataType: 'json',
		data: {view:view,id:id,index:idindex,type:"get",cari:search,csfrData},
		beforeSend: function () {
			$(".se-pre-con").fadeIn(300);　
		},
		success: function(data) {
			$(".se-pre-con").fadeOut(300);　
			$("#removeWarning").show();
			$("#btn-limit").html("Hapus");
			$("#myModalLabel").html("Hapus Data");
			$("#id").val(data.id);
			$("#type").val("hapus");
			$("#index").val(data.index).attr("disabled","true");
			$("#nama").val(data.nama).attr("disabled","true");
			$("#cstyle").val(data.style).attr("disabled","true");
			$("#cklass").val(data.klass).attr("disabled","true");
			$("#pub").val(data.pub).attr("disabled","true");
			$("#Modallimit").modal("show");
			load_data(data.index,data.cari,data.page);
		}
	});
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearModallimit()
{
	$("#removeWarning").hide();
	$(".hidex").show();
	$("#id").val("").removeAttr( "disabled" );
	$("#index").val("").removeAttr( "disabled" );
	$("#nama").val("").removeAttr( "disabled" );
	$("#cstyle").val("").removeAttr( "disabled" );
	$("#cklass").val("").removeAttr( "disabled" );
	$("#pub").val("").removeAttr( "disabled" );
	$("#type").val("");
}
