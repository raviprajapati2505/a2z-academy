@extends('layouts.app_theme')

@section('content')

<div class="coveradminalldata">
    <div class="main-contsleftright">
        <div class="leftdatamain_cover">
            <div class="quizmaindata-cover">
                @include ('messages')
                <div class="profset-title">
                    <h1>{{ $title }}</h1>
                    <p>Welcome to Gord Academy</p>
                </div>
                <div class="addadmsupbtnright">
                    <a href="javascript:void(0)" id="create-class">
                        <i class='bx bxs-plus-circle'></i> Add New Class
                    </a>
                </div>
            </div><br><br>
            <div class="row">
                <div class="recomcouryou-data">
                    <h2>Today's Class</h2>
                </div>
                @if(count($my_classes) > 0)
                @foreach($my_classes as $class)
                <div class="coursesdata-cover">
                    <div class="coursesdata-iner">
                        <a href="javascript:void(0);">
                            <div class="coursesdata-img">
                                <div class="retclass">
                                    <h5>3.5 <i class='bx bxs-star'></i></h5>
                                </div>
                                @if($class->image)
                                <img src="<?= url('/') . '/public/' . $class->image ?>">
                                @else
                                <!-- default image class -->
                                <img src="{{ asset('public/images/my-courses-img9.jpg') }}" alt="Allie Grater">
                                @endif
                            </div>
                            <div class="coursesdata-livetext">
                                <h3>{{ $class->title }}</h3>
                                <h5>By Sirena Robertson</h5>
                                <div class="liveoff-datacov offline-class">
                                    <h6><span class="pulse"></span> Live at {{ $class->time_from}}:00</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
                @else
                <p>No classes available</p>
                @endif
            </div>
            <div class="row">
                <div class="recomcouryou-data">
                    <h2>Last week's Class</h2>
                </div>
                @if(count($last_week_class) > 0)
                    @foreach($last_week_class as $class)
                    <div class="coursesdata-cover">
                        <div class="coursesdata-iner">
                            <a href="javascript:void(0);">
                                <div class="coursesdata-img">
                                    <div class="retclass">
                                        <h5>3.5 <i class='bx bxs-star'></i></h5>
                                    </div>
                                    @if($class->image)
                                    <img src="<?= url('/') . '/public/' . $class->image ?>">
                                    @else
                                    <!-- default image class -->
                                    <img src="{{ asset('public/images/my-courses-img9.jpg') }}" alt="Allie Grater">
                                    @endif
                                </div>
                                <div class="coursesdata-livetext">
                                    <h3>{{ $class->title }}</h3>
                                    <h5>By Sirena Robertson</h5>
                                    <div class="liveoff-datacov offline-class">
                                        <h6><span class="pulse"></span> Live at {{ $class->time_from}}:00</h6>
                                    </div>
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
        @include('teacher.right_sidebar')
    </div>
</div>
@include('teacher.manage_classes.model')
<script>
    $(document).ready(function() {

        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });
    });
</script>
<script type="text/javascript">
    var store = <?php echo json_encode(route('manage_classes.store')) ?>;
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
                lessThan: "#time_to"
            },
            "time_to": {
                required: true,
            },
            "class_subject": {
                required: true,
            },
            "class_class": {
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
        $.get("{{ url('teacher/'.$urlSlug.'/') }}" + '/' + class_id + '/edit', function(data) {
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
            $('#type').val(data.data.course_type_id).trigger('change');
            $('#child_category').val(data.data.child_category_id).trigger('change');
            if (data.data.image) {
                $('.download').show();
                $('.download').attr('href', base_url + '/public/' + data.data.image)
            } else {
                $('.download').hide();
            }
            $("#students").val('').trigger("change");
            if (data.data.students.length > 0) {
                var std_arr = []
                $.each(data.data.students, function(key, val) {
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
            url: "{{ url('teacher/'.$urlSlug.'/') }}" + '/' + class_id,
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