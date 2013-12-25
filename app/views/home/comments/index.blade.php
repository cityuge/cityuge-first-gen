@extends('layouts.home')

@section('content')

<div id="content" class="container">

	<div class="page-header">
		<h1>{{ $title }}</h1>
	</div>
	{{ trans('app.comment_desc', array('count' => $comments->getTotal())) }}
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
{{ HTML::script('js/masonry.pkgd.min.js') }}
{{ HTML::script('js/jquery.sharrre.js') }}
{{ HTML::script('js/comment-box.min.js') }}

<script>
$(document).ready(function () {
	// Masonry
	$('#comment-container').masonry({
		transitionDuration: 0,
		itemSelector: '.comment-wrapper',
		columnWidth: '.comment-wrapper-dummy'
	});
});
</script>

@stop