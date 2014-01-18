@extends('layouts.home')

@section('headerScript')
	<script data-main="{{ URL::to('') }}/js/comments-all" src="http://cdnjs.cloudflare.com/ajax/libs/require.js/2.1.9/require.min.js"></script>
@stop

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
