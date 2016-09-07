<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap/apps/shared/db_connect.php'; // connect to DB

	$date = date('Y-m-d', strtotime($_POST['date']));
	$courseName = $conn->escape_string(trim($_POST['courseName']));
	$startTime = date('H:i:s', strtotime($_POST['startTime']));
	$endTime = date('H:i:s', strtotime($_POST['endTime']));
	$location = $conn->escape_string(trim($_POST['location']));
	$instructor = $conn->escape_string(trim($_POST['instructor']));
	$instructorTitle = $conn->escape_string(trim($_POST['instructorTitle']));
	$descr = $conn->escape_string(trim($_POST['descr']));
	$listserv = $_POST['listserv'];
	$active = 1;

	// If URL var eid exists, UPDATE event, otherwise INSERT new event
	if (isset($_POST['eid'])) {

		// UPDATE existing event
		$update_event_sql = "
			UPDATE hrodt.tc_event
			SET	EventDate = ?,
				Name = ?,
				TimeBegin = ?,
				TimeEnd = ?,
				Location = ?,
				Instructor = ?,
				InstructorTitle = ?,
				Description = ?,
				Listserv = ?
			WHERE
				EventID = ?
		";

		if (!$stmt = $conn->prepare($update_event_sql)) {
			echo 'Prepare failed: (' . $conn->errno . ') ' . $conn->error . '<br />';
		} else {
			$stmt->bind_param("ssssssssii",
				$date,
				$courseName,
				$startTime,
				$endTime,
				$location,
				$instructor,
				$instructorTitle,
				$descr,
				$listserv,
				$_POST['eid']
				);
			$stmt->execute();
		}
	} else {

		// INSERT new event
		$ins_event_sql = "
			INSERT INTO hrodt.tc_event (EventDate, Name, TimeBegin, TimeEnd, Location, Instructor, InstructorTitle, Description, Listserv, Active)
			VALUES (?,?,?,?,?,?,?,?,?,?)
		";
		
		if (!$stmt = $conn->prepare($ins_event_sql)) {
			echo 'Prepare failed: (' . $conn->errno . ') ' . $conn->error . '<br />';
		} else {
			$stmt->bind_param("ssssssssii",
				$date,
				$courseName,
				$startTime,
				$endTime,
				$location,
				$instructor,
				$instructorTitle,
				$descr,
				$listserv,
				$active
				);
			$stmt->execute();
		}
	}
?>
