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
		var caller_id = e.target.id;
		var event_id = caller_id.match(/[0-9]+/);
		window.location.href = "./?page=act_del_event&id=" + event_id;
	});

});


