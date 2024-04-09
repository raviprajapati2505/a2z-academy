@extends('layouts.app_theme')

@section('content')


<div class="proprofimaincov">
    <div class="quizmaindata-cover">
        @include ('messages')
        <div class="profset-title">
            <h1>{{ $title }}</h1>
            <p>{{ $course_curriculam->course->name }} => {{ $course_curriculam->title }}</p>
            <!--  <p>Welcome to Newness Super Admin</p> -->
        </div>
        <div class="addadmsupbtnright">
            <a href="javascript:void(0)" id="create-curriculam-lecture">
                <i class='bx bxs-plus-circle'></i> Add Curriculam Lecture
            </a>
        </div>
    </div>
    <div class="mainquizans-cover">
        <div class="supadmmain_cover">
            <div class="supadmmain_maintbl">
                <div class="alert alert-danger" id="alert-danger-list">
                </div>
                <div class="alert alert-success" id="alert-success-list">
                </div>
                <table id="example" class="display table nowrap curriculam_lecture_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" id="course_curriculam_id" name="course_curriculam_id" value="{{last(request()->segments())}}">
    @include('admin.curriculam_lecture.model')
</div>
<script>
    $(document).ready(function() {
        var table = $('.curriculam_lecture_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('curriculam_lecture.index') }}",
                "data": function(d) {
                    d.course_curriculam_id = $('#course_curriculam_id').val();
                }
            },
            autoWidth: true,
            dom: 'Bfrtip',
            order: [
                [0, 'desc']
            ],
            buttons: [{
                extend: 'excelHtml5',
                "action": newexportaction,
                exportOptions: {
                    columns: [0, 1]
                }
            }, ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        function newexportaction(e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function(e, s, data) {
                // Just this once, load all data from the server...
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function(e, settings) {
                    // Call the original action function
                    if (button[0].className.indexOf('buttons-excel') >= 0) {
                        $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                        $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                    }
                    dt.one('preXhr', function(e, s, data) {
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    setTimeout(dt.ajax.reload, 0);
                    return false;
                });
            });
            dt.ajax.reload();
        }
    });
</script>
<script type="text/javascript">
    var store = <?php echo json_encode(route('curriculam_lecture.store')) ?>;
    $('#alert-danger-form').hide();
    $('#alert-success-form').hide();
    $('#alert-success-list').hide();
    $('#alert-danger-list').hide();
    $('.download').hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $("#curriculam_lectureform").validate({
        ignore: [],
        rules: {
            "title": {
                required: true,
            },
            "teacher": {
                required: true,
            },
            "description": {
                required: true,
            },
            "duration_in_hour": {
                required: true,
            },
            "status": {
                required: true,
            },
            "video": {
                required: function(element) {
                    return $('#curriculam_lecture_id').val() == '';
                },
                extension: "mov|mp4|mkv|flv|avi"
            }
        },
        messages: {},
        submitHandler: function() {
            var formData = new FormData(document.getElementById("curriculam_lectureform"));
            $.ajax({
                url: store,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.success) {
                        $('#alert-danger-form').hide();
                        $('#alert-success-form').show();
                        $('#alert-success-form').text(data.message);
                        $('.curriculam_lecture_datatable').DataTable().draw(true);
                        setTimeout(function() {
                            $('#curriculam_lectureform').trigger("reset");
                            $('#ajaxModel').modal('hide');
                        }, 2000);
                    } else if (data.message == 'Error validation') {
                        $('#alert-success-form').hide();
                        $('#alert-danger-form').show();
                        for (var key in data.data) {
                            var value = data.data[key];
                            $('#alert-danger-form').text(value[0]);
                        }
                    } else {
                        $('#alert-success-form').hide();
                        $('#alert-danger-form').show();
                        $('#alert-danger-form').text(data.message);
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

    $('#create-curriculam-lecture').click(function() {
        $('#curriculam_lecture_id').val('');
        $('#curriculam_lectureform').trigger("reset");
        $('#ajaxModel').modal('show');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
        $('.download').hide();
    });

    $('body').on('click', '.edit-curriculam-lecture', function() {
        var curriculam_lecture_id = $(this).data('id');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
        $.get("{{ url('admin/'.$urlSlug.'/') }}" + '/' + curriculam_lecture_id + '/edit', function(data) {
            var base_url = '<?php echo url('/'); ?>';
            $('#ajaxModel').modal('show');
            $('#curriculam_lecture_id').val(data.data.id);
            $('#title').val(data.data.title);
            $('#status').val(data.data.status);
            $('#duration_in_hour').val(data.data.duration_in_hour);
            $('#display_order').val(data.data.display_order);
            $('#description').val(data.data.description);
            $('#teacher').val(data.data.teacher_id).trigger('change');
            $("input[name=is_free][value=" + data.data.is_free + "]").prop('checked', true);
            if (data.data.video) {
                $('.download').show();
                $('.download').attr('href', base_url + '/public/' + data.data.video)
            }
        })
    });

    $('body').on('click', '.delete-curriculam-lecture', function() {

        var curriculam_lecture_id = $(this).data("id");

        $.ajax({
            type: "DELETE",
            beforeSend: function() {
                return confirm("Are you sure?");
            },
            url: "{{ url('admin/'.$urlSlug.'/') }}" + '/' + curriculam_lecture_id,
            success: function(data) {
                $('#alert-success-list').show();
                $('#alert-success-list').text(data.message);
                setTimeout(function() {
                    window.location.reload()
                }, 3000);

            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });
</script>

@endsection