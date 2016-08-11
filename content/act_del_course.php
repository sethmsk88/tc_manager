<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap/apps/shared/db_connect.php';

// verify that required variable was posted to this page
if (isset($_POST['_eid'])) {
	
	// run query to "delete" course listing
	// by delete, I mean mark Active=0
	$update_del_event_sql = "
		UPDATE hrodt.tc_event
		SET Active = 0
		WHERE EventID = ?
	";
	if (!$stmt = $conn->prepare($update_del_event_sql)) {
		echo 'Prepare failed: (' . $conn->errno . ') ' . $conn->error . '<br />';
	} else {
		$stmt->bind_param("i", $_POST['_eid']);
		$stmt->execute();
	}
}
?>
