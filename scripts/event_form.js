$(document).ready(function(){

	// just for the demos, avoids form submit
	/*
	jQuery.validator.setDefaults({
	  debug: true,  // Prevents form from submitting
	  success: "valid"
	});

	$('#eventForm').validate({
		rules: {
			eventName: {
				required: true
			}
		}
	});
*/

	$('#submit_eventForm').click(function(){
		
		$('#eventForm').submit();

	});

});