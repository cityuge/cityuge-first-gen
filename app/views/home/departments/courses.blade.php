@extends('layouts.home')

@section('content')

<div id="content" class="container">

    <div class="page-header">
        @if (Config::get('app.locale') === 'en')
            <h1>{{{ $department->initial }}} <small>{{{ $department->title_en }}}</small></h1>
        @else
            <h1>{{{ $department->initial }}} <small>{{{ $department->title_zh }}}</small></h1>
        @endif
    </div>

    @if (!$courses->getTotal()) {{ HTML::alert('info', trans('app.department_noCourse')) }}
    @else {{ $courses->links() }}

        <section id="course-container" class="row">
            <!-- Create a dummy div for Masonry to get the correct column width in IE9 or above -->
            <div class="course-wrapper-dummy"></div>
            @foreach ($courses as $course)
                @include('partials.courses.courseItem')
            @endforeach
        </section>

        {{ $courses->links() }}
    @endif

</div>

@stop


@section('footerScript')
@parent
{{ HTML::script('js/masonry.pkgd.min.js') }}
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
