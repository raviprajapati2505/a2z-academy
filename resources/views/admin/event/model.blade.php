<div class="modal fade addeventmodalst" id="ajaxModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="addeventinermod">
					<h2>Add Event</h2>
					<form id="eventform">
						<div class="alert alert-danger" id="alert-danger-form">
						</div>
						<div class="alert alert-success" id="alert-success-form">
						</div>
						<div class="row">
							<div class="col-sm">
								<div class="form-group">
									<label for="name">Schedule For *</label>
									<select class="js-example-basic-single form-control" name="type" id="type">
										<option value="Live Class">Live Class</option>
										<option value="Event">Event</option>
										<option value="Exam">Exam</option>
										<option value="Other">Other</option>
									</select>
								</div>
							</div>

						</div>
						<div class="dateofdatasetv">
							<h3>Date</h3>
							<div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
								<input class="form-control" type="text" readonly name="date" id="date" />
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								<i class='bx bx-calendar'></i>
							</div>
						</div>
						<div class="row">
							<div class="col-sm">
								<div class="form-group">
									<label for="name">More Information</label>
									<textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
								</div>
							</div>
						</div>
						<input type="hidden" id="event_id" name="event_id" value="">
						<div class="saveprofdata">
							<button type="submit" value="Save" id="saveBtn">Save</button>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>