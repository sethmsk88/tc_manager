<script src="./js/course_list.js"></script>

<?php
	// Get active events that are newer than one week in the past
	$sel_events_sql = "
		SELECT EventID, EventDate, Name, TimeBegin, TimeEnd, Location,
			Instructor, InstructorTitle, Description
		FROM hrodt.tc_event
		WHERE Active = 1
			AND EVENTDate > NOW() - INTERVAL 1 week
		ORDER BY EventDate, TimeBegin
	";

	if (!$stmt = $conn->prepare($sel_events_sql)){
		echo 'Prepare failed: (' . $conn->errno . ') ' . $conn->error . '<br />';
	} else {
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($eid, $date, $courseName, $timeBegin, $timeEnd, $location, $instructor, $instructorTitle, $descr);
	}
?>

<div class="container-fluid">
	<table class="table table-striped table-hover">
		<caption>Course List</caption>
		<tr>
			<th>Date</th>
			<th>Time</th>
			<th>Course</th>
			<th>Location</th>
			<th>Instructor</th>
			<th>Instructor Title</th>
			<th>Description</th>
			<th></th>
		</tr>
		<?php
			// Iterate through events result set
			while ($stmt->fetch()) {

				// Set color of row based one the when course is taking place
				if (strtotime($date) < strtotime("-1 day")) {
					$rowClass = "danger";
				} else {			
					$rowClass = "success";
				}
		?>
		<tr class="<?= $rowClass ?>">
			<td class="nowrap"><?= date('n/j (D)', strtotime($date)) ?></td>
			<td class="nowrap"><?= date('g:ia', strtotime($timeBegin)) . ' - ' . date('g:ia', strtotime($timeEnd)) ?></td>
			<td><?= $courseName ?></td>
			<td><?= $location ?></td>
			<td><?= $instructor ?></td>
			<td><?= $instructorTitle ?></td>
			<td><?= $descr ?></td>			
			<td class="nowrap">
				<button
					type="button"
					id="edit-<?= $eid ?>"
					class="action-btn btn btn-warning">
					<span class="glyphicon glyphicon-pencil"></span>
				</button>
				<button
					type="button"
					id="del-<?= $eid ?>"
					class="action-btn btn btn-danger">
					<span class="glyphicon glyphicon-trash"></span>
				</button>
			</td>
		</tr>
		<?php } // End results set loop ?>
	</table>
</div>
