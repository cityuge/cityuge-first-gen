@extends('layouts.home')

@section('content')

<section id="content" class="jumbotron jumbotron-home">
	<div class="container">
		<h1>{{ trans('static.home_jumboTitle') }}</h1>
		<p>{{ trans('static.home_jumboDesc') }}</p>
		<p><a class="btn btn-primary btn-lg" role="button" href="http://www6.cityu.edu.hk/arro/content.asp?cid=163" target="_blank">{{ trans('static.home_jumboMore') }}</a></p>
	</div>
</section>

<section class="container">
	<p class="lead text-center">{{ trans('static.home_leadParagraph') }}</p>
	
	<div class="row">
		<div class="col-sm-4 home-feature-container">
			<div class="home-feature-icon home-feature-icon-search"><i class="fa fa-search"></i></div>
			<h2 class="text-center">{{ trans('static.home_featureSearchTitle') }}</h2>
			{{ trans('static.home_featureSearchDesc') }}
		</div>

		<div class="col-sm-4 home-feature-container">
			<div class="home-feature-icon home-feature-icon-browse"><i class="fa fa-comment"></i></div>
			<h2 class="text-center">{{ trans('static.home_featureBrowseTitle') }}</h2>
			{{ trans('static.home_featureBrowseDesc') }}
		</div>

		<div class="col-sm-4 home-feature-container">
			<div class="home-feature-icon home-feature-icon-write"><i class="fa fa-pencil"></i></div>
			<h2 class="text-center">{{ trans('static.home_featureWriteTitle') }}</h2>
			{{ trans('static.home_featureWriteDesc') }}
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-6">
			<blockquote>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
				<small>Someone famous in <cite title="Source Title">Source Title</cite></small>
			</blockquote>
			<blockquote>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
				<small>Someone famous in <cite title="Source Title">Source Title</cite></small>
			</blockquote>
		</div>
		<!-- Facebook like box plug-in -->
		<div class="col-sm-6">
			<div class="fb-like-box" data-href="http://www.facebook.com/cityuge" data-width="380" data-height="270" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
		</div>
	</div>
</section>


<!-- For Facebook like box plug-in -->
<div id="fb-root"></div>

@stop


@section('footerScript')

<script>
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=722255341119564";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

@stop