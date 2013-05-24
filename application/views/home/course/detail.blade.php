@layout('layouts.home')

@section('content')

<div class="page-header">
	<h1>{{ $title }}</h1>
</div>



<!-- Info -->

<div class="row">
	{{-- Course info --}}
	<section id="info" class="span6">
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
		{{-- Links --}}
		<div>
			@if ($course->category !== 'E')
				<a class="btn" href="http://www6.cityu.edu.hk/ge_info/courses/materials/html/{{ $course->code }}.html" target="_blank">{{ __('app.course_edge_info') }} <i class="icon-external-link"></i></a>
			@endif
			<a class="btn" href="http://eportal.cityu.edu.hk/bbcswebdav/institution/APPL/Course/Current/{{ $course->code }}.htm"  target="_blank">{{ __('app.course_form2b') }} <i class="icon-external-link"></i></a>
		</div>
	</section><!-- /.span6 -->
	{{-- Stats --}}
	<section id="stats" class="span6">
		@include('partials.course.stats')
	</section><!-- /.span6 -->
</div><!-- /.row -->

<hr />

<section id="comments">
	<div class="clearfix">
		<h2 class="pull-left">{{ __('app.course_comment', array('count' => $comments->total)) }}</h2>
		<a href="{{ URL::to_route('comment.new', array(strtolower($course->code))) }}" role="button" class="btn btn-primary btn-new-comment pull-left" title="{{ __('app.comment_new') }}">
			<i class="icon-plus"></i> {{ __('app.comment_new') }}
		</a>
	</div>

	@if (!$comments->results)
		{{ HTML::alert('info', __('app.course_no_comment')) }}
	@else
		@foreach ($comments->results as $comment)
			@include('partials.comment.comment')
		@endforeach
	@endif

	{{ $comments->links() }}
</section>

@endsection