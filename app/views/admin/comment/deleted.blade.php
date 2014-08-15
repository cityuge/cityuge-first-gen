@extends('layouts.admin')

@section('content')\
<div class="container">
    <div class="page-header">
        <h1>Deleted Comments</h1>
    </div>

    <p>Total: {{ $comments->getTotal() }}, ordered by deletion date in descending order.</p>
    {{ $comments->links() }}


    <section id="comment-container" class="row" itemscope itemtype="http://schema.org/UserComments">
        <!-- Create a dummy div for Masonry to get the correct column width in IE9 or above -->
        <div class="comment-wrapper-dummy"></div>
        @foreach ($comments as $comment)
        @include('partials.comments.commentItem')
        @endforeach
    </section>

    {{ $comments->links() }}

</div>

@stop

@section('footerScript')
@parent
<script>
    comment.initMasonry();
    comment.initComment();
</script>
@stop