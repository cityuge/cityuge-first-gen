@extends('layouts.home')

@section('content')

<div id="content" class="container">
    <div class="page-header">
        <h1>{{ $title }}</h1>
    </div>

    <div class="alert alert-warning">
        {{ trans('app.comment_warning') }}
    </div>

    <div class="row">
        <aside class="col-md-4 col-md-push-8 hidden-xs">
            <dl>
                <dt>{{ trans('app.course_title') }}</dt>
                <dd>
                    {{{ $course->title_en }}}
                    @if ($course->title_zh)
                        <br />{{{ $course->title_zh }}}
                    @endif
                </dd>
                <dt>{{ trans('app.course_category') }}</dt>
                <dd>{{ CourseHelper::getCategoryText($course->category) }}</dd>
                <dt>{{ trans('app.course_department') }}</dt>
                <dd>
                    {{{ $course->department->title_en }}}<br />
                    {{{ $course->department->title_zh }}}
                </dd>
                <dt>{{ trans('app.course_level') }}</dt>
                <dd>{{{ $course->level }}}</dd>
            </dl>
        </aside>


        {{ Form::open(array('route' => 'comments.store', 'method' => 'POST', 'class' => 'col-md-8 col-md-pull-4 form-horizontal', 'role' => 'form')) }}
            <div class="form-group {{ $errors->has('semester') ? 'has-error' : '' }}">
                {{ Form::label('semester', trans('app.comment_semester'), array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-9">
                    {{ Form::select('semester', $semesters, Input::old('semester'), array('class' => 'form-control')) }}
                    {{ $errors->first('semester', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <div class="form-group {{ $errors->has('instructor') ? 'has-error' : '' }}">
                {{ Form::label('instructor', trans('app.comment_instructor'), array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-9">
                    {{ Form::text('instructor', Input::old('instructor'), array('class' => 'form-control')) }}
                    {{ $errors->first('instructor', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <div class="form-group {{ $errors->has('grade') ? 'has-error' : '' }}">
                {{ Form::label('grade', trans('app.comment_grade'), array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-9">
                    {{ Form::select('grade', $grades, Input::old('grade'), array('class' => 'form-control')) }}
                    {{ $errors->first('grade', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <div class="form-group {{ $errors->has('workload') ? 'has-error' : '' }}">
                {{ Form::label('workload', trans('app.comment_workload'), array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-9">
                    {{ Form::select('workload', $workloads, Input::old('workload'), array('class' => 'form-control')) }}
                    {{ $errors->first('workload', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                {{ Form::label('body', trans('app.comment_body'), array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-9">
                    {{ Form::textarea('body', Input::old('body'), array('class' => 'form-control', 'rows' => '10')) }}
                    {{ $errors->first('body', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <!-- reCAPTCHA -->
            <div class="form-group {{ $errors->has('recaptcha_response_field') ? 'has-error' : '' }}">
                {{ Form::label('recaptcha_response_field', trans('app.comment_recaptcha'), array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-9">
                    {{ Form::captcha(array('theme' => 'white')) }}
                    {{ $errors->first('recaptcha_response_field', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <div class="form-actions">
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    {{ Form::hidden('course_id', $course->id) }}
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> {{ trans('app.comment_submit') }}</button>
                </div>
            </div>
        {{ Form::close() }}

    </div>
</div>

@stop
