<div class="rightdatamain_cover">
    <div class="proficurrent-datacover">
        <div class="proficurrent-prof">
            @if(auth()->user()->photo)
            <img src="<?= url('/') . '/public/' ?>{{ auth()->user()->photo }}">
            @else
            <!-- default image profile -->
            <img src="{{ asset('public/images/user-icon.png') }}" alt="Allie Grater">
            @endif
            <h3>{{ Auth::user()->name.' '.Auth::user()->lastname }}</h3>
        </div>
        <div class="videoandcurrent-title">
            <h3>Note</h3>
            <a href="Javascript:void(0);" id="create-note">Add Note</a>
        </div>
        <div class="activitydata-cover">
            @if($notes)
            @foreach($notes as $note)
            <div class="activitydata-iner">
                <div class="media-left bgcolor1">
                    <img src="{{ asset('public/images/edit-icon.png') }}">
                </div>
                <div class="media-body">
                    <h4>{{ $note->title }}</h4>
                    <p>{{ substr_replace($note->description, "...", 20) }}</p>
                </div>
            </div>
            @endforeach
            @endif

        </div>

        <div class="videoandcurrent-title">
            <h3>Upcoming Class</h3>
            <a href="Javascript:void(0);">View All</a>
        </div>
        @if(count($upcoming_class) > 0)
        @foreach($upcoming_class as $class)
        <div class="videocoureslist-cover">
            <div class="videocoureslist-iner">
                <a href="Javascript:void(0);">
                    <div class="videocoureslist-left">
                        @if($class->image)
                        <img src="<?= url('/') . '/public/' . $class->image ?>">
                        @else
                        <!-- default image class -->
                        <img src="{{ asset('public/images/my-courses-img9.jpg') }}" alt="Allie Grater">
                        @endif
                    </div>
                    <div class="videocoureslist-right">
                        <h3>{{ $class->title }}</h3>
                        <p>{{ $class->date }} {{ $class->time_from }}:00</p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
        @else
                <p>No classes available</p>
        @endif
    </div>
</div>

<div class="modal fade" id="noteModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="userprofalldata-full">

                    <div class="userprofalldata-iner model-form">
                        <h3>Add Note</h3><br><br>
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
                                        <textarea name="description" id="description_note" class="form-control"></textarea>
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
                                        <label for="status">Sub-Category</label>
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

<script type="text/javascript">
    var storess = <?php echo json_encode(route('notes.store')) ?>;
    $('#alert-danger-note').hide();
    $('#alert-success-note').hide();
    $('#alert-success-list').hide();
    $('#alert-danger-list').hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $("#noteform").validate({
        ignore: [],
        rules: {
            "title": {
                required: true,
            },
            "description_note": {
                required: true,
            },
        },
        messages: {},
        submitHandler: function() {
            $.ajax({
                data: $('#noteform').serialize(),
                url: storess,
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $('#alert-danger-note').hide();
                        $('#alert-success-note').show();
                        $('#alert-success-note').text(data.message);
                        setTimeout(function() {
                            window.location.reload()
                        }, 3000);
                    } else if (data.message == 'Error validation') {
                        $('#alert-success-note').hide();
                        $('#alert-danger-note').show();
                        for (var key in data.data) {
                            var value = data.data[key];
                            $('#alert-danger-note').text(value[0]);
                        }
                    } else {
                        $('#alert-success-note').hide();
                        $('#alert-danger-note').show();
                        $('#alert-danger-note').text(data.message);
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
            return false;
        }
    });

    $('#create-note').click(function() {
        $('#note_id').val('');
        $('#noteform').trigger("reset");
        $('#noteModel').modal('show');
        $('#alert-danger-note').hide();
        $('#alert-success-note').hide();
    });
</script>