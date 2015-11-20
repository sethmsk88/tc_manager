<?php
	/*** PAGE ACCESS RESTRICTION ***/
	// If a valid EventID was not passed to this page as a GET variable, redirect to homepage
	if ( !isset($_GET['id']) || !ctype_digit((string)$_GET['id'])){
?>
		<script>
			window.location.href = "?page=" + <?php echo $homepage; ?> +  "&err=noIDProvided";
		</script>
<?php
	}
	// Else if, id is less than 0; set to default id
	else if ($_GET['id'] < 0){
		$eventID = 0; // Default. Will cause no results to return.
	}
	else{
		$eventID = $_GET['id'];
	}

	// Connect to DB
	$conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
	if ($conn->connect_errno){
		echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}

	$sql = "
		SELECT *
		FROM tc_event
		WHERE EventID = $eventID
	";

	// Run query
	if (!$qry_event = $conn->query($sql)) {
		echo "Query failed: (" . $conn->errno . ") " . $conn->error;
	}
	else {
		// Get event info
		$qry_event_row = $qry_event->fetch_assoc();
	}

	// Close DB connection
	mysqli_close($conn);
?>

<div class="container">
	<div class="row">
		<h3 class="h3-1">Edit Event</h3>
	</div>

	<?php

		// Set the edit flag to tell the included page we are in edit mode
		$editEvent = true;

		// Set the form action for the included form below
		$formAction = "./content/act_edit_event.php";
		include "./content/inc_event_form.php";
	?>
</div>