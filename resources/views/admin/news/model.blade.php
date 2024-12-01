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
                        <form method="POST" enctype="multipart/form-data" id="newsform" action="javascript:void(0)">
                            <div class="alert alert-danger" id="alert-danger-form">
                            </div>
                            <div class="alert alert-success" id="alert-success-form">
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="name">Title *</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="password">Image *</label>
                                        <input type="file" class="form-control" id="image" name="image" placeholder="">
                                        <a href="#" download class="download">Download</a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="description">Description*</label>
                                        <textarea class="form-control" id="description" name="description" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="news_id" name="news_id" value="">
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