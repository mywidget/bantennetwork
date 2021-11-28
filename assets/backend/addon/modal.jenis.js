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
	$('#nomor').val(page_number);
	$.post(base_url+'akun/cari/'+view + current_query, {sort:sort,'index' : idindex,'search':search,'page-number' : page_number,csfrData}, function(data){
		$('#all-jenisbahan').html(data);
		}).done(function() {
		NProgress.start();
		}).always(function() {
		NProgress.done();
	});
});
load_data(idindex,search,nomor);
function load_data(idindex,search,nomor){
	var search = search?search:'';
	var nomor = nomor?nomor:'';
	$.post(base_url+'akun/cari/'+view, {sort:sort,'index' : idindex,'search':search,'page-number' : nomor,csfrData},function(data){
		$('#all-jenisbahan').html(data);
		}).done(function() {
		NProgress.start();
		}).always(function() {
		NProgress.done();
	});
}
function load_klik(){
	$('#search').val('');
	$('#filter-form').submit();
}
function load_sort(){
	$('#filter-form').submit();
}
$(document).on('submit', '#filter-form', function(e){
	e.preventDefault();
	
	var form = $(this);
	// console.log(form);
	$.post(base_url+'akun/cari/'+view, $(form).serialize(), function(data){
		$('#all-jenisbahan').html(data);
		}).done(function() {
		NProgress.start();
		}).always(function() {
		NProgress.done();
	});
	
})
//Tampilkan Modal 
function jenis(id)
{
	clearModaljenisbahan();
	
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id){
		$("#btn-jenisbahan").html("Update");
		var search = $('#search').val();
		$.ajax({
			type: "POST",
			url: base_url+"akun/crud",
			dataType: 'json',
			data: {view:view,id:id,index:idindex,type:"get",csfrData},
			beforeSend: function () {
				$('.se-pre-con').fadeIn();
			},
			success: function(res) {
				$('#cari').val(search);
				setModaljenisbahan( res );
				$('.se-pre-con').fadeOut('slow');
			}
		});
		}else{
		$("#Modaljenisbahan").modal("show");
		$("#myModalLabel").html("Add data");
		$("#type").val("new"); 
		$("#btn-jenisbahan").html("Simpan");
	}
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModaljenisbahan( data )
{
	
	$("#myModalLabel").html("Edit Data");
	$("#id").val(data.id);
	$("#index").val(data.index);
	$("#type").val("edit");
	$("#nama_jenis").val(data.nama_jenis);
	$("#pub").val(data.pub);
	$("#Modaljenisbahan").modal("show");
}
$("input").keyup(function(){
	$("input").removeClass("form-control-warning");
});
$("select").change(function(){
	$("select").removeClass("form-control-warning");
});
//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submitjenisbahan()
{
	if($("#nama_jenis").val()==''){
		$("#nama_jenis").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#nama_jenis").focus() 
		return;
	}
	if($("#pub").val()==''){
		$("#pub").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#pub").focus();
		return;
	}
	var formData = $("#formjenisbahan").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_jenis",
		dataType: 'json',
		data: formData,
		beforeSend: function () {
			$('.se-pre-con').fadeIn();
		},
		success: function(data) {
			NProgress.done();
			if(data.status==200){
				showNotif('bottom-right',data.title,data.msg,'success');
				}else{
				showNotif('bottom-right',data.title,data.msg,'error');
			}
			$("#Modaljenisbahan").modal("hide");
			load_data(data.index,data.cari,data.page);
			$('.se-pre-con').fadeOut('slow');
		}
	});
}
//Hapus Data
function deletejenisbahan(id)
{
	clearModaljenisbahan();
	$.ajax({
		type: "POST",
		url: base_url+"akun/crud",
		dataType: 'json',
		data: {view:view,id:id,index:idindex,type:"get"},
		beforeSend: function () {
			$('.se-pre-con').fadeIn();
		},
		success: function(data) {
			$(".se-pre-con").fadeOut(300);　
			$("#removeWarning").show();
			$("#btn-jenisbahan").html("Hapus");
			$("#myModalLabel").html("Hapus Data");
			$("#id").val(data.id);
			$("#type").val("hapus");
			$("#index").val(data.index).attr("disabled","true");
			$("#nama_jenis").val(data.nama_jenis).attr("disabled","true");
			$("#pub").val(data.pub).attr("disabled","true");
			$("#Modaljenisbahan").modal("show");
			$('.se-pre-con').fadeOut('slow');
		}
	});
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearModaljenisbahan()
{
	$("#removeWarning").hide();
	$(".hidex").show();
	$("#id").val("").removeAttr( "disabled" );
	$("#index").val("").removeAttr( "disabled" );
	$("#nama_jenis").val("").removeAttr( "disabled" );
	$("#pub").val("").removeAttr( "disabled" );
	$("#type").val("");
}
