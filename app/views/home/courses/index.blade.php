@extends('layouts.home')

@section('content')

<div class="page-header">
	<h1>{{ $title }}</h1>
</div>

@if (isset($searchResult) && $courses->getTotal() === 0)
	{{ HTML::alert('info', Lang::get('app.course_search_nothingFound')) }}
@else
	{{ $courses->links() }}
	<table class="table table-striped table-hover table-responsive">
		<thead>
			<tr>
				<th>{{ Lang::get('app.course_code') }}</th>
				<th>{{ Lang::get('app.course_title') }}</th>
				<th>{{ Lang::get('app.course_department') }}</th>
				<th>{{ Lang::get('app.course_category') }}</th>
				<th>{{ Lang::get('app.course_level') }}</th>
				<th>{{ Lang::get('app.course_commentCount') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($courses as $course)
				<tr>
					<td data-title="{{ Lang::get('app.course_code') }}">{{ link_to_route('courses.show', $course->code, strtolower($course->code)) }}</td>
					<td data-title="{{ Lang::get('app.course_title') }}">
						{{ link_to_route('courses.show', $course->title_en, strtolower($course->code)) }}
						@if (!empty($course->title_zh))
							<br />{{ link_to_route('courses.show', $course->title_zh, strtolower($course->code)) }}
						@endif
					</td>
					<td data-title="{{ Lang::get('app.course_department') }}"><abbr title="{{{ $course->department_title_en }}}">{{{ $course->initial }}}</abbr></td>
					<td data-title="{{ Lang::get('app.course_category') }}">{{ Course::getCategoryTitle($course->category) }}</td>
					<td data-title="{{ Lang::get('app.course_level') }}">{{{ $course->level }}}</td>
					<td data-title="{{ Lang::get('app.course_commentCount') }}">{{ $course->comment_count }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $courses->links() }}
@endif

@stop