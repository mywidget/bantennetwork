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
		$('#all-hargaprint').html(data);
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
		$('#all-hargaprint').html(data);
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
		$('#all-hargaprint').html(data);
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
				}
			});
		},
		onInitialize: function(){
			var selectize = this;
			if(a!=""){
				$.post(base_url+"akun/crud",{type:'modul',view:view,id:a,index:b,csfrData}, function( data ) {
					selectize.addOption(data); // This is will add to option
					var selected_items = [];
					$.each(data, function( i, obj) {
						selected_items.push(obj.id);
					});
					selectize.setValue(selected_items); //this will set option values as default
				});
			}
		}
	});
	
}
//Tampilkan Modal 
function hargaprint(id)
{
	clearModalhargaprint();
	
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id){
		cari(id,idindex);
		$("#btn-hargaprint").html("Update");
		var search = $('#search').val();
		$.ajax({
			type: "POST",
			url: base_url+"akun/crud",
			dataType: 'json',
			data: {view:view,id:id,index:idindex,type:"get",csfrData},
			beforeSend: function () {
				// $('.se-pre-con').show();
			},
			success: function(res) {
				$('.se-pre-con').fadeOut("slow");
				$('#cari').val(search);
				// console.log(res);
				setModalhargaprint( res );
			}
		});
		}else{
		cari();
		$("#Modalhargaprint").modal("show");
		$("#myModalLabel").html("hargaprint");
		$("#type").val("new"); 
		$("#btn-hargaprint").html("Simpan");
	}
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModalhargaprint( data )
{
	// console.log();
	$("#myModalLabel").html("Edit Data");
	$("#index").val(data.index);
	$("#id").val(data.id);
	$("#type").val("edit");
	$("#kdmesin").val(data.kdmesin);
	$("#jml_min").val(data.jml_min);
	$("#jml_max").val(data.jml_max);
	$("#harga").val(data.harga);
	$("#laminating").val(data.laminating);
	$("#Modalhargaprint").modal("show");
}
$("input").keyup(function(){
	$("input").removeClass("form-control-warning");
});
$("select").change(function(){
	$("select").removeClass("form-control-warning");
});
//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submithargaprint()
{
	if($("#kdmesin").val()==''){
		$("#kdmesin").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#kdmesin").focus() 
		return;
	}
	if($("#jml_min").val()==''){
		$("#jml_min").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#jml_min").focus();
		return;
	}
	if($("#jml_max").val()==''){
		$("#jml_max").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#jml_max").focus();
		return;
	}
	if($("#harga").val()==''){
		$("#harga").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#harga").focus();
		return;
	}
	if($("#laminating").val()==''){
		$("#laminating").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#laminating").focus();
		return;
	}
	var formData = $("#formhargaprint").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_hargaprint",
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
			$("#Modalhargaprint").modal('hide');
			load_data(data.index,data.cari,data.page);
		}
	});
}

//Hapus Data
function deletehargaprint(id)
{
	clearModalhargaprint();
	cari(id,idindex);
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
			$("#btn-hargaprint").html("Hapus");
			$("#myModalLabel").html("Hapus Data");
			$("#id").val(data.id);
			$("#type").val("hapus");
			$("#index").val(data.index).attr("disabled","true");
			$("#kdmesin").val(data.kdmesin).attr("disabled","true");
			$("#jml_min").val(data.jml_min).attr("disabled","true");
			$("#jml_max").val(data.jml_max).attr("disabled","true");
			$("#harga").val(data.harga).attr("disabled","true");
			$("#laminating").val(data.laminating).attr("disabled","true");
			$("#Modalhargaprint").modal("show");
		}
	});
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearModalhargaprint()
{
	$("#removeWarning").hide();
	$(".hidex").show();
	$("#id").val("").removeAttr( "disabled" );
	$("#index").val("").removeAttr( "disabled" );
	$("#kdmesin").val("").removeAttr( "disabled" );
	$("#jml_min").val("").removeAttr( "disabled" );
	$("#jml_max").val("").removeAttr( "disabled" );
	$("#harga").val("").removeAttr( "disabled" );
	$("#laminating").val("").removeAttr( "disabled" );
	$("#type").val("");
}