@include('partials.header')

<div class="row">
		<div class="span12">


				@if (Session::has('alert_type') && Session::has('alert_body'))
					{{ HTML::alert(Session::get('alert_type'), Session::get('alert_body'), true) }}
				@endif

				@yield('content')
		</div><!--/span-->
</div>
@include('partials.footer')