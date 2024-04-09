@extends('layouts.app_front')

@section('content')
<div class="container videosclassesmain-covpg">
    <div class="classall-datacover">

        <div class="classalldatitand-cls">
            <div class="classalldata-title">
                <h3>Live Class</h3>
            </div>
        </div>

        <div class="classalldata-inerbox">
            <div class="row">
                <div id="ZoomEmbeddedApp" style="display:block !important"></div>
            </div>
        </div>
    </div>
</div>
@include('common.zoom.required_js')
@endsection