<!DOCTYPE html>
<html lang="zh-HK">
<head>
	<meta charset="utf-8">
	@if (isset($title))
		<title>{{ $title }} | {{ Lang::get('app.appTitle') }}</title>
	@else
		<title>{{ Lang::get('app.appTitle') }}</title>
	@endif

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	{{ HTML::style('css/default.css') }}
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700" media="all" type="text/css" rel="stylesheet">
	<!--[if IE 7]>{{ HTML::style('css/font-awesome-ie7.css') }}<![endif]-->
	<!--[if lt IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js"></script><![endif]-->
	
	<!-- favicon and touch icons -->
	<link rel="shortcut icon" href="{{ URL::to('') }}/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::to('') }}/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::to('') }}/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::to('') }}/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="{{ URL::to('') }}/ico/apple-touch-icon-57-precomposed.png">
	<meta name="msapplication-TileImage" content="{{ URL::to('') }}/ico/metro-tile.png">
	<meta name="msapplication-TileColor" content="#FF9900">
</head>
<body class="body-error">
	<div class="container">
		<div class="row">
			<div class="span3 offset1 error-icon">
				{{-- Icon --}}
				@if (isset($errorIcon))
					<i class="icon-{{ $errorIcon }}"></i>
				@else
					<i class="icon-warning-sign"></i>
				@endif
			</div>
			<div class="span7 error-content">
				{{-- Content --}}
				@yield('content')
			</div>
		</div>
	</div>
</body>
</html>