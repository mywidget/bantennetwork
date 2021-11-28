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
	$.post(base_url+'akun/cari/'+view+'/' + current_query, {'index' : idindex,'search':search,'page-number' : page_number,csfrData}, function(data){
		$('#all-mesin').html(data);
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
		$('#all-mesin').html(data);
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
	$.post(base_url+'akun/cari/'+view+'/', $(form).serialize(), function(data){
		$('#all-mesin').html(data);
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
function mesin(id)
{
	clearModalmesin();
	// console.log(csfrData);
	if(id){
		cari(id,idindex);
		$("#btn-mesin").html("Update");
		var search = $('#search').val();
		$.ajax({
			type: "POST",
			url: base_url+"akun/crud",
			dataType: 'json',
			data: {view:'mesin',id:id,index:idindex,type:"get",cari:search,csfrData},
			beforeSend: function () {
				$('.se-pre-con').fadeIn();
			},
			success: function(res) {
				$('.se-pre-con').fadeOut('slow');
				setModalmesin( res );
			}
		});
		}else{
		cari();
		$("#Modalmesin").modal("show");
		$("#myModalLabel").html("Add Data");
		$("#type").val("new"); 
		$("#btn-mesin").html("Simpan");
	}
}

function setModalmesin( data )
{
	$("#myModalLabel").html("Edit Data");
	$("#type").val("edit");
	$("#kdmesin").val(data.kdmesin);
	$("#nama_mesin").val(data.namamesin);
	$("#jumlah_min").val(data.jumlah_min);
	$("#harga_min").val(data.harga_min);
	$("#harga_lebih").val(data.harga_lebih);
	$("#plat_sama").val(data.plat_sama);
	$("#harga_ctp").val(data.harga_ctp);
	$("#min_bw").val(data.min_bw);
	$("#lebih_bw").val(data.lebih_bw);
	$("#min_khusus").val(data.min_khusus);
	$("#lebih_khusus").val(data.lebih_khusus);
	$("#aktif").val(data.aktif);
	$("#panjang").val(data.panjang);
	$("#lebar").val(data.lebar);
	$("#min_panjang").val(data.min_panjang);
	$("#min_lebar").val(data.min_lebar);
	$("#panjangc").val(data.panjangc);
	$("#lebarc").val(data.lebarc);
	$("#replat").val(data.replat);
	$("#jenis_mesin").val(data.jenis_mesin);
	$("#tarikan").val(data.tarikan);
	$("#Modalmesin").modal("show");
}
$("input").keyup(function(){
	$("input").removeClass("form-control-warning");
});
$("select").change(function(){
	$("select").removeClass("form-control-warning");
});
//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submitmesin()
{
	
	if($("#nama_mesin").val()==''){
		$("#nama_mesin").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#nama_mesin").focus() 
		return;
	}
	if($("#jumlah_min").val()==''){
		$("#jumlah_min").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#jumlah_min").focus() 
		return;
	}
	if($("#harga_min").val()==''){
		$("#harga_min").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#harga_min").focus() 
		return;
	}
	if($("#harga_lebih").val()==''){
		$("#harga_lebih").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#harga_lebih").focus() 
		return;
	}
	if($("#plat_sama").val()==''){
		$("#plat_sama").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#plat_sama").focus() 
		return;
	}
	if($("#harga_ctp").val()==''){
		$("#harga_ctp").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#harga_ctp").focus() 
		return;
	}	
	if($("#min_bw").val()==''){
		$("#min_bw").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#min_bw").focus() 
		return;
	}	
	
	if($("#lebih_bw").val()==''){
		$("#lebih_bw").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#lebih_bw").focus() 
		return;
	}	
	if($("#min_khusus").val()==''){
		$("#min_khusus").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#min_khusus").focus() 
		return;
	}	
	if($("#lebih_khusus").val()==''){
		$("#lebih_khusus").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#lebih_khusus").focus() 
		return;
	}
	if($('#aktif').val()=="") { 
		$("#aktif").addClass('form-control-warning');
		showNotif('top-center','Input Data','Aktif Harus dipilih','warning');
		$("#aktif").focus();
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
	if($("#min_panjang").val()==''){
		$("#min_panjang").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#min_panjang").focus() 
		return;
	}	
	
	if($("#min_lebar").val()==''){
		$("#min_lebar").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#min_lebar").focus() 
		return;
	}
	if($("#panjangc").val()==''){
		$("#panjangc").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#panjangc").focus() 
		return;
	}
	if($("#lebarc").val()==''){
		$("#lebarc").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#lebarc").focus() 
		return;
	}
	if($("#tarikan").val()==''){
		$("#tarikan").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#tarikan").focus() 
		return;
	}
	if($("#replat").val()==''){
		$("#replat").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#replat").focus() 
		return;
	}
	if($("#jenis_mesin").val()==''){
		$("#jenis_mesin").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#jenis_mesin").focus() 
		return;
	}
	if($("#chosen-tags").val()==''){
		$("#chosen-tags").addClass('form-control-warning');
		showNotif('top-center','Input Data','Modul Harus diisi','warning');
		$('#chosen-tags').selectize()[0].selectize.focus();
		return;
	}
	var formData = $("#formmesin").serialize();
	// console.log(formData);
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_mesin",
		data: formData,
		dataType: 'json',
		beforeSend: function () {
			$('.se-pre-con').fadeIn();
		},
		success: function(data) {
			// console.log(100);
			if(data.status==200){
				showNotif('bottom-right',data.title,data.msg,'success');
				}else{
				showNotif('bottom-right',data.title,data.msg,'error');
			}
			load_data(data.index,data.cari,data.page);
			// hideModal();
			$("#Modalmesin").modal('hide');
			$('.se-pre-con').fadeOut('slow');
			load_data(data.index,data.cari,data.page);
		}
	});
}
//Hapus Data
function deletemesin(id)
{
	clearModalmesin()
	var search = $('#search').val();
	cari(id,idindex);
	$.ajax({
		type: "POST",
		url: base_url+"akun/crud",
		dataType: 'json',
		data: {view:view,id:id,index:idindex,type:"get",cari:search,csfrData},
		beforeSend: function () {
			$('.se-pre-con').fadeIn();
		},
		success: function(data) {
			$('.se-pre-con').fadeOut('slow');
			$("#removeWarning").show();
			$("#btn-mesin").html("Hapus");
			$("#myModalLabel").html("Hapus Data");
			$("#Modalmesin").modal("show");
			//
			$("#type").val("hapus");
			$("#kdmesin").val(data.kdmesin).attr("readonly","true");
			$("#nama_mesin").val(data.namamesin).attr("disabled","true");
			$("#jumlah_min").val(data.jumlah_min).attr("disabled","true");
			$("#harga_min").val(data.harga_min).attr("disabled","true");
			$("#harga_lebih").val(data.harga_lebih).attr("disabled","true");
			$("#plat_sama").val(data.plat_sama).attr("disabled","true");
			$("#harga_ctp").val(data.harga_ctp).attr("disabled","true");
			$("#min_bw").val(data.min_bw).attr("disabled","true");
			$("#lebih_bw").val(data.lebih_bw).attr("disabled","true");
			$("#min_khusus").val(data.min_khusus).attr("disabled","true");
			$("#lebih_khusus").val(data.lebih_khusus).attr("disabled","true");
			$("#aktif").val(data.aktif).attr("disabled","true");
			$("#panjang").val(data.panjang).attr("disabled","true");
			$("#lebar").val(data.lebar).attr("disabled","true");
			$("#min_panjang").val(data.min_panjang).attr("disabled","true");
			$("#min_lebar").val(data.min_lebar).attr("disabled","true");
			$("#panjangc").val(data.panjangc).attr("disabled","true");
			$("#lebarc").val(data.lebarc).attr("disabled","true");
			$("#replat").val(data.replat).attr("disabled","true");
			$("#jenis_mesin").val(data.jenis_mesin).attr("disabled","true");
			$("#tarikan").val(data.tarikan).attr("disabled","true");
			$('#chosen-tags').selectize()[0].selectize.disable();
		}
	});
}
function clearModalmesin()
{
	$("#removeWarning").hide();
	$("#type").val("");
	$("#kdmesin").val("").removeAttr( "disabled" );
	$("#nama_mesin").val("").removeAttr( "disabled" );
	$("#jumlah_min").val("").removeAttr( "disabled" );
	$("#harga_min").val("").removeAttr( "disabled" );
	$("#harga_lebih").val("").removeAttr( "disabled" );
	$("#plat_sama").val("").removeAttr( "disabled" );
	$("#harga_ctp").val("").removeAttr( "disabled" );
	//readonly
	$("#min_bw").val("0");
	$("#lebih_bw").val("0");
	$("#min_khusus").val("0");
	$("#lebih_khusus").val("0");
	//
	$("#aktif").val("").removeAttr( "disabled" );
	$("#panjang").val("").removeAttr( "disabled" );
	$("#lebar").val("").removeAttr( "disabled" );
	$("#min_panjang").val("").removeAttr( "disabled" );
	$("#min_lebar").val("").removeAttr( "disabled" );
	$("#panjangc").val("").removeAttr( "disabled" );
	$("#lebarc").val("").removeAttr( "disabled" );
	$("#replat").val("").removeAttr( "disabled" );
	$("#jenis_mesin").val("").removeAttr( "disabled" );
	$("#tarikan").val("").removeAttr( "disabled" );
	$('#chosen-tags').selectize()[0].selectize.enable();
	
}
$(document).ready(function() {
    var inputWdithReturn = '0';
    
    $('.input').focus(function(){
        inputWdith='60px';
        $(this).animate({
            width: inputWdith
        }, 400 )
        
    });
    $('.input').blur(function(){
        $(this).animate({
            width: inputWdithReturn
        }, 500 )
        
    });
});