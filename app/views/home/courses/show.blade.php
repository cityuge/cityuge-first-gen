@extends('layouts.home')

@section('content')

<section id="content" class="jumbotron jumbotron-course jumbotron-course-{{ strtolower($course->category) }}">
	<div class="container">
	<h1>
		<span class="jumbotron-course-code">{{{ $course->code }}}</span>
		<span class="jumbotron-course-title">{{{ $course->title_en }}}</span>
		@if (Session::get('_locale') != 'en' && $course->title_zh)
			<span class="jumbotron-course-title">{{{ $course->title_zh }}}</span>
		@endif
	</h1>
	<ul class="jumbotron-course-meta">
		<li>
			<dl>
				<dt>{{ trans('app.course_category') }}</dt>
				<dd>{{ CourseHelper::getCategoryText($course->category) }}</dd>
			</dl>
		</li>
		<li>
			<dl>
				<dt>{{ trans('app.course_level') }}</dt>
				<dd>{{{ $course->level }}}</dd>
			</dl>
		</li>
		<li>
			<dl>
				<dt>{{ trans('app.course_department') }}</dt>
				<dd>
					@if (Session::get('_locale') == 'en')
						{{{ $course->department->title_en }}}
					@else
						{{{ $course->department->title_zh }}}
					@endif
				</dd>
			</dl>
		</li>
	</ul>
</div>
</section>

<div class="container">

	<!-- Info -->
	<div class="row">
		<!-- Course info -->
		<section id="info" class="col-sm-3">
			<dl>				
				<dt>
					{{ trans('app.course_assess') }}
					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-info-circle"></i> {{ trans('app.course_assess_explain') }}</button>
				</dt>
				<dd>
					<ul class="fa-ul">
						<li class="{{ $course->assess_exam ? 'text-success' : 'text-muted'}}">
							<i class="fa-li fa {{ $course->assess_exam ? 'fa-check' : 'fa-times'}}"></i>{{ trans_choice($course->assess_exam ? 'app.course_assess_include' : 'app.course_assess_exclude', null, array('task' => trans('app.course_assess_exam'))) }}
						</li>
						<li class="{{ $course->assess_quiz ? 'text-success' : 'text-muted'}}">
							<i class="fa-li fa {{ $course->assess_quiz ? 'fa-check' : 'fa-times'}}"></i>{{ trans_choice($course->assess_quiz ? 'app.course_assess_include' : 'app.course_assess_exclude', null, array('task' => trans('app.course_assess_quiz'))) }}
						</li>
						<li class="{{ $course->assess_report ? 'text-success' : 'text-muted'}}">
							<i class="fa-li fa {{ $course->assess_report ? 'fa-check' : 'fa-times'}}"></i>{{ trans_choice($course->assess_report ? 'app.course_assess_include' : 'app.course_assess_exclude', null, array('task' => trans('app.course_assess_report'))) }}
						</li>
						<li class="{{ $course->assess_project ? 'text-success' : 'text-muted'}}">
							<i class="fa-li fa {{ $course->assess_project ? 'fa-check' : 'fa-times'}}"></i>{{ trans_choice($course->assess_project ? 'app.course_assess_include' : 'app.course_assess_exclude', null, array('task' => trans('app.course_assess_project'))) }}
						</li>
					</ul>
				</dd>
				<dt>{{ trans('app.course_offering') }}</dt>
				<dd>
					@if (count($course->offerings) > 0)
						@foreach ($course->offerings as $offering)
							<span class="label label-info">{{{ SemesterHelper::getSemesterText($offering->semester) }}}</span>
						@endforeach
					@else
						<span class="text-error">{{ trans('app.course_offering_none') }}</span>
					@endif
				</dd>
			</dl>

		</section><!-- /.span6 -->

		<!-- Stats -->
		<section id="stats" class="col-sm-6">Stats</section>
		
		<!-- Links -->
		<nav id="links" class="col-sm-3">
			<div class="list-group">
				<a href="http://eportal.cityu.edu.hk/bbcswebdav/institution/APPL/Course/Current/{{ $course->code }}.htm" target="_blank" class="list-group-item">{{ trans('app.course_form2b') }} <i class="fa fa-external-link"></i></a>
				@if ($course->category !== 'E')
					<a href="http://www6.cityu.edu.hk/ge_info/courses/materials/html/{{ $course->code }}.html" target="_blank" class="list-group-item">{{ trans('app.course_edgeInfo') }} <i class="fa fa-external-link"></i></a>
				@endif
				<a href="{{{ $course->department->url }}}" target="_blank" class="list-group-item">{{ trans('app.course_department_website') }} <i class="fa fa-external-link"></i></a>
				<a href="{{ route('departments.courses', array(strtolower($course->department->initial))) }}" class="list-group-item">{{ trans('app.course_department_course') }}</a>
			</div>
		</nav>
		
	</div><!-- /.row -->


	<div>
		<h2>{{ trans_choice('app.course_comment', $comments->getTotal(), array('count' => $comments->getTotal())) }}
			<a href="{{ URL::route('comments.create', array(strtolower($course->code))) }}" role="button" class="btn btn-primary">
				<i class="icon-comment"></i> {{ Lang::get('app.comment_new') }}
			</a>
		</h2>
	</div>
	<section id="comment-container" class="row" itemscope itemtype="http://schema.org/UserComments">
		<!-- Create a dummy div for Masonry to get the correct column width in IE9 or above -->
		<div class="comment-wrapper-dummy"></div>
		@if (!$comments->getTotal())
			{{ HTML::alert('info', Lang::get('app.course_noComment')) }}
		@else
			<div id="comment-container" class="row">
				@foreach ($comments as $comment)
					@include('partials.comments.courseCommentItem')
				@endforeach
			</div>
		@endif

	</section>

</div>

@stop

@section('footerScript')
{{ HTML::script('js/masonry.pkgd.min.js') }}
{{-- HTML::script('js/jquery.sharrre.js') --}}
{{-- HTML::script('js/comment-box.min.js') --}}
{{-- HTML::script('js/course-detail.min.js') --}}

<script>
$(document).ready(function () {
	// Masonry
	$('#comment-container').masonry({
		transitionDuration: 0,
		itemSelector: '.comment-wrapper',
		columnWidth: '.comment-wrapper-dummy'
	});
});
</script>

@stop