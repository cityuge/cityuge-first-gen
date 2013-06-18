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
				<a href="{{ $course->department->url }}">
					{{{ $course->department->title_en }}}<br />
					{{{ $course->department->title_zh }}}
				</a>
			</dd>
			<dt>{{ Lang::get('app.course_level') }}</dt>
			<dd>{{{ $course->level }}}</dd>
		</dl>
		{{-- Links --}}
		<div>
			@if ($course->category !== Lang::get('app.category_e'))
				<a class="btn" href="http://www6.cityu.edu.hk/ge_info/courses/materials/html/{{ $course->code }}.html" target="_blank">{{ Lang::get('app.course_edgeInfo') }} <i class="icon-external-link"></i></a>
			@endif
			<a class="btn" href="http://eportal.cityu.edu.hk/bbcswebdav/institution/APPL/Course/Current/{{ $course->code }}.htm"  target="_blank">{{ Lang::get('app.course_form2b') }} <i class="icon-external-link"></i></a>
		</div>
	</section><!-- /.span6 -->
	{{-- Stats --}}
	<section id="stats" class="span6">
		@include('partials.courses.stats')
	</section><!-- /.span6 -->
</div><!-- /.row -->

<hr />

<section id="comments">
	<div class="clearfix">
		<h2 class="pull-left">{{ Lang::choice('app.course_comment', $comments->getTotal(), array('count' => $comments->getTotal())) }}</h2>
		<a href="{{ URL::route('comments.create', array(strtolower($course->code))) }}" role="button" class="btn btn-primary btn-new-comment pull-left">
			<i class="icon-plus"></i> {{ Lang::get('app.comment_new') }}
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

<script>
$(document).ready(function () {
	// Masonry
	$('#comment-container').masonry({
		transitionDuration: 0,
		itemSelector: '.comment'
	});

	$('div[data-toggle=tooltip]').tooltip({ placement: 'left' });
	$('a[data-toggle=tooltip]').tooltip({ placement: 'left' });
});
</script>

@stop