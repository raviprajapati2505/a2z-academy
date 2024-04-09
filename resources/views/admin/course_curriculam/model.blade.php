<div class="modal fade" id="ajaxModel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="userprofalldata-full">

					<div class="userprofalldata-iner model-form">
						<h3>Course Curriculam</h3><br><br>
						<form id="course_curriculamform">
							<div class="alert alert-danger" id="alert-danger-form">
							</div>
							<div class="alert alert-success" id="alert-success-form">
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="">Title *</label>
										<input type="text" class="form-control" id="title" name="title" placeholder="">
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="">Display Order</label>
										<input type="text" class="form-control" id="display_order" name="display_order" placeholder="">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="status">This Curriculam is</label>
										<select class="js-example-basic-single form-control" name="status" id="status">
											<option value="Enabled">Active</option>
											<option value="Disabled">Inactive</option>
										</select>
									</div>
								</div>
							</div>

							<input type="hidden" id="course_id" name="course_id" value="{{last(request()->segments())}}">
							<input type="hidden" id="course_curriculam_id" name="course_curriculam_id" value="">
							<div class="saveprofdata">
								<button type="submit" value="Save" id="saveBtn">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>