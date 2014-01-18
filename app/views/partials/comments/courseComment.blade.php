<div class="span6 comment">
	<article id="comment-{{ $comment->id }}" class="comment-inner">
		<header class="{{ CourseHelper::getGradeStyle('comment-grade-strip-', $comment->grade) }}">
			<div class="comment-grade {{ CourseHelper::getGradeStyle('comment-grade-', $comment->grade) }}" data-toggle="tooltip" title="{{ trans('app.comment_grade_tooltip', array('grade' => $comment->grade)) }}">
				{{ $comment->grade }}
			</div>
			<h4>{{{ $comment->semester }}}</h4>

			<div class="comment-meta">
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
				<i class="icon-time"></i> <time pubdate datetime="{{ $comment->created_at->format(DateTime::ISO8601) }}">{{ $comment->created_at->format('M j, Y \a\t H:i') }}</time>
			</p>
			<div class="btn-group pull-right">
				{{-- Sharrre --}}
				<a class="btn dropdown-toggle" data-toggle="dropdown" title="{{ trans('app.comment_share') }}" href="#">
					<i class="icon-share-alt"></i>
					<span class="caret"></span>
				</a>

				{{-- Permalink --}}
				<a href="{{ URL::route('comments.show', array($comment->id)) }}" role="button" class="btn" title="{{ trans('app.comment_permalink') }}">
					<i class="icon-link"></i>
				</a>

				{{-- Sharrre dropdown --}}
				<ul class="dropdown-menu pull-right social-media-dropdown" data-url="{{ URL::route('comments.show', array($comment->id)) }}" data-text="{{ trans('app.comment_show_title', array('id' => $comment->id, 'courseCode' => e($course->code), 'courseTitle' => e($course->title_en))) }}"></ul>
			</div>
		</footer>
	</article>
</div>