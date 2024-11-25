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
                        <h3>Promocode Information</h3><br><br>
                        <form id="promocodeform">
                            <div class="alert alert-danger" id="alert-danger-form">
                            </div>
                            <div class="alert alert-success" id="alert-success-form">
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="">Promo Code *</label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="status">Discount Type</label>
                                        <select class="js-example-basic-single form-control" name="discount_type" id="discount_type">
                                            <option value="Percentage">Percentage</option>
                                            <option value="Fixed Amount">Fixed Amount</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="">Amount *</label>
                                        <input type="text" class="form-control" id="discount_amount" name="discount_amount" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="price">Code Valid Till *</label>
                                        <input type="text" name="valid_till" id="valid_till" class="form-control datepicker" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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

                            <input type="hidden" id="promocode_id" name="promocode_id" value="">
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