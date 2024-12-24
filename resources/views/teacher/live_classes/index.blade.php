@extends('layouts.app_theme')

@section('content')

<div class="coveradminalldata">
    <div class="main-contsleftright">
        <div class="leftdatamain_cover">
            <div class="quizmaindata-cover">
                @include ('messages')
                <div class="profset-title">
                    <h1>{{ $title }}</h1>
                    <p>Welcome to GORD Academy</p>
                </div>
                <div class="addadmsupbtnright">
                    <a href="javascript:void(0)" id="create-class">
                        <i class='bx bxs-plus-circle'></i> Create Live Class
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="recomcouryou-data">
                    <h2>Today's Class</h2>
                </div>
                @if(count($live_class) > 0)
                @foreach($live_class as $class)
                <div class="coursesdata-cover">
                    <div class="coursesdata-iner">
                        <?php
                        $url = $class->zoom_join_url;
                        $meeting_credentials = explode('?', $url);
                        
                        $password = '';
                        $mn = '';
                        if(isset($meeting_credentials[0]) && isset($meeting_credentials[1])){
                            $mn = str_replace('https://us05web.zoom.us/j/', '', $meeting_credentials[0]);
                            $password = str_replace('pwd=', '', $meeting_credentials[1]);
                        } 
                        ?>
                        <?php
                        $current_hour = date('H');
                        $time_from = $class->time_from;
                        $time_to = $class->time_to;
                        $current_date = strtotime(date('Y-m-d'));
                        $class_date = strtotime($class->date);

                        if (($current_hour >= $time_from && $current_hour <= $time_to) && $current_date == $class_date) {
                            $classd = 'live-class';
                            $zoom_link = 'join_meeting';
                            $text = 'Live Now';
                        } else if ($class_date < $current_date) {
                            $classd = 'offline-class';
                            $zoom_link = 'completed';
                            $text = 'Meeting Completed';
                        } else {
                            $classd = 'offline-class';
                            $zoom_link = 'not_started';
                            $text = 'Live at ' . $class->time_from . ':00';
                        }
                        ?>
                        <a href="<?php echo $class->zoom_start_url ?>" target="_blank">
                        <!-- <a href="javascript:void(0);" class="{{ $zoom_link }}" data-mn="{{ $mn }}" data-pwd="{{ $password }}" data-display_name="{{ auth()->user()->name }}" data-role="1" data-url="<?= url('/') . '/teacher/meeting?' ?>"> -->
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
                                <h5>By {{ $class->teacher->name }}</h5>
                                <div class="liveoff-datacov <?= $classd; ?>">
                                    <h6><span class="pulse"></span> {{ $text }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
                @else
                <p>No live classes available</p>
                @endif
            </div>
        </div>
    </div>
    <form class="navbar-form navbar-right" id="meeting_form" style="display:none">
        <div class="form-group">
            <input type="text" name="display_name" id="display_name" maxLength="100" placeholder="Name" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="text" name="meeting_number" id="meeting_number" value="82388002152" maxLength="200" style="width:150px" placeholder="Meeting Number" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="text" name="meeting_pwd" id="meeting_pwd" value="" style="width:150px" maxLength="32" placeholder="Meeting Password" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="meeting_email" id="meeting_email" value="" style="width:150px" maxLength="32" placeholder="Email option" class="form-control">
        </div>

        <div class="form-group">
            <select id="meeting_role" class="sdk-select">
                <option value=0>Attendee</option>
                <option value=1>Host</option>
                <option value=5>Assistant</option>
            </select>
        </div>
        <div class="form-group">
            <select id="meeting_china" class="sdk-select">
                <option value=0>Global</option>
                <option value=1>China</option>
            </select>
        </div>
        <div class="form-group">
            <select id="demoType" class="sdk-select">
                <option value='cdn'>CDN</option>
                <option value='local'>Local</option>
            </select>
        </div>
        <div class="form-group">
            <select id="meeting_lang" class="sdk-select">
                <option value="en-US">English</option>
                <option value="de-DE">German Deutsch</option>
                <option value="es-ES">Spanish Español</option>
                <option value="fr-FR">French Français</option>
                <option value="jp-JP">Japanese 日本語</option>
                <option value="pt-PT">Portuguese Portuguese</option>
                <option value="ru-RU">Russian Русский</option>
                <option value="zh-CN">Chinese 简体中文</option>
                <option value="zh-TW">Chinese 繁体中文</option>
                <option value="ko-KO">Korean 한국어</option>
                <option value="vi-VN">Vietnamese Tiếng Việt</option>
                <option value="it-IT">Italian italiano</option>
            </select>
        </div>

        <input type="hidden" value="" id="copy_link_value" />
        <button type="submit" class="btn btn-primary" id="clear_all">Clear</button>
        <button type="button" link="" onclick="window.copyJoinLink('#copy_join_link')" class="btn btn-primary" id="copy_join_link">Copy Direct join link</button>
    </form>
</div>
@include('teacher.live_classes.model')

<script>
    $(document).ready(function() {

        var table = $('.class_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('live_classes.index') }}",
            autoWidth: true,
            dom: 'Bfrtip',
            order: [
                [0, 'desc']
            ],
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
    var store = <?php echo json_encode(route('live_classes.store')) ?>;
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
@include('common.zoom.required_js')
<script src="{{ asset('public/js/additional/zoom/nav.js') }}"></script>
@endsection