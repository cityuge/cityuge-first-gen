@extends('layouts.home')

@section('content')

<div id="content" class="container">
	<div class="row">
		@include('partials.comments.commentItem')
		<div class="col-sm-6">
			{{-- Admin Section --}}
			@if (Auth::check())
				<h4>{{ trans('app.comment_show_admin') }}</h4>
				<dl>
					<dt>{{ trans('app.comment_id') }}</dt>
					<dd>{{ $comment->id }}</dd>
					<dt>{{ trans('app.comment_ipAdress') }}</dt>
					<dd>{{{ $comment->ip_address }}}</dd>
					<dd>
						<a class="btn btn-default" href="http://whois.net/ip-address-lookup/{{{ $comment->ip_address }}}" target="_blank">{{ trans('app.comment_whois') }} <i class="fa fa-external-link"></i></a>
					</dd>
				</dl>

			@endif
			
			{{--  Social media share buttons --}}
			<h4>{{ trans('app.comment_share') }}</h4>
			{{ trans('app.comment_show_shareDesc')}}

		</div>
</div>
</div>

@stop

@section('footerScript')
	@parent
	<script>
		comment.initComment();
	</script>
@stop