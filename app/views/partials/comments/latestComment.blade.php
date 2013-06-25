<?php $currentRoute = Route::currentRouteName(); ?>
<div class="span6 comment">
	<article id="comment-{{ $comment->id }}" class="comment-inner">
		<header class="comment-grade-strip-{{ Course::getGradeStyle($comment->grade) }}">
			<div class="comment-grade comment-grade-{{ Course::getGradeStyle($comment->grade) }}" data-toggle="tooltip" title="{{ trans('app.comment_grade_tooltip', array('grade' => $comment->grade)) }}">
				{{ Course::getRawGradeByText($comment->grade) }}
			</div>
			<a href="{{ URL::route('courses.show', array(strtolower($comment->course->code))) }}">
				<h4>
					<span class="comment-course-code">{{{ $comment->course->code }}}</span>
					{{{ $comment->course->title_en }}}
					@if (!empty($comment->course->title_zh))
						<span class="comment-title-zh">{{{ $comment->course->title_zh }}}</span>
					@endif
				</h4>
			</a>

			<div class="comment-meta">
				<dl>
					<dt>{{ Lang::get('app.comment_semester') }}</dt>
					<dd>{{ $comment->semester }}</dd>
				</dl>
				<dl>
					<dt>{{ Lang::get('app.comment_instructor') }}</dt>
					<dd>{{{ $comment->instructor }}}</dd>
				</dl>
				<dl>
					<dt>{{ Lang::get('app.comment_workload') }}</dt>
					<dd>{{ $comment->workload }}</dd>
				</dl>
			</div>
		</header>
		
		<div class="comment-body">{{ $comment->body }}</div>

		<footer>
			<p class="muted pull-left">
				<i class="icon-time"></i> <time pubdate datetime="{{ $comment->created_at->format(DateTime::ISO8601) }}">{{ $comment->created_at->format('F j, Y \a\t H:i') }}</time>
			</p>
			<div class="pull-right">
			{{-- <div class="btn-group pull-right"> --}}
				@unless ($currentRoute === 'comments.show')
					<a href="{{ URL::route('comments.show', array($comment->id)) }}" role="button" class="btn" data-toggle="tooltip" title="{{ trans('app.comment_permalink') }}">
						<i class="icon-link"></i>
					</a>
				@endunless
			</div>
		</footer>
	</article>
</div>