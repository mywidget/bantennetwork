	function searchFilter(page_num) {
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		$.ajax({
			type: 'POST',
			url: base_url+'layanan/ajaxPembelian/',
			data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
			beforeSend: function () {
				$('.loadingcrud').show();
			},
			success: function (html) {
				$('#posts_content').html(html);
				$('.loadingcrud').fadeOut("slow");
			}
		});
	}
	$(document).on('shown.bs.modal', function(e) {
		$('[autofocus]', e.target).focus();
	});
			
		    //Tampilkan Modal 
			function pembelian(id)
			{
				clearModalsp();
				
				// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
				if(id)
				{
					$.ajax({
						type: "POST",
						url: base_url+"layanan/pembelian_get",
						dataType: 'json',
						data: {id:id,type:"get"},
						beforeSend: function () {
           				$('.loader').show();
        				},
						success: function(res) {
							 $('.loader').fadeOut("slow");
							setModalDatap( res );
						}
					});
				}
				// Untuk Tambahkan Data
				else
				{
					$("#myModalPembelian").modal("show");
					$("#myModalLabel").html("Data Pembayaran");
					$("#type").val("new"); 
				}
			}
			
			//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
			function setModalDatap( data )
			{
				
				$("#myModalLabel").html("EDIT Data");
				$("#id").val(data.id);
				$("#type").val("edit");
				$("#mail").val(data.mail);
				$("#paket").val(data.paket);
				$("#reg").val(data.reg);
				$("#exp").val(data.exp);
				$("#hargap").val(data.harga);
				$("#status").val(data.status);
				$("#durasi").val(data.bulan);
				$("#iduser").val(data.iduser);
				$("#myModalPembelian").modal("show");
				
			}
			
			//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
			function submitPembelian()
			{
			var mail = $("#mail").val();
			var paket = $("#paket").val();
			var reg = $("#reg").val();
			var exp = $("#exp").val();
			var harga = $("#hargap").val();
			var lunas = $("#lunas").val();
			var pub = $("#status").val();
			var bulan = $("#durasi").val();
			if(mail==''){
			$('.errore').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
			}else if(paket==''){
			$('.errorp').html('Belum dipilih').delay(200).fadeIn().delay(3000).fadeOut();
			}else if(reg==''){
			$('.errorreg').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
			}else if(exp==''){
			$('.errorexp').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
			}else if(harga==''){
			$('.errorh').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
			}else if(lunas==''){
			$('.errorlunas').html('Belum dipilih').delay(200).fadeIn().delay(3000).fadeOut();
			}else if(pub==''){
			$('.errorpub').html('Belum dipilih').delay(200).fadeIn().delay(3000).fadeOut();
			}else if(bulan==''){
			$('.errordurasi').html('Belum dipilih').delay(200).fadeIn().delay(3000).fadeOut();
			}else{
				var formData = $("#formUserp").serialize();
				$.ajax({
					type: "POST",
					url: base_url+"layanan/simpan_pembelian",
					dataType: 'json',
					data: formData,
					success: function(data) {
					// if(data.status==200){
					// console.log(data.status);
					// }else{
					// }
						searchFilter();
						$('#myModalPembelian').modal('hide');
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
					url: "page/beli/crud.php",
					dataType: 'json',
					data: {id:id,type:"get"},
					success: function(data) {
						// $(".hidex").hide();
						$("#removeWarning").show();
						$("#myModalLabel").html("Hapus Data");
						$("#id").val(data.id);
						$("#type").val("delete");
						$("#mail").val(data.mail).attr("disabled","true");
						$("#paket").val(data.paket).attr("disabled","true");
						$("#reg").val(data.reg).attr("disabled","true");
						$("#exp").val(data.exp).attr("disabled","true");
						$("#hargap").val(data.harga).attr("disabled","true");
						$("#status").val(data.status).attr("disabled","true");
						$("#durasi").val(data.bulan).attr("disabled","true");
						$("#iduser").val(data.iduser).attr("disabled","true");
						$("#myModalPembelian").modal("show");
					}
				});
			}
			
			//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
			function clearModalsp()
			{
				$("#removeWarning").hide();
				$(".hidex").show();
				$("#id").val("").removeAttr( "disabled" );
				$("#mail").val("").removeAttr( "disabled" );
				$("#paket").val("").removeAttr( "disabled" );
				$("#reg").val("").removeAttr( "disabled" );
				$("#exp").val("").removeAttr( "disabled" );
				$("#hargap").val("").removeAttr( "disabled" );
				$("#status").val("").removeAttr( "disabled" );
				$("#durasi").val("").removeAttr( "disabled" );
				$("#iduser").val("").removeAttr( "disabled" );
				$("#type").val("");
			}
