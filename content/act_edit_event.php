<?php
	// TODO: Redirect if not coming from the correct page

	// Connect to DB
	$conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
	if ($conn->connect_errno){
		echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}

	// Update Event
	$sql = "
		UPDATE $eventTable
		SET EventDate = '" . date('Y-m-d', strtotime($_POST['eventDate'])) . "',
			Name = '" . $conn->escape_string(trim($_POST['eventName'])) . "',
			TimeBegin = '" . date('H:i:s', strtotime($_POST['startTime'])) .  "',
			TimeEnd = '" . date('H:i:s', strtotime($_POST['endTime'])) . "',
			Location = '" . $conn->escape_string(trim($_POST['location'])) . "',
			Instructor = '" . $conn->escape_string(trim($_POST['instructor'])) . "',
			InstructorTitle = '" . $conn->escape_string(trim($_POST['instructorTitle'])) . "',
			Description = '" . $conn->escape_string(trim($_POST['description'])) . "'
		WHERE EventID = " . $_POST['eventID']
		;

	// Run query
	if ($conn->query($sql) === TRUE){
		$qry_success = TRUE;
	}
	else{
		$qry_success = FALSE;
		echo "Error executing query: " . $conn->error . "<br />";
	}

	// Close DB connection
	mysqli_close($conn);

	if ($qry_success){
		echo '<script>';
			echo 'window.location = "?page=' . $homepage . '&edited=' . $_POST['eventID'] . '"';
		echo '</script>';
	}
	else{
		echo '<h3>There was an error adding the event. You can use your browser\' Back button to correct the error and submit again.</h3>';
	}

?>