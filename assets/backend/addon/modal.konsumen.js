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
	$.post(base_url+'akun/cari/konsumen'+ current_query, {'search':search,'page-number' : page_number}, function(data){
		$('#all-konsumen').html(data);
		}).done(function() {
		NProgress.start();
		}).always(function() {
		NProgress.done();
	});
});
load_data(search,nomor);
function load_data(search,nomor){
	var search = search?search:'';
	var nomor = nomor?nomor:1;
	$.post(base_url+'akun/cari/konsumen', {'search':search,'page-number' : nomor},function(data){
		$('#all-konsumen').html(data);
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
	$.post(base_url+'akun/cari/konsumen', $(form).serialize(), function(data){
		$('#all-konsumen').html(data);
		}).done(function() {
		NProgress.start();　
		}).always(function() {
		NProgress.done();
	});
})
//Tampilkan Modal 
function konsumen(id)
{
	clearModalkonsumen();
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id){
		// console.log('edit');
		$("#btn-konsumen").html("Update");
		var search = $('#search').val();
		$.ajax({
			type: "POST",
			url: base_url+"akun/crud",
			dataType: 'json',
			data: {view:'konsumen',id:id,type:"get"},
			beforeSend: function () {
				$('.se-pre-con').fadeIn();
			},
			success: function(res) {
				$('#cari').val(search);
				setModalbahan( res );
				$('.se-pre-con').fadeOut("slow");
			}
		});
		}else{
		// console.log('new');
		$("#ModalKonsumen").modal("show");
		$("#myModalLabel").html("Form input konsumen");
		$("#type").val("new"); 
		$("#btn-konsumen").html("Simpan");
	}
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModalbahan( data )
{
	
	$("#myModalLabel").html("Edit Data");
	$("#type").val("edit");
	$("#id").val(data.id);
	$("#tgl").val(data.tgl);
	$("#nama").val(data.nama);
	$("#telp").val(data.telp);
	$("#email").val(data.email);
	$("#alamat").val(data.alamat);
	$("#jabatan").val(data.jabatan);
	$("#perusahaan").val(data.perusahaan);
	$("#ModalKonsumen").modal("show");
}
$("input").keyup(function(){
	$("input").removeClass("form-control-warning");
});
$("select").change(function(){
	$("select").removeClass("form-control-warning");
});
//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submitKonsumen()
{
	
	if($("#email").val()==''){
		$("#email").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#email").focus();
		return;
	}
	if($("#nama").val()==''){
		$("#nama").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#nama").focus() 
		return;
	}
	if($("#jabatan").val()==''){
		$("#jabatan").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#jabatan").focus() 
		return;
	}
	if($("#telp").val()==''){
		$("#telp").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#telp").focus() 
		return;
	}
	if($("#perusahaan").val()==''){
		$("#perusahaan").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#perusahaan").focus() 
		return;
	}
	if($("#alamat").val()==''){
		$("#alamat").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#alamat").focus() 
		return;
	}
	
	var formData = $("#formKonsumen").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_konsumen",
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
			$("#ModalKonsumen").modal('hide');
			load_data(data.index,data.cari,data.page);
			
		}
	});
}

//Hapus Data
function deleteKonsumen(id)
{
	clearModalkonsumen();
	var search = $('#search').val();
	
	$.ajax({
		type: "POST",
		url: base_url+"akun/crud",
		dataType: 'json',
		data: {view:'konsumen',id:id,type:"get",cari:search},
		beforeSend: function () {
			NProgress.start();
		},
		success: function(data) {
			NProgress.done();
			// $(".hidex").hide();
			$("#removeWarning").show();
			$("#btn-konsumen").html("Hapus");
			$("#myModalLabel").html("Hapus Data");
			$("#id").val(data.id);
			$("#type").val("hapus");
			$("#tgl").val(data.tgl).attr("disabled","true");
			$("#nama").val(data.nama).attr("disabled","true");
			$("#telp").val(data.telp).attr("disabled","true");
			$("#email").val(data.email).attr("disabled","true");
			$("#alamat").val(data.alamat).attr("disabled","true");
			$("#jabatan").val(data.jabatan).attr("disabled","true");
			$("#perusahaan").val(data.perusahaan).attr("disabled","true");
			$("#ModalKonsumen").modal("show");
		}
	});
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearModalkonsumen()
{
	$("#removeWarning").hide();
	$(".hidex").show();
	$("#tgl").val("").removeAttr("disabled");
	$("#nama").val("").removeAttr("disabled");
	$("#telp").val("").removeAttr("disabled");
	$("#email").val("").removeAttr("disabled");
	$("#alamat").val("").removeAttr("disabled");
	$("#jabatan").val("").removeAttr("disabled");
	$("#perusahaan").val("").removeAttr("disabled");
	
	$("#type").val("");
	// NProgress.remove();
}
