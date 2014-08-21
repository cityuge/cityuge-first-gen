@extends('layouts.home')

@section('content')

<section id="content" class="jumbotron jumbotron-course jumbotron-course-{{ strtolower($course->category) }}">
    <div class="container">
    <h1>
        <span class="jumbotron-course-code">{{{ $course->code }}}</span>
        <span class="jumbotron-course-title">{{{ $course->title_en }}}</span>
        @if (Config::get('app.locale') != 'en' && $course->title_zh)
            <span class="jumbotron-course-title">{{{ $course->title_zh }}}</span>
        @endif
    </h1>
    <ul class="jumbotron-course-meta">
        <li>
            <dl>
                <dt>{{ trans('app.course_category') }}</dt>
                <dd>{{ CourseHelper::getCategoryText($course->category) }}</dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>{{ trans('app.course_level') }}</dt>
                <dd>{{{ $course->level }}}</dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>{{ trans('app.course_department') }}</dt>
                <dd>
                    @if (Config::get('app.locale') == 'en') {{{ $course->department->title_en }}}
                    @else {{{ $course->department->title_zh }}}
                    @endif
                </dd>
            </dl>
        </li>
    </ul>
</div>
</section>

<div class="container">
    <ul class="nav nav-pills visible-xs" id="phone-tab">
        <li><a href="#info">{{ trans('app.course_detail_info') }}</a></li>
        <li><a href="#stats">{{ trans('app.course_detail_stats') }}</a></li>
        <li class="active"><a href="#comments">{{ trans('app.course_detail_comment') }}</a></li>
    </ul>

    <!-- Info -->
    <div class="row">
        <!-- Course info -->
        <section id="info" class="col-sm-3">
            <dl>
                <dt>
                    {{ trans('app.course_assess') }}
                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#assess-explain-modal"><i class="fa fa-info-circle"></i> {{ trans('app.course_assess_explain') }}</button>
                </dt>
                <dd>
                    <ul class="fa-ul">
                        <li class="{{ $course->assess_exam ? 'text-success' : 'text-muted'}}">
                            <i class="fa-li fa {{ $course->assess_exam ? 'fa-check' : 'fa-times'}}"></i>{{ trans_choice($course->assess_exam ? 'app.course_assess_include' : 'app.course_assess_exclude', null, array('task' => trans('app.course_assess_exam'))) }}
                        </li>
                        <li class="{{ $course->assess_quiz ? 'text-success' : 'text-muted'}}">
                            <i class="fa-li fa {{ $course->assess_quiz ? 'fa-check' : 'fa-times'}}"></i>{{ trans_choice($course->assess_quiz ? 'app.course_assess_include' : 'app.course_assess_exclude', null, array('task' => trans('app.course_assess_quiz'))) }}
                        </li>
                        <li class="{{ $course->assess_report ? 'text-success' : 'text-muted'}}">
                            <i class="fa-li fa {{ $course->assess_report ? 'fa-check' : 'fa-times'}}"></i>{{ trans_choice($course->assess_report ? 'app.course_assess_include' : 'app.course_assess_exclude', null, array('task' => trans('app.course_assess_report'))) }}
                        </li>
                        <li class="{{ $course->assess_project ? 'text-success' : 'text-muted'}}">
                            <i class="fa-li fa {{ $course->assess_project ? 'fa-check' : 'fa-times'}}"></i>{{ trans_choice($course->assess_project ? 'app.course_assess_include' : 'app.course_assess_exclude', null, array('task' => trans('app.course_assess_project'))) }}
                        </li>
                    </ul>
                </dd>
                <dt>{{ trans('app.course_offering') }}</dt>
                <dd>
                    @if (count($course->offerings) > 0)
                        @foreach ($course->offerings as $offering)
                            <span class="label label-info">{{{ SemesterHelper::getSemesterText($offering->semester) }}}</span>
                        @endforeach
                    @else
                        <span class="text-error">{{ trans('app.course_offering_none') }}</span>
                    @endif
                </dd>
            </dl>

        </section><!-- /.span6 -->

        <!-- Stats -->
        <section id="stats" class="col-sm-6">
            @include('partials.courses.stats')
        </section>

        <!-- Links -->
        <nav id="links" class="col-sm-3">
            <div class="list-group">
                <a href="http://www.cityu.edu.hk/ug/201415/course/{{ $course->code }}.htm" target="_blank" class="list-group-item">{{ trans('app.course_form2b') }} <i class="fa fa-external-link"></i></a>
                @if ($course->category !== 'E')
                    <a href="http://www6.cityu.edu.hk/ge_info/courses/materials/html/{{ $course->code }}.html" target="_blank" class="list-group-item">{{ trans('app.course_edgeInfo') }} <i class="fa fa-external-link"></i></a>
                @endif
                <a href="{{{ $course->department->url }}}" target="_blank" class="list-group-item">{{ trans('app.course_department_website') }} <i class="fa fa-external-link"></i></a>
                <a href="{{ route('departments.courses', array(strtolower($course->department->initial))) }}" class="list-group-item">{{ trans('app.course_department_course') }}</a>
            </div>
        </nav>

    </div><!-- /.row -->

    <hr class="hidden-xs">

    <div>
        <h2 id="comments">{{ trans_choice('app.course_comment', $comments->getTotal(), array('count' => $comments->getTotal())) }}
            <a href="{{ URL::route('comments.create', array(strtolower($course->code))) }}" role="button" class="btn btn-primary">
                <i class="fa fa-pencil"></i> {{ Lang::get('app.comment_new') }}
            </a>
        </h2>
    </div>
    @if (!$comments->getTotal()) {{ HTML::alert('info', Lang::get('app.course_noComment')) }}
    @else
        <section id="comment-container" class="row" itemscope itemtype="http://schema.org/UserComments">
            <!-- Create a dummy div for Masonry to get the correct column width in IE9 or above -->
            <div class="comment-wrapper-dummy"></div>
            <div id="comment-container" class="row">
                @foreach ($comments as $comment)
                    @include('partials.comments.courseCommentItem')
                @endforeach
            </div>
        </section>
    @endif
    {{ $comments->fragment('comments')->links() }}

</div>


{{-- Assessment Task Definitions --}}
<div class="modal fade" id="assess-explain-modal" tabindex="-1" role="dialog" aria-labelledby="assess-explain-modal-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="assess-explain-modal-title">{{ trans('app.course_assess_model_title') }}</h4>
            </div>
            <div class="modal-body">
                <dl>
                    <dt>{{ trans('app.course_assess_exam') }}</dt>
                    <dd>{{ trans('app.course_assess_def_exam') }}</dd>
                    <dt>{{ trans('app.course_assess_quiz') }}</dt>
                    <dd>{{ trans('app.course_assess_def_quiz') }}</dd>
                    <dt>{{ trans('app.course_assess_report') }}</dt>
                    <dd>{{ trans('app.course_assess_def_report') }}</dd>
                    <dt>{{ trans('app.course_assess_project') }}</dt>
                    <dd>{{ trans('app.course_assess_def_project') }}</dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@stop

@section('footerScript')
    @parent

    <script>
        // Comments
        comment.initMasonry();
        comment.initComment();

        // Phone layout
        $info = $('#info');
        $stats = $('#stats');
        $links = $('#links');
        $comments = $('#comments, #comment-container');

        function resize()
        {
            if ($(window).width() < config.grid.smMin) {
                var activeTab = $('#phone-tab .active a').attr('href');
                $info.hide();
                $stats.hide();
                $links.hide();
                $comments.hide();
                if (activeTab === '#info') {
                    $info.show();
                    $links.show();
                } else if (activeTab === '#comments') {
                    $comments.show();
                } else {
                    $(activeTab).show();
                }
            } else {
                $info.show();
                $stats.show();
                $links.show();
                $comments.show();
            }
        }

        // run the resize function when the page is loaded as it can be a mobile device
        resize();

        $(window).resize(function () {
            resize();
        });

        // handle the click event of the pills shown in mobile device
        $('#phone-tab a').click(function (e) {
            e.preventDefault();
            $(e.target).parent().siblings().removeClass('active');
            $(e.target).parent().addClass('active');
            var clickedTab = $(e.target).attr('href');
            $info.hide();
            $stats.hide();
            $links.hide();
            $comments.hide();
            if (clickedTab === '#info') {
                $info.show();
                $links.show();
            } else if (clickedTab === '#comments') {
                $comments.show();
            } else {
                $(clickedTab).show();
            }
        });
    </script>

@stop
