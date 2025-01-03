@extends('layouts.app_theme')

@section('content')


<div class="proprofimaincov">
    <div class="quizmaindata-cover">
        @include ('messages')
        <div class="profset-title">
            <h1>Enrollment Report</h1>
            <!--  <p>Welcome to Newness Super Admin</p> -->
        </div>
    </div>
    <div class="mainquizans-cover">
        <div class="supadmmain_cover">
            <div class="supadmmain_maintbl">
                <div class="row">
                    <div class="col-md-2"><label><b>From Date</b> </label>&nbsp;&nbsp;<input type="date" name="from_date" id="from_date" class="form-control"></div>
                    <div class="col-md-2"><label><b>To Date</b> </label>&nbsp;&nbsp;<input type="date" name="to_date" id="to_date" class="form-control"></div>
                    <div class="col-md-2"><label><b>Course</b> </label>&nbsp;&nbsp;
                        <select class="form-control" name="course" id="course">
                            <option value="">Select</option>
                            @foreach($courses as $course)
                            <option value="{{$course->id}}">{{$course->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"><label><b>Category</b> </label>&nbsp;&nbsp;
                        <select class="form-control" name="course_type" id="course_type">
                            <option value="">Select</option>
                            @foreach($course_type as $type)
                            <option value="{{$type->id}}">{{$type->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"><label><b>Sub-Category</b> </label>&nbsp;&nbsp;
                        <select class="form-control" name="subject" id="subject">
                            <option value="">Select</option>
                            @foreach($subjects as $sub)
                            <option value="{{$sub->id}}">{{$sub->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"><label><b>Batch</b> </label>&nbsp;&nbsp;
                        <select class="form-control" name="class" id="class">
                            <option value="">Select</option>
                            @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br><br><br>
                    <div class="col-md-2"><label><b>Instructor</b> </label>&nbsp;&nbsp;
                        <select class="form-control" name="instructor" id="instructor">
                            <option value="">Select</option>
                            @foreach($instructors as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"><label><b>Delivery Mode</b> </label>&nbsp;&nbsp;
                        <select class="form-control" name="delivery_mode" id="delivery_mode">
                            <option value="">Select</option>
                            @foreach($delivery_modes as $delivery)
                            <option value="{{$delivery->id}}">{{$delivery->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"><label><b>Learners</b> </label>&nbsp;&nbsp;
                        <select class="form-control" name="learners" id="learners">
                            <option value="">Select</option>
                            @foreach($learners as $learn)
                            <option value="{{$learn->id}}">{{$learn->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"><a class="btn btn-primary btn-xs" id="filter_data">Filter</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-primary btn-xs" id="reset_data">Reset</a></div>
                </div>
                <br>
                <table id="example" class="display table nowrap enrollment_datatable">
                    <thead>
                        <tr>
                            <th>Learner Name</th>
                            <th>Course Name</th>
                            <th>Course Price</th>
                            <th>Course Purchased At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        var table = $('.enrollment_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('admin/report/total_enrollment_report') }}",
                "type": "GET",
                "data": function(d) {
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                    d.subject = $('#subject').val();
                    d.class = $('#class').val();
                    d.course = $('#course').val();
                    d.course_type = $('#course_type').val();
                    d.instructor = $('#instructor').val();
                    d.delivery_mode = $('#delivery_mode').val();
                    d.learners = $('#learners').val();
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
                    columns: [0, 1, 2, 3]
                }
            }, ],
            columns: [{
                    data: 'firstname',
                    name: 'firstname'
                }, {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'purchased_date',
                    name: 'purchased_date'
                },
            ]
        });

        $('#filter_data').click(function() {
            table.ajax.reload();
        })
        $('#reset_data').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#subject').val('');
            $('#class').val('');
            $('#course').val('');
            $('#course_type').val('');
            $('#instructor').val('');
            $('#delivery_modes').val('');
            $('#learners').val('');
            table.ajax.reload('');
        })

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


@endsection