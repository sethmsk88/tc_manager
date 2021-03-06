<!-- Modal Dialog -->
<div
	class="modal fade"
	id="confirmDelete"
	role="dialog"
	aria-labelledby="confirmDeleteLabel"
	aria-hidden="true">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button
					type="button"
					class="close"
					data-dismiss="modal"
					aria-hidden="true">
					&times;
				</button>
	        	<h4 class="modal-title">Delete Permanently</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure about this ?</p>
			</div>
			<div class="modal-footer">
				<button
					type="button"
					class="btn btn-default"
					data-dismiss="modal">
					Cancel
				</button>
	        	<button
	        		type="button"
	        		class="btn btn-danger"
	        		id="confirm">
	        		Delete
	        	</button>
			</div>
		</div>
	</div>
</div>

<!-- Dialog show event handler -->
<script type="text/javascript">
	$('#confirmDelete').on('show.bs.modal', function (e) {
		$buttonID = $(e.relatedTarget).attr('id');

		$message = $(e.relatedTarget).attr('data-message');
		$(this).find('.modal-body p').html($message);
		$title = $(e.relatedTarget).attr('data-title');
		$(this).find('.modal-title').text($title);

		// Pass form reference to modal for submission on yes/ok
		var formID = $(e.relatedTarget).attr('data-formid');
		var form = $(formID);
		$(this).find('.modal-footer #confirm').data('form', form);
	});

	// Form confirm (yes/ok) handler, submits form
	$('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
		
		// Get fileID from buttonID
		$fileID = $buttonID.match(/\d+$/)[0];

		// Set hidden input value
		$('#fileID').val($fileID);
		
		$(this).data('form').submit();
	});
</script>
