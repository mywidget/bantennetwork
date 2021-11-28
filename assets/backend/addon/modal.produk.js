//Tampilkan Modal 
function produk(id)
{
	if(id)
	{
		$.ajax({
			type: "POST",
			url: base_url+"crud_data/get_produk/",
			data: {id:id,type:"get"},
			beforeSend: function () {
				$(".se-pre-con").fadeIn();　
			},
			success: function(res) {
				// console.log(res);
				$("#myModalProduk").modal("show");
				$(".se-pre-con").fadeOut(300);　
				$(".load-produk").html(res);　
			}
		});
	}
}

//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
function submitProduk()
{
	
	
	var formData = $("#formUserd").serialize();
	// console.log(formData);
	$.ajax({
		type: "POST",
		url: base_url+"crud_data/simpan_produk/",
		dataType: 'json',
		data: formData,
		beforeSend: function () {
			// $(".se-pre-con").fadeIn(300);　
		},
		success: function(data) {
			$(".se-pre-con").fadeOut('slow');　
			if(data.status==200){
				showToastPosition('bottom-right',data.title,data.msg,data.kelas);
				}else{
				showToastPosition('bottom-right',data.title,data.msg,data.kelas);
			}
			$("#main-produk").load(location.href + " .sortable");
			$("i").removeClass("ik-move");
			$("#myModalProduk").modal("hide");
		}
	});
	
}