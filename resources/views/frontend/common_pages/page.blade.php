@extends('layouts.app_front')

@section('content')
<div class="container">
    <div class="mycorspagedatacov">
        <div class="myactpagedata_title">
            <h1>{{ $page_content->title }}</h1>
            <p>Welcome to {{ $page_content->title }}</p>
        </div>
        <div class="row">
            {!! $page_content->content !!}
        </div>
    </div>
</div>
@endsection