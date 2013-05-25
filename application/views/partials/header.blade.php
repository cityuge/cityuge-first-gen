<?php $current_route = Request::route()->action['as']; ?>
<!DOCTYPE html>
<html lang="zh-HK">
<head>
	<meta charset="utf-8">
	@if (isset($title))
		<title>{{ $title }} | {{ __('app.app_title') }}</title>
	@else
		<title>{{ __('app.app_title') }}</title>
	@endif
	
	<!-- Meta keywords and description -->
	@if (isset($meta_keywords))
		<meta name="keywords" content="{{ implode(', ', $meta_keywords) . ', ' . __('app.meta_global_keyword') }}">
	@else
		<meta name="keywords" content="{{ __('app.meta_global_keyword') }}">
	@endif

	@if (isset($meta_description))
		<meta name="description" content="{{ $meta_description }}">
	@endif

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	{{ Asset::styles() }}
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700" media="all" type="text/css" rel="stylesheet">
	<!--[if IE 7]>{{ HTML::style('css/font-awesome-ie7.css') }}<![endif]-->
	<!--[if lt IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js"></script><![endif]-->

	<!-- Social medias -->
	{{-- Facebook --}}
	<meta property="fb:admins" content="***REMOVED***">
	@if (isset($title))
		<meta property="og:title" content="{{ $title }} | {{ __('app.app_title') }}">
	@else
		<meta property="og:title" content="{{ __('app.app_title') }}">
	@endif
	<meta property="og:image" content="{{ URL::to_asset('img/logo-140px.png') }}">
	@if (isset($meta_description))
		<meta property="og:description" content="{{ $meta_description }}">
	@endif
	<meta property="og:url" content="{{ URL::current() }}">

	{{-- Twitter --}}
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="{{ Config::get('app.twitter_card_site') }}">
	@if (isset($title))
		<meta name="twitter:title" content="{{ $title }} | {{ __('app.app_title') }}">
	@else
		<meta name="twitter:title" content="{{ __('app.app_title') }}">
	@endif
	@if (isset($meta_description))
		<meta name="twitter:description" content="{{ $meta_description }}">
	@else
		<meta name="twitter:description" content="{{ __('app.meta_home_desc') }}">
	@endif
	<meta name="twitter:image:src" content="{{ URL::to_asset('img/logo-140px.png') }}">

	<!-- RSS feeds -->
	<link rel="alternate" type="application/rss+xml" title="{{ __('app.feed_meta_title') }}" href="{{ URL::to_route('feed') }}">
	@if ($current_route === 'course.detail')
		<link rel="alternate" type="application/rss+xml" title="{{ __('app.feed_course_meta_title', array('course_code' => $course->code)) }}" href="{{ URL::to_route('course.feed', array(strtolower($course->code))) }}">
	@endif
	<!-- favicon and touch icons -->
	<link rel="shortcut icon" href="{{ URL::base() }}/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::base() }}/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::base() }}/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::base() }}/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="{{ URL::base() }}/ico/apple-touch-icon-57-precomposed.png">
	<meta name="msapplication-TileImage" content="{{ URL::base() }}/ico/metro-tile.png">
	<meta name="msapplication-TileColor" content="#FF9900">
	
	<script type="text/javascript"> 
		@section('scripts_header')
		@yield_section
	</script>
</head>
<body>
	<header class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<i class="icon-ellipsis-vertical"></i>
				</button>
				<a class="brand" href="{{ URL::base() }}" title="{{ __('app.app_title') }}">{{ __('app.app_title') }}</a>
				<nav class="nav-collapse collapse">
					<ul class="nav">
						@if ($current_route == 'course')
							<li class="active">
						@else
							<li>
						@endif
							{{ HTML::link_to_route('course', __('app.nav_course')) }}
						</li>

						@if ($current_route == 'comment')
							<li class="active">
						@else
							<li>
						@endif
							{{ HTML::link_to_route('comment', __('app.nav_comment')) }}
						</li>
						
						@if ($current_route == 'course.category')
							<li class="dropdown active">
						@else
							<li class="dropdown">
						@endif
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ __('app.nav_category') }} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ HTML::link_to_route('course.category', __('app.category_area1'), 'area-1') }}</li>
								<li>{{ HTML::link_to_route('course.category', __('app.category_area2'), 'area-2') }}</li>
								<li>{{ HTML::link_to_route('course.category', __('app.category_area3'), 'area-3') }}</li>
								<li>{{ HTML::link_to_route('course.category', __('app.category_unireq'), 'university-requirements') }}</li>
								<li class="divider"></li>
								<li>{{ HTML::link_to_route('course.category', __('app.category_e'), 'foundation') }}</li>
							</ul>
						</li>

						@if ($current_route == 'department')
							<li class="active">
						@else
							<li>
						@endif
							{{ HTML::link_to_route('department', __('app.nav_department')) }}
						</li>
					</ul><!-- /.nav -->
					<ul class="nav pull-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-rss"></i> {{ __('app.nav_rss') }} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ HTML::link_to_route('feed', __('app.nav_rss_site')) }}</li>
								@if ($current_route === 'course.detail')
									<li>{{ HTML::link_to_route('course.feed', __('app.nav_rss_course', array('course_code' => $course->code)), strtolower($course->code)) }}</li>
								@endif
							</ul>
						</li>
					</ul>
					{{-- Search form --}}
					{{ Form::open('courses/search', 'POST', array('class' => 'navbar-form pull-right form-search')) }}
						<div class="input-append">
						{{ Form::token() }}
							{{ Form::text('keyword', isset($search_result) ? $keyword : '', array('class' => 'input-xlarge search-query', 'placeholder' => __('app.nav_search_placeholder'), 'x-webkit-speech' => '', 'x-webkit-grammar' => 'builtin:search', 'lang' => 'en')) }}
							<button type="submit" class="btn btn-inverse"><i class="icon-search"></i> {{ __('app.nav_search') }}</button>
						</div>
					{{ Form::close() }}

				</nav><!--/.nav-collapse -->
			</div>
		</div>
	</header>

	<div class="container">