$(document).ready(function() {

	/*************************/
	/* Button Event Handlers */
	/*************************/
	$('#btn_addEvent').on('click', function() {
		window.location.href = "./?page=add_event";
	});

	$('button.edit_button').on('click', function() {
		var regex_matchDigits = /\d+/;
		var event_id = $(this).attr('id').match(regex_matchDigits)[0];
		
		window.location.href = "./?page=edit_event&id=" + event_id;
	});

	$('button.del_button').on('click', function(e){
		e.preventDefault();

		var regex_matchDigits = /\d+/;
		var event_id = $(this).attr('id').match(regex_matchDigits)[0];
		
		$.ajax({
			url: './content/act_del_event.php',
			method: 'post',
			data: {
				'id': event_id
			},
			dataType: 'json',
			success: function(response) {

				if (response['action'] == 'error') {
						
					// Print error message
					$('#ajax_response').text(response['message']);
				}
				else if (response['action'] == 'delete') {
					// Remove the event from the table that was just deleted
					$('button.del_button[id="' + $(this).attr('id') + '"]').closest('tr').remove();
				}
			}
		});
	});

});


