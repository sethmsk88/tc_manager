$(document).ready(function(){

	$('#eventForm').on('submit', function(e){
		e.preventDefault(); // Prevent submit

		var formAction = e.currentTarget.action;
		
		$.ajax({
			url: formAction,
			method: 'post',
			data: $('#eventForm').serialize(),
			success: function(response) {
				
				// If an ID number was returned
				if (!isNaN(response)) {
					window.location.href = "?page=manager&edited=" + response;
				}
			}
		});
		

	});

});