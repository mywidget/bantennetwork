!(function($) {
	"use strict";
	
	$('form.php-email-form').submit(function(e) {
		// console.log('aaa');
		e.preventDefault();
		
		var f = $(this).find('.form-group'),
		ferror = false,
		emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;
		
		f.children('input').each(function() { // run all inputs
			
			var i = $(this); // current input
			var rule = i.attr('data-rule');
			
			if (rule !== undefined) {
				var ierror = false; // error flag for current input
				var pos = rule.indexOf(':', 0);
				if (pos >= 0) {
					var exp = rule.substr(pos + 1, rule.length);
					rule = rule.substr(0, pos);
					} else {
					rule = rule.substr(pos + 1, rule.length);
				}
				
				switch (rule) {
					case 'required':
					if (i.val() === '') {
						ferror = ierror = true;
					}
					break;
					
					case 'minlen':
					if (i.val().length < parseInt(exp)) {
						ferror = ierror = true;
					}
					break;
					
					case 'email':
					if (!emailExp.test(i.val())) {
						ferror = ierror = true;
					}
					break;
					
					case 'checked':
					if (! i.is(':checked')) {
						ferror = ierror = true;
					}
					break;
					
					case 'regexp':
					exp = new RegExp(exp);
					if (!exp.test(i.val())) {
						ferror = ierror = true;
					}
					break;
				}
				i.next('.form-control').html(ierror ? (i.addClass('form-control-warning') !== undefined ? i.addClass('form-control-warning') : '') : (i.removeClass('form-control-warning').addClass('form-control-success')));
				
				i.next('.form-control').html(
					ierror ? (i.change(function(){i.removeClass('form-control-warning').addClass('form-control-success')}) !== undefined ? i.change(function(){i.removeClass('form-control-warning').addClass('form-control-success')}) : '') : ""
				);
				// change(function(){removeClass('form-control-warning').addClass('form-control-success')})
			}
		});
		f.children('textarea').each(function() { // run all inputs
			
			var i = $(this); // current input
			var rule = i.attr('data-rule');
			
			if (rule !== undefined) {
				var ierror = false; // error flag for current input
				var pos = rule.indexOf(':', 0);
				if (pos >= 0) {
					var exp = rule.substr(pos + 1, rule.length);
					rule = rule.substr(0, pos);
					} else {
					rule = rule.substr(pos + 1, rule.length);
				}
				
				switch (rule) {
					case 'required':
					if (i.val() === '') {
						ferror = ierror = true;
					}
					break;
					
					case 'minlen':
					if (i.val().length < parseInt(exp)) {
						ferror = ierror = true;
					}
					break;
				}
				i.next('.form-control').html(ierror ? (i.addClass('form-control-warning') !== undefined ? i.addClass('form-control-warning') : '') : (i.removeClass('form-control-warning').addClass('form-control-success')));
				
				i.next('.form-control').html(
					ierror ? (i.change(function(){i.removeClass('form-control-warning').addClass('form-control-success')}) !== undefined ? i.change(function(){i.removeClass('form-control-warning').addClass('form-control-success')}) : '') : ""
				);
			}
		});
		if (ferror) return false;
		
		var thisform = new FormData(this);
		var this_form = $(this);
		var action = $(this).attr('action');
		
		if( ! action ) {
			this_form.find('.error-message').slideDown().html('The form action property is not set!');
			return false;
		}
		
		this_form.find('.error-message').slideUp();
		
		if ( $(this).data('recaptcha-site-key') ) {
			var recaptcha_site_key = $(this).data('recaptcha-site-key');
			grecaptcha.ready(function() {
				grecaptcha.execute(recaptcha_site_key, {action: 'php_email_form_submit'}).then(function(token) {
					php_email_form_submit(this_form,action,thisform + '&recaptcha-response=' + token);
				});
			});
			} else {
			php_email_form_submit(this_form,action,thisform);
		}
		
		return true;
	});
	
	function php_email_form_submit(this_form, action, data) {
		$.ajax({
			type: "POST",
			url: action,
			data: data,
			contentType: false,
			cache: false,
			processData:false,
			dataType: 'json',
			beforeSend: function () {
				$('.se-pre-con').fadeIn();
			},
			timeout: 40000
			}).done( function(res){
			console.log(res);
			if (res.status == 200) {
				// this_form.find("input:not(input[type=submit]), textarea").val('');
				$('#ModalBiaya').modal('hide');
				$('.se-pre-con').fadeOut('slow');
				load_data(res.index,res.cari,res.page);
				} else {
				if(!res) {
					msg = 'Form submission failed and no error message returned from: ' + action + '<br>';
				}
				this_form.find('.error-message').slideDown().html(msg);
			}
			}).fail( function(data){
			console.log(data);
			var error_msg = "Form submission failed!<br>";
			if(data.statusText || data.status) {
				error_msg += 'Status:';
				if(data.statusText) {
					error_msg += ' ' + data.statusText;
				}
				if(data.status) {
					error_msg += ' ' + data.status;
				}
				error_msg += '<br>';
			}
			if(data.responseText) {
				error_msg += data.responseText;
			}
			this_form.find('.error-message').slideDown().html(error_msg);
		});
	}
	
})(jQuery);

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
		$('#all-biaya').html(data);
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
		$('#all-biaya').html(data);
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
		$('#all-biaya').html(data);
		}).done(function() {
		NProgress.start();
		}).always(function() {
		NProgress.done();
	});
	
	
})
//Tampilkan Modal 
function biaya(id)
{
	clearModalBiaya();
	
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id){
		// console.log('edit');
		$("#btn-biaya").html("Update");
		var search = $('#search').val();
		$.ajax({
			type: "POST",
			url: base_url+"akun/crud",
			dataType: 'json',
			data: {view:view,id:id,index:idindex,type:"get"},
			beforeSend: function () {
				$('.se-pre-con').fadeIn();
			},
			success: function(res) {
				$('.se-pre-con').fadeOut("slow");
				$('#cari').val(search);
				setModalBiaya( res );
			}
		});
		}else{
		// console.log('new');
		$("#ModalBiaya").modal("show");
		$("#myModalLabel").html("Biaya");
		$("#type").val("new"); 
		$("#btn-biaya").html("Simpan");
		$('#publish1')[0].checked = true;
	}
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModalBiaya( data )
{
	
	$("#myModalLabel").html("Edit Data");
	$("#id").val(data.id);
	$("#type").val("edit");
	$("#nama_biaya").val(data.nama_biaya);
	$("#jumlahmin").val(data.jumlahmin);
	$("#hargamin").val(data.hargamin);
	$("#hargalebih").val(data.hargalebih);
	$("#groups").val(data.groups);
	$("#panjang").val(data.panjang);
	$("#lebar").val(data.lebar);
	if(data.pub=="Y"){
		$('#publish1')[0].checked = true;             
		$('#publish2')[0].checked = false;             
		}else if(data.pub=="N"){
		$('#publish1')[0].checked = false;             
		$('#publish2')[0].checked = true;
	}
	
	$("#ModalBiaya").modal("show");
	
}

// //Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
// function submitBiaya()
// {
// if($("#nama_biaya").val()==''){
// $("#nama_biaya").addClass('form-control-warning');
// showNotif('top-center','Input Data','Harus diisi','warning');
// $("#nama_biaya").focus();
// return;
// }
// var formData = $("#formBiaya").serialize();
// $.ajax({
// type: "POST",
// url: base_url+"crud_data/simpan_biaya",
// dataType: 'json',
// data: formData,
// beforeSend: function () {
// $(".se-pre-con").fadeIn(300);　
// },
// success: function(data) {
// $(".se-pre-con").fadeOut(300);　
// NProgress.done();
// if(data.status==200){
// showNotif('bottom-right',data.title,data.msg,'success');
// }else{
// showNotif('bottom-right',data.title,data.msg,'error');
// }
// $("#ModalBiaya").modal('hide');
// load_data(data.index,data.cari,data.page);
// }
// });
// }

//Hapus Data
function deleteBiaya(id)
{
	clearModalBiaya();
	var search = $('#search').val();
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
			// $(".hidex").hide();
			$("#removeWarning").show();
			$("#btn-biaya").html("Hapus");
			$("#myModalLabel").html("Hapus Data");
			$("#id").val(data.id);
			$("#type").val("hapus");
			$("#nama_biaya").val(data.nama_biaya).attr("disabled","true");
			$("#jumlahmin").val(data.jumlahmin).attr("disabled","true");
			$("#hargamin").val(data.hargamin).attr("disabled","true");
			$("#hargalebih").val(data.hargalebih).attr("disabled","true");
			$("#groups").val(data.groups).attr("disabled","true");
			$("#panjang").val(data.panjang).attr("disabled","true");
			$("#lebar").val(data.lebar).attr("disabled","true");
			$("#publish").val(data.pub).attr("disabled","true");
			$("#ModalBiaya").modal("show");
			if(data.pub=="Y"){
				$('#publish1')[0].checked = true;             
				$('#publish2')[0].checked = false;             
				}else if(data.pub=="N"){
				$('#publish1')[0].checked = false;             
				$('#publish2')[0].checked = true;
			}
			$('input[name=publish]').attr("disabled",true);
			$('.radio').addClass('radio-disable');
		}
	});
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearModalBiaya()
{
	$("#removeWarning").hide();
	$(".hidex").show();
	$("#id").val("").removeAttr( "disabled" );
	$("#nama_biaya").val("").removeAttr( "disabled" );
	$("#jumlahmin").val("").removeAttr( "disabled" );
	$("#hargamin").val("").removeAttr( "disabled" );
	$("#hargalebih").val("").removeAttr( "disabled" );
	$("#groups").val("").removeAttr( "disabled" );
	$("#panjang").val("").removeAttr( "disabled" );
	$("#lebar").val("").removeAttr( "disabled" );
	$("#publish").val("").removeAttr( "disabled" );
	$("#type").val("");
	$('input').removeClass('form-control-warning');
	$('.radio').removeClass('radio-disable');
	$('input[name=publish]').attr("disabled",false);
}
