<div class="course-wrapper">
	<div class="panel panel-default panel-course">
		<div class="panel-course-heading">
			<a href="{{ route('courses.show', strtolower($course->code)) }}" class="panel-course-heading-{{ strtolower($course->category) }}">
				<h3 class="panel-title">

						<span class="panel-course-code">{{{ $course->code }}}</span>

						{{{ $course->title_en }}}

						@if (!empty($course->title_zh) && Session::get('_locale') !== 'en')
							<br />{{{ $course->title_zh }}}
						@endif
				</h3>
			</a>
		</div>
		<div class="panel-footer panel-course-footer">
			<ul class="panel-course-footer-meta">
				<li>
					<dl>
						<dt>{{ trans('app.course_category') }}</dt>
						<dd>{{ Course::getCategoryTitle($course->category) }}</dd>
					</dl>
				</li>
				<li>
					<dl>
						<dt>{{ trans('app.course_level') }}</dt>
						<dd>{{{ $course->level }}}</dd>
					</dl>
				</li>
				@if (isset($course->initial))
					<li>
						<dl>
							<dt>{{ trans('app.course_department') }}</dt>
							<dd><abbr title="{{{ $course->department_title_en }}}">{{{ $course->initial }}}</abbr></dd>
						</dl>
					</li>
				@endif
				<li>
					<dl>
						<dt>{{ trans('app.course_commentCount') }}</dt>
						<dd>{{{ $course->comment_count }}}</dd>
					</dl>
				</li>
			</ul>
		</div>
	</div>
</div>