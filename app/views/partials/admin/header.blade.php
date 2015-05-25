<?php $currentRoute = Route::currentRouteName(); ?>
<!DOCTYPE html>
<html lang="en">
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
    <meta name="theme-color" content="#feb82b">

    <!-- CSS -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700" media="all" type="text/css" rel="stylesheet">
    {{ HTML::style('css/default.css') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    @section('headerScript')
    <script>
        var APP_BASE_URL = '{{ URL::to('') }}';
    </script>
    {{ HTML::script('js/vendor-common.min.js') }}
    {{ HTML::script('js/home-common.min.js') }}
    @show

</head>
<body>
<a class="sr-only" href="#content">{{ trans('app.nav_skipNav') }}</a>
<header id="overall-header">
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">{{ trans('app.nav_toggleNav') }}</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand navbar-brand-en" href="{{ route('admin.dashboard') }}" title="{{ trans('app.appTitle') }}">{{ trans('app.appTitle') }}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <!-- Left hand side -->
                <ul class="nav navbar-nav">
                    <li>{{ link_to_route('home', 'Home') }}</li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Comments <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>{{ link_to_route('admin.comments.deleted', 'Deleted comments') }}</li>
                        </ul>
                    </li>
                    <li>{{ link_to_route('admin.cache', 'Cache') }}</li>
                </ul>

                <!-- Right hand side -->
                {{ Form::open(array('route' => 'courses.processSearch', 'method' => 'POST', 'id' => 'header-quick-search', 'class' => 'navbar-form navbar-right', 'role' => 'search')) }}
                <div class="form-group">
                    <label for="header-quick-search-keyword" class="sr-only">{{ trans('app.nav_searchPlaceholder') }}</label>
                    {{ Form::text('keyword', isset($search_result) ? $keyword : '', array('id' => 'header-quick-search-keyword', 'class' => 'form-control', 'placeholder' => trans('app.nav_searchPlaceholder'))) }}
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> <span class="sr-only">{{ trans('app.nav_search') }}</span></button>
                {{ Form::hidden('type', 'quick') }}
                {{ Form::close() }}
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>
</header>
