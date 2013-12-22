@extends('layouts.home')

@section('content')

<div id="content" class="container">

<div class="page-header">
	<h1>{{ $title }}</h1>
</div>

{{ Form::open(array('route' => 'courses.processSearch', 'method' => 'POST', 'role' => 'form')) }}
	<div class="row">
		<div class="col-lg-4 col-sm-6">
			<div class="form-group">
				{{ Form::label('keyword', trans('app.course_search_keyword')) }}
				{{ Form::text('keyword', null, array('class' => 'form-control')) }}
			</div>

			<h4>{{ trans('app.course_quickAccessCurrentSemester', array('semester' => SemesterHelper::getSemesterText(Config::get('cityuge.currentQuickAccessSemester')))) }}</h4>
			<div class="list-group">
				@foreach ($quickAccesses as $item)
					<a href="{{ $item['url'] }}" class="list-group-item">{{ $item['text'] }} <i class="fa fa-angle-right"></i></a>
				@endforeach
			</div>

		</div>
		
		<div class="col-lg-4 col-sm-6">
			<fieldset>
				<legend>{{ trans('app.course_search_misc') }}</legend>
				<div class="form-group">
					{{ Form::label('semester', trans('app.course_search_semester')) }}
					{{ Form::select('semester', $semesters, null, array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('department', trans('app.course_search_department')) }}
					{{ Form::select('department', $departments, null, array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('category', trans('app.course_search_category')) }}
					{{ Form::select('category', $categories, null, array('class' => 'form-control')) }}
				</div>
  			</fieldset>
		</div>

		<div class="col-lg-4 col-sm-12">
			<fieldset>
				<legend>
					{{ trans('app.course_search_assess') }}
					<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#assess-explain-modal"><i class="fa fa-info-circle"></i> {{ trans('app.course_assess_explain') }}</button>
				</legend>
				
				
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 col-lg-4 control-label">{{ trans('app.course_assess_exam') }}</label>
						<div class="col-sm-9 col-lg-8">
							<label class="radio-inline">{{ Form::radio('exam', '1') }} {{ trans('app.course_search_assess_yes') }}</label>
							<label class="radio-inline">{{ Form::radio('exam', '0') }} {{ trans('app.course_search_assess_no') }}</label>
							<label class="radio-inline">{{ Form::radio('exam', '', true) }} {{ trans('app.course_search_assess_dontCare') }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 col-lg-4 control-label">{{ trans('app.course_assess_quiz') }}</label>
						<div class="col-sm-9 col-lg-8">
							<label class="radio-inline">{{ Form::radio('quiz', '1') }} {{ trans('app.course_search_assess_yes') }}</label>
							<label class="radio-inline">{{ Form::radio('quiz', '0') }} {{ trans('app.course_search_assess_no') }}</label>
							<label class="radio-inline">{{ Form::radio('quiz', '', true) }} {{ trans('app.course_search_assess_dontCare') }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 col-lg-4 control-label">{{ trans('app.course_assess_report') }}</label>
						<div class="col-sm-9 col-lg-8">
							<label class="radio-inline">{{ Form::radio('report', '1') }} {{ trans('app.course_search_assess_yes') }}</label>
							<label class="radio-inline">{{ Form::radio('report', '0') }} {{ trans('app.course_search_assess_no') }}</label>
							<label class="radio-inline">{{ Form::radio('report', '', true) }} {{ trans('app.course_search_assess_dontCare') }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 col-lg-4 control-label">{{ trans('app.course_assess_project') }}</label>
						<div class="col-sm-9 col-lg-8">
							<label class="radio-inline">{{ Form::radio('project', '1') }} {{ trans('app.course_search_assess_yes') }}</label>
							<label class="radio-inline">{{ Form::radio('project', '0') }} {{ trans('app.course_search_assess_no') }}</label>
							<label class="radio-inline">{{ Form::radio('project', '', true) }} {{ trans('app.course_search_assess_dontCare') }}</label>
						</div>
					</div>
				</div>
			</fieldset>
		</div>

	</div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{ trans('app.nav_search') }}</button>
		{{ Form::hidden('type', 'advanced') }}
	</div>

{{ Form::close() }}

{{-- Assessment Task Definitions --}}
<div class="modal fade" id="assess-explain-modal" tabindex="-1" role="dialog" aria-labelledby="assess-explain-modal-title" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="assess-explain-modal-title">{{ trans('app.course_assess_model_title') }}</h4>
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
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->




</div><!--/.container -->

@stop