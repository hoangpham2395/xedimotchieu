// Date picker
$(function () {
    $('.datepicker').datepicker();
    $('.datetimepicker').datetimepicker({
		format: 'YYYY-MM-DD H:mm',
		inline: false,
        sideBySide: true
	});
});

var UsersController = {
	openFlagActive: 1,
	changeOpenFlag: function(e) {
		var id = $(e).attr('data-id'),
		url = $(e).attr('data-action'),
		token = $(e).attr('data-token'),
		that = this;

		$.ajax({
			url: url,
			type: 'POST',
			data: {
				id: id, 
				_token: token
			}
		}).done(function(response) {
			if (response.status) {
				// update success, change button open flag
				if (response.openFlag == that.openFlagActive) {
					$(e).removeClass('btn-basic').addClass('btn-success').text('On');
				} else {
					$(e).removeClass('btn-success').addClass('btn-basic').text('Off');
				}
			} else {
				alert('Lỗi hệ thống.');
			}
		}).fail(function() {
			alert('Lỗi hệ thống.');
		});
	},
};