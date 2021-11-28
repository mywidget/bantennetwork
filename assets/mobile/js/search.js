$( document ).ready(function() {
	searchAll();
});
$(".tab").click(function(){
	// e.preventDefault();
    // console.log(this.id);
}); 

$("#tab-0").click(function(){
	searchAll();
	$("#keywords").attr("placeholder", "Cari Semua berita");
}); 

$("#tab-1").click(function(){
	searchAll();
	$("#keywords").attr("placeholder", "News");
}); 

$("#tab-2").click(function(){
	searchAll();
	$("#keywords").attr("placeholder", "Program");
}); 

$("#tab-3").click(function(){
	searchAll();
	$("#keywords").attr("placeholder", "Artikel");
}); 

$("#tab-4").click(function(){
	searchAll();
	$("#keywords").attr("placeholder", "Video");
}); 

$(".cari").click(function(){
	searchAll();
	
}); 


function searchAll(page_num){
	$("div.spanner").addClass("show");
	$("div.overlay").addClass("show");
	page_num = page_num?page_num:0;
	var keywords = $('#keywords').val();
	// var sortBy = $("#"+a).val();
	var sortBy = $('input[name="tab-css"]:checked').val();

	// console.log(sortBy);
	$.ajax({
		type: 'POST',
		url: base_url+'search/ajaxSearch/'+page_num,
		data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
		beforeSend: function(){
			$('.loading').fadeIn("slow");
		},
		success: function(html){
			$('#postList-tab-'+sortBy).html(html);
			$('.loading').fadeOut("slow");
		}
	});
}