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
	$.post(base_url+'akun/cari/'+view+'/' + current_query, {'index' : idindex,'page-number' : page_number}, function(data){
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
	$.post(base_url+'akun/cari/'+view, {'index' : idindex,'search':search,'page-number' : nomor},function(data){
		$('#all-ukuran').html(data);
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
function cari(a,b){
	var a = a?a:'';
	var b = b?b:'';
	var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
	var csrfHash = $('.txt_csrfname').val(); // CSRF hash
	$('#chosen-tags').selectize()[0].selectize.destroy();
	$('#chosen-tags').selectize({
		labelField: 'name',
		valueField: 'id',
		searchField: 'name',
		plugins: ['remove_button'],
		options: [],
		create: false,
		load: function(query, callback) {
			if (!query.length) return callback();
			// console.log(csfrData);
			$.ajax({
				url: base_url+'akun/modul_add/',
				type: 'POST',
				dataType: 'json',
				beforeSend: function () {
					NProgress.start();
				},
				data: {
					type: 'modul',
					name: query,
					[csrfName]: csrfHash
				},
				error: function() {
					callback();
				},
				success: function(res) {
					callback(res);
					NProgress.done();
				}
			});
		},
		onInitialize: function(){
			var selectize = this;
			$.post(base_url+"akun/crud",{type:'modul',view:view,id:a,index:b,csfrData}, function( data ) {
				if(a!=""){
					selectize.addOption(data); // This is will add to option
					var selected_items = [];
					$.each(data, function( i, obj) {
						selected_items.push(obj.id);
					});
					selectize.setValue(selected_items); //this will set option values as default
				}
			});
		}
	});
	
}
//Tampilkan Modal 
function kertas(id)
{
	clearModalKertas();
	
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id){
		cari(id,idindex);
		$("#btn-ukuran").html("Update");
		var search = $('#search').val();
		var num = $('#nomor').val();
		$.ajax({
			type: "POST",
			url: base_url+"akun/crud",
			dataType: 'json',
			data: {view:view,id:id,index:idindex,type:"get",cari:search,csfrData},
			beforeSend: function () {
				NProgress.start();
			},
			success: function(res) {
				NProgress.done();
				$('#cari').val(search);
				// console.log(res);
				setModalKertas( res );
			}
		});
		}else{
		cari();
		$("#ModalKertas").modal("show");
		$("#myModalLabel").html("bahan");
		$("#type").val("new"); 
		$("#btn-kertas").html("Simpan");
	}
}

$("input").keyup(function(){
	$("input").removeClass("form-control-warning");
});
$("select").change(function(){
	$("select").removeClass("form-control-warning");
});
//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModalKertas( data )
{
	$("#btn-kertas").html("Update");
	$("#myModalLabel").html("Edit Data");
	$("#id").val(data.id_kategori);
	$("#id_index").val(data.index);
	$("#ket_ukuran").val(data.ket_ukuran);
	$("#panjang").val(data.panjang);
	$("#lebar").val(data.lebar);
	$("#type").val("edit");
	$("#ModalKertas").modal("show");
	
}
//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submitukuran()
{
	
	if($("#ket_ukuran").val()==''){
		$("#ket_ukuran").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#ket_ukuran").focus();
		return;
	}
	if($("#panjang").val()==''){
		$("#panjang").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#panjang").focus() 
		return;
	}
	if($("#lebar").val()==''){
		$("#lebar").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#lebar").focus() 
		return;
	}
	
	if($("#chosen-tags").val()==''){
		$("#chosen-tags").addClass('form-control-warning');
		showNotif('top-center','Input Data','Modul Harus diisi','warning');
		$("#chosen-tags").focus() 
		return;
	}
	
	var formData = $("#formukuran").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_kertas",
		dataType: 'json',
		data: formData,
		beforeSend: function () {
			NProgress.start();
		},
		success: function(data) {
			$('.se-pre-con').hide();
			if(data.status==200){
				showNotif('bottom-right',data.title,data.msg,'success');
				}else{
				showNotif('bottom-right',data.title,data.msg,'error');
			}
			$("#ModalKertas").modal("hide");
			load_data(data.index,data.cari,data.page);
		}
	});
}
//Hapus Data
function deletkertas(id)
{
	clearModalKertas();
	var search = $('#search').val();
	var num = $('#nomor').val();
	cari(id,idindex);
	$.ajax({
		type: "POST",
		url: base_url+"akun/crud",
		dataType: 'json',
		data: {view:view,id:id,index:idindex,type:"get",cari:search,nomor:num,csfrData},
		beforeSend: function () {
			NProgress.start();
		},
		success: function(data) {
			$("#removeWarning").show();
			$("#btn-ukuran").html("Hapus");
			$("#myModalLabel").html("Hapus Data");
			$("#ModalKertas").modal("show");
			$("#type").val("hapus");
			$("#id").val(data.id_kategori);
			$("#id_index").val(data.index);			
			$("#ket_ukuran").val(data.ket_ukuran).attr("readonly","true");
			$("#panjang").val(data.panjang).attr("readonly","true");
			$("#lebar").val(data.lebar).attr("readonly","true");
			// $(".modul").hide();
			$('#chosen-tags').selectize()[0].selectize.disable();
			
		}
	});
}
function clearModalKertas()
{
	$("#removeWarning").hide();
	$("#ket_ukuran").val("").removeAttr( "readonly" );
	$("#panjang").val("").removeAttr( "readonly" );
	$("#lebar").val("").removeAttr( "readonly" );
	$("#publish").val("").removeAttr( "readonly" );
	$("#type").val("");
	$('#chosen-tags').selectize()[0].selectize.enable();
}