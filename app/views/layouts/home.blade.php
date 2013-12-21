@include('partials.home.header')


		
@if (Session::has('alertType') && Session::has('alertBody'))
	{{ HTML::alert(Session::get('alertType'), Session::get('alertBody'), true) }}
@endif

@yield('content')
		


@include('partials.home.footer')