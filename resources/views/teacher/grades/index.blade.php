@extends('layouts.app_theme')

@section('content')

<div class="coveradminalldata">
    <div class="main-contsleftright">
        <div class="leftdatamain_cover">
            <div class="quizmaindata-cover">
                @include ('messages')
                <div class="profset-title">
                    <h1>{{ $title }}</h1>
                    <!--  <p>Welcome to Newness Super Admin</p> -->
                </div>
                <div class="addadmsupbtnright">
                    <a href="javascript:void(0)" id="create-grade">
                        <i class='bx bxs-plus-circle'></i> Add Grade
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
                        <table id="example" class="display table nowrap grade_datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Grade</th>
                                    <th>Learner Name</th>
                                    <th>Sub-Category</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('teacher.right_sidebar')
    </div>
</div>
@include('teacher.grades.model')
<script>
    $(document).ready(function() {
        var table = $('.grade_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('grades.index') }}",
            autoWidth: true,
            order: [ [0, 'desc'] ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'grade',
                    name: 'grade'
                },
                {
                    data: 'student',
                    name: 'student'
                },
                {
                    data: 'subject',
                    name: 'subject'
                }
            ]
        });
    });
</script>
<script type="text/javascript">
    var store = <?php echo json_encode(route('grades.store')) ?>;
    $('#alert-danger-form').hide();
    $('#alert-success-form').hide();
    $('#alert-success-list').hide();
    $('#alert-danger-list').hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $("#gradeform").validate({
        ignore: [],
        rules: {
            "grade_subject": {
                required: true,
            },
            "student": {
                required: true,
            },
            "grade": {
                required: true,
            },
        },
        messages: {},
        submitHandler: function() {
            $.ajax({
                data: $('#gradeform').serialize(),
                url: store,
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $('#alert-danger-form').hide();
                        $('#alert-success-form').show();
                        $('#alert-success-form').text(data.message);
                        $('.grade_datatable').DataTable().draw(true);
                        setTimeout(function() {
                            $('#gradeform').trigger("reset");
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

    $('#create-grade').click(function() {
        $('#grade_id').val('');
        $('#gradeform').trigger("reset");
        $('#ajaxModel').modal('show');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
    });

    $('body').on('click', '.edit-grade', function() {
        var grade_id = $(this).data('id');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
        $.get("{{ url('teacher/'.$urlSlug.'/') }}" + '/' + grade_id + '/edit', function(data) {
            var base_url = '<?php echo url('/'); ?>';
            $('#ajaxModel').modal('show');
            $('#grade_id').val(data.data.id);
            $('#grade_subject').val(data.data.subject_id).trigger('change');
            $('#student').val(data.data.student_id).trigger('change');
            $('#grade').val(data.data.grade).trigger('change');

        })
    });

    $('body').on('click', '.delete-grade', function() {

        var grade_id = $(this).data("id");

        $.ajax({
            type: "DELETE",
            beforeSend: function() {
                return confirm("Are you sure?");
            },
            url: "{{ url('teacher/'.$urlSlug.'/') }}" + '/' + grade_id,
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
