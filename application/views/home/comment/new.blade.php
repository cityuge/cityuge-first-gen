@layout('layouts.home')

@section('scripts_header')
var RecaptchaOptions = {
	theme : 'white'
};
@endsection

@section('content')
<div class="page-header">
	<h1>{{ $title }}</h1>
</div>

<dl>
	<dt>{{ __('app.course_title') }}</dt>
	<dd>
		{{ e($course->title_en) }}
		@if ($course->title_zh)
			<br />{{ e($course->title_zh) }}
		@endif
	</dd>
	<dt>{{ __('app.course_category') }}</dt>
	<dd>{{ Course::get_category_title($course->category) }}</dd>
	<dt>{{ __('app.course_department') }}</dt>
	<dd>
		<a href="{{ $course->department->url }}">
			{{ e($course->department->title_en) }}<br />
			{{ e($course->department->title_zh) }}
		</a>
	</dd>
	<dt>{{ __('app.course_level') }}</dt>
	<dd>{{ e($course->level) }}</dd>
</dl>
<hr />

{{ Form::open('comments', 'POST', array('class' => 'form-horizontal')) }}
	<div class="control-group {{ $errors->has('semester') ? 'error' : '' }}">
		{{ Form::label('semester', __('app.comment_semester'), array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::select('semester', $semesters, Input::old('semester')) }}
			{{ $errors->first('semester', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<div class="control-group {{ $errors->has('instructor') ? 'error' : '' }}">
		{{ Form::label('instructor', __('app.comment_instructor'), array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('instructor', Input::old('instructor')) }}
			{{ $errors->first('instructor', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<div class="control-group {{ $errors->has('grade') ? 'error' : '' }}">
		{{ Form::label('grade', __('app.comment_grade'), array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::select('grade', $grades, Input::old('grade')) }}
			{{ $errors->first('grade', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<div class="control-group {{ $errors->has('workload') ? 'error' : '' }}">
		{{ Form::label('workload', __('app.comment_workload'), array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::select('workload', $workloads, Input::old('workload')) }}
			{{ $errors->first('workload', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<div class="control-group {{ $errors->has('comment') ? 'error' : '' }}">
		{{ Form::label('comment', __('app.comment_comment'), array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::textarea('comment', Input::old('comment'), array('class' => 'input-block-level', 'rows' => '10')) }}
			{{ $errors->first('comment', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<!-- reCAPTCHA -->
	<div class="control-group {{ $errors->has('recaptcha_response_field') ? 'error' : '' }}">
		<div class="controls">
			<script type="text/javascript"
			src="http://www.google.com/recaptcha/api/challenge?k=***REMOVED***">
			</script>
			<noscript>
				<iframe src="http://www.google.com/recaptcha/api/noscript?k=***REMOVED***"
				height="300" width="500" frameborder="0"></iframe><br />
				<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
				<input type="hidden" name="recaptcha_response_field" value="manual_challenge">
			</noscript>
			{{ $errors->first('recaptcha_response_field', '<span class="help-inline">:message</span>') }}
		</div>
	</div>

	<div class="form-actions">
		{{ Form::token() }}
		{{ Form::hidden('course_id', $course->id); }}
		<button type="submit" class="btn btn-primary"><i class="icon-ok"></i> {{ __('app.comment_submit') }}</button>
	</div>
{{ Form::close() }}

@endsection