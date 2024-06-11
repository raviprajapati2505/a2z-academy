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
            <a href="javascript:void(0)" id="create-course">
                <i class='bx bxs-plus-circle'></i> Add course
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
                <table id="example" class="display table nowrap course_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course Name</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.manage_course.model')
</div>
<script>
    $(document).ready(function() {
        var table = $('.course_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('manage_course.index') }}",
            autoWidth: true,
            dom: 'Bfrtip',
            order: [
                [0, 'desc']
            ],
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
                    data: 'class',
                    name: 'class'
                },
                {
                    data: 'subject',
                    name: 'subject'
                },
                {
                    data: 'price',
                    name: 'price'
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

        CKEDITOR.config.allowedContent = true;
        CKEDITOR.replace('what_you_learn');
        CKEDITOR.replace('instructor_infromation');
    });
</script>
<script type="text/javascript">
    var store = <?php echo json_encode(route('manage_course.store')) ?>;
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

    $("#courseform").validate({
        rules: {
            "name": {
                required: true,
                minlength: 1,
                maxlength: 20,
                pattern: '^[a-zA-Z ]+$'
            },
            "course_class": {
                required: true,
            },
            "course_subject": {
                required: true,
            },
            "is_paid": {
                required: true,
            },
            // "teacher": {
            //     required: true,
            // },
            "description": {
                required: true,
            },
            "cover_image": {
                required: function(element) {
                    return $('#course_id').val() == '';
                },
                extension: "jpg|jpeg|png"
            },
            "video": {
                required: function(element) {
                    return $('#course_id').val() == '';
                },
                extension: "mov|mp4|mkv|flv|avi"
            }
        },
        messages: {
            "cover_image": {
                extension: "Allow file type is jpeg, png, jpg"
            },
            "video": {
                extension: "Allow file type is mov, mp4, mkv, flv, avi"
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "is_paid")
                error.insertAfter(".paid-custom-error");
            else
                error.insertAfter(element);
        },
        submitHandler: function() {
            var formData = new FormData(document.getElementById("courseform"));
            formData.append('what_you_learn', CKEDITOR.instances['what_you_learn'].getData());
            formData.append('instructor_infromation', CKEDITOR.instances['instructor_infromation'].getData());
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
                        $('.course_datatable').DataTable().draw(true);
                        setTimeout(function() {
                            $('#courseform').trigger("reset");
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

    $('#create-course').click(function() {
        $('#course_id').val('');
        $('#courseform').trigger("reset");
        $('#ajaxModel').modal('show');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
        $('.download').hide();
        $('.downloadi').hide();
    });

    $('input[type=radio][name=is_paid]').change(function() {
        if (this.value == '0') {
            $('.pricediv').hide();
        } else {
            $('.pricediv').show();
        }
    })

    $('body').on('click', '.edit-course', function() {
        var course_id = $(this).data('id');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
        $.get("{{ url('admin/'.$urlSlug.'/') }}" + '/' + course_id + '/edit', function(data) {
            var base_url = '<?php echo url('/'); ?>';
            $('#ajaxModel').modal('show');
            $('#course_id').val(data.data.id)
            $('#name').val(data.data.name);
            $('#description').val(data.data.description);
            //$('#instructor_infromation').val(data.data.instructor_infromation);
            CKEDITOR.instances.what_you_learn.setData(data.data.what_you_learn)
            CKEDITOR.instances.instructor_infromation.setData(data.data.instructor_infromation)
            //$('#what_you_learn').val(data.data.what_you_learn);
            $('#short_description').val(data.data.short_description);
            $('#link').val(data.data.link);
            $('#type').val(data.data.course_type_id).trigger('change');
            $('#price').val(data.data.price);
            $('#special_price').val(data.data.special_price);
            $('#language').val(data.data.language);
            $('#ceu_points').val(data.data.ceu_points);
            $('#status').val(data.data.status).trigger('change');
            $('#course_class').val(data.data.class_id).trigger('change');
            $('#course_subject').val(data.data.subject_id).trigger('change');
            
            //$('#teacher').val(data.data.teacher_id).trigger('change');
            $("input[name=is_paid][value=" + data.data.is_paid + "]").prop('checked', true);
            if (data.data.cover_image) {
                $('.downloadi').show();
                $('.downloadi').attr('href', base_url + '/public/' + data.data.cover_image)
            }
            if (data.data.video) {
                $('.download').show();
                $('.download').attr('href', base_url + '/public/' + data.data.video)
            }
            if (data.data.is_paid == '0') {
                $('.pricediv').hide();
            } else {
                $('.pricediv').show();
            }
        })
    });

    $('body').on('click', '.delete-course', function() {

        var course_id = $(this).data("id");

        $.ajax({
            type: "DELETE",
            beforeSend: function() {
                return confirm("Are you sure?");
            },
            url: "{{ url('admin/'.$urlSlug.'/') }}" + '/' + course_id,
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