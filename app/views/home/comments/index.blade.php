@extends('layouts.home')

@section('content')

<div class="page-header">
	<h1>{{ $title }}</h1>
</div>
{{ trans('app.comment_desc', array('count' => $comments->getTotal())) }}
{{ $comments->links() }}

<div id="comments" class="row">
	@foreach ($comments as $comment)
		@include('partials.comments.latestComment')
	@endforeach
</div>

{{ $comments->links() }}

@stop

@section('footerScript')
{{ HTML::script('js/masonry.pkgd.min.js') }}

<script>
$(document).ready(function () {
	// Masonry
	$('#comments').masonry({
		transitionDuration: 0,
		itemSelector: '.comment'
	});

	$('div[data-toggle=tooltip]').tooltip({ placement: 'left' });
	$('a[data-toggle=tooltip]').tooltip({ placement: 'left' });
});
</script>

@stop