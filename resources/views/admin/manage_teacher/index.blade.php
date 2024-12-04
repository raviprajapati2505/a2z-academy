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
            <a href="javascript:void(0)" id="create-teacher">
                <i class='bx bxs-plus-circle'></i> Add Instructor
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
                <table id="example" class="display table nowrap user_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Instructor Name</th>
                            <th>Email Address</th>
                            <th>Mobile Number</th>
                            <th>Batch</th>
                            <th>Sub-Category</th>
                            <th>Status</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.manage_teacher.model')
</div>
<script>
    $(document).ready(function() {
        var table = $('.user_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('manage_teacher.index') }}",
            autoWidth: true,
            dom: 'Bfrtip',
            order: [ [0, 'desc'] ],
            buttons: [{
                extend: 'excelHtml5',
                "action": newexportaction,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            }, ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
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
    });
</script>
<script type="text/javascript">
    var store = <?php echo json_encode(route('manage_teacher.store')) ?>;
    $('#alert-danger-form').hide();
    $('#alert-success-form').hide();
    $('#alert-success-list').hide();
    $('#alert-danger-list').hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $("#userform").validate({
        ignore: [],
        rules: {
            "name": {
                required: true,
                minlength: 1,
                maxlength: 100,
                pattern: '^[a-zA-Z ]+$'
            },
            "username": {
                required: true,
            },
            "email": {
                required: true,
                email: true
            },
            "contact": {
                required: false,
                digits: true,
                minlength: 10,
            },
            "password": {
                required: function(element) {
                    return $('#teacher_id').val() == '';
                },
                minlength: 8,
                pattern: '^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%&*])[a-zA-Z0-9!@#$%&*]+$'
            },
            "confirm_password": {
                required: function(element) {
                    return $('#teacher_id').val() == '';
                },
                equalTo: "#password"
            },
            "teacher_class":{
                required: true,
            },
            "teacher_subject":{
                required: true,
            }
        },
        messages: {
            "name": {
                pattern: "name should be only alphabet characters"
            },
            "email": {
                required: "Please, enter a email"
            },
            "password": {
                pattern: "Password should contain one uppercase, one lowercase, one special characters, and one numeric value"
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "gender")
                error.insertAfter(".gender-custom-error");
            else
                error.insertAfter(element);
        },
        submitHandler: function() {
            $.ajax({
                data: $('#userform').serialize(),
                url: store,
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $('#alert-danger-form').hide();
                        $('#alert-success-form').show();
                        $('#alert-success-form').text(data.message);
                        $('.user_datatable').DataTable().draw(true);
                        setTimeout(function() {
                            $('#userform').trigger("reset");
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

    $('#create-teacher').click(function() {
        $('#teacher_id').val('');
        $('#userform').trigger("reset");
        $('#ajaxModel').modal('show');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
    });

    $('body').on('click', '.edit-teacher', function() {
        var teacher_id = $(this).data('id');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
        $.get("{{ url('admin/'.$urlSlug.'/') }}" + '/' + teacher_id + '/edit', function(data) {
            $('#ajaxModel').modal('show');
            $('#teacher_id').val(data.data.id);
            $('#name').val(data.data.name);
            $('#username').val(data.data.username);
            $('#email').val(data.data.email);
            $('#contact').val(data.data.phone);
            $('#status').val(data.data.status).trigger('change');
            $('#teacher_class').val(data.data.class_id).trigger('change');
            $('#teacher_subject').val(data.data.subject_id).trigger('change');
        })
    });

    $('body').on('click', '.delete-teacher', function() {

        var teacher_id = $(this).data("id");

        $.ajax({
            type: "DELETE",
            beforeSend: function() {
                return confirm("Are you sure?");
            },
            url: "{{ url('admin/'.$urlSlug.'/') }}" + '/' + teacher_id,
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
