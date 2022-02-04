<main class="container">
	<header>
		<h4>Pencarian Berita</h4>
		<div class="input-group">
			<input type="search" name="search" id="keywords" placeholder="Cari semua berita" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-danger cari" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true">
				</span></button>
			</span>
		</div>
	</header>
	<div class="postList">
		
		<div id="wrapper">
			<div class="tabs">
				
				<input hidden type="radio" name="tab-css" class="tab" value="0" id="tab-0" checked />
				<label class="tab-control" for="tab-0">Semua</label>
				<input hidden type="radio" name="tab-css" class="tab" value="1" id="tab-1" />
				<label class="tab-control" for="tab-1">News</label>
				<input hidden type="radio" name="tab-css" class="tab" value="3" id="tab-2" />
				<label class="tab-control" for="tab-2">Program</label>
				<input hidden type="radio" name="tab-css" class="tab" value="8" id="tab-3" />
				<label class="tab-control" for="tab-3">Artikel</label>
				<input hidden type="radio" name="tab-css" class="tab" value="2" id="tab-4" />
				<label class="tab-control" for="tab-4">Video</label>
				
				<div class="tab-content">
					<div id="tab-panel-0" class="tab-panel">
						<main class="" id="berita-terkini">
							<div id="postList-tab-0"></div>
						</main>
					</div>
					<div id="tab-panel-1" class="tab-panel">
						<main class="" id="berita-terkini">
							<div id="postList-tab-1"></div>
						</main>
					</div>
					<div id="tab-panel-2" class="tab-panel">
						<main class="" id="berita-terkini">
							<div id="postList-tab-3"></div>
						</main>
					</div>
					<div id="tab-panel-3" class="tab-panel">
						<main class="" id="berita-terkini">
							<div id="postList-tab-8"></div>
						</main>
					</div>
					<div id="tab-panel-4" class="tab-panel">
						<main class="" id="berita-terkini">
							<div id="postList-tab-2"></div>
						</main>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="loading">Loading&#8230;</div>
</main>
<script>
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
</script>
<style>
	@import url("https://fonts.googleapis.com/css2?family=Overpass:wght@300;600&display=swap");
	* {
	margin: 0;
	padding: 0;
	}
	
	
	
	
	#wrapper {
	display: flex;
	align-items: center;
	height: auto;
	max-width: 45rem;
	margin: 0 auto;
}

.tabs {
width: 100%;
background-color: white;
border-radius: 0.5rem;
}

.tab-control {
display: inline-block;
border-bottom: 2px solid transparent;
font-size: 1.25rem;
padding: 0.6rem 1rem;
cursor: pointer;
transition: all 0.25s ease;
}

.tab-control:hover {
color: #ed1e79;
}

.tab-content {
border-top: 1px solid #ed1e79;
padding: 1rem;
}

.tab-panel {
display: none;
}

/* Magic style */
input[type=radio]:checked + .tab-control {
font-weight: 600;
color: #ed1e79;
border-bottom-color: #ed1e79;
}

#tab-0:checked ~ .tab-content > #tab-panel-0 {
display: block;
}

#tab-1:checked ~ .tab-content > #tab-panel-1 {
display: block;
}

#tab-2:checked ~ .tab-content > #tab-panel-2 {
display: block;
}

#tab-3:checked ~ .tab-content > #tab-panel-3 {
display: block;
}
#tab-4:checked ~ .tab-content > #tab-panel-4 {
display: block;
}

.loading {
position: fixed;
z-index: 999;
height: 2em;
width: 2em;
overflow: visible;
margin: auto;
top: 0;
left: 0;
bottom: 0;
right: 0;
}

/* Transparent Overlay */
.loading:before {
content: '';
display: block;
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
/* hide "loading..." text */
font: 0/0 a;
color: transparent;
text-shadow: none;
background-color: transparent;
border: 0;
}

.loading:not(:required):after {
content: '';
display: block;
font-size: 10px;
width: 1em;
height: 1em;
margin-top: -0.5em;
-webkit-animation: spinner 1500ms infinite linear;
-moz-animation: spinner 1500ms infinite linear;
-ms-animation: spinner 1500ms infinite linear;
-o-animation: spinner 1500ms infinite linear;
animation: spinner 1500ms infinite linear;
border-radius: 0.5em;
-webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
0% {
-webkit-transform: rotate(0deg);
-moz-transform: rotate(0deg);
-ms-transform: rotate(0deg);
-o-transform: rotate(0deg);
transform: rotate(0deg);
}
100% {
-webkit-transform: rotate(360deg);
-moz-transform: rotate(360deg);
-ms-transform: rotate(360deg);
-o-transform: rotate(360deg);
transform: rotate(360deg);
}
}
@-moz-keyframes spinner {
0% {
-webkit-transform: rotate(0deg);
-moz-transform: rotate(0deg);
-ms-transform: rotate(0deg);
-o-transform: rotate(0deg);
transform: rotate(0deg);
}
100% {
-webkit-transform: rotate(360deg);
-moz-transform: rotate(360deg);
-ms-transform: rotate(360deg);
-o-transform: rotate(360deg);
transform: rotate(360deg);
}
}
@-o-keyframes spinner {
0% {
-webkit-transform: rotate(0deg);
-moz-transform: rotate(0deg);
-ms-transform: rotate(0deg);
-o-transform: rotate(0deg);
transform: rotate(0deg);
}
100% {
-webkit-transform: rotate(360deg);
-moz-transform: rotate(360deg);
-ms-transform: rotate(360deg);
-o-transform: rotate(360deg);
transform: rotate(360deg);
}
}
@keyframes spinner {
0% {
-webkit-transform: rotate(0deg);
-moz-transform: rotate(0deg);
-ms-transform: rotate(0deg);
-o-transform: rotate(0deg);
transform: rotate(0deg);
}
100% {
-webkit-transform: rotate(360deg);
-moz-transform: rotate(360deg);
-ms-transform: rotate(360deg);
-o-transform: rotate(360deg);
transform: rotate(360deg);
}
}
</style>