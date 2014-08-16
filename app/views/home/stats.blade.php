@extends('layouts.home')

@section('content')

<section id="content" class="container">
    <div class="page-header">
        <h1>{{ $title }}</h1>
    </div>

    <div class="alert alert-warning" role="alert">{{ trans('app.stat_notes' ) }}</div>

    {{ trans('app.stat_updateAt', ['timestamp' => $stats['updatedAt']->format('M j, Y H:i')]) }}

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


    <div class="well">
        @if (Config::get('app.locale') == 'zh-hk')
            <h4>關於平均積點及平均工作量</h4>
            <p>各課程的平均積點及平均工作量均採用貝葉斯平均 (Bayesian average) 計算，公式為：</p>
            <img class="center-block" src="{{ asset('img/bayesian-avg.svg') }}" alt="Bayesian average equation in LaTeX: \frac{Cm+Rv}{m+v}"/><br>
            <p>其中：</p>
            <ul>
                <li><i>C</i>：所有 Area 1-3 GE 課程的算術平均積點 / 工作量</li>
                <li><i>v</i>：該課程的留言數目</li>
                <li><i>m</i>：排名的最低留言數目（目前為 {{ Config::get('cityuge.bayesianAvgMinCommentNum') }}）</li>
                <li><i>R</i>：該課程的算術平均積點 / 工作量</li>
            </ul>
            <p>平均積點的範圍是由 0 至 4.3。平均工作量的範圍是由 1 至 5，1 為非常輕鬆，5 為非常繁重。</p>
        @elseif (Config::get('app.locale') == 'zh-cn')
            <h4>关于平均积点及平均工作量</h4>
            <p>各课程的平均积点及平均工作量均采用贝叶斯平均 (Bayesian average) 计算，公式为：</p>
            <img class="center-block" src="{{ asset('img/bayesian-avg.svg') }}" alt="Bayesian average equation in LaTeX: \frac{Cm+Rv}{m+v}"/><br>
            <p>其中：</p>
            <ul>
                <li><i>C</i>：所有 Area 1-3 GE 课程的算术平均积点 / 工作量</li>
                <li><i>v</i>：该课程的留言数目</li>
                <li><i>m</i>：排名的最低留言数目（目前为 {{ Config::get('cityuge.bayesianAvgMinCommentNum') }}）</li>
                <li><i>R</i>：该课程的算术平均积点 / 工作量</li>
            </ul>
            <p>平均积点的范围是由 0 至 4.3。平均工作量的范围是由 1 至 5，1 为非常轻松，5 为非常繁重。</p>
        @else
            <h4>About Average Grade Point and Average Workload Level</h4>
            <p>The formula for calculating the average grade point and average workload level gives a Bayesian average:</p>
            <img class="center-block" src="{{ asset('img/bayesian-avg.svg') }}" alt="Bayesian average equation in LaTeX: \frac{Cm+Rv}{m+v}"/><br>
            <p>Where:</p>
            <ul>
                <li><i>C</i>: arithmetic mean of grade point / workload level across all Area 1-3 GE courses</li>
                <li><i>v</i>: number of comments for that course</li>
                <li><i>m</i>: minimum number of comments required to be listed (now is {{ Config::get('cityuge.bayesianAvgMinCommentNum') }})</li>
                <li><i>R</i>: arithmetic mean of grade point / workload level for that course</li>
            </ul>
            <p>The average grade point ranges between 0 to 4.3. The average workload level ranges between 1 to 5, where 1 for very light while 5 for very heavy.</p>
        @endif
    </div>

</section>

@stop