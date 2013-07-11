@extends('layouts.home')

@section('content')


<div class="row">
	@include('partials.comments.latestComment')
	<div class="span6">
		{{-- Admin Section --}}
		@if (Auth::check())
			<h4>{{ trans('app.comment_show_admin') }}</h4>
			<dl>
				<dt>{{ trans('app.comment_id') }}</dt>
				<dd>{{ $comment->id }}</dd>
				<dt>{{ trans('app.comment_ipAdress') }}</dt>
				<dd>{{{ $comment->ip_address }}}</dd>
				<dd>
					<a class="btn" href="http://whois.net/ip-address-lookup/{{{ $comment->ip_address }}}" target="_blank">{{ trans('app.comment_whois') }} <i class="icon-external-link"></i></a>
				</dd>
			</dl>

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