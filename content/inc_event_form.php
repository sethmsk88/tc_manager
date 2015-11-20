<!--
	This page is included by edit_event.php
-->

<script src="./scripts/event_form.js"></script>

<?php

	// If editing an event
	if (isset($editEvent) && $editEvent == true){

		// Set eventID for update
		$eventID = $_GET['id'];

		// Set form field value vars
		$eventName = $qry_event_row['Name'];
		$eventDate = $qry_event_row['EventDate'];
		$startTime = $qry_event_row['TimeBegin'];
		$endTime = $qry_event_row['TimeEnd'];
		$location = $qry_event_row['Location'];
		$instructor = $qry_event_row['Instructor'];
		$instructorTitle = $qry_event_row['InstructorTitle'];
		$description = $qry_event_row['Description'];
	}
	else {
		// Else, adding an event
		$eventName = "";
		$eventDate = "";
		$startTime = "";
		$endTime = "";
		$location = "";
		$instructor = "";
		$instructorTitle = "";
		$description = "";
	}
?>

<form
	id="eventForm"
	name="eventForm"
	method="post"
	role="form"
	action="<?php echo $formAction; ?>"
	>

	<input
		type="hidden"
		name="eventID"
		id="eventID"
		value="<?php if(isset($eventID)){echo $eventID;} ?>"
		>

	<div class="row">
		<div class="form-group col-md-6">
			<label for="eventName" class="control-label">Event Name</label>
			<input
				type="text"
				name="eventName"
				id="eventName"
				class="form-control"
				placeholder="Event Name"
				maxlength="128"
				value="<?php echo $eventName ?>"
				>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="eventDate" class="control-label">Event Date</label>
			<input
				name="eventDate"
				id="eventDate"
				class="form-control datepicker"
				maxlength="10"
				placeholder="  Event Date"
				value="<?php if ($eventDate != ''){echo date('m/d/Y', strtotime($eventDate));} ?>"
				>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="startTime" class="control-label">Event Start Time</label>
			<input
				type="text"
				name="startTime"
				id="startTime"
				class="form-control"
				placeholder="(Example: 9:00am)"
				value="<?php if ($endTime != ''){echo date('g:ia', strtotime($startTime));} ?>"
				>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="endTime" class="control-label">Event End Time</label>
			<input
				type="text"
				name="endTime"
				id="endTime"
				class="form-control"
				placeholder="(Example: 12:00pm)"
				value="<?php if ($endTime != ''){echo date('g:ia', strtotime($endTime));} ?>"
				>
				
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="location" class="control-label">Location</label>
			<input
				type="text"
				name="location"
				id="location"
				class="form-control"
				placeholder="Location"
				value="<?php echo $location ?>"
				>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="instructor" class="control-label">Instructor</label>
			<input
				type="text"
				name="instructor"
				id="instructor"
				class="form-control"
				placeholder="Instructor"
				value="<?php echo $instructor ?>"
				>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="instructorTitle" class="control-label">Instructor Title</label>
			<input
				type="text"
				name="instructorTitle"
				id="instructorTitle"
				class="form-control"
				placeholder="Instructor Title"
				value="<?php echo $instructorTitle ?>"
				>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-md-8">
			<label for="description" class="control-label">Description</label>
			<textarea
				name="description"
				id="description"
				class="form-control"
				rows="3"
				placeholder="Description"
				><?php echo $description ?></textarea>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<input
				type="submit"
				id="submit_eventForm"
				class="btn btn-md btn-primary"
				value="Submit"
				>
		</div>
	</div>
</form>

<div class="row">
	<div id="ajax_response" class="col-md-12">
		<!-- To be filled with ajax error response text -->
	</div>
</div>