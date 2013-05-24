@layout('layouts.home')

@section('content')

<div class="page-header">
	<h1>{{ $title }}</h1>
</div>

{{ $comments->links() }}

<ul class="media-list">
	@foreach ($comments->results as $comment)
		<li class="media">
			<div class="media-body">
				<h4 class="media-heading">
					{{ HTML::link_to_route('course.detail', $comment->course->code . ' - ' . e($comment->course->title_en), array(strtolower($comment->course->code))) }}
				</h4>
				<ul class="inline">
					<li>{{ __('app.comment_semester') }}：{{ Comment::get_semester_text($comment->semester) }}</li>
					<li>{{ __('app.comment_instructor') }}：{{ e($comment->instructor) }}</li>
					<li>{{ __('app.comment_grade') }}：{{ Course::get_grade_text($comment->grade) }}</li>
					<li>{{ __('app.comment_workload') }}：{{ Comment::get_workload_text($comment->workload) }}</li>
				</ul>
				{{ $comment->comment }}
				<p class="muted">{{ $comment->created_at }}</p>
			</div>
		</li>

	@endforeach
</ul>

{{ $comments->links() }}

@endsection