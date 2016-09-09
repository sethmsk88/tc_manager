<script src="./js/course_list.js"></script>

<?php
	// include delete confirm modal
	require_once('./includes/inc_delete_confirm.php');

	// Get active events that are newer than one week in the past
	$sel_events_sql = "
		SELECT EventID, EventDate, Name, TimeBegin, TimeEnd, Location,
			Instructor, InstructorTitle, Description, Listserv
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
		$stmt->bind_result($eid, $date, $courseName, $timeBegin, $timeEnd, $location, $instructor, $instructorTitle, $descr, $listserv);
	}
?>

<div class="container-fluid">
	<table id="course-table" class="table table-striped table-hover">
		<caption>Course List</caption>
		<thead>
			<tr>
				<th id="dateSort" class="hidden">SortDate</th>
				<th id="dateCol">Date</th>
				<th>Time</th>
				<th>Course</th>
				<th>Location</th>
				<th>Instructor</th>
				<th>Instructor Title</th>
				<th>Listserv</th>
				<th><!-- intentionally left blank --></th>
			</tr>
		</thead>
		<tbody>
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
				<td class="hidden"><?= $date ?></td>
				<td class="nowrap"><?= date('n/j (D)', strtotime($date)) ?></td>
				<td class="nowrap"><?= date('g:ia', strtotime($timeBegin)) . ' - ' . date('g:ia', strtotime($timeEnd)) ?></td>
				<td><?= $courseName ?></td>
				<td><?= $location ?></td>
				<td><?= $instructor ?></td>
				<td><?= $instructorTitle ?></td>
				<td style="font-size: 1.35em;">
					<?php
						if ($listserv == 1)
							echo '<span class="glyphicon glyphicon-ok text-success"></span>';
						else
							echo '<span class="glyphicon glyphicon-remove text-danger"></span>';
					?>
				</td>			
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
						class="action-btn btn btn-danger"
						data-toggle="modal"
						data-target="#confirmDelete"
						data-formid="#del-course-form"
						data-title="Delete Course"
						data-message="Are you sure you want to delete this course?">
						<span class="glyphicon glyphicon-trash"></span>
					</button>
				</td>
			</tr>
		<?php } // End results set loop ?>
		</tbody>
	</table>
</div>


<!-- Hidden form for delete course button. Submitted using ajax -->
<form id="del-course-form" class="hidden">
	<input id="_eid" name="_eid" type="hidden" value="">
</form>
