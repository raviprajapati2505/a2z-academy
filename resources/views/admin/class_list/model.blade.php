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
						<h3>Class List</h3><br><br>
						<form id="class_listform">
							<div class="alert alert-danger" id="alert-danger-form">
							</div>
							<div class="alert alert-success" id="alert-success-form">
							</div>

							<div class="row">
								<div class="col-sm">
									<div class="form-group">
										<label for="">Name *</label>
										<input type="text" class="form-control" id="name" name="name" placeholder="">
									</div>
								</div>
							</div>

							<input type="hidden" id="class_list_id" name="class_list_id" value="">
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