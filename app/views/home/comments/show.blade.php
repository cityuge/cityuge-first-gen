@extends('layouts.home')

@section('content')


<div class="row">
	@include('partials.comments.latestComment')
	<div class="span6">
		@if (Auth::check())
			<h4>{{ trans('app.comment_show_admin') }}</h4>
		
		@endif
		
		{{--  Social media share buttons --}}
		<h4>{{ trans('app.comment_share') }}</h4>
		{{ trans('app.comment_show_shareDesc')}}

	</div>
</div>

@stop

@section('footerScript')
{{ HTML::script('js/jquery.sharrre.js') }}
{{ HTML::script('js/comment-box.min.js') }}
@stop