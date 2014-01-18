<?php $currentRoute = Route::currentRouteName(); ?>
<!DOCTYPE html>
<html lang="{{ Session::get('_localeISO') }}">
<head>
	<meta charset="utf-8">
	@if (isset($title))
		<title>{{ $title }} | {{ trans('app.appTitle') }}</title>
	@else
		<title>{{ trans('app.appTitle') }}</title>
	@endif
	
	<!-- Meta keywords and description -->
	@if (isset($metaKeywords))
		<meta name="keywords" content="{{ implode(', ', $metaKeywords) . ', ' . trans('app.meta_globalKeyword') }}">
	@else
		<meta name="keywords" content="{{ trans('app.meta_globalKeyword') }}">
	@endif

	@if (isset($metaDescription))
		<meta name="description" content="{{ $metaDescription }}">
	@endif

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	
	<!-- CSS -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700" media="all" type="text/css" rel="stylesheet">
	{{ HTML::style('css/default.css') }}

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

	
	<!-- Social network -->
	<!-- Facebook -->
	<meta property="fb:admins" content="{{ Config::get('cityuge.facebookInsightsAdminId') }}">
	@if (isset($title))
		<meta property="og:title" content="{{ $title }} | {{ trans('app.appTitle') }}">
	@else
		<meta property="og:title" content="{{ trans('app.appTitle') }}">
	@endif
	<meta property="og:image" content="{{ URL::asset('img/logo-140px.png') }}">
	@if (isset($metaDescription))
		<meta property="og:description" content="{{ $metaDescription }}">
	@endif
	<meta property="og:url" content="{{ URL::current() }}">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary">
	<meta property="twitter:site" content="{{ Config::get('app.twitter_card_site') }}">
	@if (isset($title))
		<meta property="twitter:title" content="{{ $title }} | {{ trans('app.appTitle') }}">
	@else
		<meta property="twitter:title" content="{{ trans('app.appTitle') }}">
	@endif
	@if (isset($metaDescription))
		<meta property="twitter:description" content="{{ $metaDescription }}">
	@else
		<meta property="twitter:description" content="{{ trans('app.meta_homeDesc') }}">
	@endif
	<meta property="twitter:image:src" content="{{ URL::asset('img/logo-140px.png') }}">

	<!-- RSS feeds -->
	<link rel="alternate" type="application/rss+xml" title="{{ trans('app.feed_metaTitle') }}" href="{{ route('feed') }}">
	@if ($currentRoute === 'courses.show')
		<link rel="alternate" type="application/rss+xml" title="{{ trans('app.feed_course_metaTitle', array('courseCode' => $course->code)) }}" href="{{ route('courses.feed', array(strtolower($course->code))) }}">
	@endif
	<!-- favicon and Apple touch icons -->
	<link rel="shortcut icon" href="{{ URL::to('') }}/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::to('') }}/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::to('') }}/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::to('') }}/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="{{ URL::to('') }}/ico/apple-touch-icon-57-precomposed.png">
	<meta name="msapplication-TileImage" content="{{ URL::to('') }}/ico/metro-tile.png">
	<meta name="msapplication-TileColor" content="#FF9900">

	@section('headerScript')
		<!-- Require.JS -->
		<script data-main="{{ URL::to('') }}/js/default" src="http://cdnjs.cloudflare.com/ajax/libs/require.js/2.1.9/require.min.js"></script>
	@show

</head>
<body>
<a class="sr-only" href="#content">{{ trans('app.nav_skipNav') }}</a>
<header id="overall-header">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="sr-only">{{ trans('app.nav_toggleNav') }}</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				@if (Session::get('_locale') == 'en')
					<a class="navbar-brand navbar-brand-en" href="{{ route('home') }}" title="{{ trans('app.appTitle') }}">{{ trans('app.appTitle') }}</a>
				@else
					<a class="navbar-brand" href="{{ route('home') }}" title="{{ trans('app.appTitle') }}">{{ trans('app.appTitle') }}</a>
				@endif
			</div>
			
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<!-- Left hand side -->
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('app.nav_course') }} <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>{{ link_to_route('courses.index', trans('app.nav_allCourse')) }}</li>
							<li>{{ link_to_route('departments.index', trans('app.nav_department')) }}</li>
							<li>{{ link_to_route('stats', trans('app.nav_stat')) }}</li>
							<li class="divider"></li>
							<li role="presentation" class="dropdown-header">{{ trans('app.nav_cityUGECategory') }}</li>
							<li>{{ link_to_route('courses.category', trans('app.category_area1'), 'area-1') }}</li>
							<li>{{ link_to_route('courses.category', trans('app.category_area2'), 'area-2') }}</li>
							<li>{{ link_to_route('courses.category', trans('app.category_area3'), 'area-3') }}</li>
							<li>{{ link_to_route('courses.category', trans('app.category_unireq'), 'university-requirements') }}</li>
							<li role="presentation" class="dropdown-header">{{ trans('app.nav_otherCategory') }}</li>
							<li>{{ link_to_route('courses.category', trans('app.category_e'), 'foundation') }}</li>
							<li class="divider"></li>
							<li>{{ link_to_route('courses.search', trans('app.nav_advancedSearch')) }}</li>
						</ul>
					</li>
					<li>{{ link_to_route('comments.index', trans('app.nav_comment')) }}</li>
				</ul>

				<!-- Right hand side -->
				{{ Form::open(array('route' => 'courses.processSearch', 'method' => 'POST', 'id' => 'header-quick-search', 'class' => 'navbar-form navbar-right', 'role' => 'search')) }}
					<div class="form-group">
						<label for="header-quick-search-keyword" class="sr-only">{{ trans('app.nav_searchPlaceholder') }}</label>
						{{ Form::text('keyword', isset($search_result) ? $keyword : '', array('id' => 'header-quick-search-keyword', 'class' => 'form-control', 'placeholder' => trans('app.nav_searchPlaceholder'), 'x-webkit-speech' => '', 'x-webkit-grammar' => 'builtin:search', 'lang' => 'en')) }}
					</div>
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> <span class="sr-only">{{ trans('app.nav_search') }}</span></button>
					{{ Form::hidden('type', 'quick') }}
				{{ Form::close() }}
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>{{ HTML::link(LocaleHelper::getCurrentPageURLInLocale('hk'), '繁體中文') }}</li>
							<li>{{ HTML::link(LocaleHelper::getCurrentPageURLInLocale('cn'), '简体中文') }}</li>
							<li>{{ HTML::link(LocaleHelper::getCurrentPageURLInLocale('en'), 'English') }}</li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container -->
	</nav>
</header>

