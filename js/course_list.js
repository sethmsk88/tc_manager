// Swap element's class1 for class2
function swapClass($el, class1, class2) {
	$el.toggleClass(class1);
	$el.toggleClass(class2);
}

$(document).ready(function() {

	// Activate data table
	$('#course-table').DataTable({
		"paging": false,
		"searching": false,
		"columnDefs": [
			{"orderable": false, "targets": 7} // Disable ordering on last column
		]
	});

	// Intercept Date sort event and apply sort to hidden column
	// Remove previously assigned click events for this object
	$dateCol = $('#dateCol');
	$dateCol.off("click");	
	$dateCol.click(function(e) {
		// apply sort to hidden date column
		$('#dateSort').trigger("click");

		console.log($dateCol.attr("class"));

		// show appropriate sorting symbol by toggling the correct class
		if ($dateCol.hasClass('sorting')) {
			$dateCol.removeClass('sorting');
			$dateCol.addClass('sorting_asc');
		} else if ($dateCol.hasClass('sorting_desc')) {
			$dateCol.removeClass('sorting_desc');
			$dateCol.addClass('sorting_asc');
		} else if ($dateCol.hasClass('sorting_asc')) {
			$dateCol.removeClass('sorting_asc');
			$dateCol.addClass('sorting_desc');
		}
	});

	$('.action-btn').click(function(e) {
		e.preventDefault();

		var id_parts = $(this).attr('id').split("-");
		var action = id_parts[0];
		var eid = id_parts[1];
		
		// if edit button do something
		if (action == "edit") {
			// redirect to edit course page
			location.href = "?page=edit_course&eid=" + eid;
		} else if (action == "del") {
			// set the hidden input element in the delete action form
			$('#_eid').val(eid);
		}
	});


	$('#del-course-form').submit(function(e) {
		e.preventDefault();

		$form = $(this);

		// post the id to the action page
		$.ajax({
			url: './content/act_del_course.php',
			method: 'post',
			data: $form.serialize(),
			success: function(response) {
				location.reload();
			}
		});
	});
});
