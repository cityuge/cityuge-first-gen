</div><!--/.container-->

<footer id="footer">
	<div class="container">
		<div class="clearfix">
			<p class="pull-left">&copy; Swiftzer {{ date('Y') }}</p>
			<p class="pull-right">Version {{{ Config::get('cityuge.version') }}}</p>
		</div>
		<p class="disclaimer">{{ trans('app.footer_nav_memory', array('memory' => number_format(memory_get_peak_usage(true) / 1024 / 1024, 2))) }}</p>
	</div><!-- /.container -->
</footer>

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', '{{ Config::get('cityuge.googleAnalyticsUA') }}', '{{ Config::get('cityuge.googleAnalyticsDomain') }}');
	ga('send', 'pageview');
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
@yield('footerScript')
</body>
</html>