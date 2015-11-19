<div class="container-fluid">

	<div class="row">
		<div class="col-sm-12">
			<button id="btn_addEvent" type="button" class="btn btn-lg btn-style1">Add Event</button>
		</div>
	</div>

	<?php

		// Connect to DB
		$conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
		if ($conn->connect_errno){
			echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
		}

		$sql = "
			SELECT *
			FROM $eventTable
			WHERE Active = 1
			ORDER BY EventDate ASC
			";

		// Run Query
		$qry_events = $conn->query($sql);

		// Output query results
		if (!$qry_events){
			echo "Query failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			$qry_events_col_names = $qry_events->fetch_fields();
			$qry_events_results = $qry_events->fetch_all();
		}
		// Close DB connection
		mysqli_close($conn);
	?>
	
	<!-- Table showing all active events -->
	<div class="row">
		<div class="col-md-12">
			<table class="eventsCalendar table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Event Name</th>
						<th>Date</th>
						<th>Time</th>
						<th>Location</th>
						<th>Instructor</th>
						<th>Instructor Title</th>
						<th>Description</th>
						<th style="min-width:102px;">Actions</th>			
					</tr>
				</thead>
				<tbody>
				<?php
					$numActiveEvents = 7; // Actively displayed

					$qry_events->data_seek(0); // Move result set iterator to start
					while ($row = $qry_events->fetch_assoc()){

						/*
							Determine row color based on whether or not the event is too
							far in the past or too far in the future to be displayed.
						*/
						if (strtotime($row['EventDate']) < strtotime("-1 day")){
							$rowClass = "danger";
						}
						else if ($numActiveEvents > 0){
							$numActiveEvents--;
							$rowClass = "success";
						}
						else{
							$rowClass = "info";
						}
					?>
						<tr class="<?php echo $rowClass; ?>">
							<td><?php echo $row['Name']; ?></td>
							<td><?php echo date('m/d/Y', strtotime($row['EventDate'])); ?></td>
							<td><?php echo date('g:ia', strtotime($row['TimeBegin'])) . ' - ' . date('g:ia', strtotime($row['TimeEnd'])); ?></td>
							<td><?php echo $row['Location']; ?></td>
							<td><?php echo $row['Instructor']; ?></td>
							<td><?php echo $row['InstructorTitle']; ?></td>
							<td><?php echo $row['Description']; ?></td>
							<td class="center">
								<button
									id="<?php echo 'edit_' . $row['EventID']; ?>"
									type="button"
									class="edit_button btn btn-default confirm"
									style="margin-right:4px;"
									data-toggle="confirmation"
									>
									<span class="edit_button glyphicon glyphicon-pencil"></span>
								</button>
								<button
									id="<?php echo 'del_' . $row['EventID']; ?>"
									type="button"
									class="del_button btn btn-default"
									>
									<span class="del_button glyphicon glyphicon-remove"></span>
								</button>
							</td>
						</tr>
				<?php
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
