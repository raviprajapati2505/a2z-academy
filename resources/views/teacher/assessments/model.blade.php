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
						<h3>Learner Assessment</h3><br><br>
						<form method="POST" enctype="multipart/form-data" id="assessmentform" action="javascript:void(0)">
							<div class="alert alert-danger" id="alert-danger-form">
							</div>
							<div class="alert alert-success" id="alert-success-form">
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="assessment_subject">Select Subcategory *</label>
										<select class="js-example-basic-single form-control" name="assessment_subject" id="assessment_subject">
											@foreach($subjects as $subject)
											<option value="{{ $subject->id }}">{{ $subject->title }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="assessment_class">Select Batch *</label>
										<select class="js-example-basic-single form-control" name="assessment_class" id="assessment_class">
											@foreach($classes as $class)
											<option value="{{ $class->id }}">{{ $class->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="student">Select Learner *</label>
										<select class="js-example-basic-single form-control" name="student" id="student">
											@foreach($students as $student)
											<option value="{{ $student->id }}">{{ $student->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="marks">Marks *</label>
										<input type="text" class="form-control" id="marks" name="marks" placeholder="">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="status">Assessment File</label>
										<input type="file" class="form-control" id="assesment_file" name="assesment_file" placeholder="">
										<a href="" download class="download">Download</a>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="other_info">Other information</label>
										<textarea name="other_info" id="other_info" class="form-control"></textarea>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="price">Assignment Start Date *</label>
										<input type="text" name="started_date" id="started_date" class="form-control datepicker" placeholder="">
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="price">Assignment Expired Date *</label>
										<input type="text" name="expired_date" id="expired_date" class="form-control datepicker" placeholder="">
									</div>
								</div>
							</div>

							<input type="hidden" id="assessment_id" name="assessment_id" value="">
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
