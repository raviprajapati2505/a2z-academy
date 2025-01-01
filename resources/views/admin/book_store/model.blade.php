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
                        <h3>Book Information</h3><br><br>
                        <form method="POST" enctype="multipart/form-data" id="bookform" action="javascript:void(0)">
                            <div class="alert alert-danger" id="alert-danger-form">
                            </div>
                            <div class="alert alert-success" id="alert-success-form">
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="name">Book Name *</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="name">Book Author *</label>
                                        <input type="text" class="form-control" id="author" name="author" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="video">Book Preview File *</label>
                                    <input type="file" class="form-control" id="book_file" name="book_file" placeholder="">
                                    <a href="#" download class="downloadfile">Download</a>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="password">Cover Image *</label>
                                        <input type="file" class="form-control" id="cover_image" name="cover_image" placeholder="">
                                        <a href="#" download class="download">Download</a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="name">Purchased External link</label>
                                        <input type="text" class="form-control" id="external_link" name="external_link" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="status">This Book is</label>
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
                                        <label for="name">Price ($)</label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="book_id" name="book_id" value="">
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