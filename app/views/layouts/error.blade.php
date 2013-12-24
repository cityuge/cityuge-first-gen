<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	@if (isset($title))
		<title>{{ $title }} | {{ trans('app.appTitle') }}</title>
	@else
		<title>{{ trans('app.appTitle') }}</title>
	@endif

	<meta name="robots" content="noindex">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	
	<!-- CSS -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" media="all" type="text/css" rel="stylesheet">
	{{ HTML::style('css/error.css') }}

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

	<!-- favicon and Apple touch icons -->
	<link rel="shortcut icon" href="{{ URL::to('') }}/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::to('') }}/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::to('') }}/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::to('') }}/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="{{ URL::to('') }}/ico/apple-touch-icon-57-precomposed.png">
	<meta name="msapplication-TileImage" content="{{ URL::to('') }}/ico/metro-tile.png">
	<meta name="msapplication-TileColor" content="#FF9900">

</head>
<body>
<header class="container clearfix">
	<span class="simp-logo pull-left">{{ trans('app.appTitle', array(), null, 'en') }}</span>
	@if (isset($errorCode))
		<span class="label label-status-code pull-right">HTTP {{ $errorCode }}</span>
	@endif
</header>

@yield('content')

@if (App::environment('production'))
	<!-- Google Analytics: Universal Analytics tracking code -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', ga('create', '{{ Config::get('cityuge.googleAnalyticsUA') }}', '{{ Config::get('cityuge.googleAnalyticsDomain') }}');
		ga('send', 'pageview');
	</script>
@endif

</body>
</html>