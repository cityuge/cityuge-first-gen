@extends('layouts.home')

@section('content')

<div class="page-header">
	<h1>
		{{{ $course->code }}}
		{{--<small>{{{ $course->title_en }}}</small>
		@if ($course->title_zh)
			<small>{{{ $course->title_zh }}}</small>
		@endif--}}
	</h1>
</div>


<ul class="nav nav-pills visible-phone" id="mobile-tab">
	<li><a href="#info">{{ trans('app.course_detail_info') }}</a></li>
	<li><a href="#stats">{{ trans('app.course_detail_stats') }}</a></li>
	<li class="active"><a href="#comments">{{ trans('app.course_detail_comment') }}</a></li>
</ul>

<!-- Info -->
<div class="row">
	{{-- Course info --}}
	<section id="info" class="span6">
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
				{{{ $course->department->title_en }}}<br />
				{{{ $course->department->title_zh }}}
			</dd>
			<dd>
				<a class="btn" href="{{ route('departments.courses', array(strtolower($course->department->initial))) }}">{{ Lang::get('app.course_department_course') }}</a>
				<a class="btn" href="{{{ $course->department->url }}}" target="_blank">{{ Lang::get('app.course_department_website') }} <i class="icon-external-link"></i></a>
			</dd>
			<dt>{{ Lang::get('app.course_level') }}</dt>
			<dd>{{{ $course->level }}}</dd>
			<dt>{{ Lang::get('app.course_assess') }} <a href="#assess-explain-modal" role="button" class="btn btn-small" data-toggle="modal"><i class="icon-info-sign"></i> {{ trans('app.course_assess_explain') }}</a></dt>
			<dd>
				<ul class="icons-ul">
					<li class="{{ $course->assess_exam ? 'text-success' : 'muted'}}">
						<i class="icon-li {{ $course->assess_exam ? 'icon-ok' : 'icon-remove'}}"></i>{{ trans_choice($course->assess_exam ? 'app.course_assess_include' : 'app.course_assess_exclude', null, array('task' => trans('app.course_assess_exam'))) }}
					</li>
					<li class="{{ $course->assess_quiz ? 'text-success' : 'muted'}}">
						<i class="icon-li {{ $course->assess_quiz ? 'icon-ok' : 'icon-remove'}}"></i>{{ trans_choice($course->assess_quiz ? 'app.course_assess_include' : 'app.course_assess_exclude', null, array('task' => trans('app.course_assess_quiz'))) }}
					</li>
					<li class="{{ $course->assess_report ? 'text-success' : 'muted'}}">
						<i class="icon-li {{ $course->assess_report ? 'icon-ok' : 'icon-remove'}}"></i>{{ trans_choice($course->assess_report ? 'app.course_assess_include' : 'app.course_assess_exclude', null, array('task' => trans('app.course_assess_report'))) }}
					</li>
					<li class="{{ $course->assess_project ? 'text-success' : 'muted'}}">
						<i class="icon-li {{ $course->assess_project ? 'icon-ok' : 'icon-remove'}}"></i>{{ trans_choice($course->assess_project ? 'app.course_assess_include' : 'app.course_assess_exclude', null, array('task' => trans('app.course_assess_project'))) }}
					</li>
				</ul>
			</dd>
			<dt>{{ Lang::get('app.course_offering') }}</dt>
			<dd>
				@if (count($course->offerings) > 0)
					@foreach ($course->offerings as $offering)
						<span class="label label-info">{{{ Comment::getSemesterText($offering->semester) }}}</span>
					@endforeach
				@else
					<span class="text-error">{{ trans('app.course_offering_none') }}</span>
				@endif
			</dd>
		</dl>
		{{-- Links --}}
		<div>
			@if ($course->category !== Lang::get('app.category_e'))
				<a class="btn" href="http://www6.cityu.edu.hk/ge_info/courses/materials/html/{{ $course->code }}.html" target="_blank">{{ Lang::get('app.course_edgeInfo') }} <i class="icon-external-link"></i></a>
			@endif
			<a class="btn" href="http://eportal.cityu.edu.hk/bbcswebdav/institution/APPL/Course/Current/{{ $course->code }}.htm" target="_blank">{{ Lang::get('app.course_form2b') }} <i class="icon-external-link"></i></a>
		</div>
	</section><!-- /.span6 -->
	{{-- Stats --}}
	<section id="stats" class="span6">
		@include('partials.courses.stats')
	</section><!-- /.span6 -->
</div><!-- /.row -->

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


<hr class="hidden-phone" />

<section id="comments">
	<div class="clearfix">
		<h2 class="pull-left">{{ Lang::choice('app.course_comment', $comments->getTotal(), array('count' => $comments->getTotal())) }}</h2>
		<a href="{{ URL::route('comments.create', array(strtolower($course->code))) }}" role="button" class="btn btn-primary btn-new-comment pull-left">
			<i class="icon-comment"></i> {{ Lang::get('app.comment_new') }}
		</a>
	</div>
	@if (!$comments->getTotal())
		{{ HTML::alert('info', Lang::get('app.course_noComment')) }}
	@else
		<div id="comment-container" class="row">
			@foreach ($comments as $comment)
				@include('partials.comments.courseComment')
			@endforeach
		</div>
	@endif

	{{ $comments->links() }}
</section>

@stop

@section('footerScript')
{{ HTML::script('js/masonry.pkgd.min.js') }}
{{ HTML::script('js/jquery.sharrre.js') }}
{{ HTML::script('js/comment-box.min.js') }}
{{ HTML::script('js/course-detail.min.js') }}
@stop