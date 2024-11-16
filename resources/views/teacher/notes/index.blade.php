@extends('layouts.app_theme')

@section('content')

<div class="proprofimaincov">
    <div class="quizmaindata-cover">
        @include ('messages')
        <div class="profset-title">
            <h1>{{ $title }}</h1>
            <!--  <p>Welcome to Newness Super Admin</p> -->
        </div>
    </div>
    <div class="mainquizans-cover">
        <div class="supadmmain_cover">
            <div class="supadmmain_maintbl">
                <div class="alert alert-danger" id="alert-danger-list">
                </div>
                <div class="alert alert-success" id="alert-success-list">
                </div>
                <table id="example" class="display table nowrap notes_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Sub-Category</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('teacher.notes.model')
</div>
<script>
    $(document).ready(function() {
        var table = $('.notes_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('notes.index') }}",
            autoWidth: true,
            dom: 'Bfrtip',
            order: [
                [0, 'desc']
            ],
            buttons: [{
                extend: 'excelHtml5',
                "action": newexportaction,
                exportOptions: {
                    columns: [0, 1]
                }
            }, ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'type',
                    name: 'type'
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
    });
</script>
<script type="text/javascript">
    var store = <?php echo json_encode(route('notes.store')) ?>;
    $('#alert-danger-note').hide();
    $('#alert-success-note').hide();
    $('#alert-success-list').hide();
    $('#alert-danger-list').hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $("#noteform").validate({
        ignore: [],
        rules: {
            "title": {
                required: true,
            }
        },
        messages: {},
        submitHandler: function() {
            $.ajax({
                data: $('#noteform').serialize(),
                url: store,
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $('#alert-danger-note').hide();
                        $('#alert-success-note').show();
                        $('#alert-success-note').text(data.message);
                        $('.notes_datatable').DataTable().draw(true);
                        setTimeout(function() {
                            $('#noteform').trigger("reset");
                            $('#ajaxModel').modal('hide');
                        }, 2000);
                    } else if (data.message == 'Error validation') {
                        $('#alert-success-note').hide();
                        $('#alert-danger-note').show();
                        for (var key in data.data) {
                            var value = data.data[key];
                            $('#alert-danger-note').text(value[0]);
                        }
                    } else {
                        $('#alert-success-note').hide();
                        $('#alert-danger-note').show();
                        $('#alert-danger-note').text(data.message);
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

    $('body').on('click', '.edit-note', function() {
        var note_id = $(this).data('id');
        $('#alert-danger-note').hide();
        $('#alert-success-note').hide();
        $.get("{{ url('teacher/'.$urlSlug.'/') }}" + '/' + note_id + '/edit', function(data) {
            var base_url = '<?php echo url('/'); ?>';
            $('#ajaxModel').modal('show');
            $('#note_id').val(data.data.id);
            $('#title').val(data.data.title);
            $('#description').val(data.data.description);
            $('#type').val(data.data.type);
            $('#subject').val(data.data.subject_id);
        })
    });

    $('body').on('click', '.delete-note', function() {

        var note_id = $(this).data("id");

        $.ajax({
            type: "DELETE",
            beforeSend: function() {
                return confirm("Are you sure?");
            },
            url: "{{ url('teacher/'.$urlSlug.'/') }}" + '/' + note_id,
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