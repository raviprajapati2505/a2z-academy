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
            <a href="javascript:void(0)" id="create-promocode">
                <i class='bx bxs-plus-circle'></i> Add Promo Code
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
                <table id="example" class="display table nowrap promocode_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Promo Code</th>
                            <th>Discount Type</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.promocode.model')
</div>
<script>
    $(document).ready(function() {
        var table = $('.promocode_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('promocode.index') }}",
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
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'discount_type',
                    name: 'discount_type'
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
    var store = <?php echo json_encode(route('promocode.store')) ?>;
    $('#alert-danger-form').hide();
    $('#alert-success-form').hide();
    $('#alert-success-list').hide();
    $('#alert-danger-list').hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $("#promocodeform").validate({
        ignore: [],
        rules: {
            "code": {
                required: true,
            },
            "discount_amount": {
                required: true,
            },
            "valid_till": {
                required: true,
            },
        },
        messages: {},
        submitHandler: function() {
            $.ajax({
                data: $('#promocodeform').serialize(),
                url: store,
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $('#alert-danger-form').hide();
                        $('#alert-success-form').show();
                        $('#alert-success-form').text(data.message);
                        $('.promocode_datatable').DataTable().draw(true);
                        setTimeout(function() {
                            $('#promocodeform').trigger("reset");
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

    $('#create-promocode').click(function() {
        $('#promocode_id').val('');
        $('#promocodeform').trigger("reset");
        $('#ajaxModel').modal('show');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
    });

    $('body').on('click', '.edit-promocode', function() {
        var promocode_id = $(this).data('id');
        $('#alert-danger-form').hide();
        $('#alert-success-form').hide();
        $.get("{{ url('admin/'.$urlSlug.'/') }}" + '/' + promocode_id + '/edit', function(data) {
            var base_url = '<?php echo url('/'); ?>';
            $('#ajaxModel').modal('show');
            $('#promocode_id').val(data.data.id);
            $('#code').val(data.data.code);
            $('#discount_type').val(data.data.discount_type).trigger('change');
            $('#discount_amount').val(data.data.discount_amount);
            $('#valid_till').val(data.data.valid_till);
            $('#type').val(data.data.course_type_id).trigger('change');
        })
    });

    $('body').on('click', '.delete-promocode', function() {

        var promocode_id = $(this).data("id");

        $.ajax({
            type: "DELETE",
            beforeSend: function() {
                return confirm("Are you sure?");
            },
            url: "{{ url('admin/'.$urlSlug.'/') }}" + '/' + promocode_id,
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