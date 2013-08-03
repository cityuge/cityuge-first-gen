@extends('layouts.home')

@section('content')

<div class="page-header">
	<h1>{{ $title }}</h1>
</div>

{{ Form::open(['route' => 'courses.processSearch', 'method' => 'POST', 'class' => 'navbar-form form-search']) }}
	<div class="row">
		<div class="span6 offset3">
			<div class="input-append">
				{{ Form::text('keyword', Input::old('keyword'), array('class' => 'span5 search-query', 'placeholder' => Lang::get('app.nav_searchPlaceholder'), 'x-webkit-speech' => '', 'x-webkit-grammar' => 'builtin:search', 'lang' => 'en')) }}
				<button type="submit" class="btn"><i class="icon-search"></i> {{ Lang::get('app.nav_search') }}</button>
			</div>
		</div>
	</div>

	<fieldset>
		<legend>Legend</legend>
		<label>Label name</label>
		<input type="text" placeholder="Type something…">
		<span class="help-block">Example block-level help text here.</span>
		<label class="checkbox">
			<input type="checkbox"> Check me out
		</label>
		<button type="submit" class="btn">Submit</button>
	</fieldset>
{{ Form::close() }}

@stop