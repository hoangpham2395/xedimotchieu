$(function () {
	// Date picker
	$('.datepicker').datepicker();
	$('.datetimepicker').datetimepicker({
		format: 'YYYY-MM-DD H:mm',
		inline: false,
        sideBySide: true
	});
	$('.timepicker').timepicker({
		showInputs: false,
		showMeridian: false
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
		htmlId = $(e).attr('data-id'),
		field = $(e).attr('data-field');

		if (field == null || field == undefined) {
			field = htmlId;
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: {
				city_id: cityId,
				_token: token,
				field: field
			}
		}).done(function(response) {
			$('#' + htmlId).html(response);
		}).fail(function() {
			alert(SystemController.systemError);
		});
	},
	getTotalRow: function () {
        return $('.model_schedule_list').find('.model_schedule_info').length;
    },
    replacePrefix: function (selector, prefix, newName) {
        $(selector).find('input, select, div, tr, button, label').each(function () {
            var pattern = /_prefix_/gm;
            // change name
            var name = $(this).attr('name');
            if (name !== undefined && name.length > 0) {
                name = name.replace('[' + prefix + ']', '[' + newName + ']');
                $(this).attr('name', name);
            }
            // change class
            var className = $(this).attr('class');
            if (className !== undefined && className.length > 0) {
                className = className.replace(pattern, newName);
                $(this).attr('class', className);
            }
            // change id
            var idName = $(this).attr('id');
            if (idName !== undefined && idName.length > 0) {
                idName = idName.replace(pattern, newName);
                $(this).attr('id', idName);
            }
            // change data id
            var dataId = $(this).data('id');
            if (dataId !== undefined && dataId.length > 0) {
                dataId = dataId.replace(pattern, newName);
                $(this).attr('data-id', dataId);
            }
            // change data index
            var dataIndex = $(this).data('index');
            if (dataIndex !== undefined && dataIndex.length > 0) {
                dataIndex = dataIndex.replace(pattern, newName);
                $(this).attr('data-index', dataIndex);
            }

            // change for
            var _for = $(this).attr('for');
            if (_for !== undefined && _for.length > 0) {
                _for = _for.replace(pattern, newName);
                $(this).attr('for', _for);
            }

            // change name of input file
            name = $(this).attr('name');
            if (name !== undefined && name.length > 0 && name.startsWith('_file_name')) {
                name = name.replace(pattern, newName);
                $(this).attr('name', name);

                var value = $(this).attr('value');
                value = value.replace(pattern, newName);
                $(this).attr('value', value);
            }
        });
    },

    /**
     * Bind event for delete button
     */
    bindDeleteBtn: function () {
        var total = PostsController.getTotalRow();
        if (total <= 1) {
            $('.model_schedule_list .model_schedule_info .delete-row').not(':first').addClass('hide');
        } else {
            $('.model_schedule_list .model_schedule_info .delete-row').not(':first').removeClass('hide');
        }
        setTimeout(function () {
            $('.model_schedule_list .model_schedule_info').each(function (e) {
                $(this).find('input,select,hidden').each(function (ex) {
                    var name = $(this).attr('name');
                    name = name.replace(/\[[0-9]*/, '[' + e);
                    $(this).attr('name', name);
                })
            })
        }, 500);
    },
	addSchedule: function(input) {
		var total = PostsController.getTotalRow(),
            prefix = '_prefix_',
            newName = total,
            html = $('#model_schedule_template').html();

        // append new model
        $('.model_schedule_list').append(html);
        // change data-id
    	$('.model_schedule_list .new_model_schedule:last').attr('data-id', total);
    	$('.model_schedule_list .new_model_schedule:last .model_schedule_info').attr('data-id', total);
        // change panel heading
        $('.model_schedule_list .new_model_schedule:last').find('.panel_heading').empty().text(total + 1);
        $('.model_schedule_template .new_model_schedule').find('.panel_heading').empty().text(prefix);
        // change data-id for selectbox city
        $('.model_schedule_list .new_model_schedule:last').find('.select-city').attr('data-id', 'district_id_' + total);
        $('.model_schedule_list .new_model_schedule:last').find('.select-district').attr('id', 'district_id_' + total);
        // change tag name, id, class
        PostsController.replacePrefix('.model_shop_media_list .new_model_shop_media:last', prefix, newName);
        PostsController.bindDeleteBtn();
		// Load package
        $('.timepicker').timepicker({
			showInputs: false,
			showMeridian: false
		});
		$('.model_schedule_list .new_model_schedule:last .select2').select2();
	},
	removeSchedule: function (input) {
        if (PostsController.getTotalRow() <= 1) {
            return false;
        }
        // delete old data
        $(input).closest('.model_schedule_info').remove();
        
        $('.model_schedule_list').find('.model_schedule_info').each(function(index) {
        	$(this).find('.panel_heading').empty().text(index + 1);
        	$(this).find('.select-city').attr('data-id', 'district_id_' + index);
        	$(this).find('.select-district').attr('id', 'district_id_' + index);
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