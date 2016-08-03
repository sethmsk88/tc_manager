$(document).ready(function() {
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
			// post the id to the action page
			$.ajax({
				url: './content/act_del_course.php',
				method: 'post',
				data: {
					'eid': eid
				},
				success: function(response) {
					alert(response);
				}
			});
		}
		// else if delete do something

	});
});
