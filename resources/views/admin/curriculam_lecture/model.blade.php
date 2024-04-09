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
						<form method="POST" enctype="multipart/form-data" id="curriculam_lectureform" action="javascript:void(0)">
							<div class="alert alert-danger" id="alert-danger-form">
							</div>
							<div class="alert alert-success" id="alert-success-form">
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="title">Title *</label>
										<input type="text" class="form-control" id="title" name="title" placeholder="">
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="display_order">Display Order</label>
										<input type="number" class="form-control" id="display_order" name="display_order" placeholder="">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="status">Description *</label>
										<textarea name="description" id="description" class="form-control"></textarea>
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="description">Is Lecture Free ?</label>
										<input type="radio" id="free" name="is_free" value="0" placeholder=""> Free
										<input type="radio" id="paid" name="is_free" value="1" placeholder=""> Paid
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="status">This Lecture is</label>
										<select class="js-example-basic-single form-control" name="status" id="status">
											<option value="Enabled">Active</option>
											<option value="Disabled">Inactive</option>
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
										<label for="duration_in_hour">Duration in hour</label>
										<input type="number" class="form-control" id="duration_in_hour" name="duration_in_hour" placeholder="">
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="video">Lecture Video *</label>
										<input type="file" class="form-control" id="video" name="video" placeholder="">
										<a href="#" download class="download">Download</a>
									</div>
								</div>
							</div>

							<input type="hidden" id="course_curriculam_id" name="course_curriculam_id" value="{{last(request()->segments())}}">
							<input type="hidden" id="curriculam_lecture_id" name="curriculam_lecture_id" value="">
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
