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
            <h3>Live Class Information</h3><br><br>
            <form method="POST" enctype="multipart/form-data" id="classform" action="javascript:void(0)">
              <div class="alert alert-danger" id="alert-danger-form">
              </div>
              <div class="alert alert-success" id="alert-success-form">
              </div>

              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="password">Title *</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="">Select Batch *</label>
                    <select class="js-example-basic-single form-control" name="class_class" id="class_class">
                      @foreach($classes as $class)
                      <option value="{{ $class->id }}">{{ $class->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="form-group">
                    <label for="">Select Subcategory *</label>
                    <select class="js-example-basic-single form-control" name="class_subject" id="class_subject">
                      @foreach($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="password">Image *</label>
                    <input type="file" class="form-control" id="image" name="image" placeholder="">
                    <a href="" download class="download">Download</a>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="form-group">
                    <label for="price">Select Date *</label>
                    <input type="text" name="date" id="date" class="form-control datepicker" placeholder="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="password">Select Time From *</label>
                    <select class="js-example-basic-single form-control" name="time_from" id="time_from">
                      <option value="01">01AM</option>
                      <option value="02">02AM</option>
                      <option value="03">03AM</option>
                      <option value="04">04AM</option>
                      <option value="05">05AM</option>
                      <option value="06">06AM</option>
                      <option value="07">07AM</option>
                      <option value="08">08AM</option>
                      <option value="09">09AM</option>
                      <option value="10">10AM</option>
                      <option value="11">11AM</option>
                      <option value="12">12PM</option>
                      <option value="13">01PM</option>
                      <option value="14">02PM</option>
                      <option value="15">03PM</option>
                      <option value="16">04PM</option>
                      <option value="17">05PM</option>
                      <option value="18">06PM</option>
                      <option value="19">07PM</option>
                      <option value="20">08PM</option>
                      <option value="21">09PM</option>
                      <option value="22">10PM</option>
                      <option value="23">11PM</option>
                      <option value="24">12PM</option>
                    </select>
                    <div class="time_from-custom-error"></div>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="form-group">
                    <label for="time_to">Time to *</label>
                    <select class="js-example-basic-single form-control" name="time_to" id="time_to">
                      <option value="01">01AM</option>
                      <option value="02">02AM</option>
                      <option value="03">03AM</option>
                      <option value="04">04AM</option>
                      <option value="05">05AM</option>
                      <option value="06">06AM</option>
                      <option value="07">07AM</option>
                      <option value="08">08AM</option>
                      <option value="09">09AM</option>
                      <option value="10">10AM</option>
                      <option value="11">11AM</option>
                      <option value="12">12PM</option>
                      <option value="13">01PM</option>
                      <option value="14">02PM</option>
                      <option value="15">03PM</option>
                      <option value="16">04PM</option>
                      <option value="17">05PM</option>
                      <option value="18">06PM</option>
                      <option value="19">07PM</option>
                      <option value="20">08PM</option>
                      <option value="21">09PM</option>
                      <option value="22">10PM</option>
                      <option value="23">11PM</option>
                      <option value="24">12PM</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="status">This Batch is</label>
                    <select class="js-example-basic-single form-control" name="status" id="status">
                      <option value="Enabled">Active</option>
                      <option value="Disabled">Inactive</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="status">More Information *</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group">
										<label for="description"></label>
										<input type="checkbox" id="select_all" name="select_all" value="0" placeholder=""> All Learner
									</div>
              </div>

              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="status">Select Learner</label>
                    <select class="js-example-basic-single form-control" multiple name="students[]" id="students">
                      @foreach($students as $student)
                      <option value="{{ $student->id }}">{{ $student->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <input type="hidden" id="class_id" name="class_id" value="">
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
