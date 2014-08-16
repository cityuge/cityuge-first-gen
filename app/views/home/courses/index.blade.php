@extends('layouts.home')

@section('content')

<div id="content" class="container">
    <div class="page-header">
        <h1>
            {{ $title }}
            @if (isset($categoryDesc))
                <small>{{ $categoryDesc }}</small>
            @endif
        </h1>
    </div>
</div>




<div class="container">
    {{-- if it is show courses in a category, show the semester lists --}}
    @if (isset($categoryUrl))
            <div class="course-dropdown-wrapper">
                <div class="btn-group">
                    <button type="button" id="semester-dropdown-menu" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        {{ trans('app.course_semester') }} <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="semester-dropdown-menu">
                        <li><a href="{{ route('courses.category', array($categoryUrl)) }}">{{ trans('app.course_semesterNone') }}</a></li>
                        @foreach ($semesters as $key => $value)
                            <li><a href="{{ route('courses.category', array($categoryUrl, strtolower($key))) }}">{{ $value }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
    @endif
    @if (isset($searchResult) && $courses->getTotal() === 0)
        {{ HTML::alert('info', Lang::get('app.course_search_nothingFound')) }}
    @else
        {{ $courses->appends(Input::except('page'))->links() }}
        <section id="course-container" class="row">
            <!-- Create a dummy div for Masonry to get the correct column width in IE9 or above -->
            <div class="course-wrapper-dummy"></div>
            @foreach ($courses as $course)
                @include('partials.courses.courseItem')
            @endforeach
        </section>
        {{ $courses->appends(Input::except('page'))->links() }}
    @endif

</div>

@stop



@section('footerScript')
@parent
<script>
$(document).ready(function () {
    // Masonry
    $('#course-container').masonry({
        transitionDuration: 0,
        itemSelector: '.course-wrapper',
        columnWidth: '.course-wrapper-dummy'
    });
});
</script>
@stop