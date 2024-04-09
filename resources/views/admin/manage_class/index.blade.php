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
            <a href="javascript:void(0)" id="create-class">
                <i class='bx bxs-plus-circle'></i> Add Class
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
                <table id="example" class="display table nowrap class_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Instructor</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.manage_class.model')
</div>
<script>
    $(document).ready(function() {
        var table = $('.class_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('manage_class.index') }}",
            autoWidth: true,
            dom: 'Bfrtip',
            order: [ [0, 'desc'] ],
            buttons: [{
                extend: 'excelHtml5',
                "action": newexportaction,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }, ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'teacher',
                    name: 'teacher'
                },
                {
                    data: 'class',
                    name: 'class'
                },
                {
                    data: 'subject',
                    name: 'subject'
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false
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
    var store = <?php echo json_encode(route('manage_class.store')) ?>;
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

    $("#classform").validate({
        ignore: [],
        rules: {
            "title": {
                required: true,
            },
            "date": {
                required: true,
            },
            "time_from": {
                required: true,
            },
            "time_from": {
                required: true,
                lessThan: "#time_to"
            },
            "class_subject": {
                required: true,
            },
            "class_class": {
                required: true,
            },
            "teacher": {
                required: true,
            },
            "description": {
                required: true,
            },
            "image": {
                required: function(element) {
                    return $('#class_id').val() == '';
                },
                extension: "jpg|jpeg|png"
            }
        },
        messages: {
            "time_from": {
                lessThan: "Time-from should always lesser then To-time"
            },
            "image": {
                extension: "Allow file type is jpeg, png, jpg"
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "time_from")
                error.insertAfter(".time_from-custom-error");
            else
                error.insertAfter(element);
        },
        submitHandler: function() {
            var formData = new FormData(document.getElementById("classform"));
            $.ajax({
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
                        $('.class_datatable').DataTable().draw(true);
                        setTimeout(function() {
                            $('#classform').trigger("reset");
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

    $('#create-class').click(function() {
        $('#class_id').val('');
        $('#classform').trigger("reset");
        $('#ajaxModel').modal('show');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
        $('.download').hide();
    });

    $('body').on('click', '.edit-class', function() {
        var class_id = $(this).data('id');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
        $.get("{{ url('admin/'.$urlSlug.'/') }}" + '/' + class_id + '/edit', function(data) {
            var base_url = '<?php echo url('/'); ?>';
            $('#ajaxModel').modal('show');
            $('#class_id').val(data.data.id);
            $('#title').val(data.data.title);
            $('#status').val(data.data.status).trigger('change');
            $('#class_class').val(data.data.class_id).trigger('change');
            $('#class_subject').val(data.data.subject_id).trigger('change');
            $('#teacher').val(data.data.teacher_id).trigger('change');
            $('#date').val(data.data.date);
            $("#date").datepicker("setDate", data.data.date);
            $('#time_from').val(data.data.time_from).trigger('change');
            $('#time_to').val(data.data.time_to).trigger('change');
            $('#description').val(data.data.description);
            if (data.data.image) {
                $('.download').show();
                $('.download').attr('href', base_url + '/public/' + data.data.image)
            } else {
                $('.download').hide();
            }
            $("#students").val('').trigger("change");
            // $("#students option").each(function() {
            //     $(this).prop("selected", false);
            // });
            if (data.data.students.length > 0) {
                var std_arr = []
                $.each(data.data.students, function(key, val) {
                    //$("#students option[value='" + val.id + "']").prop("selected", true);
                    std_arr.push(val.id);
                });
                $("#students").val(std_arr).trigger("change");
            }
        })
    });

    $('body').on('click', '.delete-class', function() {

        var class_id = $(this).data("id");

        $.ajax({
            type: "DELETE",
            beforeSend: function() {
                return confirm("Are you sure?");
            },
            url: "{{ url('admin/'.$urlSlug.'/') }}" + '/' + class_id,
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

    $("#select_all").click(function() {
        if ($("#select_all").is(':checked')) {
            $("#students > option").prop("selected", "selected");
            $("#students").trigger("change");
        } else {
            $("#students").val('').trigger("change");
        }
    });
</script>

@endsection
