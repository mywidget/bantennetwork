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
	$.post(base_url+'akun/cari/'+view + current_query, {cats:cats,'index' : idindex,'search':search,'page-number' : page_number}, function(data){
		$('#all-bahan').html(data);
		}).done(function() {
		NProgress.start();
		}).always(function() {
		NProgress.done();
	});
});
load_data(idindex,search,nomor,cats);
function load_data(idindex,search,nomor,cats){
	var search = search?search:'';
	var nomor = nomor?nomor:1;
	$.post(base_url+'akun/cari/'+view, {cats:cats,'index' : idindex,'search':search,'page-number' : nomor},function(data){
		$('#all-bahan').html(data);
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
	var cats = $("#cats").val();
	$("#kat").val(cats);
});
$(document).on('submit', '#filter-form', function(e){
	e.preventDefault();
	
	var form = $(this);
	// console.log(form);
	$.post(base_url+'akun/cari/'+view, $(form).serialize(), function(data){
		$('#all-bahan').html(data);
	}).done(function() {
		NProgress.start();　
		}).always(function() {
		NProgress.done();
	});
})
//Tampilkan Modal 
function bahan(id)
{
	clearModalbahan();
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id){
		// console.log('edit');
		$("#btn-bahan").html("Update");
		var search = $('#search').val();
		$.ajax({
			type: "POST",
			url: base_url+"akun/crud",
			dataType: 'json',
			data: {cats:cats,view:view,id:id,index:idindex,type:"get"},
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
		$("#Modalbahan").modal("show");
		$("#myModalLabel").html("Form input bahan");
		$("#type").val("new"); 
		$("#btn-bahan").html("Simpan");
	}
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModalbahan( data )
{
	
	$("#myModalLabel").html("Edit Data");
	$("#id").val(data.kd_bhn);
	$("#type").val("edit");
	$("#Nm_Bhn").val(data.nm_bhn);
	$("#kategori").val(data.id_kategori);
	$("#Harga_Bahan").val(data.harga_bahan);
	$("#Tinggi").val(data.tinggi);
	$("#Lebar").val(data.lebar);
	$("#Tebal").val(data.tebal);
	$("#publish").val(data.publish);
	$("#Modalbahan").modal("show");
}
$("input").keyup(function(){
	$("input").removeClass("form-control-warning");
});
$("select").change(function(){
	$("select").removeClass("form-control-warning");
});
//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submitBahan()
{

	if($("#Nm_Bhn").val()==''){
		$("#Nm_Bhn").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#Nm_Bhn").focus();
		return;
	}
	if($("#kategori").val()==''){
		$("#kategori").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#kategori").focus() 
		return;
	}
	if($("#Harga_Bahan").val()==''){
		$("#Harga_Bahan").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#Harga_Bahan").focus() 
		return;
	}
	if($("#Tinggi").val()==''){
		$("#Tinggi").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#Tinggi").focus() 
		return;
	}
	if($("#Lebar").val()==''){
		$("#Lebar").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#Lebar").focus() 
		return;
	}
	if($("#Tebal").val()==''){
		$("#Tebal").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#Tebal").focus() 
		return;
	}
	if($("#publish").val()==''){
		$("#publish").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#publish").focus() 
		return;
	}
	
	var formData = $("#formbahan").serialize();
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_bahan",
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
			$("#Modalbahan").modal('hide');
			load_data(data.index,data.cari,data.page,data.cats);
			
		}
	});
}

//Hapus Data
function deletebahan(id)
{
	clearModalbahan();
	var search = $('#search').val();
	
	$.ajax({
		type: "POST",
		url: base_url+"akun/crud",
		dataType: 'json',
		data: {view:view,id:id,index:idindex,type:"get",cari:search,cats:cats,csfrData},
		beforeSend: function () {
			NProgress.start();
		},
		success: function(data) {
			NProgress.done();
			// $(".hidex").hide();
			$("#removeWarning").show();
			$("#btn-bahan").html("Hapus");
			$("#myModalLabel").html("Hapus Data");
			$("#id").val(data.kd_bhn);
			$("#type").val("hapus");
			$("#Nm_Bhn").val(data.nm_bhn).attr("disabled","true");
			$("#kategori").val(data.id_kategori).attr("disabled","true");
			$("#Harga_Bahan").val(data.harga_bahan).attr("disabled","true");
			$("#Tinggi").val(data.tinggi).attr("disabled","true");
			$("#Lebar").val(data.lebar).attr("disabled","true");
			$("#Tebal").val(data.tebal).attr("disabled","true");
			$("#publish").val(data.publish).attr("disabled","true");
			$("#Modalbahan").modal("show");
		}
	});
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearModalbahan()
{
	$("#removeWarning").hide();
	$(".hidex").show();
	$("#id").val("").removeAttr( "disabled" );
	$("#Nm_Bhn").val("").removeAttr( "disabled" );
	$("#kategori").val("").removeAttr( "disabled" );
	$("#Harga_Bahan").val("").removeAttr( "disabled" );
	$("#Tinggi").val("").removeAttr( "disabled" );
	$("#Lebar").val("").removeAttr( "disabled" );
	$("#Tebal").val("").removeAttr( "disabled" );
	$("#publish").val("").removeAttr( "disabled" );
	$("#type").val("");
	NProgress.remove();
}
