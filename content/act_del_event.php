<?php
	// TODO: Redirect if not coming from the correct page
	// Security Issue: Using a GET value for the delete ID

	// Connect to DB
	$conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
	if ($conn->connect_errno){
		echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}

	// Mark Event Inactive
	$sql = "
		UPDATE $eventTable
		SET Active = 0
		WHERE EventID = " . $_GET['id']
		;

	// Run query
	if ($conn->query($sql) === TRUE){
		$qry_success = TRUE;
	}
	else{
		$qry_success = FALSE;
		echo "Error executing query: " . $conn->error . "<br />";
	}

	// Clost DB connection
	mysqli_close($conn);

	if ($qry_success){
		echo '<script>';
			echo 'window.location = "?page=' . $homepage . '&deleted=' . $_GET['id'] . '"';
		echo '</script>';
	}
	else{
		echo '<h3>There was an error deleting the event. Please contact your Administrator.</h3>';
	}

?>