<?php
	// Output FORM Post Variables
	/*
	foreach ($_POST as $param_name => $param_val){
		echo "Param: $param_name; Value: $param_val<br />";
	}
	*/

	// Connect to DB
	$conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
	if ($conn->connect_errno){
		echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}


	// Insert Event info into table
	$sql = "INSERT INTO $eventTable (EventDate, Name, TimeBegin, TimeEnd, Location, Instructor, InstructorTitle, Description, Active)" .
		"VALUES ('" . date('Y-m-d', strtotime($_POST['eventDate'])) . "'," .
			"'" . $conn->escape_string(trim($_POST['eventName'])) . "'," .
			"'" . date('H:i:s', strtotime($_POST['startTime'])) . "'," .
			"'" . date('H:i:s', strtotime($_POST['endTime'])) . "'," .
			"'" . $conn->escape_string(trim($_POST['location'])) . "'," .
			"'" . $conn->escape_string(trim($_POST['instructor'])) . "'," .
			"'" . $conn->escape_string(trim($_POST['instructorTitle'])) . "'," .
			"'" . $conn->escape_string(trim($_POST['description'])) . "'," .
			"1" .
			")";

	// Run Query
	if ($conn->query($sql) === TRUE){
		$qry_success = TRUE;
	}
	else{
		$qry_success = FALSE;
		echo "Error executing query: " . $conn->error . "<br />";
	}

	// Close DB connection
	mysqli_close($conn);


	/*
		If the event was successfully inserted into the DB, redirect;
		else, display error message and do not redirect.
	*/
	if ($qry_success){
		echo '<script>';
			echo 'window.location = "?page=' . $homepage . '"';
		echo '</script>';
	}
	else{
		echo '<h3>There was an error adding the event. You can use your browser\' Back button to correct the error and submit again.</h3>';
	}
?>

