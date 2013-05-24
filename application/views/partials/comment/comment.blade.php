
<div class="media">
			<div class="media-body">
				<h4 class="media-heading">
					{{ Comment::get_semester_text($comment->semester) }}
				</h4>
				<ul class="inline">
					<li>{{ __('app.comment_instructor') }}：{{ e($comment->instructor) }}</li>
					<li>{{ __('app.comment_grade') }}：{{ Course::get_grade_text($comment->grade) }}</li>
					<li>{{ __('app.comment_workload') }}：{{ Comment::get_workload_text($comment->workload) }}</li>
				</ul>
				{{ $comment->comment }}
				<p class="muted">{{ $comment->created_at }}</p>
			</div>
		</div>