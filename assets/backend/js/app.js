/* Set the width of the side navigation to 250px */
function openNav(x) {
	document.getElementById("mySidenav" + x).style.width = "350px";
	$("#o-nav" + x).hide();
	$("#c-nav" + x).show();
}
/* Set the width of the side navigation to 0 */
function closeNav(x) {
	document.getElementById("mySidenav" + x).style.width = "0";
	$("#c-nav" + x).hide();
	$("#o-nav" + x).show();
}

function validateNumber(event) {
	var key = window.event ? event.keyCode : event.which;
	if (event.keyCode === 8 || event.keyCode === 46 || event.keyCode === 37 || event.keyCode === 39) {
		return true;
	} else if (key < 48 || key > 57) {
		return false;
	} else return true;
};

function formatMoney(number, places, symbol, thousand, decimal) {
	number = number || 0;
	places = !isNaN(places = Math.abs(places)) ? places : 0;
	symbol = symbol !== undefined ? symbol : "";
	thousand = thousand || ".";
	decimal = decimal || ",";
	var negative = number < 0 ? "-" : "",
		i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
		j = (j = i.length) > 3 ? j % 3 : 0;
	return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
}

function retnum(str) {
	var num = str.replace(/[^0-9]|/ / g, '');
	return num;
}

function angka(number) {
	var str = number;
	var re = str.replace("Rp.", "");
	var res = replaceAll(".", "", re);
	return res;
}

function replaceAll(find, replace, str) {
	while (str.indexOf(find) > -1) {
		str = str.replace(find, replace);
	}
	return str;
}
var iMsg={A:"",B:"Bahan belum dipilih",C:"",D:"",E:"",F:"",G:"",H:"",J:"jumlah masih kosong",L:"Lebar masih kosong",K:"Kertas belum dipilih",KT:"Keterangan masih kosong",LT:"Lebar Tutup",LP:"Lebar Pond tidak boleh nol/kosong",LPA:"Lebar Pond kebesaran",TPA:"Tinggi Pond kebesaran",M:"Mesin belum dipilih",P:"Panjang masih kosong masih kosong",T:"Tinggi masih kosong",TP:"Tinggi pond tidak boleh nol/kosong",U:"Ukuran kebesaran",W:"Jumlah Warna Minimal!!",Z:""};