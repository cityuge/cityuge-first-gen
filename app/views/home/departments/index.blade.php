@extends('layouts.home')

@section('content')

<div id="content" class="container">
    <div class="page-header">
        <h1>{{ $title }}</h1>
    </div>
    <dl class="dl-horizontal">
        @foreach($departments as $dep)
            <dt>{{ link_to_route('departments.courses', $dep->initial, strtolower($dep->initial)) }}</dt>
            <dd>{{{ $dep->title_en }}}</dd>
            <dd>{{{ $dep->title_zh }}}</dd>
        @endforeach
    </dl>
</div>
@stop
