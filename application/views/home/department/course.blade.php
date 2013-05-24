@layout('layouts.home')

@section('content')
<div class="page-header">
	<h1>{{ e($department->initial) }} <small>{{ e($department->title_en) }}</small></h1>
</div>

@if (!$courses->results)
	{{ HTML::alert('info', __('app.department_no_course')) }}
@else
	{{ $courses->links() }}
	<table class="table table-striped table-hover table-responsive">
		<thead>
			<tr>
				<th>{{ __('app.course_code') }}</th>
				<th>{{ __('app.course_title') }}</th>
				<th>{{ __('app.course_category') }}</th>
				<th>{{ __('app.course_level') }}</th>
				<th>{{ __('app.course_comment_count') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($courses->results as $course)
				<tr>
					<td data-title="{{ __('app.course_code') }}">{{ HTML::link_to_route('course.detail', $course->code, strtolower($course->code)) }}</td>
					<td data-title="{{ __('app.course_title') }}">
						{{ HTML::link_to_route('course.detail', $course->title_en, strtolower($course->code)) }}
						@if (!empty($course->title_zh))
							<br />{{ HTML::link_to_route('course.detail', $course->title_zh, strtolower($course->code)) }}
						@endif
					</td>
					<td data-title="{{ __('app.course_category') }}">{{ Course::get_category_title($course->category) }}</td>
					<td data-title="{{ __('app.course_level') }}">{{ e($course->level) }}</td>
					<td data-title="{{ __('app.course_comment_count') }}">{{ e($course->comment_count) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $courses->links() }}
@endif

@endsection