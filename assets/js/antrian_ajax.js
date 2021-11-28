// jQuery on an empty object, we are going to use this as our queue
var ajaxQueue = $({});

$.ajaxQueue = function(ajaxOpts) {
  // Hold the original complete function
  var oldComplete = ajaxOpts.complete;

  // Queue our ajax request
  ajaxQueue.queue(function(next) {
    // Create a complete callback to invoke the next event in the queue
    ajaxOpts.complete = function() {
      // Invoke the original complete if it was there
      if (oldComplete) {
        oldComplete.apply(this, arguments);
      }

      // Run the next query in the queue
      next();
    };

    // Run the query
    $.ajax(ajaxOpts);
  });
};


/* Set the width of the side navigation to 250px */
function openNav(x) {
	document.getElementById("mySidenav" + x).style.width = "400px";
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

