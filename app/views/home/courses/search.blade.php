@extends('layouts.home')

@section('content')

<div class="page-header">
	<h1>{{ $title }}</h1>
</div>

{{ Form::open(array('route' => 'courses.processSearch', 'method' => 'POST', 'class' => '')) }}
	<div class="row">
		<div class="span4">
			<div class="control-group">
				{{ Form::label('keyword', Lang::get('app.course_search_keyword'), array('class' => 'control-label')) }}
				{{ Form::text('keyword', null, array('class' => 'input-block-level')) }}
			</div>

			<h4>{{ trans('app.course_quickAccessCurrentSemester', array('semester' => SemesterHelper::getSemesterText(Config::get('cityuge.currentQuickAccessSemester')))) }}</h4>
			<ul class="nav nav-tabs nav-stacked">
				@foreach ($quickAccesses as $item)
					<li><a href="{{ $item['url'] }}">{{ $item['text'] }} <i class="icon-angle-right"></i></a></li>
				@endforeach
			</ul>

		</div>
		
		<div class="span4">
			<fieldset>
				<legend>{{ trans('app.course_search_misc') }}</legend>
				{{ Form::label('semester', Lang::get('app.course_search_semester')) }}
				{{ Form::select('semester', $semesters, null, array('class' => 'input-block-level')) }}

				{{ Form::label('department', Lang::get('app.course_search_department')) }}
				{{ Form::select('department', $departments, null, array('class' => 'input-block-level')) }}

				{{ Form::label('category', Lang::get('app.course_search_category')) }}
				{{ Form::select('category', $categories, null, array('class' => 'input-block-level')) }}
  			</fieldset>
		</div>

		<div class="span4">
			<fieldset>
				<legend>{{ trans('app.course_search_assess') }}</legend>
				<p><a href="#assess-explain-modal" role="button" class="btn btn-small" data-toggle="modal"><i class="icon-info-sign"></i> {{ trans('app.course_assess_explain') }}</a></p>
				<p>
					{{ trans('app.course_assess_exam') }}<br />
					<label class="radio inline">{{ Form::radio('exam', '1') }} {{ trans('app.course_search_assess_yes') }}</label>
					<label class="radio inline">{{ Form::radio('exam', '0') }} {{ trans('app.course_search_assess_no') }}</label>
					<label class="radio inline">{{ Form::radio('exam', '', true) }} {{ trans('app.course_search_assess_dontCare') }}</label>
				</p>
				<p>
					{{ trans('app.course_assess_quiz') }}<br />
					<label class="radio inline">{{ Form::radio('quiz', '1') }} {{ trans('app.course_search_assess_yes') }}</label>
					<label class="radio inline">{{ Form::radio('quiz', '0') }} {{ trans('app.course_search_assess_no') }}</label>
					<label class="radio inline">{{ Form::radio('quiz', '', true) }} {{ trans('app.course_search_assess_dontCare') }}</label>
				</p>
				<p>
					{{ trans('app.course_assess_report') }}<br />
					<label class="radio inline">{{ Form::radio('report', '1') }} {{ trans('app.course_search_assess_yes') }}</label>
					<label class="radio inline">{{ Form::radio('report', '0') }} {{ trans('app.course_search_assess_no') }}</label>
					<label class="radio inline">{{ Form::radio('report', '', true) }} {{ trans('app.course_search_assess_dontCare') }}</label>
				</p>
				<p>
					{{ trans('app.course_assess_project') }}<br />
					<label class="radio inline">{{ Form::radio('project', '1') }} {{ trans('app.course_search_assess_yes') }}</label>
					<label class="radio inline">{{ Form::radio('project', '0') }} {{ trans('app.course_search_assess_no') }}</label>
					<label class="radio inline">{{ Form::radio('project', '', true) }} {{ trans('app.course_search_assess_dontCare') }}</label>
				</p>
			</fieldset>
		</div>

	</div>
	
	<div class="form-actions">
		<button type="submit" class="btn btn-primary"><i class="icon-search"></i> {{ Lang::get('app.nav_search') }}</button>
		{{ Form::hidden('type', 'advanced') }}
	</div>

{{ Form::close() }}

{{-- Assessment Task Definitions --}}
<div id="assess-explain-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="assess-explain-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="assess-explain-modal-label">{{ trans('app.course_assess_model_title') }}</h3>
	</div>
	<div class="modal-body">
		<dl>
			<dt>{{ trans('app.course_assess_exam') }}</dt>
			<dd>{{ trans('app.course_assess_def_exam') }}</dd>
			<dt>{{ trans('app.course_assess_quiz') }}</dt>
			<dd>{{ trans('app.course_assess_def_quiz') }}</dd>
			<dt>{{ trans('app.course_assess_report') }}</dt>
			<dd>{{ trans('app.course_assess_def_report') }}</dd>
			<dt>{{ trans('app.course_assess_project') }}</dt>
			<dd>{{ trans('app.course_assess_def_project') }}</dd>
		</dl>
		
	</div>
</div>

@stop