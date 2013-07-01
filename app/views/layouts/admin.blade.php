@include('partials.admin.header')

<div class="row">
		<div class="span12">
			@if (Session::has('alertType') && Session::has('alertBody'))
				{{ HTML::alert(Session::get('alertType'), Session::get('alertBody'), true) }}
			@endif

			@yield('content')
		</div><!--/span-->
</div>

@include('partials.admin.footer')