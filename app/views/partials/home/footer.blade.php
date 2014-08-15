

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
		<nav class="hidden-print">
			<ul class="list-inline">
				<li>{{ link_to_route('about', trans('app.footer_nav_about')) }}</li>
				<li>{{ link_to_route('feed', trans('app.footer_nav_rss')) }}</li>
				<li><a href="http://facebook.com/cityuge">{{ trans('app.footer_nav_facebookFanPage') }}</a></li>
				<li><a href="http://swiftzer.net/category/cityuge">{{ trans('app.footer_nav_devBlog') }}</a></li>
                @if (Auth::check())
                    <li>{{ link_to_route('logout', trans('app.nav_logout')) }}</li>
                @endif
			</ul>
		</nav>
	</div><!-- /.container -->
</footer>

@if (App::environment('production'))
	<!-- Google Analytics: Universal Analytics tracking code -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', ga('create', '{{ Config::get('cityuge.googleAnalyticsUA') }}', '{{ Config::get('cityuge.googleAnalyticsDomain') }}'));
        ga('require', 'displayfeatures');
		ga('send', 'pageview');
	</script>
@endif

<!-- Scrollback.io -->
<script>
    window.scrollback = {room:"cityuge",embed:"toast",theme:"dark",minimize:true};(function(d,s,h,e){e=d.createElement(s);e.async=1;e.src=(location.protocol === "https:" ? "https:" : "http:") + "//scrollback.io/client.min.js";d.getElementsByTagName(s)[0].parentNode.appendChild(e);}(document,"script"));
</script>

@section('footerScript')
<script>
headerQuickSearch.init();
</script>
@show
</body>
</html>