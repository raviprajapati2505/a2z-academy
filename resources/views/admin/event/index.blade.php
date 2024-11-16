@extends('layouts.app_theme')

@section('content')
<div class="coveradminalldata">
    <div class="calendarpage-cover">
        <div class="profset-title">
            <h1>Calendar</h1>
            <p>Welcome to Gord Academy Calendar</p>
        </div>
        <div class="leftright-calendar">
            <div class="left-calendar">
                <div class="leftdatacalendar">
                    <div id='calendar'></div>
                </div>
            </div>
            <div class="right-calendar">
                <div class="rightdatacalendar">
                    <h3>Calendar</h3>
                    <h6>Drag and drop your event or click in the calendar</h6>
                    <div class="eventdata-list">
                        <!-- <h5><span class="livecls"></span> Live Class</h5> -->
                        <h5><span class="eventcls"></span> Event</h5>
                        <h5><span class="examcls"></span> Exam</h5>
                        <h5><span class="workshopcls"></span> Workshop</h5>
                        <h5><span class="othercls"></span> Other</h5>
                    </div>
                    <div class="addnew-event">
                        <a href="javascript:void(0);" id="create-event"><i class='bx bx-plus'></i>New Event</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.event.model')

<script type="text/javascript">
    var store = <?php echo json_encode(route('event.store')) ?>;
    $('#alert-danger-form').hide();
    $('#alert-success-form').hide();
    $('#alert-success-list').hide();
    $('#alert-danger-list').hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    var events = <?php echo json_encode($events) ?>;
    var classes = <?php echo json_encode($classes) ?>;
    var allevents = []
    if (events.length > 0) {
        for (var key in events) {
            var value = events[key];
            let color = '#F52269';
            if (value.type == 'Event') {
                color = '#211C77';
            } else if (value.type == 'Exam') {
                color = '#F3E500';
            } else if (value.type == 'Other') {
                color = '#096C04'
            } else if (value.type == 'Workshop') {
                color = 'gray'
            }
            dailyclass = {
                "start": value.datetime,
                "title": value.description,
                "color": color
            }
            allevents.push(dailyclass);
        }
    }
    if (classes.length > 0) {
        for (var key in classes) {
            var value = classes[key];
            dailyclass = {
                "start": value.date + ' ' + value.time_from + ':00:00',
                "end": value.date + ' ' + value.time_to + ':00:00',
                "title": value.description,
                "color": '#F52269'
            }
            allevents.push(dailyclass);
        }
    }

    $("#eventform").validate({
        ignore: [],
        rules: {
            "type": {
                required: true
            },
            "date": {
                required: true
            },
            "description": {
                required: true
            },
        },
        submitHandler: function() {
            $.ajax({
                data: $('#eventform').serialize(),
                url: store,
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $('#alert-danger-form').hide();
                        $('#alert-success-form').show();
                        $('#alert-success-form').text(data.message);
                        setTimeout(function() {
                            $('#eventform').trigger("reset");
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

    $('#create-event').click(function() {
        $('#event_id').val('');
        $('#eventform').trigger("reset");
        $('#ajaxModel').modal('show');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {

        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#calendar').fullCalendar({
            themeSystem: 'bootstrap4',
            header: {
                center: 'prev,next today',
                left: 'title',
                right: 'month,agendaWeek,agendaDay'
                // right: 'year,month,agendaWeek,agendaDay,listMonth'
            },
            droppable: true,
            weekNumbers: true,
            eventLimit: true, // allow "more" link when too many events
            events: allevents
        });
    });
</script>
@endsection