<!DOCTYPE html>
<html lang="zh-HK">
<head>
	<meta charset="utf-8">
	<title>{{ Lang::get('app.admin_title') }}</title>

	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700" media="all" type="text/css" rel="stylesheet">
	{{ HTML::style('css/default.css') }}
	<!--[if IE 7]>{{ HTML::style('css/font-awesome-ie7.css') }}<![endif]-->
	<!--[if lt IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js"></script><![endif]-->
	<style>
		html {
			height: 100%;
		}
	</style>
	
	<!-- favicon and touch icons -->
	<link rel="shortcut icon" href="{{ URL::to('') }}/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::to('') }}/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::to('') }}/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::to('') }}/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="{{ URL::to('') }}/ico/apple-touch-icon-57-precomposed.png">
	<meta name="msapplication-TileImage" content="{{ URL::to('') }}/ico/metro-tile.png">
	<meta name="msapplication-TileColor" content="#FF9900">
</head>
<body id="login-body">


	<div id="login-box" class="well">
		<h1>{{ trans('app.login_title') }}</h1>
		@if (Session::has('alertType') && Session::has('alertBody'))
			{{ HTML::alert(Session::get('alertType'), Session::get('alertBody')) }}
		@endif

		{{ Form::open(array('route' => 'loggingIn', 'method' => 'post')) }}
			<p>
				{{ Form::text('username', Input::old('username'), array('placeholder' => trans('app.user_username'), 'class' => 'input-block-level', 'autofocus', 'autocomplete' => 'off')) }}
			</p>
			
			<p>
				{{ Form::password('password', array('placeholder' => trans('app.user_password'), 'class' => 'input-block-level', 'autocomplete' => 'off')) }}
			</p>
			
			<p>
				<label class="checkbox">
					{{ Form::checkbox('remember', 'remember', false) }}
					{{ Form::label('remember', trans('app.login_rememberMe')) }}
				</label>
			</p>
			
			<p>
				{{ Form::token() }}
				{{ Form::submit(trans('app.login_submit'), array('class' => 'btn btn-primary btn-large btn-block')) }}
			</p>
		{{ Form::close() }}
	</div>


</body>
</html>