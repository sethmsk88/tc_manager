<?php
	// TODO: Redirect if not coming from the correct page

	// Include my database info
    include "../../shared/dbInfo.php";

	// Connect to DB
	$conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
	if ($conn->connect_errno){
		echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}

	$param_int_Active = 0; // Inactive
	$param_int_EventID = $_POST['id'];

	// Mark Event Inactive
	$delete_event_sql = "
		UPDATE tc_event
		SET Active = ?
		WHERE EventID = ?
	";

	// Prepare stmt
	if (!$stmt = $conn->prepare($delete_event_sql)) {
		echo 'Prepare failed: (' . $conn->errno . ') ' . $conn->error;
	}

	// Bind params
	if (!$stmt->bind_param("ii", $param_int_Active, $param_int_EventID)) {
		echo 'Binding params failed: (' . $stmt->errno . ') ' . $stmt->error;
	}

	// Execute query
	if (!$stmt->execute()) {
		// Response
		echo json_encode(
			array(
				'action'=>'error',
				'message'=>'Execute failed (' . $stmt->errno . ') ' . $stmt->error
			)
		);
	}
	else {

		// Response
		echo json_encode(
			array(
				'action'=>'delete',
				'id'=>$param_int_EventID
			)
		);
	}

	$stmt->close();

	// Close DB connection
	mysqli_close($conn);
?>
