</div><!--/.container-->

<footer id="footer">
	<div class="container">
		<div class="clearfix">
			<p class="pull-left">&copy; Swiftzer {{ date('Y') }}</p>
			<p class="pull-right">Version 0.6</p>
		</div>
		<p class="disclaimer">{{ __('app.footer_disclaimer') }}</p>
		<ul class="inline">
			<li>{{ HTML::link_to_route('about', __('app.footer_nav_about')) }}</li>
			<li><a href="http://swiftzer.net/category/cityu-ge-guide">{{ __('app.footer_nav_dev_blog') }}</a></li>
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
	@if (Request::route()->action['as'] == 'course.search_result')
		ga('send', 'pageview', {'page': '/search?q={{ urlencode($keyword) }}'});
	@else
		ga('send', 'pageview');
	@endif
</script>



{{ Asset::scripts() }}
<script type="text/javascript"> 
	@section('scripts_footer')
	@yield_section
</script>
</body>
</html>