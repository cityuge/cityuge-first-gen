@extends('layouts.home')

@section('content')

<div class="page-header">
	<h1>{{ $title }}</h1>
</div>
<dl class="dl-horizontal">
	@foreach($departments as $dep)
		<dt>{{ link_to_route('departments.courses', $dep->initial, strtolower($dep->initial)) }}</dt>
		<dd>{{{ $dep->title_en }}}<br />{{{ $dep->title_zh }}}</dd>
	@endforeach
</dl>
@stop