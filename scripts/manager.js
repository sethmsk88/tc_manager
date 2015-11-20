$(document).ready(function() {

	/*************************/
	/* Button Event Handlers */
	/*************************/
	$('#btn_addEvent').on('click', function(e){
		window.location = "./?page=add_event";
	});

	$('button.edit_button').on('click', function(e){
		var caller_id = e.target.id;
		var event_id = caller_id.match(/[0-9]+/);

		window.location.href = "./?page=edit_event&id=" + event_id;
	});

	$('button.del_button').on('click', function(e){
		e.preventDefault();

		var caller_id = e.target.id;
		var event_id = caller_id.match(/[0-9]+/)[0];

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
					$('button.del_button[id="' + caller_id + '"]').closest('tr').remove();
				}
			}
		});
	});

});


