<?php $currentRoute = Route::currentRouteName(); ?>
<!DOCTYPE html>
<html lang="{{ Session::get('_localeISO') }}">
<head>
	<meta charset="utf-8">
	@if (isset($title))
		<title>{{ $title }} | {{ Lang::get('app.admin_title') }}</title>
	@else
		<title>{{ Lang::get('app.admin_title') }}</title>
	@endif

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700" media="all" type="text/css" rel="stylesheet">
	{{ HTML::style('css/default.css') }}
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

	@yield('headerScript')

</head>
<body>
	<header class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<i class="icon-ellipsis-vertical"></i>
				</button>
				<a class="brand" href="{{ route('admin.dashboard') }}" title="{{ Lang::get('app.admin_title') }}">{{ Lang::get('app.admin_title') }}</a>
				<nav class="nav-collapse collapse">
					<ul class="nav">
						<li>
							<a href="{{ route('home') }}"><i class="icon-home"></i> {{ trans('app.admin_nav_site') }}</a>
						</li>
						@if ($currentRoute == 'courses.index' || $currentRoute == 'courses.category')
							<li class="dropdown active">
						@else
							<li class="dropdown">
						@endif
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Lang::get('app.nav_course') }} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ link_to_route('courses.index', Lang::get('app.nav_allCourse')) }}</li>
								<li class="divider"></li>
								<li class="nav-header">{{ trans('app.nav_cityUGECategory') }}</li>
								<li>{{ link_to_route('courses.category', Lang::get('app.category_area1'), 'area-1') }}</li>
								<li>{{ link_to_route('courses.category', Lang::get('app.category_area2'), 'area-2') }}</li>
								<li>{{ link_to_route('courses.category', Lang::get('app.category_area3'), 'area-3') }}</li>
								<li>{{ link_to_route('courses.category', Lang::get('app.category_unireq'), 'university-requirements') }}</li>
								<li class="nav-header">{{ trans('app.nav_otherCategory') }}</li>
								<li>{{ link_to_route('courses.category', Lang::get('app.category_e'), 'foundation') }}</li>
							</ul>
						</li>

						@if ($currentRoute == 'comments.index')
							<li class="active">
						@else
							<li>
						@endif
							{{ link_to_route('comments.index', Lang::get('app.nav_comment')) }}
						</li>

						@if ($currentRoute == 'departments.index')
							<li class="active">
						@else
							<li>
						@endif
							{{ link_to_route('departments.index', Lang::get('app.nav_department')) }}
						</li>
					</ul><!-- /.nav -->
					<ul class="nav pull-right">
						{{-- Locale --}}
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ HTML::link(LocaleHelper::getCurrentPageURLInLocale('hk'), '繁體中文') }}</li>
								<li>{{ HTML::link(LocaleHelper::getCurrentPageURLInLocale('cn'), '简体中文') }}</li>
							</ul>
						</li>
						{{-- Admin menu --}}
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{ URL::route('logout') }}"><i class="icon-off"></i> {{ trans('app.nav_logout') }}</a></li>
							</ul>
						</li>

					</ul>
					

				</nav><!--/.nav-collapse -->
			</div>
		</div>
	</header>

	<div class="container">