$(document).ready(function(){
	
	// Activate datepicker input fields
	$('.datepicker').datepicker();

	// Activate confirmation boxes
	//$('.confirm').confirmation();

	/*************************/
	/* Button Event Handlers */
	/*************************/
	$('#btn_goBack').on('click', function(e){
		window.location = "./?page=manager";
	});
});