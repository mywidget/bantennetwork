function searchModul(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: base_url+'master/ajaxModul/'+page_num,
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        beforeSend: function () {
			$(".se-pre-con").fadeIn(300);　
		},
        success: function (html) {
			// console.log(page_num);
			$("#perpage").val(page_num);
            $('#posts_content').html(html);
            $(".se-pre-con").fadeOut(300);　
		}
	});
}

//Tampilkan Modal 
function showModalsp(id)
{
	clearModalsp();
	
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id)
	{
		$.ajax({
			type: "POST",
			url: base_url+"master/crud_modul",
			dataType: 'json',
			data: {id:id,type:"get"},
			beforeSend: function () {
				$(".se-pre-con").fadeIn(300);　
			},
			success: function(res) {
				$(".se-pre-con").fadeOut(300);　
				setModalDatap( res );
			}
		});
	}
	// Untuk Tambahkan Data
	else
	{
		$("#myModalmod").modal("show");
		$("#myModalLabel").html("Data Pembayaran");
		$("#type").val("new"); 
		// clearModalsp();
	}
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModalDatap( data )
{
	// console.log(data);
	$("#myModalLabel").html("EDIT Data");
	$("#type").val("edit");
	$("#id").val(data.id);
	$("#nama").val(data.nama);
	$("#tag").val(data.tag);
	$("#embed1").val(data.embed);
	$("#embed2").val(data.embed2);
	$("#pupup").val(data.classn);
	$("#pub").val(data.pub);
	$("#ket").text(data.ket);
	$("#cari").val($("#keywords").val());
	$("#myModalmod").modal("show");
	$('#warna').minicolors('value', data.warna);
}

function hideModal() {
	$("#myModalsd").removeClass("in");
	$(".modal-backdrop").hide();
	$('body').removeClass('modal-open');
	$('body').css('padding-right', '');
	$("#myModalsd").hide();
	$("#myModalsd").modal("hide");
}
//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submitModul()
{
	var nama = $("#nama").val();
	var tag = $("#tag").val();
	var embed1 = $("#embed1").val();
	var embed2 = $("#embed2").val();
	var pupup = $("#pupup").val();
	var warna = $("#warna").val();
	var pub = $("#pub").val();
	var ket = $("#ket").val();
	if(nama==''){
		$('.error_a').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
		}else if(tag==''){
		$('.error_b').html('Belum dipilih').delay(200).fadeIn().delay(3000).fadeOut();
		}else if(embed1==''){
		$('.error_c').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
		}else if(warna==''){
		$('.error_e').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
		}else{
		var formData = $("#formModul").serialize();
		$.ajax({
			type: "POST",
			url: base_url+"master/crud_modul",
			data: formData,
			dataType: 'json',
			beforeSend: function () {
				$(".se-pre-con").fadeIn(300);　
			},
			success: function(data) {
				$(".se-pre-con").fadeOut(300);　
				$('#keywords').val(data.cari);
				searchModul(data.perpage);
				$('#myModalmod').modal('hide');
			}
		});
	}
}
//Hapus Data
function deleteUserp(id)
{
	clearModalsp();
	$.ajax({
		type: "POST",
		url: "crud/modul/",
		dataType: 'json',
		data: {id:id,type:"get"},
		success: function(data) {
			// $(".hidex").hide();
			$("#removeWarning").show();
			$("#myModalLabel").html("Hapus Data");
			$("#id").val(data.id);
			$("#type").val("delete");
			$("#nama").val(data.nama).attr("disabled","true");
			$("#tag").val(data.tag).attr("disabled","true");
			$("#embed1").val(data.embed).attr("disabled","true");
			$("#embed2").val(data.embed2).attr("disabled","true");
			$("#pupup").val(data.classn).attr("disabled","true");
			$("#warna").val(data.warna).attr("disabled","true");
			$("#pub").val(data.pub).attr("disabled","true");
			$("#myModalmod").modal("show");
		}
	});
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearModalsp()
{
	$("#removeWarning").hide();
	$(".hidex").show();
	$("#id").val("").removeAttr( "disabled" );
	$("#nama").val("").removeAttr( "disabled" );
	$("#tag").val("").removeAttr( "disabled" );
	$("#embed1").val("").removeAttr( "disabled" );
	$("#embed2").val("").removeAttr( "disabled" );
	$("#pupup").val("").removeAttr( "disabled" );
	$("#warna").val("").removeAttr( "disabled" );
	$("#pub").val("").removeAttr( "disabled" );
	$("#type").val("");
}
