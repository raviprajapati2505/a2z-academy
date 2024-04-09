@extends('layouts.app_theme')

@section('content')
<div class="coveradminalldata">
    <div class="main-contsleftright">
        <div class="leftdatamain_cover">
            <div class="quizmaindata-cover">
                @include ('messages')
                <div class="profset-title">
                    <h1>{{ $title }}</h1>
                </div>
            </div>
            <div class="mainquizans-cover">
                <div id="ZoomEmbeddedApp" style="display:block !important"></div>
            </div>
        </div>
        @include('teacher.right_sidebar')
    </div>
</div>
@include('common.zoom.required_js')
@endsection