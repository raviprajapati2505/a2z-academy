<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="userprofalldata-full" style="overflow:auto;height:500px">

                    <div class="userprofalldata-iner model-form">
                        <h3>Course Information</h3><br><br>
                        <form method="POST" enctype="multipart/form-data" id="courseform" action="javascript:void(0)">
                            <div class="alert alert-danger" id="alert-danger-form">
                            </div>
                            <div class="alert alert-success" id="alert-success-form">
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="name">Course Name *</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="">Select Category</label>
                                        <select class="js-example-basic-single form-control" name="type" id="type">
                                            @foreach($course_type as $type)
                                            <option value="{{ $type->id }}">{{ $type->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="description">Course is ?</label>
                                        <input type="radio" id="free" name="is_paid" value="0" placeholder=""> Free
                                        <input type="radio" id="paid" name="is_paid" value="1" placeholder=""> Paid
                                    </div>
                                    <div class="paid-custom-error"></div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="password">Cover Image <small>(dimention prefer 700 x 600)</small> <small>(size prefer 5MB max)</small> *</label>
                                        <input type="file" class="form-control" id="cover_image" name="cover_image" placeholder="">
                                        <a href="#" download class="downloadi">Download</a>
                                    </div>
                                </div>
                            </div>

                            <div class="row pricediv">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="price">Course Price</label>
                                        <input type="number" class="form-control" id="price" name="price" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="price">Special Price</label>
                                        <input type="number" class="form-control" id="special_price" name="special_price" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="link">Recorded Course Link</label>
                                        <input type="text" class="form-control" id="link" name="link" placeholder="https://www.youtube.com/embed/tL5sYdlk20I">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="video">Course Video</label>
                                        <input type="file" class="form-control" id="video" name="video" placeholder="">
                                        <a href="#" download class="download">Download</a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="">Select Batch *</label>
                                        <select class="js-example-basic-single form-control" name="course_class" id="course_class">
                                            @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="">Select Subcategory *</label>
                                        <select class="js-example-basic-single form-control" name="course_subject" id="course_subject">
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
                                        <label for="status">This Course is</label>
                                        <select class="js-example-basic-single form-control" name="status" id="status">
                                            <option value="Enabled">Active</option>
                                            <option value="Disabled">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="name">Language</label>
                                        <input type="text" class="form-control" id="language" name="language" placeholder="">
                                    </div>
                                </div>
                                <!-- <div class="col-sm">
                  <div class="form-group">
                    <label for="teacher">Select Instructor *</label>
                    <select class="js-example-basic-single form-control" name="teacher" id="teacher">
                      @foreach($teachers as $teacher)
                      <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div> -->
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="description">Study Materials</label>
                                        <input type="file" class="form-control" id="materials" name="materials[]" placeholder="" multiple>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="name">Learning Hours (LH) Points</label>
                                        <input type="text" class="form-control" id="ceu_points" name="ceu_points" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="child_category">Select Sub-subcategory</label>
                                        <select class="js-example-basic-single form-control" name="child_category" id="child_category">
                                            @foreach($child_category as $type)
                                            <option value="{{ $type->id }}">{{ $type->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="">Select Delivery Mode</label>
                                        <select class="js-example-basic-single form-control" name="delivery_mode" id="delivery_mode">
                                            @foreach($delivery_modes as $type)
                                            <option value="{{ $type->id }}">{{ $type->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="description">Course Description <small>(200 characters)</small> *</label>
                                        <textarea class="form-control" id="description" name="description" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="description">Short Description</label>
                                        <textarea class="form-control" id="short_description" name="short_description" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="description">What you will learn</label>
                                        <textarea class="form-control what_you_learn" id="what_you_learn" name="what_you_learn" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="description">Course Instructor Information</label>
                                        <textarea class="form-control" id="instructor_infromation" name="instructor_infromation" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="course_id" name="course_id" value="">
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