$(document).ready(function(){

	$('#eventForm').on('submit', function(e){
		e.preventDefault(); // Prevent submit

		var formAction = e.currentTarget.action;
		
		$.ajax({
			url: formAction,
			method: 'post',
			data: $('#eventForm').serialize(),
			dataType: 'json',
			success: function(response) {
				
				// If action page executed successfully
				if (response !== null) {
					
					if (response['action'] == 'error') {
						
						// Print error message
						$('#ajax_response').text(response['message']);
					}
					else if (response['action'] == 'edit') {
						window.location.href = "?page=manager&edited=" + response['id'];
					}
					else if (response['action'] == 'add') {
						window.location.href = "?page=manager&added=" + response['id'];
					}
				}
			}
		});
		

	});

});