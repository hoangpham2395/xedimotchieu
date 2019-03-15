// Date picker
$(function () {
	$('.datepicker').datepicker();
	$('.datetimepicker').datetimepicker({
		format: 'YYYY-MM-DD H:mm',
		inline: false,
        sideBySide: true
	});
	$('.select2').select2();
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