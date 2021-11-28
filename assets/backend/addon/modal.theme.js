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
		$('#all-theme').html(data);
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
		$('#all-theme').html(data);
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
		$('#all-theme').html(data);
		}).done(function() {
		NProgress.start();　
		}).always(function() {
		NProgress.done();
	});
})
function cekpub(id){
	var search = $('#search').val();
	var pub = $('#pub').val();
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_theme",
		dataType: 'json',
		data: {
			view:view,
			id:id,
			index:idindex,
			type:"pub",
			nomor:nomor,
			cari:search,
			pub:pub
		},
		beforeSend: function () {
			$('.se-pre-con').show();
		},
		success: function(data) {
			$('.se-pre-con').fadeOut("slow");
			load_data(data.index,data.cari,data.page);
		}
	});
}
function theme(id)
{
	clearModaltheme();
	
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id){
		// console.log('edit');
		$("#btn-theme").html("Update");
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
				$('.se-pre-con').fadeOut("slow");
				$('#cari').val(search);
				// console.log(res);
				setModaltheme( res );
			}
		});
		}else{
		// console.log('new');
		$("#Modaltheme").modal("show");
		$("#myModalLabel").html("theme");
		$("#type").val("new"); 
		$("#btn-theme").html("Simpan");
	}
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModaltheme( data )
{
	// console.log(data.pub);
	$("#myModalLabel").html("Edit Data");
	$("#index").val(data.index);
	$("#id").val(data.id);
	$("#type").val("edit");
	$("#nama").val(data.nama);
	$("#kolom").val(data.kolom);
	$("publish").val(data.pub);
	$("#Modaltheme").modal("show");
}
$("input").keyup(function(){
	$("input").removeClass("form-control-warning");
});
//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submittheme()
{
	if($("#nama").val()==''){
		$("#nama").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#nama").focus() 
		return;
	}
	if($("#kolom").val()==''){
		$("#kolom").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#kolom").focus();
		return;
	}
	if($("publish").val()==''){
		$("publish").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("publish").focus();
		return;
	}
	var formData = $("#formtheme").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_theme",
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
			$("#Modaltheme").modal('hide');
			load_data(data.index,data.cari,data.page);
		}
	});
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearModaltheme()
{
	$("#removeWarning").hide();
	$(".hidex").show();
	$("#id").val("").removeAttr( "disabled" );
	$("#index").val("").removeAttr( "disabled" );
	$("#nama").val("").removeAttr( "disabled" );
	$("#klass").val("").removeAttr( "disabled" );
	$("#kolom").val("").removeAttr( "disabled" );
	$("publish").val("").removeAttr( "disabled" );
	$("#type").val("");
}