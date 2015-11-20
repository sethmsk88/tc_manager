<?php
	// Include my database info
    include "../../shared/dbInfo.php";

	// Connect to DB
	$conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
	if ($conn->connect_errno){
		echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}

	$param_str_EventDate = date('Y-m-d', strtotime($_POST['eventDate']));
	$param_str_Name = $conn->escape_string(trim($_POST['eventName']));
	$param_str_TimeBegin = date('H:i:s', strtotime($_POST['startTime']));
	$param_str_TimeEnd = date('H:i:s', strtotime($_POST['endTime']));
	$param_str_Location = $conn->escape_string(trim($_POST['location']));
	$param_str_Instructor = $conn->escape_string(trim($_POST['instructor']));
	$param_str_InstructorTitle = $conn->escape_string(trim($_POST['instructorTitle']));
	$param_str_Description = $conn->escape_string(trim($_POST['description']));
	$param_int_Active = 1; // true

	// Insert Event info into table
	$insert_event_sql = "
		INSERT INTO tc_event (
			EventDate,
			Name,
			TimeBegin,
			TimeEnd,
			Location,
			Instructor,
			InstructorTitle,
			Description,
			Active)
		VALUES (?,?,?,?,?,?,?,?,?)
	";

	// Prepare stmt
	if (!$stmt = $conn->prepare($insert_event_sql)) {
		echo 'Prepare failed: (' . $conn->errno . ') ' . $conn->error;
	}

	// Bind params
	if (!$stmt->bind_param("ssssssssi",
			$param_str_EventDate,
			$param_str_Name,
			$param_str_TimeBegin,
			$param_str_TimeEnd,
			$param_str_Location,
			$param_str_Instructor,
			$param_str_InstructorTitle,
			$param_str_Description,
			$param_int_Active)
		){
		echo 'Binding params failed: (' . $stmt->errno . ') ' . $stmt->error;
	}

	// Execute query
	if (!$stmt->execute()) {
		echo 'Execute failed (' . $stmt->errno . ') ' . $stmt->error;
	}
	else {
		echo '1'; // Success
	}

	$stmt->close();

	// Close DB connection
	mysqli_close($conn);
?>
