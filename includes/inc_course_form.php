<script src="./js/course_form.js"></script>

<?php
	// If editing a course, populate fields with event info
	if (isset($_GET['eid'])) {
		// Get event information for the eid url var
		$sel_event_sql = "
			SELECT EventDate, Name, TimeBegin, TimeEnd, Location,
			Instructor, InstructorTitle, Description
			FROM hrodt.tc_event
			WHERE EventID = ?
				AND Active = 1
		";
		if (!$stmt = $conn->prepare($sel_event_sql)) {
			echo 'Prepare failed: (' . $conn->errno . ') ' . $conn->error . '<br />';
		} else {
			if (!$stmt->bind_param("i", $_GET['eid'])) {
				echo 'Bind param failed: (' . $stmt->errno . ') ' . $stmt->error . '<br />';
			} else {
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($date, $courseName, $timeBegin, $timeEnd, $location, $instructor, $instructorTitle, $descr);
				$stmt->fetch();
			}
		}
	} else {
		$date = "";
		$courseName = "";
		$timeBegin = "";
		$timeEnd = "";
		$location = "";
		$instructor = "";
		$instructorTitle = "";
		$descr = "";
	}
?>

<form
	name="course-form"
	id="course-form"
	class="cmxform"
	role="form"
	method="post"
	action="?page=course_list">

	<div class="row">
		<div class="col-md-6 form-group">
			<label for="courseName">Course Name</label>
			<input
				type="text"
				name="courseName"
				id="courseName"
				class="form-control"
				placeholder="Course Name"
				value="<?= $courseName ?>">
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 form-group">
			<label for="date">Date</label>
			<input
				type="text"
				name="date"
				id="date"
				class="form-control datepicker"
				placeholder=" Event Date"
				value="<?= date('m/d/Y', strtotime($date)) ?>">
		</div>
		<div class="col-md-4 form-group">
			<label for="startTime">Start Time</label>
			<input
				type="text"
				name="startTime"
				id="startTime"
				class="form-control"
				placeholder="e.g. 9:30am"
				value="<?= date('g:ia', strtotime($timeBegin)) ?>">
		</div>
		<div class="col-md-4 form-group">
			<label for="endTime">End Time</label>
			<input
				type="text"
				name="endTime"
				id="endTime"
				class="form-control"
				placeholder="e.g. 12:00pm"
				value="<?= date('g:ia', strtotime($timeEnd)) ?>">
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 form-group">
			<label for="location">Location</label>
			<input
				type="text"
				name="location"
				id="location"
				class="form-control"
				placeholder="Location"
				value="<?= $location ?>">
		</div>
		<div class="col-md-4 form-group">
			<label for="instructor" class="control-label">Instructor</label>
			<input
				type="text"
				name="instructor"
				id="instructor"
				class="form-control"
				placeholder="Instructor"
				value="<?= $instructor ?>">
		</div>
		<div class="col-md-4 form-group">
			<label for="instructorTitle" class="control-label">Instructor Title</label>
			<input
				type="text"
				name="instructorTitle"
				id="instructorTitle"
				class="form-control"
				placeholder="Instructor Title"
				value="<?= $instructorTitle ?>">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 form-group">
			<b>This course listing should appear in the listserv:</b>
			<div class="radio">
				<label for="listserv-no"><input type="radio" name="listserv" value="0"> No</label>
			</div>
			<div class="radio">
				<label for="listserv-yes"><input type="radio" name="listserv" value="1"> Yes</label>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 form-group">
			<label for="descr">Description</label>
			<textarea
				type="text"
				name="descr"
				id="descr"
				class="form-control"
				rows="3"
				placeholder="Description"><?= $descr ?></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<input
				type="submit"
				class="btn btn-primary"
				value="Submit"
				style="width:100%;">
		</div>
	</div>
</form>
