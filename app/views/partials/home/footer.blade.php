</div><!--/.container-->

<footer id="footer">
	<div class="container">
		<div class="clearfix">
			<p class="pull-left">&copy; Swiftzer {{ date('Y') }}</p>
			<p class="pull-right">Version {{{ Config::get('cityuge.version') }}}</p>
		</div>
		<p class="disclaimer">{{ Lang::get('app.footer_disclaimer') }}</p>
		<ul class="inline">
			<li>{{ link_to_route('about', Lang::get('app.footer_nav_about')) }}</li>
			<li><a href="http://swiftzer.net/category/cityu-ge-guide">{{ Lang::get('app.footer_nav_devBlog') }}</a></li>
			<li>{{ link_to_route('admin.dashboard', Lang::get('app.footer_nav_acp')) }}</li>
		</ul>
	</div><!-- /.container -->
</footer>

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', '***REMOVED***', 'swiftzer.net');
	{{-- Set the page view of Google Analytics if current page is a search result page --}}
	@if (Route::currentRouteName() == 'courses.searchResult')
		ga('send', 'pageview', {'page': '/search?q={{ urlencode($keyword) }}'});
	@else
		ga('send', 'pageview');
	@endif
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
@yield('footerScript')
</body>
</html>