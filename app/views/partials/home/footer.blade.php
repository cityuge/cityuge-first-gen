

<footer id="overall-footer">
	<div class="container">
		<div class="clearfix">
			<p class="pull-left">&copy; Swiftzer {{ date('Y') }}</p>
			<p class="pull-right">Version {{{ Config::get('cityuge.version') }}}</p>
		</div>
		<p class="footer-disclaimer">{{ trans('app.footer_disclaimer') }}</p>
		@if (Auth::check())
			<p class="disclaimer">{{ trans('app.footer_nav_memory', array('memory' => number_format(memory_get_peak_usage(true) / 1024 / 1024, 2))) }}</p>
		@endif
		<nav>
			<ul class="list-inline">
				<li>{{ link_to_route('about', Lang::get('app.footer_nav_about')) }}</li>
				<li><a href="http://facebook.com/cityuge">{{ trans('app.footer_nav_facebookFanPage') }}</a></li>
				<li><a href="http://swiftzer.net/category/cityuge">{{ Lang::get('app.footer_nav_devBlog') }}</a></li>
			</ul>
		</nav>
	</div><!-- /.container -->
</footer>

<!-- Google Analytics -->
<script>
	/*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', '{{ Config::get('cityuge.googleAnalyticsUA') }}', '{{ Config::get('cityuge.googleAnalyticsDomain') }}');
	ga('send', 'pageview');*/
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/hogan.js/2.0.0/hogan.min.js"></script>
{{ HTML::script('js/typeahead.min.js') }}
{{ HTML::script('js/search.min.js') }}
@yield('footerScript')
</body>
</html>