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
                        <h3>Notes</h3><br><br>
                        <form id="noteform">
                            <div class="alert alert-danger" id="alert-danger-note">
                            </div>
                            <div class="alert alert-success" id="alert-success-note">
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="price">Note Title *</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="">
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
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="status">Type *</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="1">Personal Note</option>
                                            <option value="2">Class Note</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="status">Subject *</label>
                                        <select class="form-control" name="subject" id="subject">
                                            @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="note_id" name="note_id" value="">
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