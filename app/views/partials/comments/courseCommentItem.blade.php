<div class="comment-wrapper">
	<article class="panel panel-default panel-comment">
		<header class="panel-comment-heading">
			<div class="{{ CourseHelper::getGradeStyle('panel-comment-heading-', $comment->grade) }}">
				<h3 class="panel-title">
					{{ SemesterHelper::getSemesterText($comment->semester) }}
				</h3>
				<span class="panel-comment-grade {{ CourseHelper::getGradeStyle('panel-comment-grade-', $comment->grade) }}" data-toggle="tooltip" title="{{ trans('app.comment_grade_tooltip', array('grade' => CourseHelper::getGradeText($comment->grade))) }}">{{ $comment->grade }}</span>
			</div>
		</header>
		<aside class="panel-comment-aside">
			<ul class="panel-comment-aside-meta">
				<li>
					<dl>
						<dt>{{ trans('app.comment_instructor') }}</dt>
						<dd>{{{ $comment->instructor }}}</dd>
					</dl>
				</li>
				<li>
					<dl>
						<dt>{{ trans('app.comment_workload') }}</dt>
						<dd>{{ CommentHelper::getWorkloadText($comment->workload) }}</dd>
					</dl>
				</li>
			</ul>
		</aside>
		<div class="panel-body panel-comment-body" itemprop="commentText">{{ $comment->body }}</div>
		<footer class="panel-footer panel-comment-footer">
			<p class="text-muted pull-left">
				<i class="fa fa-clock-o"></i>
				<time pubdate datetime="{{ $comment->created_at->format(DateTime::ISO8601) }}" itemprop="commentTime">{{ $comment->created_at->format('M j, Y H:i') }}</time>
			</p>
			<div class="btn-group btn-group-comment-footer">
				<a href="{{ URL::route('comments.show', array($comment->id)) }}" class="btn btn-comment-footer" role="button"><i class="fa fa-link"></i> <span class="sr-only">{{ trans('app.comment_permalink') }}</span></a>
				<div class="btn-group dropup ">
					<ul class="dropdown-menu pull-right" role="menu" aria-labelledby="comment-dropup-menu-{{ $comment->id }}">
						<li><a href="#"><i class="fa fa-fw fa-facebook"></i> Facebook</a></li>
						<li><a href="#"><i class="fa fa-fw fa-twitter"></i> Twitter</a></li>
						<li><a href="#"><i class="fa fa-fw fa-google-plus"></i> Google+</a></li>
						<li><a href="#"><i class="fa fa-fw fa-renren"></i> Renren</a></li>
						<li><a href="#"><i class="fa fa-fw fa-weibo"></i> Weibo</a></li>
					</ul>
					<button type="button" id="comment-dropup-menu-{{ $comment->id }}" class="btn btn-comment-footer dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-share"></i> <span class="sr-only">{{ trans('app.comment_share') }}</span> <span class="caret"></span>
					</button>
				</div>
			</div>
		</footer>
	</article>
</div>