$(document).ready(function() {

	// Handler for submission of course form
	courseForm_ajax_submit = function(form) {
		$.ajax({
			url: './content/act_course.php',
			method: 'post',
			data: $(form).serialize(),
			success: function(response) {
				location.href = "?page=course_list";
			}
		});
	}	

	$('#course-form').validate({
		rules: {
			courseName: "required",
			date: {
				required: true,
				date: true
			},
			startTime: {
				required: true,
				time12h: true
			},
			endTime: {
				required: true,
				time12h: true
			},
			location: "required",
			instructor: "required",
			listserv: "required",
			descr: {
				maxlength: 2048
			}

		},
		messages: {
			courseName: {
				required: "Course Name is required."
			},
			date: {
				required: "Date is required."
			},
			startTime: {
				required: "Start Time is required."
			},
			endTime: {
				required: "End Time is required."
			},
			location: {
				required: "Location is required."
			},
			instructor: {
				required: "Instructor is required."
			},
			listserv: {
				required: "Listserv selection is required."
			}
		},
		errorPlacement: function(error, el) {
			if (el.is(":radio")) {
				error.appendTo(el.parents('.form-group'));
			} else {
				// default behavior
				error.insertAfter(el);
			}
		},
		submitHandler: courseForm_ajax_submit
	});
});
