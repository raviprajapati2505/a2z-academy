@extends('layouts.app_theme')

@section('content')


<div class="proprofimaincov">
    <div class="quizmaindata-cover">
        @include ('messages')
        <div class="profset-title">
            <h1>{{ $title }}</h1>
            <!--  <p>Welcome to Newness Super Admin</p> -->
        </div>
        <div class="addadmsupbtnright">
            <a href="javascript:void(0)" id="create-assessments">
                <i class='bx bxs-plus-circle'></i> Add Assessment
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
                <table id="example" class="display table nowrap assessment_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Marks</th>
                            <th>Class Name</th>
                            <th>Learner Name</th>
                            <th>Subject</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.assessment.model')
</div>
<script>
    $(document).ready(function() {
        var table = $('.assessment_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('assessment.index') }}",
            autoWidth: true,
            dom: 'Bfrtip',
            order: [ [0, 'desc'] ],
            buttons: [{
                extend: 'excelHtml5',
                "action": newexportaction,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }, ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'marks',
                    name: 'marks'
                },
                {
                    data: 'class',
                    name: 'class'
                },
                {
                    data: 'student',
                    name: 'student'
                },
                {
                    data: 'subject',
                    name: 'subject'
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

        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });
    });
</script>
<script type="text/javascript">
    var store = <?php echo json_encode(route('assessment.store')) ?>;
    $('#alert-danger-form').hide();
    $('#alert-success-form').hide();
    $('#alert-success-list').hide();
    $('#alert-danger-list').hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $("#assessmentform").validate({
        ignore: [],
        rules: {
            "assessment_subject": {
                required: true,
            },
            "assessment_class": {
                required: true,
            },
            "student": {
                required: true,
            },
            "started_date": {
                required: true,
            },
            "expired_date": {
                required: true,
            },
            "marks": {
                required: true,
                min: 0,
                max: 100,
                number: true
            },
        },
        messages: {},
        submitHandler: function() {
            $.ajax({
                data: $('#assessmentform').serialize(),
                url: store,
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $('#alert-danger-form').hide();
                        $('#alert-success-form').show();
                        $('#alert-success-form').text(data.message);
                        $('.assessment_datatable').DataTable().draw(true);
                        setTimeout(function() {
                            $('#assessmentform').trigger("reset");
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
                    //$('#ajaxModel').modal('hide');
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
            return false;
        }
    });

    $('#create-assessments').click(function() {
        $('#assessment_id').val('');
        $('#assessment').trigger("reset");
        $('#ajaxModel').modal('show');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
    });

    $('body').on('click', '.edit-assessment', function() {
        var assessment_id = $(this).data('id');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
        $.get("{{ url('admin/'.$urlSlug.'/') }}" + '/' + assessment_id + '/edit', function(data) {
            var base_url = '<?php echo url('/'); ?>';
            $('#ajaxModel').modal('show');
            $('#assessment_id').val(data.data.id);
            $('#assessment_subject').val(data.data.subject_id).trigger('change');
            $('#teacher').val(data.data.teacher_id).trigger('change');
            $('#student').val(data.data.student_id).trigger('change');
            $('#assessment').val(data.data.assessment);
            $('#started_date').val(data.data.started_date);
            $('#expired_date').val(data.data.expired_date);
            $("#started_date").datepicker("setDate", data.data.started_date);
            $("#expired_date").datepicker("setDate", data.data.expired_date);
            $('#marks').val(data.data.marks);
        })
    });

    $('body').on('click', '.delete-assessment', function() {

        var assessment_id = $(this).data("id");

        $.ajax({
            type: "DELETE",
            beforeSend: function() {
                return confirm("Are you sure?");
            },
            url: "{{ url('admin/'.$urlSlug.'/') }}" + '/' + assessment_id,
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
