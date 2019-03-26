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

(function ($) {
    'use strict';
    // Preloader
    $(window).on('load', function () {
        $('#preloader').fadeOut('1000', function () {
            $(this).remove();
        });
    });

    // Toggle nav
    if ($.fn.classyNav) {
        $('#robertoNav').classyNav();
    }
})(jQuery);

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
	
	isMobile: function () {
	    var check = false;
	    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
	    return check;
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
  		// Show form search
		$('.home-search').removeClass('display-none');
		$('.home-result').removeClass('display-none');
		// Scroll to top
		HomeController.scrollToTop(parseInt($('#home_search').offset().top) - 90);
	},
	scrollToTop: function(position) {
  		$("html, body").animate({ scrollTop: position }, "slow");
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

var RatesController = {
	store: function(formId) {
		var url = $(formId).attr('action'),
		method = $(formId).attr('method'),
		token = $(formId + ' input[name="_token"]').val(),
		postId = $(formId + ' input[name="post_id"]').val(),
		rate = $(formId + ' input[name="rate"]').val(),
		comment = $(formId + ' textarea[name="comment"]').val();

		// Reset validation
		$('#alert_rate').addClass('display-none');
		$('#alert_rate .error-rate').addClass('display-none');
		$('#alert_rate .error-comment').addClass('display-none');

		// Validate
		if (!rate) {
			$('#alert_rate').removeClass('display-none');
			$('#alert_rate .error-rate').removeClass('display-none');
		}
		if (!comment) {
			$('#alert_rate').removeClass('display-none');
			$('#alert_rate .error-comment').removeClass('display-none');
		}

		// Submit form
		if (rate && comment) {
			$.ajax({
				url: url,
				type: 'POST',
				data: {
					_token: token,
					rate: rate,
					comment: comment,
					post_id: postId
				}
			}).done(function(data) {
				$('#list_rates').html(data);
				// Reset data
				$(formId + ' input[name="rate"]').val(0);
				$(formId + ' .filled-stars').css('width', '0%');
				$(formId + ' textarea[name="comment"]').val('');
			}).fail(function() {
				alert(SystemController.systemError);
			});
		}
	},
	redirectLogin:function(e) {
		var url = $(e).attr('data-url');
		window.location.href = url;
	},
};