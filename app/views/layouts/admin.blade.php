@include('partials.admin.header')

@if (Session::has('alertType') && Session::has('alertBody'))
<div class="container">
    {{ HTML::alert(Session::get('alertType'), Session::get('alertBody'), true) }}
</div>
@endif

@yield('content')

@include('partials.admin.footer')
