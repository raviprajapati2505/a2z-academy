@extends('layouts.app_theme')

@section('content')


<div class="proprofimaincov">
    <div class="quizmaindata-cover">
        @include ('messages')
        <div class="profset-title">
            <h1>Certificate Report</h1>
            <!--  <p>Welcome to Newness Super Admin</p> -->
        </div>
    </div>
    <div class="mainquizans-cover">
        <div class="supadmmain_cover">
            <div class="supadmmain_maintbl">
                <div class="row">
                    <div class="col-md-2"><label>From Date : </label>&nbsp;&nbsp;<input type="date" name="from_date" id="from_date"></div>
                    <div class="col-md-2"><label>To Date : </label>&nbsp;&nbsp;<input type="date" name="to_date" id="to_date"></div>
                    <div class="col-md-2"><a class="btn btn-primary btn-xs" id="filter_data">Filter</a></div>
                </div>
                <br><br>
                <table id="example" class="display table nowrap certificate_datatable">
                    <thead>
                        <tr>
                            <th>Learner Name</th>
                            <th>Course Name</th>
                            <th>Certificate Generated At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        var table = $('.certificate_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('admin/report/certificate_report') }}",
                "type": "GET",
                "data": function(d) {
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                }
            },
            autoWidth: true,
            dom: 'Bfrtip',
            data: {
                from_date: 'test',
                to_date: 'test'
            },
            order: [
                [0, 'desc']
            ],
            buttons: [{
                extend: 'excelHtml5',
                "action": newexportaction,
                exportOptions: {
                    columns: [0, 1, 2]
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
                    data: 'generated_date',
                    name: 'generated_date'
                },
            ]
        });

        $('#filter_data').click(function(){
            table.ajax.reload();
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