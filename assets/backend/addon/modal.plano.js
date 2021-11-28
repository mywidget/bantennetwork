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
	$.post(base_url+'akun/cari/'+view+'/' + current_query, {sort:sort,'index' : idindex,'page-number' : page_number}, function(data){
		$('#all-ukuran').html(data);
		}).done(function() {
		NProgress.start();
		}).always(function() {
		NProgress.done();
	});
})
load_data(idindex,search,nomor);
function load_data(idindex,search,nomor){
	var search = search?search:'';
	var nomor = nomor?nomor:1;
	$.post(base_url+'akun/cari/'+view, {sort:sort,'index' : idindex,'search':search,'page-number' : nomor},function(data){
		$('#all-plano').html(data);
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
		$('#all-ukuran').html(data);
		}).done(function() {
		NProgress.start();
		}).always(function() {
		NProgress.done();
	});
	
	
})
//Tampilkan Modal 
function plano(id)
{
	clearModalplano();
	
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id){
		// console.log('edit');
		$("#btn-plano").html("Update");
		var search = $('#search').val();
		$.ajax({
			type: "POST",
			url: base_url+"akun/crud",
			dataType: 'json',
			data: {
				view:view,
				id:id,
				index:idindex,
				type:"get",
				csfrData
			},
			beforeSend: function () {
				$('.se-pre-con').show();
			},
			success: function(res) {
				$('.se-pre-con').fadeOut("slow");
				$('#cari').val(search);
				// console.log(res);
				setModalplano( res );
			}
		});
		}else{
		// console.log('new');
		$("#Modalplano").modal("show");
		$("#myModalLabel").html("plano");
		$("#type").val("new"); 
		$("#btn-plano").html("Simpan");
	}
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModalplano( data )
{
	
	$("#myModalLabel").html("Edit Data");
	$("#index").val(data.index);
	$("#id").val(data.id);
	$("#type").val("edit");
	$("#nama").val(data.nama);
	$("#panjang").val(data.panjang);
	$("#lebar").val(data.lebar);
	$("#Modalplano").modal("show");
}
$("input").keyup(function(){
	$("input").removeClass("form-control-warning");
});
$("select").change(function(){
	$("select").removeClass("form-control-warning");
});
//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submitplano()
{
	if($("#nama").val()==''){
		$("#nama").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#nama").focus() 
		return;
	}
	if($("#panjang").val()==''){
		$("#panjang").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#panjang").focus();
		return;
	}
	if($("#lebar").val()==''){
		$("#lebar").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#lebar").focus();
		return;
	}
	var formData = $("#formplano").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_plano",
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
			$("#Modalplano").modal('hide');
			load_data(data.index,data.cari,data.page);
		}
	});
}
//Hapus Data
function deleteplano(id)
{
	clearModalplano();
	$.ajax({
		type: "POST",
		url: base_url+"akun/crud",
		dataType: 'json',
		data: {
			view:view,
			id:id,
			index:idindex,
			type:"get",
			csfrData
		},
		beforeSend: function () {
			$(".se-pre-con").fadeIn(300);　
		},
		success: function(data) {
			$(".se-pre-con").fadeOut(300);　
			$("#removeWarning").show();
			$("#btn-plano").html("Hapus");
			$("#myModalLabel").html("Hapus Data");
			$("#id").val(data.id);
			$("#type").val("hapus");
			$("#index").val(data.index).attr("disabled","true");
			$("#nama").val(data.nama).attr("disabled","true");
			$("#panjang").val(data.panjang).attr("disabled","true");
			$("#lebar").val(data.lebar).attr("disabled","true");
			$("#Modalplano").modal("show");
		}
	});
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearModalplano()
{
	$("#removeWarning").hide();
	$(".hidex").show();
	$("#id").val("").removeAttr( "disabled" );
	$("#index").val("").removeAttr( "disabled" );
	$("#nama").val("").removeAttr( "disabled" );
	$("#panjang").val("").removeAttr( "disabled" );
	$("#lebar").val("").removeAttr( "disabled" );
	$("#type").val("");
}
