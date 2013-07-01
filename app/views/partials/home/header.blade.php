<?php $currentRoute = Route::currentRouteName(); ?>
<!DOCTYPE html>
<html lang="zh-HK">
<head>
	<meta charset="utf-8">
	@if (isset($title))
		<title>{{ $title }} | {{ Lang::get('app.appTitle') }}</title>
	@else
		<title>{{ Lang::get('app.appTitle') }}</title>
	@endif
	
	<!-- Meta keywords and description -->
	@if (isset($metaKeywords))
		<meta name="keywords" content="{{ implode(', ', $metaKeywords) . ', ' . Lang::get('app.meta_globalKeyword') }}">
	@else
		<meta name="keywords" content="{{ Lang::get('app.meta_globalKeyword') }}">
	@endif

	@if (isset($metaDescription))
		<meta name="description" content="{{ $metaDescription }}">
	@endif

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700" media="all" type="text/css" rel="stylesheet">
	{{ HTML::style('css/default.css') }}
	<!--[if IE 7]>{{ HTML::style('css/font-awesome-ie7.css') }}<![endif]-->
	<!--[if lt IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js"></script><![endif]-->

	<!-- Social medias -->
	{{-- Facebook --}}
	<meta property="fb:admins" content="***REMOVED***">
	@if (isset($title))
		<meta property="og:title" content="{{ $title }} | {{ Lang::get('app.appTitle') }}">
	@else
		<meta property="og:title" content="{{ Lang::get('app.appTitle') }}">
	@endif
	<meta property="og:image" content="{{ URL::asset('img/logo-140px.png') }}">
	@if (isset($metaDescription))
		<meta property="og:description" content="{{ $metaDescription }}">
	@endif
	<meta property="og:url" content="{{ URL::current() }}">

	{{-- Twitter --}}
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="{{ Config::get('app.twitter_card_site') }}">
	@if (isset($title))
		<meta name="twitter:title" content="{{ $title }} | {{ Lang::get('app.appTitle') }}">
	@else
		<meta name="twitter:title" content="{{ Lang::get('app.appTitle') }}">
	@endif
	@if (isset($metaDescription))
		<meta name="twitter:description" content="{{ $metaDescription }}">
	@else
		<meta name="twitter:description" content="{{ Lang::get('app.meta_homeDesc') }}">
	@endif
	<meta name="twitter:image:src" content="{{ URL::asset('img/logo-140px.png') }}">

	<!-- RSS feeds -->
	<link rel="alternate" type="application/rss+xml" title="{{ Lang::get('app.feed_metaTitle') }}" href="{{ route('feed') }}">
	@if ($currentRoute === 'courses.show')
		<link rel="alternate" type="application/rss+xml" title="{{ Lang::get('app.feed_course_metaTitle', array('courseCode' => $course->code)) }}" href="{{ route('courses.feed', array(strtolower($course->code))) }}">
	@endif
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
	<header class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<i class="icon-ellipsis-vertical"></i>
				</button>
				<a class="brand" href="{{ URL::to('') }}" title="{{ Lang::get('app.appTitle') }}">{{ Lang::get('app.appTitle') }}</a>
				<nav class="nav-collapse collapse">
					<ul class="nav">
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
						{{-- RSS --}}
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-rss"></i> {{ Lang::get('app.nav_rss') }} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ link_to_route('feed', Lang::get('app.nav_rssSite')) }}</li>
								@if ($currentRoute === 'courses.show')
									<li>{{ link_to_route('courses.feed', Lang::get('app.nav_rssCourse', array('courseCode' => $course->code)), strtolower($course->code)) }}</li>
								@endif
							</ul>
						</li>
						{{-- Admin menu --}}
						@if (Auth::check())
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="{{ URL::route('admin.dashboard') }}"><i class="icon-dashboard"></i> {{ trans('app.nav_acp') }}</a></li>
									<li class="divider"></li>
									<li><a href="{{ URL::route('logout') }}"><i class="icon-off"></i> {{ trans('app.nav_logout') }}</a></li>
								</ul>
							</li>
						@endif
						<li>
							<ul class="inline">
								<li>
									{{-- Search form --}}
									{{ Form::open(['route' => 'courses.search', 'method' => 'POST', 'class' => 'navbar-form form-search']) }}
										<div class="input-append">
											{{ Form::text('keyword', isset($search_result) ? $keyword : '', array('class' => 'input-large search-query', 'placeholder' => Lang::get('app.nav_searchPlaceholder'), 'x-webkit-speech' => '', 'x-webkit-grammar' => 'builtin:search', 'lang' => 'en')) }}
											<button type="submit" class="btn btn-inverse"><i class="icon-search"></i> {{ Lang::get('app.nav_search') }}</button>
										</div>
									{{ Form::close() }}
								</li>
							</ul>
						</li>
					</ul>
					

				</nav><!--/.nav-collapse -->
			</div>
		</div>
	</header>

	<div class="container">