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
	var perpage = $('#per-page').val();
	$('#nomor').val(page_number);
	$.post(base_url+'akun/cari/'+view+'/' + current_query, {'index' : idindex,'per-page':perpage,'page-number' : page_number,csfrData}, function(data){
		$('#all-katbahan').html(data);
		}).done(function() {
		NProgress.start();　
		}).always(function() {
		NProgress.done();
	});
})
load_data(idindex,search,nomor);
function load_data(idindex,search,nomor){
	var search = $('#search').val();
	var nomor = nomor?nomor:1;
	var cats = $('#cats').val();
	var perpage = $('#per-page').val();
	
	$.post(base_url+'akun/cari/'+view+'/', {'index' : idindex,'per-page':perpage,'cats':cats,'search':search,'page-number' : nomor,csfrData},function(data){
		$('#all-katbahan').html(data);
		}).done(function() {
		NProgress.start();　
		}).always(function() {
		NProgress.done();
	});
}
function load_klik(){
	$('#cats').val(null).trigger("change")
	$('#search').val('');
	$('#nomor').val('');
	$('#filter-form').submit();
}
$(document).on('change', '#cats', function(e){
	e.preventDefault();
	// console.log(1);
	$('#filter-form').submit();
});
$(document).on('submit', '#filter-form', function(e){
	e.preventDefault();
	
	var form = $(this);
	// console.log(form);
	$.post(base_url+'akun/cari/'+view+'/', $(form).serialize(), function(data){
		$('#all-katbahan').html(data);
		}).done(function() {
		NProgress.start();　
		}).always(function() {
		NProgress.done();
	});
});
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
function katbahan(id)
{
	clearModalbahan();
	if(id){
		cari(id,idindex);
		var search = $('#search').val();
		$.ajax({
			type: "POST",
			url: base_url+"akun/crud",
			dataType: 'json',
			data: {view:view,id:id,index:idindex,type:"get",csfrData},
			beforeSend: function () {
				$('.se-pre-con').show();
			},
			success: function(res) {
				$('#cari').val(search);
				$('.se-pre-con').fadeOut("slow");
				setModalbahan( res );
			}
		});
		}else{
		cari();
		// cari_add();
		$("#Modalkatbahan").modal("show");
		$("#myModalLabel").html("Add Data");
		$("#type").val("new"); 
		$("#btn-katbahan").html("Simpan");
	}
}


function setModalbahan( data )
{
	$("#btn-katbahan").html("Update");
	$("#myModalLabel").html("Edit Data");
	$("#id").val(data.idcat);
	$("#nama_kategori").val(data.nama);
	$("#jenis").val(data.jenis);
	$("#print_a3").val(data.hrg_a3);
	$("#publish").val(data.publish);
	$("#type").val("edit");
	$("#Modalkatbahan").modal("show");
}
$("input").keyup(function(){
	$("input").removeClass("form-control-warning");
});
$("select").change(function(){
	$("select").removeClass("form-control-warning");
});
//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submitkatbahan()
{
	
	
	if($("#nama_kategori").val()==''){
		$("#nama_kategori").addClass('form-control-warning');
		showNotif('top-center','Input Data','Nama Harus diisi','warning');
		$("#nama_kategori").focus();
		return;
	}
	if($("#jenis").val()==''){
		$("#jenis").addClass('form-control-warning');
		showNotif('top-center','Input Data','Jenis belum dipilih','warning');
		$("#jenis").focus() 
		return;
	}
	if($("#print_a3").val()==''){
		$("#print_a3").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harga Harus diisi','warning');
		$("#print_a3").focus() 
		return;
	}
	if($("#chosen-tags").val()==''){
		$("#chosen-tags").addClass('form-control-warning');
		showNotif('top-center','Input Data','Modul Harus diisi','warning');
		$('#chosen-tags').selectize()[0].selectize.focus();
		return;
	}
	if(!$('#publish').val() ){
		$("#publish").addClass('form-control-warning');
		showNotif('top-center','Input Data','Aktif Harus dipilih','warning');
		$("#publish").focus();
		return;
	}
	var formData = $("#formkatbahan").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_katbahan",
		dataType: 'json',
		data: formData,
		beforeSend: function () {
			$('.se-pre-con').fadeIn();
		},
		success: function(data) {
			if(data.status==200){
				showNotif('bottom-right',data.title,data.msg,'success');
				}else{
				showNotif('bottom-right',data.title,data.msg,'error');
			}
			$("#Modalkatbahan").modal("hide");
			load_data(data.index,data.cari,data.page);
			$('.se-pre-con').fadeOut('slow');
		}
	});
}


//Hapus Data
function deletekatbahan(id)
{
	clearModalbahan();
	var search = $('#search').val();
	var num = $('#nomor').val();
	cari(id,idindex);
	$.ajax({
		type: "POST",
		url: base_url+"akun/crud",
		data: {view:view,id:id,index:idindex,type:"get",cari:search,nomor:num,csfrData},
		dataType: 'json',
		beforeSend: function () {
			$('.se-pre-con').fadeIn();
		},
		success: function(data) {
			$("#removeWarning").show();
			$("#btn-katbahan").html("Hapus");
			$("#myModalLabel").html("Hapus Data");
			$("#Modalkatbahan").modal("show");
			$("#id").val(data.idcat);
			$("#id_index").val(data.index);
			$("#nama_kategori").val(data.nama).attr("disabled","true");
			$("#jenis").val(data.jenis).attr("disabled","true");
			$("#print_a3").val(data.hrg_a3).attr("disabled","true");
			$("#publish").val(data.publish).attr("disabled","true");
			$("#type").val("hapus");
			$("#Modalkatbahan").modal("show");
			$('#chosen-tags').selectize()[0].selectize.disable();
			$('.se-pre-con').fadeOut('slow');
		}
	});
}

function clearModalbahan()
{
	$("#removeWarning").hide();
	$("#id").val("").removeAttr( "disabled" );
	$("#nama_kategori").val("").removeAttr( "disabled" );
	$("#jenis").val("").removeAttr( "disabled" );
	$("#print_a3").val("").removeAttr( "disabled" );
	$("#publish").val("").removeAttr( "disabled" );
	$("#type").val("");
	$('#chosen-tags').selectize()[0].selectize.enable();
}