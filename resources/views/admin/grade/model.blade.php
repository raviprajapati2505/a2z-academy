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
						<h3>Learner Grade</h3><br><br>
						<form id="gradeform">
							<div class="alert alert-danger" id="alert-danger-form">
							</div>
							<div class="alert alert-success" id="alert-success-form">
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="">Select Subcategory *</label>
										<select class="js-example-basic-single form-control" name="grade_subject" id="grade_subject">
											@foreach($subjects as $subject)
											<option value="{{ $subject->id }}">{{ $subject->title }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="teacher">Select Instructor *</label>
										<select class="js-example-basic-single form-control" name="teacher" id="teacher">
											@foreach($teachers as $teacher)
											<option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="status">Select Learner *</label>
										<select class="js-example-basic-single form-control" name="student" id="student">
											@foreach($students as $student)
											<option value="{{ $student->id }}">{{ $student->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="status">Select Grade *</label>
										<select class="js-example-basic-single form-control" name="grade" id="grade">
											<option value="A+">A+</option>
											<option value="A">A</option>
											<option value="B+">B+</option>
											<option value="B">B</option>
											<option value="C">C</option>
											<option value="P">P</option>
										</select>
									</div>
								</div>
							</div>

							<input type="hidden" id="grade_id" name="grade_id" value="">
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
