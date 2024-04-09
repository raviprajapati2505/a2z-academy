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
						<h3>Course Quiz</h3><br><br>
						<form id="courses_quizform">
							<div class="alert alert-danger" id="alert-danger-form">
							</div>
							<div class="alert alert-success" id="alert-success-form">
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="">Question *</label>
										<input type="text" class="form-control" id="question" name="question" placeholder="">
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="">Option A</label>
										<input type="text" class="form-control" id="option_a" name="option_a" placeholder="">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="">Option B</label>
										<input type="text" class="form-control" id="option_b" name="option_b" placeholder="">
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="">Option C</label>
										<input type="text" class="form-control" id="option_c" name="option_c" placeholder="">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="">Option D</label>
										<input type="text" class="form-control" id="option_d" name="option_d" placeholder="">
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="status">Correct Answer</label>
										<select class="js-example-basic-single form-control" name="correct_answer" id="correct_answer">
											<option value="A">Option A</option>
											<option value="B">Option B</option>
											<option value="C">Option C</option>
											<option value="D">Option D</option>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="">Sorting</label>
										<input type="number" class="form-control" id="sorting" name="sorting" placeholder="">
									</div>
								</div>
								<div class="col-sm">
									<div class="form-group">
										<label for="status">This Course is</label>
										<select class="js-example-basic-single form-control" name="status" id="status">
											<option value="Enabled">Active</option>
											<option value="Disabled">Inactive</option>
										</select>
									</div>
								</div>
							</div>

							<input type="hidden" id="course_id" name="course_id" value="{{last(request()->segments())}}">
							<input type="hidden" id="courses_quiz_id" name="courses_quiz_id" value="">
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