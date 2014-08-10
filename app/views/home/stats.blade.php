@extends('layouts.home')

@section('content')

<section id="content" class="container">
    <div class="page-header">
        <h1>{{ $title }}</h1>
    </div>



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



    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('app.stat_hotCourse') }}</h3>
        </div>
        <div class="panel-body">
            {{ trans('app.stat_hotCourseNote') }}
        </div>
        <ul class="nav nav-tabs nav-tabs-stats" role="tablist">
            <li class="active"><a href="#hot-course-area1" data-toggle="tab">{{ trans('app.category_area1') }}</a></li>
            <li><a href="#hot-course-area2" data-toggle="tab">{{ trans('app.category_area2') }}</a></li>
            <li><a href="#hot-course-area3" data-toggle="tab">{{ trans('app.category_area3') }}</a></li>
        </ul>
        <div class="tab-content">
            @for ($area = 1; $area <= 3; $area++)
                <div class="tab-pane fade {{ $area == 1 ? 'in active' : '' }}" id="hot-course-area{{ $area }}" role="tabpanel">
                    @if (!$stats['hotCoursesArea' . $area])
                        {{ HTML::alert('info', trans('app.stat_emptyList')) }}
                    @else
                        <table class="table table-condensed table-hover table-stats">
                            <thead>
                            <tr>
                                <th class="col-sm-1">{{ trans('app.stat_courseCode') }}</th>
                                <th>{{ trans('app.stat_courseTitle') }}</th>
                                <th class="col-sm-2">{{ trans('app.stat_totalComment') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stats['hotCoursesArea' . $area] as $row)
                                <tr>
                                    <td>{{ link_to_route('courses.show', $row->code, array(strtolower($row->code))) }}</td>
                                    <td>{{ link_to_route('courses.show', $row->title_en, array(strtolower($row->code))) }}</td>
                                    <td>{{ $row->total_comments }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            @endfor
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('app.stat_goodGradeCourse') }}</h3>
        </div>
        <div class="panel-body">
            {{ trans('app.stat_goodGradeCourseNote', array('limit' => Config::get('cityuge.home_statsMaxItem'))) }}
        </div>
        <ul class="nav nav-tabs nav-tabs-stats" role="tablist">
            <li class="active"><a href="#good-grade-course-area1" data-toggle="tab">{{ trans('app.category_area1') }}</a></li>
            <li><a href="#good-grade-course-area2" data-toggle="tab">{{ trans('app.category_area2') }}</a></li>
            <li><a href="#good-grade-course-area3" data-toggle="tab">{{ trans('app.category_area3') }}</a></li>
        </ul>
        <div class="tab-content">
            @for ($area = 1; $area <= 3; $area++)
            <div class="tab-pane fade {{ $area == 1 ? 'in active' : '' }}" id="good-grade-course-area{{ $area }}" role="tabpanel">
                @if (!$stats['goodGradeCoursesArea' . $area])
                {{ HTML::alert('info', trans('app.stat_emptyList')) }}
                @else
                <table class="table table-condensed table-hover table-stats">
                    <thead>
                    <tr>
                        <th class="col-sm-1">{{ trans('app.stat_courseCode') }}</th>
                        <th>{{ trans('app.stat_courseTitle') }}</th>
                        <th class="col-sm-2">{{ trans('app.stat_bayesianGradePoint') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stats['goodGradeCoursesArea' . $area] as $row)
                    <tr>
                        <td>{{ link_to_route('courses.show', $row->code, array(strtolower($row->code))) }}</td>
                        <td>{{ link_to_route('courses.show', $row->title_en, array(strtolower($row->code))) }}</td>
                        <td>{{ $row->bayesian_gp }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            @endfor
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('app.stat_badGradeCourse') }}</h3>
        </div>
        <div class="panel-body">
            {{ trans('app.stat_badGradeCourseNote', array('limit' => Config::get('cityuge.home_statsMaxItem'))) }}
        </div>
        <ul class="nav nav-tabs nav-tabs-stats" role="tablist">
            <li class="active"><a href="#bad-grade-course-area1" data-toggle="tab">{{ trans('app.category_area1') }}</a></li>
            <li><a href="#bad-grade-course-area2" data-toggle="tab">{{ trans('app.category_area2') }}</a></li>
            <li><a href="#bad-grade-course-area3" data-toggle="tab">{{ trans('app.category_area3') }}</a></li>
        </ul>
        <div class="tab-content">
            @for ($area = 1; $area <= 3; $area++)
            <div class="tab-pane fade {{ $area == 1 ? 'in active' : '' }}" id="bad-grade-course-area{{ $area }}" role="tabpanel">
                @if (!$stats['badGradeCoursesArea' . $area])
                {{ HTML::alert('info', trans('app.stat_emptyList')) }}
                @else
                <table class="table table-condensed table-hover table-stats">
                    <thead>
                    <tr>
                        <th class="col-sm-1">{{ trans('app.stat_courseCode') }}</th>
                        <th>{{ trans('app.stat_courseTitle') }}</th>
                        <th class="col-sm-2">{{ trans('app.stat_bayesianGradePoint') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stats['badGradeCoursesArea' . $area] as $row)
                    <tr>
                        <td>{{ link_to_route('courses.show', $row->code, array(strtolower($row->code))) }}</td>
                        <td>{{ link_to_route('courses.show', $row->title_en, array(strtolower($row->code))) }}</td>
                        <td>{{ $row->bayesian_gp }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            @endfor
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('app.stat_lightWorkloadCourse') }}</h3>
        </div>
        <div class="panel-body">
            {{ trans('app.stat_lightWorkloadCourseNote', array('limit' => Config::get('cityuge.home_statsMaxItem'))) }}
        </div>
        <ul class="nav nav-tabs nav-tabs-stats" role="tablist">
            <li class="active"><a href="#light-workload-course-area1" data-toggle="tab">{{ trans('app.category_area1') }}</a></li>
            <li><a href="#light-workload-course-area2" data-toggle="tab">{{ trans('app.category_area2') }}</a></li>
            <li><a href="#light-workload-course-area3" data-toggle="tab">{{ trans('app.category_area3') }}</a></li>
        </ul>
        <div class="tab-content">
            @for ($area = 1; $area <= 3; $area++)
            <div class="tab-pane fade {{ $area == 1 ? 'in active' : '' }}" id="light-workload-course-area{{ $area }}" role="tabpanel">
                @if (!$stats['lightWorkloadCoursesArea' . $area])
                {{ HTML::alert('info', trans('app.stat_emptyList')) }}
                @else
                <table class="table table-condensed table-hover table-stats">
                    <thead>
                    <tr>
                        <th class="col-sm-1">{{ trans('app.stat_courseCode') }}</th>
                        <th>{{ trans('app.stat_courseTitle') }}</th>
                        <th class="col-sm-2">{{ trans('app.stat_bayesianWorkload') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stats['lightWorkloadCoursesArea' . $area] as $row)
                    <tr>
                        <td>{{ link_to_route('courses.show', $row->code, array(strtolower($row->code))) }}</td>
                        <td>{{ link_to_route('courses.show', $row->title_en, array(strtolower($row->code))) }}</td>
                        <td>{{ $row->bayesian_workload }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            @endfor
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('app.stat_heavyWorkloadCourse') }}</h3>
        </div>
        <div class="panel-body">
            {{ trans('app.stat_heavyWorkloadCourseNote', array('limit' => Config::get('cityuge.home_statsMaxItem'))) }}
        </div>
        <ul class="nav nav-tabs nav-tabs-stats" role="tablist">
            <li class="active"><a href="#heavy-workload-course-area1" data-toggle="tab">{{ trans('app.category_area1') }}</a></li>
            <li><a href="#heavy-workload-course-area2" data-toggle="tab">{{ trans('app.category_area2') }}</a></li>
            <li><a href="#heavy-workload-course-area3" data-toggle="tab">{{ trans('app.category_area3') }}</a></li>
        </ul>
        <div class="tab-content">
            @for ($area = 1; $area <= 3; $area++)
            <div class="tab-pane fade {{ $area == 1 ? 'in active' : '' }}" id="heavy-workload-course-area{{ $area }}" role="tabpanel">
                @if (!$stats['heavyWorkloadCoursesArea' . $area])
                {{ HTML::alert('info', trans('app.stat_emptyList')) }}
                @else
                <table class="table table-condensed table-hover table-stats">
                    <thead>
                    <tr>
                        <th class="col-sm-1">{{ trans('app.stat_courseCode') }}</th>
                        <th>{{ trans('app.stat_courseTitle') }}</th>
                        <th class="col-sm-2">{{ trans('app.stat_bayesianWorkload') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stats['heavyWorkloadCoursesArea' . $area] as $row)
                    <tr>
                        <td>{{ link_to_route('courses.show', $row->code, array(strtolower($row->code))) }}</td>
                        <td>{{ link_to_route('courses.show', $row->title_en, array(strtolower($row->code))) }}</td>
                        <td>{{ $row->bayesian_workload }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            @endfor
        </div>
    </div>

</section>

@stop