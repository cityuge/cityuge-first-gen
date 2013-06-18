@extends('layouts.home')

@section('content')


<div class="row">
	@include('partials.comments.latestComment')
	{{--  Social media share buttons --}}
	<div id="social-network-btn" class="span6">
		<h4>{{ trans('app.comment_show_share') }}</h4>
		{{ trans('app.comment_show_shareDesc')}}
		<button id="facebook" class="btn btn-facebook" data-url="{{ URL::current() }}" data-text="{{ Lang::get('app.meta_home_desc') }}"></button>
		<button id="twitter" class="btn btn-twitter" data-url="{{ URL::current() }}" data-text="{{ Lang::get('app.meta_home_desc') }}"></button>
		<button id="google-plus" class="btn btn-google-plus" data-url="{{ URL::current() }}" data-text="{{ Lang::get('app.meta_home_desc') }}"></button>
	</div>
</div>

@stop

@section('footerScript')
{{ HTML::script('js/jquery.sharrre.js') }}
<script>
$(document).ready(function () {
	$('div[data-toggle=tooltip]').tooltip({ placement: 'left' });
	$('a[data-toggle=tooltip]').tooltip({ placement: 'left' });
});

// Social media share buttons
$('#twitter').sharrre({
	share: {
		twitter: true
	},
	template: '<i class="icon-twitter"></i> Tweet',
	enableHover: false,
	enableTracking: true,
	buttons: { twitter: {via: 'swiftzer'}},
	click: function(api, options){
		api.simulateClick();
		api.openPopup('twitter');
	}
});
$('#facebook').sharrre({
	share: {
		facebook: true
	},
	template: '<i class="icon-facebook"></i> Share',
	enableHover: false,
	enableTracking: true,
	click: function(api, options){
		api.simulateClick();
		api.openPopup('facebook');
	}
});
$('#google-plus').sharrre({
	share: {
		googlePlus: true
	},
	urlCurl: '',
	template: '<i class="icon-google-plus"></i> Share',
	enableHover: false,
	enableTracking: true,
	click: function(api, options){
		api.simulateClick();
		api.openPopup('googlePlus');
	}
});
</script>
@stop