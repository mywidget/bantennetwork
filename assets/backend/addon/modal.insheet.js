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
		$('#all-insheet').html(data);
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
		$('#all-insheet').html(data);
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
		$('#all-insheet').html(data);
		}).done(function() {
		NProgress.start();　
		}).always(function() {
		NProgress.done();
	});
})
//
//Tampilkan Modal 
function insheet(id)
{
	clearModalinsheet();
	
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id){
		// console.log('edit');
		$("#btn-insheet").html("Update");
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
				setModalinsheet( res );
				$('#cari').val(search);
				$('.se-pre-con').fadeOut("slow");
			}
		});
		}else{
		// console.log('new');
		$("#Modalinsheet").modal("show");
		$("#myModalLabel").html("insheet");
		$("#type").val("new"); 
		$("#btn-insheet").html("Simpan");
	}
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModalinsheet( data )
{
	
	$("#myModalLabel").html("Edit Data");
	$("#index").val(data.index);
	$("#id").val(data.id);
	$("#type").val("edit");
	$("#dari").val(data.dari);
	$("#sampai").val(data.sampai);
	$("#insheet").val(data.insheet);
	$("#insheet_bb").val(data.insheet_bb);
	$("#Modalinsheet").modal("show");
}
$("input").keyup(function(){
	$("input").removeClass("form-control-warning");
});
$("select").change(function(){
	$("select").removeClass("form-control-warning");
});
//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submitinsheet()
{
	if($("#dari").val()==''){
		$("#dari").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#dari").focus() 
		return;
	}
	if($("#sampai").val()==''){
		$("#sampai").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#sampai").focus();
		return;
	}
	if($("#insheet").val()==''){
		$("#insheet").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#insheet").focus();
		return;
	}
	if($("#insheet_bb").val()==''){
		$("#insheet_bb").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#insheet_bb").focus();
		return;
	}
	var formData = $("#forminsheet").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_insheet",
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
			$("#Modalinsheet").modal('hide');
			load_data(data.index,data.cari,data.page);
		}
	});
}
//Hapus Data
function deleteinsheet(id)
{
	clearModalinsheet();
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
			$("#btn-insheet").html("Hapus");
			$("#myModalLabel").html("Hapus Data");
			$("#id").val(data.id);
			$("#type").val("hapus");
			$("#index").val(data.index).attr("disabled","true");
			$("#dari").val(data.dari).attr("disabled","true");
			$("#sampai").val(data.sampai).attr("disabled","true");
			$("#insheet").val(data.insheet).attr("disabled","true");
			$("#insheet_bb").val(data.insheet_bb).attr("disabled","true");
			$("#pub").val(data.pub).attr("disabled","true");
			$("#Modalinsheet").modal("show");
			load_data(data.index,data.cari,data.page);
		}
	});
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearModalinsheet()
{
	$("#removeWarning").hide();
	$(".hidex").show();
	$("#id").val("").removeAttr( "disabled" );
	$("#index").val("").removeAttr( "disabled" );
	$("#dari").val("").removeAttr( "disabled" );
	$("#sampai").val("").removeAttr( "disabled" );
	$("#insheet").val("").removeAttr( "disabled" );
	$("#insheet_bb").val("").removeAttr( "disabled" );
	$("#type").val("");
}
