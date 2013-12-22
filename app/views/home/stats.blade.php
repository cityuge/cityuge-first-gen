@extends('layouts.home')

@section('content')

<section id="content" class="container">
	<div class="page-header">
		<h1>{{ $title }}</h1>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">{{ trans('app.stat_analysisReportTitle') }}</h3>
				</div>
				<div class="panel-body">
					{{ trans('app.stat_analysisReportDesc') }}
				</div>
				<ul class="list-group">
					<a href="http://issuu.com/swiftzer/docs/ge_course_analysis_report__aug_2013" class="list-group-item">{{ trans('app.stat_analysisReportRead' ) }}</a>
					<a href="http://docs.google.com/file/d/0B1iBpnvlJzmtMERYeGUtVFo4VG8/edit" class="list-group-item">{{ trans('app.stat_analysisReportDownload' ) }}</a>
				</ul>
			</div>
		</div>

		<div class="col-sm-6">
			<h2>{{ trans('app.stat_hotCourse') }}</h2>
			<ul class="nav nav-tabs" role="tablist">
				@for ($i = 1; $i <= 3; $i++)
					<li {{ $i == 1 ? 'class="active"' : '' }}><a href="#hot-course-area{{ $i }}" data-toggle="tab">{{ trans('app.category_area' . $i) }}</a></li>
				@endfor
			</ul>
			<div class="tab-content">
				@for ($i = 1; $i <= 3; $i++)
					<div class="tab-pane fade {{ $i == 1 ? 'in active' : '' }}" id="hot-course-area{{ $i }}" role="tabpanel">
						@if (!$stats['hotCoursesArea' . $i])
							{{ HTML::alert('info', trans('app.stat_emptyList')) }}
						@else
							<ol>
								@foreach($stats['hotCoursesArea' . $i] as $row)
									<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
								@endforeach
							</ol>
						@endif
					</div>
				@endfor
			</div>
		</div><!-- /.col-sm-6 -->
	</div><!-- /.row -->

	<div class="row">
		<div class="col-sm-6">
			<h2>{{ trans('app.stat_goodGradeCourse') }}</h2>
			<p class="text-muted">{{ trans('app.stat_goodGradeCourseNote', array('limit' => Config::get('cityuge.home_statsMaxItem'))) }}</p>
			<ul class="nav nav-tabs" role="tablist">
				@for ($i = 1; $i <= 3; $i++)
					<li {{ $i == 1 ? 'class="active"' : '' }}><a href="#goode-grade-course-area{{ $i }}" data-toggle="tab">{{ trans('app.category_area' . $i) }}</a></li>
				@endfor
			</ul>
			<div class="tab-content">
				@for ($i = 1; $i <= 3; $i++)
					<div class="tab-pane fade {{ $i == 1 ? 'in active' : '' }}" id="goode-grade-course-area{{ $i }}" role="tabpanel">
						@if (!$stats['goodGradeCoursesArea' . $i])
							{{ HTML::alert('info', trans('app.stat_emptyList')) }}
						@else
							<ol>
								@foreach($stats['goodGradeCoursesArea' . $i] as $row)
									<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
								@endforeach
							</ol>
						@endif
					</div>
				@endfor
			</div>
		</div><!-- /.col-sm-6 -->

		<div class="col-sm-6">
			<h2>{{ trans('app.stat_badGradeCourse') }}</h2>
			<p class="text-muted">{{ trans('app.stat_badGradeCourseNote', array('limit' => Config::get('cityuge.home_statsMaxItem'))) }}</p>
			<ul class="nav nav-tabs" role="tablist">
				@for ($i = 1; $i <= 3; $i++)
					<li {{ $i == 1 ? 'class="active"' : '' }}><a href="#bade-grade-course-area{{ $i }}" data-toggle="tab">{{ trans('app.category_area' . $i) }}</a></li>
				@endfor
			</ul>
			<div class="tab-content">
				@for ($i = 1; $i <= 3; $i++)
					<div class="tab-pane fade {{ $i == 1 ? 'in active' : '' }}" id="bade-grade-course-area{{ $i }}" role="tabpanel">
						@if (!$stats['badGradeCoursesArea' . $i])
							{{ HTML::alert('info', trans('app.stat_emptyList')) }}
						@else
							<ol>
								@foreach($stats['badGradeCoursesArea' . $i] as $row)
									<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
								@endforeach
							</ol>
						@endif
					</div>
				@endfor
			</div>
		</div><!-- /.col-sm-6 -->
	</div><!-- /.row -->

	<div class="row">
		<div class="col-sm-6">
			<h2>{{ trans('app.stat_lightWorkloadCourse') }}</h2>
			<ul class="nav nav-tabs" role="tablist">
				@for ($i = 1; $i <= 3; $i++)
					<li {{ $i == 1 ? 'class="active"' : '' }}><a href="#light-workload-course-area{{ $i }}" data-toggle="tab">{{ trans('app.category_area' . $i) }}</a></li>
				@endfor
			</ul>
			<div class="tab-content">
				@for ($i = 1; $i <= 3; $i++)
					<div class="tab-pane fade {{ $i == 1 ? 'in active' : '' }}" id="light-workload-course-area{{ $i }}" role="tabpanel">
						@if (!$stats['lightWorkloadCoursesArea' . $i])
							{{ HTML::alert('info', trans('app.stat_emptyList')) }}
						@else
							<ol>
								@foreach($stats['lightWorkloadCoursesArea' . $i] as $row)
									<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
								@endforeach
							</ol>
						@endif
					</div>
				@endfor
			</div>
		</div><!-- /.col-sm-6 -->

		<div class="col-sm-6">
			<h2>{{ trans('app.stat_heavyWorkloadCourse') }}</h2>
			<ul class="nav nav-tabs" role="tablist">
				@for ($i = 1; $i <= 3; $i++)
					<li {{ $i == 1 ? 'class="active"' : '' }}><a href="#heavy-workload-course-area{{ $i }}" data-toggle="tab">{{ trans('app.category_area' . $i) }}</a></li>
				@endfor
			</ul>
			<div class="tab-content">
				@for ($i = 1; $i <= 3; $i++)
					<div class="tab-pane fade {{ $i == 1 ? 'in active' : '' }}" id="heavy-workload-course-area{{ $i }}" role="tabpanel">
						@if (!$stats['heavyWorkloadCoursesArea' . $i])
							{{ HTML::alert('info', trans('app.stat_emptyList')) }}
						@else
							<ol>
								@foreach($stats['heavyWorkloadCoursesArea' . $i] as $row)
									<li>{{ link_to_route('courses.show', $row->code . ' - ' . $row->title_en, array(strtolower($row->code))) }}</li>
								@endforeach
							</ol>
						@endif
					</div>
				@endfor
			</div>
		</div><!-- /.col-sm-6 -->
		
	</div><!-- /.row -->
</section>

@stop