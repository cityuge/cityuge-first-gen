@extends('layouts.home')

@section('content')
<div class="page-header">
	<h1>{{ $title }}</h1>
</div>

<dl>
	<dt>{{ Lang::get('app.course_title') }}</dt>
	<dd>
		{{{ $course->title_en }}}
		@if ($course->title_zh)
			<br />{{{ $course->title_zh }}}
		@endif
	</dd>
	<dt>{{ Lang::get('app.course_category') }}</dt>
	<dd>{{ $course->category }}</dd>
	<dt>{{ Lang::get('app.course_department') }}</dt>
	<dd>
		<a href="{{ $course->department->url }}">
			{{{ $course->department->title_en }}}<br />
			{{{ $course->department->title_zh }}}
		</a>
	</dd>
	<dt>{{ Lang::get('app.course_level') }}</dt>
	<dd>{{{ $course->level }}}</dd>
</dl>
<hr />

{{ Form::open(['route' => 'comments.store', 'method' => 'POST', 'class' => 'form-horizontal']) }}
	<div class="control-group {{ $errors->has('semester') ? 'error' : '' }}">
		{{ Form::label('semester', Lang::get('app.comment_semester'), array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::select('semester', $semesters, Input::old('semester')) }}
			{{ $errors->first('semester', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<div class="control-group {{ $errors->has('instructor') ? 'error' : '' }}">
		{{ Form::label('instructor', Lang::get('app.comment_instructor'), array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('instructor', Input::old('instructor')) }}
			{{ $errors->first('instructor', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<div class="control-group {{ $errors->has('grade') ? 'error' : '' }}">
		{{ Form::label('grade', Lang::get('app.comment_grade'), array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::select('grade', $grades, Input::old('grade')) }}
			{{ $errors->first('grade', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<div class="control-group {{ $errors->has('workload') ? 'error' : '' }}">
		{{ Form::label('workload', Lang::get('app.comment_workload'), array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::select('workload', $workloads, Input::old('workload')) }}
			{{ $errors->first('workload', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<div class="control-group {{ $errors->has('body') ? 'error' : '' }}">
		{{ Form::label('body', Lang::get('app.comment_body'), array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::textarea('body', Input::old('body'), array('class' => 'input-block-level', 'rows' => '10')) }}
			{{ $errors->first('body', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<!-- reCAPTCHA -->
	<div class="control-group {{ $errors->has('recaptcha_response_field') ? 'error' : '' }}">
		<div class="controls">
			{{ Form::captcha(array('theme' => 'white')) }}
			{{ $errors->first('recaptcha_response_field', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<div class="form-actions">
		{{ Form::hidden('course_id', $course->id) }}
		<button type="submit" class="btn btn-primary"><i class="icon-ok"></i> {{ Lang::get('app.comment_submit') }}</button>
	</div>
{{ Form::close() }}

@stop