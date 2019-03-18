$(function () {
	// Date picker
	$('.datepicker').datepicker();
	$('.datetimepicker').datetimepicker({
		format: 'YYYY-MM-DD H:mm',
		inline: false,
        sideBySide: true
	});
	// Jquery select2
	$('.select2').select2();
	// slider
	var minCost = SystemController.getUrlVars()['min_cost'] ? SystemController.getUrlVars()['min_cost'] : 0;
	var maxCost = SystemController.getUrlVars()['max_cost'] ? SystemController.getUrlVars()['max_cost'] : 10;
	$( "#slider-range" ).slider({
		range: true,
		min: 0,
		max: 10,
		values: [minCost, maxCost],
		slide: function( event, ui ) {
			$( "#amount" ).text(ui.values[ 0 ] + " triệu VND - " + ui.values[ 1 ] + " triệu VND");
			$("#amount1").val(ui.values[0]);
			$("#amount2").val(ui.values[1]);
		}
	});
	$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
});

// Accordion in left column
function showSubMenu(id) {
	var x = document.getElementById(id);
	if (x.className.indexOf("w3-show") == -1) {
		x.className += " w3-show";
		x.previousElementSibling.className += " w3-theme-d1";
	} else { 
		x.className = x.className.replace("w3-show", "");
		x.previousElementSibling.className = 
		x.previousElementSibling.className.replace(" w3-theme-d1", "");
	}
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
	var x = document.getElementById("navDemo");
	if (x.className.indexOf("w3-show") == -1) {
		x.className += " w3-show";
	} else { 
		x.className = x.className.replace(" w3-show", "");
	}
}

var SystemController = {
	systemError: 'Lỗi hệ thống.',
	getUrlVars: function() {
	    var vars = {};
	    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	        vars[key] = value;
	    });
	    return vars;
	},
};

var PostsController = {
	getDistricts: function(e) {
		var cityId = $(e).val(),
		url = $(e).attr('data-action'),
		token = $(e).attr('data-token'),
		htmlId = $(e).attr('data-id');
		$.ajax({
			url: url,
			type: 'POST',
			data: {
				city_id: cityId,
				_token: token,
				field: htmlId
			}
		}).done(function(response) {
			$('#' + htmlId).html(response);
		}).fail(function() {
			alert(SystemController.systemError);
		});
	},
};

var HomeController = {
	search: function(e) {
		// Scroll to top
		HomeController.scrollToTop();
  		// Show form search
		$('.home-search').removeClass('display-none');
		$('.home-result').removeClass('display-none');
	},
	scrollToTop: function() {
		document.body.scrollTop = 0; // For Safari
  		document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera	
	},
	showBtnScroll: function() {
		// Scroll 300px
		if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
    		document.getElementById("btn_scroll").style.display = "block";
  		} else {
    		document.getElementById("btn_scroll").style.display = "none";
  		}
	},
};